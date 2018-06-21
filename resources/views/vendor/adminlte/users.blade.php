@extends('adminlte::layouts.app')

{{--@section('htmlheader_title')--}}
{{--{{ trans('adminlte_lang::message.home') }}--}}
{{--@endsection--}}


@section('main-content')
    <section class="content-header text-center">
        <h1>
            Users
            <small> All</small>
        </h1>
    </section>
    <div class="container-fluid spark-screen">
        <div class="row">
            <table class="table" id="table">
                <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Created Date</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    @if($user->rol == 1)
                        @continue
                    @endif
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <a href="{{route('sendMessage', ['id' => $user->href])}}" class="btn btn-app">

                                <span class="badge bg-aqua">
                            {{ count($user->messages->where('status_admin' , 0))?
                            count($user->messages->where('status_admin' , 0)) : ''}}
                        </span>
                                <i class="fa fa-envelope"></i>
                            </a>

                        </td>
                        <td>

                            <input type="checkbox" data-toggle="toggle" class="blockUser"
                                   data-href="{{route('blockUser')}}"
                                   data-user="{{$user->href}}" {{$user->block ? 'checked' : "" }}>
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>
    </div>



@endsection
