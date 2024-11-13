<?php

use App\Http\Controllers\ShoeController;
use Illuminate\Support\Facades\Route;

// Define the root route ('/') which will render the 'welcome' view
Route::get('/', function () {
    return view('welcome');
});

// Shoes routes with consistent shoes/{product_code}/action format
Route::get('/', [ShoeController::class, 'home'])->name('home');
Route::get('/search', [ShoeController::class, 'index'])->name('search');
Route::get('/create', [ShoeController::class, 'create'])->name('create');
Route::post('/store', [ShoeController::class, 'store'])->name('store');

// Routes with product_code parameter before the action
Route::get('/{product_code}/edit', [ShoeController::class, 'edit'])->name('edit');
Route::put('/{product_code}/update', [ShoeController::class, 'update'])->name('update');
Route::delete('/{product_code}/delete', [ShoeController::class, 'destroy'])->name('delete');
