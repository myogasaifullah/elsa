<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigratePersentaseToProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data dari tabel persentase
        $persentaseData = DB::table('persentase')->get();
        
        foreach ($persentaseData as $data) {
            // Update data di tabel progress berdasarkan id_progres
            DB::table('progress')
                ->where('id', $data->id_progres)
                ->update([
                    'target_upload' => $data->target_publish,
                    'tanggal_upload_youtube' => $data->tanggal_publish,
                    'publish_link_youtube' => $data->publish_link_youtube,
                    'durasi' => $data->durasi_video_menit,
                ]);
        }
        
        $this->command->info('Data berhasil dipindahkan dari tabel persentase ke progress!');
    }
}
