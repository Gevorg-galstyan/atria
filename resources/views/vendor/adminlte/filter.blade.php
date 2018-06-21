@extends('adminlte::layouts.app')


@section('main-content')
    <section class="content-header text-center">
        <h1>
            Filters
            <small> All</small>
        </h1>
    </section>
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-sm-2">
                <button class="btn btn-app" title="Add Filter" data-toggle="modal" data-target="#modalAddFilter">
                    Add
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <table class="table text-hover" id="table">
                <thead>
                <tr>
                    <th>Հայերեն</th>
                    <th>English</th>
                    <th>Русский</th>
                    <th>Sub</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @php($i = 0)
                @foreach($filters->sortByDesc('id') as $category)
                    <tr class="{{$category->id == session('newCat') ? 'active':''}}" data-target="cat_{{$i}}"
                        data-prod="{{$category->id}}"
                        data-href_delete="{{route('deleteFilter')}}">

                        <td>{{$category->translate('hy')->name}}</td>
                        <td>{{$category->translate('en')->name}}</td>
                        <td>{{$category->translate('ru')->name}}</td>
                        <td>
                            <ul>
                                @foreach($category->subs as $sub)
                                    <li>{{$sub->name}}</li>
                                @endforeach
                            </ul>

                        </td>
                        <td>
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
    @include('vendor.adminlte.modal.modalAddFilter')

@endsection
@section('script')
    @parent

    <script>
        @if(session('error') == 'add')
            $('#modalAddFilter').modal();
        @elseif(session('error') == 'edit')

        @endif

    </script>
@endsection
