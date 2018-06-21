<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterValue extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translationModel = 'App\Models\FilterValueTranslations';

    public $translatedAttributes = [
        'name',
    ];

    protected $fillable = [
        'code', 'parent_id',
    ];

    public function parent(){
        return $this->belongsTo('App\Models\FilterSub', 'parent_id', 'id');
    }
//    public function catFilter(){
//        return $this->hasMany('App\Models\CatFilter', 'val_id', 'id');
//    }

}
