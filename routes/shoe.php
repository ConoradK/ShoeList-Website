<?php

use App\Http\Controllers\ShoeController;
use Illuminate\Support\Facades\Route;
//use App\Http\Middleware\AdminMiddleware;
//use App\Http\Kernel;

// Define the root route ('/') which will render the 'welcome' view
// Route::get('/', function () {
//     return view('welcome');
// });

// Shoes routes with consistent shoes/{id}/action format
Route::get('/', [ShoeController::class, 'home'])->name('home');
Route::get('/search', [ShoeController::class, 'index'])->name('search');


// Routes with id parameter before the action
// Route::get('/{id}/edit', [ShoeController::class, 'edit'])->name('edit');
// Route::put('/{id}/update', [ShoeController::class, 'update'])->name('update');
// Route::delete('/{id}/delete', [ShoeController::class, 'destroy'])->name('delete');

// Autocomplete search route
Route::get('/search/autocomplete', [ShoeController::class, 'autocomplete'])->name('search.autocomplete');


// Route::post('/favorites/{shoe}', [ShoeController::class, 'addToFavorites'])->name('favorites.add')->middleware('auth');


Route::middleware(['auth', 'user'])->group(function () {
    Route::post('/favorites/add/{shoe}', [ShoeController::class, 'addToFavorites'])->name('favorites.add');
    Route::post('/remove-from-favourites/{shoe}', [ShoeController::class, 'removeFromFavourites'])->name('favorites.remove');

});




// Apply 'auth' and 'admin' middleware for create and store routes
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/create', [ShoeController::class, 'create'])->name('create');
//     Route::post('/store', [ShoeController::class, 'store'])->name('store');
// });


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/shoes/{id}/edit', [ShoeController::class, 'edit'])->name('edit');
    Route::put('/shoes/{id}', [ShoeController::class, 'update'])->name('update');
    Route::delete('/shoes/{id}', [ShoeController::class, 'destroy'])->name('delete');
    Route::get('/create', [ShoeController::class, 'create'])->name('create');
    Route::post('/store', [ShoeController::class, 'store'])->name('store');

});
