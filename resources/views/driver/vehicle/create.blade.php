@extends('driver.layouts.app', ['page' => __('Vehicle Information'), 'pageSlug' => 'vehicles'])
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Vehicle</h2>
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
        <form action="{{ route('driver.vehicle.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Student ID:</strong>
               <select class="form-control" name="driverID">
                   <option value="">Choose Student ID</option>
                   @foreach ($driver as $id => $studentID)
                       <option
                           value="{{$id}}" {{ (isset($car->driverID) && $car->driverID == $id) ? ' selected' : '' }}>{{$studentID}}</option>
                   @endforeach
               </select>
           </div>
           </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Car Type:</strong>
                    <select name="carType" class="form-control">
                        <option value="">Select Car Type</option>
                        <option value="Sedan">Sedan</option>
                        <option value="Hatchback">Hatchback</option>
                        <option value="SUV">Sports-Utility Vehicle (SUV)</option>
                        <option value="Station Wagon">Station Wagon</option>
                        <option value="MPV">Multi-Purpose Van (MPV)</option>
                        <option value="Pick-Up Truck">Pick-Up Truck</option>
                        <option value="Coupe">Coupe</option>
                        <option value="Convertible">Convertible</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Car Model:</strong>
                    <input type="text" name="carModel" class="form-control" placeholder="Model of your car">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Car Color:</strong>
                    <input type="text" name="carColor" class="form-control" placeholder="Color of your car">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Car Plate Number:</strong>
                    <input type="text" name="carPlate" class="form-control" placeholder="Plate Number of your car">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Car Capacity:</strong>
                    <select name="carCapacity" class="form-control">
                        <option value="">Select Car Capacity</option>
                        <option value="2">2 People</option>
                        <option value="4">4 People</option>
                        <option value="6">6 People</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Car Image:</strong>
                    <div class="custom-file">
                        <input type="file" name="carImage" class="custom-file-input" id="carImage">
                        <label class="custom-file-label" for="carImage">Choose file</label>
                    </div>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Road Tax Expiry Date:</strong>
                    <input type="date" name="roadtaxExp" class="form-control">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('driver.vehicle.index') }}"> Back</a>
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
