<?php

namespace App\Imports;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProdiImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $rows)
    {
        \Log::info('ProdiImport: Starting collection processing with ' . $rows->count() . ' rows');

        foreach ($rows as $index => $row) {
            \Log::info('ProdiImport: Processing row ' . ($index + 1) . ': ' . json_encode($row->toArray()));

            // Check if nama_prodi exists
            if (!isset($row['nama_prodi']) || empty($row['nama_prodi'])) {
                \Log::warning('ProdiImport: Skipping row ' . ($index + 1) . ' - nama_prodi is missing or empty');
                continue;
            }

            // Find or create fakultas
            $fakultas = null;
            if (!empty($row['nama_fakultas'])) {
                $fakultas = Fakultas::firstOrCreate(
                    ['nama_fakultas' => $row['nama_fakultas']],
                    ['nama_fakultas' => $row['nama_fakultas']]
                );
                \Log::info('ProdiImport: Found/created fakultas: ' . $fakultas->nama_fakultas);
            } else {
                // If no fakultas specified, skip or use default
                \Log::warning('ProdiImport: Skipping row ' . ($index + 1) . ' - nama_fakultas is required');
                continue;
            }

            try {
                $prodi = Prodi::create([
                    'fakultas_id' => $fakultas->id,
                    'nama_prodi' => $row['nama_prodi'],
                    'kode_prodi' => $row['kode_prodi'] ?? null,
                    'singkatan' => $row['singkatan'] ?? null,
                ]);

                \Log::info('ProdiImport: Created prodi ID ' . $prodi->id . ': ' . $row['nama_prodi']);
            } catch (\Exception $e) {
                \Log::error('ProdiImport: Error processing row ' . ($index + 1) . ': ' . $e->getMessage());
                throw $e;
            }
        }

        \Log::info('ProdiImport: Collection processing completed');
    }

    public function rules(): array
    {
        return [
            'nama_fakultas' => 'required|string|max:255',
            'nama_prodi' => 'required|string|max:255',
            'kode_prodi' => 'nullable|string|max:50',
            'singkatan' => 'nullable|string|max:50',
        ];
    }
}
