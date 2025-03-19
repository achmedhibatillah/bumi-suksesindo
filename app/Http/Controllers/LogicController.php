<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LogicController extends Controller
{
    function generateUniqueId(string $table, string $column): string
    {
        do {
            $randomString = Str::random(35);
            $exists = DB::table($table)->where($column, $randomString)->exists();
        } while ($exists);
        
        return $randomString;
    }

    function generateUniqueOtp(string $table, string $column, int $length = 6): int
    {
        do {
            $otp = random_int(pow(10, $length - 1), pow(10, $length) - 1);
            $exists = DB::table($table)->where($column, $otp)->exists();
        } while ($exists);
        
        return $otp;
    }
}
