<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About_text extends Model
{
    use \Dimsav\Translatable\Translatable;
//    use Translatable;

    public $translationModel = 'App\Models\AboutTextTranslation';

    public $translatedAttributes = [
        'header', 'description',
    ];

    protected $fillable = [
        'header', 'description',
    ];


}
