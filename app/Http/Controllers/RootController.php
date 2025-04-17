<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Sesi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RootController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Root - Index',
            'page' => 'homepage',
        ];

        return
        view('templates/header') . 
        view('templates/sidebar-root', $data) . 
        view('root/index', [
        ]) . 
        view('templates/footbar-root') . 
        view('templates/footer');  
    }

    public function sesi()
    {
        $data = [
            'title' => 'Root - Sesi',
            'page' => 'sesi',
        ];

        $sesiData = Sesi::getAllSesi();

        return
        view('templates/header') . 
        view('templates/sidebar-root', $data) . 
        view('root/sesi', [
            'sesi' => $sesiData,
        ]) . 
        view('templates/footbar-root') . 
        view('templates/footer');
    }

    public function sesi_detail($sesi_id)
    {
        $sesiData = Sesi::getDetailSesi($sesi_id);

        return
        view('templates/header') . 
        view('root/sesi-detail', [
            'sesi' => $sesiData,
        ]) . 
        view('templates/footer');
    }

    public function sesi_add(Request $request)
    {
        $request->validate([
            'tgl' => 'required',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
            'sesi_deskripsi' => 'max:255',
        ], [
            'tgl.required' => 'Tanggal harus diisi.',
            'jam_masuk.required' => 'Waktu masuk harus diisi.',
            'jam_pulang.required' => 'Waktu pulang harus diisi.',
            'sesi_deskripsi.max' => 'Maksimal 255 karakter.'
        ]);

        if ($request->jam_masuk >= $request->jam_pulang) {
            return redirect()->back()->withErrors([
                'jam_masuk' => 'Jam masuk tidak boleh melebihi jam pulang.'
            ])->withInput();
        }

        $sesiTodayStatus = Sesi::whereDate('sesi_masuk', $request->tgl)->exists();
        if ($sesiTodayStatus) {
            return redirect()->back()->withErrors([
                'tgl' => 'Tanggal sudah tersedia.'
            ])->withInput();
        }

        $sesi_masuk = Carbon::parse("{$request->tgl} {$request->jam_masuk}");
        $sesi_pulang = Carbon::parse("{$request->tgl} {$request->jam_pulang}");
    
        $logic = new LogicController();
    
        $data = [
            'sesi_id' => $logic->generateUniqueId('sesi', 'sesi_id'),
            'sesi_deskripsi' => $request->sesi_deskripsi,
            'sesi_masuk' => $sesi_masuk,
            'sesi_pulang' => $sesi_pulang,
        ];

        Sesi::create($data);

        $usersData = User::get();

        foreach($usersData as $x) {
            Presensi::create([
                'presensi_id' => $logic->generateUniqueId('presensi', 'presensi_id'),
                'user_id' => $x->user_id,
                'presensi_status' => 4
            ]);
        }

        return redirect()->back()->with('success', 'Sesi baru berhasil ditambahkan.');
    }

    public function sesi_del(Request $request)
    {
        $sesiData = Sesi::where('sesi_id', $request->sesi_id)->first();
        
        Presensi::whereDate('created_at', $sesiData->created_at->toDateString())->delete();
        Sesi::where('sesi_id', $request->sesi_id)->delete();
        return redirect()->back()->with('success', 'Anda berhasil menghapus sesi dengan ID #' . $request->sesi_id);
    }
}
