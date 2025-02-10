@extends('driver.layouts.app', ['page' => __('Vehicle Information'), 'pageSlug' => 'vehicles'])

@section('content')
<div class="container">
    <h4 class="card-title mb-4">Your Vehicle</h4>

    <!-- Create Vehicle Button -->
    <a href="{{ route('driver.vehicle.create') }}" class="btn btn-primary mb-3">Create a New Vehicle</a>

    @if ($car->isEmpty())
        <p>No vehicles found.</p>
    @else
        <div class="row">
            @foreach ($car as $c)
            <div class="col-md-6 mb-4"> <!-- Two cards per row -->
                <div class="card shadow-lg p-3 rounded border">
                    <div class="card-body">

                        <!-- Car Image -->
                        <div class="text-center mb-3">
                            <img src="{{ asset('storage/' . $c->carImage) }}" alt="Car Image"
                                class="img-fluid rounded shadow-sm"
                                style="width: 100%; max-height: 200px; object-fit: cover;">
                        </div>

                        <!-- Car Details -->
                        <h5 class="text-primary fw-bold text-center mb-3">
                            {{ $c->carModel }} ({{ $c->carType }})
                        </h5>

                        <!-- 🔹 Driver ID (NEWLY ADDED) -->
                        <p class="text-center fw-bold text-primary" style="font-size: 16px;">
                            👤 Driver ID: {{ $c->driver ? $c->driver->studentID : 'No driver assigned' }}
                        </p>

                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-6">
                                <p class="mb-1"><strong>🚘 Color:</strong> {{ $c->carColor }}</p>
                                <p class="mb-1"><strong>🔢 Plate:</strong> {{ $c->carPlate }}</p>
                            </div>

                            <!-- Right Column -->
                            <div class="col-6">
                                <p class="mb-1"><strong>👥 Seats:</strong> {{ $c->carCapacity }}</p>
                                <p class="mb-1"><strong>📅 Road Tax:</strong> {{ $c->roadtaxExp }}</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end mt-3" style="gap: 10px;">
                            <a href="{{ route('driver.vehicle.edit', $c->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('driver.vehicle.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this vehicle?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
