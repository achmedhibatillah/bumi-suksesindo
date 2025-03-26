<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\UsersTemp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function user_login()
    {
        return
        view('templates/header') . 
        view('auth/user-login') . 
        view('templates/footer');
    }

    public function user_registrasi()
    {
        return
        view('templates/header') . 
        view('auth/user-registrasi') . 
        view('templates/footer');
    }

    public function user_registrasi_init(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:355'
        ], [
            'email.required' => 'Isi alamat email.',
            'email.email' => 'Alamat email harus valid.',
            'email.max' => 'Maksimal 355 karakter.'
        ]);

        $logic = new LogicController();

        if ($user = UsersTemp::where('ut_email', $request->email)->first()) {
            $data = ['ut_url_login' => $logic->generateUniqueId('users_temp', 'ut_url_login')];
            UsersTemp::where('ut_id', $user->ut_id)->update($data);
            return redirect()->to('registrasi/informasi/' . $user->ut_id);
        }

        $data = [
            'ut_id' => $logic->generateUniqueId('users_temp', 'ut_id'),
            'ut_email' => $request->email,
            'ut_url_login' => $logic->generateUniqueId('users_temp', 'ut_url_login'),
        ];

        UsersTemp::create($data);

        return redirect()->to('registrasi/informasi/' . $data['ut_id']);
    }

    public function user_registrasi_informasi($ut_id)
    {
        if (empty(UsersTemp::where('ut_id', $ut_id)->first())) {
            return redirect()->to('registrasi')->with('error', 'Silakan masukkan email.');
        }

        $email = UsersTemp::where('ut_id', $ut_id)->first()->ut_email;

        return
        view('templates/header') . 
        view('auth/user-registrasi-informasi', [
            'email' => $email,
        ]) . 
        view('templates/footer');
    }

    public function user_registrasi_verifikasi($ut_url_login)
    {
        if (empty(UsersTemp::where('ut_url_login', $ut_url_login)->first())) {
            return redirect()->to('registrasi')->with('error', 'Url autentikasi tidak valid.');
        }

        $ut = UsersTemp::where('ut_url_login', $ut_url_login)->first();

        return
        view('templates/header') . 
        view('auth/user-registrasi-identitas', [
            'ut' => $ut,
        ]) . 
        view('templates/footer');
    }

    public function user_registrasi_save(Request $request)
    {
        $request->validate([
            'user_email' => 'required|email',
            'user_nama' => 'required|max:255',
            'user_password' => 'required|min:6|max:12|confirmed',
        ], [
            'user_nama.required' => 'Bagian ini harus diisi.',
            'user_nama.max' => 'Maksimal 255 karakter.',
            'user_password.required' => 'Password wajib diisi.',
            'user_password.min' => 'Password minimal harus 6 karakter.',
            'user_password.max' => 'Password maksimal 12 karakter.',
            'user_password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if (!empty(Users::where('user_email', $request->user_email)->first())) {
            return 'dah';
        }
        
        $logic = new LogicController();
        $userData = [
            'user_id' => $logic->generateUniqueId('users', 'user_id'),
            'user_nama' => $request->user_nama,
            'user_email' => $request->user_email,
            'user_password' => Hash::make($request->user_password),
            'user_foto' => $request->user_foto,
        ];

        Users::create($userData);

        session([
            'is_user' => true,
            'user' => $userData,
        ]);

        return redirect()->to('homepage');
    }
}
