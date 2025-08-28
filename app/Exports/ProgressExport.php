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
        
        return $query->get();
    }
}
