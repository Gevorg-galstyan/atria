<div class="shop-list">
    @foreach($products->chunk(3) as $chunk)
        <div class="row">
            @foreach($chunk as $product)
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
    @endforeach



</div><!-- end row -->

<div class="row">
    <div class="col-md-12">
        <nav class="text-center">
            {{$products->links()}}
        </nav>
    </div>
</div>



