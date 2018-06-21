<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeImageTranslations extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'text_1', 'text_2', 'text_3',
    ];
}
