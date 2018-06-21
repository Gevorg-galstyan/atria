<?php

namespace App\Http\Controllers;


use App\Models\FilterSub;
use App\Models\FilterValue;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Reviews;
use Illuminate\Support\Facades\View;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Cart\CartTable;
use App\Models\Cart\CartFilter;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->cat) {
            return abort(404);
        }


        $subCategory = SubCategory::where('link', $request->cat)->firstOrFail();
        $category = $subCategory->category;
        $products = Product::where('parent_id', $subCategory->id)->orderBy('id', 'desc')->paginate(9);

        $other_products = Product::where('parent_id', '!=', $subCategory->id)->inRandomOrder()->limit(4)->get();


        return view('products', [
            'subCategory' => $subCategory,
            'category' => $category,
            'other_products' => $other_products,
            'products' => $products,
        ]);
    }

    public function getProduct(Request $request)
    {
        if (!$request->cat || !$request->prod) {
            return abort(404);
        }

        $subCat = SubCategory::where('link', $request->cat)->firstOrFail();
        $product = Product::where('link', $request->prod)->firstOrFail();
        $other_products = Product::where('parent_id', '!=', $subCat->id)->inRandomOrder()->limit(4)->get();
        return view('singleProduct', [
            'subCat' => $subCat,
            'product' => $product,
            'other_products' => $other_products,

        ]);
    }


    public function getComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required',
        ]);
        if ($validator->fails() || Auth::guest() || !$request->prod) {
            return abort(404);
        }
        $product = Product::where('link', $request->prod)->firstOrFail();
        $review = Reviews::create([
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
            'text' => $request->comment,
            'published' => 0,
        ]);
        if ($review) {
            return response()->json(['success' => __('product.message_successful')]);
        }
    }

    public function pstFilterProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cat' => 'required',
        ]);
        if ($validator->fails()) {
            return abort(404);
        }
        $cat = SubCategory::where('code', $request->cat)->firstOrFail();
        if ($request->filter[0]) {
            $products = Product::where('parent_id', $cat->id)->where(function ($query) use ($request) {
                $query->whereHas('filters', function ($query) use ($request) {
                    $query->whereIn('filter_value', $request->filter);
                });
            })->orderBy('id', 'desc')->paginate(9);
        } else {
            $products = Product::where('parent_id', $cat->id)->orderBy('id', 'desc')->paginate(9);
        }
        if ($products->first()) {
            return View::make('includes.productList', [
                'products' => $products,
            ]);
        } else {
            $products = Product::where('parent_id', $cat->id)->inRandomOrder()->limit(3)->get();
            return View::make('includes.notProduct', [
                'products' => $products,
            ]);
        }

    }

    public function priceAjax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filter' => 'required',
            'filter.*' => 'required',
            'prod' => 'required',
        ]);
        if ($validator->fails()) {
            return abort(404);
        }
        $product = Product::where('code', $request->prod)->firstOrFail();
        $price = $product->price;
        $sale = $product->sale;
        foreach ($request->filter as $filter) {
            $prodFilter = $product->filters->where('filter_value', $filter)->first();
            if ($prodFilter->plusMinus == '+') {
                $price = $price + $prodFilter->price;
            } else {
                $price = $price - $prodFilter->price;
            }
        }
        if ($sale) {
            if ($sale < 100) {
                $sale1 = $price / 100;
                $sale = $sale1 * $sale;
                $price = $price - $sale;
            } else {
                $price = $sale;
            }
        }
        return response()->json(['price' => $price]);
    }

    public function add_to_cart(Request $request)
    {

        if (Auth::guest()){
            return abort(404);
        }
        $validator = Validator::make($request->all(), [
            'color' => 'max:7',
            'prod' => 'required',
            'qty' => 'required|integer|numeric|min:1',
            'filter.*' => 'required',
            'fl.*' => 'required',
            'name.*' => 'required',
        ]);
        if ($validator->fails()) {
            return abort(404);
        }
        $product = Product::where('code', $request->prod)->firstOrFail();
        $price = $product->price;
        $sale = $product->sale;
        if ($request->filter){
            foreach ($request->filter as $key => $filter) {
                if ($request->fl[$key] == 'sub') {
                    $control = FilterSub::where('code', $filter)->whereTranslationLike('name', $request->name[$key])->firstOrFail();
                    $control->filter->whereTranslationLike('name', $request->filter_name[$key])->firstOrFail();
                } elseif ($request->fl[$key] == 'val') {
                    $control = FilterValue::where('code', $filter)->whereTranslationLike('name', $request->name[$key])->firstOrFail();
                    $control->parent->filter->whereTranslationLike('name', $request->filter_name[$key])->firstOrFail();
                }
                $prodFilter = $product->filters->where('filter_value', $filter)->first();
                if ($prodFilter->plusMinus == '+') {
                    $price = $price + $prodFilter->price;
                } else {
                    $price = $price - $prodFilter->price;
                }
            }
        }

        if ($sale) {
            if ($sale < 100) {
                $sale1 = $price / 100;
                $sale = $sale1 * $sale;
                $price = $price - $sale;
            }
        }
        $color = $request->color;
        $a = Cart::instance(Auth::user()->name . '-' . Auth::user()->id)->add([
            'id' => $product->id,
            'name' => $product->translate(session('locale'))->name,
            'qty' => $request->qty,
            'price' => $price,
            'options' => [
                'user_id' => Auth::user()->id,
                'color' => $color,
                'filter_name' => $request->filter_name,
                'filter_value' => $request->name,
                'image_name' => $product->images->sortBy('id')->first()['image_name'],
            ]
        ]);
        $res = CartTable::create([
            'product_id' => $product->id,
            'user_id' => Auth::user()->id,
            'row_id' => $a->rowId,
            'qty' => $request->qty,
            'color' => $color,
            'product_name' => $product->translate(session('locale'))->name,
            'price' => $price,
            'image_name' => $product->images->sortBy('id')->first()['image_name'],
        ]);
        if ($res) {
            if (isset($request->name)) {
                foreach ($request->name as $key => $name) {
                    CartFilter::create([
                        'cart_id' => $res->id,
                        'filter_name' => $request->filter_name[$key],
                        'filter_value' => $request->name[$key],
                    ]);
                }
            }

        }
//        Cart::destroy();
        return View::make('includes.newCartItem');
    }

    public function cart_remove(Request $request)
    {
//        Cart::destroy();
        Cart::remove($request->order);
        $delete = CartTable::where('row_id', $request->order)->get();
        if ($delete->count() > 0) {
            foreach ($delete as $dll) {
                CartFilter::where('cart_id', $dll->id)->delete();
                $dll->delete();
            }

        }
        return View::make('includes.newCartItem');
    }


    public function sales(){
        $products = Product::where('sale', '>', 0)->paginate(12);
        return view('sales',[
            'products' => $products
        ]);
    }


    public function check_out(Request $request){

    }

}
