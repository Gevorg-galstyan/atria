<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About_sld extends Model
{
    protected $fillable = [
        'image', 'code',
    ];

    use \Dimsav\Translatable\Translatable;


    public $translationModel = 'App\Models\About_sld_translation';

    public $translatedAttributes = [
        'text',
    ];
}
