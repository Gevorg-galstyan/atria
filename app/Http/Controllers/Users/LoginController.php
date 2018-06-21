<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider(Request $request)
    {
        return Socialite::driver($request->social)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request)
    {

        $userSocialite = Socialite::driver($request->social)->user();

        if($userSocialite->getEmail()){
            $res = User::where('email', $userSocialite->getEmail())->first();
            if ($res) {
                if ($res->status == 1) {
                    if ($res->block == 1) {
                        Auth::login($res);
                        return back();
                    } else {
                        return back();
                    }
                } else {
                    return back();
                }
            }
        }




        $res = User::where('driver_id', $userSocialite->getId())->first();
        if ($res) {
            if ($res->status == 1) {
                if ($res->block == 1) {
                    Auth::login($res);
                    return back();
                } else {
                    return back();
                }
            } else {
                return back();
            }
        }
        $res = User::where('driver_token', $userSocialite->token)->first();
        if ($res) {
            if ($res->status == 1) {
                if ($res->block == 1) {
                    Auth::login($res);
                    return back();
                } else {
                    return back();
                }
            } else {
                return back();
            }
        }

        $link =  $userSocialite->getId();


        while (true) {
            $a['href'] = $link;
            $validator = Validator::make($a, [
                'href' => 'required|unique:users'
            ]);
            if ($validator->fails()) {
                $link = $link . rand(0, 99);
                break;
            } else {
                break;
            }
        }

        $user = new User();

        $user->name = $userSocialite->getName();
        $user->driver_id = $userSocialite->getId();
        $user->email = $userSocialite->getEmail();
        $user->fb_google = $request->social;
        $user->driver_link = $request->social;
        $user->driver_token = $userSocialite->token;
        $user->status = 1;
        $user->block = 1;
        $user->phone = '';
        $user->address = $request->social;
        $user->href = $link;
        $user->password = bcrypt(md5($userSocialite->token));
        $user->save();
        Auth::login($user);
        return redirect('/');

        // $user->token;;
    }
}
