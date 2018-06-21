@if(isset($messages))
    @foreach($messages as $message)
        <li class="{{$message->user_id == Auth::user()->id ? 'right' : 'left'}} clearfix msg {{$message->status_admin ==0 ? 'seen' : ''}}"
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
@else
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
@endif