@extends('layouts.app', ['page' => __('Carpool Information'), 'pageSlug' => 'carpool'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <h4 class="card-title">Your Carpool Information</h4>
        
        <!-- Button to create a new carpool -->
        <a href="{{ route('driver.carpool.create') }}" class="btn btn-primary" style="margin-bottom: 15px;">Create a New Carpool</a>

        @if ($carpool->isEmpty())
            <p style="margin-top: 10px;">No carpool found.</p>
        @else
            @foreach ($carpool as $c)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter">
                                <thead class="text-primary">

                                </thead>
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <td>{{ $c->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Driver Name</th>
                                        <td>{{ $c->user ? $c->user->fullname : 'No driver' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Driver Gender</th>
                                        <td>{{ $c->user ? $c->user->gender : 'Not Selected' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Car Model</th>
                                        <td>{{ $c->car ? $c->car->carModel : 'No car' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Car Color</th>
                                        <td>{{ $c->car ? $c->car->carColor : 'No car' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Car Plate Number</th>
                                        <td>{{ $c->car ? $c->car->carPlate : 'No car' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Car Capacity</th>
                                        <td>{{ $c->car ? $c->car->carCapacity : 'No car' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pickup Location</th>
                                        <td>{{ $c->pickup_loc }}</td>
                                    </tr>
                                    <tr>
                                        <th>Drop Off Location</th>
                                        <td>{{ $c->dropoff_loc }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pickup Date</th>
                                        <td>{{ $c->pickup_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pickup Time</th>
                                        <td>{{ $c->pickup_time }}</td>
                                    </tr>
                                    <tr>
                                        <th>Available Seats</th>
                                        <td>{{ $c->available_seats }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Fare</th>
                                        <td>{{ $c->total_fare }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fare Per Head</th>
                                        <td>{{ $c->fare_per_head }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{ $c->status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
            
                        <!-- Edit and Delete Buttons -->
                        <div class="d-flex justify-content-end mt-3" style="gap: 10px;">
                            <a href="{{ route('carpool.edit', $c->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('carpool.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this carpool?');">
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
