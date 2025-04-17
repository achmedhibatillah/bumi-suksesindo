<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'user_id',
        'user_email',
        'user_nama',
        'user_password',
        'user_foto',
    ];

    public static function getAllKaryawan()
    {
        return self::get()
            ->map(function ($karyawan) {
                $created_at = Carbon::parse($karyawan->created_at);

                return [
                    'user_id' => $karyawan->user_id,
                    'user_email' => $karyawan->user_email,
                    'user_nama' => $karyawan->user_nama,
                    'user_foto' => $karyawan->user_foto,
                    'created_at_tgl' => $created_at->translatedFormat('l, d F Y'),
                    'created_at_jam' => $created_at->translatedFormat('H:s'),
                ];
            });
    }
}
