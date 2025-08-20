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

        $sudahShooting = $progress->where('status', 'sudah shooting')->count();
        $prosesEdit = $progress->where('progres', 'progres')->count();
        $belumShooting = $progress->where('status', 'belum shooting')->count();
        $sudahTerbit = $progress->where('progres', 'selesai')->count();

        return view('laporan', compact('progress', 'sudahShooting', 'prosesEdit', 'belumShooting', 'sudahTerbit'));
    }
}
