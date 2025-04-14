<?php

namespace App\Models;

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
        return self::where('user_id', $user_id)
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->map(function ($lembur) {
            return [
                'lembur_id' => $lembur->lembur_id,
                'lembur_tgl' => $lembur->lembur_tgl,
                'lembur_mulai' => $lembur->lembur_mulai,
                'lembur_selesai' => $lembur->lembur_selesai,
                'lembur_catatan' => $lembur->lembur_catatan,
                'lembur_status' => $lembur->lembur_status,
                'created_at' => $lembur->created_at,
                'updated_at' => $lembur->updated_at,
            ];
        });
    }
}
