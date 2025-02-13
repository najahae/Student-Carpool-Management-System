@extends('layouts.app', ['class' => 'login-page', 'page' => __('RideMate'), 'contentClass' => 'login-page'])

@section('content')
    <div class="col-md-10 text-center ml-auto mr-auto">
        <!-- Optional heading or message -->
    </div>
    <div class="col-lg-4 col-md-6 ml-auto mr-auto">
        <form class="form" method="post" action="{{ route('password.email') }}">
            @csrf

            <!-- Header Section -->
            <div class="form-group text-center">
                <h1 class="text-white display-2">{{ __('RESET PASSWORD') }}</h1>
                <p class="text-lead text-light display-5">
                    {{ __('Enter your email to reset your password') }}
                </p>
            </div>

            <!-- Email Input -->
            <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-email-85"></i>
                    </div>
                </div>
                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}">
                @include('alerts.feedback', ['field' => 'email'])
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-lg btn-block mb-3">{{ __('Send Password Reset Link') }}</button>

            <!-- Footer Links -->
            <div class="text-center">
                <h6>
                    <a href="{{ route('admin.loginPage') }}" class="link footer-link">{{ __('Back to Login') }}</a>
                </h6>
            </div>
        </form>
    </div>
@endsection
