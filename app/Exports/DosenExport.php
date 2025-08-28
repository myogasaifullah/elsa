<?php

namespace App\Exports;

use App\Models\Progress;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DosenExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $progress = $this->getFilteredProgress($this->filters);
        
        return view('exports.dosen', [
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
        $query = Progress::with(['jadwalBooking.dosen'])->orderBy('created_at', 'desc');
        
        // Apply filters
        if (!empty($filters['dosen_date_from'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->where('tanggal', '>=', $filters['dosen_date_from']);
            });
        }
        
        if (!empty($filters['dosen_date_to'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->where('tanggal', '<=', $filters['dosen_date_to']);
            });
        }
        
        if (!empty($filters['dosen_status'])) {
            $query->whereHas('jadwalBooking.dosen', function ($q) use ($filters) {
                $q->where('status_dosen', $filters['dosen_status']);
            });
        }
        
        // Filter for Mooc jenis_kategori and selesai progres
        $query->whereHas('jadwalBooking', function ($q) {
            $q->where('jenis_kategori', 'Mooc');
        })->where('progres', 'selesai');
        
        return $query->get();
    }
}
