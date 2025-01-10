<?php

use App\Http\Controllers\ShoeController;
use Illuminate\Support\Facades\Route;


// Shoes routes with consistent shoes/{id}/action format
Route::get('/', [ShoeController::class, 'home'])->name('home'); // Home route for the shoe store
Route::get('/search', [ShoeController::class, 'index'])->name('search'); // Search route to filter shoes


// Autocomplete search route
Route::get('/search/autocomplete', [ShoeController::class, 'autocomplete'])->name('search.autocomplete'); // Autocomplete search for shoe names


// Routes accessible to authenticated users with 'user' role
Route::middleware(['auth', 'user'])->group(function () {
    Route::post('/favorites/add/{shoe}', [ShoeController::class, 'addToFavorites'])->name('favorites.add'); // Add shoe to favorites
    Route::post('/remove-from-favourites/{shoe}', [ShoeController::class, 'removeFromFavourites'])->name('favorites.remove'); // Remove shoe from favorites
});


// Routes accessible to authenticated users with 'admin' role
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/shoes/{id}/edit', [ShoeController::class, 'edit'])->name('edit'); // Edit shoe details
    Route::put('/shoes/{id}', [ShoeController::class, 'update'])->name('update'); // Update shoe details
    Route::delete('/shoes/{id}', [ShoeController::class, 'destroy'])->name('delete'); // Delete a shoe
    Route::get('/create', [ShoeController::class, 'create'])->name('create'); // Create a new shoe form
    Route::post('/store', [ShoeController::class, 'store'])->name('store'); // Store new shoe in the database
});
