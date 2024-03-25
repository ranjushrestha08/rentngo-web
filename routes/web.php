<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function(){
    Route::resource('vehicleCategories', App\Http\Controllers\VehicleCategoryController::class);
    Route::resource('vehicles', App\Http\Controllers\VehicleController::class);
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('/users', App\Http\Controllers\UserDetailsController::class)->except(['create', 'store', 'delete']);
    Route::resource('/rentals', App\Http\Controllers\RentalController::class)->except(['create', 'store', 'delete']);

});

