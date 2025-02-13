@extends('admin.layouts.app', ['pageSlug' => 'passenger-management'])

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Passenger</h2>
    <form action="{{ route('admin.driver.update', $passenger->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="fullname" class="form-control" value="{{ $passenger->fullname }}" required>
        </div>
        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" class="form-control" required>
                <option value="Male" {{ $passenger->gender == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ $passenger->gender == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Student ID</label>
            <input type="text" name="student_id" class="form-control" value="{{ $passenger->student_id }}" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $passenger->phone }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $passenger->email }}" required>
        </div>
        <div class="mb-3">
            <label>Upload Student Card</label>
            <input type="file" name="student_card" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Update Passenger</button>
    </form>
</div>
@endsection
