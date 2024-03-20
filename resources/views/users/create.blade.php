<!-- create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create User</h2>
        <form action="{{ route('customuser.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
              <div id="address-fields">
            <div class="form-group">
                <label for="street">Street:</label>
                <input type="text" class="form-control" name="address[0][street]">
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" name="address[0][city]">
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" class="form-control" name="address[0][state]">
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" class="form-control" name="address[0][country]">
            </div>
        </div>
        <button type="button" class="btn btn-secondary" id="add-address">Add Address</button>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
    document.getElementById('add-address').addEventListener('click', function () {
        const addressFields = document.getElementById('address-fields');
        const newAddressField = document.createElement('div');
        newAddressField.className = 'address-group';
        newAddressField.innerHTML = `
            <div class="form-group">
                <label>Street:</label>
                <input type="text" class="form-control" name="address[${addressFields.children.length}][street]">
            </div>
            <div class="form-group">
                <label>City:</label>
                <input type="text" class="form-control" name="address[${addressFields.children.length}][city]">
            </div>
            <div class="form-group">
                <label>State:</label>
                <input type="text" class="form-control" name="address[${addressFields.children.length}][state]">
            </div>
            <div class="form-group">
                <label>Country:</label>
                <input type="text" class="form-control" name="address[${addressFields.children.length}][country]">
            </div>
        `;
        addressFields.appendChild(newAddressField);
    });
        function previewImage(event) {
            var preview = document.getElementById('preview');
            preview.style.display = 'block';
            preview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
