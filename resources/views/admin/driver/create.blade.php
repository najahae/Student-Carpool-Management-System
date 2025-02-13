@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Driver</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.driver.store') }}" method="POST">
        @csrf

        <!--Full Name -->
        <div class="mb-3">
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname"  required>
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-control" id="gender" name="gender"  required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="student_id" class="form-label">Student ID</label>
            <input type="text" class="form-control" id="student_id" name="student_id"  required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone"  required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value='awdwawdawd' required>
        </div>

          <!-- Student Card Upload -->
          <div class="form-group">
            <label>Upload Student Card (JPG, PNG only)</label>
            <input type="file" name="studentCard" class="form-control-file" accept=".jpg,.jpeg,.png" required>
        </div>
 
          <!-- Student Card Upload -->
          <div class="form-group">
            <label>Upload License Card (JPG, PNG only)</label>
            <input type="file" name="licenseCard" class="form-control-file " accept=".jpg,.jpeg,.png" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Driver</button>
    </form>
</div>

<style>
    
option {
    color: gray;
}
</style>
@endsection
