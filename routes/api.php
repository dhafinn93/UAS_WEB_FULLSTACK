<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KosController;
use App\Http\Controllers\API\ReviewController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/kos', [KosController::class, 'index']);
Route::get('/kos/{id}', [KosController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::apiResource('reviews', ReviewController::class);

});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {

        Route::post('/kos', [KosController::class, 'store']);

        Route::put('/kos/{id}', [KosController::class, 'update']);

        Route::delete('/kos/{id}', [KosController::class, 'destroy']);
    });