@extends('driver.layouts.app', ['page' => __('Carpool Information'), 'pageSlug' => 'carpool'])

@section('content')
<div class="container">
    <h4 class="card-title mb-3">Your Carpool Information</h4>

    <!-- Create Carpool Button -->
    <a href="{{ route('driver.carpool.create') }}" class="btn btn-primary mb-3">Create a New Carpool</a>

    @if ($carpool->isEmpty())
        <p>No carpool found.</p>
    @else
        <div class="row">
            @foreach ($carpool as $c)
            <div class="col-md-6 mb-3"> <!-- 2 Cards per row -->
                <div class="card shadow-sm p-2 rounded border">
                    <div class="card-body">

                        <!-- Header: Title + Status + Seats -->
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-primary fw-bold mb-0">Carpool #{{ $c->id }}</h6>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-secondary me-2">🚗 Available Seats: {{ $c->available_seats }}/{{ $c->car->carCapacity ?? '-' }}</span>
                                    <span class="badge {{ $c->status == 'open' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($c->status) }}
                                </span>
                            </div>
                        </div>

                        <hr class="mt-1 mb-2">

                        <!-- Two-Column Layout -->
                        <div class="row">
                            <!-- Left Column (Driver & Car) -->
                            <div class="col-6">
                                <small class="text-muted">👤 Driver</small>
                                <p class="mb-1"><strong>ID:</strong> {{ $c->driver->studentID ?? '-' }}</p>
                                <p class="mb-1"><strong>Name:</strong> {{ $c->driver->fullname ?? '-' }}</p>
                                <p class="mb-1"><strong>Gender:</strong> {{ $c->driver->gender ?? '-' }}</p>
                                
                                <small class="text-muted">🚘 Car</small>
                                <p class="mb-1"><strong>Model:</strong> {{ $c->car->carModel ?? '-' }}</p>
                                <p class="mb-1"><strong>Plate:</strong> {{ $c->car->carPlate ?? '-' }}</p>
                                <p class="mb-1"><strong>Capacity:</strong> {{ $c->car->carCapacity ?? '-' }}</p>
                            </div>

                            <!-- Right Column (Ride Details) -->
                            <div class="col-6">
                                <small class="text-muted">📍 Route</small>
                                <p class="mb-1"><strong>From:</strong> {{ $c->pickup_loc }}</p>
                                <p class="mb-1"><strong>To:</strong> {{ $c->dropoff_loc }}</p>

                                <small class="text-muted">📅 Details</small>
                                <p class="mb-1"><strong>Date:</strong> {{ $c->pickup_date }}</p>
                                <p class="mb-1"><strong>Total Fare:</strong> RM{{ $c->total_fare }}</p>
                                <!-- <p class="mb-1"><strong>Fare Per Head:</strong> RM{{ $c->fare_per_head }}</p> -->
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end mt-2" style="gap: 8px;">
                            <a href="{{ route('driver.carpool.edit', $c->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('driver.carpool.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this carpool?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div> <!-- Close row -->
    @endif
</div>
@endsection
