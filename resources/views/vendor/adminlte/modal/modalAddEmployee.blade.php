<div id="modalAddEmployee" class="modal fade" role="dialog" style="z-index: 9999999">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <div class="box-header with-border text-center">
                    <h3 class="box-title">Add An Employee</h3>
                </div>
                <div class="box box-primary">

                    <div class="box-body">

                        <form action="{{route('addEmployee')}}" class="formImage" method="post">
                            {{csrf_field()}}


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="upload-demo2">
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
                                    <div class="form-group text-center {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label>Հայերեն</label>
                                        <input type="text" name="hy_name" class="form-control" placeholder="Հայերեն"
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
                                        <input type="text" name="en_name" class="form-control" placeholder="English"
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
                                        <input type="text" name="ru_name" class="form-control" placeholder="Русский"
                                               value="{{old('ru_name')}}" required>
                                        @if ($errors->has('ru_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('ru_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> <!--name-->

                            <!--position-->
                            <div class="row">
                                <h3>Position</h3>
                                <div class="col-xs-4">
                                    <div class="form-group text-center {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label>Հայերեն</label>
                                        <input type="text" name="hy_position" class="form-control" placeholder="Հայերեն"
                                               value="{{old('hy_position')}}">
                                        @if ($errors->has('hy_position'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('hy_position') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group text-center {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label>English</label>
                                        <input type="text" name="en_position" class="form-control" placeholder="English"
                                               value="{{old('en_position')}}">
                                        @if ($errors->has('en_position'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('en_position') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group text-center {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label>Русский</label>
                                        <input type="text" name="ru_position" class="form-control" placeholder="Русский"
                                               value="{{old('ru_position')}}">
                                        @if ($errors->has('ru_position'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('ru_position') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--position-->


                            <!--about emploee-->
                            <div class="row">
                                <h3>About Employee</h3>
                                <div class="col-xs-4">
                                    <div class="form-group text-center {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label>Հայերեն</label>
                                        <input type="text" name="hy_text" class="form-control" placeholder="Հայերեն"
                                               value="{{old('hy_text')}}">
                                        @if ($errors->has('hy_text'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('hy_text') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group text-center {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label>English</label>
                                        <input type="text" name="en_text" class="form-control" placeholder="English"
                                               value="{{old('en_text')}}">
                                        @if ($errors->has('en_text'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('en_text') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group text-center {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label>Русский</label>
                                        <input type="text" name="ru_text" class="form-control" placeholder="Русский"
                                               value="{{old('ru_text')}}">
                                        @if ($errors->has('ru_text'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('ru_text') }}</strong>
                                            </span>
                                        @endif
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
                                                                  id="href"></div>
                                </div>
                                <div class="row">
                                    <label col-sm-2> <a data-tooltip="tooltip" data-placement="top" href="#"> <i
                                                    class="fa fa-google-plus"></i> </a></label>
                                    <div class="col-sm-10"><input type="text" name="google" class="form-control"
                                                                  id="href"></div>
                                </div>
                                <div class="row">
                                    <label col-sm-2> <a data-tooltip="tooltip" data-placement="top" href="#"> <i
                                                    class="fa fa-twitter"></i> </a></label>
                                    <div class="col-sm-10"><input type="text" name="twitter" class="form-control"
                                                                  id="href"></div>
                                </div>
                                <div class="row">
                                    <label col-sm-2> <a data-tooltip="tooltip" data-placement="top" href="#"> <i
                                                    class="fa fa-linkedin"></i> </a></label>
                                    <div class="col-sm-10"><input type="text" name="linkedin" class="form-control"
                                                                  id="href"></div>
                                </div>
                                <div class="row">
                                    <label col-sm-2> <a data-tooltip="tooltip" data-placement="top" href="#"> <i
                                                    class="fa fa-pinterest"></i> </a></label>
                                    <div class="col-sm-10"><input type="text" name="pinterest" class="form-control"
                                                                  id="href"></div>
                                </div>
                                <div class="row">
                                    <label col-sm-2> <a data-tooltip="tooltip" data-placement="top" href="#"> <i
                                                    class="fa fa-skype"></i> </a></label>
                                    <div class="col-sm-10"><input type="text" name="skype" class="form-control"
                                                                  id="href"></div>
                                </div>
                                <div class="row">
                                    <label col-sm-2> <a data-tooltip="tooltip" data-placement="top" href="#"> <i
                                                    class="fa fa-vimeo"></i> </a></label>
                                    <div class="col-sm-10"><input type="text" name="vimeo" class="form-control"
                                                                  id="href"></div>
                                </div>
                                <div class="row">
                                    <label col-sm-2> <a data-tooltip="tooltip" data-placement="top" href="#"> <i
                                                    class="fa fa-youtube"></i> </a></label>
                                    <div class="col-sm-10"><input type="text" name="youtube" class="form-control"
                                                                  id="href"></div>
                                </div>
                                <div class="row">
                                    <label col-sm-2> <a data-tooltip="tooltip" data-placement="top" href="#"> <i
                                                    class="fa fa-instagram"></i> </a></label>
                                    <div class="col-sm-10"><input type="text" name="instagram" class="form-control"
                                                                  id="href"></div>
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

    </div>
</div>

