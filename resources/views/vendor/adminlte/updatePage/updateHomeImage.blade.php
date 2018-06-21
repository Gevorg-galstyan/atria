<style>
    #modalUpdate,.modal-dialog,.modal-body{
        padding: 0 !important;
        margin: 0 !important;
    }
    .modal-dialog {
        width: 100% !important;
    }
</style>

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <h3 class="box-title">Update</h3>
    </div>
    <div class="modal-body">
        <div class="imgREsalt" style="display: none; z-index: 9999999999999999999">

        </div>
        <div class="modal-body">
            <div class="box box-primary">

                <div class="box-body">
                    <form action="{{route('updateHomeImage')}}" method="POST" class="formImage" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="">
                            <div class=" text-center" >
                                <div class="col-sm">
                                    <input type="file" name="" id="file" class="input-file  upload2"
                                           data-image="imageVarietyUpdate">
                                    <label for="file" class="btn btn-tertiary js-labelFile">
                                        <i class="icon fa fa-check"></i>
                                        <span class="js-fileName">Change a Image</span>
                                    </label>
                                </div>
                                <div class="col-md text-center">
                                    <div class="upload-demo2" style="width:350px; position: relative;">
                                        <span class="span_reset_file"><i class="fa fa-times" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>

                            {{--<div class="col-sm-6">--}}
                                {{--<img src="{{asset('upload/'.$product->image_name)}}" class="img-thumbnail" alt="{{config('app.name')}}" width="100%">--}}
                            {{--</div>--}}
                            <div class="row">
                                {{--<div class="col-sm-12">--}}
                                    {{--<div class="actions">--}}
                                        {{--<button type="button" class="btn btn-success basic-result">Result</button>--}}
                                        {{--<input type="number" class="basic-width" value="1170" placeholder="width"> x <input--}}
                                                {{--type="number" class="basic-height" value="900" placeholder="height">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>

                        </div>
                        <div class="row text-center">
                            <div class="col-sm-4">
                                <h3>Հայերեն</h3>
                            </div>
                            <div class="col-sm-4">

                                <h3>English</h3>
                            </div>
                            <div class="col-sm-4">
                                <h3>Русский</h3>
                            </div>
                        </div>


                        <div class="row border_radius text-center">
                            <h4>Text 1</h4>
                            <div class="col-xs-4">
                                <div class="form-group text-center">
                                    <input type="text" name="hy_text_1" class="form-control" placeholder="Հայերեն"
                                           value="{{$product->translate('hy')->text_1}}" >
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group text-center">
                                    <input type="text" name="en_text_1" class="form-control" placeholder="English"
                                           value="{{$product->translate('en')->text_1}}" >

                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group text-center">
                                    <input type="text" name="ru_text_1" class="form-control" placeholder="Русский"
                                           value="{{$product->translate('ru')->text_1}}" >
                                </div>
                            </div>
                        </div>
                        <!--<div class="row border_radius text-center">-->
                        <!--    <h4>Text 2</h4>-->
                        <!--    <div class="col-xs-4">-->
                        <!--        <div class="form-group text-center">-->
                        <!--            <input type="text" name="hy_text_2" class="form-control" placeholder="Հայերեն"-->
                        <!--                   value="{{$product->translate('hy')->text_2}}" >-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-xs-4">-->
                        <!--        <div class="form-group text-center">-->
                        <!--            <input type="text" name="en_text_2" class="form-control" placeholder="English"-->
                        <!--                   value="{{$product->translate('en')->text_2}}" >-->

                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-xs-4">-->
                        <!--        <div class="form-group text-center">-->
                        <!--            <input type="text" name="ru_text_2" class="form-control" placeholder="Русский"-->
                        <!--                   value="{{$product->translate('ru')->text_2}}" >-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="row border_radius text-center">
                            <h4>Text 3</h4>
                            <div class="col-xs-4">
                                <div class="form-group text-center">
                                    <input type="text" name="hy_text_3" class="form-control" placeholder="Հայերեն"
                                           value="{{$product->translate('hy')->text_3}}" >
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group text-center">
                                    <input type="text" name="en_text_3" class="form-control" placeholder="English"
                                           value="{{$product->translate('en')->text_3}}" >

                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group text-center">
                                    <input type="text" name="ru_text_3" class="form-control" placeholder="Русский"
                                           value="{{$product->translate('ru')->text_3}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <input type="hidden" name="image" >
                    </form>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<style>

</style>
<script>
    $uploadCrop = $(".upload-demo2").croppie({
        enableExif: true,
        viewport: {
            width: 1000,
            height: 534
        },
        boundary: {
            width: 1100,
            height: 634
        }
    });

    w = 1349 ;
    h = 720;
</script>