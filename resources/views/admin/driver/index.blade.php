@extends('admin.layouts.app', ['pageSlug' => 'driver-management'])
@section('content')

<!-- Driver Management Title -->
<div class="row">
    <div class="col-12 text-center mb-5">
        <h1 class="display-2 text-white">{{ __('DRIVER MANAGEMENT') }}</h1>
    </div>
</div>

<!-- Flash Message for Success -->
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Add Driver Button -->
<div class="mb-3">
    <a href="{{ route('admin.driver.create') }}" class="btn btn-success">Add New Driver</a>
</div>
@php 
    $drivers = \App\Models\Driver::all();
@endphp
<!-- Driver Table -->
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
        @isset($drivers)
            @forelse ($drivers as $key => $driver)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $driver->fullname }}</td>
                    <td>{{ $driver->gender }}</td>
                    <td>{{ $driver->email }}</td>
                    <td>{{ $driver->phoneNum }}</td>
                    <td>{{ $driver->studentID }}</td>
                    <td class="flex-wrap">
                        <!-- Edit Button -->
                        
                        <!-- View Button -->
                        <a href="{{ route('admin.driver.show', $driver->id) }}" class="btn btn-info btn-sm">View</a>

                        <!-- Verify Identity Button -->
                        <form action="{{ route('admin.driver.verify', $driver->id) }}" method="POST" style="display:inline;">
                            @csrf
                        </form>

                        <!-- Suspend Account Button -->
                        <form action="{{ route('admin.driver.suspend', $driver->id) }}" method="POST" style="display:inline;">
                            @csrf
                        </form>

                        <!-- Delete Button -->
                        <form action="{{ route('admin.driver.destroy', $driver->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this driver?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No drivers found.</td>
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
