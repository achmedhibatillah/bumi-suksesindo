<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    protected $table = 'lembur';
    protected $primaryKey = 'lembur_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'lembur_id',
        'lembur_tgl',
        'lembur_mulai',
        'lembur_selesai',
        'lembur_catatan',
        'lembur_status',
        'user_id',
    ];

    public static function getLemburByUser($user_id)
    {
        $paginator = self::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    

        $paginator->getCollection()->transform(function ($lembur) {
            $mulai = Carbon::createFromFormat('H:i:s', $lembur->lembur_mulai);
            $selesai = Carbon::createFromFormat('H:i:s', $lembur->lembur_selesai);
            $durasiMenit = $mulai->diffInMinutes($selesai);
            $jam = floor($durasiMenit / 60);
            $menit = $durasiMenit % 60;
            $lembur_durasi = ($jam > 0 ? "{$jam} jam " : '') . ($menit > 0 ? "{$menit} menit" : '');

            if ($lembur->lembur_status == 0 && $lembur->lembur_tgl <= now()) {
                $lembur_status = 'Kadaluarsa';
            } else if ($lembur->lembur_status == 0 && $lembur->lembur_tgl > now()) {
                $lembur_status = 'Menunggu konfirmasi';
            }
        
            return [
                'lembur_id' => $lembur->lembur_id,
                'lembur_tgl' => Carbon::parse($lembur->lembur_tgl)->translatedFormat('l, d F Y'),
                'lembur_mulai' => $lembur->lembur_mulai,
                'lembur_selesai' => $lembur->lembur_selesai,
                'lembur_durasi' => $lembur_durasi,
                'lembur_catatan' => $lembur->lembur_catatan,
                'lembur_status' => $lembur_status,
                'created_at' => $lembur->created_at,
                'updated_at' => $lembur->updated_at,
            ];
        });
            
    
        return $paginator;
    }
    
}
