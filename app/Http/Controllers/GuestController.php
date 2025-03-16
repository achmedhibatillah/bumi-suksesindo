<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return
        view('templates/header') . 
        view('guest/index') . 
        view('templates/footer');
    }
}
