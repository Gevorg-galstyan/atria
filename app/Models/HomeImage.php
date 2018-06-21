<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeImage extends Model
{
    use \Dimsav\Translatable\Translatable;


    public $translationModel = 'App\Models\HomeImageTranslations';

    public $translatedAttributes = [
        'text_1', 'text_2', 'text_3',
    ];

    protected $fillable = [
        'code', 'image_name',
    ];
}
