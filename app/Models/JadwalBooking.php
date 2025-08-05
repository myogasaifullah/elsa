<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalBooking extends Model
{
    protected $fillable = [
        'tanggal',
        'jam',
        'jenis_kategori',
        'kategori_mooc',
        'studio',
        'nama_mata_kuliah',
        'judul_course',
        'status',
        'user_id',
        'dosen_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
