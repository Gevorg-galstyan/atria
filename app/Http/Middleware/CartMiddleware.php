<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Cart\CartTable;

class CartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if (!Auth::guest() && Auth::user()->email == '') {
            return redirect(route('enterEmail'));
        }
        if (!Auth::guest() && Cart::instance(Auth::user()->name . '-' . Auth::user()->id)->count() < 1) {
            $orders = CartTable::where('user_id', Auth::user()->id)->where('fulfilled', 0)->get();
            foreach ($orders as $order) {
                $a = Cart::instance(Auth::user()->name . '-' . Auth::user()->id)->add([
                    'id' => $order->product_id,
                    'name' => $order->product_name,
                    'qty' => $order->qty,
                    'price' => $order->price,
                    'options' => [
                        'user_id' => Auth::user()->id,
                        'color' => $order->color,
                        'filter_name' => $order->filters->pluck('filter_name'),
                        'filter_value' => $order->filters->pluck('filter_value'),
                        'image_name' => $order->image_name,
                    ]
                ]);
                $order->row_id = $a->rowId;
                $order->save();
            }

        }
        return $next($request);

    }
}
