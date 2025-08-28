<?php

namespace App\Exports;

use App\Models\JadwalBooking;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class JadwalExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $jadwal = $this->getFilteredJadwal($this->filters);
        
        return view('exports.jadwal', [
            'jadwal' => $jadwal
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
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
}
