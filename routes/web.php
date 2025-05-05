<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\RootController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RootMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
 
Route::get('/', [GuestController::class, 'index']); 
Route::get('s', function() { return response()->json(Session::all()); }); 
Route::get('logout', function() { Session::flush(); return redirect()->to(''); }); 

Route::get('login', [AuthController::class, 'user_login']);
Route::post('login', [AuthController::class, 'user_login_verifikasi']);
Route::get('registrasi', [AuthController::class, 'user_registrasi']);
Route::post('registrasi', [AuthController::class, 'user_registrasi_init']);
Route::get('registrasi/informasi/{slug}', [AuthController::class, 'user_registrasi_informasi']);
Route::get('registrasi/verifikasi/{slug}', [AuthController::class, 'user_registrasi_verifikasi']);
Route::post('registrasi/identitas', [AuthController::class, 'user_registrasi_save']);

// Users
Route::middleware([UserMiddleware::class])->group(function () {
    Route::get('homepage', [DashboardController::class, 'index']);
    Route::post('presensi-masuk', [PresensiController::class, 'rekap_masuk']);
    Route::post('presensi-pulang', [PresensiController::class, 'rekap_pulang']);

    Route::get('riwayat-presensi', [DashboardController::class, 'presensi']);

    Route::get('laporan-lembur', [DashboardController::class, 'lembur']);
    Route::post('lembur/request', [LemburController::class, 'request']);

    Route::get('izin-cuti', [DashboardController::class, 'cuti']);
    Route::post('izin-cuti/request', [CutiController::class, 'request']);

    Route::get('kalender-perusahaan', [DashboardController::class, 'kalender']);

    Route::get('profil-saya', [DashboardController::class, 'profil']);
    Route::post('profil/pp', [UserController::class, 'profil_pp']);
    Route::post('profil/nama', [UserController::class, 'profil_nama']);
});

// Root
Route::get('root', function() { return redirect()->to('root/login'); });
Route::get('root/login', [AuthController::class, 'root_login']);
Route::post('root/login', [AuthController::class, 'root_login_verifikasi']);
Route::middleware([RootMiddleware::class])->group(function () {
    Route::get('root/index', [RootController::class, 'index']); 

    Route::get('root/karyawan', [RootController::class, 'karyawan']); 
    Route::get('root/karyawan/{slug}', [RootController::class, 'karyawan_detail']); 

    Route::get('root/sesi', [RootController::class, 'sesi']);
    Route::get('root/sesi/{slug}', [RootController::class, 'sesi_detail']);

    Route::post('root/sesi/add', [RootController::class, 'sesi_add']);
    Route::post('root/sesi/del', [RootController::class, 'sesi_del']);

    Route::get('root/lembur', [RootController::class, 'lembur']);
    Route::post('root/lembur/response', [RootController::class, 'lembur_response']);

    Route::get('root/cuti', [RootController::class, 'cuti']);
    Route::post('root/cuti/response', [RootController::class, 'cuti_response']); 

    Route::get('root/kalender', [RootController::class, 'kalender']);
    Route::post('root/kalender/add', [RootController::class, 'kalender_add']);
    Route::post('root/kalender/delete', [RootController::class, 'kalender_delete']);
});
