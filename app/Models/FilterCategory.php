<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterCategory extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translationModel = 'App\Models\FilterCategoryTranslations';

    public $translatedAttributes = [
        'name',
    ];

    protected $fillable = [
        'code','cat_id',
    ];

    public function subs(){
        return $this->hasMany('App\Models\FilterSub', 'filter_id', 'id');
    }
//    public function filters(){
//        return $this->hasMany('App\Models\CatFilter', 'filter_id', 'id');
//    }
}
