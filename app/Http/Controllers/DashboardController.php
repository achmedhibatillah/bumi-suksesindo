<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => '',
            'page' => 'homepage',
        ];

        return
        view('templates/header') . 
        view('templates/sidebar-user', $data) . 
        view('dashboard/index') . 
        view('templates/footbar-user') . 
        view('templates/footer');
    }
}
