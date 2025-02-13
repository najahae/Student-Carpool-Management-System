@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Driver</h2>

    <form action="{{ route('admin.driver.update', ['id' => $driver->id]) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $driver->fullname }}" required>
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-control" id="gender" name="gender">
                <option value="male" {{ $driver->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $driver->gender == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ $driver->gender == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="student_id" class="form-label">Student ID</label>
            <input type="text" class="form-control" id="student_id" name="student_id" value="{{ $driver->studentID }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $driver->email }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $driver->phoneNum }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Driver</button>
    </form>
</div>
@endsection
