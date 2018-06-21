<a href="#" class="dropdown-toggle cart" data-toggle="dropdown" role="button"
   aria-expanded="false"><span class="countbadge hidden-xs">
        @if(Auth::guest())
            0
        @else
            {{Cart::instance(Auth::user()->name.'-'.Auth::user()->id)->content()->count()}}
        @endif
                                </span> <i
            class="fa fa-shopping-bag"></i></a>
@if(!Auth::guest() && Cart::instance(Auth::user()->name.'-'.Auth::user()->id))
    <ul class="dropdown-menu start-right" role="menu">
        <li class="shopcart" style='padding: 0 !important;'>

             <div class="cart-content">
                @php($i =0)
                @foreach(Cart::content() as $item)
                    <table data-target="dll_{{$i}}">
                        <tbody>
                        <tr class="row">
                            <td class=""><img
                                        src="{{asset('images/products/'.$item->options->image_name)}}"
                                        alt="">
                            </td>
                            <td class="col-md-7">
                                <h4><a href="#0">
                                        {{$item->name}}
                                    </a></h4>
                                <small> @lang('product.price') : {{$item->price}}AMD
                                </small>

                                <small> @lang('product.quanity') : {{$item->qty}}</small>

                               

                             
                            </td>
                            <td class="col-md-2">
                                <a href="{{route('cart_remove')}}" data-order="{{$item->rowId}}"
                                   data-status="dll_{{$i}}" class="closeme cart-remove"><i
                                            class="fa fa-close"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="clearfix"></div>
                    <hr>
                    @php($i++)
                @endforeach
            </div>

            <div class="text-center">
                <h3>@lang('product.subtotal')
                    : {{Cart::total()}}</h3>
                @if(Cart::instance(Auth::user()->name.'-'.Auth::user()->id)->count() >0)
                    <form action="{{route('check_out')}}" method="post">
                        {{csrf_field()}}
                        <button type="submit"
                                class="btn btn-primary">
                            @lang('product.checkout')
                        </button>
                    </form>

                @endif
            </div>

        </li>
    </ul>
@endif