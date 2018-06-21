<header class="header">
    <div class="container-full">
        <nav class="navbar navbar-inverse yamm">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="  r"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" alt=""></a>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="{{Request::url() == route('home') ?'active':''}}">
                            <a href="{{route('home')}}"> @lang('header.home') </a>
                        </li>
                        <li><a href="{{route('about')}}">@lang('header.about')</a></li>
                        <li class="dropdown yamm-fw">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false"> @lang('header.shop') <span
                                        class="fa fa-angle-down"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="yamm-content container">
                                        @foreach($categories->sortByDesc('id')->chunk(4) as $chunk)
                                            <div class="row">
                                                @foreach($chunk as $category)
                                                    <div class="col-md-3">
                                                        <div class="widget">
                                                            <div class="widget-title">
                                                                <h4>{{$category->translate(session('locale'))->name}}</h4>
                                                                <hr>
                                                            </div><!-- end widget-title -->

                                                            <ul class="dropdown-mega">
                                                                @foreach($category->subCategories->sortByDesc('id') as $subCategory)
                                                                    <li>
                                                                        <a href="{{route('getCategory', [
                                                                        'cat' => $subCategory->link])}}">
                                                                            {{$subCategory->translate(session('locale'))->name}}
                                                                            <span> ({{count($subCategory->products)}}
                                                                                )</span>
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div><!-- end ttmenu-content -->
                                </li>
                            </ul>
                        </li>
                        <li><a href="{{route('sales')}}">@lang('index.sales')</a></li>

                        <li><a href="{{route('contactus')}}">@lang('header.contact')</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right searchandbag">
                        @if(count($social_icons->where('link', '!=', null)) > 0)
                            <li class="dropdown hasmenu shopcartmenu">
                                <a href="#" class="dropdown-toggle cart" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    <i class="fa fa-chain-broken"></i>
                                </a>

                                @if($social_icons->where('link', '!=', null)->first())
                                    <ul class="dropdown-menu icon-dropdown start-right" role="menu">
                                        @foreach($social_icons as $icons)
                                            @if($icons->link)
                                                <li class="facebook pad_3 pull-left">
                                                    @if($icons->icon_code == "fa fa-skype")
                                                        <a href="skype:{{$icons->link}}?chat"> <i
                                                                    class="{{$icons->icon_code}}"></i></a>
                                                    @else
                                                        <a target="_blank"
                                                           href="{{$icons->link}}">
                                                            <i class="{{$icons->icon_code}}"></i>
                                                        </a>
                                                    @endif
                                                </li>

                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                        <li class="dropdown hasmenu shopcartmenu cart-container">
                            @include('includes.newCartItem')
                        </li>
                        <li class="dropdown searchdropdown hasmenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false"><i class="fa fa-search"></i></a>
                            <ul class="dropdown-menu show-right">
                                <li>

                                    <form action="{{route('search')}}" method="post">

                                        <div id="custom-search-input">
                                            <div class="input-group col-md-12">
                                                <input
                                                        id="searchArea"
                                                        type="text"
                                                        name="word"
                                                        class="form-control input-lg"
                                                        placeholder="@lang('header.search')"
                                                        value="{{isset($word) ? $word : ''}}"
                                                        required/>
                                                <span class="input-group-btn">
                                                            {{csrf_field()}}
                                                    <button
                                                            class="button button--aylen btn btn-lg"
                                                            id="searchButton"
                                                            type="submit"
                                                            data-result_page="{{route('search')}}">
                                                                <i class="fa fa-search"></i>
                                                            </button>
                                                        </span>
                                            </div>
                                        </div>
                                    </form>

                                </li>
                            </ul>
                        </li>

                        @if (Auth::guest())
                            <li>
                                <a data-tooltip="tooltip" data-placement="bottom" title="@lang('auth.login')"
                                   class="modal_trigger"
                                   href="#modal">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </a>
                            </li>
                        @else
                            <li class="dropdown hasmenu shopcartmenu {{request::segment(1) == 'user' ? 'active' : ''}}">
                                <a href="{{Auth::user()->rol == 1 ? route('admin') : '#0'}}"
                                   class="{{Auth::user()->rol == 1 ? '' : 'dropdown-toggle'}}"
                                   data-toggle="{{Auth::user()->rol == 1 ? '' : 'dropdown'}}"
                                   role="{{Auth::user()->rol == 1 ? '' : 'button'}}">
                                    {{ Auth::user()->name }}
                                </a>
                                @if(!Auth::user()->rol == 1)
                                    <ul class="dropdown-menu show-right">
                                        <li>
                                            <a href="{{route('user', ['id' => Auth::user()->href])}}">
                                                @lang('user.profile')
                                            </a>
                                            <a href="{{route('userPurchases', ['id' => Auth::user()->href])}}">
                                                @lang('user.purchases')
                                            </a>
                                            <a href="{{route('userSettings', ['id' => Auth::user()->href])}}">
                                                @lang('user.settings')
                                            </a>
                                            <a href="{{ route('logout') }}" data-tooltip="tooltip"
                                               data-placement="bottom" title="Logout"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                @lang('user.logout') <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                @endif
                            </li>
                        @endif


                        <ul class="nav navbar-nav navbar-right searchandbag"
                            style='margin-top: 0 !important;text-transform: uppercase;position: relative'>
                            <span style='position: absolute; left: 0;top: 0;height: 100%; width: 1px; background:#fff'></span>
                            <li class="dropdown hasmenu shopcartmenu">
                                <a href="#" class="dropdown-toggle cart" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    {{session('locale')?session('locale'):'hy'}}
                                </a>


                                <ul class="dropdown-menu icon-dropdown start-right" role="menu">

                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <li>
                                            <a rel="alternate" hreflang="{{ $localeCode }}"
                                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                            </li>
                        </ul>
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </nav>
    </div><!-- end container -->
</header>
