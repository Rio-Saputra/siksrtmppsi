<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanKegiatan extends Model
{
    protected $table = 'permintaan_kegiatan';

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'tanggal',
        'jam',
        'lokasi',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
