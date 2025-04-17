<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

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
        App::setLocale('id');
    
        return self::orderBy('sesi_masuk', 'desc')
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
                    'sesi_masuk_tgl' => $sesi_masuk->translatedFormat('l, d F Y'),
                    'sesi_masuk_jam' => $sesi_masuk->format('H:i'),
                    'sesi_pulang_tgl' => $sesi_pulang->translatedFormat('l, d F Y'),
                    'sesi_pulang_jam' => $sesi_pulang->format('H:i'),
                    'status' => $status,
                ];
            });
    }
    
    public static function getDetailSesi($sesi_id)
    {
        App::setLocale('id');
    
        $sesi = self::where('sesi_id', $sesi_id)->first();
    
        if (!$sesi) {
            return null;
        }
    
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
            'sesi_masuk_tgl' => $sesi_masuk->translatedFormat('l, d F Y'),
            'sesi_masuk_jam' => $sesi_masuk->format('H:i'),
            'sesi_pulang_tgl' => $sesi_pulang->translatedFormat('l, d F Y'),
            'sesi_pulang_jam' => $sesi_pulang->format('H:i'),
            'status' => $status,
        ];
    }    
}
