
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="box-header with-border text-center">
                    <h3 class="box-title">Edit An Employee</h3>
                </div>
                <div class="box box-primary">

                    <div class="box-body">

                        <form action="{{route('editEmployee',['id' => $product->id])}}" class="formImage" method="post">
                            {{csrf_field()}}

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="upload-demo1">
                                        <input type="file" name="" id="file" class="input-file  upload2">
                                        <label for="file" class="btn btn-tertiary js-labelFile">
                                            <i class="icon fa fa-check"></i>
                                            <span class="js-fileName">Change a Image</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!--name-->
                            <div class="row">
                                <h3>Name</h3>
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
                            </div> <!--name-->

                            <!--position-->
                            <div class="row">
                                <h3>Position</h3>
                                <div class="col-xs-4">
                                    <div class="form-group text-center">
                                        <label>Հայերեն</label>
                                        <input type="text" name="hy_position" class="form-control" placeholder="Հայերեն"
                                               value="{{$product->translate('hy')->position}}">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group text-center">
                                        <label>English</label>
                                        <input type="text" name="en_position" class="form-control" placeholder="English"
                                               value="{{$product->translate('en')->position}}">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group text-center">
                                        <label>Русский</label>
                                        <input type="text" name="ru_position" class="form-control" placeholder="Русский"
                                               value="{{$product->translate('ru')->position}}">
                                    </div>
                                </div>
                            </div>
                            <!--position-->


                            <!--about emploee-->
                            <div class="row">
                                <h3>About Employee</h3>
                                <div class="col-xs-4">
                                    <div class="form-group text-center">
                                        <label>Հայերեն</label>
                                        <input type="text" name="hy_text" class="form-control" placeholder="Հայերեն"
                                               value="{{$product->translate('hy')->text}}">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group text-center">
                                        <label>English</label>
                                        <input type="text" name="en_text" class="form-control" placeholder="English"
                                               value="{{$product->translate('en')->text}}">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group text-center">
                                        <label>Русский</label>
                                        <input type="text" name="ru_text" class="form-control" placeholder="Русский"
                                               value="{{$product->translate('ru')->text}}">
                                    </div>
                                </div>
                            </div>
                            <!--about emploee-->

                            <!--social-->
                            <div class="row">
                                <h3>Social Links</h3>
                                <div class="row">
                                    <label col-sm-2> <a data-tooltip="tooltip" data-placement="top" href="#"> <i
                                                    class="fa fa-facebook"></i> </a></label>
                                    <div class="col-sm-10"><input type="text" name="facebook" class="form-control"
                                            id="href" value="{{$product->employee_social->facebook}}"></div>
                                </div>
                                <div class="row">
                                    <label col-sm-2> <a data-tooltip="tooltip" data-placement="top" href="#"> <i
                                                    class="fa fa-google-plus"></i> </a></label>
                                    <div class="col-sm-10"><input type="text" name="google" class="form-control"
                                           value="{{$product->employee_social->google}}" id="href"></div>
                                </div>
                                <div class="row">
                                    <label col-sm-2> <a data-tooltip="tooltip" data-placement="top" href="#"> <i
                                                    class="fa fa-twitter"></i> </a></label>
                                    <div class="col-sm-10"><input type="text" name="twitter" class="form-control"
                                             value="{{$product->employee_social->twitter}}" id="href"></div>
                                </div>
                                <div class="row">
                                    <label col-sm-2> <a data-tooltip="tooltip" data-placement="top" href="#"> <i
                                                    class="fa fa-linkedin"></i> </a></label>
                                    <div class="col-sm-10"><input type="text" name="linkedin" class="form-control"
                                           value="{{$product->employee_social->linkedin}}" id="href"></div>
                                </div>
                                <div class="row">
                                    <label col-sm-2> <a data-tooltip="tooltip" data-placement="top" href="#"> <i
                                                    class="fa fa-pinterest"></i> </a></label>
                                    <div class="col-sm-10"><input type="text" name="pinterest" class="form-control"
                                            value="{{$product->employee_social->pinterest}}" id="href"></div>
                                </div>
                                <div class="row">
                                    <label col-sm-2> <a data-tooltip="tooltip" data-placement="top" href="#"> <i
                                                    class="fa fa-skype"></i> </a></label>
                                    <div class="col-sm-10"><input type="text" name="skype" class="form-control"
                                          value="{{$product->employee_social->skype}}" id="href"></div>
                                </div>
                                <div class="row">
                                    <label col-sm-2> <a data-tooltip="tooltip" data-placement="top" href="#"> <i
                                                    class="fa fa-vimeo"></i> </a></label>
                                    <div class="col-sm-10"><input type="text" name="vimeo" class="form-control"
                                          value="{{$product->employee_social->vimeo}}" id="href"></div>
                                </div>
                                <div class="row">
                                    <label col-sm-2> <a data-tooltip="tooltip" data-placement="top" href="#"> <i
                                                    class="fa fa-youtube"></i> </a></label>
                                    <div class="col-sm-10"><input type="text" name="youtube" class="form-control"
                                           value="{{$product->employee_social->youtube}}"  id="href"></div>
                                </div>
                                <div class="row">
                                    <label col-sm-2> <a data-tooltip="tooltip" data-placement="top" href="#"> <i
                                                    class="fa fa-instagram"></i> </a></label>
                                    <div class="col-sm-10"><input type="text" name="instagram" class="form-control"
                                         value="{{$product->employee_social->instagram}}" id="href"></div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                            <input type="hidden" name="image">
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

        <script>
            $uploadCrop = $(".upload-demo1").croppie({
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
