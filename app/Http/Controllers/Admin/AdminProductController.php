<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use App\Models\FilterCategory;
use Illuminate\Support\Facades\Validator;
use App\Models\Color;
use App\Models\Image;
use App\Models\Reviews;
use App\Models\Cart\CartTable;
use App\Models\Cart\CartFilter;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {

        Category::where('link', $request->cat)->firstOrFail();
        $sub = SubCategory::where('link', $request->name)->firstOrFail();
        $filters = FilterCategory::where('cat_id', $sub->id)->get();
        $products = Product::where('parent_id', $sub->id)->get();
        return view('vendor.adminlte.products', [
            'sub' => $sub,
            'filters' => $filters,
            'products' => $products,
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hy_name' => 'required|string',
            'en_name' => 'required|string',
            'ru_name' => 'required|string',
            'color.*' => 'min:6|max:8',
            'image' => 'required',
            'image.*' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }
        if ($request->hy_description || $request->en_description || $request->ru_description) {
            $validator = Validator::make($request->all(), [
                'hy_description' => 'required',
                'en_description' => 'required',
                'ru_description' => 'required',
            ]);
            if ($validator->fails()) {
                dd($validator->errors());
                return back()->withErrors($validator->errors())->withInput();
            }
        }
        $link = mb_strtolower($request->en_name);
        $link = str_replace(' ', '-', $link);
        while (true) {
            $a['link'] = $link;
            $validator = Validator::make($a, [
                'link' => 'required|unique:products'
            ]);
            if ($validator->fails()) {
                $link = $link . rand(0, 99);
            } else {
                break;
            }
        }

        $product = Product::create([
            'code' => time() . $request->en_name,
            'link' => $link,
            'sale' => $request->firstSale,
            'price' => $request->firstPrice,
            'parent_id' => $request->cat,
            'slider_new' => $request->new,
            'slider_sale' => $request->saleSlider,
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

        if ($request->color[0]) {
            foreach ($request->color as $color) {
                Color::create([
                    'product_id' => $product->id,
                    'color' => $color,
                ]);
            }
        }

        if ($request->image[0]) {
            $img = 0;
            foreach ($request->image as $image) {

                $data = $image;
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);

                $data = base64_decode($data);
                $imageName = $img . time() . '.jpg';
                file_put_contents('images/products/' . $imageName, $data);

                Image::create([
                    'image_name' => $imageName,
                    'product_id' => $product->id,
                ]);
                $img++;
            }

        };

        if ($request->filter_checkbox) {
        foreach ($request->filter_checkbox as $k => $v) {
            ProFilter::create([
                'filter_value' => $request->filter_checkbox[$k],
                'price' => $request->price[$k],
                'plusMinus' => $request->plusMinus[$k],
                'prod_id' => $product->id,
                'filter_id' => $request->filter_name[$k],
            ]);
        }
    }
        if ($request->filter_checkbox_value) {
            foreach ($request->filter_checkbox_value as $k => $v) {
                ProFilter::create([
                    'filter_value' => $request->filter_checkbox_value[$k],
                    'price' => $request->price_value[$k],
                    'plusMinus' => $request->plusMinus_value[$k],
                    'prod_id' => $product->id,
                    'filter_id' => $request->filter_name[$k],
                ]);
            }
        }
        if ($product) {
            return back()->with('newCat', $product->id);
        }

    }

    public function update(Request $request)
    {
        if (!$request->prod) {
            return abort(404);
        }
        $product = Product::where('link', $request->prod)->firstOrFail();
        $sub = SubCategory::where('id', $product->parent->id)->firstOrFail();
        $filters = FilterCategory::where('cat_id', $sub->id)->get();

        if ($request->key && $request->key == 'one') {
            return View::make('vendor.adminlte.updatePage.updateProduct', [
                'product' => $product,
                'filters' => $filters,
                'sub' => $sub,
            ]);
        }

        $validator = Validator::make($request->all(), [
            'hy_name' => 'required|string',
            'en_name' => 'required|string',
            'ru_name' => 'required|string',
            'color.*' => 'min:6|max:8',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        if ($request->hy_description1 || $request->en_description1 || $request->ru_description1) {
            $validator = Validator::make($request->all(), [
                'hy_description1' => 'required',
                'en_description1' => 'required',
                'ru_description1' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }
        }

        if (!$request->image_name || $request->image) {
            $validImage = Validator::make($request->all(), [
                'image' => 'required',
            ]);
            if ($validImage->fails()) {
                return redirect()->back()->withErrors($validImage->errors())->withInput();
            }
        }


        $product->sale = $request->firstSale;
        $product->price = $request->firstPrice;
        $product->slider_new = $request->new;
        $product->slider_sale = $request->saleSlider;
        $product->translate('hy')->name = $request->hy_name;
        $product->translate('en')->name = $request->en_name;
        $product->translate('ru')->name = $request->ru_name;
        $product->translate('hy')->description = $request->hy_description1;
        $product->translate('en')->description = $request->en_description1;
        $product->translate('ru')->description = $request->ru_description1;
        $product->save();


        Color::where('product_id', $product->id)->delete();
        if ($request->color[0]) {
            foreach ($request->color as $color) {
                Color::create([
                    'product_id' => $product->id,
                    'color' => $color,
                ]);
            }
        }
        if ($request->image_name) {
            $image_name = $request->image_name;

            Image::where(['product_id' => $product->id])->chunk(count($image_name), function ($images) use ($image_name) {
                $j = 0;
                foreach ($images as $image) {
                    Image::where('id', $image->id)->update(['image_name' => $image_name[$j]]);
                    $j++;
                }
            });

        }


        if ($request->image[0]) {
            $img = 0;
            foreach ($request->image as $image) {

                $data = $image;
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);

                $data = base64_decode($data);
                $imageName = $img . time() . '.jpg';
                file_put_contents('images/products/' . $imageName, $data);

                Image::create([
                    'image_name' => $imageName,
                    'product_id' => $product->id,
                ]);
                $img++;
            }

        };


        ProFilter::where('prod_id', $product->id)->delete();


        if ($request->filter_checkbox) {
            foreach ($request->filter_checkbox as $k => $v) {
                ProFilter::create([
                    'filter_value' => $request->filter_checkbox[$k],
                    'price' => $request->price[$k],
                    'plusMinus' => $request->plusMinus[$k],
                    'prod_id' => $product->id,
                    'filter_id' => $request->filter_name[$k],
                ]);
            }
        }
        if ($request->filter_checkbox_value) {
            foreach ($request->filter_checkbox_value as $k => $v) {
                ProFilter::create([
                    'filter_value' => $request->filter_checkbox_value[$k],
                    'price' => $request->price_value[$k],
                    'plusMinus' => $request->plusMinus_value[$k],
                    'prod_id' => $product->id,
                    'filter_id' => $request->filter_name[$k],
                ]);
            }
        }


        if ($product) {
            return back()->with('newCat', $product->id);
        }
    }


    public function delete(Request $request)
    {
        if ($request->key && $request->key == 'image') {
            $res = Image::where('id', $request->prod)->firstOrFail();
            if (file_exists(public_path() . '/images/products/' . $res->image_name)) {
                $delete = File::delete(public_path() . '/images/products/' . $res->image_name);
                $res->delete();
                return 1;

            }
        }
        $product = Product::where('link', $request->prod)->firstOrFail();

// delete Images //
        foreach ($product->images as $image) {
            if (file_exists(public_path() . '/images/products/' . $image->image_name)) {
                $delete = File::delete(public_path() . '/images/products/' . $image->image_name);
                if (!$delete) {
                    return abort(404);
                }
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
        return 1;

    }

    public function comment(Request $request)
    {
        if (!$request->id) {
            return abort(404);
        } else {
            if ($request->id == 'all') {

                $comments = Reviews::where('published', 0)->get();
                return view('vendor.adminlte.comments', [
                    'comments' => $comments,
                ]);
            } else {

                $all_comments = Reviews::where('new', '!=', 1)->where('product_id', $request->id)->update([
                    'new' => 1
                ]);


                $comments = Reviews::where('product_id', $request->id)->get();
                $product = Product::where('id', $request->id)->first();

                return view('vendor.adminlte.commentsPage', [
                    'comments' => $comments,
                    'product' => $product

                ]);

            }
        }
    }

    public function unpublish_comment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prod' => 'integer|numeric|min:1'
        ]);
        if ($validator->fails()) {
            return abort(404);
        }

        $comments = Reviews::where('id', $request->prod)->update(['published' => $request->public]);

        if ($comments) {
            return 1;
        }


        return back();
    }

    public function deleteComment(Request $request)
    {
        $com = Reviews::where('id', $request->prod)->firstOrFail();
        $com->delete();
        return 1;
    }
}
