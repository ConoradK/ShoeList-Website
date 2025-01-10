<!-- resources/views/auth/login.blade.php -->

@extends('layouts.app') <!-- Assuming you have a main layout -->

@section('content')
    <div class="login-container">
        <h2>Login</h2>
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>

    <div class="error-messages">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endsection
