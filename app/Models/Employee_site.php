<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee_site extends Model
{
    protected $fillable = [
        'employee_id', 'facebook', 'google', 'twitter', 'linkedin', 'vimeo', 'skype', 'youtube', 'instagram',
    ];
}
