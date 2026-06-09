<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PinAuthController;
use App\Http\Controllers\StaffPanelController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CustomerController::class, 'index'])->name('home');
Route::post('/orders', [CustomerController::class, 'store'])->name('orders.store');
Route::get('/receipt/{order:order_number}', [CustomerController::class, 'receipt'])->name('orders.receipt');
Route::get('/track', [CustomerController::class, 'trackForm'])->name('orders.track.form');
Route::get('/track/{order:order_number}', [CustomerController::class, 'track'])->name('orders.track');
Route::post('/track', [CustomerController::class, 'trackRedirect'])->name('orders.track.redirect');

Route::get('/portal', [PinAuthController::class, 'portal'])->name('portal');
Route::get('/login/{role}', [PinAuthController::class, 'show'])->whereIn('role', ['staff', 'admin'])->name('login.show');
Route::post('/login/{role}', [PinAuthController::class, 'login'])->whereIn('role', ['staff', 'admin'])->name('login.attempt');
Route::post('/logout/{role}', [PinAuthController::class, 'logout'])->whereIn('role', ['staff', 'admin'])->name('logout');

Route::middleware('bee.role:staff')->prefix('staff')->name('staff.')->group(function () {
    Route::get('/orders', [StaffPanelController::class, 'index'])->name('orders');
    Route::patch('/orders/{order}/status', [StaffPanelController::class, 'updateStatus'])->name('orders.status');
});

Route::middleware('bee.role:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminPanelController::class, 'dashboard'])->name('dashboard');
    Route::get('/menu', [AdminPanelController::class, 'menu'])->name('menu');
    Route::post('/categories', [AdminPanelController::class, 'storeCategory'])->name('categories.store');
    Route::patch('/categories/{category}', [AdminPanelController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminPanelController::class, 'deleteCategory'])->name('categories.delete');
    Route::post('/items', [AdminPanelController::class, 'storeItem'])->name('items.store');
    Route::patch('/items/{item}', [AdminPanelController::class, 'updateItem'])->name('items.update');
    Route::delete('/items/{item}', [AdminPanelController::class, 'deleteItem'])->name('items.delete');
    Route::get('/tables', [AdminPanelController::class, 'tables'])->name('tables');
    Route::post('/tables', [AdminPanelController::class, 'storeTable'])->name('tables.store');
    Route::patch('/tables/{table}', [AdminPanelController::class, 'updateTable'])->name('tables.update');
    Route::delete('/tables/{table}', [AdminPanelController::class, 'deleteTable'])->name('tables.delete');
    Route::get('/settings', [AdminPanelController::class, 'settings'])->name('settings');
    Route::patch('/settings', [AdminPanelController::class, 'updateSettings'])->name('settings.update');
    Route::get('/reports/sales.csv', [AdminPanelController::class, 'exportSales'])->name('reports.sales');
});
