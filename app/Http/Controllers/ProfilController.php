<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function profil_informasi(Request $request)
    {
        $request->validate([
            'profil_alamat' => 'required|max:255',
            'profil_telp' => 'required|numeric|digits_between:10,13',
        ], [
            'profil_alamat.required' => 'Alamat harus diisi.',
            'profil_alamat.max' => 'Maksimal 255 karakter.',
            'profil_telp.required' => 'Nomor telepon harus diisi.',
            'profil_telp.numeric' => 'Nomor telepon tidak valid.',
            'profil_telp.digits_between' => 'Nomor telepon tidak valid.',
        ]);
    
        $profilTelp = $request->profil_telp;
        if (substr($profilTelp, 0, 2) === '08') {
            $profilTelp = '62' . substr($profilTelp, 1);
        }
    
        $informasiData = [
            'profil_alamat' => $request->profil_alamat,
            'profil_telp' => $profilTelp,
        ];
    
        Profil::where('user_id', $request->user_id)->update($informasiData);
    
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
    
}
