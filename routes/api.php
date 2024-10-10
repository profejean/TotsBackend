<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReservationController; 
use App\Http\Middleware\JwtMiddleware;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Cambia 'jwt' por 'jwt.verify'
Route::middleware(['jwt.verify'])->group(function () {
    //Spaces
    Route::get('spaces', [SpaceController::class, 'index']);
    Route::post('spaces', [SpaceController::class, 'store']);
    Route::get('spaces/{id}', [SpaceController::class, 'show']);
    Route::put('spaces/{id}', [SpaceController::class, 'update']);
    Route::delete('spaces/{id}', [SpaceController::class, 'destroy']);

    //Reservations
    Route::get('reservations', [ReservationController::class, 'index']);
    Route::post('reservations', [ReservationController::class, 'store']);
    Route::get('reservations/{id}', [ReservationController::class, 'show']);
    Route::put('reservations/{id}', [ReservationController::class, 'update']);
    Route::delete('reservations/{id}', [ReservationController::class, 'destroy']);

    //Images
    Route::post('spaces/{spaces}/images', [ImageController::class, 'store']);
    Route::get('spaces/{spaces}/images', [ImageController::class, 'index']);

    // Services
    Route::get('services', [ServiceController::class, 'index']);
    Route::post('services', [ServiceController::class, 'store']);
    Route::get('services/{id}', [ServiceController::class, 'show']);
    Route::put('services/{id}', [ServiceController::class, 'update']);
    Route::delete('services/{id}', [ServiceController::class, 'destroy']); 

});
