<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;

    protected $table = 'fakultas';

    protected $fillable = [
        'nama_fakultas',
        'kode_fakultas',
        'singkatan',
    ];

    public function prodis()
    {
        return $this->hasMany(Prodi::class);
    }

    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class);
    }

    public function dosens()
    {
        return $this->hasMany(Dosen::class);
    }
}
