<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <div class="box-header with-border text-center">
            <h2 class="box-title">Do you really want to hide this block?</h2>
        </div>
        <div class="box box-primary">

            <div class="box-body">

                <form action="{{route('hideBlock')}}" class="formImage" method="post">
                    {{csrf_field()}}

                    <div class="radio">
                        <label>
                            <input type="radio" name="radio" value="1" {{$product->hide == 1 ? 'checked': ''}}>
                            Hide
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="radio" value="0" {{$product->hide == 0 ? 'checked': ''}}>
                            Show
                        </label>
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
