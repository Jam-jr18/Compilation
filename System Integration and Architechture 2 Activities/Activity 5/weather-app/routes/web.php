<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController; // Import your Weather Controller
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// MODIFIED: Pointing to WeatherController@index instead of a simple function
Route::get('/dashboard', [WeatherController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';