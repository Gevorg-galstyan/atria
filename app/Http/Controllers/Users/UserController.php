<?php

namespace App\Http\Controllers\Users;

use App\Models\ConfirmUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Message;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function index(Request $request, $id)
    {
        $user = User::where('href', $id)->firstOrFail();
        return view('user.index', [
            'user' => $user
        ]);
    }

//    =========   SETTINGS =========//
    public function getSettings(Request $request)
    {
        if (!$request->id) {
            return abort(404);
        }
        $user = User::where('href', $request->id)->firstOrFail();

        return view('user.settings', [
            'user' => $user
        ]);
    }

    public function editDennis(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|min:3|max:30',
            'last_name' => 'required|string|min:3|max:40',
            'address' => 'required|min:3',
            'phone' => 'required|min:9|max:20',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $user = User::where('id', Auth::user()->id)->update([
            'name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        if ($user) {
            return back()->with('success', __('user.updated'));
        }

    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required|min:6',
            'password' => 'required|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->with('password', true);
        }
        if (Hash::check(md5($request->oldPassword), Auth::user()->getAuthPassword())) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make(md5($request->password));
            $user->fb_google = null;
            $user->save();
            return back()->with([
                'success' => __('user.updated'),
                'password' => true
            ]);
        } else {
            return back()->with([
                'error' => __('user.old password') . ' ' . __('user.no right'),
                'password' => true
            ]);
        }
    }

    public function deleteUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required||min:6',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->with('delete', true);
        }
        if (Hash::check(md5($request->password), Auth::user()->getAuthPassword())) {
            $user = User::find(Auth::user()->id);
            ConfirmUsers::where('email', Auth::user()->email)->delete();
            $user->delete();
            return redirect('/');
        } else {
            return back()->with([
                'error' => __('auth.password') . ' ' . __('user.no right'),
                'delete' => true
            ]);
        }
    }

    public function getSendAdmin()
    {

        $messages = Message::where('user_id', Auth::user()->id)->orWhere('to_id', Auth::user()->id)->get();

        return view('user.sendAdmin', [
            'messages' => $messages,
        ]);
    }

    public function getMessage(Request $request)
    {
        if ($request->key && $request->key == 'set') {
            $messages = Message::where('id', '>', $request->message)->where(function ($query) {
                $query->where('user_id', Auth::user()->id)
                    ->orWhere('to_id', Auth::user()->id);
            })->get();
            Message::where(function ($query) {
                $query->where('user_id', Auth::user()->id)
                    ->orWhere('to_id', Auth::user()->id);
            })->update(['status_user' => 1]);
            if ($messages->first()){
              return  View::make('user.messageTemplate',[
                  'messages' => $messages
              ]);
            }

            return 0;
        }
        $validator = Validator::make($request->all(), [
            'text' => 'required',
        ]);

        if ($validator->fails()) {
            return abort(404);
        }
        $message = Message::create([
            'user_id' => Auth::user()->id,
            'to_id' => 1,
            'text' => $request->text,
        ]);
        return  View::make('user.messageTemplate',[
            'message' => $message
        ]);
    }

    public function enterEmail(Request $request){
        if (!Auth::guest() && !Auth::user()->email){
            return view('enterEmail');
        }else{
            abort(404);
        }
    }

    public function postEnterEmail(Request $request){
        $this->validate($request,[
            'email' => 'required|email|unique:users'
        ]);
        $update = User::where('id', Auth::user()->id)->update(['email' => $request->email]);
        if ($update){
            return redirect('/');
        }
    }
}
