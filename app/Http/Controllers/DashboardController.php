<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Sesi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Homepage',
            'page' => 'homepage',
        ];

        $sesiData = Sesi::whereRaw('sesi_masuk - INTERVAL 1 HOUR <= ?', [now()])->where('sesi_pulang', '>=', now())->first();

        if (isset($sesiData)) {
            $issetPresensi = true;
            
            $presensiExist = Presensi::whereDate('created_at', Carbon::today())->where('user_id', session('user')['user_id'])->where('presensi_status', '!=', 4)->exists();
            $masuk = ($presensiExist) ? date('H:i:s', strtotime(Presensi::whereDate('created_at', Carbon::today())->where('user_id', session('user')['user_id'])->first()->created_at)) : null ;
            if ($presensiExist) {
                $presensiData = Presensi::whereDate('created_at', Carbon::today())->where('user_id', session('user')['user_id'])->first();
                $masuk = date('H:i:s', strtotime($presensiData->created_at));
                $pulang = date('H:i:s', strtotime($presensiData->updated_at));
                $pulang = ($masuk == $pulang) ? false : $pulang;
            } else {
                $masuk = null;
                $pulang = null;
            }
        } else {
            $issetPresensi = false;
            $masuk = null;
            $pulang = null;
        }

        $presensiData = Presensi::getAllInOneMonthByUser(session('user')['user_id']);

        $accumulative = [
            'total_shift' => Presensi::where('user_id', session('user')['user_id'])
                ->whereMonth('created_at', Carbon::now()->month)
                ->where(function($q) {
                    $q->where('presensi_status', 1)
                    ->orWhere('presensi_status', 4);
                })->count(),
            'total_izin' => Presensi::where('user_id', session('user')['user_id'])
                ->whereMonth('created_at', Carbon::now()->month)
                ->where(function($q) {
                    $q->where('presensi_status', 3);
                })->count(),
            'total_telat' => [
                'jam' => 0,
                'menit' => 0,
            ]
        ];

        return
        view('templates/header', $data) . 
        view('templates/sidebar-user', $data) . 
        view('dashboard/index', [
            'issetPresensi' => $issetPresensi,
            'masuk' => $masuk,
            'pulang' => $pulang,
            'accumulative' => $accumulative,
            'presensi' => $presensiData
        ]) . 
        view('templates/footbar-user') . 
        view('templates/footer');
    }

    public function presensi()
    {
        $data = [
            'title' => 'Riwayat Presensi',
            'page' => 'riwayat-presensi',
        ];

        return
        view('templates/header', $data) . 
        view('templates/sidebar-user', $data) . 
        view('dashboard/presensi-riwayat') . 
        view('templates/footbar-user') . 
        view('templates/footer');
    }
}
