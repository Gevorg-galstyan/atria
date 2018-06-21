<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translationModel = 'App\Models\ProductTranslations';

    public $translatedAttributes = [
        'name', 'description',
    ];

    protected $fillable = [
        'code', 'parent_id', 'sale', 'link','price',
    ];

    public function colors(){
        return $this->hasMany('App\Models\Color', 'product_id', 'id');
    }
    public function images(){
        return $this->hasMany('App\Models\Image', 'product_id', 'id');
    }
    public function filters(){
        return $this->hasMany('App\Models\ProFilter', 'prod_id', 'id');
    }
    public function parent(){
        return $this->belongsTo('App\Models\SubCategory', 'parent_id', 'id');
    }
    public function reviews(){
        return $this->hasMany('App\Models\Reviews', 'product_id', 'id');
    }
}



