<?php

namespace App\Imports;

use App\Models\Progress;
use App\Models\JadwalBooking;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\MataKuliah;
use App\Models\Studio;
use App\Models\Editor;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ArsipImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $rows)
    {
        \Log::info('ArsipImport: Starting collection processing with ' . $rows->count() . ' rows');

        foreach ($rows as $index => $row) {
            \Log::info('ArsipImport: Processing row ' . ($index + 1) . ': ' . json_encode($row->toArray()));

            DB::transaction(function () use ($row, $index) {
                try {
                    // Find or create related models - create fakultas and prodi first
                    $dosen = null;
                    $fakultas = null;
                    $prodi = null;
                    $mataKuliah = null;
                    $studio = null;
                    $editor = null;

                    if (!empty($row['nama_fakultas'])) {
                        $fakultas = Fakultas::firstOrCreate(
                            ['nama_fakultas' => $row['nama_fakultas']],
                            ['nama_fakultas' => $row['nama_fakultas']]
                        );
                        \Log::info('ArsipImport: Created/found fakultas: ' . $fakultas->nama_fakultas);
                    }

                    if (!empty($row['nama_prodi'])) {
                        $prodi = Prodi::firstOrCreate(
                            ['nama_prodi' => $row['nama_prodi']],
                            ['nama_prodi' => $row['nama_prodi']]
                        );
                        \Log::info('ArsipImport: Created/found prodi: ' . $prodi->nama_prodi);
                    }

                    if (!empty($row['nama_dosen'])) {
                        // Generate a unique NUPTK based on nama_dosen
                        $baseNuptk = strtoupper(substr(md5($row['nama_dosen']), 0, 10));
                        $nuptk = $baseNuptk;
                        $counter = 1;

                        // Ensure NUPTK is unique
                        while (Dosen::where('nuptk_dosen', $nuptk)->exists()) {
                            $nuptk = $baseNuptk . $counter;
                            $counter++;
                        }

                        // Get or create default fakultas and prodi if not provided
                        if (!$fakultas) {
                            $fakultas = Fakultas::first() ?? Fakultas::create(['nama_fakultas' => 'Fakultas Default']);
                        }
                        if (!$prodi) {
                            $prodi = Prodi::first() ?? Prodi::create(['nama_prodi' => 'Prodi Default']);
                        }

                        $dosen = Dosen::firstOrCreate(
                            ['nama_dosen' => $row['nama_dosen']],
                            [
                                'nama_dosen' => $row['nama_dosen'],
                                'nuptk_dosen' => $nuptk,
                                'target_video_dosen' => 10, // Default target
                                'fakultas_id' => $fakultas->id,
                                'prodi_id' => $prodi->id,
                                'status' => 'aktif'
                            ]
                        );
                        \Log::info('ArsipImport: Created/found dosen: ' . $dosen->nama_dosen . ' with NUPTK: ' . $dosen->nuptk_dosen);
                    }

                    if (!empty($row['nama_mata_kuliah'])) {
                        $mataKuliah = MataKuliah::firstOrCreate(
                            ['nama_mata_kuliah' => $row['nama_mata_kuliah']],
                            ['nama_mata_kuliah' => $row['nama_mata_kuliah']]
                        );
                        \Log::info('ArsipImport: Created/found mata kuliah: ' . $mataKuliah->nama_mata_kuliah);
                    }

                    if (!empty($row['nama_studio'])) {
                        $studio = Studio::firstOrCreate(
                            ['nama_studio' => $row['nama_studio']],
                            ['nama_studio' => $row['nama_studio']]
                        );
                        \Log::info('ArsipImport: Created/found studio: ' . $studio->nama_studio);
                    }

                    if (!empty($row['nama_editor'])) {
                        $editor = Editor::firstOrCreate(
                            ['nama' => $row['nama_editor']],
                            ['nama' => $row['nama_editor']]
                        );
                        \Log::info('ArsipImport: Created/found editor: ' . $editor->nama);
                    }

                    // Create User if dosen exists
                    $user = null;
                    if ($dosen) {
                        $user = User::firstOrCreate(
                            ['name' => $dosen->nama_dosen],
                            [
                                'name' => $dosen->nama_dosen,
                                'email' => strtolower(str_replace(' ', '.', $dosen->nama_dosen)) . '@example.com',
                                'password' => bcrypt('password'),
                                'fakultas_id' => $fakultas ? $fakultas->id : null,
                                'prodi_id' => $prodi ? $prodi->id : null,
                            ]
                        );
                        \Log::info('ArsipImport: Created/found user: ' . $user->name);
                    }

                    // Create Jadwal Booking
                    $jadwalBooking = JadwalBooking::create([
                        'tanggal' => $this->parseDate($row['tanggal_shooting']),
                        'jam' => (!empty($row['jam_mulai']) && !empty($row['jam_selesai'])) ? $row['jam_mulai'] . ' - ' . $row['jam_selesai'] : null,
                        'jenis_kategori' => $row['jenis_kategori'] ?? null,
                        'kategori_mooc' => $row['kategori_mooc'] ?? null,
                        'nama_mata_kuliah' => $mataKuliah ? $mataKuliah->nama_mata_kuliah : ($row['judul_course'] ?? null),
                        'judul_course' => $row['judul_course'] ?? null,
                        'status' => $row['status'] ?? 'belum shooting',
                        'user_id' => $user ? $user->id : null,
                        'dosen_id' => $dosen ? $dosen->id : null,
                        'studio_id' => $studio ? $studio->id : null,
                    ]);
                    \Log::info('ArsipImport: Created jadwal booking with ID: ' . $jadwalBooking->id);

                    // Create Progress
                    $progress = Progress::create([
                        'jadwal_booking_id' => $jadwalBooking->id,
                        'target_upload' => $this->parseDate($row['target_upload']),
                        'persentase' => $row['persentase'] ?? null,
                        'progres' => $row['progres'] ?? null,
                        'keterangan' => $row['keterangan'] ?? null,
                        'durasi' => $row['durasi'] ?? null,
                        'tanggal_upload_youtube' => $this->parseDate($row['tanggal_upload_youtube']),
                        'publish_link_youtube' => $row['publish_link_youtube'] ?? null,
                        'editor_id' => $editor ? $editor->id : null,
                    ]);
                    \Log::info('ArsipImport: Created progress with ID: ' . $progress->id);
                } catch (\Exception $e) {
                    \Log::error('ArsipImport: Error processing row ' . ($index + 1) . ': ' . $e->getMessage());
                    \Log::error('ArsipImport: Stack trace: ' . $e->getTraceAsString());
                    throw $e;
                }
            });
        }

        \Log::info('ArsipImport: Collection processing completed');
    }

    private function parseDate($dateString)
    {
        if (empty($dateString)) {
            return null;
        }

        // Try different date formats
        $formats = [
            'Y-m-d',      // 2024-01-15
            'd/m/Y',      // 15/01/2024
            'm/d/Y',      // 01/15/2024
            'd-m-Y',      // 15-01-2024
            'm-d-Y',      // 01-15-2024
            'Y/m/d',      // 2024/01/15
        ];

        foreach ($formats as $format) {
            try {
                $date = \Carbon\Carbon::createFromFormat($format, $dateString);
                if ($date) {
                    \Log::info('ArsipImport: Successfully parsed date "' . $dateString . '" with format "' . $format . '"');
                    return $date->format('Y-m-d');
                }
            } catch (\Exception $e) {
                // Continue to next format
                continue;
            }
        }

        // If all formats fail, try Carbon::parse as last resort
        try {
            $date = \Carbon\Carbon::parse($dateString);
            \Log::info('ArsipImport: Successfully parsed date "' . $dateString . '" with Carbon::parse');
            return $date->format('Y-m-d');
        } catch (\Exception $e) {
            \Log::warning('ArsipImport: Failed to parse date "' . $dateString . '"');
            return null;
        }
    }

    public function rules(): array
    {
        return [
            'nama_dosen' => 'nullable|string|max:255',
            'nama_fakultas' => 'nullable|string|max:255',
            'nama_prodi' => 'nullable|string|max:255',
            'nama_mata_kuliah' => 'nullable|string|max:255',
            'judul_course' => 'nullable|string|max:255',
            'kategori_mooc' => 'nullable|string|max:255',
            'nama_studio' => 'nullable|string|max:255',
            'tanggal_shooting' => 'nullable|string', // Changed to string to be more flexible
            'jam_mulai' => 'nullable|string',
            'jam_selesai' => 'nullable|string',
            'jenis_kategori' => 'nullable|string|max:255',
            'target_upload' => 'nullable|string', // Changed to string to be more flexible
            'persentase' => 'nullable|numeric|min:0|max:100',
            'progres' => 'nullable|string', // Changed to string to be more flexible
            'keterangan' => 'nullable|string', // Changed to string to be more flexible
            'durasi' => 'nullable|integer|min:0',
            'tanggal_upload_youtube' => 'nullable|string', // Changed to string to be more flexible
            'publish_link_youtube' => 'nullable|string', // Changed to string since URL validation might be too strict
            'nama_editor' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
        ];
    }
}
