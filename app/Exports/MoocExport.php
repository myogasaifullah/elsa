<?php

namespace App\Exports;

use App\Models\Progress;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MoocExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $progress = $this->getFilteredProgress($this->filters);
        
        // Group by fakultas
        $grouped = $progress->groupBy('jadwalBooking.user.fakultas.nama_fakultas');
        
        return view('exports.mooc', [
            'grouped' => $grouped
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
        if (!empty($filters['mooc_date_from'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->where('tanggal', '>=', $filters['mooc_date_from']);
            });
        }
        
        if (!empty($filters['mooc_date_to'])) {
            $query->whereHas('jadwalBooking', function ($q) use ($filters) {
                $q->where('tanggal', '<=', $filters['mooc_date_to']);
            });
        }
        
        if (!empty($filters['mooc_dosen'])) {
            $query->whereHas('jadwalBooking.dosen', function ($q) use ($filters) {
                $q->where('nama_dosen', 'like', '%' . $filters['mooc_dosen'] . '%');
            });
        }
        
        return $query->get();
    }
}
