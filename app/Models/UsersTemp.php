<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersTemp extends Model
{
    protected $table = 'users_temp';
    protected $primaryKey = 'ut_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'ut_id',
        'ut_email',
        'ut_url_login'
    ];
}
