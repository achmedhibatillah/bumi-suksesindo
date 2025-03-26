<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'index']); 
Route::get('s', function() { return response()->json(Session::all()); }); 

Route::get('login', [AuthController::class, 'user_login']);
Route::get('registrasi', [AuthController::class, 'user_registrasi']);
Route::post('registrasi', [AuthController::class, 'user_registrasi_init']);
Route::get('registrasi/informasi/{slug}', [AuthController::class, 'user_registrasi_informasi']);
Route::get('registrasi/verifikasi/{slug}', [AuthController::class, 'user_registrasi_verifikasi']);
Route::post('registrasi/identitas', [AuthController::class, 'user_registrasi_save']);

Route::middleware([UserMiddleware::class])->group(function () {
    Route::get('homepage', [DashboardController::class, 'index']);
});