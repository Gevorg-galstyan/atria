<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <div class="box-header with-border text-center">
            <h3 class="box-title">Change Cover</h3>
        </div>
        <div class="box box-primary">

            <div class="box-body">

                <form action="{{route('change_cover')}}" class="formImage" method="post">
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
            width: 1000,
            height: 200
        },
        boundary: {
            width: 1200,
            height: 300
        }
    });

    w = 2000;
    h = 400;
</script>
