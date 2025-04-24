<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Sesi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function rekap_masuk(Request $request)
    {
        $presensiSudahAda = Presensi::whereDate('created_at', Carbon::today())->where('user_id', session('user')['user_id'])->where('presensi_status', '!=', 4)->exists();
        
        if ($presensiSudahAda) {
            return redirect()->back()->with('warning-modal', 'Anda tidak dapat melakukan presensi lebih dari satu kali dalam satu hari.');
        }
        
        $sesiData = Sesi::whereRaw('sesi_masuk - INTERVAL 1 HOUR <= ?', [now()])->where('sesi_pulang', '>=', now())->first();

        $presensi_id = Presensi::where('user_id', session('user')['user_id'])->whereDate('created_at', now())->first()->presensi_id;

        $presensi_status = now()->lessThan($sesiData->sesi_masuk) ? 1 : 2;
        $presensiData = [
            'presensi_status' => $presensi_status,
            'presensi_keterangan' => $request->presensi_keterangan,
            'user_id' => session('user')['user_id'],
            'created_at' => now(),
        ];

        Presensi::where('presensi_id', $presensi_id)->update($presensiData);
        return redirect()->back()->with('success', 'Presensi berhasil direkap.');
    }

    public function rekap_pulang(Request $request)
    {
        $presensiData = Presensi::where('user_id', session('user')['user_id'])->whereDate('created_at', Carbon::today())->first();

        if ($presensiData) {
            $presensiEnded = !$presensiData->created_at->eq($presensiData->updated_at);
        
            if ($presensiEnded) {
                return redirect()->back()->with('warning-modal', 'Sesi presensi telah terekap.');
            }
        } else {
            return redirect()->back()->with('warning-modal', 'Sesi presensi belum Anda mulai.');
        }
        
        $presensi_status = now()->lessThan(Carbon::today()->addHours(7)) ? 1 : 2;

        $presensiData = [
            'presensi_id' => $presensiData->presensi_id,
        ];

        Presensi::where('user_id', session('user')['user_id'])->whereDate('created_at', Carbon::today())->update($presensiData);
        return redirect()->back()->with('success', 'Presensi berhasil direkap.');
    }
}
