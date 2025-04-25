<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Kalender extends Model
{
    protected $table = 'kalender';
    protected $primaryKey = 'kalender_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'kalender_id',
        'kalender_tgl',
        'kalender_kegiatan',
        'kalender_style',
    ];

    public static function getKalenderAfter30Day($tgl)
    {
        $tanggal = Carbon::parse($tgl);
        $tanggalPlus30 = $tanggal->copy()->addDays(30);
    
        return self::whereDate('kalender_tgl', '>=', $tanggal)
            ->whereDate('kalender_tgl', '<=', $tanggalPlus30)
            ->get()
            ->map(function ($kalender) {
                if ($kalender->kalender_style == 1) {
                    $kalender_style = 'bg-danger';
                } elseif ($kalender->kalender_style == 2) {
                    $kalender_style = 'bg-primary';
                } elseif ($kalender->kalender_style == 3) {
                    $kalender_style = 'bg-success';
                } elseif ($kalender->kalender_style == 4) {
                    $kalender_style = 'bg-secondary';
                }

                return [
                    'kalender_id' => $kalender->kalender_id,
                    'kalender_tgl' => $kalender->kalender_tgl,
                    'kalender_kegiatan' => $kalender->kalender_kegiatan,
                    'kalender_style' => $kalender_style
                ];
            });
    }

    public static function getKalender()
    {
        return self::
            get()
            ->map(function ($kalender) {
                if ($kalender->kalender_style == 1) {
                    $kalender_style = 'bg-danger';
                } elseif ($kalender->kalender_style == 2) {
                    $kalender_style = 'bg-primary';
                } elseif ($kalender->kalender_style == 3) {
                    $kalender_style = 'bg-success';
                } elseif ($kalender->kalender_style == 4) {
                    $kalender_style = 'bg-secondary';
                }

                return [
                    'kalender_id' => $kalender->kalender_id,
                    'kalender_tgl' => $kalender->kalender_tgl,
                    'kalender_kegiatan' => $kalender->kalender_kegiatan,
                    'kalender_style' => $kalender_style
                ];
            });
    }
}
