<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterSub extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translationModel = 'App\Models\FilterSubTranslations';

    public $translatedAttributes = [
        'name',
    ];

    protected $fillable = [
        'code', 'filter_id',
    ];

    public function filter(){
        return $this->belongsTo('App\Models\FilterCategory', 'filter_id', 'id');
    }

    public function values(){
        return $this->hasMany('App\Models\FilterValue', 'parent_id', 'id');
    }

    public function catFilter(){
        return $this->hasMany('App\Models\CatFilter', 'sub_id', 'id');
    }
}
