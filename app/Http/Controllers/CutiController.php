<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CutiController extends Controller
{
    public function request(Request $request)
    {
        $request->validate([
            'cuti_status' => 'required',
            'cuti_mulai' => 'required',
            'cuti_selesai' => 'required',
            'cuti_alasan' => 'required|max:350',
        ], [
            'cuti_status.required' => 'Jenis cuti harus dipilih.',
            'cuti_mulai.required' => 'Waktu mulai cuti harus diisi.',
            'cuti_selesai.required' => 'Waktu selesai cuti harus diisi.',
            'cuti_alasan.required' => 'Alasan cuti harus diisi.',
            'cuti_alasan.max' => 'Maksimal 350 karakter.',
        ]);

        $mulai = Carbon::createFromFormat('Y-m-d', $request->cuti_mulai);
        $selesai = Carbon::createFromFormat('Y-m-d', $request->cuti_selesai);        
        if ($mulai >= $selesai) {
            return back()->withErrors(['cuti_mulai' => 'Waktu mulai harus lebih kecil dari waktu selesai.'])->withInput();
        }

        $logic = new LogicController();
        $cutiData = [
            'cuti_id' => $logic->generateUniqueId('cuti', 'cuti_id'),
            'cuti_status' => $request->cuti_status,
            'cuti_mulai' => $request->cuti_mulai,
            'cuti_selesai' => $request->cuti_selesai,
            'cuti_verif' => 0,
            'cuti_alasan' => $request->cuti_alasan,
            'user_id' => session('user')['user_id'],
        ];

        Cuti::create($cutiData);
        return redirect()->back()->with('success', 'Pengajuan cuti berhasil dibuat.');
    }
}
