<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'jadwal_bookings';

    protected $fillable = [
        'user_id',
        'tanggal',
        'jam',
        'jenis_kategori',
        'kategori_mooc',
        'studio_id',
        'nama_mata_kuliah',
        'judul_course',
        'status',
        'dosen_id',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'nama_mata_kuliah', 'nama_mata_kuliah');
    }

    
}
