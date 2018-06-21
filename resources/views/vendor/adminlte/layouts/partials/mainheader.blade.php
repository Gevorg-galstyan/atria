<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ route('admin') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b> P</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b> Panel</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">


                {{--comment--}}
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-comment-o" aria-hidden="true"></i>
                        <span class="label label-success">
                            {{ count($newComments->where('new' , 0))?
                            count($newComments->where('new' , 0)) : ''}}
                        </span>
                    </a>

                    @if(count($newComments->where('new', 0)))
                        <ul class="dropdown-menu">
                            <li class="header">
                                You have {{ count($newComments->where('new' , 0))}} comments
                            </li>

                            @foreach($newComments ->where('new' , 0)->sortByDesc('id')->take(3) as $comment)
                                <li>
                                    <!-- inner menu: contains the comment -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="{{route('adminGetComment', ['id' => $comment->product->id])}}">
                                                <div class="pull-left">
                                                    <img
                                                            src="{{asset('images/products/'.$comment
                                                            ->product
                                                            ->images
                                                            ->sortBy('id')
                                                            ->first()['image_name'])}}"
                                                            class="{{$comment
                                                            ->product
                                                            ->translate('en')
                                                            ->name}}"
                                                            alt=""
                                                            width="100%">
                                                </div>

                                                <h4>

                                                    Product {{$comment->product->translate(session('locale'))->name}}
                                                    @if($comment->new == 0)
                                                        <span class="pull-right label label-success">New</span>
                                                    @endif
                                                </h4>
                                                <!-- The comment -->

                                                <p>{{str_limit($comment->text, 30)}}</p>
                                                <small><i class="fa fa-clock-o"></i>{{$comment->created_at}}</small>
                                            </a>
                                        </li><!-- end message -->
                                    </ul><!-- /.menu -->
                                </li>
                            @endforeach

                            <li class="footer"><a href="{{route('adminGetComment', ['id' => 'all'])}}">See All</a></li>
                        </ul>
                    @endif

                </li><!-- /.comment-menu -->


                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">
                            {{ count(Auth::user()->messagesSeen->where('status_admin' , 0))?
                            count(Auth::user()->messagesSeen->where('status_admin' , 0)) : ''}}
                        </span>
                    </a>
                    @if(count(Auth::user()->messagesSeen->where('status_admin' , 0)))
                        <ul class="dropdown-menu">
                            <li class="header">
                                You have {{count(Auth::user()->messagesSeen->where('status_admin' , 0))}} messages
                            </li>
                            @foreach(Auth::user()->messagesSeen->where('status_admin' , 0) as $msg)
                                <li>
                                    <!-- inner menu: contains the messages -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="{{route('sendMessage', ['id' => $msg->user->href])}}">
                                                <div class="pull-left">
                                                    <!-- User Image -->
                                                </div>
                                                <!-- Message title and timestamp -->
                                                <h4>
                                                    {{$msg->user->name.' '.$msg->user->last_name}}
                                                    <small><i class="fa fa-clock-o"></i>{{$msg->created_at}}</small>
                                                </h4>
                                                <!-- The message -->
                                                <p>{{str_limit($msg->text, 30)}}</p>
                                            </a>
                                        </li><!-- end message -->
                                    </ul><!-- /.menu -->
                                </li>
                            @endforeach
                            <li class="footer"><a href="#">c</a></li>
                        </ul>
                    @endif
                </li><!-- /.messages-menu -->


                <!-- Notifications Menu -->
                {{--<li class="dropdown notifications-menu">--}}
                {{--<!-- Menu toggle button -->--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                {{--<i class="fa fa-bell-o"></i>--}}
                {{--<span class="label label-warning">10</span>--}}
                {{--</a>--}}
                {{--<ul class="dropdown-menu">--}}
                {{--<li class="header">{{ trans('adminlte_lang::message.notifications') }}</li>--}}
                {{--<li>--}}
                {{--<!-- Inner Menu: contains the notifications -->--}}
                {{--<ul class="menu">--}}
                {{--<li><!-- start notification -->--}}
                {{--<a href="#">--}}
                {{--<i class="fa fa-users text-aqua"></i> {{ trans('adminlte_lang::message.newmembers') }}--}}
                {{--</a>--}}
                {{--</li><!-- end notification -->--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="footer"><a href="#">{{ trans('adminlte_lang::message.viewall') }}</a></li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--<!-- Tasks Menu -->--}}
                {{--<li class="dropdown tasks-menu">--}}
                {{--<!-- Menu Toggle Button -->--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                {{--<i class="fa fa-flag-o"></i>--}}
                {{--<span class="label label-danger">9</span>--}}
                {{--</a>--}}
                {{--<ul class="dropdown-menu">--}}
                {{--<li class="header">{{ trans('adminlte_lang::message.tasks') }}</li>--}}
                {{--<li>--}}
                {{--<!-- Inner menu: contains the tasks -->--}}
                {{--<ul class="menu">--}}
                {{--<li><!-- Task item -->--}}
                {{--<a href="#">--}}
                {{--<!-- Task title and progress text -->--}}
                {{--<h3>--}}
                {{--{{ trans('adminlte_lang::message.tasks') }}--}}
                {{--<small class="pull-right">20%</small>--}}
                {{--</h3>--}}
                {{--<!-- The progress bar -->--}}
                {{--<div class="progress xs">--}}
                {{--<!-- Change the css width attribute to simulate progress -->--}}
                {{--<div class="progress-bar progress-bar-aqua" style="width: 20%"--}}
                {{--role="progressbar" aria-valuenow="20" aria-valuemin="0"--}}
                {{--aria-valuemax="100">--}}
                {{--<span class="sr-only">20% {{ trans('adminlte_lang::message.complete') }}</span>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</a>--}}
                {{--</li><!-- end task item -->--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="footer">--}}
                {{--<a href="#">{{ trans('adminlte_lang::message.alltasks') }}</a>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                @if (Auth::guest())
                    <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                    <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                @else
                <!-- User Account Menu -->
                    <li class="dropdown user user-menu" id="user_menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{ Gravatar::get($user->email) }}" class="user-image" alt="User Image"/>
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image"/>
                                <p>
                                    {{ Auth::user()->name }}

                                </p>
                            </li>
                            <!-- Menu Body -->
                        {{--<li class="user-body">--}}
                        {{--<div class="col-xs-4 text-center">--}}
                        {{--<a href="#">{{ trans('adminlte_lang::message.followers') }}</a>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-4 text-center">--}}
                        {{--<a href="#">{{ trans('adminlte_lang::message.sales') }}</a>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-4 text-center">--}}
                        {{--<a href="#">{{ trans('adminlte_lang::message.friends') }}</a>--}}
                        {{--</div>--}}
                        {{--</li>--}}
                        <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{route('settings')}}"
                                       class="btn btn-default btn-flat">{{ trans('adminlte_lang::message.profile') }}</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}" data-tooltip="tooltip"
                                    class="btn btn-default btn-flat"
                                                   data-placement="bottom" title="Logout"
                                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    @lang('user.logout') <i class="fa fa-sign-out" aria-hidden="true"></i>
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                      style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                    

                                </div>
                            </li>
                        </ul>
                    </li>
                @endif

            <!-- Control Sidebar Toggle Button -->
                {{--<li>--}}
                {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </nav>
</header>
