@extends('admin.layouts.app', ['pageSlug' => 'passenger-management'])

@section('content')
<div class="container">
    <h2>Passenger Details</h2>
    <table class="table">
        <tr><th>Full Name</th><td>{{ $passenger->name }}</td></tr>
        <tr><th>Gender</th><td>{{ $passenger->gender }}</td></tr>
        <tr><th>Student ID</th><td>{{ $passenger->student_id }}</td></tr>
        <tr><th>Phone</th><td>{{ $passenger->phone }}</td></tr>
        <tr><th>Email</th><td>{{ $passenger->email }}</td></tr>
        <tr><th>Student Card</th>
            <td>
                @if($passenger->student_card)
                    <img src="{{ asset('storage/' . $passenger->student_card) }}" width="200">
                @else
                    No Student Card Uploaded
                @endif
            </td>
        </tr>
    </table>
    <a href="{{ route('admin.passenger.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
