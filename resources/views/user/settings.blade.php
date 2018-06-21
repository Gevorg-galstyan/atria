@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked admin-menu">
                    <li class="{{!session('password') && !session('delete') ?'active':''}}">
                        <a href="#" data-target-id="personal">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            @lang('user.personal dannie')
                        </a>
                    </li>
                    <li class="{{session('password') && !session('delete') ?'active':''}}">
                        <a href="#" data-target-id="password">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            @lang('user.change password')
                        </a>
                    </li>
                    <li class="{{session('delete')?'active':''}}">
                        <a href="#" data-target-id="delete">
                            <i class="fa fa-trash-o fa-fw"></i>
                            @lang('user.delete our page')
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 well admin-content" id="personal" style="{{!session('password') && !session('delete') ?'':'display: none;'}}">


                <form class="form-horizontal" action="{{route('editDennis', ['id' => $user->href])}}" method="post">
                    {{csrf_field()}}
                    <fieldset>

                        <!-- Form Name -->
                        <legend class="text-center">@lang('user.personal dannie')</legend>

                        <!-- Select Basic -->

                        <!-- Text <input-->
                        <div class="form-group">
                            <div class="col-sm-2 col-sm-offset-8">
                            <span class="btn btn-info edit_dannie" title="@lang('user.edit')">
                                <i class="fa fa-edit"></i>
                            </span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="first_name">@lang('auth.first_name')</label>
                            <div class="col-md-5">
                                <input id="ProductName" name="first_name" type="text"
                                       placeholder="@lang('auth.first_name')"
                                       class="form-control input-md first_name_dennie"
                                       value="{{$user->name}}"
                                       disabled required>
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif

                            </div>

                        </div>

                        <!-- Text input-->
                        <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="last_name">@lang('auth.last_name')</label>
                            <div class="col-md-5">
                                <input id="FeaturesOne" name="last_name" type="text"
                                       placeholder="@lang('auth.last_name')" class="form-control  last_name_dennie"
                                       value="{{$user->last_name}}" disabled required>
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="address">@lang('auth.address')</label>
                            <div class="col-md-5">
                                <input name="address" type="text"
                                       placeholder="@lang('auth.address')" class="form-control address_dennie"
                                       value="{{$user->address}}" disabled required>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="phone">@lang('user.phone')</label>
                            <div class="col-md-5">
                                <input name="phone" type="text"
                                       placeholder="@lang('user.phone')" class="form-control input-md phone_dennie"
                                       value="{{$user->phone}}" disabled required>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </fieldset>
                    <div class="col-sm-8 col-sm-offset-4">
                        <button type="submit" class="btn btn-success save_dennie" disabled>@lang('user.save')</button>
                    </div>

                </form>


            </div>
            <div class="col-md-9 well admin-content" id="password" style="{{!session('password')?'display: none ;':'display: block;'}}">
                <form class="form-horizontal" action="{{route('changePassword', ['id' => $user->href])}}" method="post">
                    {{csrf_field()}}
                    <fieldset>

                        <!-- Form Name -->
                        <legend class="text-center">@lang('user.change password')</legend>

                        <!-- Select Basic -->

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">@lang('auth.email')</label>
                            <div class="col-md-5">
                                <input id="ProductName" name="email" type="text"
                                       placeholder="@lang('auth.email')" class="form-control input-md"
                                       value="{{$user->email}}"
                                       disabled>
                            </div>
                        </div>

                        <!-- Text input-->


                        <!-- Text input-->
                        <div class="form-group {{ $errors->has('oldPassword') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="address">@lang('user.old password')</label>
                            <div class="col-md-5">
                                <input name="oldPassword" type="password"
                                       placeholder="@lang('user.old password')" class="form-control"
                                       value="{{Auth::user()->fb_google ? Auth::user()->driver_token : ''}}"
                                       required>
                                @if ($errors->has('oldPassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('oldPassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="phone">@lang('user.new password')</label>
                            <div class="col-md-5">
                                <input name="password" type="password"
                                       placeholder="@lang('user.new password')"
                                       class="form-control input-md phone_dennie" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="phone">@lang('auth.confirm_password')</label>
                            <div class="col-md-5">
                                <input name="password_confirmation" type="password"
                                       placeholder="@lang('auth.confirm_password')"
                                       class="form-control input-md phone_dennie" required>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </fieldset>
                    <div class="col-sm-8 col-sm-offset-4">
                        <button type="submit" class="btn btn-success save_dennie">@lang('user.save')</button>
                    </div>

                </form>
            </div>
            <div class="col-md-9 well admin-content" id="delete" style="{{!session('delete')?'display: none ;':'display: block;'}}">
                <form class="form-horizontal" action="{{route('deleteUser', ['id' => $user->href])}}" method="post">
                    {{csrf_field()}}
                    <fieldset>

                        <!-- Form Name -->
                        <legend class="text-center">@lang('user.delete our page')</legend>

                        <!-- Select Basic -->

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">@lang('auth.email')</label>
                            <div class="col-md-5">
                                <input id="ProductName" name="email" type="text"
                                       placeholder="@lang('auth.email')" class="form-control input-md"
                                       value="{{$user->email}}"
                                       disabled>
                            </div>
                        </div>

                        <!-- Text input-->


                        <!-- Text input-->
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="password">@lang('auth.password')</label>
                            <div class="col-md-5">
                                <input name="password" type="password"
                                       placeholder="@lang('auth.password')" class="form-control" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                    </fieldset>
                    <div class="col-sm-8 col-sm-offset-4">
                        <button type="submit" class="btn btn-danger">@lang('user.delete')</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


@endsection

@section('script')
    @parent
    <script type="text/javascript"
            src="{{asset('js/user/settings.js')}}"></script>
@endsection