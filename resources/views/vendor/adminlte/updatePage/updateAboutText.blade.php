<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <div class="box-header with-border text-center">
            <h3 class="box-title">Edit About Us Text</h3>
        </div>
        <div class="box box-primary">

            <div class="box-body">

                {{--@php(dd($product))--}}

                <form action="{{route('change_about_text')}}" class="formImage" method="post">
                    {{csrf_field()}}

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3>Header</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group text-center">
                                <label>Հայերեն</label>
                                <input type="text" name="hy_name" class="form-control" placeholder="Հայերեն"
                                       value="{{$product->translate('hy')->header}}" required>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group text-center">
                                <label>English</label>
                                <input type="text" name="en_name" class="form-control" placeholder="English"
                                       value="{{$product->translate('en')->header}}" required>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group text-center">
                                <label>Русский</label>
                                <input type="text" name="ru_name" class="form-control" placeholder="Русский"
                                       value="{{$product->translate('ru')->header}}" required>
                            </div>
                        </div>
                    </div> <!--name-->

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3>Text</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group text-center">
                                <label for="hy_description">Հայերեն</label>
                                <textarea name="hy_description1" rows="10" cols="80">
{{$product->translate('hy')->description}}
                                    </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group text-center">
                                <label for="en_description">English</label>
                                <textarea name="en_description1" rows="10" cols="80">
{{$product->translate('en')->description}}
                                    </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group text-center">
                                <label for="ru_description">Русский</label>
                                <textarea name="ru_description1" rows="10" cols="80">
{{$product->translate('ru')->description}}
                                    </textarea>
                            </div>
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
    $(function () {
        CKEDITOR.replace('hy_description1');
        CKEDITOR.replace('en_description1');
        CKEDITOR.replace('ru_description1');
    });
</script>