<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persentase extends Model
{
    use HasFactory;

    protected $table = 'persentase';

    protected $fillable = [
        'id_progres',
        'catatan1',
        'catatan2',
        'catatan3',
        'catatan4',
        'catatan5',
        'catatan6',
        'catatan7',
        'catatan8',
        'catatan9',
        'catatan10',
        'target_publish',
        'publish_link_youtube',
        'tanggal_publish',
        'durasi_video_menit',
    ];

    protected $casts = [
        'target_publish' => 'date',
        'tanggal_publish' => 'date',
        'durasi_video_menit' => 'decimal:2',
    ];

    public function progress()
    {
        return $this->belongsTo(Progress::class, 'id_progres');
    }
}
