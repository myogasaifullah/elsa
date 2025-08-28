<?php

namespace App\Exports;

use App\Models\Progress;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FakultasExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $progress = $this->getFilteredProgress($this->filters);
        
        return view('exports.fakultas', [
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
        $query = Progress::with(['jadwalBooking.dosen.fakultas'])->orderBy('created_at', 'desc');
        
        // Apply filters
        if (!empty($filters['fakultas_date_from'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->where('tanggal', '>=', $filters['fakultas_date_from']);
            });
        }
        
        if (!empty($filters['fakultas_date_to'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->where('tanggal', '<=', $filters['fakultas_date_to']);
            });
        }
        
        if (!empty($filters['fakultas_id'])) {
            $query->whereHas('jadwalBooking.dosen.fakultas', function ($q) use ($filters) {
                $q->where('id', $filters['fakultas_id']);
            });
        }
        
        return $query->get();
    }
}
