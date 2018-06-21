<?php

namespace App\Http\Controllers\Auth;

use Acacha\AdminLTETemplateLaravel\Console\Routes\Route;
use App\Models\ConfirmUsers;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyAuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:40',
            'password' => 'required|min:6',
        ]);
        $pass = md5($request->password);
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $pass, 'status' => '1', 'block' => 1], $request->has('remember'))) {
            if(Auth::user()->rol == 1){
                return redirect(route('admin'));
            }
            return redirect()->back();
        } else {
            $user = User::where('email', $request->email)->first();
            if ($user && $user->status == 0) {
                if (Hash::check(md5($request->password), $user->password)) {
                    $model = ConfirmUsers::where('email', $request->email)->firstOrFail();
                    $model->updated_at = Carbon::now();
                    $model->save();
                    session(['confirm_email' => $model->email]);
                    return back()
                        ->with('success', __('auth.exist_user').' <a href="'.route('again_email').'">'.__('auth.send_again').'</a>');
                }else{
                    return back()->with('error', __('auth.IncorrectLogin'));
                }
            }else{
                return back()->with('error', __('auth.IncorrectLogin'));
            }
        }
    }
}
