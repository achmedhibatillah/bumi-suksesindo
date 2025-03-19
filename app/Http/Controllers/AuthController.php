<?php

namespace App\Http\Controllers;

use App\Models\UsersTemp;
use Illuminate\Http\Request;

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

    public function user_registrasi_a1(Request $request)
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
            $data = ['ut_otp' => $logic->generateUniqueOtp('users_temp', 'ut_otp')];
            UsersTemp::where('ut_id', $user->ut_id)->update($data);
            return redirect()->to('registrasi/' . $user->ut_id);
        }

        $data = [
            'ut_id' => $logic->generateUniqueId('users_temp', 'ut_id'),
            'ut_email' => $request->email,
            'ut_otp' => $logic->generateUniqueOtp('users_temp', 'ut_otp'),
        ];

        UsersTemp::create($data);

        return redirect()->to('registrasi/' . $data['ut_id']);
    }

    public function user_registrasi_otp($ut_id)
    {
        if (empty(UsersTemp::where('ut_id', $ut_id)->first())) {
            return redirect()->to('registrasi')->with('error', 'Silakan masukkan email.');
        } 
    }
}
