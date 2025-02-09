@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Edit Profile') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                    <div class="card-body">
                            @csrf
                            @method('put')

                            @include('alerts.success')

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Full Name:</strong>
                                    <input type="text" name="fullname" value="{{ $user->fullname }}" class="form-control" placeholder="Your full name">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('fullname') ? ' has-danger' : '' }}">
                                <label>{{ __('Full Name') }}</label>
                                <input type="text" name="fullname" class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" placeholder="{{ __('Full Name') }}" value="{{ old('fullname', auth()->user()->fullname) }}">
                                @include('alerts.feedback', ['field' => 'fullname'])
                            </div>

                            <div class="form-group{{ $errors->has('gender') ? ' has-danger' : '' }}">
                                <label>{{ __('Gender') }}</label>
                                <select name="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}">
                                    <option value="" disabled selected>{{ __('Select Gender') }}</option>
                                    <option value="male" {{ old('gender', auth()->user()->gender) == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                    <option value="female" {{ old('gender', auth()->user()->gender) == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                                    <option value="other" {{ old('gender', auth()->user()->gender) == 'other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                                </select>
                                @include('alerts.feedback', ['field' => 'gender'])
                            </div>


                            <div class="form-group{{ $errors->has('studentID') ? ' has-danger' : '' }}">
                                <label>{{ __('Student ID') }}</label>
                                <input type="text" name="studentID" class="form-control{{ $errors->has('studentID') ? ' is-invalid' : '' }}" placeholder="{{ __('Student ID') }}" value="{{ old('studentID', auth()->user()->studentID) }}">
                                @include('alerts.feedback', ['field' => 'studentID'])
                            </div>

                            <div class="form-group{{ $errors->has('phoneNum') ? ' has-danger' : '' }}">
                                <label>{{ __('Phone Number') }}</label>
                                <input type="text" name="phoneNum" class="form-control{{ $errors->has('phoneNum') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone Number') }}" value="{{ old('phoneNum', auth()->user()->phoneNum) }}">
                                @include('alerts.feedback', ['field' => 'phoneNum'])
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>{{ __('Email address') }}</label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email address') }}" value="{{ old('email', auth()->user()->email) }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>

                            <div class="form-group{{ $errors->has('studentCard') ? ' has-danger' : '' }}">
                                <label>{{ __('Student Card') }}</label>
                                <input type="studentCard" name="studentCard" class="form-control{{ $errors->has('studentCard') ? ' is-invalid' : '' }}" placeholder="{{ __('Student Card') }}" value="{{ old('studentCard', auth()->user()->studentCard) }}">
                                @include('alerts.feedback', ['field' => 'studentCard'])
                            </div>

                            <div class="form-group{{ $errors->has('licenseCard') ? ' has-danger' : '' }}">
                                <label>{{ __('License Card') }}</label>
                                    <input type="file" name="licenseCard" class="form-control{{ $errors->has('licenseCard') ? ' is-invalid' : '' }}" placeholder="{{ __('licenseCard') }}">
                                    @include('alerts.feedback', ['field' => 'licenseCard'])

                                    @if(auth()->user()->licenseCard)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . auth()->user()->licenseCard) }}" alt="License Card Image" width="100">
                                        </div>
                                    @endif
                            </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Password') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')

                        @include('alerts.success', ['key' => 'password_status'])

                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <label>{{ __('Current Password') }}</label>
                            <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" required>
                            @include('alerts.feedback', ['field' => 'old_password'])
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label>{{ __('New Password') }}</label>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" required>
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('Confirm New Password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Change password') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="#">
                                <img class="avatar" src="{{ asset('black') }}/img/emilyz.jpg" alt="">
                                <h5 class="title">{{ auth()->user()->name }}</h5>
                            </a>
                            <p class="description">
                                {{ __('Ceo/Co-Founder') }}
                            </p>
                        </div>
                    </p>
                    <div class="card-description">
                        {{ __('Do not be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...') }}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="button-container">
                        <button class="btn btn-icon btn-round btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-google">
                            <i class="fab fa-google-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
