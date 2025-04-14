<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'user_id',
    ];
}
