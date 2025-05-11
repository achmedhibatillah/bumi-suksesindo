<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'profil';
    protected $primaryKey = 'profil_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'profil_id',
        'profil_alamat',
        'profil_telp',
        'user_id',
    ];

    public static function getProfilByUser($user_id)
    {
        $profil = self::where('user_id', $user_id)->first();

        $profil->profil_alamat = $profil->profil_alamat !== null ? $profil->profil_alamat : 'Belum diisi' ;
        $profil->profil_telp = $profil->profil_telp !== null ? $profil->profil_telp : 'Belum diisi' ;

        return $profil;
    }
}
