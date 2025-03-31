<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Homepage',
            'page' => 'homepage',
        ];

        $presensiExist = Presensi::whereDate('created_at', Carbon::today())->where('user_id', session('user')['user_id'])->exists();
        $masuk = ($presensiExist) ? date('H:i:s', strtotime(Presensi::whereDate('created_at', Carbon::today())->where('user_id', session('user')['user_id'])->first()->created_at)) : null ;
        if ($presensiExist) {
            $presensiData = Presensi::whereDate('created_at', Carbon::today())->where('user_id', session('user')['user_id'])->first();
            $masuk = date('H:i:s', strtotime($presensiData->created_at));
            $pulang = date('H:i:s', strtotime($presensiData->updated_at));
            $pulang = ($masuk == $pulang) ? false : $pulang;
        } else {
            $masuk = null;
            $pulang = null;
        }

        $presensiData = Presensi::getAllInOneMonthByUser(session('user')['user_id']);

        return
        view('templates/header', $data) . 
        view('templates/sidebar-user', $data) . 
        view('dashboard/index', [
            'masuk' => $masuk,
            'pulang' => $pulang,
            'presensi' => $presensiData
        ]) . 
        view('templates/footbar-user') . 
        view('templates/footer');
    }
}
