@extends('passenger.layouts.app', ['page' => __('Incoming Trips'), 'pageSlug' => 'incoming-trips'])

@section('content')
<div class="container">
    <h2>Incoming Trips</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Driver</th>
                <th>Pickup Location</th>
                <th>Destination</th>
                <th>Carpool Date</th>
                <th>Carpool Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr>
                <td>{{ $booking->carpool->driver->fullname }}</td>
                <td>{{ $booking->carpool->pickup_loc }}</td>
                <td>{{ $booking->carpool->dropoff_loc }}</td>
                <td>{{ $booking->carpool->pickup_date }}</td>
                <td>{{ $booking->carpool->pickup_time }}</td>
                <td>
                    @if($booking->status == 'accepted')
                        <span class="badge bg-success">Accepted</span>
                    @elseif($booking->status == 'rejected')
                        <span class="badge bg-danger">Rejected</span>
                    @else
                        <span class="badge bg-warning">Pending</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No upcoming trips.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
