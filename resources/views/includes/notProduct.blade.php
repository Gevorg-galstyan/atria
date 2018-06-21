<div class="title-area">
    <h2>
        <small>We couldn't find anything..</small>
    </h2>
    <h4 class="heading_margin">See also..</h4>
</div>

{{--<div class="row search_text">--}}
{{----}}
{{--</div>--}}

<div class="row">
    @foreach($products as $product)
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="shop-item text-center">
                <div class="shop-thumbnail">
                    <a href="{{route('getProduct',[
                                                'cat' => $product->parent->link,
                                                'prod' => $product->link
                                                ])}}" class="link_img">
                        <img class="img-responsive"
                             src="{{asset('images/products/'.$product
                                                         ->images
                                                         ->sortBy('id')
                                                         ->first()['image_name'])}}"/>
                    </a>

                </div>
                <div class="shop-desc">
                    <h3>
                        <a href="{{route('getProduct',[
                                                'cat' => $product->parent->link,
                                                'prod' => $product->link
                                                ])}}">
                            {{$product->translate(session('locale'))->name}}
                        </a>
                    </h3>
                    <div>
                        @include('includes.pricing',['prod' => $product])
                    </div>

                </div>

                <div class="shop-meta clearfix">
                    <ul class="">
                        <li>
                            <a href="{{route('getProduct',[
                                                        'cat' => $product->parent->link,
                                                        'prod' => $product->link
                                                        ])}}"
                               class='heart'>
                                <i class="fa fa-shopping-bag"></i>
                                @lang('product.add_cart')
                            </a>
                        </li>
                    </ul><!-- end list -->
                </div><!-- end shop-meta -->
            </div><!-- end shop-item -->

        </div>
    @endforeach
</div>