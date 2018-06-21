<div class="panel panel-primary">
    <div class="panel-body">
        <ul class="chat">
            @foreach($messages as $message)
                <li class="{{$message->user_id == Auth::user()->id ? 'right' : 'left'}} clearfix msg {{$message->status_admin == 0 ? 'seen' : ''}}"
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
    <form action="{{route('getMessageAdmin',['id' => $user->href])}}" id="messageSend">
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