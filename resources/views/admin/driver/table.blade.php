<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Gender</th>
            <th>Student ID</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($drivers as $key => $driver)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $driver->fullname }}</td>
            <td>{{ ucfirst($driver->gender) }}</td>
            <td>{{ $driver->student_id }}</td>
            <td>{{ $driver->email }}</td>
            <td>{{ $driver->phone }}</td>
            <td>
                <a href="{{ route('admin.driver.show', $driver->id) }}" class="btn btn-info btn-sm">View</a>
                
                <form action="{{ route('admin.driver.destroy', $driver->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
