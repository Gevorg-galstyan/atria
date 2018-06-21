<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});
use Illuminate\Support\Facades\Route;

Route::get('again-emil', 'HomeController@again_email')->name('again_email');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Auth::routes();
        Route::get('enter-email', 'Users\UserController@enterEmail')->name('enterEmail');
        Route::post('enter-email', 'Users\UserController@postEnterEmail')->name('postEnterEmail');
        Route::group(['middleware' => 'cartCheck'], function () {

            Route::get('home', 'HomeController@index')->name('home');
            Route::get('about', 'HomeController@about')->name('about');
            Route::get('contactus', 'HomeController@contactus')->name('contactus');
            Route::get('', 'HomeController@index')->name('home');
            Route::get('terms-conditions', 'HomeController@terms')->name('terms');
            Route::get('delivery', 'HomeController@delivery')->name('delivery');
            Route::get('refund-policy', 'HomeController@refund')->name('refund');
            Route::get('sales', 'ProductController@sales')->name('sales');
            Route::post('subscribe', 'HomeController@subscribe')->name('subscribe');


            Route::get('login/{social}', 'Users\LoginController@redirectToProvider')->name('socialiteLogin');
            Route::get('login/{social}/callback', 'Users\LoginController@handleProviderCallback');


//        =================  Product  ================== //
            Route::get('category/{cat}', 'ProductController@index')->name('getCategory');
            Route::get('category/{cat}/{prod}', 'ProductController@getProduct')->name('getProduct');

//        =================  Product Filter Search ==================  //

            Route::post('filter', 'ProductController@pstFilterProduct')->name('pstFilterProduct');

            Route::post('send_email', 'HomeController@send_email')->name('send_email');

            //========= SEARCH  ======= //
            Route::post('search', 'HomeController@search')->name('search');

            //========= Price Ajax  ======= //
            Route::post('price', 'ProductController@priceAjax')->name('priceAjax');

            Route::get('register/confirm/{token}', 'Auth\AdvancedReg@confirm')->name('registerEmail');
            Route::get('repeat_confirm', 'Auth\AdvancedReg@getRepeat')->name('getRepeat');
            Route::post('login', 'Auth\MyAuthController@login')->name('login');
            Route::post('register', 'Auth\AdvancedReg@register')->name('register');
            Route::post('repeat_confirm', 'Auth\AdvancedReg@postRepeat');
            Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email')->middleware('passwordEmail');




//        =================  USER  ================== //
            Route::group(['middleware' => 'user'], function () {

                //        =================  Add To Cart ==================  //

                Route::post('add_to_cart', 'ProductController@add_to_cart')->name('add_to_cart');

                //        =================  Cart Remove==================  //
                Route::post('cart_remove', 'ProductController@cart_remove')->name('cart_remove');
                //        =================  Check out==================  //
                Route::post('check_out', 'ProductController@check_out')->name('check_out');

                //        =================  Comment  ================== //
                Route::post('comment/{prod}', 'ProductController@getComment')->name('getComment');


                Route::group(['prefix' => 'user/{id}'], function () {

                    Route::get('', 'Users\UserController@index')->name('user');

                    Route::get('settings', 'Users\UserController@getSettings')->name('userSettings');

                    Route::get('purchases', 'Users\UserController@getPurchases')->name('userPurchases');

                    Route::get('message', 'Users\UserController@getSendAdmin')->name('userGetMessage');

                    Route::post('getMessage', 'Users\UserController@getMessage')->name('getMessage');

                    Route::post('postMessage', 'Users\UserController@postSendAdmin')->name('userPostMessage');

                    Route::post('editDennis', 'Users\UserController@editDennis')->name('editDennis');

                    Route::post('changePassword', 'Users\UserController@changePassword')->name('changePassword');

                    Route::post('deleteUser', 'Users\UserController@deleteUser')->name('deleteUser');

                });
            });
        });

        //        =================  ADMIN  ================== //

        Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
            Route::get('', 'Admin\AdminController@index')->name('admin');
            Route::get('message/{id?}', 'Admin\AdminController@sendMessage')->name('sendMessage');
            Route::get('messages', 'Admin\AdminController@adminMessages')->name('adminMessages');
            Route::get('site', 'Admin\AdminController@site')->name('site');
            Route::get('aboutus', 'Admin\AdminController@aboutus')->name('aboutus');
            Route::get('icons', 'Admin\AdminController@icons')->name('icons');
            Route::get('users', 'Admin\AdminController@getUsers')->name('getUsers');
            Route::get('settings', 'Admin\AdminController@settings')->name('settings');
            Route::post('messageUser', 'Admin\AdminController@messageUser')->name('messageUser');
            Route::post('change_icons', 'Admin\AdminController@change_icons')->name('change_icons');


            //=========  SUBSCRIBERS  ======= //
            Route::get('subscribers', 'Admin\AdminController@getSubscribers')->name('getSubscribers');
            Route::post('subscribersEmail', 'Admin\AdminController@subscribersEmail')->name('subscribersEmail');
            Route::post('deleteSubscriber', 'Admin\AdminController@deleteSubscriber')->name('deleteSubscriber');

            //=========  EMPLOYEE  ======= //

            Route::post('addEmployee', 'Admin\AdminController@addEmployee')->name('addEmployee');
            Route::post('editEmployee/{id}', 'Admin\AdminController@editEmployee')->name('editEmployee');
            Route::post('editEmployeeDelete', 'Admin\AdminController@deleteEmployee')->name('deleteEmployee');
            Route::post('hideBlock', 'Admin\AdminController@hideBlock')->name('hideBlock');

            //=========  ABOUT US  ======= //
            Route::post('change_cover', 'Admin\AdminController@change_cover')->name('change_cover');
            Route::post('change_slider', 'Admin\AdminController@change_slider')->name('change_slider');
            Route::post('change_about_text', 'Admin\AdminController@change_about_text')->name('change_about_text');
            Route::post('add_question', 'Admin\AdminController@add_question')->name('add_question');
            Route::post('edit_questions/{id}', 'Admin\AdminController@edit_questions')->name('edit_questions');
            Route::post('deleteSlideImg/{id}', 'Admin\AdminController@deleteSlideImg')->name('deleteSlideImg');

            //=========  CATEGORY  ======= //

            Route::get('category', 'Admin\AdminCategoryController@index')->name('adminCategories');
            Route::get('category/{name?}', 'Admin\AdminCategoryController@show')->name('adminCategory');
            Route::post('addCategory', 'Admin\AdminCategoryController@create')->name('addCategory');
            Route::post('updateCategory', 'Admin\AdminCategoryController@update')->name('updateCategory');
            Route::post('deleteCategory', 'Admin\AdminCategoryController@delete')->name('deleteCategory');

            //=========  SUB CATEGORY  ======= //


//            Route::get('{name}/{cat}', 'Admin\AdminSubCategoryController@index')->name('adminSubCategories');
            Route::post('addTopCategory', 'Admin\AdminSubCategoryController@addTopCategory')->name('addTopCategory');

            Route::post('addSubCategory', 'Admin\AdminSubCategoryController@create')->name('addSubCategory');
            Route::post('updateSubCategory', 'Admin\AdminSubCategoryController@update')->name('updateSubCategory');
            Route::post('deleteSubCategory', 'Admin\AdminSubCategoryController@delete')->name('deleteSubCategory');


            //=========  FILTERS ======= //

            Route::get('filters', 'Admin\AdminFilterController@index')->name('getFilter');
//            Route::get('{cat}/subCategory/{name}', 'Admin\AdminSubCategoryController@show')->name('adminSubCategory');
//
            Route::post('addFilter', 'Admin\AdminFilterController@create')->name('addFilter');
//
//            Route::post('addSubCategory', 'Admin\AdminSubCategoryController@create')->name('addSubCategory');
//            Route::post('updateSubCategory', 'Admin\AdminSubCategoryController@update')->name('updateSubCategory');
            Route::post('deleteFilter', 'Admin\AdminFilterController@delete')->name('deleteFilter');


            //========= PRODUCT  ======= //

            Route::get('category/{cat?}/product/{name?}', 'Admin\AdminProductController@index')->name('adminProduct');
            Route::post('{cat}/addProduct', 'Admin\AdminProductController@create')->name('addProduct');
            Route::post('updateProduct/{prod?}', 'Admin\AdminProductController@update')->name('updateProduct');
            Route::post('deleteProduct', 'Admin\AdminProductController@delete')->name('deleteProduct');


            Route::post('updateHomeImage', 'Admin\AdminController@updateHomeImage')->name('updateHomeImage');
            Route::post('block', 'Admin\AdminController@blockUser')->name('blockUser');
            Route::post('getMessageAdmin', 'Admin\AdminController@getMessageAdmin')->name('getMessageAdmin');

            //========= COMMENT  ======= //

            Route::get('comment/{id}', 'Admin\AdminProductController@comment')->name('adminGetComment');
            Route::get('unpublish_comment', 'Admin\AdminProductController@unpublish_comment')->name('unpublish_comment');
            Route::post('deleteComment', 'Admin\AdminProductController@deleteComment')->name('deleteComment');
        });

    });
    
    Route::get('register',function(){
        return abort(404);
    });
    
    
