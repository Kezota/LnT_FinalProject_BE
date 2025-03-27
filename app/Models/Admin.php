<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    protected $fillable = [
        'nama_lengkap',
        'id_admin',
        'email',
        'password',
        'nomor_handphone'
    ];

    protected $hidden = [
        'password'
    ];
}
