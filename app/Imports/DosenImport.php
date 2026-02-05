<?php

namespace App\Imports;

use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class DosenImport implements ToModel, WithValidation, SkipsEmptyRows
{
    private $rowNumber = 0;

    public function model(array $row)
    {
        $this->rowNumber++;

        \Log::info('DosenImport: Processing row ' . $this->rowNumber . ': ' . json_encode($row));

        // Skip header row (first row)
        if ($this->rowNumber === 1) {
            \Log::info('DosenImport: Skipping header row ' . $this->rowNumber);
            return null;
        }

        // Map indexed array to named fields
        // Assuming columns are: nama_dosen, nuptk_dosen, target_video_dosen, status_dosen, nama_fakultas, nama_prodi
        $nama_dosen = trim($row[0] ?? '');
        $nuptk_dosen = trim($row[1] ?? '');
        $target_video_dosen = is_numeric($row[2] ?? 0) ? (int)$row[2] : 0;
        $status_dosen = trim(strtolower($row[3] ?? 'tetap'));
        // Normalize status values
        if (in_array($status_dosen, ['tetap', 'tidak tetap', 'tidak_tetap', 'tidak-tetap'])) {
            $status_dosen = $status_dosen === 'tetap' ? 'tetap' : 'tidak_tetap';
        } else {
            $status_dosen = 'tetap'; // default
        }
        $nama_fakultas = trim($row[4] ?? '');
        $nama_prodi = trim($row[5] ?? '');

        \Log::info('DosenImport: Mapped data - nama_dosen: "' . $nama_dosen . '", nuptk_dosen: "' . $nuptk_dosen . '", nama_fakultas: "' . $nama_fakultas . '", nama_prodi: "' . $nama_prodi . '"');

        // Check if required fields exist and are not empty
        if (empty($nama_dosen)) {
            \Log::warning('DosenImport: Skipping row ' . $this->rowNumber . ' - nama_dosen is missing or empty');
            return null;
        }
        if (empty($nuptk_dosen)) {
            \Log::warning('DosenImport: Skipping row ' . $this->rowNumber . ' - nuptk_dosen is missing or empty');
            return null;
        }
        if (empty($nama_fakultas)) {
            \Log::warning('DosenImport: Skipping row ' . $this->rowNumber . ' - nama_fakultas is missing or empty');
            return null;
        }
        if (empty($nama_prodi)) {
            \Log::warning('DosenImport: Skipping row ' . $this->rowNumber . ' - nama_prodi is missing or empty');
            return null;
        }

        // Find fakultas and prodi by name
        $fakultas = Fakultas::where('nama_fakultas', $nama_fakultas)->first();
        $prodi = Prodi::where('nama_prodi', $nama_prodi)->first();
        if (!$fakultas) {
            \Log::warning('DosenImport: Skipping row ' . $this->rowNumber . ' - nama_fakultas "' . $nama_fakultas . '" does not exist');
            return null;
        }
        if (!$prodi) {
            \Log::warning('DosenImport: Skipping row ' . $this->rowNumber . ' - nama_prodi "' . $nama_prodi . '" does not exist');
            return null;
        }

        \Log::info('DosenImport: Creating dosen record for row ' . $this->rowNumber);

        return new Dosen([
            'nama_dosen' => $nama_dosen,
            'nuptk_dosen' => $nuptk_dosen,
            'target_video_dosen' => $target_video_dosen,
            'status_dosen' => $status_dosen,
            'fakultas_id' => $fakultas->id,
            'prodi_id' => $prodi->id,
        ]);
    }

    private function isHeaderRow(array $row): bool
    {
        // More specific check: if the row contains typical header patterns
        // Check if nama_dosen column contains header-like text
        $namaDosenValue = strtolower(trim($row['nama_dosen'] ?? ''));
        if (in_array($namaDosenValue, ['nama dosen', 'nama_dosen', 'nama'])) {
            return true;
        }

        // Check if nuptk_dosen column contains header-like text
        $nuptkValue = strtolower(trim($row['nuptk_dosen'] ?? ''));
        if (in_array($nuptkValue, ['nuptk', 'nuptk dosen', 'nuptk_dosen'])) {
            return true;
        }

        return false;
    }

    public function rules(): array
    {
        return [
            '0' => 'required|string|max:255', // nama_dosen
            '1' => 'required|string|unique:dosens,nuptk_dosen', // nuptk_dosen
            '2' => 'nullable', // target_video_dosen - we'll handle validation in model method
            '3' => 'nullable', // status_dosen - we'll handle validation in model method
            '4' => 'required|string', // nama_fakultas
            '5' => 'required|string', // nama_prodi
        ];
    }

    public function customValidationMessages()
    {
        return [
            '0.required' => 'Kolom nama_dosen wajib diisi.',
            '1.required' => 'Kolom nuptk_dosen wajib diisi.',
            '1.unique' => 'NUPTK dosen sudah terdaftar.',
            '4.required' => 'Kolom nama_fakultas wajib diisi.',
            '5.required' => 'Kolom nama_prodi wajib diisi.',
            '3.in' => 'Status dosen harus tetap atau tidak_tetap.',
        ];
    }
}
