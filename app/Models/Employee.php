<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use \Dimsav\Translatable\Translatable;
//    use Translatable;

    public $translationModel = 'App\Models\Employee_translation';

    public $translatedAttributes = [
        'name', 'position', 'text'
    ];

    protected $fillable = [
        'image', 'name', 'position', 'text', 'code'
    ];

    public function employee_social(){
        return $this->hasOne('App\Models\Employee_site', 'employee_id', 'id');
    }
}
