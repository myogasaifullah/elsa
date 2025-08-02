<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodis';

    protected $fillable = [
        'fakultas_id',
        'nama_prodi',
        'singkatan',
    ];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }
}
