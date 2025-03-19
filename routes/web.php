<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'index']);

Route::get('login', [AuthController::class, 'user_login']);
Route::get('registrasi', [AuthController::class, 'user_registrasi']);
Route::post('registrasi', [AuthController::class, 'user_registrasi_a1']);
Route::get('registrasi/{slug}', [AuthController::class, 'user_registrasi_otp']);