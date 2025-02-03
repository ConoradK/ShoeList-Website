<!-- resources/views/auth/login.blade.php -->

@extends('layouts.app') 

@section('content') <!-- Start of the content section -->
    <div class="login-container"> <!-- Container for the login form -->
        <h2>Login</h2> <!-- Login form heading -->
        <form action="{{ route('login.submit') }}" method="POST"> <!-- Form submission to login.submit route -->
            @csrf <!-- CSRF protection token for form submission -->
            <div class="input-group"> <!-- Input group for username field -->
                <label for="username">Username</label> <!-- Label for the username input -->
                <input type="text" name="username" id="username" required> <!-- Username input field, required -->
            </div>
            <div class="input-group"> <!-- Input group for password field -->
                <label for="password">Password</label> <!-- Label for the password input -->
                <input type="password" name="password" id="password" required> <!-- Password input field, required -->
            </div>
            <button type="submit">Login</button> <!-- Submit button for the form -->
        </form>
    </div>

    <div class="error-messages"> <!-- Container for displaying error messages -->
        <ul>
            @foreach($errors->all() as $error) <!-- Loop through all error messages -->
                <li>{{ $error }}</li> <!-- Display each error in a list item -->
            @endforeach
        </ul>
    </div>

@endsection <!-- End of content section -->
