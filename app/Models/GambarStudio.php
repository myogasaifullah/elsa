<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GambarStudio extends Model
{
    protected $table = 'gambar_studios';

    protected $fillable = [
        'studio_id',
        'path',
    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
}
