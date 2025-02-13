@extends('passenger.layouts.app', ['page' => __('List of Carpools'), 'pageSlug' => 'carpool'])
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Carpool</h2>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('carpool.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Driver ID:</strong>
                <input type="text" name="driver_id" class="form-control" placeholder="Driver ID">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Date:</strong>
                <input type="date" class="form-control" name="date" placeholder="Date">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Start Time:</strong>
                <input type="time" class="form-control" name="start_time" placeholder="Start Time">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>End Time:</strong>
                <input type="time" class="form-control" name="end_time" placeholder="End Time">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Pickup Location:</strong>
                <input type="text" class="form-control" name="pickup_location" placeholder="Pickup Location">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Destination:</strong>
                <input type="text" class="form-control" name="destination" placeholder="Destination">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Available Seats:</strong>
                <input type="number" class="form-control" name="available_seats" placeholder="Available Seats">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-primary" href="{{ route('timetables.index') }}"> Back</a>
        </div>
    </div>

</form>
@endsection
