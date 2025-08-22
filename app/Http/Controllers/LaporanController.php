<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Catat aktivitas: melihat halaman laporan
        ActivityLogService::log('lihat_laporan', 'Melihat halaman laporan progress');
        
        // Ambil parameter pagination dari request (default 10 item per halaman)
        $perPage = $request->get('per_page', 5);
        
        $progress = Progress::with([
            'jadwalBooking.dosen.fakultas',
            'jadwalBooking.dosen.prodi',
            'jadwalBooking.studio',
            'editor'
        ])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        // Untuk statistik, kita perlu semua data (tidak dipaginasi)
        $allProgress = Progress::with([
            'jadwalBooking.dosen.fakultas',
            'jadwalBooking.dosen.prodi',
            'jadwalBooking.studio',
            'editor'
        ])->get();

        // Filter progress berdasarkan status dosen dengan validasi lebih ketat
        $progressTetap = $allProgress->filter(function ($item) {
            $status = strtolower(trim($item->jadwalBooking->dosen->status_dosen ?? ''));
            return $status === 'tetap';
        });

        $progressTidakTetap = $allProgress->filter(function ($item) {
            $status = strtolower(trim($item->jadwalBooking->dosen->status_dosen ?? ''));
            return in_array($status, ['tidak tetap', 'tidaktetap', 'tidak_tetap', 'non tetap', 'nontetap']);
        });

        // Untuk debugging: cek semua status dosen yang ada
        $allStatus = $allProgress->pluck('jadwalBooking.dosen.status_dosen')->unique()->filter()->values();
        
        $sudahShooting = $allProgress->where('status', 'sudah shooting')->count();
        $prosesEdit = $allProgress->where('progres', 'progres')->count();
        $belumShooting = $allProgress->where('status', 'belum shooting')->count();
        $sudahTerbit = $allProgress->where('progres', 'selesai')->count();

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