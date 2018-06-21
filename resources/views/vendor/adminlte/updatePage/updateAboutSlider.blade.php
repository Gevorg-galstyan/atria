<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <div class="box-header with-border text-center">
            <h3 class="box-title">Change Slider Images</h3>
        </div>
        <div class="box box-primary">

            <div class="box-body">

                <form action="{{route('change_slider')}}" method="post"
                      class="productMulty"
                      enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="row">
                        <h4 class="text-center">
                            <i class="fa fa-picture-o" aria-hidden="true"></i>Old Images
                        </h4>
                        <div class="col-md-12">
                            <div id="multiple-file-preview">

                                <div class="clear-both">
                                    <ul id="sortable1" class="sort text-center" style="list-style: none;">
                                        @php($img = 0)
                                        @foreach($product->sortBy('id') as $image)
                                            <li class="ui-state-default col-sm-3" data-order="0"
                                                data-target="image{{$img}}"
                                                data-prod="{{$image->id}}"
                                                data-key="image"
                                                data-href_delete="{{route('deleteSlideImg',['id'=>$image->id])}}">

                                                <input type="text" class="form-control col-sm-4" name="text_hy[]" value="{{$image->translate('hy')->text . $img}}">
                                                <input type="text" class="form-control col-sm-4" name="text_en[]" value="{{$image->translate('en')->text . $img}}">
                                                <input type="text" class="form-control col-sm-4" name="text_ru[]" value="{{$image->translate('ru')->text . $img}}">

                                                <img src="{{asset('upload/about_slider/'.$image->image)}}"
                                                     style="width:100%;"/>
                                                <span class="delete_update_image iconDelete"
                                                      data-status="image{{$img}}">
                                                                <i class="fa fa-trash fa-2x"></i>
                                                            </span>
                                                <input type="hidden" name="image_name[]"
                                                       value="{{$image->image}}">
                                            </li>
                                            @php($img ++)
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel panel-danger">
                            <div class="panel panel-body">
                                <h4 class="text-center">Choose New Images</h4>

                                <div class="col-sm-12">
                                    <div class="block">
                                        <input type="file" name="img" data-name="updateImage"
                                               class="image"
                                               multiple="multiple"/>

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="image_container" data-xname="updateImage">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                            </button>
                        </div>
                    </div>

                    <div class="imageContainer">

                    </div>

                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<script>
    prodImageW = 1000;
    prodImageH = 650;
</script>