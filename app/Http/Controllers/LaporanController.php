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

        return view('laporan', compact('progress'));
    }

}
