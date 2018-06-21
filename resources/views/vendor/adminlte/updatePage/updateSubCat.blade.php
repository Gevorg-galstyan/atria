<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        {{--<h4 class="modal-title">(IMAGE SIZE 1920 x 1080)</h4>--}}
    </div>
    <div class="modal-body">
        <div class="modal-body">
            <div class="box-header with-border text-center">
                <h3 class="box-title">Update Category</h3>
            </div>
            <div class="box box-primary">

                <div class="box-body">

                    <form action="{{route('updateSubCategory')}}" method="POST" class="formImage"
                          enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="upload-demo5">
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
                                <div class="upload-demo6">
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

                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Old Cover Image</h3>
                                <img src="{{asset('images/subCategory/'.$product->general_image)}}" class="img-rounded"
                                     alt="Cinque Terre" width="100%">
                            </div>
                            <div class="col-sm-6">
                                <h3>Old Image</h3>
                                <img src="{{asset('images/subCategory/'.$product->image_name)}}" class="img-rounded"
                                     alt="Cinque Terre" width="100%">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group text-center">
                                    <label>Հայերեն</label>
                                    <input type="text" name="hy_name" class="form-control" placeholder="Հայերեն"
                                           value="{{$product->translate('hy')->name}}" required>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group text-center">
                                    <label>English</label>
                                    <input type="text" name="en_name" class="form-control" placeholder="English"
                                           value="{{$product->translate('en')->name}}" required>

                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group text-center">
                                    <label>Русский</label>
                                    <input type="text" name="ru_name" class="form-control" placeholder="Русский"
                                           value="{{$product->translate('ru')->name}}" required>
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
                        @php
                            $i = 0;
                            $j = 0;
                        @endphp
                        @foreach($filters->sortBy('id') as $filter)
                            <div class="panel-group accordion" data-target="filter_{{$i}}"
                                 data-filter="{{$i}}"
                                 data-prod="{{$filter->id}}"
                                 data-href_delete="{{route('deleteFilter')}}"
                                 data-key="filter">
                                <div class="panel panel-danger">
                                    <div class="panel-heading">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$i}}">
                                            <h4 class="panel-title text-center">
                                                {{$filter->translate(session('locale'))->name}}
                                            </h4>
                                        </a>
                                    </div>
                                    <div id="collapse_{{$i}}" class="panel-collapse collapse">
                                        <div class="panel-body">


                                            <div class="col-sm-12">

                                                <button type="button"
                                                        class="btn btn-danger btn_delete iconDelete pull-right"
                                                        data-status="filter_{{$i}}"
                                                        title="Delete">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </button>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <div class="form-group text-center">
                                                        <label>Հայերեն</label>
                                                        <input type="text"
                                                               name="hy_name_filter_old[{{$i}}]"
                                                               class="form-control"
                                                               placeholder="Հայերեն"
                                                               value="{{$filter->translate('hy')->name}}"
                                                               required>
                                                    </div>

                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="form-group text-center">
                                                        <label>English</label>
                                                        <input type="text"
                                                               name="en_name_filter_old[{{$i}}]"
                                                               class="form-control"
                                                               placeholder="English"
                                                               value="{{$filter->translate('en')->name}}"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="form-group text-center">
                                                        <label>Русский</label>
                                                        <input type="text"
                                                               name="ru_name_filter_old[{{$i}}]"
                                                               class="form-control"
                                                               placeholder="Русский"
                                                               value="{{$filter->translate('ru')->name}}"
                                                               required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h3 class="text-center">
                                                    Add Sub Filter
                                                    <button type="button" class="btn btn-info add_sub_filter"
                                                            data-sub_filter="{{$i}}"
                                                            title="Add Sub Filter">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </h3>
                                            </div>
                                            <div class="sub_filter_content">

                                                @foreach($filter->subs->sortBy('id') as  $sub)
                                                    <div data-name="old_{{$j}}"
                                                         data-target="delete_filter_sub{{$j}}"
                                                         data-prod="{{$sub->id}}"
                                                         data-href_delete="{{route('deleteFilter')}}"
                                                         data-key="sub">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <div class="form-group text-center">
                                                                    <label>Հայերեն</label>
                                                                    <input type="text"
                                                                           name="hy_name_sub_old[{{$i}}][]"
                                                                           class="form-control"
                                                                           placeholder="Հայերեն"
                                                                           value="{{$sub->translate('hy')->name}}"
                                                                           required>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <div class="form-group text-center">
                                                                    <label>English</label>
                                                                    <input type="text"
                                                                           name="en_name_sub_old[{{$i}}][]"
                                                                           class="form-control"
                                                                           placeholder="English"
                                                                           value="{{$sub->translate('en')->name}}"
                                                                           required>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-3">
                                                                <div class="form-group text-center">
                                                                    <label>Русский</label>
                                                                    <input type="text"
                                                                           name="ru_name_sub_old[{{$i}}][]"
                                                                           class="form-control"
                                                                           placeholder="Русский"
                                                                           value="{{$sub->translate('ru')->name}}"
                                                                           required>
                                                                </div>
                                                            </div>
                                                            <button data-target="{{$j}}"
                                                                    type="button"
                                                                    class="btn btn-info add_filter_value"
                                                                    data-prefix="old_"
                                                                    title="Add Child"
                                                                    data-val="{{$i}}">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                            <button data-status="delete_filter_sub{{$j}}"
                                                                    type="button"
                                                                    class="btn btn-danger btn_delete iconDelete"
                                                                    title="Delete">
                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                            </button>
                                                        </div>

                                                        @php($f = 0)
                                                        @foreach($sub->values->sortBy('id') as $value)
                                                            <div class="row"
                                                                 data-target="delete_filter_value{{$f}}"
                                                                 data-prod="{{$value->id}}"
                                                                 data-href_delete="{{route('deleteFilter')}}"
                                                                 data-key="value">
                                                                <div class="col-xs-1">
                                                                </div>
                                                                <div class="col-xs-3">
                                                                    <div class="form-group text-center">
                                                                        <label>Հայերեն</label>
                                                                        <input type="text"
                                                                               name="hy_sub_old[{{$i}}][{{$j}}][]"
                                                                               class="form-control"
                                                                               placeholder="Հայերեն"
                                                                               value="{{$value->translate('hy')->name}}"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-3">
                                                                    <div class="form-group text-center">
                                                                        <label>English</label>
                                                                        <input type="text"
                                                                               name="en_sub_old[{{$i}}][{{$j}}][]"
                                                                               class="form-control"
                                                                               placeholder="English"
                                                                               value="{{$value->translate('en')->name}}"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-3">
                                                                    <div class="form-group text-center">
                                                                        <label>Русский</label>
                                                                        <input type="text"
                                                                               name="ru_sub_old[{{$i}}][{{$j}}][]"
                                                                               class="form-control"
                                                                               placeholder="Русский"
                                                                               value="{{$value->translate('ru')->name}}"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-2">
                                                                    <button type="button"
                                                                            class="btn btn-danger btn_delete iconDelete"
                                                                            data-status="delete_filter_value{{$f}}"
                                                                            title="Delete">
                                                                        <i class="fa fa-times"
                                                                           aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @php($f++)
                                                        @endforeach
                                                    </div>
                                                    @php($j++)
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php($i++)
                        @endforeach
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <input type="hidden" name="prod" value="{{$product->link}}">
                        <input type="hidden" name="image">
                        <input type="hidden" name="imageGeneral">
                    </form>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<script>
    $uploadCrop1 = $(".upload-demo6").croppie({
        enableExif: true,
        viewport: {
            width: 370,
            height: 300
        },
        boundary: {
            width: 470,
            height: 400
        }
    });

    w1 = 370;
    h1 = 300;


    $uploadCrop = $(".upload-demo5").croppie({
        enableExif: true,
        viewport: {
            width: 500,
            height: 100
        },
        boundary: {
            width: 600,
            height: 120
        }
    });

    w = 2000;
    h = 400;
    var modal = document.getElementById('myModal');

    sub_filter = "{{$i}}";
    filter = "{{$i}}";
    number = 0;
</script>