@extends('driver.layouts.app', ['page' => __('Carpool Information'), 'pageSlug' => 'carpool'])

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Carpool</h2>
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
        <form action="{{ route('driver.carpool.update', $carpool->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Student ID -->
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Student ID:</strong>
               <select class="form-control" name="driverID">
                   <option value="">Choose Student ID:</option>
                   @foreach ($driver as $id => $studentID)
                       <option
                           value="{{$id}}" {{ (isset($carpool['driverID']) && $carpool['driverID'] == $id) ? ' selected' : '' }}>{{$studentID}}</option>
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
                           value="{{$id}}" {{ (isset($carpool['carID']) && $carpool['carID'] == $id) ? ' selected' : '' }}>{{$carPlate}}</option>
                   @endforeach
               </select>
           </div>
           </div>

           <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Pickup Location:</strong>
                    <input type="text" name="pickup_loc" value="{{ $carpool->pickup_loc }}" class="form-control" placeholder="Pickup Location">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Drop Off Location:</strong>
                    <input type="text" name="dropoff_loc" value="{{ $carpool->dropoff_loc }}" class="form-control" placeholder="Drop Off Location">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Pickup Date:</strong>
                    <input type="date" name="pickup_date" value="{{ $carpool->pickup_date }}" class="form-control" placeholder="Pickup Date">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Pickup Time:</strong>
                    <input type="time" name="pickup_time" value="{{ $carpool->pickup_time }}" class="form-control" placeholder="Pickup Time">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Available Seats:</strong>
                    <select name="available_seats" class="form-control">
                        <option value="">Select available seats</option>
                        <option value="1" {{ $carpool->available_seats == '1' ? 'selected' : '' }}>1 Person</option>
                        <option value="2" {{ $carpool->available_seats == '2' ? 'selected' : '' }}>2 People</option>
                        <option value="3" {{ $carpool->available_seats == '3' ? 'selected' : '' }}>3 People</option>
                        <option value="4" {{ $carpool->available_seats == '4' ? 'selected' : '' }}>4 People</option>
                        <option value="5" {{ $carpool->available_seats == '5' ? 'selected' : '' }}>5 People</option>
                        <option value="6" {{ $carpool->available_seats == '6' ? 'selected' : '' }}>6 People</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Total Fare:</strong>
                    <input type="text" name="totalFare" value="{{ $carpool->total_fare }}" class="form-control" placeholder="Total Fare">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Fare Per Head:</strong>
                    <input type="text" name="fare_per_head" value="{{ $carpool->fare_per_head }}" class="form-control" placeholder="Fare Per Head">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select name="status" class="form-control">
                        <option value="">Select Carpool Status</option>
                        <option value="open" {{ $carpool->status == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="full" {{ $carpool->status == 'full' ? 'selected' : '' }}>Full</option>
                        <option value="completed" {{ $carpool->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="canceled" {{ $carpool->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>
            </div>

            <!-- Submit and Back Buttons -->
            <div class="row mt-3">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-secondary" href="{{ route('driver.vehicle.index') }}">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .card {
        border: 1px solid rgb(54, 39, 85); /* Light border color */
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
