@extends('adminlte::layouts.app')


@section('main-content')
    <section class="content-header text-center">
        <h1>
            New Comments
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
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Comment Text</th>
                </tr>
                </thead>
                <tbody>
                @php($i = 0)
                @foreach($comments->sortByDesc('id') as $comment)
                    <tr>

                        <td>{{$comment->user->name . ' ' . $comment->user->last_nam}}</td>
                        <td>{{$comment->created_at}}</td>
                        <td>{{$comment->product->translate(session('locale'))->name}}</td>
                        <td>{{$comment->text}}</td>
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

@endsection
@section('script')
    @parent

@endsection
