<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About_faq_translation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'description', 'header',
    ];
}
