@extends('adminlte::layouts.app')


@section('main-content')

    <section class="content-header text-center">
        <h1>
            {{$category->translate(session('locale'))->name}}

            <small> Category</small>
        </h1>
    </section>
    <div class="row">
        <div class="col-sm-2">
            <button class="btn btn-app" title="Add Category" data-toggle="modal" data-target="#modalAddSubCategory">
                Add
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
        </div>

    </div>
    <table id="table" class="table table-bordered">
        <thead>
        <tr>
            <th>Image</th>
            <th>Հայերեն</th>
            <th>English</th>
            <th>Русский</th>
            <th>Filters</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @php($i = 0)
        @foreach($category->subCategories->sortByDesc('id') as $cat)
            <tr class="{{$cat->id == session('newCat') ? 'active':''}}" data-target="cat_{{$i}}"
                data-href_update="{{route('updateSubCategory')}}" data-prod="{{$cat->link}}"
                data-href_delete="{{route('deleteSubCategory')}}">
                <td>
                    <div class="col-sm-4">
                        <a href="{{route('adminProduct', [
                                       'cat' => $category->link,
                                       'name' => $cat->link])}}">
                        <img src="{{asset('images/subCategory/'.$cat->image_name)}}" class="img-rounded"
                             alt="{{$cat->translate('en')->name}}" width="100%">
                        </a>
                    </div>
                </td>
                <td><a href="{{route('adminProduct', [
                                       'cat' => $category->link,
                                       'name' => $cat->link])}}">
                        {{$cat->translate('hy')->name}}
                    </a>
                </td>
                <td><a href="{{route('adminProduct', [
                                       'cat' => $category->link,
                                       'name' => $cat->link])}}">
                        {{$cat->translate('en')->name}}
                    </a>
                </td>
                <td><a href="{{route('adminProduct', [
                                       'cat' => $category->link,
                                       'name' => $cat->link])}}">
                        {{$cat->translate('ru')->name}}
                    </a>
                </td>
                <td>
                    {{--@foreach($cat->filters as $filter)--}}
                    {{--<div><i class="fa fa-filter"></i> {{$filter->filter->name}}</div>--}}
                    {{--@endforeach--}}
                </td>
                <td>
                    <button class="btn  btn-primary iconUpdate" data-toggle="modal" data-status="cat_{{$i}}"
                            data-target="#modalUpdate">
                        <i class="fa fa-edit"></i>
                        Edit
                    </button>
                    <button class="btn  btn-danger iconDelete" data-toggle="modal" data-status="cat_{{$i}}"
                            data-target="#modalDelete">
                        <i class="fa fa-trash"></i>
                        Delete
                    </button>
                </td>
            </tr>
            @php($i++)
        @endforeach


        </tbody>
    </table>
    @include('vendor.adminlte.modal.modalDelete')
    @include('vendor.adminlte.modal.modalAddSubCategory')
@endsection
@section('script')
    @parent
    <script>
        $uploadCrop1 = $(".upload-demo4").croppie({
            enableExif: true,
            viewport: {
                width: 370,
                height: 300
            },
            boundary: {
                width: 470,
                height: 400
            }
        });

        w1 = 370;
        h1 = 300;


        $uploadCrop = $(".upload-demo3").croppie({
            enableExif: true,
            viewport: {
                width: 500,
                height: 100
            },
            boundary: {
                width: 600,
                height: 120
            }
        });

        w = 2000;
        h = 400;


        @if(session('error') == 'add')
            $('#modalAddSubCategory').modal();
        @endif
    </script>
@endsection

