@extends('adminlte::layouts.app')

{{--@section('htmlheader_title')--}}
{{--{{ trans('adminlte_lang::message.home') }}--}}
{{--@endsection--}}


@section('main-content')
    <section class="content-header text-center">
        <h1>
            Categories
            <small> All</small>
        </h1>
    </section>
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-sm-2">
                <button class="btn btn-app" title="Add Category" data-toggle="modal" data-target="#modalAddCategory">
                    Add
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <table class="table text-center" id="table">
                <thead>
                <tr>
                    <th>Հայերեն</th>
                    <th>English</th>
                    <th>Русский</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @php($i = 0)
                @foreach($categories->sortByDesc('id') as $category)
                    <tr class="{{$category->id == session('newCat') ? 'active':''}}" data-target="cat_{{$i}}"
                        data-href_update="{{route('updateCategory')}}" data-prod="{{$category->link}}"
                        data-href_delete="{{route('deleteCategory')}}">
                        <td>
                            <a href="{{route('adminCategory', ['name' => $category->link])}}">
                                {{$category->translate('hy')->name}}
                            </a>
                        </td>
                        <td>
                            <a href="{{route('adminCategory', ['name' => $category->link])}}">
                            {{$category->translate('en')->name}}
                            </a>
                        </td>
                        <td>
                            <a href="{{route('adminCategory', ['name' => $category->link])}}">
                            {{$category->translate('ru')->name}}
                            </a>
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
        </div>
    </div>
    @include('vendor.adminlte.modal.modalAddCategory')

@endsection
@section('script')
    @parent

    <script>
        @if(session('error') == 'add')
            $('#modalAddCategory').modal();
        @elseif(session('error') == 'edit')

        @endif

    </script>
@endsection
