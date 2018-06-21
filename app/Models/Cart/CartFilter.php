<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Model;

class CartFilter extends Model
{
    protected $fillable = [
        'cart_id', 'filter_name', 'filter_value',
    ];
}
