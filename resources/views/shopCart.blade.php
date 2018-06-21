@if(!Auth::guest() && Cart::instance(Auth::user()->name.'-'.Auth::user()->id))

    @foreach(Cart::instance(Auth::user()->name.'-'.Auth::user()->id) as $item)
        <table>
            <tbody>
            <tr class="row">
                <td class="col-md-3"><img src="{{asset('images/products/'.$item->options->image_name)}}" alt="">
                </td>
                <td class="col-md-7">
                    <h4>{{$item->name}}</h4>

                    <small> @lang('product.price') : {{$item->price}} AMD</small>

                    <small> @lang('product.quanity') : 1</small>

                    <small> Color
                        <button style="background: {{$color->color}};"
                                class=" cart-color btn-default"
                                data-value="{{$color->color}}">
                            <i class="fa fa-square" style="color: {{$color->color}};"></i>
                        </button>
                    </small>
                </td>
                <td class="col-md-2"><a href="#" class="closeme"><i class="fa fa-close"></i></a>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="clearfix"></div>
    @endforeach
    <div class="text-center">
        <h3>@lang('product.subtotal') : Cart::instance(Auth::user()->name.'-'.Auth::user()->id)->subtotal()</h3>
        <a href="shop-checkout.html" class="btn btn-primary">@lang('product.checkout')</a>
    </div>
@endif