<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function rekap_masuk(Request $request)
    {
        $presensiSudahAda = Presensi::whereDate('created_at', Carbon::today())->where('user_id', session('user')['user_id'])->exists();
        
        if ($presensiSudahAda) {
            return redirect()->back()->with('warning-modal', 'Anda tidak dapat melakukan presensi lebih dari satu kali dalam satu hari.');
        }
        
        $presensi_status = now()->lessThan(Carbon::today()->addHours(7)) ? 1 : 2;

        $logic = new LogicController();
        $presensiData = [
            'presensi_id' => $logic->generateUniqueId('presensi', 'presensi_id'),
            'presensi_status' => $presensi_status,
            'presensi_keterangan_masuk' => $request->presensi_keterangan_masuk,
            'user_id' => session('user')['user_id'],
        ];

        Presensi::create($presensiData);
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
            'presensi_keterangan_pulang' => $request->presensi_keterangan_pulang,
        ];

        Presensi::where('user_id', session('user')['user_id'])->whereDate('created_at', Carbon::today())->update($presensiData);
        return redirect()->back()->with('success', 'Presensi berhasil direkap.');
    }
}
