<?php

use App\Http\Controllers\ShoeController;
use Illuminate\Support\Facades\Route;

// Define the root route ('/') which will render the 'welcome' view
Route::get('/', function () {
    return view('welcome');
});

// Shoes routes with consistent shoes/{id}/action format
Route::get('/', [ShoeController::class, 'home'])->name('home');
Route::get('/search', [ShoeController::class, 'index'])->name('search');
Route::get('/create', [ShoeController::class, 'create'])->name('create');
Route::post('/store', [ShoeController::class, 'store'])->name('store');

// Routes with id parameter before the action
Route::get('/{id}/edit', [ShoeController::class, 'edit'])->name('edit');
Route::put('/{id}/update', [ShoeController::class, 'update'])->name('update');
Route::delete('/{id}/delete', [ShoeController::class, 'destroy'])->name('delete');

// Autocomplete search route
Route::get('/search/autocomplete', [ShoeController::class, 'autocomplete'])->name('search.autocomplete');
