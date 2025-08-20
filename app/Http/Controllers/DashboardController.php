<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\JadwalBooking;
use App\Models\Dosen;
use App\Models\Mooc;
use App\Models\Studio;
use App\Models\MataKuliah;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\Progress;
use App\Models\Editor;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari database
        $data = [
            'total_users' => User::count(),
            'total_bookings' => Booking::count(),
            'total_jadwal' => JadwalBooking::count(),
            'total_dosen' => Dosen::count(),
            'total_mooc' => Mooc::count(),
            'total_studio' => Studio::count(),
            'total_matakuliah' => MataKuliah::count(),
            'total_fakultas' => Fakultas::count(),
            'total_prodi' => Prodi::count(),
            'total_progress' => Progress::count(),
            'total_editors' => Editor::count(),
            'total_activity_logs' => ActivityLog::count(),
            
            // Data terbaru
            'recent_users' => User::latest()->limit(5)->get(),
            'recent_bookings' => Booking::with(['user', 'studio'])->latest()->limit(5)->get(),
            'recent_jadwal' => JadwalBooking::with(['booking', 'dosen'])->latest()->limit(5)->get(),
            'recent_progress' => Progress::with(['jadwalBooking', 'editor'])->latest()->limit(5)->get(),
            
            // Data untuk chart
            'bookings_by_month' => Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->groupBy('month')
                ->pluck('total', 'month')
                ->toArray(),
                
            'users_by_role' => User::selectRaw('role, COUNT(*) as total')
                ->groupBy('role')
                ->pluck('total', 'role')
                ->toArray(),
                
            'progress_by_status' => Progress::selectRaw('progres, COUNT(*) as total')
                ->groupBy('progres')
                ->pluck('total', 'progres')
                ->toArray(),
                
            // Data untuk system load (contoh: aktivitas sistem dalam 7 hari terakhir)
            'system_load' => $this->getSystemLoadData(),
        ];

        return view('dashboard', compact('data'));
    }

    /**
     * Mendapatkan data system load dari database
     */
    private function getSystemLoadData()
    {
        // Data aktivitas user dalam 7 hari terakhir
        $userActivity = ActivityLog::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();

        // Data booking dalam 7 hari terakhir
        $bookingActivity = Booking::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();

        // Data progress dalam 7 hari terakhir
        $progressActivity = Progress::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();

        // Mengisi tanggal yang tidak memiliki data dengan 0
        $dates = [];
        for ($i = 6; $i >= 0; $i--) {
            $dates[] = now()->subDays($i)->format('Y-m-d');
        }

        $userData = [];
        $bookingData = [];
        $progressData = [];

        foreach ($dates as $date) {
            $userData[] = $userActivity[$date] ?? 0;
            $bookingData[] = $bookingActivity[$date] ?? 0;
            $progressData[] = $progressActivity[$date] ?? 0;
        }

        // Format tanggal untuk label chart (Hari dalam minggu)
        $dayLabels = [];
        foreach ($dates as $date) {
            $dayLabels[] = date('D', strtotime($date));
        }

        return [
            'labels' => $dayLabels,
            'user_activity' => $userData,
            'booking_activity' => $bookingData,
            'progress_activity' => $progressData
        ];
    }
}