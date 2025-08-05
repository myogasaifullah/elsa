<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progress';
    
    protected $fillable = [
        'jadwal_booking_id',
        'target_upload',
        'persentase',
        'progres',
        'keterangan',
        'durasi',
        'tanggal_upload_youtube',
        'editor_id',
    ];

    protected $casts = [
        'target_upload' => 'date',
        'tanggal_upload_youtube' => 'date',
        'persentase' => 'decimal:2',
    ];

    public function jadwalBooking()
    {
        return $this->belongsTo(JadwalBooking::class, 'jadwal_booking_id');
    }

    public function editor()
    {
        return $this->belongsTo(Editor::class, 'editor_id');
    }
}
