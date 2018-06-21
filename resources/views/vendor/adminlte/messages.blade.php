@extends('adminlte::layouts.app')

@section('link')
    <link href="{{ asset('/css/admin/message.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('main-content')

    <section class="content-header text-center">
        <h1>
            Messages
            <small> All</small>
        </h1>
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <div class="list-group">
                    @foreach($users  as $user)
                        @if($user->rol == 1)
                            @continue
                        @endif
                        <a href="#" class="list-group-item list-group-item-action message_user"
                           data-user="{{$user->href}}" data-href="{{route('messageUser')}}">
                            <div class="text-center">
                                <b>{{$user->name}}</b>
                                <span class="badge bg-aqua">
                                    {{ count($user->messages->where('status_admin' , 0))?
                                    count($user->messages->where('status_admin' , 0)) : ''}}
                                </span>
                            </div>
                            <div class="">
                                @if($user->messages->sortByDesc('id')->first()['id'] > $user->messagesSeen->sortByDesc('id')->first()['id'])
                                    <p>{{str_limit($user->messages->sortByDesc('id')->first()['text'], 50)}}</p>
                                    <div class="">{{$user->messages->sortByDesc('id')->first()['created_at']}}</div>
                                @else
                                    <p>{{str_limit($user->messagesSeen->sortByDesc('id')->first()['text'], 50)}}</p>
                                    <div class="">{{$user->messagesSeen->sortByDesc('id')->first()['created_at']}}</div>
                                @endif
                            </div>
                        </a>

                    @endforeach
                </div>
            </div>
            <div class="col-md-8">
                <div class="message_content">

                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    @parent
    <script src="{{asset('js/admin/message.js')}}"></script>
@endsection
