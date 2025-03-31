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
}
