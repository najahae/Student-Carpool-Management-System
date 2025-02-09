@extends('layouts.app', ['page' => __('Vehicle Information'), 'pageSlug' => 'vehicles'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <h4 class="card-title">Your Vehicle</h4>
        
        <!-- Button to create a new vehicle -->
        <a href="{{ route('driver.vehicle.create') }}" class="btn btn-primary" style="margin-bottom: 15px;">Create a New Vehicle</a>

        @if ($car->isEmpty())
            <p style="margin-top: 10px;">No vehicles found.</p>
        @else
            @foreach ($car as $c)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter">
                                <thead class="text-primary">
                                <td colspan="2" style="text-align: center;">
                                    <img src="{{ asset('storage/' . $c->carImage) }}" alt="Car Image" style="width: 300px; height: auto; border-radius: 8px;">
                                </td>

                                </thead>
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <td>{{ $c->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Student ID</th>
                                        <td>{{ $c->user ? $c->user->studentID : 'No driver' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Type</th>
                                        <td>{{ $c->carType }}</td>
                                    </tr>
                                    <tr>
                                        <th>Model</th>
                                        <td>{{ $c->carModel }}</td>
                                    </tr>
                                    <tr>
                                        <th>Color</th>
                                        <td>{{ $c->carColor }}</td>
                                    </tr>
                                    <tr>
                                        <th>Plate Number</th>
                                        <td>{{ $c->carPlate }}</td>
                                    </tr>
                                    <tr>
                                        <th>Capacity</th>
                                        <td>{{ $c->carCapacity }}</td>
                                    </tr>
                                    <tr>
                                        <th>Road Tax Expiry Date</th>
                                        <td>{{ $c->roadtaxExp }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
            
                        <!-- Edit and Delete Buttons -->
                        <div class="d-flex justify-content-end mt-3" style="gap: 10px;">
                            <a href="{{ route('vehicle.edit', $c->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('vehicle.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this vehicle?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
