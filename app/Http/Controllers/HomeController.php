<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Category;
use App\Models\About_text;
use App\Models\About_cover;
use App\Models\About_faq;
use App\Models\About_sld;
use App\Models\ConfirmUsers;
use App\Models\Employee_block;
use App\Models\Product;
use App\Models\ProductTranslations;
use Illuminate\Http\Request;
use App\Models\HomeImage;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Mail;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscriber;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        $homeImage = HomeImage::where('code', 'home-image')->first();
        $topCategories = SubCategory::where('top', '>', 0)->get();
        $subCategories = SubCategory::get();
        $sliders = Product::where('slider_new', 'new')->orWhere('slider_sale', 'sale')->get();
        return view('home', [
            'homeImage' => $homeImage,
            'topCategories' => $topCategories,
            'subCategories' => $subCategories,
            'sliders' => $sliders,
        ]);
    }

    public function about(){
        $employees = Employee::get();
        $about_text = About_text::first();
        $cover = About_cover::first();
        $show = Employee_block::first();
        $about_faq = About_faq::get();
        $about_slider = About_sld::get();

        return view('about',[
            'employees' => $employees,
            'about_text' => $about_text,
            'cover' => $cover,
            'show' => $show,
            'about_faq' => $about_faq,
            'about_slider' => $about_slider,
        ]);
    }

    public function contactus(){
        return view('contactus');
    }

    public function send_email(Request $request){
        $name = $request->name;
        $email = $request->email;
        $number = $request->phone;
        $subject = $request->subject;
        $text = $request->text;

        try{

            Mail::send('emails.email', [
                'email'=>$email,
                'name'=>$name,
                'number'=>$number,
                'text' => $text,
                'subject' => $subject
            ], function ($message) use ($email, $name, $number, $text, $subject) {
                $message->to(getenv('MAIL_USERNAME'));
                $message->from($email, $name);
            });

            return back()->with("success", "Your Email Was Successfully Sent");
        } catch (\Exception $e){
            return back()->with("error", "Your Email Was Not Sent");
        }
    }

    public function subscribe(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Please, enter valid email or name')->withErrors($validator->errors())->withInput();
        }

        $check = Subscriber::where('email', $request->email)->first();
        if(!$check){
            Subscriber::create([
                'name' => $request->name,
                'email' => $request->email
            ]);
            return back()->with('success', 'You have successfully subscribed!');
        }

        return back()->with('error', 'You are already subscribed!');
    }

    public function search(Request $request){

        $validator = Validator::make($request->all(), [
            'word' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Please, enter search words')->withErrors($validator->errors())->withInput();
        }

        $products = Product::whereTranslationLike('name', '%'.$request->word.'%')->paginate(9);
        $rnd = Product::all()->random(3);

        if($request->key == "ajax"){
              return View::make('includes.productList',['products'=>$products]);
        }else{
            return view('searchResult',[
                'products' => $products,
                'word' => $request->word,
                'rnd' => $rnd,
            ]);
        }
    }

    public function again_email(){
        if (!session('confirm_email')){
            return abort(404);
        }else{
            $email = session('confirm_email');
            $model = ConfirmUsers::where('email', $email)->firstOrFail();
            $user = User::where('email', $email)->firstOrFail();
            $token = $model->token;
            Mail::send('emails.register', ['user' => $user, 'token' => $token], function ($m) use ($user) {
                $m->to($user->email, $user->name)->subject('Register');
            });
            return redirect()->back()->with('info', __('auth.butNotConfirmed'));
        }
    }

    public function terms(){
        return view('terms');
    }

    public function delivery(){
        return view('delivery');
    }

    public function refund(){
        return view('refund');
    }



}
