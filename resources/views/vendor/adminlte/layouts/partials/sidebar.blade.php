<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                </div>
            </div>
    @endif

    <!-- search form (Optional) -->
    {{--<form action="#" method="get" class="sidebar-form">--}}
    {{--<div class="input-group">--}}
    {{--<input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>--}}
    {{--<span class="input-group-btn">--}}
    {{--<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>--}}
    {{--</span>--}}
    {{--</div>--}}
    {{--</form>--}}
    <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{ route('home') }}"><i
                            class='fa fa-home'></i>
                    <span>Home</span></a></li>
            <li class="{{!Request::url() == route('admin')? 'active' : '' }}"><a href="{{ route('admin') }}"><i
                            class='fa fa-home'></i>
                    <span>Admin Home</span></a></li>
            <li><a href="{{ route('site') }}">
                    <i class='fa fa-home'></i>
                    <span>Edit Home Page</span></a>
            </li>

            <li class="{{Request::segment(2) == 'about' ? 'active' : ''}}"><a href="{{route('aboutus')}}"><i
                            class="fa fa-info" aria-hidden="true"></i>
                    <span>About Us</span></a></li>

            <li class="{{Request::url() == route('getUsers') ? 'active' : ''}}"><a href="{{route('getUsers')}}"><i
                            class="fa fa-users" aria-hidden="true"></i>
                    <span>Users</span>
                    @if(count($users_count->where('new', 0 ))!= 0)
                        <span class="pull-right label label-danger">New {{count($users_count->where('new', 0 ))}}</span>
                    @endif
                    <span class="pull-right label label-success">All {{count($users_count)}}</span>
                </a></li>

            <li class="{{Request::url() == route('getSubscribers') ? 'active' : ''}}"><a
                        href="{{route('getSubscribers')}}"><i
                            class="fa fa-users" aria-hidden="true"></i>
                    <span>Subscribers</span>
                    @if(count($subscriber_count->where('new', 0 ))!= 0)
                        <span class="pull-right label label-danger">New {{count($subscriber_count->where('new', 0 ))}}</span>
                    @endif
                    <span class="pull-right label label-success">All {{count($subscriber_count)}}</span>
                </a></li>

            <li class="{{Request::url() == route('adminMessages') ? 'active' : ''}}"><a
                        href="{{route('adminMessages')}}"><i
                            class='fa fa-envelope-o'></i>
                    <span>Messages</span></a></li>
            <li class="treeview
                        {{Request::url() == route('adminCategories')
                        || Request::url()  == route('adminCategory')
                        || Request::url() == route('adminProduct')
                        ||Request::segment(2) || Request::segment(3) == 'category'
                        ? 'active' : '' }}">
                <a href="#">
                    <i class='fa fa-list'></i>
                    <span>Category</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{Request::url() == route('adminCategories')
                                ? 'active' : ''}}">
                        <a href="{{route('adminCategories')}}">
                            <i class='fa fa-list'></i>
                            All Categories
                        </a>
                    </li>
                    @foreach($categories->sortBydesc('id') as $category)
                        <li class="treeview {{Request::segment(3) || Request::segment(4) == $category->link
                        ? 'active' : ''}}">
                            <a href="#0">
                                {{$category->translate(session('locale'))->name}}
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="treeview
                                    {{Request::url() == route('adminCategory', ['name' => $category->link])
                                    ? 'active' : ''}}">
                                    <a href="{{route('adminCategory', ['name' => $category->link])}}">
                                        All Sub Categories
                                    </a>
                                </li>
                                @foreach($category->subCategories->sortBydesc('id') as $subCategory)
                                    <li class="{{Request::url() == route('adminProduct', [
                                       'cat' => $category->link,
                                       'name' => $subCategory->link
                                       ])? 'active' : ''}}">
                                        <a href="{{route('adminProduct', [
                                       'cat' => $category->link,
                                       'name' => $subCategory->link
                                       ])}}">
                                            {{$subCategory->translate(session('locale'))->name}}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                    @endforeach
                </ul>
            </li>

            {{--<li class="{{Request::segment(2) == 'filters' ? 'active' : ''}}"><a href="{{route('getFilter')}}">--}}
            {{--<i class="fa fa-filter" aria-hidden="true"></i>--}}
            {{--<span>Filters</span></a></li>--}}

            <li class="{{Request::segment(2) == 'icons' ? 'active' : ''}}"><a href="{{route('icons')}}"><i
                            class="fa fa-users" aria-hidden="true"></i>
                    <span>Social Icons</span></a></li>


        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
