@extends('layouts.app')

@section('head')
    @parent
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.4.1/croppie.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{asset('css/admin/admin.css')}}">
    <style type="text/css">
        .modal {
           z-index: 9999999;
        }
    </style>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
@endsection

@section('content')

    <section class="section paralbackground page-banner hidden-xs"
             style="background-image:url('{{asset('/images/covers/'.$cover->image)}}');"
             data-img-width="2000"
             data-img-height="400"
             data-diff="100"
             data-target="about_cover"
             data-prod="{{$cover->id}}"
             data-href_update="{{route('change_cover')}}">

        <button class="btn btn-info pull-right iconUpdate"
                title="Edite Cover"
                data-toggle="modal"
                data-target="#modalUpdate"
                data-status="about_cover">
            <i class="fa fa-edit"></i> Edit
        </button>
    </section>
    <!-- end section -->

    <div class="page-title">
        <div class="container clearfix">
            <div class="title-area pull-left">
                <h2>About us
                    <small>Welcome to the HomeStyle shop!</small>
                </h2>
            </div><!-- /.pull-right -->
            <div class="pull-right hidden-xs">
                <div class="bread">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">About</li>
                    </ol>
                </div><!-- end bread -->
            </div><!-- /.pull-right -->

        </div>

    </div><!-- end page-title -->


    <section class="section lb"
             data-target="about_slide"
             data-prod="{{$slide}}"
             data-href_update="{{route('change_slider')}}">
        <button class="btn btn-info pull-right iconUpdate"
                title="Edite Cover"
                data-toggle="modal"
                data-target="#modalUpdate"
                data-status="about_slide">
            <i class="fa fa-edit"></i> Edit
        </button>

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
                                 data-width="none"  data-height="none"
                                 data-whitespace="nowrap"  data-transform_idle="o:1;"
                                 data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.8;sY:0.8;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;"
                                 data-transform_out="y:[100%];s:1000;s:1000;"
                                 data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                 data-start="550" data-responsive_offset="on"
                                  >
                            </div>
                            <div class="tp-caption Sports-Subline tp-resizeme rs-parallaxlevel-0"
                                 id="slide-214-layer-1"
                                 data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                 data-y="['middle','middle','middle','middle']" data-voffset="['71','71','51','41']"
                                 data-fontsize="['30','30','30','25']"
                                 data-width="none"  data-height="none"
                                 data-whitespace="nowrap" data-transform_idle="o:1;"
                                 data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.8;sY:0.8;skX:0;skY:0;opacity:0;s:1500;e:Power4.easeOut;"
                                 data-transform_out="y:[100%];s:1000;s:1000;"
                                 data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                 data-start="550" data-splitin="chars"
                                 data-splitout="none"  data-responsive_offset="on"
                                 data-elementdelay="0.05"
                                 style=" white-space: nowrap; font-size: 30px; line-height: 30px;">{{$slide->text}}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div><!-- END REVOLUTION SLIDER -->
        </div><!-- end container -->
    </section><!-- end section -->


    <section class="section">
        <div class="container">
            <div class="row"
                 data-target="about_text"
                 data-prod="{{$about_text->id}}"
                 data-href_update="{{route('change_about_text')}}">

                <button class="btn btn-info iconUpdate  pull-right" title="Edit Text"
                        data-toggle="modal" data-target="#modalUpdate"
                        data-status="about_text">
                    <i class="fa fa-edit"></i> Edit
                </button>
                <div class="col-md-12 col-sm-12">

                    <div class="section-title text-left clearfix">
                        <h4>{{$about_text->header}}</h4>
                        <p>
                            {!! $about_text->description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--
    <section class="section"
             data-target="questions_text"
             {{--data-prod="{{$questions}}"--}}
             data-href_update="{{route('add_question')}}">
        <button class="btn btn-info iconUpdate  pull-right" title="Edit"
                data-toggle="modal" data-target="#modalUpdate"
                data-status="questions_text">
            <i class="fa fa-edit"></i> Add Questions
        </button>


        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="section-title text-left clearfix">
                        <h4>WHY HomeStyles?</h4>
                        <p>Donec vitae sapien ut libero venenatis faucibus.</p>
                        <hr>
                    </div>

                    <div class="content-widget">
                        <div class="accordion-widget">
                            <div class="accordion-toggle-2">

                                <div class="panel-group" id="accordion3">
                                    <div class="row">

                                        @foreach($about_faq as $faq)
                                            <div class="col-md-11 col-sm-1"
                                                 data-target="edit_questions_{{$faq->id}}"
                                                 data-prod="{{$faq->id}}"
                                                 data-href_update="{{route('edit_questions',['id' => $faq->id])}}">

                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <div class="panel-title">
                                                            <a class="accordion-toggle" data-toggle="collapse"
                                                               data-parent="#accordion3" href="#collapseFour_{{$faq->id}}">
                                                                {{$faq->header}} <i class="indicator fa fa-plus"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div id="collapseFour_{{$faq->id}}" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <p>
                                                                {!! $faq->description !!}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-sm-1">
                                                <button class="btn btn-info iconUpdate  pull-right" title="Edit"
                                                        data-toggle="modal" data-target="#modalUpdate"
                                                        data-status="edit_questions_{{$faq->id}}">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                            </div>

                                            @endforeach

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>-->
<!--

    <section class="section"
             data-target="hide_block"
             data-prod="{{$show->id}}"
             data-href_update="{{route('hideBlock')}}">

        <button class="btn btn-info iconUpdate  pull-right" title="Edit Text"
                data-toggle="modal" data-target="#modalUpdate"
                data-status="hide_block">
            <i class="fa fa-edit"></i> Close Section
        </button>


        <div class="container">
            <div class="section-title text-center clearfix">
                <h4>Meet the Team</h4>
                <p>Donec vitae sapien ut libero venenatis faucibus.</p>
                <hr>
            </div>

            <div class="row">
                <button class="btn btn-info   pull-right" title="Add a Employee"
                        data-toggle="modal" data-target="#modalAddEmployee">
                    <i class="fa fa-edit"></i> Add
                </button>

            </div>
            <div class="row module-wrapper text-center">

                @php($i = 0)
                @foreach($employees as $employee)

                    <div class="col-md-3 col-sm-3 team-member"
                         data-prod="{{$employee->id}}"
                         data-href_update="{{route('editEmployee', ['id' => $employee->id])}}"
                         data-href_delete="{{route('deleteEmployee')}}"
                         data-target="prod_{{$i}}">
                        <div class="row">


                            <button class="btn btn-info pull-right iconUpdate"
                                    title="Edit Employee"
                                    data-toggle="modal"
                                    data-target="#modalUpdate"
                                    data-status="prod_{{$i}}">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger pull-left iconDelete"
                                    title="Delete Employee"
                                    data-toggle="modal"
                                    data-target="#modalDelete"
                                    data-status="prod_{{$i}}">
                                <i class="fa fa-trash"></i> Delete
                            </button>


                        </div>
                        <div class="about-widget">
                            <div class="post-media">
                                <img src="{{asset('images/employee/'.$employee->image)}}" alt="" class="img-responsive">
                            </div>
                            <div class="social-icons">
                                <ul class="list-inline">

                                    @if($employee->employee_social->facebook != "")
                                        <li class="facebook"><a data-tooltip="tooltip" data-placement="top"
                                                                title="Facebook" target="_blank"
                                                                href="{{$employee->link}}"><i
                                                        class="fa fa-facebook"></i></a></li>
                                    @endif

                                    @if($employee->employee_social->google != "")
                                        <li class="google"><a data-tooltip="tooltip" data-placement="top"
                                                              target="_blank"
                                                              title="Google Plus" href="{{$employee->link}}"><i
                                                        class="fa fa-google-plus"></i></a>
                                        </li>
                                    @endif


                                    @if($employee->employee_social->twitter != "")
                                        <li class="twitter"><a data-tooltip="tooltip" data-placement="top"
                                                               target="_blank"
                                                               title="Twitter"
                                                               href="{{$employee->link}}"><i class="fa fa-twitter"></i></a>
                                        </li>
                                    @endif

                                    @if($employee->employee_social->linkedin != "")
                                        <li class="linkedin"><a data-tooltip="tooltip" data-placement="top"
                                                                target="_blank"
                                                                title="Linkedin"
                                                                href="{{$employee->link}}"><i
                                                        class="fa fa-linkedin"></i></a></li>
                                    @endif

                                    @if($employee->employee_social->pinterest != "")
                                        <li class="pinterest"><a data-tooltip="tooltip" data-placement="top"
                                                                 target="_blank"
                                                                 title="Pinterest" href="{{$employee->link}}"><i
                                                        class="fa fa-pinterest"></i></a>
                                        </li>
                                    @endif

                                    @if($employee->employee_social->skype != "")
                                        <li class="skype"><a data-tooltip="tooltip" data-placement="top" target="_blank"
                                                             title="Skype"
                                                             href="{{$employee->link}}"><i class="fa fa-skype"></i></a>
                                        </li>
                                    @endif

                                    @if($employee->employee_social->vimeo != "")
                                        <li class="vimeo"><a data-tooltip="tooltip" data-placement="top" target="_blank"
                                                             title="vimeo"
                                                             href="{{$employee->link}}"><i class="fa fa-vimeo"></i></a>
                                        </li>
                                    @endif

                                    @if($employee->employee_social->youtube != "")
                                        <li class="youtube"><a data-tooltip="tooltip" data-placement="top"
                                                               target="_blank" title="youtube"
                                                               href="{{$employee->link}}"><i class="fa fa-youtube"></i></a>
                                        </li>
                                    @endif

                                    @if($employee->employee_social->instagram != "")
                                        <li class="instagram"><a data-tooltip="tooltip" data-placement="top"
                                                                 target="_blank" title="instagram"
                                                                 href="{{$employee->link}}"><i
                                                        class="fa fa-instagram"></i></a></li>
                                    @endif

                                </ul>
                            </div>

                            <div class="about-desc">
                                <h4>{{$employee->name}}</h4>
                                <small>{{$employee->position}}</small>
                                <p>{{$employee->text}}</p>
                            </div>
                        </div>
                    </div>
                    @php($i++)
                @endforeach


            </div>

        </div>


    </section>-->
    
  @include('vendor.adminlte.modal.modalDelete')
    @include('vendor.adminlte.modal.modalUpdate')
    @include('vendor.adminlte.modal.modalAddEmployee')
@endsection



@section('script')
    @parent
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('js/croppie.min.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

    <script>
        $uploadCrop = $(".upload-demo2").croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200
            },
            boundary: {
                width: 300,
                height: 301
            }
        });

        w = 500;
        h = 500;
    </script>
    <script src="{{asset('js/plugins.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/jquery.themepunch.tools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS -->
    <script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('revolution/js/extensions/revolution.extension.video.min.js')}}"></script>

    <script>
        var revapi;
        jQuery(document).ready(function() {
            revapi = jQuery("#rev_slider").revolution({
                sliderType:"standard",
                sliderLayout:"auto",
                delay:9000,
                navigation: {
                    arrows:{enable:true}
                },
                gridwidth:1230,
                gridheight:720
            });
        }); /*ready*/
    </script>


    <script type="text/javascript" src="{{asset('js/admin/site.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/jquery-ui.js')}}"></script>

    <script>

    </script>

@endsection