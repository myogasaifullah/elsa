<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mooc extends Model
{
    protected $table = 'moocs';

    protected $fillable = [
        'judul_mooc',
        'dosen_id',
    ];

    public function dosen()
    {
        return $this->belongsTo('App\Models\Dosen', 'dosen_id');
    }
}
