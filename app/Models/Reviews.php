<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'text', 'published', 'new'
    ];

    public function product(){
        return $this->belongsTo('App\models\Product', 'product_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
