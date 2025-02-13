@extends('driver.layouts.app', ['page' => __('Booking Request'), 'pageSlug' => 'booking'])

@section('content')
<div class="container">
    <h2>Passenger Booking Requests</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Passenger</th>
                <th>Carpool Driver</th>
                <th>Pickup Location</th>
                <th>Destination</th>
                <th>Carpool Date</th>
                <th>Carpool Time</th>
                <th>Number of Passengers</th>
                <th>Fare Per Head</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {{Auth::user()->id}}
            @if ($bookings->count() == 0)
                <tr>
                    <td colspan="6" class="text-center">No pending booking requests.</td>
                </tr>
          
            @else 
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->passenger->name }}</td>
                        <td>{{ $booking->carpool->driver->fullname }}</td>
                        <td>{{ $booking->carpool->pickup_loc }}</td>
                        <td>{{ $booking->carpool->dropoff_loc }}</td>
                        <td>{{ $booking->carpool->pickup_date }}</td>
                        <td>{{ $booking->carpool->pickup_time }}</td>
                        <td>{{ $booking->number_of_passengers }}</td>
                        <td>RM{{ number_format($booking->carpool->fare_per_head, 2) }}</td>
                        <td><span class="badge bg-warning">{{ ucfirst($booking->status) }}</span></td>
                        <td class="flex-wrap">
                            <form action="{{ route('driver.booking.accept', ['booking' => $booking->id])}}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Accept</button>
                            </form>

                            <form action="{{ route('driver.booking.reject', ['booking' => $booking->id])}}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<style>
    .flex-wrap form { 
        display: flex !important;
        margin: 0.5rem 0;
    }
    </style>
@endsection
