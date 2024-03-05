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


Route::middleware('áuth:api')->group(function(){
Route::post('logout', [AuthApiController::class, 'logout']);
Route::get('user', [AuthApiController::class, 'user']);
Route::get('user', [AuthApiController::class, 'user']);
Route::get('vehicles', [ApiController::class, 'getAllVehicles']);

});