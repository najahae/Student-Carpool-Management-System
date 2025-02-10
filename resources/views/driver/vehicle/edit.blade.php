@extends('driver.layouts.app', ['page' => __('Vehicle Information'), 'pageSlug' => 'vehicles'])

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Vehicle</h2>
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
        <form action="{{ route('driver.vehicle.update', $car->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Student ID -->
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Student ID:</strong>
               <select class="form-control" name="driverID">
                   <option value="">Choose Student ID</option>
                   @foreach ($driver as $id => $studentID)
                       <option
                           value="{{$id}}" {{ (isset($car['driverID']) && $car['driverID'] == $id) ? ' selected' : '' }}>{{$studentID}}</option>
                   @endforeach
               </select>
           </div>
           </div>

            <!-- Car Type -->
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Car Type:</strong>
                    <select name="carType" class="form-control">
                        <option value="">Select Car Type</option>
                        <option value="Sedan" {{ $car->carType == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                        <option value="Hatchback" {{ $car->carType == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                        <option value="SUV" {{ $car->carType == 'SUV' ? 'selected' : '' }}>Sports-Utility Vehicle (SUV)</option>
                        <option value="Station Wagon" {{ $car->carType == 'Station Wagon' ? 'selected' : '' }}>Station Wagon</option>
                        <option value="MPV" {{ $car->carType == 'MPV' ? 'selected' : '' }}>Multi-Purpose Van (MPV)</option>
                        <option value="Pick-Up Truck" {{ $car->carType == 'Pick-Up Truck' ? 'selected' : '' }}>Pick-Up Truck</option>
                        <option value="Coupe" {{ $car->carType == 'Coupe' ? 'selected' : '' }}>Coupe</option>
                        <option value="Convertible" {{ $car->carType == 'Convertible' ? 'selected' : '' }}>Convertible</option>
                    </select>
                </div>
            </div>

            <!-- Car Model -->
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Car Model:</strong>
                    <input type="text" name="carModel" value="{{ $car->carModel }}" class="form-control" placeholder="Model of your car">
                </div>
            </div>

            <!-- Car Color -->
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Car Color:</strong>
                    <input type="text" name="carColor" value="{{ $car->carColor }}" class="form-control" placeholder="Color of your car">
                </div>
            </div>

            <!-- Car Plate Number -->
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Car Plate Number:</strong>
                    <input type="text" name="carPlate" value="{{ $car->carPlate }}" class="form-control" placeholder="Plate Number of your car">
                </div>
            </div>

            <!-- Car Capacity -->
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Car Capacity:</strong>
                    <select name="carCapacity" class="form-control">
                        <option value="">Select Car Capacity</option>
                        <option value="2" {{ $car->carCapacity == '2' ? 'selected' : '' }}>2 People</option>
                        <option value="4" {{ $car->carCapacity == '4' ? 'selected' : '' }}>4 People</option>
                        <option value="6" {{ $car->carCapacity == '6' ? 'selected' : '' }}>6 People</option>
                    </select>
                </div>
            </div>

            <!-- Car Image -->
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Car Image:</strong>
                    <div class="custom-file">
                        <input type="file" name="carImage" class="custom-file-input" id="carImage">
                        <label class="custom-file-label" for="carImage">Choose file</label>
                    </div>
                    @if ($car->carImage)
                        <div class="mt-3">
                            <strong>Current Image:</strong><br>
                            <img src="{{ asset('storage/' . $car->carImage) }}" alt="Car Image" width="150" class="img-thumbnail">
                        </div>
                    @endif
                </div>
            </div>

            <!-- Road Tax Expiry Date -->
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Road Tax Expiry Date:</strong>
                    <input type="date" name="roadtaxExp" value="{{ $car->roadtaxExp }}" class="form-control">
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
