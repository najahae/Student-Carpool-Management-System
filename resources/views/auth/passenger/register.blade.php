@extends('passenger.layouts.app', ['class' => 'register-page', 'page' => __('RideMate'), 'contentClass' => 'register-page'])

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
            <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-single-02"></i>
                    </div>
                </div>
                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                    placeholder="{{ __('Full Name') }}" value="{{ old('name') }}">
                @include('alerts.feedback', ['field' => 'name'])
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

            <!-- Student ID -->
            <div class="input-group{{ $errors->has('student_id') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-badge"></i>
                    </div>
                </div>
                <input type="text" name="student_id" class="form-control{{ $errors->has('student_id') ? ' is-invalid' : '' }}" 
                    placeholder="{{ __('Student ID') }}" value="{{ old('student_id') }}">
                @include('alerts.feedback', ['field' => 'student_id'])
            </div>

            <!-- Phone Number -->
            <div class="input-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-mobile"></i>
                    </div>
                </div>
                <input type="text" name="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" 
                    placeholder="{{ __('Phone Number') }}" value="{{ old('phone') }}">
                @include('alerts.feedback', ['field' => 'phone'])
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
