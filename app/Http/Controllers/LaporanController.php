<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Fakultas;
use App\Models\Studio;
use App\Models\JadwalBooking;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use App\Exports\ProgressExport;
use App\Exports\JadwalExport;
use App\Exports\MoocExport;
use App\Exports\RekapExport;
use App\Exports\DosenExport;
use App\Exports\FakultasExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Catat aktivitas: melihat halaman laporan
        ActivityLogService::log('lihat_laporan', 'Melihat halaman laporan progress');
        
        // Ambil parameter pagination dari request (default 10 item per halaman)
        $perPage = $request->get('per_page', 5);
        
        // Filter parameters for different tables
        $filterProgress = $request->only(['progress_date_from', 'progress_date_to', 'progress_dosen', 'progress_prodi']);
        $filterJadwal = $request->only(['jadwal_date_from', 'jadwal_date_to', 'jadwal_dosen', 'jadwal_studio']);
        $filterMooc = $request->only(['mooc_date_from', 'mooc_date_to', 'mooc_dosen']);
        $filterRekap = $request->only(['rekap_date_from', 'rekap_date_to', 'rekap_dosen']);
        $filterDosen = $request->only(['dosen_date_from', 'dosen_date_to', 'dosen_status']);
        $filterFakultas = $request->only(['fakultas_date_from', 'fakultas_date_to', 'fakultas_id']);
        
        // Get filtered data for each table
        $progress = $this->getFilteredProgress($filterProgress, $perPage);
        $allProgress = $this->getFilteredProgress($filterProgress);
        
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
        $allStatus = $allProgress->pluck('jadwalBooking->dosen->status_dosen')->unique()->filter()->values();
        
        $sudahShooting = $allProgress->where('status', 'sudah shooting')->count();
        $prosesEdit = $allProgress->where('progres', 'progres')->count();
        $belumShooting = $allProgress->where('status', 'belum shooting')->count();
        $sudahTerbit = $allProgress->where('progres', 'selesai')->count();
        
        // Get filter options
        $prodis = Prodi::all();
        $fakultases = Fakultas::all();
        $studios = Studio::all();
        $dosens = Dosen::all();

        return view('laporan', compact(
            'progress',
            'progressTetap',
            'progressTidakTetap',
            'sudahShooting',
            'prosesEdit',
            'belumShooting',
            'sudahTerbit',
            'allStatus',
            'filterProgress',
            'filterJadwal',
            'filterMooc',
            'filterRekap',
            'filterDosen',
            'filterFakultas',
            'prodis',
            'fakultases',
            'studios',
            'dosens'
        ));
    }
    
    private function getFilteredProgress($filters, $perPage = null)
    {
        $query = Progress::with([
            'jadwalBooking.dosen.fakultas',
            'jadwalBooking.dosen.prodi',
            'jadwalBooking.studio',
            'editor'
        ])->orderBy('created_at', 'desc');
        
        // Apply filters
        if (!empty($filters['progress_date_from'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->where('tanggal', '>=', $filters['progress_date_from']);
            });
        }
        
        if (!empty($filters['progress_date_to'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->where('tanggal', '<=', $filters['progress_date_to']);
            });
        }
        
        if (!empty($filters['progress_dosen'])) {
            $query->whereHas('jadwalBooking.dosen', function ($q) use ($filters) {
                $q->where('nama_dosen', 'like', '%' . $filters['progress_dosen'] . '%');
            });
        }
        
        if (!empty($filters['progress_prodi'])) {
            $query->whereHas('jadwalBooking.dosen.prodi', function ($q) use ($filters) {
                $q->where('id', $filters['progress_prodi']);
            });
        }
        
        if ($perPage) {
            return $query->paginate($perPage);
        }
        
        return $query->get();
    }
    
    private function getFilteredJadwal($filters)
    {
        $query = JadwalBooking::with(['dosen', 'studio'])->orderBy('tanggal', 'desc');
        
        // Apply filters
        if (!empty($filters['jadwal_date_from'])) {
            $query->where('tanggal', '>=', $filters['jadwal_date_from']);
        }
        
        if (!empty($filters['jadwal_date_to'])) {
            $query->where('tanggal', '<=', $filters['jadwal_date_to']);
        }
        
        if (!empty($filters['jadwal_dosen'])) {
            $query->whereHas('dosen', function ($q) use ($filters) {
                $q->where('nama_dosen', 'like', '%' . $filters['jadwal_dosen'] . '%');
            });
        }
        
        if (!empty($filters['jadwal_studio'])) {
            $query->where('studio_id', $filters['jadwal_studio']);
        }
        
        return $query->get();
    }
    
    // Export methods for each table
    public function exportProgressPdf(Request $request)
    {
        $filters = $request->only(['progress_date_from', 'progress_date_to', 'progress_dosen', 'progress_prodi']);
        $export = new ProgressExport($filters);
        
        return Pdf::loadView('exports.progress', $export->view()->getData())->download('laporan-progress.pdf');
    }
    
    public function exportProgressExcel(Request $request)
    {
        $filters = $request->only(['progress_date_from', 'progress_date_to', 'progress_dosen', 'progress_prodi']);
        return Excel::download(new ProgressExport($filters), 'laporan-progress.xlsx');
    }
    
    public function exportJadwalPdf(Request $request)
    {
        $filters = $request->only(['jadwal_date_from', 'jadwal_date_to', 'jadwal_dosen', 'jadwal_studio']);
        $export = new JadwalExport($filters);
        
        return Pdf::loadView('exports.jadwal', $export->view()->getData())->download('laporan-jadwal.pdf');
    }
    
    public function exportJadwalExcel(Request $request)
    {
        $filters = $request->only(['jadwal_date_from', 'jadwal_date_to', 'jadwal_dosen', 'jadwal_studio']);
        return Excel::download(new JadwalExport($filters), 'laporan-jadwal.xlsx');
    }
    
    public function exportMoocPdf(Request $request)
    {
        $filters = $request->only(['mooc_date_from', 'mooc_date_to', 'mooc_dosen']);
        $export = new MoocExport($filters);
        
        return Pdf::loadView('exports.mooc', $export->view()->getData())->download('laporan-mooc.pdf');
    }
    
    public function exportMoocExcel(Request $request)
    {
        $filters = $request->only(['mooc_date_from', 'mooc_date_to', 'mooc_dosen']);
        return Excel::download(new MoocExport($filters), 'laporan-mooc.xlsx');
    }
    
    public function exportRekapPdf(Request $request)
    {
        $filters = $request->only(['rekap_date_from', 'rekap_date_to', 'rekap_dosen']);
        $export = new RekapExport($filters);
        
        return Pdf::loadView('exports.rekap', $export->view()->getData())->download('laporan-rekap.pdf');
    }
    
    public function exportRekapExcel(Request $request)
    {
        $filters = $request->only(['rekap_date_from', 'rekap_date_to', 'rekap_dosen']);
        return Excel::download(new RekapExport($filters), 'laporan-rekap.xlsx');
    }
    
    public function exportDosenPdf(Request $request)
    {
        $filters = $request->only(['dosen_date_from', 'dosen_date_to', 'dosen_status']);
        $export = new DosenExport($filters);
        
        return Pdf::loadView('exports.dosen', $export->view()->getData())->download('laporan-dosen.pdf');
    }
    
    public function exportDosenExcel(Request $request)
    {
        $filters = $request->only(['dosen_date_from', 'dosen_date_to', 'dosen_status']);
        return Excel::download(new DosenExport($filters), 'laporan-dosen.xlsx');
    }
    
    public function exportFakultasPdf(Request $request)
    {
        $filters = $request->only(['fakultas_date_from', 'fakultas_date_to', 'fakultas_id']);
        $export = new FakultasExport($filters);
        
        return Pdf::loadView('exports.fakultas', $export->view()->getData())->download('laporan-fakultas.pdf');
    }
    
    public function exportFakultasExcel(Request $request)
    {
        $filters = $request->only(['fakultas_date_from', 'fakultas_date_to', 'fakultas_id']);
        return Excel::download(new FakultasExport($filters), 'laporan-fakultas.xlsx');
    }
}
