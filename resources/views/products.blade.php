@extends('layouts.app')

@section('content')


    <section class="section paralbackground page-banner hidden-xs"
             style="background-image:url({{asset('images/subCategory/'.$subCategory->general_image)}});"
             data-img-width="2000" data-img-height="400"
             data-diff="100">
    </section>
    <!-- end section -->

    <div class="page-title">
        <div class="container clearfix">
            <div class="title-area pull-left">
                <h2>ATRIA
                    <small>@lang('index.atria')</small>
                </h2>
            </div><!-- /.pull-right -->
            <div class="pull-right hidden-xs">
                <div class="bread">
                    <ol class="breadcrumb">
                        <li><a href="{{route('home')}}">@lang('header.home')</a></li>
                        <li class="active">{{$subCategory->translate(session('locale'))->name}}</li>
                    </ol>
                </div><!-- end bread -->
            </div><!-- /.pull-right -->
        </div>
    </div><!-- end page-title -->

    <section class="section lb">
        <div class="container">
            <div class="row">
                <div id="content" class="col-md-9 col-sm-12 single-blog">
                    <div class=" shop-list">

                        @foreach($products->chunk(3) as $chunk)
                            <div class="row">
                                @foreach($chunk as $product)
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="shop-item text-center">
                                            <div class="shop-thumbnail">
                                                <a href="{{route('getProduct',[
                                                'cat' => $subCategory->link,
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
                                                'cat' => $subCategory->link,
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
                                                'cat' => $subCategory->link,
                                                'prod' => $product->link
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

                </div><!-- end content -->

                <div id="sidebar" class="col-md-3 col-sm-12">

                    <div class="widget clearfix">
                        @php($i = 0)
                        @foreach($subCategory->filters as $filter)

                            <div class="widget-title {{$i == 0 ? 'filter_href' : ''}}"
                                 data-href="{{$i == 0 ? route('pstFilterProduct') : ''}}"
                                 data-cat="{{$i == 0 ? $subCategory->code : ''}}">
                                <h4>
                                    {{$filter->translate(session('locale'))->name}}
                                </h4>
                                <hr>
                            </div>

                            <div class="menu-widget">
                                @foreach($filter->subs as $sub)
                                    @if(count($sub->values) < 1)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"
                                                       class="products_filter"
                                                       name="filter[]"
                                                       value="{{$sub->code}}">
                                                {{$sub->translate(session('locale'))->name}}
                                            </label>
                                        </div>
                                    @else
                                        @foreach($sub->values as $value)
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4>
                                                        {{$sub->translate(session('locale'))->name}}
                                                    </h4>
                                                </div>
                                                <div class="col-sm-11 col-sm-offset-1">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="products_filter"
                                                                   name="filter[]" value="{{$value->code}}">
                                                            {{$value->translate(session('locale'))->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                            <!-- end menu-widget -->
                            @php($i++)
                        @endforeach
                    </div>
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h4>
                                {{$category->translate(session('locale'))->name}}
                            </h4>
                            <hr>
                        </div>
                        <div class="menu-widget">
                            <ul class="check">
                                @foreach($category->subCategories as $subs)

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
                                @foreach($other_products as $product)
                                    <li>
                                        <div>
                                            <a href="{{route('getProduct',[
                                                'cat' => $product->parent->link,
                                                'prod' => $product->link
                                                ])}}" class="link_img">
                                                <img src="{{asset(
                                                         "images/products/".$product->images->sortBy('id')->first()['image_name'])}}"
                                                     alt="">
                                            </a>
                                            <a href="{{route('getProduct',[
                                                'cat' => $product->parent->link,
                                                'prod' => $product->link
                                                ])}}" class="link_img link_text ">
                                                {{--@if($product)--}}
                                                <div class="related_name">
                                                        <span>
                                                            {{$product->translate(session('locale'))->name}}
                                                        </span>
                                                </div>
                                                <div class="related_price">
                                                    @include('includes.pricing',['prod' => $product])
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
        </div><!-- end container -->
    </section><!-- end section -->


@endsection

@section('script')
    @parent
    <script type="text/javascript" src="{{asset('js/products.js')}}"></script>


@endsection

