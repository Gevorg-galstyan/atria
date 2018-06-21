<div id="modal" class="popupContainer" style="display:none;">
    <header class="popupHeader">
        <span class="header_title">@lang('auth.login')</span>
        <span class="modal_close"><i class="fa fa-times"></i></span>
    </header>

    <section class="popupBody">
        <!-- Social Login -->
        <div class="social_login">
            <div class="">
                <a href="{{route('socialiteLogin', ['log' => 'facebook'])}}" class="social_box fb">
                    <span class="icon"><i class="fa fa-facebook"></i></span>
                    <span class="icon_title">@lang('auth.contactFacebook')</span>

                </a>

                <a href="{{route('socialiteLogin', ['log' => 'google'])}}" class="social_box google">
                    <span class="icon"><i class="fa fa-google-plus"></i></span>
                    <span class="icon_title">@lang('auth.contactGoogle')</span>
                </a>
            </div>

            <div class="centeredText">
                <span>@lang('auth.orUseYourEmailAddress')</span>
            </div>

            <div class="action_btns">
                <div class="one_half"><a href="#" id="login_form" class="btn">@lang('auth.login')</a></div>
                <div class="one_half last"><a href="#" id="register_form" class="btn">@lang('auth.register')</a></div>
            </div>
        </div>

        <!-- Username & Password Login form -->
        <div class="user_login">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <label for="email">@lang('auth.email')</label>
                <input id="email" type="email" name="email" required autofocus>

                <label for="password">@lang('auth.password')</label>
                <input id="password" type="password" name="password" required>


                <label>
                    <input type="checkbox" name="remember">
                    @lang('auth.remember')
                </label>

                <div class="action_btns">
                    <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i>
                            @lang('auth.back')</a></div>
                    <div class="one_half last">
                        <button type="submit" href="#" class="btn btn_red">@lang('auth.login')</button>
                    </div>
                </div>
            </form>
            <a class="forgot_password" href="{{ route('password.request') }}">
                @lang('auth.forgotPassword')?
            </a>
        </div>

        <!-- Register Form -->
        <div class="user_register">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class='form-group'>
                    <div class='col-xs-6'>
                        <label for="first_name">@lang('auth.first_name')</label>
                        <input id="first_name" type="text" name="first_name" required autofocus>
                    </div>
                    <div class='col-xs-6'>
                        <label for="last_name">@lang('auth.last_name')</label>
                        <input id="last_name" type="text" name="last_name">
                    </div>
                </div>
                <div class='form-group'>
                    <div class='col-xs-6'>
                        <label for="email">@lang('auth.email')</label>
                        <input id="email" type="email" name="email" required>
                    </div>
                    <div class='col-xs-6'>
                        <label for="address">@lang('auth.address')</label>
                        <input id="address" type="text" name="address" required>
                    </div>
                </div>
                <div class='form-group'>
                    <div class='col-sm-12'>
                        <label for="address">@lang('auth.phone')</label>
                        <input id="phone" type="text" name="phone" required>
                    </div>
                </div>
                 <div class='form-group'>
                    <div class='col-xs-6'>
                          <label for="password">@lang('auth.password')</label>
                        <input id="password" type="password" name="password" required>
                    </div>
                    <div class='col-xs-6'>
                        <label for="password-confirm">@lang('auth.confirm_password')</label>
                        <input id="password-confirm" type="password" name="password_confirmation" required>
                    </div>
                </div>
              
                <div class="action_btns">
                    <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i>
                            @lang('auth.back')</a></div>
                    <div class="one_half last">
                        <button type="submit" href="#" class="btn btn_red">@lang('auth.register')</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>