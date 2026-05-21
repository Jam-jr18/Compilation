<?php

use App\Http\Controllers\GuitarController;
Route::resource('guitars', GuitarController::class);
Route::get('/', function () { return redirect('/guitars'); });