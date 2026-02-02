<?php

namespace App\Imports;

use App\Models\MataKuliah;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MataKuliahImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $rows)
    {
        \Log::info('MataKuliahImport: Starting collection processing with ' . $rows->count() . ' rows');

        foreach ($rows as $index => $row) {
            \Log::info('MataKuliahImport: Processing row ' . ($index + 1) . ': ' . json_encode($row->toArray()));

            // Check if required fields exist
            if (!isset($row['nama_mata_kuliah']) || empty($row['nama_mata_kuliah'])) {
                \Log::warning('MataKuliahImport: Skipping row ' . ($index + 1) . ' - nama_mata_kuliah is missing or empty');
                continue;
            }

            if (!isset($row['kode_matakuliah']) || empty($row['kode_matakuliah'])) {
                \Log::warning('MataKuliahImport: Skipping row ' . ($index + 1) . ' - kode_matakuliah is missing or empty');
                continue;
            }

            // Find fakultas
            $fakultas = null;
            if (!empty($row['nama_fakultas'])) {
                $fakultas = Fakultas::where('nama_fakultas', $row['nama_fakultas'])->first();
                if (!$fakultas) {
                    \Log::warning('MataKuliahImport: Skipping row ' . ($index + 1) . ' - fakultas not found: ' . $row['nama_fakultas']);
                    continue;
                }
            } else {
                \Log::warning('MataKuliahImport: Skipping row ' . ($index + 1) . ' - nama_fakultas is required');
                continue;
            }

            // Find prodi
            $prodi = null;
            if (!empty($row['nama_prodi'])) {
                $prodi = Prodi::where('nama_prodi', $row['nama_prodi'])
                    ->where('fakultas_id', $fakultas->id)
                    ->first();
                if (!$prodi) {
                    \Log::warning('MataKuliahImport: Skipping row ' . ($index + 1) . ' - prodi not found: ' . $row['nama_prodi']);
                    continue;
                }
            } else {
                \Log::warning('MataKuliahImport: Skipping row ' . ($index + 1) . ' - nama_prodi is required');
                continue;
            }

            try {
                $mataKuliah = MataKuliah::create([
                    'fakultas_id' => $fakultas->id,
                    'prodi_id' => $prodi->id,
                    'nama_mata_kuliah' => $row['nama_mata_kuliah'],
                    'kode_matakuliah' => $row['kode_matakuliah'],
                    'sks' => $row['sks'] ?? 1,
                    'keterangan' => $row['keterangan'] ?? 'wajib',
                ]);

                \Log::info('MataKuliahImport: Created mata kuliah ID ' . $mataKuliah->id . ': ' . $row['nama_mata_kuliah']);
            } catch (\Exception $e) {
                \Log::error('MataKuliahImport: Error processing row ' . ($index + 1) . ': ' . $e->getMessage());
                throw $e;
            }
        }

        \Log::info('MataKuliahImport: Collection processing completed');
    }

    public function rules(): array
    {
        return [
            'nama_fakultas' => 'required|string|max:255',
            'nama_prodi' => 'required|string|max:255',
            'nama_mata_kuliah' => 'required|string|max:255',
            'kode_matakuliah' => 'required|string|max:255',
            'sks' => 'nullable|integer|min:1',
            'keterangan' => 'nullable|in:wajib,pilihan',
        ];
    }
}
