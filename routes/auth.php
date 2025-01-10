<?php

use App\Http\Controllers\AuthController;

// Show the login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Handle login form submission
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


// Handle logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
