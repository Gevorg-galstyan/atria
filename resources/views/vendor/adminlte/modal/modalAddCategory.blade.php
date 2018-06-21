<div id="modalAddCategory" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <div class="box-header with-border text-center">
                    <h3 class="box-title">Add Category</h3>
                </div>
                <div class="box box-primary">

                    <div class="box-body">

                        <form action="{{route('addCategory')}}" method="post">
                            {{csrf_field()}}
                            <div class="row">
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

                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        </div>

    </div>
</div>
