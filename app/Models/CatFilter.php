<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatFilter extends Model
{
    protected $fillable = [
        'cat_id', 'sub_id',
    ];

    public function subs(){
        return $this->belongsTo('App\Models\FilterSub', 'sub_id', 'id');
    }

//    public function values(){
//        return $this->belongsTo('App\Models\FilterValue', 'val_id', 'id');
//    }

    public function cat(){
        return $this->belongsTo('App\Models\SubCategory', 'cat_id', 'id');
    }
}
