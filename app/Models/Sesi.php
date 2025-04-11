<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    protected $table = 'sesi';
    protected $primaryKey = 'sesi_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'sesi_id',
        'sesi_deskripsi',
        'sesi_masuk',
        'sesi_pulang',
    ];

    public static function getAllSesi()
    {
        return self::
            orderBy('sesi_masuk', 'desc')
            ->get()
            ->map(function ($sesi) {
                $sesi_masuk = Carbon::parse($sesi->sesi_masuk);
                $sesi_pulang = Carbon::parse($sesi->sesi_pulang);

                if (now()->lt($sesi_masuk)) {
                    $status = 'Belum';
                } else if (now()->gte($sesi_masuk) && now()->lte($sesi_pulang)) { 
                    $status = 'Aktif';
                } else if (now()->gt($sesi_pulang)) {
                    $status = 'Terlewat';
                }

                return [
                    'sesi_id' => $sesi->sesi_id,
                    'sesi_deskripsi' => $sesi->sesi_deskripsi,
                    'sesi_masuk' => $sesi->sesi_masuk,
                    'sesi_pulang' => $sesi->sesi_pulang,
                    'status' => $status,
                ];
            });
    }

    public static function getDetailSesi($sesi_id)
    {
        return self::where('sesi_id', $sesi_id)->first();

        $sesi_masuk = Carbon::parse($sesi->sesi_masuk);
        $sesi_pulang = Carbon::parse($sesi->sesi_pulang);

        if (now()->lt($sesi_masuk)) {
            $status = 'Belum';
        } else if (now()->gte($sesi_masuk) && now()->lte($sesi_pulang)) { 
            $status = 'Aktif';
        } else if (now()->gt($sesi_pulang)) {
            $status = 'Terlewat';
        }

        return [
            'sesi_id' => $sesi->sesi_id,
            'sesi_deskripsi' => $sesi->sesi_deskripsi,
            'sesi_masuk' => $sesi->sesi_masuk,
            'sesi_pulang' => $sesi->sesi_pulang,
            'status' => $status,
        ];
    }
}
