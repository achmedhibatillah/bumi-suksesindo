<?php

namespace App\Http\Controllers;

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
    
    }
    
}
