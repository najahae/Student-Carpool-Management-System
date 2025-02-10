@extends('passenger.layouts.app', ['page' => __('Carpool Information'), 'pageSlug' => 'carpool'])

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Timetable Details</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Driver ID:</strong>
                {{ $timetable->driver_id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date:</strong>
                {{ $timetable->date }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Start Time:</strong>
                {{ $timetable->start_time }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>End Time:</strong>
                {{ $timetable->end_time }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Pickup Location:</strong>
                {{ $timetable->pickup_location }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Destination:</strong>
                {{ $timetable->destination }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Available Seats:</strong>
                {{ $timetable->available_seats }}
            </div>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('timetables.index') }}"> Back</a>
        </div>
    </div>
@endsection
