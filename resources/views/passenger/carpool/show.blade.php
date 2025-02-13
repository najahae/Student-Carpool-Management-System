@extends('passenger.layouts.app', ['page' => __('List of Carpools'), 'pageSlug' => 'carpool'])
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Carpool Details</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Driver ID:</strong>
                {{ $carpool->driverID }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date:</strong>
                {{ $carpool->pickup_date }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Pickup Time:</strong>
                {{ $carpool->pickup_time }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Pickup Location:</strong>
                {{ $carpool->pickup_loc }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Destination:</strong>
                {{ $carpool->dropoff_loc }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Available Seats:</strong>
                {{ $carpool->available_seats }}
            </div>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('passenger.carpool.index') }}"> Back</a>
        </div>
    </div>
@endsection
