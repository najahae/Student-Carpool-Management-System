@extends('layouts.app')

@section('content')
    <div class="header py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <!-- Larger Welcome Text -->
                        <h1 class="text-white display-2">{{ __('RideMate') }}</h1>
                        <p class="text-lead text-light display-4">
                            {{ __('Choose your role to proceed with login.') }}
                        </p>
                        <!-- Buttons for different logins -->
                        <div class="d-flex justify-content-center gap-5 mt-4">
                            <a href="{{ route('admin.login') }}" class="btn btn-primary btn-lg">
                                {{ __('Admin') }}
                            </a>
                            <a href="{{ route('driver.login') }}" class="btn btn-secondary btn-lg">
                                {{ __('Driver') }}
                            </a>
                            <a href="{{ route('passenger.login') }}" class="btn btn-success btn-lg">
                                {{ __('Passenger') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
