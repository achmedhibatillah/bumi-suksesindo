<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use Illuminate\Http\Request;

class RootController extends Controller
{
    public function index()
    {
        $sesiData = Sesi::get();

        return
        view('templates/header') . 
        view('root/index', [
            'sesi' => $sesiData,
        ]) . 
        view('templates/footer');
    }

    public function sesi_add(Request $request)
    {
        $request->validate([
            'sesi_masuk' => 'required',
            'sesi_pulang' => 'required',
            'sesi_deskripsi' => 'max:255',
        ], [
            'sesi_masuk.required' => 'Waktu mulai harus diisi.',
            'sesi_pulang.required' => 'Waktu pulang harus diisi.',
            'sesi_deskripsi.max' => 'Maksimal 255 karakter.'
        ]);

        $logic = new LogicController();

        $data = [
            'sesi_id' => $logic->generateUniqueId('sesi', 'sesi_id'),
            'sesi_deskripsi' => $request->sesi_deskripsi,
            'sesi_masuk' => $request->sesi_masuk,
            'sesi_pulang' => $request->sesi_pulang, 
        ];

        Sesi::create($data);

        return redirect()->back()->with('success', 'Sesi baru berhasil ditambahkan.');
    }
}
