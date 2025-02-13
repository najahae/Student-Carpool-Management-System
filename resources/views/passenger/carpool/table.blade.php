@extends('passenger.layouts.app', ['page' => __('List of Carpools'), 'pageSlug' => 'carpool'])

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>List of Carpools</h2>
        </div>
    </div>
</div>

<!-- Gender Filter Form -->
<form action="{{ route('passenger.carpool.index') }}" method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <label for="gender">Filter by Driver Gender:</label>
            <select name="gender" class="form-control">
                <option value="">All</option>
                <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </div>
</form>

<!-- Display carpools -->
@if ($carpool->count() > 0)
    <div class="row">
        @foreach ($carpool as $c) 
        @if(\App\Models\Booking::where('passenger_id', Auth::id())->pluck('carpool_id')->contains($c->id))



        @else
        <div class="col-md-6 mb-4">
            <div class="card border rounded shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <!--<div class="me-3">
                            <img src="{{ asset('path_to_driver_image_placeholder') }}" class="rounded-circle" alt="Driver" width="60">
                        </div>-->
                        <div>
                            <h5 class="mb-1">{{ optional($c->driver)->fullname ?? 'No Driver Assigned' }}</h5>
                            <p class="text-muted mb-1">{{ ucfirst(optional($c->driver)->gender ?? 'N/A') }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="mb-1"><strong>Pickup:</strong> {{ $c->pickup_loc }}</p>
                            <p class="mb-1"><strong>Destination:</strong> {{ $c->dropoff_loc }}</p>
                        </div>
                        <div>
                            <p class="mb-1"><strong>Date:</strong> {{ $c->pickup_date }}</p>
                            <p class="mb-1"><strong>Time:</strong> {{ $c->pickup_time }}</p>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <p class="mb-1"><strong>Car Model:</strong> {{ optional($c->car)->carModel ?? 'Not Available' }}</p>
                        <p class="mb-1"><strong>Car Capacity:</strong> {{ optional($c->car)->carCapacity ?? 'Not Available' }}</p>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0"><strong>Seats Available:</strong> {{ $c->available_seats }}</p>
                        </div>
                        <div>
                            <form action="{{ route('passenger.carpool.join', $c->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @if($c->car->carModel != "Perodua Axia")
                                <button type="submit" class="btn btn-primary">Join</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
@else
    <p class="text-center">No carpool found.</p>
@endif

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
@endsection
