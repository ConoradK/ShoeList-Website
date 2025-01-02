@extends('layouts.app') <!-- Extends the base layout layouts.app -->

@section('content') <!-- Section that will define the content inside the content section of the layout -->
    <h1>Edit Shoe</h1> <!-- Title -->

    <!-- Display any global validation errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li> <!-- Display all validation errors -->
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form to edit an existing shoe -->
    <form action="{{ route('update', $shoe->product_code) }}" method="POST">
        @csrf <!-- CSRF protection to prevent Cross-Site Request Forgery attacks -->
        @method('PUT') <!-- HTTP method spoofing to send a PUT request, since HTML forms only support GET and POST -->
        
        <!-- Include the shoe form partial and pass the current shoe data to pre-fill the form fields -->
        @include('partials.shoe-form', ['shoe' => $shoe])

        <!-- Submit button to update the shoe details -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection <!-- End of the content section -->
