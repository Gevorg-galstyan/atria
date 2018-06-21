@extends('layouts.app')

@section('head')
    @parent
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/prettyPhoto.css')}}">
@endsection
@section('content')
    <div class="page-title lb">
        <div class="container clearfix">
            <div class="title-area pull-left">
                <h2>{{$product->translate(session('locale'))->name}}
                    <small>@lang('index.atria')</small>
                </h2>
            </div><!-- /.pull-right -->
            <div class="pull-right hidden-xs">
                <div class="bread">
                    <ol class="breadcrumb">
                        <li><a href="{{route('home')}}">@lang('header.home')</a></li>
                        <li><a href="{{route('getCategory',['cat' => $product->parent->link])}}">
                                {{$product->parent->translate(session('locale'))->name}}
                            </a>
                        </li>
                        <li class="active">
                            {{$product->translate(session('locale'))->name}}
                        </li>
                    </ol>
                </div><!-- end bread -->
            </div><!-- /.pull-right -->
        </div>
    </div><!-- end page-title -->

    <section class="section single-white-shop">
        <div class="container">
            <div class="row">
                <div id="content" class="col-md-9 col-sm-12 single-blog">
                    <div class="row">
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <div class="regular_3">
                                 @foreach($product->images as $image)
                                    <div>
                                        <img class="img-responsive" src="{{asset('images/products/'.$image->image_name)}}" alt=""/>
                                    </div>
                                @endforeach
                               
                            </div>
                             <div class="regular_3_nav">
                                    @foreach($product->images as $image)
                                        <div>
                                            <img class="img-responsive" src="{{asset('images/products/'.$image->image_name)}}" alt=""/>
                                        </div>
                                    @endforeach

                                </div>
                        </div><!-- end col -->
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <div class="shop-desc bgw">
                                <h3>{{$product->translate(session('locale'))->name}} </h3>
                                <small>
                                    <span class="prod_price">
                                        @if($product->sale)
                                            <del>{{$product->price}} AMD</del>
                                            @if($product->sale < 100)
                                                @php
                                                    $sale = $product->price / 100;
                                                    $sale = $sale * $product->sale;
                                                    $sale = $product->price - $sale;
                                                @endphp
                                                {{$sale}}
                                            @else
                                                {{$product->sale}}
                                            @endif
                                        @else
                                            {{$product->price}}
                                        @endif
                                    </span> AMD
                                </small>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <small>Color</small>
                                <div class="row">
                                    @foreach($product->colors as $color) 

                                        <div class="col-sm-1">
                                            <button style="background: {{$color->color}};"
                                                    class="prod_color btn-default"
                                                    data-value="{{$color->color}}">
                                                <i class="fa fa-square" style="color: {{$color->color}};"></i>
                                            </button>
                                        </div>

                                    @endforeach

                                </div>
                                <small>Quantity</small>
                                <div class="row">
                                    <div class="col-sm-6 ">

                                        <div class="input-group">
                                                <span class="quantity-left-minus"
                                                      data-type="minus" data-field="">
                                                    <i class="fa fa-minus"></i>
                                                </span>

                                            <input type="text" id="quantity" name="quantity"
                                                   value="1" min="1" max="100"
                                                   class="text-center">

                                            <span class="quantity-right-plus"
                                                  data-type="plus" data-field="">
                                                    <i class="fa fa-plus"></i>
                                                </span>
                                        </div>


                                    </div>
                                </div>
                                @foreach($product->parent->filters->chunk(2) as $chunk)
                                    <div class="row">
                                        @php($i = 1)
                                        @foreach($chunk as $filter)
                                            @php
                                                $filter_id = $product->filters->where('filter_id' , $filter->id)->first();
                                            if(!$filter_id){
                                                continue;
                                            }
                                            @endphp
                                            <div class="col-sm-6">
                                                <div class="form-group text-center">
                                                    <select class="selectpicker product_filter"
                                                            data-prod="{{$product->code}}"
                                                            data-href="{{route('priceAjax')}}"
                                                            data-filter="{{$filter->translate(session('locale'))->name}}">
                                                        <option value="" class="text-center change-disabled-parent"
                                                                data-disabled="{{$i}}" disabled selected>
                                                            @lang('product.choose') {{$filter->translate(session('locale'))->name}}
                                                            *
                                                        </option>
                                                        @foreach($filter->subs->sortBy('id') as  $subs)
                                                            @if(count($subs->values) < 1)
                                                                @php

                                                                    $filter_id = $product->filters->where('filter_value' , $subs->code)->first();
                                                                if(!$filter_id){
                                                                    continue;
                                                                }
                                                                @endphp
                                                                <option value="{{$subs->code}}"
                                                                        class="change-disabled"
                                                                        data-disabled_change="{{$i}}"
                                                                        data-name="{{$subs
                                                                        ->translate(session('locale'))
                                                                        ->name}}"
                                                                        data-fl="sub">
                                                                    {{$subs->translate(session('locale'))->name}}
                                                                </option>
                                                            @else
                                                                <optgroup
                                                                        label="{{$subs->translate(session('locale'))->name}}">
                                                                    @foreach($subs->values  as $value)
                                                                        @php
                                                                            $filter_id = $product->filters->where('filter_value' , $value->code)->first();
                                                                        if(!$filter_id){
                                                                            continue;
                                                                        }
                                                                        @endphp

                                                                        <option value="{{$value->code}}"
                                                                                class="change-disabled"
                                                                                data-disabled_change="{{$i}}"
                                                                                data-name="{{$value
                                                                                ->translate(session('locale'))
                                                                                ->name}}"
                                                                                data-fl="val">
                                                                            {{$value->translate(session('locale'))->name}}
                                                                        </option>
                                                                    @endforeach
                                                                </optgroup>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @php($i++)
                                        @endforeach
                                    </div>
                                @endforeach
                                @if(!Auth::guest())
                                    <a href="{{route('add_to_cart')}}"
                                       class="button button--aylen btn add_cart"
                                       disabled>
                                        @lang('product.add_cart')
                                    </a>
                                @else
                                    <p>
                                        @lang('product.please_order')
                                        <a data-tooltip="tooltip" data-placement="bottom"
                                           class="modal_trigger"
                                           href="#modal">
                                            @lang('auth.login')
                                        </a>
                                    </p>
                                @endif


                                <div class="shopmeta">
                                    <span><strong>@lang('product.category'):</strong>
                                        <a href="{{route('getCategory', ['cat' => $product->parent->link])}}">
                                            {{$product->parent->translate(session('locale'))->name}}
                                        </a>
                                    </span>
                                </div><!-- end shopmeta -->

                            </div><!-- end desc -->
                        </div><!-- end col -->
                    </div><!-- end row -->
                    <hr class="invis">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-style-1">
                                <div class="tabbed-widget">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab"
                                                              href="#home">@lang('product.description')</a></li>
                                        <li><a data-toggle="tab" href="#menu1">@lang('product.reviews')</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div id="home" class="tab-pane fade in active">
                                            {!! $product->translate(session('locale'))->description !!}
                                        </div>
                                        <div id="menu1" class="tab-pane fade">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel">
                                                        <div class="panel-body comments">
                                                            <ul class="media">
                                                                @foreach($product
                                                                ->reviews
                                                                ->sortByDesc('id')
                                                                ->where('published', 1) as $reviews)
                                                                    <li class="media">
                                                                        <div class="comment">
                                                                            <div class="media-body">
                                                                                <strong class="text-success">
                                              @if(!Auth::guest())                                      {{Auth::user()->name. ' '. Auth::user()->last_name}}
                                                                @endif                </strong>
                                                                                <span class="text-muted">
                                                                                        <small class="text-muted">
                                                                                           {{$product->created_at->diffForHumans()}}
                                                                                        </small>
                                                                                </span>
                                                                                <p>
                                                                                    {{$reviews->text}}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div><!-- end postpager -->
                                                <div class="contact_form blog-desc">
                                                    @if(!Auth::guest())

                                                        <div class="widget-title">
                                                            <h4>@lang('product.feedback')</h4>
                                                            <hr>
                                                        </div>

                                                        <div class="contact_form_container">
                                                            <form class="row comment_form"
                                                                  action="{{route('getComment', ['prod' => $product->link])}}"
                                                                  method="POST">
                                                                {{csrf_field()}}
                                                                <div class="col-md-12 col-sm-12">
                                                                    <label>
                                                                        @lang('product.comment')
                                                                        <span class="required">*</span>
                                                                    </label>
                                                                    <textarea class="form-control"
                                                                              placeholder="" name="comment" required>

                                                                    </textarea>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12">
                                                                    <input type="submit"
                                                                           value="@lang('product.feedback')"
                                                                           class="btn btn-primary"/>
                                                                </div>
                                                            </form>
                                                        </div><!-- end commentform -->
                                                    @else
                                                        <div class="widget-title">
                                                            <h4>
                                                                @lang('product.register_reviews')

                                                                <a data-tooltip="tooltip" data-placement="bottom"
                                                                   class="modal_trigger"
                                                                   href="#modal">
                                                                    @lang('auth.login')
                                                                </a>
                                                            </h4>
                                                            <hr>
                                                        </div>
                                                    @endif
                                                </div><!-- end postpager -->
                                            </div><!-- end content -->
                                        </div>
                                    </div>
                                </div>
                                <!-- end tabbed-widget -->
                            </div>
                            <!-- end service-style-1 -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div><!-- end content -->

                <div id="sidebar" class="col-md-3 col-sm-12"> 
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h4>
                                {{$subCat->category->translate(session('locale'))->name}}
                            </h4>
                            <hr>
                        </div>
                        <div class="menu-widget">
                            <ul class="check">
                                @foreach($subCat->category->subCategories as $subs)

                                    <li>
                                        <a href="{{route('getCategory', [
                                            'cat' => $subs->link,
                                            ])}}">
                                            {{$subs->translate(session('locale'))->name}}
                                        </a>
                                    </li>

                                @endforeach


                            </ul>
                        </div>
                        <!-- end menu-widget -->
                    </div>
                    <!-- end widget -->


                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h4>@lang('product.other_prod')</h4>
                            <hr>
                        </div>
                        <div class="menu-widget menu-widget-new">
                            <ul class="related">

                                <!-- Releted products-->
                                @foreach($other_products as $prod)
                                    <li>
                                        <div>
                                            <a href="{{route('getProduct',[
                                                'cat' => $prod->parent->link,
                                                'prod' => $prod->link
                                                ])}}" class="link_img">
                                                <img src="{{asset(
                                                         "images/products/".$product->images->sortBy('id')->first()['image_name'])}}"
                                                     alt="">
                                            </a>
                                            <a href="{{route('getProduct',[
                                                'cat' => $prod->parent->link,
                                                'prod' => $prod->link
                                                ])}}" class="link_img link_text ">
                                                {{--@if($prod)--}}
                                                <div class="related_name">
                                                        <span>
                                                            {{$prod->translate(session('locale'))->name}}
                                                        </span>
                                                </div>
                                                <div class="related_price">
                                                    @include('includes.pricing',['prod' => $prod])
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- end menu-widget -->
                    </div>
                    <!-- end widget -->
                </div><!-- end sidebar -->
            </div><!-- end row -->
<div class="row related_product_of_single">
                        <div class="section-title text-center clearfix">
                            <h4>@lang('product.related')</h4>
                            
                            <hr>
                        </div><!-- end title -->
                        <div class="row">
                            @if(count($subCat->products) >3)
                                @foreach($subCat->products->where('id', '!=', $product->id)->random(3) as $prod)
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="shop-item text-center">
                                            <div class="shop-thumbnail">
                                                <a href="{{route('getProduct',[
                                                'cat' => $subCat->link,
                                                'prod' => $prod->link
                                                ])}}" class="link_img">
                                                    <img class="img-responsive"
                                                         src="{{asset('images/products/'.$prod
                                                         ->images
                                                         ->sortBy('id')
                                                         ->first()['image_name'])}}"/>
                                                </a>

                                            </div>
                                            <div class="shop-desc">
                                                <h3>
                                                    <a href="{{route('getProduct',[
                                                'cat' => $subCat->link,
                                                'prod' => $prod->link
                                                ])}}">
                                                        {{$prod->translate(session('locale'))->name}}
                                                    </a>
                                                </h3>
                                                <div>
                                                    @include('includes.pricing',['prod' => $prod])
                                                </div>

                                            </div>

                                            <div class="shop-meta clearfix">
                                                <ul class="">
                                                    <li>
                                                        <a href="{{route('getProduct',[
                                                'cat' => $subCat->link,
                                                'prod' => $prod->link
                                                ])}}" class='heart'>
                                                            <i class="fa fa-shopping-bag"></i>
                                                            @lang('product.add_cart')
                                                        </a>
                                                    </li>
                                                </ul><!-- end list -->
                                            </div><!-- end shop-meta -->
                                        </div><!-- end shop-item -->
                                    </div>
                                @endforeach
                            @else
                                @foreach($subCat->products->where('id', '!=', $product->id) as $prod)
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="shop-item text-center">
                                            <div class="shop-thumbnail">
                                                <a href="{{route('getProduct',[
                                                'cat' => $subCat->link,
                                                'prod' => $prod->link
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
                                                'cat' => $subCat->link,
                                                'prod' => $prod->link
                                                ])}}">
                                                        {{$prod->translate(session('locale'))->name}}
                                                    </a>
                                                </h3>
                                                <div>
                                                    @include('includes.pricing',['prod' => $prod])
                                                </div>

                                            </div>

                                            <div class="shop-meta clearfix">
                                                <ul class="">
                                                    <li>
                                                        <a href="{{route('getProduct',[
                                                'cat' => $subCat->link,
                                                'prod' => $prod->link
                                                ])}}" class='heart'>
                                                            <i class="fa fa-shopping-bag"></i>
                                                            @lang('product.add_cart')
                                                        </a>
                                                    </li>
                                                </ul><!-- end list -->
                                            </div><!-- end shop-meta -->
                                        </div><!-- end shop-item -->
                                    </div>
                                @endforeach
                            @endif


                        </div><!-- end row -->
                    </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end section -->
  
@endsection

@section('script')
    @parent
    <script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <script type="text/javascript"
            src="{{asset('js/single_page.js')}}"></script>
    <script>
        var product = "{{$product->code}}";
    </script>

@endsection
