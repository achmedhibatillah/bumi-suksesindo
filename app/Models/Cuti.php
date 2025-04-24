<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Cuti extends Model
{
    protected $table = 'cuti';
    protected $primaryKey = 'cuti_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'cuti_id',
        'cuti_status',
        'cuti_mulai',
        'cuti_selesai',
        'cuti_alasan',
        'cuti_verif',
        'user_id',
    ];

    public static function getCutiByUser($user_id)
    {
        $paginator = self::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $paginator->getCollection()->transform(function ($cuti) {
            $mulaiCarbon = Carbon::parse($cuti->cuti_mulai);
            $selesaiCarbon = Carbon::parse($cuti->cuti_selesai);
            $created_at = Carbon::parse($cuti->created_at);

            $durasiHari = $mulaiCarbon->diffInDays($selesaiCarbon) + 1;
            $cuti_durasi = $durasiHari . ' hari';

            if ($cuti->cuti_verif == 0 && $mulaiCarbon->lessThanOrEqualTo(now())) {
                $cuti_verif = 'Kadaluarsa';
            } elseif ($cuti->cuti_verif == 0 && $mulaiCarbon->greaterThan(now())) {
                $cuti_verif = 'Menunggu konfirmasi';
            } elseif ($cuti->cuti_verif == 1) {
                $cuti_verif = 'Disetujui';
            } elseif ($cuti->cuti_verif == 2) {
                $cuti_verif = 'Ditolak';
            } else {
                $cuti_verif = '';
            }

            // Perbaikan penentuan cuti_status
            $cuti_status_map = [
                1 => 'Cuti Tahunan',
                2 => 'Cuti Sakit atau Melahirkan',
                3 => 'Cuti Keluarga atau Cuti Duka',
            ];
            $cuti_status = $cuti_status_map[$cuti->cuti_status] ?? 'Tidak Diketahui';

            return [
                'cuti_id' => $cuti->cuti_id,
                'cuti_status' => $cuti_status,
                'cuti_mulai' => $mulaiCarbon->translatedFormat('l, d F Y'),
                'cuti_selesai' => $selesaiCarbon->translatedFormat('l, d F Y'),
                'cuti_durasi' => $cuti_durasi,
                'cuti_alasan' => $cuti->cuti_alasan,
                'cuti_verif' => $cuti_verif,
                'created_at' => $created_at->translatedFormat('l, d F Y'),
                'updated_at' => $cuti->updated_at,
            ];
        });

        return $paginator;
    }

    public static function getCuti()
    {
        $paginator = self::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $paginator->getCollection()->transform(function ($cuti) {
            $mulaiCarbon = Carbon::parse($cuti->cuti_mulai);
            $selesaiCarbon = Carbon::parse($cuti->cuti_selesai);
            $created_at = Carbon::parse($cuti->created_at);

            $durasiHari = $mulaiCarbon->diffInDays($selesaiCarbon) + 1;
            $cuti_durasi = $durasiHari . ' hari';

            if ($cuti->cuti_verif == 0 && $mulaiCarbon->lessThanOrEqualTo(now())) {
                $cuti_verif = 'Kadaluarsa';
            } elseif ($cuti->cuti_verif == 0 && $mulaiCarbon->greaterThan(now())) {
                $cuti_verif = 'Menunggu konfirmasi';
            } elseif ($cuti->cuti_verif == 1) {
                $cuti_verif = 'Disetujui';
            } elseif ($cuti->cuti_verif == 2) {
                $cuti_verif = 'Ditolak';
            } else {
                $cuti_verif = '';
            }

            // Perbaikan penentuan cuti_status
            $cuti_status_map = [
                1 => 'Cuti Tahunan',
                2 => 'Cuti Sakit atau Melahirkan',
                3 => 'Cuti Keluarga atau Cuti Duka',
            ];
            $cuti_status = $cuti_status_map[$cuti->cuti_status] ?? 'Tidak Diketahui';

            return [
                'cuti_id' => $cuti->cuti_id,
                'cuti_status' => $cuti_status,
                'cuti_mulai' => $mulaiCarbon->translatedFormat('l, d F Y'),
                'cuti_selesai' => $selesaiCarbon->translatedFormat('l, d F Y'),
                'cuti_durasi' => $cuti_durasi,
                'cuti_alasan' => $cuti->cuti_alasan,
                'cuti_verif' => $cuti_verif,
                'created_at' => $created_at->translatedFormat('l, d F Y'),
                'updated_at' => $cuti->updated_at,
            ];
        });

        return $paginator;
    }
}
