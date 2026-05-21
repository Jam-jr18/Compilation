<?php

use App\Http\Controllers\BookFormController;
use Illuminate\Support\Facades\Route;

// Show the form
Route::get('/borrow-book', [BookFormController::class, 'create']);

// Handle the form submission
Route::post('/borrow-book', [BookFormController::class, 'store']);