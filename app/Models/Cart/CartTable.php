<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Model;

class CartTable extends Model
{
    protected $fillable = [
        'product_id', 'user_id','row_id','color','product_name','qty','price', 'image_name',
    ];

    public function filters(){
        return $this->hasMany('App\Models\Cart\CartFilter', 'cart_id', 'id');
    }
}
