@extends('layouts.app')

@section('content')
    <div class="first-slider">
        <div id="rev_slider_56_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container"
             data-alias="sports-hero54"
             style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
            <div id="rev_slider_56_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.0.7">
                <ul data-target="home_image"
                    data-prod="{{$homeImage->code}}"
                    data-href_update="{{route('updateHomeImage')}}">

                    <li data-index="rs-214" data-transition="fade" data-slotamount="7" data-easein="default"
                        data-easeout="default" data-masterspeed="300" data-rotate="0" data-saveperformance="off"
                        data-title="Slide" data-description="">

                        <img src="{{asset('upload/'.$homeImage->image_name)}}" alt="{{config('app.name')}}" data-bgposition="center center"
                             data-bgfit="cover"
                             data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>


                        <div class="tp-caption Sports-Display   tp-resizeme rs-parallaxlevel-0"
                             id="slide-214-layer-1"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['-180','-170','-190','-140']"
                             data-fontsize="['120','120','120','100']"
                             data-lineheight="['130','130','130','100']"
                             data-width="none"
                             data-height="none"
                             data-whitespace="nowrap"
                             data-transform_idle="o:1;"
                             data-transform_in="z:0;rX:0deg;rY:0;rZ:0;sX:1.5;sY:1.5;skX:0;skY:0;opacity:0;s:2000;e:Power3.easeInOut;"
                             data-transform_out="y:[100%];s:1000;s:1000;"
                             data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                             data-start="750"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"
                             style="z-index: 5; white-space: nowrap;">{{$homeImage->translate(session('locale'))->text_1}}
                        </div>

                        <!--<div class="tp-caption Sports-DisplayFat   tp-resizeme rs-parallaxlevel-0"-->
                        <!--     id="slide-214-layer-2"-->
                        <!--     data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"-->
                        <!--     data-y="['middle','middle','middle','middle']" data-voffset="['-48','-48','-68','-48']"-->
                        <!--     data-fontsize="['133','133','133','100']"-->
                        <!--     data-lineheight="['130','130','130','100']"-->
                        <!--     data-width="none"-->
                        <!--     data-height="none"-->
                        <!--     data-whitespace="nowrap"-->
                        <!--     data-transform_idle="o:1;"-->
                        <!--     data-transform_in="z:0;rX:0deg;rY:0;rZ:0;sX:1.5;sY:1.5;skX:0;skY:0;opacity:0;s:2000;e:Power3.easeInOut;"-->
                        <!--     data-transform_out="y:[100%];s:1000;s:1000;"-->
                        <!--     data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"-->
                        <!--     data-start="1000"-->
                        <!--     data-splitin="none"-->
                        <!--     data-splitout="none"-->
                        <!--     data-responsive_offset="on"-->
                        <!--     style="z-index: 6; white-space: nowrap;">{{$homeImage->translate(session('locale'))->text_2}}-->
                        <!--</div>-->

                        <div class="tp-caption Sports-Subline   tp-resizeme rs-parallaxlevel-0"
                             id="slide-214-layer-4"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['-71','71','51','41']"
                             data-fontsize="['30','30','30','25']"
                             data-lineheight="['10','30','30','25']"
                             data-width="none"
                             data-height="none"
                             data-whitespace="nowrap"
                             data-transform_idle="o:1;"
                             data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.8;sY:0.8;skX:0;skY:0;opacity:0;s:1500;e:Power4.easeOut;"
                             data-transform_out="y:[100%];s:1000;s:1000;"
                             data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                             data-start="1500"
                             data-splitin="chars"
                             data-splitout="none"
                             data-responsive_offset="on"
                             data-elementdelay="0.05"
                             style="z-index: 8; white-space: nowrap; background-color: #ffffff; margin:0; padding:20px 0 0 0; text-align:center; font-size: 30px;">
                            {{$homeImage->translate(session('locale'))->text_3}}
                        </div>

                    </li>
                </ul>
                <div class="tp-static-layers"></div>
                <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
            </div>
        </div><!-- END REVOLUTION SLIDER -->
    </div><!-- end first slider -->

    <div class="top_content">
        <section class="section">
            <div class="container">
                <div class="section-title text-center clearfix">
                    <h4>
                        @lang('index.top_categories')
                    </h4>
                    <!--<p>Listed below our top categories, campaings, promotions and offers for you!</p>-->
                    <hr>
                </div><!-- end title -->

                <div class="banner-masonry row">
                    @php($i = 1)
                    @foreach($topCategories->sortBy('top') as $topCategory)
                        <div class="banner-item item-w1 item-h1">
                            <a href="{{route('getCategory', ['cat' => $topCategory->link])}}">
                                <img src="{{asset('images/subCategory/'.$topCategory->image_name)}}"
                                     alt="{{$topCategory->translate('en')->name}}"
                                     class="img-responsive"></a>
                            <div class="banner-button">
                                <a href="{{route('getCategory', ['cat' => $topCategory->link])}}"
                                   class="button button--aylen btn">
                                    {{$topCategory->translate(session('locale'))->name}}
                                </a>
                            </div>
                        </div><!-- end banner-item -->
                        @php($i++)
                    @endforeach
                </div>
            </div><!-- end container -->
        </section><!-- end section -->
    </div><!-- end banner -->

    <section class="section lb nopadbot">
        <div class="container-fluid">
            <div class="section-title text-center clearfix">
                <h4>
                    @lang('index.our_products')
                </h4>
                <!--<p>Listed below our awesome products with a stylish portfolio section!</p>-->
                <hr>
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-12">
                    <nav class="portfolio-filter text-center">
                        <ul class="list-inline">
                            <li>
                                <a class="button button--aylen btn" href="#" data-filter="*">
                                    @lang('index.all')
                                </a>
                            </li>

                            @foreach($categories as $category)
                                <li>
                                    <a class="button button--aylen btn" href="#" data-filter=".{{$category->link}}">
                                        {{$category->translate(session('locale'))->name}}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </nav>
                </div>
            </div>


            <div id="da-thumbs" class="da-thumbs">
                @foreach($categories as $category)
                    @if(count($category->subCategories) >= 2)
                        @foreach($category->subCategories->random(2) as $subCategory)
                            @if(count($subCategory->products) >= 2)
                                @foreach($subCategory->products->random(2) as $product)
                                    <div class="pentry item-w1 item-h1 {{$category->link}}">
                                        <a href="{{route('getProduct',[
                                                'cat' => $product->parent->link,
                                                'prod' => $product->link
                                                ])}}" title=$product">
                                            <img src="{{asset('images/products/'.$product->images->sortBy('id')->first()['image_name'])}}"
                                                 alt={{$product->translate('en')->name}}"" class="img-responsive">
                                            <div>
                                                <span>@lang('product.more')</span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                @foreach($subCategory->products as $product)
                                    <div class="pentry item-w1 item-h1 {{$category->link}}">
                                        <a href="{{route('getProduct',[
                                                'cat' => $product->parent->link,
                                                'prod' => $product->link
                                                ])}}" title="">
                                            <img src="{{asset('images/products/'.$product->images->sortBy('id')->first()['image_name'])}}"
                                                 alt="{{$product->translate('en')->name}}" class="img-responsive">
                                            <div><span>@lang('product.more')</span></div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @else
                        @foreach($category->subCategories as $subCategory)
                            @if(count($subCategory->products) >= 2)
                                @foreach($subCategory->products->random(2) as $product)
                                    <div class="pentry item-w1 item-h1 {{$category->link}}">
                                        <a href="{{route('getProduct',[
                                                'cat' => $product->parent->link,
                                                'prod' => $product->link
                                                ])}}" title="">
                                            <img src="{{asset('images/products/'.$product->images->sortBy('id')->first()['image_name'])}}"
                                                 alt="{{$product->translate('en')->name}}" class="img-responsive">
                                            <div><span>@lang('product.more')</span></div>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                @foreach($subCategory->products as $product)
                                    <div class="pentry item-w1 item-h1 {{$category->link}}">
                                        <a href="{{route('getProduct',[
                                                'cat' => $product->parent->link,
                                                'prod' => $product->link
                                                ])}}" title="">
                                            <img src="{{asset('images/products/'.$product->images->sortBy('id')->first()['image_name'])}}"
                                                 alt="{{$product->translate('en')->name}}" class="img-responsive">
                                            <div><span>@lang('product.more')</span></div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach


            </div><!-- end div -->
        </div><!-- end container-fluid -->
    </section><!-- end section -->

    <section class="section">
        <div class="container">
            <div class="section-title text-center clearfix">
                <h4>
                    @lang('index.discounts')
                </h4>
                <!--<p>We showcase all our premium quality home decoration materials and furniture's!</p>-->
                <hr>
            </div><!-- end title -->

            <div class="row">
                <div class='regular_2'>
                @foreach($sliders->where('slider_sale', 'sale') as $prod)
                   
                        <div class="shop-item ">
                            <div class="shop-thumbnail">
                                <a href="{{route('getProduct',[
                                                'cat' => $prod->parent->link,
                                                'prod' => $prod->link
                                                ])}}" class="link_img">
                                    <img src="{{asset('images/products/'.$prod->images->sortBy('id')->first()['image_name'])}}"
                                         alt="{{$prod->translate('en')->name}}" class="img-responsive">
                                </a>
                            </div><!-- end shop-thumbnail -->
                            <div class="shop-desc">
                                <h3>
                                    <a href="{{route('getProduct',[
                                                'cat' => $prod->parent->link,
                                                'prod' => $prod->link
                                                ])}}"
                                       title="">{{$prod->translate(session('locale'))->name}}
                                    </a>
                                </h3>
                                <div>
                                    @include('includes.pricing', ['prod' => $prod])

                                </div>

                            </div><!-- end shop-desc -->

                            <div class="shop-meta clearfix">
                                <ul class="">
                                    <li>
                                        <a href="{{route('getProduct',[
                                                'cat' => $prod->parent->link,
                                                'prod' => $prod->link
                                                ])}}"><i class="fa fa-shopping-bag"
                                                         aria-hidden="true"> </i>
                                            @lang('product.add_cart')
                                        </a>
                                    </li>
                                </ul><!-- end list -->
                            </div><!-- end shop-meta -->
                        </div><!-- end shop-item -->
                    
                @endforeach
</div>
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end section -->


    <section class="section">
        <div class="container">
            <div class="section-title text-center clearfix">
                <h4>
                    @lang('index.newstellers')
                </h4>
                <!--<p>Donec vitae sapien ut libero venenatis faucibus.</p>-->
                <hr>
            </div><!-- end title -->

            <div class="row module-wrapper text-center"> 
           
            <div class='regular'>
                @foreach($sliders->where('slider_new', 'new') as $prod)
                   
                       
                      
                           <div class="shop-item ">
                                <span class="new_styker">@lang('product.new')</span>
                            <div class="shop-thumbnail">
                                <a href="{{route('getProduct',[
                                                'cat' => $prod->parent->link,
                                                'prod' => $prod->link
                                                ])}}" class="link_img">
                                    <img src="{{asset('images/products/'.$prod->images->sortBy('id')->first()['image_name'])}}"
                                         alt="{{$prod->translate('en')->name}}" class="img-responsive">
                                </a>
                            </div><!-- end shop-thumbnail -->
                            <div class="shop-desc">
                                <h3>
                                    <a href="{{route('getProduct',[
                                                'cat' => $prod->parent->link,
                                                'prod' => $prod->link
                                                ])}}" title="">
                                        {{$prod->translate(session('locale'))->name}}
                                    </a>
                                </h3>
                                <div>
                                    @include('includes.pricing', ['prod' => $prod])
                                </div>
                            </div><!-- end shop-desc -->
                            <div class="shop-meta clearfix">
                                <ul class="">
                                    <li>
                                        <a href="{{route('getProduct',[
                                                'cat' => $prod->parent->link,
                                                'prod' => $prod->link
                                                ])}}">
                                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                            @lang('product.add_cart')
                                        </a>
                                    </li>
                                </ul><!-- end list -->
                            </div><!-- end shop-meta -->
                        </div><!-- end shop-item -->
                      
                      
                       
                        
                        
                @endforeach
                </div>
            </div><!-- row -->

        </div><!-- end container -->
    </section><!-- end section -->
    <!--<section class="section">-->
    <!--    <div class="container">-->
    <!--        <div class="section-title text-center clearfix">-->
    <!--            <h4>-->
    <!--                @lang('index.we_love_our_suppliers')-->
    <!--            </h4>-->
                <!--<p>Special thanks for all our suppliers to build awesome community!</p>-->
    <!--            <hr>-->
    <!--        </div><!-- end title -->

    <!--        <div id="owl-client" class="clients">-->
    <!--            <div class="client-logo GrayScale">-->
    <!--                <a href="#"><img src="{{asset('upload/client_01.png')}}" alt="" class="img-responsive"></a>-->
    <!--            </div><!-- end logo -->

    <!--            <div class="client-logo GrayScale">-->
    <!--                <a href="#"><img src="{{asset('upload/client_02.png')}}" alt="" class="img-responsive"></a>-->
    <!--            </div><!-- end logo -->

    <!--            <div class="client-logo GrayScale">-->
    <!--                <a href="#"><img src="{{asset('upload/client_03.png')}}" alt="" class="img-responsive"></a>-->
    <!--            </div><!-- end logo -->

    <!--            <div class="client-logo GrayScale">-->
    <!--                <a href="#"><img src="{{asset('upload/client_04.png')}}" alt="" class="img-responsive"></a>-->
    <!--            </div><!-- end logo -->

    <!--            <div class="client-logo GrayScale">-->
    <!--                <a href="#"><img src="{{asset('upload/client_05.png')}}" alt="" class="img-responsive"></a>-->
    <!--            </div><!-- end logo -->
    <!--        </div><!-- end row -->

    <!--    </div><!-- end container -->
    <!--</section><!-- end section -->
@endsection
