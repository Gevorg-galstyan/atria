@extends('layouts.app')


@section('content')

    <section class="section paralbackground page-banner hidden-xs"
             style="background-image:url('{{asset('/images/covers/'.$cover->image)}}');" data-img-width="2000"
             data-img-height="400"
             data-diff="100">
    </section>
    <!-- end section -->

    <div class="page-title">
        <div class="container clearfix">
            <div class="title-area pull-left">
                <h2>
                    @lang('about.about_us')

                    <small>@lang('about.about_us_desc')</small>
                </h2>
            </div><!-- /.pull-right -->
            <div class="pull-right hidden-xs">
                <div class="bread">
                    <ol class="breadcrumb">
                        <li>
                            <a href="#">
                                @lang('header.home')
                            </a>
                        </li>
                        <li class="active">
                            @lang('header.about')
                        </li>
                    </ol>
                </div><!-- end bread -->
            </div><!-- /.pull-right -->
        </div>
    </div><!-- end page-title -->

    <section class="section lb">
        <div class="container">
            <!-- START REVOLUTION SLIDER 5.0 auto mode -->
            <div id="rev_slider" class="rev_slider" data-version="5.0">
                <!-- SLIDE  -->
                <ul>
                    @foreach($about_slider as $slide)
                        <li data-transition="fade">
                            <!-- MAIN IMAGE -->
                            <img src="{{asset('upload/about_slider/'.$slide->image)}}" width="1250" height="600">
                            <div class="tp-caption tp-resizeme rs-parallaxlevel-0"
                                 id="slide-214-layer-1"
                                 data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                 data-y="['middle','middle','middle','middle']" data-voffset="['55','55','55','40']"
                                 data-width="none" data-height="none"
                                 data-whitespace="nowrap" data-transform_idle="o:1;"
                                 data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.8;sY:0.8;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;"
                                 data-transform_out="y:[100%];s:1000;s:1000;"
                                 data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                 data-start="550" data-responsive_offset="on"
                                 style="z-index: 200000000;">
                            </div>
                            <div class="tp-caption Sports-Subline tp-resizeme rs-parallaxlevel-0"
                                 id="slide-214-layer-1"
                                 data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                 data-y="['middle','middle','middle','middle']" data-voffset="['71','71','51','41']"
                                 data-fontsize="['30','30','30','25']"
                                 data-width="none" data-height="none"
                                 data-whitespace="nowrap" data-transform_idle="o:1;"
                                 data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.8;sY:0.8;skX:0;skY:0;opacity:0;s:1500;e:Power4.easeOut;"
                                 data-transform_out="y:[100%];s:1000;s:1000;"
                                 data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                 data-start="550" data-splitin="chars"
                                 data-splitout="none" data-responsive_offset="on"
                                 data-elementdelay="0.05"
                                 style="z-index: 99988888; white-space: nowrap; font-size: 30px; line-height: 30px;">{{$slide->text}}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div><!-- END REVOLUTION SLIDER -->
        </div><!-- end container -->
    </section><!-- end section -->


    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="section-title text-left clearfix">
                        <h4>
                            {{$about_text->translate(session('locale'))->header}}
                        </h4>
                        <p>
                            {!! $about_text->translate(session('locale'))->description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
{{--<section class="section">--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-12 col-sm-12">--}}
                {{--<div class="section-title text-left clearfix">--}}
                    {{--<h4>WHY HomeStyles?</h4>--}}
                    {{--<p>Donec vitae sapien ut libero venenatis faucibus.</p>--}}
                    {{--<hr>--}}
                {{--</div><!-- end title -->--}}

                {{--<div class="content-widget">--}}
                    {{--<div class="accordion-widget">--}}
                        {{--<div class="accordion-toggle-2">--}}
                            {{--<div class="panel-group " id="accordion3">--}}
                                {{--@foreach($about_faq as $faq)--}}

                                    {{--<div class="panel panel-default">--}}
                                        {{--<div class="panel-heading">--}}
                                            {{--<div class="panel-title">--}}
                                                {{--<a class="accordion-toggle" data-toggle="collapse"--}}
                                                   {{--data-parent="#accordion3" href="#collapseFour_{{$faq->id}}">--}}
                                                    {{--{{$faq->header}}--}}
                                                    {{--<i class="indicator fa fa-plus"></i>--}}
                                                {{--</a>--}}

                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div id="collapseFour_{{$faq->id}}" class="panel-collapse collapse">--}}
                                            {{--<div class="panel-body">--}}
                                                {{--{!! $faq->description !!}--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                {{--@endforeach--}}
                            {{--</div>--}}
                        {{--</div><!-- accordion -->--}}
                    {{--</div><!-- end accordion-widget -->--}}
                {{--</div><!-- end content-widget -->--}}
            {{--</div><!-- end col -->--}}

        {{--</div><!-- end row -->--}}
    {{--</div><!-- end container -->--}}
{{--</section><!-- end section -->--}}


{{--@if($show->hide == 0)--}}
    {{--<section class="section">--}}
       {{--<div class="container">--}}
        {{--<div class="section-title text-center clearfix">--}}
            {{--<h4>--}}
                {{--@lang('about.our_team')--}}
            {{--</h4>--}}
            {{--<p>Donec vitae sapien ut libero venenatis faucibus.</p>--}}
            {{--<hr>--}}
        {{--</div>--}}


        {{--<div class="row module-wrapper text-center">--}}


            {{--@php($i = 0)--}}
            {{--@foreach($employees as $employee)--}}

                {{--<div class="col-md-3 col-sm-3 team-member"--}}
                {{-->--}}
                    {{--<div class="row">--}}

                    {{--</div>-->--}}
                    {{--<div class="about-widget">--}}
                        {{--<div class="post-media">--}}
                            {{--<img src="{{asset('images/employee/'.$employee->image)}}" alt=""--}}
                                 {{--class="img-responsive">--}}
                        {{--</div>--}}
                        {{--<div class="social-icons">--}}
                            {{--<ul class="list-inline">--}}

                                {{--@if($employee->employee_social->facebook != "")--}}
                                    {{--<li class="facebook"><a data-tooltip="tooltip" data-placement="top"--}}
                                                            {{--title="Facebook" target="_blank"--}}
                                                            {{--href="{{$employee->link}}"><i--}}
                                                    {{--class="fa fa-facebook"></i></a></li>--}}
                                {{--@endif--}}

                                    {{--@if($employee->employee_social->google != "")--}}
                                    {{--<li class="google"><a data-tooltip="tooltip" data-placement="top"--}}
                                                          {{--target="_blank"--}}
                                                          {{--title="Google Plus" href="{{$employee->link}}"><i--}}
                                                    {{--class="fa fa-google-plus"></i></a>--}}
                                    {{--</li>--}}
                                {{--@endif--}}


                                    {{--@if($employee->employee_social->twitter != "")--}}
                                    {{--<li class="twitter"><a data-tooltip="tooltip" data-placement="top"--}}
                                                           {{--target="_blank"--}}
                                                           {{--title="Twitter"--}}
                                                           {{--href="{{$employee->link}}"><i--}}
                                                    {{--class="fa fa-twitter"></i></a>--}}
                                    {{--</li>--}}
                                {{--@endif--}}

                                    {{--@if($employee->employee_social->linkedin != "")--}}
                                    {{--<li class="linkedin"><a data-tooltip="tooltip" data-placement="top"--}}
                                                            {{--target="_blank"--}}
                                                            {{--title="Linkedin"--}}
                                                            {{--href="{{$employee->link}}"><i--}}
                                                    {{--class="fa fa-linkedin"></i></a></li>--}}
                                {{--@endif--}}

                                    {{--@if($employee->employee_social->pinterest != "")--}}
                                    {{--<li class="pinterest"><a data-tooltip="tooltip" data-placement="top"--}}
                                                             {{--target="_blank"--}}
                                                             {{--title="Pinterest" href="{{$employee->link}}"><i--}}
                                                    {{--class="fa fa-pinterest"></i></a>--}}
                                    {{--</li>--}}
                                {{--@endif--}}

                                    {{--@if($employee->employee_social->skype != "")--}}
                                    {{--<li class="skype"><a data-tooltip="tooltip" data-placement="top"--}}
                                                         {{--target="_blank"--}}
                                                         {{--title="Skype"--}}
                                                         {{--href="{{$employee->link}}"><i class="fa fa-skype"></i></a>--}}
                                    {{--</li>--}}
                                {{--@endif--}}

                                    {{--@if($employee->employee_social->vimeo != "")--}}
                                    {{--<li class="vimeo"><a data-tooltip="tooltip" data-placement="top"--}}
                                                         {{--target="_blank"--}}
                                                         {{--title="vimeo"--}}
                                                         {{--href="{{$employee->link}}"><i class="fa fa-vimeo"></i></a>--}}
                                    {{--</li>--}}
                                {{--@endif--}}

                                    {{--@if($employee->employee_social->youtube != "")--}}
                                    {{--<li class="youtube"><a data-tooltip="tooltip" data-placement="top"--}}
                                                           {{--target="_blank" title="youtube"--}}
                                                           {{--href="{{$employee->link}}"><i--}}
                                                    {{--class="fa fa-youtube"></i></a>--}}
                                    {{--</li>--}}
                                {{--@endif--}}

                                    {{--@if($employee->employee_social->instagram != "")--}}
                                    {{--<li class="instagram"><a data-tooltip="tooltip" data-placement="top"--}}
                                                             {{--target="_blank" title="instagram"--}}
                                                             {{--href="{{$employee->link}}"><i--}}
                                                    {{--class="fa fa-instagram"></i></a></li>--}}
                                {{--@endif--}}

                                {{--</ul>--}}
                        {{--</div>--}}

                        {{--<div class="about-desc">--}}
                            {{--<h4>{{$employee->name}}</h4>--}}
                            {{--<small>{{$employee->position}}</small>--}}
                            {{--<p>{{$employee->text}}</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--@php($i++)--}}
            {{--@endforeach--}}


            {{--</div>--}}

    {{--</div>--}}
{{--</section>--}}
{{--@endif--}}
@endsection


@section('script')
    @parent
    <script type="text/javascript" src="{{asset('revolution/js/jquery.themepunch.tools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS -->
    <script type="text/javascript"
            src="{{asset('revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
    <script>
        var revapi;
        jQuery(document).ready(function () {
            revapi = jQuery("#rev_slider").revolution({
                sliderType: "standard",
                sliderLayout: "auto",
                delay: 9000,
                navigation: {
                    arrows: {enable: true}
                },
                gridwidth: 1230,
                gridheight: 720
            });
        });
        /*ready*/
    </script>
@endsection