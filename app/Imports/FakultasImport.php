<?php

namespace App\Imports;

use App\Models\Fakultas;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class FakultasImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $rows)
    {
        \Log::info('FakultasImport: Starting collection processing with ' . $rows->count() . ' rows');

        foreach ($rows as $index => $row) {
            \Log::info('FakultasImport: Processing row ' . ($index + 1) . ': ' . json_encode($row->toArray()));

            // Check if nama_fakultas exists
            if (!isset($row['nama_fakultas']) || empty($row['nama_fakultas'])) {
                \Log::warning('FakultasImport: Skipping row ' . ($index + 1) . ' - nama_fakultas is missing or empty');
                continue;
            }

            try {
                $fakultas = Fakultas::create([
                    'nama_fakultas' => $row['nama_fakultas'],
                    'kode_fakultas' => $row['kode_fakultas'] ?? null,
                    'singkatan' => $row['singkatan'] ?? null,
                ]);

                \Log::info('FakultasImport: Created fakultas ID ' . $fakultas->id . ': ' . $row['nama_fakultas']);
            } catch (\Exception $e) {
                \Log::error('FakultasImport: Error processing row ' . ($index + 1) . ': ' . $e->getMessage());
                throw $e;
            }
        }

        \Log::info('FakultasImport: Collection processing completed');
    }

    public function rules(): array
    {
        return [
            'nama_fakultas' => 'required|string|max:255',
            'kode_fakultas' => 'nullable|string|max:50',
            'singkatan' => 'nullable|string|max:50',
        ];
    }
}
