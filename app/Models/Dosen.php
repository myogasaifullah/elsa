<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosens';

    protected $fillable = [
        'nama_dosen',
        'nuptk_dosen',
        'target_video_dosen',
        'fakultas_id',
        'prodi_id',
    ];

    public function fakultas()
    {
        return $this->belongsTo('App\Models\Fakultas', 'fakultas_id');
    }

    public function prodi()
    {
        return $this->belongsTo('App\Models\Prodi', 'prodi_id');
    }
}
