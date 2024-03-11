<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\ApiController;

Route::post('signup', [AuthApiController::class, 'signup']);
Route::post('login', [AuthApiController::class, 'login']);


Route::middleware('auth:api')->group(function(){
    Route::post('logout', [AuthApiController::class, 'logout']);
    Route::get('user', [AuthApiController::class, 'user']);
    Route::get('user', [AuthApiController::class, 'user']);
    Route::get('vehicles', [ApiController::class, 'getAllVehicles']);


    Route::get('/getVehicles', [ApiController::class, 'getVehicles']);
    Route::get('/getVehiclesByCategory', [ApiController::class, 'getVehiclesByCategory']);
    Route::get('/getVehicleDetail/{id}', [ApiController::class, 'getVehicle']);
    Route::get('/getCategories', [ApiController::class, 'getCategories']);
    Route::post('/rent/vehicle', [ApiController::class, 'rentVehicle']);
    Route::get('/rent-user-details/{id}', [ApiController::class, 'getUserRentalDetails']);
    Route::get('/user/rentals', [ApiController::class, 'getUserRentals']);
    Route::post('/user/update/rentals-status/{id}', [ApiController::class, 'updateRentalStatus']);
    Route::post('/user/update/rentals/{id}', [ApiController::class, 'updateRental']);


});