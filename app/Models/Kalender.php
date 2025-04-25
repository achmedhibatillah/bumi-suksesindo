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
                   ->get();
    }
}
