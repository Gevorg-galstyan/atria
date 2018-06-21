@extends('layouts.app')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{asset('css/user/message.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <ul class="chat">
                            @foreach($messages as $message)
                                <li class="{{$message->user_id == Auth::user()->id ? 'right' : 'left'}} clearfix msg {{$message->status_user ==0 ? 'seen' : ''}}"
                                    data-message="{{$message->id}}">
                                    <div class="chat-body clearfix">
                                        <div class="">
                                            <strong class="{{$message->user_id == Auth::user()->id ? 'pull-right' : ''}} primary-font">
                                                {{$message->user->name}}
                                            </strong>
                                            <div class="col-sm-12">
                                                <div class="{{$message->user_id  == Auth::user()->id ? 'pull-right' : ''}} text-muted">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                    {{$message->created_at}}
                                                </div>
                                            </div>
                                            <div class="col-sm-6 {{$message->user_id  == Auth::user()->id ? 'col-sm-offset-6' : ''}}">
                                                <div class="{{$message->user_id  == Auth::user()->id ? 'pull-right' : ''}}">
                                                    <p>{{$message->text}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <form action="{{route('getMessage',['id' => Auth::user()->href])}}" id="messageSend">
                        <div class="panel-footer">
                            <div class="input-group" id="messageSend">
                                <input id="btn-input" type="text" name="text" class="form-control input-sm messageText "
                                       placeholder="Type your message here..."/>
                                <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm " id="btn-chat">
                                @lang('user.send')</button>
                        </span>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>




@endsection

@section('script')
    @parent
    <script type="text/javascript" src="{{asset('js/user/message.js')}}"></script>
@endsection