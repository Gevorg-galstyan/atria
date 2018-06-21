@extends('adminlte::layouts.app')


@section('main-content')
    <section class="content-header text-center">
        <h1>
            {{$sub->translate(session('locale'))->name}}
            <small>Products</small>
        </h1>
    </section>



<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <button class="btn btn-app" title="Add Product" data-toggle="modal" data-target="#modalAddProduct">
                Add
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <table id="table" class="table table-bordered">
        <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Colors</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @php($i = 0)
        @foreach($products->sortByDesc('id') as $product)
            <tr class="{{$product->id == session('newCat') ? 'active':''}}" data-target="prod_{{$i}}"
                data-href_update="{{route('updateProduct')}}" data-prod="{{$product->link}}"
                data-href_delete="{{route('deleteProduct')}}">
                <td>
                    <div class="col-sm-4">
                        <img src="{{asset('images/products/'.$product->images->sortBy('id')->first()['image_name'])}}"
                             class="img-rounded"
                             alt="{{$product->translate('en')->name}}"
                             width="100%">
                    </div>
                    <div class="col-sm-2">
                        <a href="{{route('adminGetComment',['id'=>$product->id])}}">
                            <i class="fa fa-comment-o fs-22" aria-hidden="true"></i>
                        </a>

                    </div>
                </td>
                <td>
                    <div class="col-sm-12">
                        <b>Հաըերեն</b>: {{$product->translate('hy')->name}}
                    </div>
                    <div class="col-sm-12">
                        <b>English</b> : {{$product->translate('en')->name}}
                    </div>
                    <div class="col-sm-12">
                        <b>Русский</b> : {{$product->translate('ru')->name}}
                    </div>
                </td>
                <td>

                    <div class="">
                        @foreach($product->colors->sortBy('id') as $color)
                            <div class="col-sm-3 no_padd_left"><span class='' style="color: {{$color->color}}"><i class="fa fa-square fa-2x"></i></span></div>
                        @endforeach
                    </div>
 




                </td>
                <td>
                    <div class="btn-group">
                        <button class="btn  btn-primary iconUpdate" type="button" data-toggle="modal" data-status="prod_{{$i}}"
                                data-target="#modalUpdate">
                            <i class="fa fa-edit"></i>
                            Edit
                        </button>

                        <button class="btn  btn-danger iconDelete"  type="button" data-toggle="modal" data-status="prod_{{$i}}"
                                data-target="#modalDelete">
                            <i class="fa fa-trash"></i>
                            Delete
                        </button>
</div>
                </td>
            </tr>
            @php($i++)
        @endforeach


        </tbody>
    </table>
</div>

    @include('vendor.adminlte.modal.modalAddProduct')
@endsection
@section('script')
    @parent
    {{--<script>--}}
    {{--$uploadCrop = $(".upload-demo4").croppie({--}}
    {{--enableExif: true,--}}
    {{--viewport: {--}}
    {{--width: 370,--}}
    {{--height: 300--}}
    {{--},--}}
    {{--boundary: {--}}
    {{--width: 470,--}}
    {{--height: 400--}}
    {{--}--}}
    {{--});--}}
    {{--w = 370 ;--}}
    {{--h = 300;--}}
    {{--@if(session('error') == 'add')--}}
    {{--$('#modalAddSubCategory').modal();--}}
    {{--@endif--}}
    {{--</script>--}}
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('hy_description');
            CKEDITOR.replace('en_description');
            CKEDITOR.replace('ru_description');
            //bootstrap WYSIHTML5 - text editor
//            $(".textarea").wysihtml5();
        });
    </script>
@endsection

