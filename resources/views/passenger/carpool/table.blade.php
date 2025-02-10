@extends('passenger.layouts.app', ['page' => __('Join A Carpool'), 'pageSlug' => 'carpool'])

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>List of Timetables</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('timetables.create') }}"> Add New Timetable</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Driver ID</th>
        <th>Date</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Pickup Location</th>
        <th>Destination</th>
        <th>Available Seats</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($timetables as $timetable)
    <tr>
        <td>{{ $timetable->id }}</td>
        <td>{{ $timetable->driver_id }}</td>
        <td>{{ $timetable->date }}</td>
        <td>{{ $timetable->start_time }}</td>
        <td>{{ $timetable->end_time }}</td>
        <td>{{ $timetable->pickup_location }}</td>
        <td>{{ $timetable->destination }}</td>
        <td>{{ $timetable->available_seats }}</td>
        <td>
            <form action="{{ route('timetables.destroy', $timetable->id) }}" method="POST">

                <a class="btn btn-info" href="{{ route('timetables.show', $timetable->id) }}">Show</a>

                <a class="btn btn-primary" href="{{ route('timetables.edit', $timetable->id) }}">Edit</a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
