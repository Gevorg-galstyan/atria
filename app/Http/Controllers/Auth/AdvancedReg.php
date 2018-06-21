<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\User;
use Illuminate\Support\Facades\Mail;
use App\Models\ConfirmUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdvancedReg extends Controller
{
    public function register(Request $request)

    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:40',
            'last_name' => 'required|max:40',
            'email' => 'required|max:40|email',
            'password' => 'required|confirmed|min:6',
            'address' => 'required',
            'phone' => 'required|min:9'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        while (true) {
            if (!isset($href)) {
                $first_name = str_replace(' ', '.', $request->first_name);
                $last_name = str_replace(' ', '.', $request->last_name);
                $href = mb_strtolower($first_name . '.' . $last_name);
            }
            $res = User::where('href', $href)->first();
            if (!is_null($res)) {
                $href = $href . '.' . rand(1000, 9999);
            } else {
                break;
            }
        }
//        try {
            $user = User::where('email', '=', $request->input('email'))->first();
            if (!empty($user->email)) {
                if ($user->status == 0) {
                    $model = ConfirmUsers::where('email', $request->email)->first();

                    if (!empty($model->token)) {
                        $model->updated_at = Carbon::now();
                        $model->save();
                        session(['confirm_email' => $model->email]);
                        return back()
                            ->with('success', __('auth.exist_user').' <a href="'.route('again_email').'">'.__('auth.send_again').'</a>');
                    } else {
                        $token = $token = str_random(32);
                        $email = $user->email;
                         ConfirmUsers::create([
                            'email' => $email,
                            'token' => $token,
                             'pass' => md5($request->password),
                        ]);
                    }
                    Mail::send('emails.register', ['user' => $user, 'token' => $token], function ($m) use ($user) {
                        $m->to($user->email, $user->name)->subject('Register');
                    });
                    return redirect()->back()->with('info', __('auth.butNotConfirmed'));
                } elseif ($user->status == 1) {
                    return redirect()->back()
                        ->with('error', __('auth.forgotPassword') .
                            '<a href="' . route('getRepeat') . '">
                            ' . __('auth.forgotPassword') . '</a>');
                }
            }
            $pass = md5($request->password);
            $user = User::create([
                'name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'password' => bcrypt($pass),
                'href' => $href,
            ]);
            $email = $user->email;
            $token = str_random(32);
            if ($user) {
                $confirm = ConfirmUsers::create([
                    'email' => $email,
                    'token' => $token,
                    'pass' => md5($request->password),
                ]);
                if ($confirm) {
                    Mail::send('emails.register', ['user' => $user, 'token' => $token], function ($m) use ($user) {
                        $m->to($user->email, $user->name)->subject('Register');
                    });
                }
            }
//        } catch (\Exception $e) {
//            dd($e);
//            return redirect()->back()->with('error', __('auth.serverError'));
//        }
        return redirect()->back()->with('success', __('auth.confirmEmail'));

    }

    public function confirm($token)
    {
        $model = ConfirmUsers::where('token', '=', $token)->firstOrFail();

        $user = User::where('email', '=', $model->email)->first();
        $pass = $model->pass;
        $user->status = 1;
        $user->save();
        $model->delete();
        if (Auth::attempt(['email' => $user->email, 'password' => $pass, 'status' => '1'])) {
            return redirect('/')->with('success', $user->name . ' ' . __('auth.registerSuccessful'));
        } else {
            return redirect()->route('home');
        }
    }

    public function getRepeat()
    {
        return view('auth.passwords.email');
    }

}
