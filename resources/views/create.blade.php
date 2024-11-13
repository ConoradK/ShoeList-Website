@extends('layouts.app')

@section('content')
    <h1>Create a New Shoe</h1>

    <!-- Success message display if the session contains a success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }} <!-- Display the success message -->
        </div>
    @endif

    <!-- Form to create a new shoe -->
    <form action="{{ route('store') }}" method="POST">
        @csrf <!-- CSRF protection for the form -->
        
        <!-- Include the shoe form partial, which contains the input fields -->
        @include('partials.shoe-form')

        <!-- Submit button to create the new shoe -->
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
