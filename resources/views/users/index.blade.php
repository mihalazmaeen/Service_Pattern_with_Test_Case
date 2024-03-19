<!-- users.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>User List</h2>
        <div class="mb-3">
            <a href="{{ route('customuser.create') }}" class="btn btn-success">Create User</a>
        </div>
        <div class="mb-3">
            <a href="{{ route('deleted') }}" class="btn btn-success">Show Deleted User</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" width="100"></td>
                        <td>
                            <a href="{{ route('customuser.show', $user->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('customuser.edit', $user->id) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('customuser.destroy', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
