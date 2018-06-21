@extends('adminlte::layouts.app')

@section('main-content')
    <section class="content-header text-center">
        <h1>
            Subscribers
            <small> All</small>
        </h1>
    </section>
    <div class="container-fluid spark-screen">
        <div class="row"
             data-prod="email_"
             data-href_update="{{route('subscribersEmail')}}"
             data-target="email_">

            <button class="btn btn-info pull-right" id="btn_"
                    data-toggle="modal"
                    data-target="#sendSubscribers"
                    data-status="email_"> Send email
            </button>

            <table class="table" id="table">
                <thead>
                <tr>
                    <th>Select All
                        <input id="selectAll" type="checkbox">
                    </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subscribed at</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @php($i =0)
                @foreach($subscribers as $subscriber)
                    <tr data-target="subscriber_{{$i}}"
                        data-prod="{{$subscriber->id}}"
                        data-href_delete="{{route('deleteSubscriber')}}">
                        <td>
                            <input type="checkbox" class="checkbox" name="check[]" data-email="{{$subscriber->email}}">
                        </td>
                        <td>{{$subscriber->name}}</td>
                        <td>{{$subscriber->email}}</td>
                        <td>{{$subscriber->created_at}}</td>
                        <td>
                            <button class="btn  btn-danger iconDelete" data-toggle="modal"
                                    data-status="subscriber_{{$i}}"
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

    @include('vendor.adminlte.modal.modalDelete')
    @include('vendor.adminlte.modal.sendSubscribers')
@endsection
