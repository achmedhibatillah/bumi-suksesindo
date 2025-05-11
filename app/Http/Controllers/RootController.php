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
use Illuminate\Support\Facades\File;

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

    public function karyawan()
    {
        $data = [
            'title' => 'Root - Data Karyawan',
            'page' => 'karyawan',
        ];

        $karyawanData = Users::getAllKaryawan();

        return
        view('templates/header') . 
        view('templates/sidebar-root', $data) . 
        view('root/karyawan', [
            'karyawan' => $karyawanData,
        ]) . 
        view('templates/footbar-root') . 
        view('templates/footer');
    }

    public function karyawan_detail($user_id, Request $request)
    {
        $karyawanData = Users::where('user_id', $user_id)->first();

        $data = [
            'title' => 'Root - Data Karyawan | ' . $karyawanData['user_id'],
            'page' => 'karyawan',
        ];

        $karyawanData = Users::getDetailKaryawan($user_id);
        $informasiKaryawanData = Profil::getProfilByUser($karyawanData['user_id']);

        $filename = 'uploads/PP-' . $karyawanData['user_id'] . '.png';
        $filepath = public_path($filename);
        
        $pp = file_exists($filepath) ? $filename : null; 

        $presensiData = Presensi::getFilteredPresensi($user_id, Carbon::now()->subDays(30), Carbon::now());
        $tgl = [
            'tgl_mulai' => Carbon::now()->subDays(30)->toDateString(),
            'tgl_selesai' => Carbon::now()->toDateString(),
        ];

        if ($request->has('tgl_mulai') && $request->has('tgl_selesai')) {
            $presensiData = Presensi::getFilteredPresensi($user_id, $request->tgl_mulai, $request->tgl_selesai);
            $tgl = [
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
            ];
        }
        return
        view('templates/header', $data) . 
        view('templates/sidebar-root', $data) . 
        view('root/karyawan-detail', [
            'karyawan' => $karyawanData,
            'profil' => $informasiKaryawanData,
            'pp' => $pp,
            'presensi' => $presensiData,
            'tgl' => $tgl,
        ]) . 
        view('templates/footbar-root') . 
        view('templates/footer');
    }

    public function karyawan_delete(Request $request)
    {
        $userId = $request->user_id;

        $file_path = public_path('uploads/PP-' . $userId . '.png');
        if (File::exists($file_path)) {
            File::delete($file_path);
        }

        User::where('user_id', $userId)->delete();

        return redirect()->back()->with('success', 'Data karyawan berhasil dihapus.');
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
        $data = [
            'title' => 'Root - Sesi',
            'page' => 'sesi',
        ];

        $sesiData = Sesi::getDetailSesi($sesi_id);
        $sesiUsersData = Presensi::getPresensiBySesi($sesi_id);

        // dd($sesiUsersData);
        return
        view('templates/header') . 
        view('templates/sidebar-root', $data) . 
        view('root/sesi-detail', [
            'sesi' => $sesiData,
            'sesiusers' => $sesiUsersData,
        ]) . 
        view('templates/footbar-root') . 
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
            $cutiData = Cuti::where('user_id', $x->user_id)->whereDate('created_at', $sesi_masuk->toDateString())->where('cuti_verif', 1)->first();
            
            Presensi::create([
                'presensi_id' => $logic->generateUniqueId('presensi', 'presensi_id'),
                'user_id' => $x->user_id,
                'presensi_status' => ($cutiData) ? 5 : 4,
                'presensi_keterangan' => ($cutiData) ? $cutiData->cuti_alasan : null,
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


    public function lembur()
    {
        $data = [
            'title' => 'Root - Pengajuan Lembur',
            'page' => 'lembur',
        ];

        $lemburData = Lembur::getLembur();

        return
        view('templates/header') . 
        view('templates/sidebar-root', $data) . 
        view('root/lembur', [
            'lembur' => $lemburData,
        ]) . 
        view('templates/footbar-root') . 
        view('templates/footer');
    }

    public function lembur_response(Request $request)
    {
        if ($request->status == 'true') {
            Lembur::where('lembur_id', $request->lembur_id)->update(['lembur_status' => 1]);
            return redirect()->back()->with('success', 'Pengajuan lembur dari '. $request->user_nama . ' berhasil disetujui.');
        } else {
            Lembur::where('lembur_id', $request->lembur_id)->update(['lembur_status' => 2]);
            return redirect()->back()->with('success', 'Pengajuan lembur dari '. $request->user_nama . ' berhasil ditolak.');
        }
    }

    public function cuti()
    {
        $data = [
            'title' => 'Root - Pengajuan Cuti',
            'page' => 'cuti',
        ];

        $cutiData = Cuti::getCuti();

        return
        view('templates/header') . 
        view('templates/sidebar-root', $data) . 
        view('root/cuti', [
            'cuti' => $cutiData,
        ]) . 
        view('templates/footbar-root') . 
        view('templates/footer');
    }

    public function cuti_response(Request $request)
    {
        if ($request->status == 'true') {
            Cuti::where('cuti_id', $request->cuti_id)->update(['cuti_verif' => 1]);
            return redirect()->back()->with('success', 'Pengajuan cuti dari '. $request->user_nama . ' berhasil disetujui.');
        } else {
            Cuti::where('cuti_id', $request->cuti_id)->update(['cuti_verif' => 2]);
            return redirect()->back()->with('success', 'Pengajuan cuti dari '. $request->user_nama . ' berhasil ditolak.');
        }
    }

    public function kalender(Request $request)
    {
        $data = [
            'title' => 'Root - Atur Kalender',
            'page' => 'kalender',
        ];
    
        $tanggal = $request->tgl ?? now();
        $kalenderData = Kalender::getKalenderAfter30Day($tanggal);
    
        return
            view('templates/header') . 
            view('templates/sidebar-root', $data) . 
            view('root/kalender', [
                'kalender' => $kalenderData,
                'tgl' => $tanggal,
                'tgl_30' => Carbon::parse($tanggal)->copy()->addDays(30)->format('Y-m-d')
            ]) . 
            view('templates/footbar-root') . 
            view('templates/footer');
    }
    
    public function kalender_add(Request $request)
    {
        $request->validate([
            'kalender_tgl' => 'required|unique:kalender,kalender_tgl',
            'kalender_kegiatan' => 'required|max:350',
            'kalender_style' => 'required',
        ], [
            'kalender_tgl.required' => 'Tanggal harus diisi.',
            'kalender_tgl.unique' => 'Tanggal tersebut sudah terisi.',
            'kalender_kegiatan.required' => 'Kegiatan harus diisi.',
            'kalender_kegiatan.max' => 'Maksimal 350 karakter.',
            'kalender_style.required' => 'Warna harus diisi.',
        ]);   
        
        $logic = new LogicController();
        $kalenderData = [
            'kalender_id' => $logic->generateUniqueId('kalender', 'kalender_id'),
            'kalender_tgl' => $request->kalender_tgl,
            'kalender_kegiatan' => $request->kalender_kegiatan,
            'kalender_style' => $request->kalender_style,
        ];

        Kalender::create($kalenderData);

        return redirect()->back()->with('success', 'Berhasil menambahkan kegiatan pada tanggal ' . $kalenderData['kalender_tgl'] . '.');
    }

    public function kalender_delete(Request $request)
    {
        $kalenderData = Kalender::where('kalender_id', $request->kalender_id)->first();
        Kalender::where('kalender_id', $request->kalender_id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus kegiatan pada tanggal ' . $kalenderData['kalender_tgl'] . '.');
    }
}
