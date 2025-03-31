<?php

namespace App\Models;

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
}
