<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Models\ConfirmUsers;
use Illuminate\Support\Facades\Mail;

class PasswordEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if (!empty($user->email) && $user->status == 0){
            $model = ConfirmUsers::where('email', $request->email)->first();
            if ($model->token){
                $token = $model->token;
            }else{
                $token = $token = str_random(32);
                $email = $user->email;
                ConfirmUsers::create([
                    'email' => $email,
                    'token' => $token,
                ]);
            }
            Mail::send('emails.register', ['user' => $user, 'token' => $token], function ($m) use ($user) {
                $m->to($user->email, $user->name)->subject('Register');
            });
            return redirect()->back()->with('info', __('userSend.asdasd'));
        }elseif (!empty($user->email) && $user->status == 1){

            return $next($request);

        }elseif (empty($user->email)){

            return redirect()->back()->with('error', __('userSend.notRegistered'));
        }

        return $next($request);
    }
}
