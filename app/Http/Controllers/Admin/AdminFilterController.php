<?php

namespace App\Http\Controllers\Admin;

use App\Models\CatFilter;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FilterCategory;
use Illuminate\Support\Facades\Validator;
use App\Models\FilterSub;
use App\Models\FilterValue;
use App\Models\ProFilter;

class AdminFilterController extends Controller
{
    public function index()
    {
        $filters = FilterCategory::get();
        return view('vendor.adminlte.filter', [
            'filters' => $filters
        ]);
    }

//    public function create(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'hy_name' => 'required|string',
//            'en_name' => 'required|string',
//            'ru_name' => 'required|string',
//        ]);
//        if ($validator->fails()) {
//            return back()->with('error', 'add')->withErrors($validator->errors())->withInput();
//        }
//
//        $res = FilterCategory::create([
//            'code' => time() . $request->en_name,
//            'hy' => [
//                'name' => $request->hy_name,
//            ],
//            'en' => [
//                'name' => $request->en_name,
//            ],
//            'ru' => [
//                'name' => $request->ru_name,
//            ]
//        ]);
//
//        $i = 0;
//        if ($request->hy_name_sub[0]) {
//
//            foreach ($request->hy_name_sub as $filterSub) {
//
//                $sub = FilterSub::create([
//                    'code' => time() . $request->en_name_sub[$i] . $res->id,
//                    'filter_id' => $res->id,
//                    'hy' => [
//                        'name' => $filterSub,
//                    ],
//                    'en' => [
//                        'name' => $request->en_name_sub[$i],
//                    ],
//                    'ru' => [
//                        'name' => $request->ru_name_sub[$i],
//                    ]
//                ]);
//
//                if (isset($request->hy_sub[$i])) {
//                    $j = 0;
//                    foreach ($request->hy_sub[$i] as $value) {
//                        FilterValue::create([
//                            'code' => time() . $request->en_sub[$i][$j],
//                            'parent_id' => $sub->id,
//                            'hy' => [
//                                'name' => $value,
//                            ],
//                            'en' => [
//                                'name' => $request->en_sub[$i][$j],
//                            ],
//                            'ru' => [
//                                'name' => $request->ru_sub[$i][$j],
//                            ]
//                        ]);
//                        $j++;
//                    }
//                }
//                $i++;
//            }
//        }
//
//        if ($res) {
//            return back()->with('newCat', $res->id);
//        }
//    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prod' => 'required',
            'key' => 'required'
        ]);
        if ($validator->fails()){
            return abort(404);
        }
        if ($request->key == 'filter'){
            $filter = FilterCategory::find($request->prod);
            $subs = FilterSub::where('filter_id', $filter->id)->get();
            foreach ($subs as $sub) {
                foreach ($sub->values as $value) {
                    $value->deleteTranslations();
                    ProFilter::where('filter_value', $value->code)->delete();
                    $value->delete();
                }
                $sub->deleteTranslations();
                CatFilter::where('sub_id', $sub->id)->delete();
                $sub->delete();
            }
            $filter->deleteTranslations();
            $filter->delete();
        }elseif ($request->key == 'sub'){
            $sub = FilterSub::find($request->prod);
                foreach ($sub->values as $value) {
                    $value->deleteTranslations();
                    ProFilter::where('filter_value', $value->code)->delete();
                    $value->delete();
                }
                $sub->deleteTranslations();
                CatFilter::where('sub_id', $sub->id)->delete();
                $sub->delete();

        }elseif ($request->key == 'value'){
            $value = FilterValue::find($request->prod);
            $value->deleteTranslations();
            ProFilter::where('filter_value', $value->code)->delete();
            $value->delete();
        }



        return 1;
    }
}
