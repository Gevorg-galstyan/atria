@extends('layouts.app')

@section('content')



    <section class="section paralbackground page-banner hidden-xs" style="background-image:url('upload/page_banner.jpg');" data-img-width="2000" data-img-height="400" data-diff="100">
    </section><!-- end section -->

    <div class="page-title lb">
        <div class="container clearfix">
            <div class="title-area pull-left">
                <h2>Page Not Found<small>Get in touch, ask your questions to us!</small></h2>
            </div><!-- /.pull-right -->
            <div class="pull-right hidden-xs">
                <div class="bread">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">404</li>
                    </ol>
                </div><!-- end bread -->
            </div><!-- /.pull-right -->
        </div>
    </div><!-- end page-title -->

    <section class="section">
        <div class="container">
            <div class="notfound">
                <h2>404 <span>Error!</span></h2>
                <p>
                    Sorry, we can't find the page you are looking for. <br>Please go to
                    <a href="#">Home </a> or search something from search form.
                </p>
            </div>
        </div><!-- end container -->
    </section><!-- end section -->
@endsection