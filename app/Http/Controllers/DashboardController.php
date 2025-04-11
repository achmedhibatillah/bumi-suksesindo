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
            // Presensi dibuka 1 jam sebelum sesi_masuk dimulai
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

        return
        view('templates/header', $data) . 
        view('templates/sidebar-user', $data) . 
        view('dashboard/index', [
            'issetPresensi' => $issetPresensi,
            'masuk' => $masuk,
            'pulang' => $pulang,
            'presensi' => $presensiData
        ]) . 
        view('templates/footbar-user') . 
        view('templates/footer');
    }
}
