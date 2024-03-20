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
            @foreach ($customuser->addresses as $index => $address)
                <div class="form-group">
                    <label for="street{{ $index }}">Street:</label>
                    <input type="text" class="form-control" id="street{{ $index }}" name="addresses[{{ $index }}][street]" value="{{ $address->street }}">
                    <input type="hidden" name="addresses[{{ $index }}][id]" value="{{ $address->id }}">
                </div>
                <div class="form-group">
                    <label for="city{{ $index }}">City:</label>
                    <input type="text" class="form-control" id="city{{ $index }}" name="addresses[{{ $index }}][city]" value="{{ $address->city }}">
                </div>
                <div class="form-group">
                    <label for="state{{ $index }}">State:</label>
                    <input type="text" class="form-control" id="state{{ $index }}" name="addresses[{{ $index }}][state]" value="{{ $address->state }}">
                </div>
                <div class="form-group">
                    <label for="country{{ $index }}">Country:</label>
                    <input type="text" class="form-control" id="country{{ $index }}" name="addresses[{{ $index }}][country]" value="{{ $address->country }}">
                </div>
                @endforeach
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
