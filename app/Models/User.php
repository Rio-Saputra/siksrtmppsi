<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'nik',
        'email',
        'password',
        'gender',   // ← DITAMBAHKAN DI SINI
        'ktp',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
