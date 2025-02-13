@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Add New Passenger</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.passenger.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Full Name -->
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="fullname" class="form-control" required>
        </div>

        <!-- Gender -->
        <div class="form-group">
            <label>Gender</label>
            <select name="gender" class="form-control" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <!-- Student ID -->
        <div class="form-group">
            <label>Student ID</label>
            <input type="text" name="student_id" class="form-control" required>
        </div>

        <!-- Phone -->
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <!-- Student Card Upload -->
        <div class="form-group">
            <label>Upload Student Card (JPG, PNG only)</label>
            <input type="file" name="student_card" class="form-control-file" accept=".jpg,.jpeg,.png" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Save Passenger</button>
    </form>
</div>

<style>
    
option {
    color: gray;
}
</style>
@endsection
