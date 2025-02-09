@extends('layouts.app', ['class' => 'register-page', 'page' => __('RideMate'), 'contentClass' => 'register-page'])

@section('content')
    <div class="col-md-10 text-center ml-auto mr-auto">
        <!-- Optional heading or logo -->
    </div>
    <div class="col-lg-4 col-md-6 ml-auto mr-auto">
        <form class="form" method="post" action="{{ route('passenger.register') }}">
            @csrf

            <!-- Header Section -->
            <div class="form-group text-center">
                <h1 class="text-white display-2">{{ __('REGISTER') }}</h1>
                <p class="text-lead text-light display-5">{{ __('PASSENGER') }}</p>
            </div>

            <!-- Full Name -->
            <div class="input-group{{ $errors->has('fullname') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-single-02"></i>
                    </div>
                </div>
                <input type="text" name="fullname" class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" 
                    placeholder="{{ __('Full Name') }}" value="{{ old('fullname') }}">
                @include('alerts.feedback', ['field' => 'fullname'])
            </div>

            <!-- Student ID -->
            <div class="input-group{{ $errors->has('studentID') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-badge"></i>
                    </div>
                </div>
                <input type="text" name="studentID" class="form-control{{ $errors->has('studentID') ? ' is-invalid' : '' }}" 
                    placeholder="{{ __('Student ID') }}" value="{{ old('studentID') }}">
                @include('alerts.feedback', ['field' => 'studentID'])
            </div>

            <!-- Email -->
            <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-email-85"></i>
                    </div>
                </div>
                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                    placeholder="{{ __('Email') }}" value="{{ old('email') }}">
                @include('alerts.feedback', ['field' => 'email'])
            </div>

            <!-- Phone Number -->
            <div class="input-group{{ $errors->has('phoneNum') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-mobile"></i>
                    </div>
                </div>
                <input type="text" name="phoneNum" class="form-control{{ $errors->has('phoneNum') ? ' is-invalid' : '' }}" 
                    placeholder="{{ __('Phone Number') }}" value="{{ old('phoneNum') }}">
                @include('alerts.feedback', ['field' => 'phoneNum'])
            </div>

            <!-- Password -->
            <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-lock-circle"></i>
                    </div>
                </div>
                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                    placeholder="{{ __('Password') }}">
                @include('alerts.feedback', ['field' => 'password'])
            </div>

            <!-- Confirm Password -->
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-lock-circle"></i>
                    </div>
                </div>
                <input type="password" name="password_confirmation" class="form-control" 
                    placeholder="{{ __('Confirm Password') }}">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-lg btn-block mb-3">{{ __('Get Started') }}</button>
        </form>
    </div>
@endsection
