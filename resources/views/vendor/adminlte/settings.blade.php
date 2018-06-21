@extends('adminlte::layouts.app')

@section('main-content')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked admin-menu">
                    <li class="{{!session('password') && !session('delete') ?'active':''}}">
                        <a href="#" data-target-id="personal">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            Edit Profile
                        </a>
                    </li>
                    <li class="{{session('password') && !session('delete') ?'active':''}}">
                        <a href="#" data-target-id="password">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            Change Password
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 well admin-content" id="personal"
                 style="{{!session('password') && !session('delete') ?'':'display: none;'}}">


                <form class="form-horizontal" action="{{route('editDennis', ['id' => $user->href])}}" method="post">
                    {{csrf_field()}}
                    <fieldset>

                        <!-- Form Name -->
                        <legend class="text-center">Edit Personal Information</legend>

                        <!-- Select Basic -->

                        <!-- Text <input-->
                        <div class="form-group">
                            <div class="col-sm-2 col-sm-offset-8">
                            <span class="btn btn-info edit_dannie" title="Edit">
                                <i class="fa fa-edit"></i>
                            </span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="first_name">Name</label>
                            <div class="col-md-5">
                                <input id="ProductName" name="first_name" type="text"
                                       placeholder="Name"
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
                            <label class="col-md-4 control-label" for="last_name">LastName</label>
                            <div class="col-md-5">
                                <input id="FeaturesOne" name="last_name" type="text"
                                       placeholder="LastName" class="form-control  last_name_dennie"
                                       value="{{$user->last_name}}" disabled required>
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Text input-->


                        <input name="address" type="hidden"
                               placeholder="Address" class="form-control address_dennie"
                               value="123456" disabled required>


                        <input name="phone" type="hidden"
                               placeholder="Phone" class="form-control input-md phone_dennie"
                               value="1234567891" disabled required>


                    </fieldset>
                    <div class="col-sm-8 col-sm-offset-4">
                        <button type="submit" class="btn btn-success save_dennie" disabled>Save</button>
                    </div>

                </form>


            </div>
            <div class="col-md-9 well admin-content" id="password"
                 style="{{!session('password')?'display: none ;':'display: block;'}}">
                <form class="form-horizontal" action="{{route('changePassword', ['id' => $user->href])}}" method="post">
                    {{csrf_field()}}
                    <fieldset>

                        <!-- Form Name -->
                        <legend class="text-center">Edit Password</legend>

                        <!-- Select Basic -->

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">Email</label>
                            <div class="col-md-5">
                                <input id="ProductName" name="email" type="text"
                                       placeholder="Email" class="form-control input-md"
                                       value="{{$user->email}}"
                                       disabled>
                            </div>
                        </div>

                        <!-- Text input-->


                        <!-- Text input-->
                        <div class="form-group {{ $errors->has('oldPassword') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="address">Old Password</label>
                            <div class="col-md-5">
                                <input name="oldPassword" type="password"
                                       placeholder="Old Password" class="form-control" required>
                                @if ($errors->has('oldPassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('oldPassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="phone">New Password</label>
                            <div class="col-md-5">
                                <input name="password" type="password"
                                       placeholder="New Password"
                                       class="form-control input-md phone_dennie" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label" for="phone">Confirm Password</label>
                            <div class="col-md-5">
                                <input name="password_confirmation" type="password"
                                       placeholder="Confirm Password"
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
                        <button type="submit" class="btn btn-success save_dennie">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>



@endsection