@extends('passenger.layouts.app', ['page' => __('List of Carpools'), 'pageSlug' => 'carpool'])

@section('content')
<div class="container">
    <div class="card shadow-sm border rounded">
        <div class="card-body text-center">
            <h3 class="mb-4 text-success">Thank You!</h3>
            <p class="mb-4">
                Your joining request for the trip from 
                <strong>{{ $carpool->pickup_loc }}</strong> to 
                <strong>{{ $carpool->dropoff_loc }}</strong> 
                is pending approval from the driver.
            </p>

            <!-- Driver Details -->
            <div class="mb-4">
                <h5 class="text-primary">Driver Details</h5>
                <p class="mb-1"><strong>Name:</strong> {{ $carpool->driver->fullname ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Contact:</strong> {{ $carpool->driver->phoneNum ?? 'N/A' }}</p>
            </div>

            <!-- Vehicle Details -->
            <div class="mb-4">
                <h5 class="text-primary">Car Details</h5>
                <p class="mb-1"><strong>Model:</strong> {{ $carpool->car->carModel ?? 'N/A' }}</p>
                <p class="mb-1"><strong>License Plate:</strong> {{ $carpool->car->carPlate ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Color:</strong> {{ $carpool->car->carColor ?? 'N/A' }}</p>
            </div>

            <!-- Notification -->
            <p class="mb-4 text-muted">
                The driver will review your request soon. Please check back later for updates.
            </p>

            <!-- Back Button -->
            <a href="{{ route('passenger.carpool.index') }}" class="btn btn-primary">
                Back to Carpool Listings
            </a>
        </div>
    </div>
</div>
@endsection
