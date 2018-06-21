<div class="modal fade" id="sendSubscribers" tabindex="-1" role="dialog" style="z-index: 9999999">
    <div class="modal-dialog" role="document" >
        <div class="text-center loaderSite" style="display: none;">
            <div class="modal-content">
                <img src="{{asset('images/load.gif')}}" alt="">
            </div>
        </div>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="box-header with-border text-center">
                    <h3 class="box-title">Email Text</h3>
                </div>
                <div class="box box-primary">

                    <div class="box-body">

                        <form action="{{route('subscribersEmail')}}" class="form_subscribers" method="post">
                            {{csrf_field()}}

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h3>Subject</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group text-center">
                                        <input type="text" name="name" class="form-control" placeholder="Subject" required>
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
                                        <textarea name="description" rows="10" cols="80"> </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Send</button>
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

