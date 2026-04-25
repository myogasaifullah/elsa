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
    protected $groupedByFakultas;

    public function __construct($groupedByFakultas = [])
    {
        $this->groupedByFakultas = $groupedByFakultas;
    }

    public function view(): View
    {
        return view('exports.fakultas', [
            'groupedByFakultas' => $this->groupedByFakultas
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

        return $query->get();
    }
}
