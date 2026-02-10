<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\Dosen;
use App\Models\Mooc;
use App\Models\Studio;
use App\Models\MataKuliah;
use App\Models\Booking;
use App\Models\JadwalBooking;
use App\Models\Editor;
use App\Models\Progress;
use App\Models\ActivityLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ComprehensiveSeeder extends Seeder
{
    public function run(): void
    {
        // Create Users with different roles
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Dosen User',
                'email' => 'dosen@example.com',
                'password' => Hash::make('password'),
                'role' => 'dosen',
            ],
            [
                'name' => 'Editor User',
                'email' => 'editor@example.com',
                'password' => Hash::make('password'),
                'role' => 'editor',
            ],
            [
                'name' => 'Student User',
                'email' => 'student@example.com',
                'password' => Hash::make('password'),
                'role' => 'student',
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        // Create Fakultas
        $fakultasData = [
            ['nama_fakultas' => 'Fakultas Teknik', 'kode_fakultas' => 'FT', 'singkatan' => 'FT'],
            ['nama_fakultas' => 'Fakultas Ekonomi', 'kode_fakultas' => 'FE', 'singkatan' => 'FE'],
            ['nama_fakultas' => 'Fakultas Kedokteran', 'kode_fakultas' => 'FK', 'singkatan' => 'FK'],
            ['nama_fakultas' => 'Fakultas Hukum', 'kode_fakultas' => 'FH', 'singkatan' => 'FH'],
            ['nama_fakultas' => 'Fakultas Ilmu Sosial', 'kode_fakultas' => 'FIS', 'singkatan' => 'FIS'],
        ];

        foreach ($fakultasData as $fakultas) {
            Fakultas::create($fakultas);
        }

        // Create Prodi
        $prodiData = [
            ['nama_prodi' => 'Teknik Informatika', 'kode_prodi' => 'TI', 'fakultas_id' => 1],
            ['nama_prodi' => 'Teknik Sipil', 'kode_prodi' => 'TS', 'fakultas_id' => 1],
            ['nama_prodi' => 'Manajemen', 'kode_prodi' => 'MN', 'fakultas_id' => 2],
            ['nama_prodi' => 'Akuntansi', 'kode_prodi' => 'AK', 'fakultas_id' => 2],
            ['nama_prodi' => 'Kedokteran', 'kode_prodi' => 'KD', 'fakultas_id' => 3],
            ['nama_prodi' => 'Hukum', 'kode_prodi' => 'HK', 'fakultas_id' => 4],
            ['nama_prodi' => 'Psikologi', 'kode_prodi' => 'PS', 'fakultas_id' => 5],
        ];

        foreach ($prodiData as $prodi) {
            Prodi::create($prodi);
        }

        // Create Dosen
        $dosenData = [
            ['nama_dosen' => 'Dr. Ahmad Surya', 'nidn' => '1234567890', 'status_dosen' => 'Aktif', 'fakultas_id' => 1],
            ['nama_dosen' => 'Prof. Siti Aminah', 'nidn' => '1234567891', 'status_dosen' => 'Aktif', 'fakultas_id' => 1],
            ['nama_dosen' => 'Dr. Budi Santoso', 'nidn' => '1234567892', 'status_dosen' => 'Tidak Aktif', 'fakultas_id' => 2],
            ['nama_dosen' => 'Dr. Maya Sari', 'nidn' => '1234567893', 'status_dosen' => 'Aktif', 'fakultas_id' => 3],
            ['nama_dosen' => 'Prof. Joko Widodo', 'nidn' => '1234567894', 'status_dosen' => 'Aktif', 'fakultas_id' => 4],
            ['nama_dosen' => 'Dr. Rina Kartika', 'nidn' => '1234567895', 'status_dosen' => 'Aktif', 'fakultas_id' => 5],
            ['nama_dosen' => 'Dr. Hendro Gunawan', 'nidn' => '1234567896', 'status_dosen' => 'Tidak Aktif', 'fakultas_id' => 1],
        ];

        foreach ($dosenData as $dosen) {
            Dosen::create($dosen);
        }

        // Create Mata Kuliah
        $mataKuliahData = [
            ['nama_mata_kuliah' => 'Pemrograman Web', 'kode_mata_kuliah' => 'PW001', 'sks' => 3, 'semester' => 3, 'fakultas_id' => 1],
            ['nama_mata_kuliah' => 'Basis Data', 'kode_mata_kuliah' => 'BD002', 'sks' => 3, 'semester' => 4, 'fakultas_id' => 1],
            ['nama_mata_kuliah' => 'Struktur Data', 'kode_mata_kuliah' => 'SD003', 'sks' => 3, 'semester' => 3, 'fakultas_id' => 1],
            ['nama_mata_kuliah' => 'Mikroekonomi', 'kode_mata_kuliah' => 'ME004', 'sks' => 3, 'semester' => 2, 'fakultas_id' => 2],
            ['nama_mata_kuliah' => 'Makroekonomi', 'kode_mata_kuliah' => 'MA005', 'sks' => 3, 'semester' => 4, 'fakultas_id' => 2],
            ['nama_mata_kuliah' => 'Anatomi Manusia', 'kode_mata_kuliah' => 'AM006', 'sks' => 4, 'semester' => 1, 'fakultas_id' => 3],
            ['nama_mata_kuliah' => 'Hukum Pidana', 'kode_mata_kuliah' => 'HP007', 'sks' => 3, 'semester' => 5, 'fakultas_id' => 4],
            ['nama_mata_kuliah' => 'Psikologi Sosial', 'kode_mata_kuliah' => 'PS008', 'sks' => 3, 'semester' => 3, 'fakultas_id' => 5],
        ];

        foreach ($mataKuliahData as $mataKuliah) {
            MataKuliah::create($mataKuliah);
        }

        // Create Studios
        $studioData = [
            ['nama_studio' => 'Studio A', 'lokasi' => 'Gedung A Lantai 1', 'kapasitas' => 50, 'fasilitas' => 'Proyektor, Sound System'],
            ['nama_studio' => 'Studio B', 'lokasi' => 'Gedung B Lantai 2', 'kapasitas' => 30, 'fasilitas' => 'Whiteboard, Komputer'],
            ['nama_studio' => 'Studio C', 'lokasi' => 'Gedung C Lantai 3', 'kapasitas' => 100, 'fasilitas' => 'Proyektor, Sound System, Whiteboard'],
            ['nama_studio' => 'Studio D', 'lokasi' => 'Gedung A Lantai 2', 'kapasitas' => 25, 'fasilitas' => 'Komputer, Proyektor'],
            ['nama_studio' => 'Studio E', 'lokasi' => 'Gedung B Lantai 1', 'kapasitas' => 75, 'fasilitas' => 'Sound System, Whiteboard'],
        ];

        foreach ($studioData as $studio) {
            Studio::create($studio);
        }

        // Create MOOC
        $moocData = [
            ['judul' => 'Introduction to Programming', 'deskripsi' => 'Basic programming concepts', 'platform' => 'Coursera', 'durasi' => 40, 'kategori' => 'Programming'],
            ['judul' => 'Data Science Fundamentals', 'deskripsi' => 'Learn data science basics', 'platform' => 'edX', 'durasi' => 60, 'kategori' => 'Data Science'],
            ['judul' => 'Machine Learning', 'deskripsi' => 'Advanced ML techniques', 'platform' => 'Coursera', 'durasi' => 80, 'kategori' => 'AI'],
            ['judul' => 'Web Development', 'deskripsi' => 'Full stack web development', 'platform' => 'Udemy', 'durasi' => 50, 'kategori' => 'Web'],
            ['judul' => 'Database Design', 'deskripsi' => 'Relational database design', 'platform' => 'Coursera', 'durasi' => 35, 'kategori' => 'Database'],
        ];

        foreach ($moocData as $mooc) {
            Mooc::create($mooc);
        }

        // Create Editors
        $editorData = [
            ['nama' => 'Editor One', 'email' => 'editor1@example.com', 'spesialisasi' => 'Video Editing'],
            ['nama' => 'Editor Two', 'email' => 'editor2@example.com', 'spesialisasi' => 'Audio Editing'],
            ['nama' => 'Editor Three', 'email' => 'editor3@example.com', 'spesialisasi' => 'Graphic Design'],
            ['nama' => 'Editor Four', 'email' => 'editor4@example.com', 'spesialisasi' => 'Video Editing'],
        ];

        foreach ($editorData as $editor) {
            Editor::create($editor);
        }

        // Create Bookings
        $bookingData = [
            ['user_id' => 1, 'studio_id' => 1, 'tanggal_booking' => now()->addDays(1), 'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'status' => 'approved', 'keperluan' => 'Kuliah'],
            ['user_id' => 2, 'studio_id' => 2, 'tanggal_booking' => now()->addDays(2), 'jam_mulai' => '10:00', 'jam_selesai' => '12:00', 'status' => 'pending', 'keperluan' => 'Seminar'],
            ['user_id' => 3, 'studio_id' => 3, 'tanggal_booking' => now()->addDays(3), 'jam_mulai' => '14:00', 'jam_selesai' => '16:00', 'status' => 'approved', 'keperluan' => 'Workshop'],
            ['user_id' => 4, 'studio_id' => 4, 'tanggal_booking' => now()->addDays(4), 'jam_mulai' => '09:00', 'jam_selesai' => '11:00', 'status' => 'rejected', 'keperluan' => 'Meeting'],
            ['user_id' => 1, 'studio_id' => 5, 'tanggal_booking' => now()->addDays(5), 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'status' => 'approved', 'keperluan' => 'Presentasi'],
        ];

        foreach ($bookingData as $booking) {
            Booking::create($booking);
        }

        // Create Jadwal Bookings
        $jadwalData = [
            ['booking_id' => 1, 'dosen_id' => 1, 'tanggal' => now()->addDays(1), 'jam' => '08:00-10:00', 'nama_mata_kuliah' => 'Pemrograman Web'],
            ['booking_id' => 2, 'dosen_id' => 2, 'tanggal' => now()->addDays(2), 'jam' => '10:00-12:00', 'nama_mata_kuliah' => 'Basis Data'],
            ['booking_id' => 3, 'dosen_id' => 3, 'tanggal' => now()->addDays(3), 'jam' => '14:00-16:00', 'nama_mata_kuliah' => 'Mikroekonomi'],
            ['booking_id' => 4, 'dosen_id' => 4, 'tanggal' => now()->addDays(4), 'jam' => '09:00-11:00', 'nama_mata_kuliah' => 'Anatomi Manusia'],
            ['booking_id' => 5, 'dosen_id' => 5, 'tanggal' => now()->addDays(5), 'jam' => '13:00-15:00', 'nama_mata_kuliah' => 'Hukum Pidana'],
        ];

        foreach ($jadwalData as $jadwal) {
            JadwalBooking::create($jadwal);
        }

        // Create Progress
        $progressData = [
            ['jadwal_booking_id' => 1, 'editor_id' => 1, 'persentase' => 100, 'status' => 'completed', 'keterangan' => 'Video editing selesai', 'publish_link' => 'https://example.com/video1'],
            ['jadwal_booking_id' => 2, 'editor_id' => 2, 'persentase' => 75, 'status' => 'in_progress', 'keterangan' => 'Audio editing sedang diproses', 'publish_link' => null],
            ['jadwal_booking_id' => 3, 'editor_id' => 3, 'persentase' => 50, 'status' => 'in_progress', 'keterangan' => 'Graphic design sedang dikerjakan', 'publish_link' => null],
            ['jadwal_booking_id' => 4, 'editor_id' => 4, 'persentase' => 25, 'status' => 'in_progress', 'keterangan' => 'Video editing dimulai', 'publish_link' => null],
            ['jadwal_booking_id' => 5, 'editor_id' => 1, 'persentase' => 0, 'status' => 'pending', 'keterangan' => 'Menunggu assignment', 'publish_link' => null],
        ];

        foreach ($progressData as $progress) {
            Progress::create($progress);
        }

        // Create Activity Logs
        $activityData = [
            ['user_id' => 1, 'action' => 'login', 'description' => 'User logged in'],
            ['user_id' => 2, 'action' => 'booking_created', 'description' => 'New booking created'],
            ['user_id' => 3, 'action' => 'progress_updated', 'description' => 'Progress updated'],
            ['user_id' => 4, 'action' => 'login', 'description' => 'User logged in'],
            ['user_id' => 1, 'action' => 'booking_approved', 'description' => 'Booking approved'],
        ];

        foreach ($activityData as $activity) {
            ActivityLog::create($activity);
        }
    }
}
