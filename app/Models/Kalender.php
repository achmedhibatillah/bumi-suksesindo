<?php

namespace App\Models;

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
}
