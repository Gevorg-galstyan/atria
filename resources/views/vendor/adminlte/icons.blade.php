@extends('adminlte::layouts.app')

@section('link')
    <link href="{{ asset('/css/admin/message.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('main-content')

    <section class="content-header text-center">
        <h1>
            Social Icons
        </h1>
    </section>


    <form class="form-horizontal icons_form" method="post" action="{{route('change_icons')}}">


        @foreach($icons->sortBy('id') as $icon)
            <div class="form-group">
                <label class="col-sm-1">
                    <a class="pull-right" data-tooltip="tooltip" data-placement="top" href="#">
                        <i class="{{$icon->icon_code}}"></i>
                    </a>
                </label>

                <div class="col-sm-7">
                    <input type="text" name="icons[]" class="form-control" id="href" value="{{$icon->link}}">
                </div>
            </div>
        @endforeach


        {{csrf_field()}}
        <div class="form-group">
            <div class="col-sm-offset-7 col-sm-2">
                <button type="submit" class="btn btn-info">Save</button>
            </div>
        </div>
    </form>



@endsection
@section('script')
    @parent
    <script src="{{asset('js/admin/message.js')}}"></script>
@endsection
