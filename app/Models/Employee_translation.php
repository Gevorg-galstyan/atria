<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee_translation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'position', 'text'
    ];
}
