<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;
use App\Models\JadwalBooking;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class ArsipController extends Controller
{
    public function index()
    {
        // Get all progress data for DataTables client-side processing
        $progress = Progress::with([
            'jadwalBooking.dosen.fakultas',
            'jadwalBooking.dosen.prodi',
            'jadwalBooking.studio',
            'editor'
        ])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('arsip', compact('progress'));
    }
}
