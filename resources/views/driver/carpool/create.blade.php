@extends('layouts.app', ['page' => __('Carpool Information'), 'pageSlug' => 'carpool'])
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

<div class="card">
    <div class="card-body">
        <form action="{{ route('driver.carpool.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Driver Name:</strong>
               <select class="form-control" name="driverID">
                   <option value="">Choose Driver Name</option>
                   @foreach ($user as $id => $fullname)
                       <option
                           value="{{$id}}" {{ (isset($carpool->driverID) && $carpool->driverID == $id) ? ' selected' : '' }}>{{$fullname}}</option>
                   @endforeach
               </select>
           </div>
           </div>

           <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Car Plate Number:</strong>
               <select class="form-control" name="carID">
                   <option value="">Choose Car Plate Number</option>
                   @foreach ($car as $id => $carPlate)
                       <option
                           value="{{$id}}" {{ (isset($carpool->carID) && $carpool->carID == $id) ? ' selected' : '' }}>{{$carPlate}}</option>
                   @endforeach
               </select>
           </div>
           </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Pickup Location:</strong>
                    <input type="text" name="pickup_loc" class="form-control" placeholder="Pick Up Location">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Drop Off Location:</strong>
                    <input type="text" name="dropoff_loc" class="form-control" placeholder="Drop Off Location">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Pickup Date: </strong>
                    <input type="date" name="pickup_date" class="form-control">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Pickup Time: </strong>
                    <input type="time" name="pickup_time" class="form-control">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Available Seats:</strong>
                    <select name="available_seats" class="form-control">
                        <option value="">Select available seats</option>
                        <option value="1">1 Person</option>
                        <option value="2">2 People</option>
                        <option value="3">3 People</option>
                        <option value="4">4 People</option>
                        <option value="5">5 People</option>
                        <option value="6">6 People</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Total Fare (RM): </strong>
                    <input type="text" name="total_fare" class="form-control">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Fare Per Head (RM): </strong>
                    <input type="text" name="fare_per_head" class="form-control">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select name="status" class="form-control">
                        <option value="">Select Carpool Status</option>
                        <option value="open">Open</option>
                        <option value="full">Full</option>
                        <option value="completed">Completed</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('carpool.index') }}"> Back</a>
                </div>
            </div>
        </form>
    </div>
</div>

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

<script>
    // Update file input label on file selection
    document.querySelector('.custom-file-input').addEventListener('change', function (e) {
        var fileName = document.getElementById("carImage").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName;
    });
</script>
@endsection
