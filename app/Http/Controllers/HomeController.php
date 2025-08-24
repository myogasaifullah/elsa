<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Dosen;
use App\Models\Editor;
use App\Models\Fakultas;
use App\Models\GambarStudio;
use App\Models\JadwalBooking;
use App\Models\MataKuliah;
use App\Models\Mooc;
use App\Models\Persentase;
use App\Models\Prodi;
use App\Models\Progress;
use App\Models\Studio;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Menampilkan semua data dari database
     */
    public function index()
    {
        // Mengambil semua data dari semua model
        $data = [
            'users' => User::all(),
            'bookings' => Booking::all(),
            'dosens' => Dosen::all(),
            'editors' => Editor::all(),
            'fakultas' => Fakultas::all(),
            'gambar_studios' => GambarStudio::all(),
            'jadwal_bookings' => JadwalBooking::all(),
            'mata_kuliahs' => MataKuliah::all(),
            'moocs' => Mooc::with(['dosen.fakultas', 'dosen.prodi'])->get(),
            'videos' => Mooc::with(['dosen.fakultas', 'dosen.prodi'])->get(),
            'persentases' => Persentase::all(),
            'prodis' => Prodi::all(),
            'progresses' => Progress::all(),
            'studios' => Studio::all(),
            'activity_logs' => ActivityLog::with('user')->get(),
            'logs' => ActivityLog::with('user')->get(),
            
            // Statistik jumlah data
            'counts' => [
                'users' => User::count(),
                'bookings' => Booking::count(),
                'dosens' => Dosen::count(),
                'editors' => Editor::count(),
                'fakultas' => Fakultas::count(),
                'gambar_studios' => GambarStudio::count(),
                'jadwal_bookings' => JadwalBooking::count(),
                'mata_kuliahs' => MataKuliah::count(),
                'moocs' => Mooc::count(),
                'persentases' => Persentase::count(),
                'prodis' => Prodi::count(),
                'progresses' => Progress::count(),
                'studios' => Studio::count(),
                'activity_logs' => ActivityLog::count(),
            ],

            // Data untuk chart
            'chart_data' => $this->getChartData()
        ];

        return view('home', compact('data'));
    }

    /**
     * Menampilkan detail data berdasarkan ID (opsional)
     */
    public function show($model, $id)
    {
        $modelClass = 'App\\Models\\' . ucfirst($model);
        
        if (class_exists($modelClass)) {
            $data = $modelClass::findOrFail($id);
            return view('home-detail', compact('data', 'model'));
        }

        abort(404, 'Model tidak ditemukan');
    }

    /**
     * Mendapatkan data untuk chart
     */
    private function getChartData()
    {
        return [
            // Data untuk Budget Chart (Radar)
            'budget_data' => [
                'allocated' => [4200, 3000, 20000, 35000, 50000, 18000],
                'actual' => [5000, 14000, 28000, 26000, 42000, 21000]
            ],

            // Data untuk Traffic Chart (Pie)
            'traffic_data' => [
                'Search Engine' => 1048,
                'Direct' => 735,
                'Email' => 580,
                'Union Ads' => 484,
                'Video Ads' => 300
            ],

            // Data untuk Line Chart
            'line_chart_data' => [
                'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                'data' => [65, 59, 80, 81, 56, 55, 40]
            ],

            // Data untuk Bar Chart
            'bar_chart_data' => [
                'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                'data' => [65, 59, 80, 81, 56, 55, 40]
            ],

            // Data untuk Pie Chart
            'pie_chart_data' => [
                'labels' => ['Red', 'Blue', 'Yellow'],
                'data' => [300, 50, 100]
            ],

            // Data untuk Doughnut Chart
            'doughnut_chart_data' => [
                'labels' => ['Red', 'Blue', 'Yellow'],
                'data' => [300, 50, 100]
            ],

            // Data untuk Radar Chart
            'radar_chart_data' => [
                'labels' => ['Eating', 'Drinking', 'Sleeping', 'Designing', 'Coding', 'Cycling', 'Running'],
                'dataset1' => [65, 59, 90, 81, 56, 55, 40],
                'dataset2' => [28, 48, 40, 19, 96, 27, 100]
            ],

            // Data untuk Polar Area Chart
            'polar_area_data' => [
                'labels' => ['Red', 'Green', 'Yellow', 'Grey', 'Blue'],
                'data' => [11, 16, 7, 3, 14]
            ],

            // Data untuk Stacked Bar Chart
            'stacked_bar_data' => [
                'labels' => ['January', 'February', 'March', 'April', 'May'],
                'dataset1' => [-75, -15, 18, 48, 74],
                'dataset2' => [-11, -1, 12, 62, 95],
                'dataset3' => [-44, -5, 22, 35, 62]
            ],

            // Data untuk Bubble Chart
            'bubble_chart_data' => [
                'labels' => ['January', 'February', 'March', 'April'],
                'dataset1' => [
                    ['x' => 20, 'y' => 30, 'r' => 15],
                    ['x' => 40, 'y' => 10, 'r' => 10],
                    ['x' => 15, 'y' => 37, 'r' => 12],
                    ['x' => 32, 'y' => 42, 'r' => 33]
                ],
                'dataset2' => [
                    ['x' => 40, 'y' => 25, 'r' => 22],
                    ['x' => 24, 'y' => 47, 'r' => 11],
                    ['x' => 65, 'y' => 11, 'r' => 14],
                    ['x' => 11, 'y' => 55, 'r' => 8]
                ]
            ],

            // Data untuk Area Chart
            'area_chart_data' => [
                'prices' => [
                    8107.85, 8128.0, 8122.9, 8165.5, 8340.7, 8423.7, 8423.5, 8514.3, 
                    8481.85, 8487.7, 8506.9, 8626.2, 8668.95, 8602.3, 8607.55, 8512.9, 
                    8496.25, 8600.65, 8881.1, 9340.85
                ],
                'dates' => [
                    "13 Nov 2017", "14 Nov 2017", "15 Nov 2017", "16 Nov 2017", "17 Nov 2017",
                    "20 Nov 2017", "21 Nov 2017", "22 Nov 2017", "23 Nov 2017", "24 Nov 2017",
                    "27 Nov 2017", "28 Nov 2017", "29 Nov 2017", "30 Nov 2017", "01 Dec 2017",
                    "04 Dec 2017", "05 Dec 2017", "06 Dec 2017", "07 Dec 2017", "08 Dec 2017"
                ]
            ],

            // Data untuk Column Chart
            'column_chart_data' => [
                'labels' => ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                'net_profit' => [44, 55, 57, 56, 61, 58, 63, 60, 66],
                'revenue' => [76, 85, 101, 98, 87, 105, 91, 114, 94],
                'free_cash_flow' => [35, 41, 36, 26, 45, 48, 52, 53, 41]
            ],

            // Data untuk Donut Chart
            'donut_chart_data' => [
                'labels' => ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
                'data' => [44, 55, 13, 43, 22]
            ],

            // Data untuk Radial Bar Chart
            'radial_bar_data' => [
                'labels' => ['Apples', 'Oranges', 'Bananas', 'Berries'],
                'data' => [44, 55, 67, 83]
            ],

            // Data untuk Vertical Bar Chart
            'vertical_bar_data' => [
                'labels' => ['Brazil', 'Indonesia', 'USA', 'India', 'China', 'World'],
                'year2011' => [18203, 23489, 29034, 104970, 131744, 630230],
                'year2012' => [19325, 23438, 31000, 121594, 134141, 681807]
            ],

            // Data untuk Candle Stick Chart
            'candle_stick_data' => [
                'dates' => ['2017-10-24', '2017-10-25', '2017-10-26', '2017-10-27'],
                'data' => [
                    [20, 34, 10, 38],
                    [40, 35, 30, 50],
                    [31, 38, 33, 44],
                    [38, 15, 5, 42]
                ]
            ],

            // Data real dari database
            'real_data' => [
                // Bookings by month
                'bookings_by_month' => Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->groupBy('month')
                    ->pluck('total', 'month')
                    ->toArray(),
                    
                // Users by role
                'users_by_role' => User::selectRaw('role, COUNT(*) as total')
                    ->groupBy('role')
                    ->pluck('total', 'role')
                    ->toArray(),
                    
                // Progress by persentase range
                'progress_by_persentase' => Progress::selectRaw('
                    CASE 
                        WHEN persentase = 0 THEN "0%"
                        WHEN persentase > 0 AND persentase <= 25 THEN "1-25%"
                        WHEN persentase > 25 AND persentase <= 50 THEN "26-50%"
                        WHEN persentase > 50 AND persentase <= 75 THEN "51-75%"
                        WHEN persentase > 75 AND persentase < 100 THEN "76-99%"
                        WHEN persentase = 100 THEN "100%"
                        ELSE "Unknown"
                    END as progress_range, 
                    COUNT(*) as total'
                )
                    ->groupBy('progress_range')
                    ->pluck('total', 'progress_range')
                    ->toArray(),
                    
                // Studios count
                'studios_count' => Studio::count(),
                    
                // Dosen by status_dosen
                'dosens_by_status' => Dosen::selectRaw('status_dosen, COUNT(*) as total')
                    ->groupBy('status_dosen')
                    ->pluck('total', 'status_dosen')
                    ->toArray(),
                    
                // Editors count
                'editors_count' => Editor::count(),
                    
                // Activity by day (last 7 days)
                'activity_by_day' => ActivityLog::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                    ->where('created_at', '>=', now()->subDays(7))
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get()
                    ->pluck('count', 'date')
                    ->toArray()
            ]
        ];
    }
}
