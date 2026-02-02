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
        if (empty($row['dosen_id'] ?? '')) {
            \Log::warning('MoocImport: Skipping row ' . $this->rowNumber . ' - dosen_id is missing or empty');
            return null;
        }

        // Check if dosen exists
        $dosen = Dosen::find($row['dosen_id']);
        if (!$dosen) {
            \Log::warning('MoocImport: Skipping row ' . $this->rowNumber . ' - dosen_id ' . $row['dosen_id'] . ' does not exist');
            return null;
        }

        return new Mooc([
            'judul_mooc' => trim($row['judul_mooc']),
            'dosen_id' => $row['dosen_id'],
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
            'dosen_id' => 'required|exists:dosens,id',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'judul_mooc.required' => 'Kolom judul_mooc wajib diisi.',
            'dosen_id.required' => 'Kolom dosen_id wajib diisi.',
            'dosen_id.exists' => 'Dosen dengan ID tersebut tidak ditemukan.',
        ];
    }
}
