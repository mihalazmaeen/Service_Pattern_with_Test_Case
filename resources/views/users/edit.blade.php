<!-- edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit User</h2>
       <form action="{{ route('customuser.update', $customuser->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $customuser->name }}">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $customuser->email }}">
            </div>
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" class="form-control-file" id="photo" name="photo" onchange="previewImage(event)">
                <img id="preview" src="{{ asset('storage/' . $customuser->photo) }}" alt="{{ $customuser->name }}" width="100">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            var preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
