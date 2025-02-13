@extends('driver.layouts.app', ['class' => 'register-page', 'page' => __('RideMate'), 'contentClass' => 'register-page'])

@section('content')
    <div class="col-md-10 text-center ml-auto mr-auto">
        <!-- Optional heading or logo -->
    </div>
    <div class="col-lg-4 col-md-6 ml-auto mr-auto">
        <form class="form" method="post" action="{{ route('driver.register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Header Section -->
            <div class="form-group text-center">
                <h1 class="text-white display-2">{{ __('REGISTER') }}</h1>
                <p class="text-lead text-light display-5">{{ __('DRIVER') }}</p>
            </div>

            <!-- Full Name -->
            <div class="input-group{{ $errors->has('fullname') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-single-02"></i>
                    </div>
                </div>
                <input type="text" name="fullname" class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" placeholder="{{ __('Full Name') }}">
                @include('alerts.feedback', ['field' => 'fullname'])
            </div>

            <!-- Gender -->
            <div class="input-group{{ $errors->has('gender') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-single-02"></i>
                    </div>
                </div>
                <select name="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}">
                    <option value="" disabled selected>{{ __('Select Gender') }}</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                </select>
                @include('alerts.feedback', ['field' => 'gender'])
            </div>

            <!-- Student ID -->
            <div class="input-group{{ $errors->has('studentID') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-single-02"></i>
                    </div>
                </div>
                <input type="text" name="studentID" class="form-control{{ $errors->has('studentID') ? ' is-invalid' : '' }}" placeholder="{{ __('Student ID') }}">
                @include('alerts.feedback', ['field' => 'studentID'])
            </div>

            <!-- Phone Number -->
            <div class="input-group{{ $errors->has('phoneNum') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-mobile"></i>
                    </div>
                </div>
                <input type="text" name="phoneNum" class="form-control{{ $errors->has('phoneNum') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone Number') }}">
                @include('alerts.feedback', ['field' => 'phoneNum'])
            </div>

            <!-- Email -->
            <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-email-85"></i>
                    </div>
                </div>
                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}">
                @include('alerts.feedback', ['field' => 'email'])
            </div>

            <!-- Password -->
            <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-lock-circle"></i>
                    </div>
                </div>
                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}">
                @include('alerts.feedback', ['field' => 'password'])
            </div>

            <!-- Confirm Password -->
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-lock-circle"></i>
                    </div>
                </div>
                <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}">
            </div>

            <!-- Student Card -->
            <label for="studentCard">{{ __('Student Card') }}</label>
            <div class="input-group{{ $errors->has('studentCard') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-badge"></i>
                    </div>
                </div>
                <input type="file" name="studentCard" class="form-control{{ $errors->has('studentCard') ? ' is-invalid' : '' }}">
                @include('alerts.feedback', ['field' => 'studentCard'])
            </div>
            <small class="form-text text-muted">Upload a JPEG, PNG, or JPG file not exceeding 2MB.</small>

            <!-- License Card -->
            <label for="licenseCard">{{ __('License Card') }}</label>
            <div class="input-group{{ $errors->has('licenseCard') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-badge"></i>
                    </div>
                </div>
                <input type="file" name="licenseCard" class="form-control{{ $errors->has('licenseCard') ? ' is-invalid' : '' }}">
                @include('alerts.feedback', ['field' => 'licenseCard'])
            </div>
            <small class="form-text text-muted">Upload a JPEG, PNG, or JPG file not exceeding 2MB.</small>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-lg btn-block mb-3">{{ __('Get Started') }}</button>
        </form>
    </div>
@endsection

<style>
    .card {
        border: 1px solidrgb(54, 39, 85); /* Light border color */
        border-radius: 8px;
        padding: 15px;
        margin-top: 20px;
    }

    select option {
        color: gray;
    }

    .mt-3 {
        margin-top: 1rem;
    }
</style>