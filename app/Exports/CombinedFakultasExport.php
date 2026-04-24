<?php

namespace App\Exports;

use App\Models\Progress;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CombinedFakultasExport implements FromView, ShouldAutoSize, WithStyles, WithTitle
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $allProgress = $this->getFilteredProgress($this->filters);

        // Filter dosen tetap
        $progressTetap = $allProgress->filter(function ($item) {
            $status = strtolower(trim($item->jadwalBooking->dosen->status_dosen ?? ''));
            return $status === 'tetap';
        });

        // Filter dosen tidak tetap
        $progressTidakTetap = $allProgress->filter(function ($item) {
            $status = strtolower(trim($item->jadwalBooking->dosen->status_dosen ?? ''));
            return in_array($status, ['tidak tetap', 'tidaktetap', 'tidak_tetap', 'non tetap', 'nontetap']);
        });

        return view('exports.combined_fakultas', [
            'progressTetap' => $progressTetap,
            'progressTidakTetap' => $progressTidakTetap,
        ]);
    }

    public function title(): string
    {
        return 'Fakultas Gab';
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
        if (!empty($filters['fakultas_year'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->whereYear('tanggal', $filters['fakultas_year']);
            });
        }

        if (!empty($filters['fakultas_month'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->whereMonth('tanggal', $filters['fakultas_month']);
            });
        }

        return $query->get();
    }
}
