@extends('adminlte::layouts.app')

@section('main-content')
    <section class="content-header text-center mb_20">
        <h1>
            {{$product->translate(session('locale'))->name}}
        </h1>
    </section>
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-sm-4">
                <img src="{{asset('images/products/'.$product->images->sortBy('id')->first()['image_name'])}}"
                     class="img-rounded"
                     alt="{{$product->translate('en')->name}}"
                     width="100%"
                >
            </div>
            <div class="col-sm-8">
                {!! $product->translate(session('locale'))->description !!}
            </div>
        </div>
        <div class="row">
            <table class="table table-hover table-bordered icons_form">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Comment Text</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @php($i = 0)
                @if($comments->first())
                    @foreach($comments as $comment)
                        <tr
                                data-href_delete="{{route('deleteComment')}}"
                                data-href_edit="{{route('unpublish_comment')}}"
                                data-prod="{{$comment->id}}"
                                data-target="prod_{{$i}}"
                        >
                            <td>{{$comment->user->name . ' ' . $comment->user->last_nam}}</td>
                            <td>{{$comment->created_at}}</td>
                            <td>{{$comment->product->translate(session('locale'))->name}}</td>
                            <td>{{$comment->text}}</td>
                            <td>

                                <button data-status="prod_{{$i}}" class="btn btn-warning unpublish_comment"
                                        value="{{$comment->published == 0?0:1}}">
                                    <i class="fa fa-globe"></i>
                                    @if($comment->published == 1)
                                        Unpublish
                                    @else
                                        Publish
                                    @endif
                                </button>

                                <button class="btn btn-danger iconDelete"
                                        data-toggle="modal"
                                        data-status="prod_{{$i}}"
                                        data-target="#modalDelete">
                                    <i class="fa fa-trash"></i> Delete
                                </button>

                            </td>
                        </tr>
                        @php($i++)
                    @endforeach
                @endif

                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('script')
    @parent

@endsection
