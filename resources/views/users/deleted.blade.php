<!-- deleted.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Soft-Deleted Users</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deletedUsers as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->addresses->first()->street ?? '' }},{{ $user->addresses->first()->state ?? '' }},{{ $user->addresses->first()->city ?? '' }},{{ $user->addresses->first()->country ?? '' }}</td>
                        <td>
                            <form action="{{ route('restore', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Restore</button>
                            </form>
                            <form action="{{ route('destroy-permanently', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Permanently Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
