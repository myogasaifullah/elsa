<?php

namespace App\Exports;

use App\Models\Progress;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProgressExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $progress = $this->getFilteredProgress($this->filters);

        return view('exports.progress', [
            'progress' => $progress
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    private function getFilteredProgress($filters)
    {
        $query = Progress::with([
            'jadwalBooking.dosen.fakultas',
            'jadwalBooking.dosen.prodi',
            'jadwalBooking.studio',
            'editor'
        ])->orderBy('created_at', 'desc');

        // Apply old filters (for backward compatibility)
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

        // Apply new filters from editor page
        if (!empty($filters['filter_dosen'])) {
            $query->whereHas('jadwalBooking.dosen', function ($q) use ($filters) {
                $q->where('nama_dosen', $filters['filter_dosen']);
            });
        }

        if (!empty($filters['filter_fakultas'])) {
            $query->whereHas('jadwalBooking.dosen.fakultas', function ($q) use ($filters) {
                $q->where('nama_fakultas', $filters['filter_fakultas']);
            });
        }

        if (!empty($filters['filter_matakuliah'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->where('nama_mata_kuliah', $filters['filter_matakuliah']);
            });
        }

        if (!empty($filters['filter_lokasi'])) {
            $query->whereHas('jadwalBooking.studio', function ($q) use ($filters) {
                $q->where('nama_studio', $filters['filter_lokasi']);
            });
        }

        if (!empty($filters['filter_jenis_shooting'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->where('jenis_kategori', $filters['filter_jenis_shooting']);
            });
        }

        if (!empty($filters['filter_tahun']) || !empty($filters['filter_bulan'])) {
            $query->where(function ($q) use ($filters) {
                if (!empty($filters['filter_tahun'])) {
                    $q->whereYear('target_upload', $filters['filter_tahun']);
                }
                if (!empty($filters['filter_bulan'])) {
                    $q->whereMonth('target_upload', $filters['filter_bulan']);
                }
            });
        }

        if (!empty($filters['filter_editor'])) {
            $query->whereHas('editor', function ($q) use ($filters) {
                $q->where('nama', $filters['filter_editor']);
            });
        }

        if (!empty($filters['filter_progres'])) {
            $query->where('progres', $filters['filter_progres']);
        }

        return $query->get();
    }
}
