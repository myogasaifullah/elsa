<?php

namespace App\Imports;

use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class DosenImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    private $rowNumber = 0;

    public function model(array $row)
    {
        $this->rowNumber++;

        \Log::info('DosenImport: Processing row ' . $this->rowNumber . ': ' . json_encode($row));

        // Skip if this looks like a header row (all values are strings that could be headers)
        if ($this->isHeaderRow($row)) {
            \Log::info('DosenImport: Skipping header row ' . $this->rowNumber);
            return null;
        }

        // Check if required fields exist and are not empty
        if (empty(trim($row['nama_dosen'] ?? ''))) {
            \Log::warning('DosenImport: Skipping row ' . $this->rowNumber . ' - nama_dosen is missing or empty');
            return null;
        }
        if (empty(trim($row['nuptk_dosen'] ?? ''))) {
            \Log::warning('DosenImport: Skipping row ' . $this->rowNumber . ' - nuptk_dosen is missing or empty');
            return null;
        }
        if (empty($row['fakultas_id'] ?? '')) {
            \Log::warning('DosenImport: Skipping row ' . $this->rowNumber . ' - fakultas_id is missing or empty');
            return null;
        }
        if (empty($row['prodi_id'] ?? '')) {
            \Log::warning('DosenImport: Skipping row ' . $this->rowNumber . ' - prodi_id is missing or empty');
            return null;
        }

        // Check if fakultas and prodi exist
        $fakultas = Fakultas::find($row['fakultas_id']);
        $prodi = Prodi::find($row['prodi_id']);
        if (!$fakultas) {
            \Log::warning('DosenImport: Skipping row ' . $this->rowNumber . ' - fakultas_id ' . $row['fakultas_id'] . ' does not exist');
            return null;
        }
        if (!$prodi) {
            \Log::warning('DosenImport: Skipping row ' . $this->rowNumber . ' - prodi_id ' . $row['prodi_id'] . ' does not exist');
            return null;
        }

        return new Dosen([
            'nama_dosen' => trim($row['nama_dosen']),
            'nuptk_dosen' => trim($row['nuptk_dosen']),
            'target_video_dosen' => $row['target_video_dosen'] ?? 0,
            'status_dosen' => $row['status_dosen'] ?? 'tetap',
            'fakultas_id' => $row['fakultas_id'],
            'prodi_id' => $row['prodi_id'],
        ]);
    }

    private function isHeaderRow(array $row): bool
    {
        // Check if all required fields contain header-like strings
        $headerIndicators = ['nama', 'nuptk', 'fakultas', 'prodi', 'dosen', 'target', 'status'];
        $rowString = strtolower(implode(' ', array_values($row)));

        foreach ($headerIndicators as $indicator) {
            if (strpos($rowString, $indicator) !== false) {
                return true;
            }
        }

        return false;
    }

    public function rules(): array
    {
        return [
            'nama_dosen' => 'required|string|max:255',
            'nuptk_dosen' => 'required|string|unique:dosens,nuptk_dosen',
            'target_video_dosen' => 'nullable|integer',
            'status_dosen' => 'nullable|in:tetap,tidak_tetap',
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id' => 'required|exists:prodis,id',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama_dosen.required' => 'Kolom nama_dosen wajib diisi.',
            'nuptk_dosen.required' => 'Kolom nuptk_dosen wajib diisi.',
            'nuptk_dosen.unique' => 'NUPTK dosen sudah terdaftar.',
            'fakultas_id.required' => 'Kolom fakultas_id wajib diisi.',
            'fakultas_id.exists' => 'Fakultas dengan ID tersebut tidak ditemukan.',
            'prodi_id.required' => 'Kolom prodi_id wajib diisi.',
            'prodi_id.exists' => 'Prodi dengan ID tersebut tidak ditemukan.',
            'status_dosen.in' => 'Status dosen harus tetap atau tidak_tetap.',
        ];
    }
}
