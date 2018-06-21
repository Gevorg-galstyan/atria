<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use App\Models\CatFilter;
use App\Models\FilterCategory;
use App\Models\FilterSub;
use App\Models\FilterValue;
use App\Models\ProFilter;
use App\Models\Cart\CartTable;
use App\Models\Cart\CartFilter;

class AdminSubCategoryController extends Controller
{
    public function index(Request $request)
    {
        $cat = Category::wheer('link', $request->cet)->firstOrFail();
        return view('vendor.adminlte.categories', [
            'cat' => $cat,
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hy_name' => 'required|string',
            'en_name' => 'required|string',
            'ru_name' => 'required|string',
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'add')->withErrors($validator->errors())->withInput();
        }

        $cat = Category::where('link', $request->cat)->firstOrFail();
        $link = mb_strtolower($request->en_name);
        $link = str_replace(' ', '-', $link);

        while (true) {

            $a['link'] = $link;
            $validator = Validator::make($a, [
                'link' => 'required|unique:sub_categories'
            ]);
            if ($validator->fails()) {
                $link = $link . rand(0, 99);
                break;
            } else {
                break;
            }
        }


        $imageName = null;
        $imageNamegeneral = null;


        if ($request->image) {
            $data = $_POST['image'];
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);

            $data = base64_decode($data);
            $imageName = time() . '.jpg';
            file_put_contents('images/subCategory/' . $imageName, $data);
        }


        if ($request->imageGeneral) {
            $data = $_POST['imageGeneral'];
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);

            $data = base64_decode($data);
            $imageNamegeneral = '1' . time() . '.jpg';
            file_put_contents('images/subCategory/' . $imageNamegeneral, $data);
        }


        $newCat = SubCategory::create([
            'code' => time() . $request->en_name,
            'image_name' => $imageName,
            'general_image' => $imageNamegeneral,
            'category_id' => $cat->id,
            'link' => $link,
            'hy' => [
                'name' => $request->hy_name,
            ],
            'en' => [
                'name' => $request->en_name,
            ],
            'ru' => [
                'name' => $request->ru_name,
            ]
        ]);


        if ($request->hy_name_filter) {
            $fl = 1;
            foreach ($request->hy_name_filter as $key => $val) {
                $res = FilterCategory::create([
                    'code' => $fl . time() . $request->en_name_filter[$key],
                    'cat_id' => $newCat->id,
                    'hy' => [
                        'name' => $val,
                    ],
                    'en' => [
                        'name' => $request->en_name_filter[$key],
                    ],
                    'ru' => [
                        'name' => $request->ru_name_filter[$key],
                    ]
                ]);
                $i = 0;
                if ($request->hy_name_sub[$key]) {

                    foreach ($request->hy_name_sub[$key] as $subKey => $subVal) {

                        $sub = FilterSub::create([
                            'code' => $i . time() . $request->en_name_sub[$key][$subKey] . $res->id,
                            'filter_id' => $res->id,
                            'hy' => [
                                'name' => $subVal,
                            ],
                            'en' => [
                                'name' => $request->en_name_sub[$key][$subKey],
                            ],
                            'ru' => [
                                'name' => $request->ru_name_sub[$key][$subKey],
                            ]
                        ]);

                        if (isset($request->hy_sub[$key][$subKey])) {
                            $j = 0;
                            foreach ($request->hy_sub[$key][$subKey] as $valKey => $valVal) {
                                FilterValue::create([
                                    'code' => time() . $request->en_sub[$key][$subKey][$valKey] . $sub->id,
                                    'parent_id' => $sub->id,
                                    'hy' => [
                                        'name' => $valVal,
                                    ],
                                    'en' => [
                                        'name' => $request->en_sub[$key][$subKey][$valKey],
                                    ],
                                    'ru' => [
                                        'name' => $request->ru_sub[$key][$subKey][$valKey],
                                    ]
                                ]);
                                $j++;
                            }
                        }
                        $i++;
                    }
                    $fl++;
                }


            }

        }


        if ($newCat) {
            return back()->with('newCat', $newCat->id);
        }
    }

    public function update(Request $request)
    {


        $this->validate($request, [
            'prod' => 'required',
        ]);

        $cat = SubCategory::where('link', $request->prod)->firstOrFail();
        $filters = FilterCategory::where('cat_id', $cat->id)->orderBy('id')->get();

        if ($request->key && $request->key == 'one') {
            return View::make('vendor.adminlte.updatePage.updateSubCat', [
                'product' => $cat,
                'filters' => $filters,
            ]);
        }

//        dd($request->all());
        if ($request->image) {
            $data = $_POST['image'];
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);

            $data = base64_decode($data);
            $imageName = time() . '.jpg';
            file_put_contents('images/subCategory/' . $imageName, $data);
            if (file_exists(public_path() . '/images/subCategory/' . $cat->image_name)) {
                File::delete(public_path() . '/images/subCategory/' . $cat->image_name);
            }
        } else {
            $imageName = $cat->image_name;
        }

        if ($request->imageGeneral) {
            $data = $_POST['imageGeneral'];
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);

            $data = base64_decode($data);
            $imageNamegeneral = '1' . time() . '.jpg';
            file_put_contents('images/subCategory/' . $imageNamegeneral, $data);
            if (file_exists(public_path() . '/images/subCategory/' . $cat->general_image)) {
                File::delete(public_path() . '/images/subCategory/' . $cat->general_image);
            }
        } else {
            $imageNamegeneral = $cat->general_image;
        }
        $validator = Validator::make($request->all(), [
            'hy_name' => 'required|string',
            'en_name' => 'required|string',
            'ru_name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $cat->image_name = $imageName;
        $cat->general_image = $imageNamegeneral;
        $cat->translate('hy')->name = $request->hy_name;
        $cat->translate('en')->name = $request->en_name;
        $cat->translate('ru')->name = $request->ru_name;
        $cat->save();


        if (isset($request->hy_name_filter_old) && $filters->first()) {

            foreach ($filters->sortByDesc('id') as $key => $val) {
                $val->translate('hy')->name = $request->hy_name_filter_old[$key];
                $val->translate('en')->name = $request->en_name_filter_old[$key];
                $val->translate('ru')->name = $request->ru_name_filter_old[$key];
                $val->save();

                if (isset($request->hy_name_sub_old[$key]) && $val->subs[$key]) {
                    $i = $val->subs->count();

                    foreach ($val->subs->sortByDesc('id') as $subKey => $subVal) {

                        $subVal->translate('hy')->name = $request->hy_name_sub_old[$key][$i - 1];
                        $subVal->translate('en')->name = $request->en_name_sub_old[$key][$i - 1];
                        $subVal->translate('ru')->name = $request->ru_name_sub_old[$key][$i - 1];
                        $subVal->save();
                        if (isset($request->hy_sub_old[$key][$i - 1])) {
                            $j = $subVal->values->count();
                            foreach ($subVal->values->sortByDesc('id') as $valKey => $valVal) {
                                $valVal->translate('hy')->name = $request->hy_sub_old[$key][$i - 1][$j - 1];
                                $valVal->translate('en')->name = $request->en_sub_old[$key][$i - 1][$j - 1];
                                $valVal->translate('ru')->name = $request->ru_sub_old[$key][$i - 1][$j - 1];
                                $valVal->save();
                                $j--;

                            }
                        }
                        if (isset($request->hy_sub[$key][$i - 1])) {
                            $jNewI = 0;
                            foreach ($request->hy_sub[$key][$i - 1] as $valKeyNew => $valValNew) {

                                FilterValue::create([
                                    'code' => $jNewI . time() . $request->en_sub[$key][$i - 1][$valKeyNew] . $subVal->id,
                                    'parent_id' => $subVal->id,
                                    'hy' => [
                                        'name' => $request->hy_sub[$key][$i - 1][$valKeyNew],
                                    ],
                                    'en' => [
                                        'name' => $request->en_sub[$key][$i - 1][$valKeyNew],
                                    ],
                                    'ru' => [
                                        'name' => $request->ru_sub[$key][$i - 1][$valKeyNew],
                                    ]
                                ]);
                                $jNewI++;
                            }
                        }

                        $i--;

                    }


                }

                if (isset($request->hy_name_sub[$key])) {
                    $iNew = 0;
                    foreach ($request->hy_name_sub[$key] as $subKeyNew => $subValNew) {
                        $sub = FilterSub::create([
                            'code' => time() . $iNew . $request->en_name_sub[$key][$subKeyNew] . $subVal->id,
                            'filter_id' => $val->id,
                            'hy' => [
                                'name' => $request->hy_name_sub[$key][$subKeyNew],
                            ],
                            'en' => [
                                'name' => $request->en_name_sub[$key][$subKeyNew],
                            ],
                            'ru' => [
                                'name' => $request->ru_name_sub[$key][$subKeyNew],
                            ]
                        ]);

                        if (isset($request->hy_sub[$key][$subKeyNew])) {
                            $jNew = 0;
                            foreach ($request->hy_sub[$key][$subKeyNew] as $valKeyNew => $valValNew) {
                                FilterValue::create([
                                    'code' => $jNew . time() . $request->en_sub[$key][$subKeyNew][$valKeyNew] . $sub->id,
                                    'parent_id' => $sub->id,
                                    'hy' => [
                                        'name' => $request->hy_sub[$key][$subKeyNew][$valKeyNew],
                                    ],
                                    'en' => [
                                        'name' => $request->en_sub[$key][$subKeyNew][$valKeyNew],
                                    ],
                                    'ru' => [
                                        'name' => $request->ru_sub[$key][$subKeyNew][$valKeyNew],
                                    ]
                                ]);
                                $jNew++;
                            }
                        }

                        $iNew++;
                    }

                }
            }
        }

        if (isset($request->hy_name_filter)) {
            $fl = 1;
            foreach ($request->hy_name_filter as $key => $val) {
                $res = FilterCategory::create([
                    'code' => $fl . time() . $request->en_name_filter[$key],
                    'cat_id' => $cat->id,
                    'hy' => [
                        'name' => $val,
                    ],
                    'en' => [
                        'name' => $request->en_name_filter[$key],
                    ],
                    'ru' => [
                        'name' => $request->ru_name_filter[$key],
                    ]
                ]);
                $i = 0;
                if (isset($request->hy_name_sub[$key])) {

                    foreach ($request->hy_name_sub[$key] as $subKey => $subVal) {

                        $sub = FilterSub::create([
                            'code' => $i.time() . $request->en_name_sub[$key][$subKey] . $res->id,
                            'filter_id' => $res->id,
                            'hy' => [
                                'name' => $request->hy_name_sub[$key][$subKey],
                            ],
                            'en' => [
                                'name' => $request->en_name_sub[$key][$subKey],
                            ],
                            'ru' => [
                                'name' => $request->ru_name_sub[$key][$subKey],
                            ]
                        ]);

                        if (isset($request->hy_sub[$key][$subKey])) {
                            $j = 0;
                            foreach ($request->hy_sub[$key][$subKey] as $valKey => $valVal) {
                                FilterValue::create([
                                    'code' => $j.time() . $request->en_sub[$key][$subKey][$valKey] . $sub->id,
                                    'parent_id' => $sub->id,
                                    'hy' => [
                                        'name' => $request->hy_sub[$key][$subKey][$valKey],
                                    ],
                                    'en' => [
                                        'name' => $request->en_sub[$key][$subKey][$valKey],
                                    ],
                                    'ru' => [
                                        'name' => $request->ru_sub[$key][$subKey][$valKey],
                                    ]
                                ]);
                                $j++;
                            }
                        }
                        $i++;

                    }

                }
                $fl++;

            }

        }
        if ($cat) {
            return back()->with([
                'success' => 'Category Updated',
                'newCat' => $cat->id,
            ]);
        }
    }


    public function delete(Request $request)
    {

        $cat = SubCategory::where('link', $request->prod)->firstOrFail();
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
        return 1;

    }

    public function addTopCategory(Request $request)
    {
        if ($request->key == 'add') {
            $res = SubCategory::where('top', '>', 0)->count();
            $cat = SubCategory::where('id', $request->cat)->update([
                'top' => $res + 1,
            ]);
            if ($cat) {
                return 1;
            }
        } elseif ($request->key == 'edit') {
            $oldCAt = SubCategory::where('id', $request->oldCat)->update([
                'top' => 0,
            ]);
            $new = SubCategory::where('id', $request->newCat)->update([
                'top' => $request->number,
            ]);
            if ($new) {
                return 1;
            }
        }
    }
}

