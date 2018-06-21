@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="text-center">
                <form action="{{route('postEnterEmail')}}" method="post" class="">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="email">@lang('auth.please_enter')</label>
                        <input type="email"
                               name="email"
                               class="form-control {{ $errors->has('email') ? ' has-error' : '' }}"
                               placeholder="@lang('contacts.email')" id="email" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <button type="submit" class="button button--aylen btn">@lang('contacts.send')</button>
                </form>

            </div>
        </div>
    </div>
@endsection