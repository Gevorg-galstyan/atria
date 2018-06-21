<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use App\Models\FilterCategory;
use App\Models\Cart\CartTable;
use App\Models\Cart\CartFilter;
use Illuminate\Support\Facades\File;
use App\Models\Image;
use App\Models\Color;
use App\Models\ProFilter;
use App\Models\Reviews;

class AdminCategoryController extends Controller
{
    public function index()
    {
        return view('vendor.adminlte.categories');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hy_name' => 'required|string',
            'en_name' => 'required|string',
            'ru_name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'add')->withErrors($validator->errors())->withInput();
        }
        $link = mb_strtolower($request->en_name);
        $link = str_replace(' ', '-', $link);
        $newCat = Category::create([
            'code' => time().$link,
            'link' => $link,

            'hy' => [
                'name' => $request->hy_name,
                'description' => $request->hy_description,
            ],
            'en' => [
                'name' => $request->en_name,
                'description' => $request->en_description,
            ],
            'ru' => [
                'name' => $request->ru_name,
                'description' => $request->ru_description,
            ]
        ]);
        if ($newCat) {
            return back()->with('newCat', $newCat->id);
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'prod' => 'required',
        ]);
        $cat = Category::where('link', $request->prod)->firstOrFail();

        if ($request->key && $request->key == 'one') {
            return View::make('vendor.adminlte.updatePage.updateCat', [
                'product' => $cat
            ]);
        }
        $validator = Validator::make($request->all(), [
            'hy_name' => 'required|string|email',
            'en_name' => 'required|string',
            'ru_name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $link = mb_strtolower($request->en_name);
        $link = str_replace(' ', '-', $link);
        $cat->code = $request->en_name;
        $cat->link = $link;
        $cat->translate('hy')->name = $request->hy_name;
        $cat->translate('en')->name = $request->en_name;
        $cat->translate('ru')->name = $request->ru_name;
        $cat->save();
        if ($cat) {
            return back()->with([
                'success' => 'Category Updated',
                'newCat' => $cat->id,
            ]);
        }
    }

    public function show(Request $request)
    {
        $category = Category::where('link', $request->name)->firstOrFail();

        $filters = FilterCategory::get();
        return view('vendor.adminlte.subCategories',[
            'category' => $category,
            'filters' => $filters,
        ]);
    }

    public function delete(Request $request)
    {
        $category = Category::where('link', $request->prod)->firstOrFail();
        foreach ($category->subCategories as $cat){
            foreach ($cat->products as $product) {

// delete Images //
                foreach ($product->images as $image) {
                    if (file_exists(public_path() . '/images/products/' . $image->image_name)) {
                        File::delete(public_path() . '/images/products/' . $image->image_name);

                    }
                }
                Image::where('product_id', $product->id)->delete();
                Color::where('product_id', $product->id)->delete();
                ProFilter::where('prod_id', $product->id)->delete();
                Reviews::where('product_id', $product->id)->delete();
                $carts = CartTable::where('product_id', $product->id)->get();
                foreach ($carts as $cart){
                    CartFilter::where('cart_id', $cart->id)->delete();
                    $cart->delete();
                }
                $product->deleteTranslations();
                $product->delete();
            }

            if (file_exists(public_path() . '/images/subCategory/' . $cat->image_name)) {
                File::delete(public_path() . '/images/subCategory/' . $cat->image_name);
            }
            if (file_exists(public_path() . '/images/subCategory/' . $cat->general_image)) {
                File::delete(public_path() . '/images/subCategory/' . $cat->general_image);
            }


//        $cat->roles()->detach();
            $cat->deleteTranslations();
            $cat->delete();
        }
//        $cat->roles()->detach();
        $category->deleteTranslations();
        $category->delete();
        return 1;

    }
}
