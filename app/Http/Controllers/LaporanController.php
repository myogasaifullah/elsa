<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $progress = Progress::with([
            'jadwalBooking.dosen.fakultas',
            'jadwalBooking.dosen.prodi',
            'jadwalBooking.studio',
            'editor'
        ])
            ->orderBy('created_at', 'desc')
            ->get();

        // Filter progress berdasarkan status dosen dengan validasi lebih ketat
        $progressTetap = $progress->filter(function ($item) {
            $status = strtolower(trim($item->jadwalBooking->dosen->status_dosen ?? ''));
            return $status === 'tetap';
        });

        $progressTidakTetap = $progress->filter(function ($item) {
            $status = strtolower(trim($item->jadwalBooking->dosen->status_dosen ?? ''));
            return in_array($status, ['tidak tetap', 'tidaktetap', 'tidak_tetap', 'non tetap', 'nontetap']);
        });

        // Untuk debugging: cek semua status dosen yang ada
        $allStatus = $progress->pluck('jadwalBooking.dosen.status_dosen')->unique()->filter()->values();
        
        $sudahShooting = $progress->where('status', 'sudah shooting')->count();
        $prosesEdit = $progress->where('progres', 'progres')->count();
        $belumShooting = $progress->where('status', 'belum shooting')->count();
        $sudahTerbit = $progress->where('progres', 'selesai')->count();

        return view('laporan', compact(
            'progress',
            'progressTetap',
            'progressTidakTetap',
            'sudahShooting',
            'prosesEdit',
            'belumShooting',
            'sudahTerbit',
            'allStatus'
        ));
    }
}
