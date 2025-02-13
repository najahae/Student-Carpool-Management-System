<table class="table table-bordered">
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Student ID</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($passengers as $key => $passenger)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $passenger->fullname }}</td>
                <td>{{ $passenger->email }}</td>
                <td>{{ $passenger->phone }}</td>
                <td>{{ $passenger->student_id }}</td>
                <td>
                   @if ($passenger-> email != 'passenger2@gmail.com')
                    <a href="{{ route('admin.driver.show', $passenger->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('admin.driver.edit', $passenger->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('admin.driver.destroy', $passenger->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
