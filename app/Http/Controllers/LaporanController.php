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

        // Get filtered data for terbit section (published MOOC videos)
        $terbitData = $this->getFilteredTerbit($filterDosen, $perPage);

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
            'dosens',
            'terbitData'
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

        // Apply year filter
        if (!empty($filters['rekap_year'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->whereYear('tanggal', $filters['rekap_year']);
            });
        }

        // Apply month filter
        if (!empty($filters['rekap_month'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->whereMonth('tanggal', $filters['rekap_month']);
            });
        }

        // Apply fakultas year filter
        if (!empty($filters['fakultas_year'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->whereYear('tanggal', $filters['fakultas_year']);
            });
        }

        // Apply fakultas month filter
        if (!empty($filters['fakultas_month'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->whereMonth('tanggal', $filters['fakultas_month']);
            });
        }

        if ($perPage) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    private function getFilteredJadwal($filters)
    {
        $query = JadwalBooking::with(['dosen.fakultas', 'studio'])->orderBy('tanggal', 'desc');

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
            $query->whereHas('studio', function ($q) use ($filters) {
                $q->where('nama_studio', $filters['jadwal_studio']);
            });
        }

        if (!empty($filters['jadwal_jenis_kategori'])) {
            $query->where('jenis_kategori', $filters['jadwal_jenis_kategori']);
        }

        if (!empty($filters['jadwal_year'])) {
            $query->whereYear('tanggal', $filters['jadwal_year']);
        }

        if (!empty($filters['jadwal_month'])) {
            $query->whereMonth('tanggal', $filters['jadwal_month']);
        }

        return $query->get();
    }

    private function getFilteredTerbit($filters, $perPage = null)
    {
        $query = Progress::with([
            'jadwalBooking.dosen',
            'jadwalBooking'
        ])->whereNotNull('publish_link_youtube')
            ->orderBy('created_at', 'desc');

        // Apply filters
        if (!empty($filters['dosen_name'])) {
            $query->whereHas('jadwalBooking.dosen', function ($q) use ($filters) {
                $q->where('nama_dosen', 'like', '%' . $filters['dosen_name'] . '%');
            });
        }

        if (!empty($filters['upload_year'])) {
            $query->whereYear('tanggal_upload_youtube', $filters['upload_year']);
        }

        if (!empty($filters['upload_month'])) {
            $query->whereMonth('tanggal_upload_youtube', $filters['upload_month']);
        }

        if ($perPage) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    // Export methods for each table
    public function exportProgressPdf(Request $request)
    {
        $filters = $request->all(); // Get all query parameters
        $export = new ProgressExport($filters);

        return Pdf::loadView('exports.progress', $export->view()->getData())->download('laporan-progress.pdf');
    }

    public function exportProgressExcel(Request $request)
    {
        $filters = $request->all(); // Get all query parameters
        return Excel::download(new ProgressExport($filters), 'laporan-progress.xlsx');
    }

    public function exportJadwalPdf(Request $request)
    {
        $filters = $request->all(); // Get all query parameters
        $export = new JadwalExport($filters);

        return Pdf::loadView('exports.jadwal', $export->view()->getData())->download('laporan-jadwal.pdf');
    }

    public function exportJadwalExcel(Request $request)
    {
        $filters = $request->all(); // Get all query parameters
        return Excel::download(new JadwalExport($filters), 'laporan-jadwal.xlsx');
    }

    public function exportMoocPdf(Request $request)
    {
        $filters = $request->only(['rekap_date_from', 'rekap_date_to', 'rekap_dosen', 'rekap_kategori_mooc', 'rekap_fakultas', 'rekap_year', 'rekap_month']);
        $export = new MoocExport($filters);

        return Pdf::loadView('exports.mooc', $export->view()->getData())->setPaper('a4', 'landscape')->download('laporan-mooc.pdf');
    }

    public function exportMoocExcel(Request $request)
    {
        $filters = $request->only(['rekap_date_from', 'rekap_date_to', 'rekap_dosen', 'rekap_kategori_mooc', 'rekap_fakultas', 'rekap_year', 'rekap_month']);
        return Excel::download(new MoocExport($filters), 'laporan-mooc.xlsx');
    }

    public function exportRekapPdf(Request $request)
    {
        $filters = $request->only(['rekap_date_from', 'rekap_date_to', 'rekap_dosen', 'rekap_year', 'rekap_month']);
        $export = new RekapExport($filters);

        return Pdf::loadView('exports.rekap', $export->view()->getData())->download('laporan-rekap.pdf');
    }

    public function exportRekapExcel(Request $request)
    {
        $filters = $request->only(['rekap_date_from', 'rekap_date_to', 'rekap_dosen', 'rekap_year', 'rekap_month']);
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
        $filterFakultas = $request->only(['fakultas_date_from', 'fakultas_date_to', 'fakultas_id', 'fakultas_year', 'fakultas_month']);
        $progress = $this->getFilteredProgress($filterFakultas);

        $groupedByDosen = [];
        foreach ($progress as $item) {
            $dosen = $item->jadwalBooking->dosen ?? null;
            $jenisKategori = $item->jadwalBooking->jenis_kategori ?? null;

            if ($dosen) {
                $dosenId = $dosen->id;
                if (!isset($groupedByDosen[$dosenId])) {
                    $groupedByDosen[$dosenId] = [
                        'dosen' => $dosen,
                        'elearning_count' => 0,
                        'mooc_count' => 0,
                        'total_video' => 0,
                        'progres_count' => 0
                    ];
                }

                if (strtolower($jenisKategori) === 'e-learning') {
                    $groupedByDosen[$dosenId]['elearning_count']++;
                } elseif (strtolower($jenisKategori) === 'mooc') {
                    $groupedByDosen[$dosenId]['mooc_count']++;
                }

                $groupedByDosen[$dosenId]['total_video']++;

                if ($item->progres === 'progres') {
                    $groupedByDosen[$dosenId]['progres_count']++;
                }
            }
        }

        return Pdf::loadView('exports.fakultas', compact('groupedByDosen'))->download('laporan-fakultas.pdf');
    }

    public function exportFakultasExcel(Request $request)
    {
        $filterFakultas = $request->only(['fakultas_date_from', 'fakultas_date_to', 'fakultas_id', 'fakultas_year', 'fakultas_month']);
        $progress = $this->getFilteredProgress($filterFakultas);

        $groupedByDosen = [];
        foreach ($progress as $item) {
            $dosen = $item->jadwalBooking->dosen ?? null;
            $jenisKategori = $item->jadwalBooking->jenis_kategori ?? null;

            if ($dosen) {
                $dosenId = $dosen->id;
                if (!isset($groupedByDosen[$dosenId])) {
                    $groupedByDosen[$dosenId] = [
                        'dosen' => $dosen,
                        'elearning_count' => 0,
                        'mooc_count' => 0,
                        'total_video' => 0,
                        'progres_count' => 0
                    ];
                }

                if (strtolower($jenisKategori) === 'e-learning') {
                    $groupedByDosen[$dosenId]['elearning_count']++;
                } elseif (strtolower($jenisKategori) === 'mooc') {
                    $groupedByDosen[$dosenId]['mooc_count']++;
                }

                $groupedByDosen[$dosenId]['total_video']++;

                if ($item->progres === 'progres') {
                    $groupedByDosen[$dosenId]['progres_count']++;
                }
            }
        }

        return Excel::download(new \App\Exports\FakultasExport($groupedByDosen), 'laporan-fakultas.xlsx');
    }

    // New combined export methods
    public function exportCombinedFakultasPdf(Request $request)
    {
        $filters = $request->only(['fakultas_year', 'fakultas_month']);
        $export = new \App\Exports\CombinedFakultasExport($filters);

        return Pdf::loadView('exports.combined_fakultas', $export->view()->getData())->download('laporan-combined-fakultas.pdf');
    }

    public function exportCombinedFakultasExcel(Request $request)
    {
        $filters = $request->only(['fakultas_year', 'fakultas_month']);
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\CombinedFakultasExport($filters), 'laporan-combined-fakultas.xlsx');
    }

    // Separate report methods
    public function editor(Request $request)
    {
        ActivityLogService::log('lihat_laporan_editor', 'Melihat halaman laporan editor');

        $filterProgress = $request->only(['progress_date_from', 'progress_date_to', 'progress_dosen', 'progress_prodi']);

        // Get all filtered progress data without pagination for DataTables
        $progress = $this->getFilteredProgress($filterProgress);
        $prodis = Prodi::all();

        // Get unique values for filter dropdowns
        $uniqueDosen = $progress->pluck('jadwalBooking.dosen.nama_dosen')->unique()->filter()->sort()->values();
        $uniqueFakultas = $progress->pluck('jadwalBooking.user.fakultas.nama_fakultas')->unique()->filter()->sort()->values();
        $uniqueMataKuliah = $progress->pluck('jadwalBooking.nama_mata_kuliah')->unique()->filter()->sort()->values();
        $uniqueLokasi = $progress->pluck('jadwalBooking.studio.nama_studio')->unique()->filter()->sort()->values();
        $uniqueEditor = $progress->pluck('editor.nama')->unique()->filter()->sort()->values();

        // Get unique years and months from target_upload
        $uniqueYears = $progress->pluck('target_upload')->filter()->map(function ($date) {
            return $date ? \Carbon\Carbon::parse($date)->format('Y') : null;
        })->unique()->filter()->sort()->values();

        $uniqueMonths = $progress->pluck('target_upload')->filter()->map(function ($date) {
            return $date ? \Carbon\Carbon::parse($date)->format('m') : null;
        })->unique()->filter()->sort()->values();

        return view('laporan.editor', compact('progress', 'filterProgress', 'prodis', 'uniqueDosen', 'uniqueFakultas', 'uniqueMataKuliah', 'uniqueLokasi', 'uniqueEditor', 'uniqueYears', 'uniqueMonths'));
    }

    public function jadwal(Request $request)
    {
        ActivityLogService::log('lihat_laporan_jadwal', 'Melihat halaman laporan jadwal');

        $filterJadwal = $request->only(['jadwal_date_from', 'jadwal_date_to', 'jadwal_dosen', 'jadwal_studio', 'jadwal_jenis_kategori', 'jadwal_year', 'jadwal_month']);
        $jadwalBookings = $this->getFilteredJadwal($filterJadwal);

        $groupedJadwal = $jadwalBookings->groupBy('tanggal')->sortKeys();
        $studios = Studio::all();

        // Get unique values for filter dropdowns
        $uniqueDosen = $jadwalBookings->pluck('dosen.nama_dosen')->unique()->filter()->sort()->values();
        $uniqueFakultas = $jadwalBookings->pluck('dosen.fakultas.nama_fakultas')->unique()->filter()->sort()->values();
        $uniqueJudulCourse = $jadwalBookings->pluck('judul_course')->unique()->filter()->sort()->values();

        // Get unique years from jadwal booking dates
        $uniqueYears = $jadwalBookings->pluck('tanggal')->filter()->map(function ($date) {
            return $date ? \Carbon\Carbon::parse($date)->format('Y') : null;
        })->unique()->filter()->sort()->values();

        return view('laporan.jadwal', compact('groupedJadwal', 'filterJadwal', 'studios', 'uniqueDosen', 'uniqueFakultas', 'uniqueJudulCourse', 'uniqueYears'));
    }

    public function mooc(Request $request)
    {
        ActivityLogService::log('lihat_laporan_mooc', 'Melihat halaman laporan mooc');

        $filterRekap = $request->only(['rekap_date_from', 'rekap_date_to', 'rekap_dosen', 'rekap_kategori_mooc', 'rekap_fakultas', 'rekap_year', 'rekap_month']);

        // Get all MOOC progress data for unique values
        $allProgress = $this->getFilteredMoocProgress([]);

        // Get unique values for filter dropdowns from all data
        $uniqueDosen = $allProgress->pluck('jadwalBooking.dosen.nama_dosen')->unique()->filter()->sort()->values();
        $uniqueKategoriMooc = $allProgress->pluck('jadwalBooking.kategori_mooc')->unique()->filter()->sort()->values();
        $uniqueFakultas = $allProgress->pluck('jadwalBooking.dosen.fakultas.nama_fakultas')->unique()->filter()->sort()->values();

        // Get unique years and months from jadwal booking dates
        $uniqueYears = $allProgress->pluck('jadwalBooking.tanggal')->filter()->map(function ($date) {
            return $date ? \Carbon\Carbon::parse($date)->format('Y') : null;
        })->unique()->filter()->sort()->values();

        $uniqueMonths = $allProgress->pluck('jadwalBooking.tanggal')->filter()->map(function ($date) {
            return $date ? \Carbon\Carbon::parse($date)->format('m') : null;
        })->unique()->filter()->sort()->values();

        // Get filtered progress data with additional filters for MOOC category and video link
        $progress = $this->getFilteredMoocProgress($filterRekap);

        // Group progress by faculty
        $groupedByFakultas = $progress->groupBy(function ($item) {
            return $item->jadwalBooking->dosen->fakultas->nama_fakultas ?? 'Tidak Diketahui';
        })->sortKeys();

        return view('laporan.mooc', compact('groupedByFakultas', 'filterRekap', 'uniqueDosen', 'uniqueKategoriMooc', 'uniqueFakultas', 'uniqueYears', 'uniqueMonths'));
    }

    private function getFilteredMoocProgress($filters)
    {
        $query = Progress::with([
            'jadwalBooking.dosen.fakultas',
            'jadwalBooking.dosen.prodi',
            'jadwalBooking.studio',
            'editor'
        ])
            ->whereNotNull('publish_link_youtube') // Only data with video link
            ->whereHas('jadwalBooking', function ($q) {
                $q->where('jenis_kategori', 'Mooc'); // Only MOOC category
            })
            ->orderBy('created_at', 'desc');

        // Apply filters
        if (!empty($filters['rekap_date_from'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->where('tanggal', '>=', $filters['rekap_date_from']);
            });
        }

        if (!empty($filters['rekap_date_to'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->where('tanggal', '<=', $filters['rekap_date_to']);
            });
        }

        if (!empty($filters['rekap_dosen'])) {
            $query->whereHas('jadwalBooking.dosen', function ($q) use ($filters) {
                $q->where('nama_dosen', 'like', '%' . $filters['rekap_dosen'] . '%');
            });
        }

        if (!empty($filters['rekap_fakultas'])) {
            $query->whereHas('jadwalBooking.dosen.fakultas', function ($q) use ($filters) {
                $q->where('nama_fakultas', $filters['rekap_fakultas']);
            });
        }

        if (!empty($filters['rekap_kategori_mooc'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->where('kategori_mooc', $filters['rekap_kategori_mooc']);
            });
        }

        // Apply year filter
        if (!empty($filters['rekap_year'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->whereYear('tanggal', $filters['rekap_year']);
            });
        }

        // Apply month filter
        if (!empty($filters['rekap_month'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->whereMonth('tanggal', $filters['rekap_month']);
            });
        }

        return $query->get();
    }

    public function dosen(Request $request)
    {
        ActivityLogService::log('lihat_laporan_dosen', 'Melihat halaman laporan dosen');

        $filterRekap = $request->only(['rekap_year', 'rekap_month']);
        $progress = $this->getFilteredProgress($filterRekap);

        // Get unique years and months from jadwal booking dates
        $allProgress = $this->getFilteredProgress([]);
        $uniqueYears = $allProgress->pluck('jadwalBooking.tanggal')->filter()->map(function ($date) {
            return $date ? \Carbon\Carbon::parse($date)->format('Y') : null;
        })->unique()->filter()->sort()->values();

        $uniqueMonths = $allProgress->pluck('jadwalBooking.tanggal')->filter()->map(function ($date) {
            return $date ? \Carbon\Carbon::parse($date)->format('m') : null;
        })->unique()->filter()->sort()->values();

        $groupedProgress = [];
        foreach ($progress as $item) {
            $dosenName = $item->jadwalBooking->dosen->nama_dosen ?? 'N/A';
            if (!isset($groupedProgress[$dosenName])) {
                $groupedProgress[$dosenName] = [
                    'target' => $item->jadwalBooking->dosen->target_video_dosen ?? 0,
                    'sudah' => 0,
                    'proses' => 0,
                    'belum' => 0,
                    'terbit' => 0,
                    'keterangan_shooting' => '-',
                    'keterangan_video' => '-',
                ];
            }

            if ($item->jadwalBooking->status == 'sudah shooting') {
                $groupedProgress[$dosenName]['sudah']++;
            }
            if ($item->progres == 'progres') {
                $groupedProgress[$dosenName]['proses']++;
            }
            if ($item->jadwalBooking->status == 'belum shooting') {
                $groupedProgress[$dosenName]['belum']++;
            }
            if ($item->progres == 'selesai') {
                $groupedProgress[$dosenName]['terbit']++;
            }

            if ($groupedProgress[$dosenName]['target'] == $groupedProgress[$dosenName]['sudah']) {
                $groupedProgress[$dosenName]['keterangan_shooting'] = 'sudah shooting';
            } else {
                $groupedProgress[$dosenName]['keterangan_shooting'] = 'belum selesai';
            }

            if ($groupedProgress[$dosenName]['target'] == $groupedProgress[$dosenName]['terbit']) {
                $groupedProgress[$dosenName]['keterangan_video'] = 'selesai terbit';
            } else {
                $groupedProgress[$dosenName]['keterangan_video'] = 'belum terbit';
            }
        }

        return view('laporan.dosen', compact('groupedProgress', 'filterRekap', 'uniqueYears', 'uniqueMonths'));
    }

    public function terbit(Request $request)
    {
        ActivityLogService::log('lihat_laporan_terbit', 'Melihat halaman laporan terbit');

        $filterDosen = $request->only(['dosen_name', 'upload_year', 'upload_month']);

        // Load all data for client-side DataTable pagination like arsip.blade.php
        $terbitData = $this->getFilteredTerbit($filterDosen);

        $dosens = Dosen::all();

        return view('laporan.terbit', compact('terbitData', 'filterDosen', 'dosens'));
    }

    public function progres(Request $request)
    {
        ActivityLogService::log('lihat_laporan_progres', 'Melihat halaman laporan progres');

        $filterFakultas = $request->only(['fakultas_date_from', 'fakultas_date_to', 'fakultas_id', 'fakultas_year', 'fakultas_month']);
        $progress = $this->getFilteredProgress($filterFakultas);

        $groupedByDosen = [];
        foreach ($progress as $item) {
            $dosen = $item->jadwalBooking->dosen ?? null;
            $jenisKategori = $item->jadwalBooking->jenis_kategori ?? null;

            if ($dosen) {
                $dosenId = $dosen->id;
                if (!isset($groupedByDosen[$dosenId])) {
                    $groupedByDosen[$dosenId] = [
                        'dosen' => $dosen,
                        'elearning_count' => 0,
                        'mooc_count' => 0,
                        'total_video' => 0,
                        'progres_count' => 0
                    ];
                }

                if (strtolower($jenisKategori) === 'e-learning') {
                    $groupedByDosen[$dosenId]['elearning_count']++;
                } elseif (strtolower($jenisKategori) === 'mooc') {
                    $groupedByDosen[$dosenId]['mooc_count']++;
                }

                $groupedByDosen[$dosenId]['total_video']++;

                if ($item->progres === 'progres') {
                    $groupedByDosen[$dosenId]['progres_count']++;
                }
            }
        }

        $fakultases = Fakultas::all();

        // Get unique years and months from jadwal booking dates
        $allProgress = $this->getFilteredProgress([]);
        $uniqueYears = $allProgress->pluck('jadwalBooking.tanggal')->filter()->map(function ($date) {
            return $date ? \Carbon\Carbon::parse($date)->format('Y') : null;
        })->unique()->filter()->sort()->values();

        $uniqueMonths = $allProgress->pluck('jadwalBooking.tanggal')->filter()->map(function ($date) {
            return $date ? \Carbon\Carbon::parse($date)->format('m') : null;
        })->unique()->filter()->sort()->values();

        return view('laporan.progres', compact('groupedByDosen', 'filterFakultas', 'fakultases', 'uniqueYears', 'uniqueMonths'));
    }

    public function fakultas(Request $request)
    {
        ActivityLogService::log('lihat_laporan_fakultas', 'Melihat halaman laporan fakultas');

        $filterFakultas = $request->only(['fakultas_year', 'fakultas_month']);
        $progress = $this->getFilteredProgress($filterFakultas);

        $progressTetap = $progress->filter(function ($item) {
            $status = strtolower(trim($item->jadwalBooking->dosen->status_dosen ?? ''));
            return $status === 'tetap';
        });

        $progressTidakTetap = $progress->filter(function ($item) {
            $status = strtolower(trim($item->jadwalBooking->dosen->status_dosen ?? ''));
            return in_array($status, ['tidak tetap', 'tidaktetap', 'tidak_tetap', 'non tetap', 'nontetap']);
        });

        $fakultasDataTetap = [];
        foreach ($progressTetap as $item) {
            $dosen = $item->jadwalBooking->dosen;
            $fakultas = $dosen->fakultas->nama_fakultas ?? 'Tidak Diketahui';
            $dosenId = $dosen->id;

            if (!isset($fakultasDataTetap[$fakultas])) {
                $fakultasDataTetap[$fakultas] = [
                    'jumlah_dosen' => \App\Models\Dosen::where('fakultas_id', $dosen->fakultas_id)->count(),
                    'pembelajaran' => 0,
                    'mooc' => 0,
                    'editing' => 0,
                    'total' => 0
                ];
            }

            if ($item->progres == 'selesai') {
                if (strtolower($item->jadwalBooking->jenis_kategori ?? '') === 'mooc') {
                    $fakultasDataTetap[$fakultas]['mooc']++;
                } else {
                    $fakultasDataTetap[$fakultas]['pembelajaran']++;
                }
            } elseif ($item->progres == 'progres') {
                $fakultasDataTetap[$fakultas]['editing']++;
            }

            $fakultasDataTetap[$fakultas]['total']++;
        }

        $fakultasDataTidakTetap = [];
        foreach ($progressTidakTetap as $item) {
            $dosen = $item->jadwalBooking->dosen;
            $fakultas = $dosen->fakultas->nama_fakultas ?? 'Tidak Diketahui';
            $dosenId = $dosen->id;

            if (!isset($fakultasDataTidakTetap[$fakultas])) {
                $fakultasDataTidakTetap[$fakultas] = [
                    'jumlah_dosen' => \App\Models\Dosen::where('fakultas_id', $dosen->fakultas_id)->count(),
                    'pembelajaran' => 0,
                    'mooc' => 0,
                    'editing' => 0,
                    'total' => 0
                ];
            }

            if ($item->progres == 'selesai') {
                if (strtolower($item->jadwalBooking->jenis_kategori ?? '') === 'mooc') {
                    $fakultasDataTidakTetap[$fakultas]['mooc']++;
                } else {
                    $fakultasDataTidakTetap[$fakultas]['pembelajaran']++;
                }
            } elseif ($item->progres == 'progres') {
                $fakultasDataTidakTetap[$fakultas]['editing']++;
            }

            $fakultasDataTidakTetap[$fakultas]['total']++;
        }

        $fakultases = Fakultas::all();

        // Get unique years and months from jadwal booking dates
        $allProgress = $this->getFilteredProgress([]);
        $uniqueYears = $allProgress->pluck('jadwalBooking.tanggal')->filter()->map(function ($date) {
            return $date ? \Carbon\Carbon::parse($date)->format('Y') : null;
        })->unique()->filter()->sort()->values();

        $uniqueMonths = $allProgress->pluck('jadwalBooking.tanggal')->filter()->map(function ($date) {
            return $date ? \Carbon\Carbon::parse($date)->format('m') : null;
        })->unique()->filter()->sort()->values();

        return view('laporan.fakultas', compact('fakultasDataTetap', 'fakultasDataTidakTetap', 'filterFakultas', 'fakultases', 'uniqueYears', 'uniqueMonths'));
    }
}
