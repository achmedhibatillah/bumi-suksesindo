<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Presensi extends Model
{
    protected $table = 'presensi';
    protected $primaryKey = 'presensi_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'presensi_id',
        'presensi_status',
        'presensi_keterangan_masuk',
        'presensi_keterangan_pulang',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public static function getAllInOneMonthByUser($user_id)
    {
        return self::where('user_id', $user_id)
        ->orderBy('created_at', 'desc')
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->get()
        ->map(function ($presensi) {
            $created_at = Carbon::parse($presensi->created_at);
            $updated_at = Carbon::parse($presensi->updated_at);
            $status = $presensi->presensi_status;

            if ($status == 1) {
                $presensi_status = $created_at->equalTo($updated_at) ? 'Hadir (tanpa rekap pulang)' : 'Hadir';
            } elseif ($status == 2) {
                $presensi_status = $created_at->equalTo($updated_at) ? 'Telat (tanpa rekap pulang)' : 'Telat';
            } elseif ($status == 3) {
                $presensi_status = 'Izin';
            } elseif ($status == 4) {
                $presensi_status = 'Alpha';
            } else {
                $presensi_status = 'Tidak Diketahui';
            }

            if (in_array($status, [1, 2])) {
                $presensi_pukul = $created_at->equalTo($updated_at)
                    ? $created_at->format('H:i:s') . ' - kepulangan tidak terekap'
                    : $created_at->format('H:i:s') . ' - ' . $updated_at->format('H:i:s');
            } else {
                $presensi_pukul = '-';
            }

            return [
                'presensi_id' => $presensi->presensi_id,
                'presensi_status' => $presensi_status,
                'presensi_keterangan_masuk' => $presensi->presensi_keterangan_masuk ?: '-',
                'presensi_keterangan_pulang' => $presensi->presensi_keterangan_pulang ?: '-',
                'user_id' => $presensi->user_id,
                'presensi_tanggal' => $created_at->translatedFormat('l, d F Y'),
                'presensi_pukul' => $presensi_pukul,
            ];
        });
    }

    public static function getFilteredPresensi($user_id, $tgl_mulai = null, $tgl_selesai = null)
    {

        return self::where('user_id', $user_id)
        ->orderBy('created_at', 'desc')
        ->where('created_at', '>=', $tgl_mulai)
        ->where('created_at', '<=', $tgl_selesai)
        ->get()
        ->map(function ($presensi) {
            $created_at = Carbon::parse($presensi->created_at);
            $updated_at = Carbon::parse($presensi->updated_at);
            $status = $presensi->presensi_status;

            if ($status == 1) {
                $presensi_status = $created_at->equalTo($updated_at) ? 'Hadir (tanpa rekap pulang)' : 'Hadir';
            } elseif ($status == 2) {
                $presensi_status = $created_at->equalTo($updated_at) ? 'Telat (tanpa rekap pulang)' : 'Telat';
            } elseif ($status == 3) {
                $presensi_status = 'Izin';
            } elseif ($status == 4) {
                $presensi_status = 'Alpha';
            } else {
                $presensi_status = 'Tidak Diketahui';
            }

            if (in_array($status, [1, 2])) {
                $presensi_pukul = $created_at->equalTo($updated_at)
                    ? $created_at->format('H:i:s') . ' - kepulangan tidak terekap'
                    : $created_at->format('H:i:s') . ' - ' . $updated_at->format('H:i:s');
            } else {
                $presensi_pukul = '-';
            }

            return [
                'presensi_id' => $presensi->presensi_id,
                'presensi_status' => $presensi_status,
                'presensi_keterangan_masuk' => $presensi->presensi_keterangan_masuk ?: '-',
                'presensi_keterangan_pulang' => $presensi->presensi_keterangan_pulang ?: '-',
                'user_id' => $presensi->user_id,
                'presensi_tanggal' => $created_at->translatedFormat('l, d F Y'),
                'presensi_pukul' => $presensi_pukul,
            ];
        });    
    }

    public static function getPresensiBySesi($sesi_id)
    {
        $sesiData = Sesi::where('sesi_id', $sesi_id)->first();
    
        if (!$sesiData) {
            return collect();
        }
    
        $sesiTgl = Carbon::parse($sesiData->sesi_masuk)->toDateString();
    
        return self::whereDate('created_at', $sesiTgl)->get()
            ->map(function ($presensi) {
                $created_at = Carbon::parse($presensi->created_at);
                $updated_at = Carbon::parse($presensi->updated_at);
                $status = $presensi->presensi_status;
    
                // Tentukan status presensi
                if ($status == 1) {
                    $presensi_status = $created_at->equalTo($updated_at) 
                        ? 'Hadir (tanpa rekap pulang)' 
                        : 'Hadir';
                } elseif ($status == 2) {
                    $presensi_status = $created_at->equalTo($updated_at) 
                        ? 'Telat (tanpa rekap pulang)' 
                        : 'Telat';
                } elseif ($status == 3) {
                    $presensi_status = 'Izin';
                } elseif ($status == 4) {
                    $presensi_status = 'Alpha';
                } else {
                    $presensi_status = 'Tidak Diketahui';
                }
    
                // Format waktu presensi
                if (in_array($status, [1, 2])) {
                    $presensi_pukul = $created_at->equalTo($updated_at)
                        ? $created_at->format('H:i:s') . ' - kepulangan tidak terekap'
                        : $created_at->format('H:i:s') . ' - ' . $updated_at->format('H:i:s');
                } else {
                    $presensi_pukul = '-';
                }
    
                return [
                    'presensi_id' => $presensi->presensi_id,
                    'status' => $presensi_status,
                    'pukul' => $presensi_pukul,
                ];
            });
    }
    
}
