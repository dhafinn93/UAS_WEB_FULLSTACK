<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KosController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;

//Admin
Route::middleware(['auth','admin'])->group(function(){

    Route::get('/admin/dashboard',[DashboardController::class,'index']);
    Route::resource('/admin/kos',KosController::class);
});

//User
Route::middleware(['auth','user'])->group(function(){

    Route::get('/user/dashboard', [UserDashboardController::class,'index']);
    Route::get('/user/review/create/{id}', [ReviewController::class,'create']);
    Route::resource('/user/review',ReviewController::class);
});

//publik
Route::get('/',[HomeController::class,'index']);
Route::get('/detail_kos/{id}',[HomeController::class,'show']);
Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login']);
Route::get('/register',[AuthController::class,'showRegister']);
Route::post('/register',[AuthController::class,'register']);
Route::post('/logout',[AuthController::class,'logout'])->name('logout');