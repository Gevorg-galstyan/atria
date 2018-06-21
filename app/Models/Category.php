<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryTranslations;

class Category extends Model
{
    use \Dimsav\Translatable\Translatable;
//    use Translatable;

    public $translationModel = 'App\Models\CategoryTranslations';

    public $translatedAttributes = [
        'name',
    ];

    protected $fillable = [
        'code', 'link'
    ];

    public function subCategories(){
        return $this->hasMany('App\Models\SubCategory', 'category_id', 'id');
    }
}
