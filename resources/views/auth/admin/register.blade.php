@extends('admin.layouts.app', ['class' => 'register-page', 'page' => __('RideMate'), 'contentClass' => 'register-page'])

@section('content')
<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row justify-content-center w-100">
        <div class="col-lg-5 col-md-6">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <h4 class="text-center mb-4">{{ __('Admin Registration Page') }}</h4>

                    <form class="form" method="post" action="{{ route('admin.register') }}">
                        @csrf

                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-single-02"></i>
                                    </div>
                                </div>
                                <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Email') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-email-85"></i>
                                    </div>
                                </div>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Password') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-lock-circle"></i>
                                    </div>
                                </div>
                                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Confirm Password') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-lock-circle"></i>
                                    </div>
                                </div>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                            </div>
                        </div>

                        <div class="form-check text-left">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" required>
                                <span class="form-check-sign"></span>
                                {{ __('I agree to the') }}
                                <a href="#">{{ __('terms and conditions') }}</a>.
                            </label>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary btn-lg w-100">{{ __('Get Started') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
