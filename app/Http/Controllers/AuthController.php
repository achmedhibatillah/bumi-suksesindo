<?php

namespace App\Http\Controllers;

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
}
