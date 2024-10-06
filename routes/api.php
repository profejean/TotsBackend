<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\ImageController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware(['jwt'])->group(function () {
    //Spaces
    Route::get('spaces', [SpaceController::class, 'index']);
    Route::post('spaces', [SpaceController::class, 'store']);
    Route::get('spaces/{id}', [SpaceController::class, 'show']);
    Route::put('spaces/{id}', [SpaceController::class, 'update']);
    Route::delete('spaces/{id}', [SpaceController::class, 'destroy']);

    //Reservartion
    Route::get('reservations', [ReservationController::class, 'index']);
    Route::post('reservations', [ReservationController::class, 'store']);
    Route::get('reservations/{id}', [ReservationController::class, 'show']);
    Route::put('reservations/{id}', [ReservationController::class, 'update']);
    Route::delete('reservations/{id}', [ReservationController::class, 'destroy']);

    //Images
    Route::post('spaces/{space}/images', [ImageController::class, 'store']);
    Route::get('spaces/{space}/images', [ImageController::class, 'index']);


});