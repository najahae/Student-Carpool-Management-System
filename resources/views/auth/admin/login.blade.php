@extends('admin.layouts.app', ['class' => 'login-page', 'page' => __('RideMate'), 'contentClass' => 'login-page'])

@section('content')
    <div class="col-md-10 text-center ml-auto mr-auto">
        <!-- You can leave this part for any heading or message -->
    </div>
    
    <div class="col-lg-4 col-md-6 ml-auto mr-auto">
        <form class="form" method="post" action="{{ route('admin.login') }}">
            @csrf

            <!-- Removed the card -->
            <div class="form-group text-center">
                <h1 class="text-white display-2">{{ __('LOGIN') }}</h1>
                        <p class="text-lead text-light display-5">
                            {{ __('ADMIN') }}
                        </p>
            </div>
            
            <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-email-85"></i>
                    </div>
                </div>
                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}">
                @include('alerts.feedback', ['field' => 'email'])
            </div>
            
            <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-lock-circle"></i>
                    </div>
                </div>
                <input type="password" placeholder="{{ __('Password') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                @include('alerts.feedback', ['field' => 'password'])
            </div>

            <!-- Simplified footer -->
            <button type="submit" class="btn btn-primary btn-lg btn-block mb-3">{{ __('Log In') }}</button>

            <div class="text-center">
                <h6>
                    <a href="{{ route('admin.register') }}" class="link footer-link">{{ __('Create Account') }}</a>
                </h6>
                <h6>
                    <a href="{{ route('password.request') }}" class="link footer-link">{{ __('Forgot password?') }}</a>
                </h6>
            </div>
        </form>
    </div>
@endsection
