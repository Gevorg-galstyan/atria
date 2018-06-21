<?php

namespace App\Http\Controllers\Admin;

use App\Models\About_faq;
use App\Models\About_sld;
use App\Models\About_text;
use App\Models\Employee_site;
use App\Models\Reviews;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Message;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\HomeImage;
use Illuminate\Support\Facades\File;
use App\Models\SubCategory;
use App\Models\Social_icons;
use App\Models\Employee;
use App\Models\Employee_block;
use App\Models\About_cover;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{
    public function index()
    {
//        Category::create([
//            'code' => 'grec',
//            'price' => '2000',
//            'hy' => [
//                'name' => 'Greece',
//                'description' => 'hayeren',
//            ],
//            'en' => [
//                'name' => 'Grèce',
//                'description' => 'angleren',
//            ],
//            'ru' => [
//                'name' => 'Grèce',
//                'description' => 'ruseren',
//            ]
//        ]);

//$a = Category::where('code', 'grec')->first();
//        dd($a->translate(session('locale'))->name);
//        Category::where('code', 'grec')->delete();


        return view('vendor.adminlte.home');
    }

    public function blockUser(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'public' => 'required|boolean',
            'user' => 'required'
        ]);

        if ($validate->fails()) {
            return abort(404);
        }
        $result = User::where('href', $request->user)->update(['block' => $request->public]);
        if ($result) {
            return 1;
        }
    }

    public function sendMessage(Request $request)
    {
        if ($request->id) {
            $user = User::where('href', $request->id)->firstOrFail();
            $messages = Message::where('user_id', $user->id)->orWhere('to_id', $user->id)->get();
            return view('vendor.adminlte.sendMessage', [
                'user' => $user,
                'messages' => $messages
            ]);
        }

    }

    public function getMessageAdmin(Request $request)
    {

        $user = User::where('href', $request->id)->firstOrFail();
        if ($request->key && $request->key == 'set') {
            $messages = Message::where('id', '>', $request->message)->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('to_id', $user->id);
            })->get();
            Message::where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('to_id', $user->id);
            })->update(['status_admin' => 1]);
            if ($messages->first()) {
                return View::make('vendor.adminlte.messageTemplate', [
                    'messages' => $messages,
                ]);
            }

            return 0;
        } else {
            $message = Message::create([
                'user_id' => Auth::user()->id,
                'to_id' => $user->id,
                'text' => $request->text,
            ]);
            return View::make('vendor.adminlte.messageTemplate', [
                'message' => $message,
            ]);
        }
    }

    public function adminMessages()
    {
        $users = User::whereHas('messages')->orWhereHas('messagesSeen')->paginate(20);


        return view('vendor.adminlte.messages', ['users' => $users]);
    }

    public function getUsers()
    {
        User::where('new', 0)->update([
            'new' => 1
        ]);

        $users = User::where('status', 1)->orderBy('id', 'desc')->get();

        return view('vendor.adminlte.users', ['users' => $users]);
    }

    public function deleteSubscriber(Request $request){
        if ($request->prod){
            Subscriber::where('id', $request->prod)->delete();
            return 1;
        }
    }

    public function getSubscribers()
    {
        Subscriber::where('new', 0)->update([
            'new' => 1
        ]);
        $subscribers = Subscriber::orderBy('id', 'desc')->get();

        return view('vendor.adminlte.subscribers', ['subscribers' => $subscribers]);
    }

    public function subscribersEmail(Request $request)
    {
        if ($request->key && $request->key == 'one') {
            return View::make('vendor.adminlte.modal.subscribersEmail');
        } else {

             $subject = $request->name;
            try {

                Mail::send('emails.emailSubscribes', [
                    'text' => $request->description,

                ], function ($message) use ($request, $subject) {
                    foreach ($request->emails as $email) {
                        $message->bcc($email)->subject($subject);
                    }
                });

                return response()->json(["success" => "Your Email Was Successfully Sent"]);

            } catch (\Exception $e) {
                return response()->json(["error" => "Your Email Was Not Sent"]);
            }
        }
    }

    public function messageUser(Request $request)
    {
        $user = User::where('href', $request->user)->firstOrFail();
        $messages = Message::where('user_id', $user->id)->orWhere('to_id', $user->id)->get();
        return View::make('vendor.adminlte.messageContentExample', [
            'messages' => $messages,
            'user' => $user,
        ]);
    }

    public function site()
    {

        $homeImage = HomeImage::where('code', 'home-image')->first();
        $topCategories = SubCategory::where('top', '>', 0)->get();
        $subCategories = SubCategory::get();

        return view('vendor.adminlte.site', [
            'homeImage' => $homeImage,
            'topCategories' => $topCategories,
            'subCategories' => $subCategories,
        ]);
    }

    public function change_cover(Request $request)
    {
        if ($request->key && $request->key == 'one') {
            $cover = About_cover::first();
            return View::make('vendor.adminlte.updatePage.updateAboutCover', [
                'cover' => $cover,
            ]);
        } else {
            $image = About_cover::first();
            if ($request->image) {
                $data = $_POST['image'];
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);

                $data = base64_decode($data);
                $imageName = time() . '.jpg';
                file_put_contents('images/covers/' . $imageName, $data);
                if (file_exists(public_path() . '/images/covers/' . $image->image)) {
                    File::delete(public_path() . '/images/covers/' . $image->image);
                }
            } else {
                $imageName = $image->image;

            }

            $image->image = $imageName;
            $image->save();

            return back();
        }
    }

    public function change_about_text(Request $request)
    {
        if ($request->key && $request->key == 'one') {
            $product = About_text::first();
            return View::make('vendor.adminlte.updatePage.updateAboutText', [
                'product' => $product,
            ]);
        } else {

            $product = About_text::first();

//            $product = About_text::create([
//                'code' => "skjdcnkjsdnc".time(),
//                'hy' => [
//                    'header' => $request->hy_name,
//                    'description' => $request->hy_description1,
//                ],
//                'en' => [
//                    'header' => $request->en_name,
//                    'description' => $request->en_description1,
//                ],
//                'ru' => [
//                    'header' => $request->ru_name,
//                    'description' => $request->ru_description1,
//                ]
//            ]);

            $product->code = time();
            $product->translate('hy')->header = $request->hy_name;
            $product->translate('en')->header = $request->en_name;
            $product->translate('ru')->header = $request->ru_name;
            $product->translate('hy')->description = $request->hy_description1;
            $product->translate('en')->description = $request->en_description1;
            $product->translate('ru')->description = $request->ru_description1;

            $product->save();

            return back();
        }
    }

    public function editEmployee(Request $request)
    {

        if ($request->key && $request->key == 'one') {
            $product = Employee::where('id', $request->prod)->first();
            return View::make('vendor.adminlte.updatePage.updateEmployee', [
                'product' => $product,
            ]);
        } else {
            $image = Employee::where('id', $request->id)->first();
            if ($request->image) {
                $data = $_POST['image'];
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);

                $data = base64_decode($data);
                $imageName = time() . '.jpg';
                file_put_contents('images/employee/' . $imageName, $data);
                if (file_exists(public_path() . '/images/employee/' . $image->image)) {
                    File::delete(public_path() . '/images/employee/' . $image->image);
                }
            } else {
                $imageName = $image->image;
            }

            $image->image = $imageName;

            $image->translate('hy')->name = $request->hy_name;
            $image->translate('en')->name = $request->en_name;
            $image->translate('ru')->name = $request->ru_name;
            $image->translate('hy')->position = $request->hy_position;
            $image->translate('en')->position = $request->en_position;
            $image->translate('ru')->position = $request->ru_position;
            $image->translate('hy')->text = $request->hy_text;
            $image->translate('en')->text = $request->en_text;
            $image->translate('ru')->text = $request->ru_text;

            Employee_site::where('employee_id', $request->id)->update([
                'facebook' => $request->facebook,
                'google' => $request->google,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'pinterest' => $request->pinterest,
                'skype' => $request->skype,
                'vimeo' => $request->vimeo,
                'youtube' => $request->youtube,
                'instagram' => $request->instagram,
            ]);

            $image->save();
            return back();
        }

    }

    public function deleteEmployee(Request $request){
        $res = Employee::where('id', $request->prod)->firstOrFail();
        if (file_exists(public_path() . '/images/employee/' . $res->image)) {
            File::delete(public_path() . '/images/employee/' . $res->image);
        }
        $res->deleteTranslations();
        $res->delete();
        return 1;
    }

    public function change_slider(Request $request)
    {
        if ($request->key && $request->key == 'one') {
            $product = About_sld::get();
            return View::make('vendor.adminlte.updatePage.updateAboutSlider', [
                'product' => $product,
            ]);
        } else {
            if ($request->image[0]) {
                $img = 0;
                foreach ($request->image as $image) {

                    $data = $image;
                    list($type, $data) = explode(';', $data);
                    list(, $data) = explode(',', $data);

                    $data = base64_decode($data);
                    $imageName = $img . time() . '.jpg';
                    file_put_contents('upload/about_slider/' . $imageName, $data);

                    About_sld::create([
                        'image' => $imageName,
                        'code' => time() . $request->text_en[$img],
                        'hy' => [
                            'text' => $request->text_hy[$img],
                        ],
                        'en' => [
                            'text' => $request->text_en[$img],
                        ],
                        'ru' => [
                            'text' => $request->text_ru[$img],
                        ]
                    ]);
                    $img++;
                }

            };

            return back();
        }

    }

    public function deleteSlideImg(Request $request)
    {
        if ($request->key && $request->key == 'image') {
            $res = About_sld::where('id', $request->prod)->firstOrFail();
            if (file_exists(public_path() . '/upload/about_slider/' . $res->image)) {
                File::delete(public_path() . '/upload/about_slider/' . $res->image);
                $res->delete();
                return 1;

            }
        }
    }

    public function add_question(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'hy_name' => 'required|string',
//            'en_name' => 'required|string',
//            'ru_name' => 'required|string',
//        ]);
//        if ($validator->fails()) {
//            return back()->with('error', 'add')->withErrors($validator->errors())->withInput();
//        }
        if ($request->key && $request->key == 'one') {
            return View::make('vendor.adminlte.modal.modalAddQuestion', [
            ]);
        } else {

            About_faq::create([
                'code' => time() . "code",
                'hy' => [
                    'header' => $request->hy_name,
                    'description' => $request->hy_description1
                ],
                'en' => [
                    'header' => $request->en_name,
                    'description' => $request->en_description1
                ],
                'ru' => [
                    'header' => $request->ru_name,
                    'description' => $request->ru_description1
                ],

            ]);

            return back();
        }

    }

    public function edit_questions(Request $request)
    {
        $product = About_faq::where('id', $request->prod)->first();

        if ($request->key && $request->key == 'one') {
            return View::make('vendor.adminlte.updatePage.updateAboutQuestions', [
                'product' => $product,
            ]);
        } else {
            $product->code = time();
            $product->translate('hy')->header = $request->hy_name;
            $product->translate('en')->header = $request->en_name;
            $product->translate('ru')->header = $request->ru_name;
            $product->translate('hy')->description = $request->hy_description1;
            $product->translate('en')->description = $request->en_description1;
            $product->translate('ru')->description = $request->ru_description1;

            $product->save();

            return back();
        }
    }

    public function aboutus()
    {
        $show = Employee_block::first();
        $employees = Employee::get();
        $cover = About_cover::first();
        $slide = About_sld::get();
        $about_text = About_text::first();
        $about_slider = About_sld::get();
        $about_faq = About_faq::get();

        return view('vendor.adminlte.aboutus', [
            'employees' => $employees,
            'cover' => $cover,
            'slide' => $slide,
            'about_text' => $about_text,
            'show' => $show,
            'about_slider' => $about_slider,
            'about_faq' => $about_faq
        ]);
    }

    public function hideBlock(Request $request)
    {
        if ($request->key && $request->key == 'one') {
            $product = Employee_block::first();
            return View::make('vendor.adminlte.updatePage.updateHideEmployees', [
                'product' => $product,
            ]);
        } else {
            Employee_block::first()->update([
                'hide' => $request->radio,
            ]);

            return back();
        }
    }

    public function icons()
    {
        $icons = Social_icons::get();

        return view('vendor.adminlte.icons', [
            'icons' => $icons,
        ]);
    }

    public function change_icons(Request $request)
    {

        for ($i = 1; $i <= count($request->icons); $i++) {
            Social_icons::where('id', $i)->update([
                'link' => $request->icons[$i - 1]
            ]);
        }
        return back();
    }

    public function addEmployee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hy_name' => 'required|string',
            'en_name' => 'required|string',
            'ru_name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'add')->withErrors($validator->errors())->withInput();
        }

        if ($request->image) {
            $data = $_POST['image'];
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);

            $data = base64_decode($data);
            $imageName = time() . '.jpg';
            file_put_contents('images/employee/' . $imageName, $data);
        }

        $empl = Employee::create([
            'code' => time() . $imageName,
            'image' => $imageName,
            'hy' => [
                'name' => $request->hy_name,
                'position' => $request->hy_position,
                'text' => $request->hy_text
            ],
            'en' => [
                'name' => $request->en_name,
                'position' => $request->en_position,
                'text' => $request->en_text
            ],
            'ru' => [
                'name' => $request->ru_name,
                'position' => $request->ru_position,
                'text' => $request->ru_text
            ],

        ]);

        $empl_social = Employee_site::create([
            'employee_id' => $empl->id,
            'facebook' => $request->facebook,
            'google' => $request->google,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'pinterest' => $request->pinterest,
            'skype' => $request->skype,
            'vimeo' => $request->vimeo,
            'youtube' => $request->youtube,
            'instagram' => $request->instagram,
        ]);

        return back();

    }

    public function updateHomeImage(Request $request)
    {
        if ($request->key && $request->key == 'one') {
            $product = HomeImage::where('code', $request->prod)->first();
            return View::make('vendor.adminlte.updatePage.updateHomeImage', [
                'product' => $product,
            ]);
        } else {
            $homeImage = HomeImage::where('code', 'home-image')->first();
            if ($request->image) {
                $data = $_POST['image'];
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);

                $data = base64_decode($data);
                $imageName = time() . '.jpg';
                file_put_contents('upload/' . $imageName, $data);
                if (file_exists(public_path() . '/upload/' . $homeImage->image_name)) {
                    File::delete(public_path() . '/upload/' . $homeImage->image_name);
                }
            } else {
                $imageName = $homeImage->image_name;
            }

            $homeImage->image_name = $imageName;
            $homeImage->translate('hy')->text_1 = $request->hy_text_1;
            $homeImage->translate('en')->text_1 = $request->en_text_1;
            $homeImage->translate('ru')->text_1 = $request->ru_text_1;
            $homeImage->translate('hy')->text_2 = $request->hy_text_2;
            $homeImage->translate('en')->text_2 = $request->en_text_2;
            $homeImage->translate('ru')->text_2 = $request->ru_text_2;
            $homeImage->translate('hy')->text_3 = $request->hy_text_3;
            $homeImage->translate('en')->text_3 = $request->en_text_3;
            $homeImage->translate('ru')->text_3 = $request->ru_text_3;
            $homeImage->save();

            return back();

        }

    }

    public function settings(){

        $admin = User::where('rol',1)->first();

        return view('vendor.adminlte.settings', [
            'admin' => $admin
        ]);
    }

}
