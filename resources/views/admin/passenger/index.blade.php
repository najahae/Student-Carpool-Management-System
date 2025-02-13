@extends('admin.layouts.app', ['pageSlug' => 'passenger-management'])

@section('content')

<!-- Passenger Management Title -->
<div class="row">
    <div class="col-12 text-center mb-5">
        <h1 class="display-2 text-white">{{ __('PASSENGER MANAGEMENT') }}</h1>
    </div>
</div>

<!-- Flash Message for Success -->
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Add Passenger Button -->
<div class="mb-3">
    <a href="{{ route('admin.passenger.create') }}" class="btn btn-success">Add New Passenger</a>
</div>
@php
    $passengers = \App\Models\Passenger::all();
@endphp
<!-- Passenger Table -->
<table class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Full Name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Student ID</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @isset($passengers)
            @forelse ($passengers as $key => $passenger)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $passenger->name }}</td>
                    <td>{{ $passenger->gender }}</td>
                    <td>{{ $passenger->email }}</td>
                    <td>{{ $passenger->phone }}</td>
                    <td>{{ $passenger->student_id }}</td>
                    <td class="flex-wrap">
                        <!-- Edit Button -->
                        
                        <!-- View Button -->
                        <a href="{{ route('admin.passenger.show', $passenger->id) }}" class="btn btn-info btn-sm">View</a>

                        <!-- Verify Identity Button -->
                        <form action="{{ route('admin.passenger.verify', $passenger->id) }}" method="POST" style="display:inline;">
                            @csrf
                        </form>

                        <!-- Suspend Account Button -->
                        <form action="{{ route('admin.passenger.suspend', $passenger->id) }}" method="POST" style="display:inline;">
                            @csrf
                        </form>

                        <!-- Delete Button -->
                        <form action="{{ route('admin.passenger.destroy', $passenger->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this passenger?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No passengers found.</td>
                </tr>
            @endforelse
        @endisset
    </tbody>
</table>

<style>
    .flex-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    </style>

@endsection
