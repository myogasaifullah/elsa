<?php

namespace App\Imports;

use App\Models\Mooc;
use App\Models\Dosen;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class MoocImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    private $rowNumber = 0;

    public function model(array $row)
    {
        $this->rowNumber++;

        \Log::info('MoocImport: Processing row ' . $this->rowNumber . ': ' . json_encode($row));

        // Skip if this looks like a header row (all values are strings that could be headers)
        if ($this->isHeaderRow($row)) {
            \Log::info('MoocImport: Skipping header row ' . $this->rowNumber);
            return null;
        }

        // Check if required fields exist and are not empty
        if (empty(trim($row['judul_mooc'] ?? ''))) {
            \Log::warning('MoocImport: Skipping row ' . $this->rowNumber . ' - judul_mooc is missing or empty');
            return null;
        }
        if (empty(trim($row['nama_dosen'] ?? ''))) {
            \Log::warning('MoocImport: Skipping row ' . $this->rowNumber . ' - nama_dosen is missing or empty');
            return null;
        }

        // Check if dosen exists by name
        $dosen = Dosen::where('nama_dosen', trim($row['nama_dosen']))->first();
        if (!$dosen) {
            \Log::warning('MoocImport: Skipping row ' . $this->rowNumber . ' - nama_dosen ' . $row['nama_dosen'] . ' does not exist');
            return null;
        }

        return new Mooc([
            'judul_mooc' => trim($row['judul_mooc']),
            'dosen_id' => $dosen->id,
        ]);
    }

    private function isHeaderRow(array $row): bool
    {
        // Check if all required fields contain header-like strings
        $headerIndicators = ['judul', 'mooc', 'dosen'];
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
            'judul_mooc' => 'required|string|max:255',
            'nama_dosen' => 'required|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'judul_mooc.required' => 'Kolom judul_mooc wajib diisi.',
            'nama_dosen.required' => 'Kolom nama_dosen wajib diisi.',
        ];
    }
}
