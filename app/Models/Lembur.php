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
}
