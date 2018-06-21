@extends('layouts.app')
@section('head')
    @parent
    <link href="{{asset('css/user/profile.css')}}" rel="stylesheet">
@endsection



@section('content')
    <!-- nav bar -->

    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <ul class="nav nav-pills nav-stacked nav-email shadow mb-20">

                    <li class="{{Request::segment(3) == 'send' ? 'active' : ''}}">
                        <a href="{{route('userGetMessage', ['id' => $user->href])}}"><i class="fa fa-envelope-o"></i> @lang('user.connectInAdmin')</a>
                    </li>

                    <li class="hidden {{Request::segment(3) == 'purchases' ? 'active' : ''}}">
                        <a href="{{route('userPurchases', ['id' => $user->href])}}">
                            <i class="fa fa-shopping-cart"></i> @lang('user.purchases')
                        </a>
                    </li>
                    <li {{Request::segment(3) == 'settings' ? 'active' : ''}}>
                        <a href="{{route('userSettings', ['id' => $user->href])}}">
                            <i class="fa fa-cog" aria-hidden="true"></i> @lang('user.settings')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" data-tooltip="tooltip" data-placement="bottom"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out" aria-hidden="true"></i> @lang('user.logout')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul><!-- /.nav -->

            </div>
            <div class="col-sm-9">

                <!-- resumt -->
                <div class="panel panel-default">
                    <div class="panel-heading resume-heading">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="col-xs-12 col-sm-8">
                                    <ul class="list-group">
                                        <li class="list-group-item">{{$user->name}}</li>
                                        <li class="list-group-item">{{$user->last_name}}</li>
                                        <li class="list-group-item">{{$user->address}}</li>
                                        <li class="list-group-item"><i class="fa fa-phone"></i> {{$user->phone}}</li>
                                        <li class="list-group-item"><i class="fa fa-envelope"></i> {{$user->email}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- resume -->

        </div>
    </div>
@endsection