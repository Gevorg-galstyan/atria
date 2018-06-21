<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About_faq extends Model
{
    protected $fillable = [
        'header', 'description', 'code',
    ];

    use \Dimsav\Translatable\Translatable;


    public $translationModel = 'App\Models\About_faq_translation';

    public $translatedAttributes = [
        'header', 'description'
    ];
}
