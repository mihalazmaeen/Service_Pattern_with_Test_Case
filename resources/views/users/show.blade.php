<!-- show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>User Details</h2>
        <div>
            <p><strong>Name:</strong> {{ $customuser->name }}</p>
            <p><strong>Email:</strong> {{ $customuser->email }}</p>
            <p><strong>Photo:</strong> <img src="{{ asset('storage/' . $customuser->photo) }}" alt="{{ $customuser->name }}" width="200"></p>
            <p><strong>Created At:</strong> {{ $customuser->created_at }}</p>
            <p><strong>Updated At:</strong> {{ $customuser->updated_at }}</p>
            <p><strong>Deleted At:</strong> {{ $customuser->deleted_at }}</p>
        </div>
    </div>
@endsection
