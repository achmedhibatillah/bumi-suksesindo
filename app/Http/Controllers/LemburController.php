<?php

namespace App\Http\Controllers;

use App\Models\Lembur;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class LemburController extends Controller
{
    public function request(Request $request)
    {
        $request->validate([
            'lembur_tgl' => ['required', 'date', 'after:today'],
            'lembur_mulai' => 'required',
            'lembur_selesai' => 'required',
            'lembur_catatan' => 'required|max:350',
        ], [
            'lembur_tgl.required' => 'Tanggal lembur harus diisi.',
            'lembur_tgl.after' => 'Tanggal lembur minimal harus besok.',
    
            'lembur_mulai.required' => 'Jam mulai lembur harus diisi.',
            'lembur_selesai.required' => 'Jam selesai lembur harus diisi.',
    
            'lembur_catatan.required' => 'Catatan harus diisi.',
            'lembur_catatan.max' => 'Maksimal 350 karakter.',
        ]);
    
        $mulai = Carbon::createFromFormat('H:i', $request->lembur_mulai);
        $selesai = Carbon::createFromFormat('H:i', $request->lembur_selesai);
    
        if ($mulai >= $selesai) {
            return back()->withErrors(['lembur_mulai' => 'Jam mulai harus lebih kecil dari jam selesai.'])->withInput();
        }
    
        $logic = new LogicController();
        $lemburData = [
            'lembur_id' => $logic->generateUniqueId('lembur', 'lembur_id'),
            'lembur_tgl' => $request->lembur_tgl,
            'lembur_mulai' => $request->lembur_mulai,
            'lembur_selesai' => $request->lembur_selesai,
            'lembur_catatan' => $request->lembur_catatan,
            'user_id' => session('user')['user_id'],
        ];

        Lembur::create($lemburData);
    }
    
}
