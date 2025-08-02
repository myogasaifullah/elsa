<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $table = 'studios';

    protected $fillable = [
        'nama_studio',
        'lokasi',
    ];

    public function gambarStudio()
    {
        return $this->hasMany(GambarStudio::class);
    }
}
