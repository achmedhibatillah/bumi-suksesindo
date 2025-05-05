<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function profil_pp(Request $request)
    {
        $request->validate([
            'pp' => 'required|mimes:png|max:10240',
        ]
        , [
            'pp.required' => 'Foto harus diupload.',
            'pp.mimes' => 'Foto harus berupa png.',
            'max' => 'Maksimal ukuran adalah 10 MB.'
        ]);

        $userId = $request->input('user_id');
        $file = $request->file('pp');

        if (!$file) {
            return back()->withErrors(['pp' => 'File tidak ditemukan.']);
        }

        $path = 'uploads/PP-' . $userId . '.png';

        $file->move(public_path('uploads'), $path);

        return back()->with('success', 'Foto profil berhasil diunggah.');
    }

    public function profil_nama(Request $request)
    {
        $request->validate([
            'user_nama' => 'required|max:255',
            'user_email' => 'required|max:255'
        ], [
            'user_nama.required' => 'Nama diperlukan.',
            'user_nama.max' => 'Maksimal 255 karakter.',
            'user_email.required' => 'Email diperlukan.',
            'user_email.max' => 'Maksimal 255 karakter.'
        ]);

        $data = [
            'user_nama' => $request->user_nama,
            'user_email' => $request->user_email,
        ];

        User::where('user_id', $request->user_id)->update($data);

        return redirect()->back()->with('success', 'Berhasil memperbarui data.');
    }
}