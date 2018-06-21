<div id="modalAddSubCategory" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <div class="box-header with-border text-center">
                    <h3 class="box-title">Add Sub Category</h3>
                </div>
                <div class="box box-primary">

                    <div class="box-body">

                        <form action="{{route('addSubCategory')}}" class="formImage" method="post">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="upload-demo3">
                                        <div class="form-group">
                                            <label for="file">Choose Cover Image</label>
                                            <input type="file" name="" id="file" class="upload3 form-control">
                                        </div>

                                        <span class="span_reset_file">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="upload-demo4">
                                        <div class="form-group">
                                            <label for="file">Choose Image</label>
                                            <input type="file" name="" id="file" class="upload2 form-control">
                                        </div>

                                        <span class="span_reset_file">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center">
                                <h3>Name</h3>
                            </div>
                            <div class="row">
                                <div class="panel panel-danger">
                                    <div class="panel-body">

                                        <div class="col-xs-4">
                                            <div class="form-group text-center {{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label>Հայերեն</label>
                                                <input type="text" name="hy_name" class="form-control"
                                                       placeholder="Հայերեն"
                                                       value="{{old('hy_name')}}" required>
                                                @if ($errors->has('hy_name'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('hy_name') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="form-group text-center {{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label>English</label>
                                                <input type="text" name="en_name" class="form-control"
                                                       placeholder="English"
                                                       value="{{old('en_name')}}" required>
                                                @if ($errors->has('en_name'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('en_name') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="form-group text-center {{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label>Русский</label>
                                                <input type="text" name="ru_name" class="form-control"
                                                       placeholder="Русский"
                                                       value="{{old('ru_name')}}" required>
                                                @if ($errors->has('ru_name'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('ru_name') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <h3><span>
                                            <i class="fa fa-filter" aria-hidden="true"></i>
                                            Filters
                                        </span>
                                        <button type="button" class="btn btn-info add_filter" title="Add Filter">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </h3>
                                </div>
                            </div>
                            <div class="filter_container">


                            </div>
                            {{--@php($i = 0)--}}
                            {{--@foreach($filters as $filter)--}}
                            {{--<div class="panel-group accordion" data-target="{{$i}}">--}}
                            {{--<div class="panel panel-danger">--}}
                            {{--<div class="panel-heading">--}}
                            {{--<a data-toggle="collapse" data-parent="#accordion" href="#collapse1_{{$i}}">--}}
                            {{--<h4 class="panel-title text-center">--}}
                            {{--{{$filter->translate(session('locale'))->name}}--}}
                            {{--</h4>--}}
                            {{--</a>--}}
                            {{--</div>--}}
                            {{--<div id="collapse1_{{$i}}" class="panel-collapse collapse">--}}
                            {{--<div class="panel-body">--}}
                            {{--@foreach($filter->subs as  $sub)--}}
                            {{--@if(count($sub->values) < 1)--}}
                            {{--<div class="col-sm-11 col-sm-offset-1">--}}
                            {{--<div class="panel panel-default">--}}
                            {{--<div class="panel-body">--}}
                            {{--<div class="btn-group btn-group-vertical"--}}
                            {{--data-toggle="buttons">--}}
                            {{--<label class="btn">--}}
                            {{--<input type="checkbox" name="subFilter[]"--}}
                            {{--value="{{$sub->id}}">--}}
                            {{--<i class="fa fa-square-o fa-2x"></i>--}}
                            {{--<i class="fa fa-check-square-o fa-2x"></i>--}}
                            {{--<span> {{$sub->translate(session('locale'))->name}}</span>--}}
                            {{--</label>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--@else--}}
                            {{--<div class="col-sm-11 col-sm-offset-1">--}}
                            {{--<div class="panel panel-success">--}}
                            {{--<div class="panel-heading">--}}
                            {{--<div class="btn-group btn-group-vertical"--}}
                            {{--data-toggle="buttons">--}}
                            {{--<label class="btn">--}}
                            {{--<input type="checkbox" name="subFilter[]"--}}
                            {{--value="{{$sub->id}}">--}}
                            {{--<i class="fa fa-square-o fa-2x"></i>--}}
                            {{--<i class="fa fa-check-square-o fa-2x"></i>--}}
                            {{--<span> {{$sub->translate(session('locale'))->name}}</span>--}}
                            {{--</label>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="panel-body">--}}
                            {{--@foreach($sub->values as $value)--}}
                            {{--<div class="col-sm-10 col-sm-offset-2">--}}
                            {{--<div class="panel panel-default">--}}
                            {{--<div class="panel-body">--}}
                            {{--<span> {{$value->translate(session('locale'))->name}}</span>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--@endforeach--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--@endif--}}
                            {{--@endforeach--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--@php($i++)--}}
                            {{--@endforeach--}}

                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                            <input type="hidden" name="cat" value="{{$category->link}}">
                            <input type="hidden" name="image">
                            <input type="hidden" name="imageGeneral">
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        </div>

    </div>
</div>

