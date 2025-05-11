<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Kalender;
use App\Models\Lembur;
use App\Models\Presensi;
use App\Models\Profil;
use App\Models\Sesi;
use App\Models\User;
use App\Models\Users;
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

        $pulang_active = false;
        $pulang_active = false;

        if (isset($sesiData)) {
            $issetPresensi = true;
        
            $presensiData = Presensi::whereDate('created_at', Carbon::today())
                ->where('user_id', session('user')['user_id'])
                ->first();
        
            if ($presensiData && $presensiData->presensi_status != 4) {
                if ($presensiData->presensi_status == 5 || $presensiData->presensi_status == 3) {
                    $issetPresensi = false;
                    $masuk = null;
                    $pulang = null;
                } else {
                    $masuk = date('H:i:s', strtotime($presensiData->created_at));
                    $pulang = date('H:i:s', strtotime($presensiData->updated_at));
                    $pulang = ($masuk == $pulang) ? false : $pulang;
        
                    $sesi = date('H:i:s', strtotime($sesiData->sesi_masuk));
                    $pulang_active = ($masuk == $sesi) ? false : true;
                }
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

        $totalTelatJam = 0;
        $totalTelatMenit = 0;
        
        $presensiTelat = Presensi::where('user_id', session('user')['user_id'])
            ->where('presensi_status', 2)
            ->whereMonth('created_at', Carbon::now()->month)
            ->get();
        
        foreach ($presensiTelat as $presensi) {
            $sesi = Sesi::whereDate('sesi_masuk', Carbon::parse($presensi->created_at)->toDateString())->first();
        
            if ($sesi) {
                $sesiMasuk = Carbon::parse($sesi->sesi_masuk);
                $presensiMasuk = Carbon::parse($presensi->created_at);
        

                $diffInMinutes = $presensiMasuk->gt($sesiMasuk)
                ? $presensiMasuk->diffInMinutes($sesiMasuk)
                : 0;
            
        
                $totalTelatJam += floor($diffInMinutes / 60);
                $totalTelatMenit += $diffInMinutes % 60;
            }
        }
                    
        if ($totalTelatMenit >= 60) {
            $extraJam = floor($totalTelatMenit / 60);
            $totalTelatJam += $extraJam;
            $totalTelatMenit = $totalTelatMenit % 60;
        }
        
        $accumulative = [
            'total_shift' => Presensi::where('user_id', session('user')['user_id'])
                ->whereMonth('created_at', Carbon::now()->month)
                ->where(function($q) {
                    $q->where('presensi_status', 1)
                      ->orWhere('presensi_status', 2);
                })->count(),
            'total_izin' => Presensi::where('user_id', session('user')['user_id'])
                ->whereMonth('created_at', Carbon::now()->month)
                ->where('presensi_status', 3)
                ->count(),
            'total_telat' => [
                'jam' => $totalTelatJam == 0 ? 0 : abs($totalTelatJam) - 1,
                'menit' => abs($totalTelatMenit),
            ]
        ];        

        return
        view('templates/header', $data) . 
        view('templates/sidebar-user', $data) . 
        view('dashboard/index', [
            'issetPresensi' => $issetPresensi,
            'masuk' => $masuk,
            'pulang' => $pulang,
            'pulang_active' => $pulang_active,
            'accumulative' => $accumulative,
            'presensi' => $presensiData
        ]) . 
        view('templates/footbar-user') . 
        view('templates/footer');
    }

    public function presensi(Request $request)
    {
        $data = [
            'title' => 'Riwayat Presensi',
            'page' => 'riwayat-presensi',
        ];
        
        $presensiData = Presensi::getFilteredPresensi(session('user')['user_id'], Carbon::now()->subDays(30), Carbon::now());
        $tgl = [
            'tgl_mulai' => Carbon::now()->subDays(30)->toDateString(),
            'tgl_selesai' => Carbon::now()->toDateString(),
        ];

        if ($request->has('tgl_mulai') && $request->has('tgl_selesai')) {
            $presensiData = Presensi::getFilteredPresensi(session('user')['user_id'], $request->tgl_mulai, $request->tgl_selesai);
            $tgl = [
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
            ];
        }

        return
        view('templates/header', $data) . 
        view('templates/sidebar-user', $data) . 
        view('dashboard/presensi-riwayat', [
            'presensi' => $presensiData,
            'tgl' => $tgl,
        ]) . 
        view('templates/footbar-user') . 
        view('templates/footer');
    }

    public function lembur()
    {
        $data = [
            'title' => 'Laporan Lembur',
            'page' => 'lembur',
        ];

        $user = User::where('user_id', session('user')['user_id'])->first();
        $lembur = Lembur::getLemburByUser(session('user')['user_id']);

        return
        view('templates/header', $data) . 
        view('templates/sidebar-user', $data) . 
        view('dashboard/lembur', [
            'user' => $user,
            'lembur' => $lembur,
        ]) . 
        view('templates/footbar-user') . 
        view('templates/footer');
    }

    public function cuti()
    {
        $data = [
            'title' => 'Izin Cuti',
            'page' => 'cuti',
        ];

        $user = User::where('user_id', session('user')['user_id'])->first();

        $cutiData = Cuti::getCutiByUser($user->user_id);

        return
        view('templates/header', $data) . 
        view('templates/sidebar-user', $data) . 
        view('dashboard/cuti', [
            'cuti' => $cutiData,
        ]) . 
        view('templates/footbar-user') . 
        view('templates/footer');
    }

    public function kalender()
    {
        $data = [
            'title' => 'Kalender Perusahaan',
            'page' => 'kalender',
        ];

        $kalender = Kalender::getKalender();

        return
        view('templates/header', $data) . 
        view('templates/sidebar-user', $data) . 
        view('dashboard/kalender', [
            'kalender' => $kalender
        ]) . 
        view('templates/footbar-user') . 
        view('templates/footer');
    }

    public function profil()
    {
        $data = [
            'title' => 'Profil Saya',
            'page' => 'profil',
        ];

        $user = User::where('user_id', session('user')['user_id'])->first();
        $profil = Profil::getProfilByUser($user->user_id);

        $filename = 'uploads/PP-' . $user->user_id . '.png';
        $filepath = public_path($filename);
        
        $pp = file_exists($filepath) ? $filename : null; 

        return
        view('templates/header', $data) . 
        view('templates/sidebar-user', $data) . 
        view('dashboard/profil', [
            'user' => $user,
            'profil' => $profil,
            'pp' => $pp,
        ]) . 
        view('templates/footbar-user') . 
        view('templates/footer');
    }
}
