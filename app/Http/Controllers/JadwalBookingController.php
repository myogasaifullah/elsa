<?php

namespace App\Http\Controllers;

use App\Models\JadwalBooking;
use App\Models\Studio;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JadwalBookingController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;

    public function index()
    {
        // Catat aktivitas: melihat halaman jadwal booking
        ActivityLogService::log('lihat_jadwal_booking', 'Melihat daftar jadwal booking');

        $jadwals = JadwalBooking::with(['user.fakultas', 'user.prodi', 'dosen'])->where('status', '!=', 'sudah shooting')->latest()->get();
        $moocs = \App\Models\Mooc::with('dosen')->get();
        $mataKuliahs = \App\Models\MataKuliah::all();
        $dosens = \App\Models\Dosen::all();
        $studios = Studio::all();

        return view('jadwal', compact('jadwals', 'moocs', 'mataKuliahs', 'dosens', 'studios'));
    }

    public function store(Request $request)
    {
        Log::info('JadwalBooking store called', $request->all());

        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'jenis_kategori' => 'required|string',
            'kategori_mooc' => 'nullable|string',
            'studio_id' => 'required|exists:studios,id',
            'nama_mata_kuliah' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'judul_course' => 'required|string|max:255',
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        try {
            $jadwal = JadwalBooking::create([
                'tanggal' => $request->tanggal,
                'jam' => $request->jam_mulai . ' - ' . $request->jam_selesai,
                'jenis_kategori' => $request->jenis_kategori,
                'kategori_mooc' => $request->kategori_mooc,
                'studio_id' => $request->studio_id,
                'nama_mata_kuliah' => $request->nama_mata_kuliah ?: null,
                'deskripsi' => $request->deskripsi ?: null,
                'judul_course' => $request->judul_course,
                'user_id' => Auth::id(),
                'dosen_id' => $request->dosen_id,
                'status' => 'pending'
            ]);

            // Catat aktivitas: menambahkan jadwal booking baru
            ActivityLogService::create('jadwal_booking', "Menambahkan jadwal booking baru: {$jadwal->judul_course} pada tanggal {$jadwal->tanggal}");

            return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan jadwal booking: ' . $e->getMessage(), $request->all());
            return back()->with('error', 'Gagal menyimpan jadwal ke database. Pastikan nama mata kuliah diisi jika diperlukan. Error: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, JadwalBooking $jadwal)
    {
        $this->authorize('update', $jadwal);

        Log::info('JadwalBooking update called', $request->all());

        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'jenis_kategori' => 'required|string',
            'kategori_mooc' => 'nullable|string',
            'studio_id' => 'required|exists:studios,id',
            'nama_mata_kuliah' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'judul_course' => 'required|string|max:255',
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        $oldData = $jadwal->toArray();
        try {
            $jadwal->update([
                'tanggal' => $request->tanggal,
                'jam' => $request->jam_mulai . ' - ' . $request->jam_selesai,
                'jenis_kategori' => $request->jenis_kategori,
                'kategori_mooc' => $request->kategori_mooc,
                'studio_id' => $request->studio_id,
                'nama_mata_kuliah' => $request->nama_mata_kuliah ?: null,
                'deskripsi' => $request->deskripsi ?: null,
                'judul_course' => $request->judul_course,
                'dosen_id' => $request->dosen_id,
            ]);

            ActivityLogService::update('jadwal_booking', "Memperbarui jadwal booking ID {$jadwal->id}. Data lama: " . json_encode($oldData) . " -> Data baru: " . json_encode($jadwal));

            return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Gagal update jadwal booking: ' . $e->getMessage(), $request->all());
            return back()->with('error', 'Gagal update jadwal ke database. Error: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(JadwalBooking $jadwal)
    {
        $this->authorize('delete', $jadwal);

        // Catat aktivitas: menghapus jadwal booking
        ActivityLogService::delete('jadwal_booking', "Menghapus jadwal booking ID {$jadwal->id} dengan judul {$jadwal->judul_course}");

        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }

    /**
     * Display approved bookings
     */
    public function scheduledBookings()
    {
        // Catat aktivitas: melihat jadwal booking yang disetujui
        ActivityLogService::log('lihat_jadwal_booking_disetujui', 'Melihat daftar jadwal booking yang disetujui');

        $jadwals = JadwalBooking::with(['user.fakultas', 'user.prodi', 'dosen', 'studio'])
            ->where('status', 'approved')
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->get();

        return view('booking.booking', compact('jadwals'));
    }

    /**
     * Mark a booking as done and create progress entry
     */
    public function markAsDone(JadwalBooking $jadwal)
    {
        try {
            // Update the jadwal status to "sudah shooting"
            $jadwal->update(['status' => 'sudah shooting']);

            // Catat aktivitas: menandai jadwal sebagai sudah shooting
            try {
                ActivityLogService::log('mark_as_done', "Menandai jadwal booking ID {$jadwal->id} sebagai sudah shooting");
            } catch (\Exception $e) {
                Log::error('Error logging activity in markAsDone: ' . $e->getMessage());
                // Continue without failing the operation
            }

            $progressCreated = false;
            try {
                // Create progress entry with the jadwal_booking_id
                $progress = \App\Models\Progress::create([
                    'jadwal_booking_id' => $jadwal->id,
                    'target_upload' => now()->addDays(7),
                    'persentase' => 0.00,
                    'progres' => 'belum',
                    'keterangan' => 'belum terbit',
                    'durasi' => null,
                    'tanggal_upload_youtube' => null,
                    'editor_id' => null,
                ]);
                $progressCreated = true;
            } catch (\Exception $e) {
                Log::error('Error creating progress in markAsDone: ' . $e->getMessage(), [
                    'jadwal_id' => $jadwal->id,
                    'trace' => $e->getTraceAsString()
                ]);
                // Continue without failing the whole operation
            }

            $message = $progressCreated
                ? 'Booking berhasil ditandai sebagai sudah shooting dan progress berhasil dibuat.'
                : 'Booking berhasil ditandai sebagai sudah shooting, namun gagal membuat progress.';

            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            Log::error('Error in markAsDone: ' . $e->getMessage(), [
                'jadwal_id' => $jadwal->id,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menandai booking: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark a booking as done and create progress entry (legacy method)
     */
    public function done(JadwalBooking $jadwal)
    {
        try {
            // Create progress entry with the jadwal_booking_id
            $progress = \App\Models\Progress::create([
                'jadwal_booking_id' => $jadwal->id,
                'target_upload' => now()->addDays(7),
                'persentase' => 0.00,
                'progres' => 'belum',
                'keterangan' => 'belum terbit',
                'durasi' => null,
                'tanggal_upload_youtube' => null,
                'editor_id' => null,
            ]);

            // Update the jadwal status to completed
            $jadwal->update(['status' => 'completed']);

            // Catat aktivitas: menandai jadwal sebagai selesai
            ActivityLogService::log('done', "Menandai jadwal booking ID {$jadwal->id} sebagai selesai");

            return redirect()->back()->with('success', 'Booking marked as done and progress entry created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to mark booking as done: ' . $e->getMessage());
        }
    }

    /**
     * Show a specific booking
     */
    public function show(JadwalBooking $jadwal)
    {
        // Catat aktivitas: melihat detail jadwal booking
        ActivityLogService::log('lihat_detail_jadwal_booking', "Melihat detail jadwal booking ID {$jadwal->id}");

        $jadwal->load(['user.fakultas', 'user.prodi', 'dosen', 'studio']);

        return response()->json([
            'tanggal' => \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y'),
            'jam' => $jadwal->jam,
            'nama' => $jadwal->user->name ?? '-',
            'email' => $jadwal->user->email ?? '-',
            'telpon' => $jadwal->user->nomor_telepon ?? '-',
            'fakultas' => $jadwal->user->fakultas->nama_fakultas ?? '-',
            'prodi' => $jadwal->user->prodi->nama_prodi ?? '-',
            'dosen' => $jadwal->dosen->nama_dosen ?? '-',
            'jenis_kategori' => $jadwal->jenis_kategori,
            'kategori_mooc' => $jadwal->kategori_mooc,
            'studio' => $jadwal->studio->nama_studio ?? '-',
            'mata_kuliah' => $jadwal->nama_mata_kuliah,
            'judul_course' => $jadwal->judul_course,
            'status' => $jadwal->status === 'approved' ? 'Belum Shooting' : ($jadwal->status === 'sudah shooting' ? 'Sudah Shooting' : $status),
            'status' => $jadwal->status === 'approved' ? 'Belum Shooting' : ($jadwal->status === 'sudah shooting' ? 'Sudah Shooting' : $jadwal->status),
        ]);
    }

    /**
     * Get approved jadwal events for calendar display
     */
    public function getApprovedEvents()
    {
        // Catat aktivitas: mendapatkan acara jadwal yang disetujui
        ActivityLogService::log('get_approved_events', 'Mengambil acara jadwal yang disetujui untuk tampilan kalender');

        $approvedEvents = JadwalBooking::with(['studio', 'dosen'])
            ->whereIn('status', ['approved', 'schedule'])
            ->get()
            ->map(function ($jadwal) {
                $jamRange = explode('-', $jadwal->jam);
                $jamMulai = isset($jamRange[0]) ? trim(str_replace(['WIB', '.', ' '], ['', ':', ''], $jamRange[0])) : '00:00';
                $jamSelesai = isset($jamRange[1]) ? trim(str_replace(['WIB', '.', ' '], ['', ':', ''], $jamRange[1])) : '00:00';

                if (strlen($jamMulai) == 5) $jamMulai .= ':00';
                if (strlen($jamSelesai) == 5) $jamSelesai .= ':00';

                return [
                    'id' => $jadwal->id,
                    'title' => $jadwal->judul_course . ' - ' . $jadwal->studio->nama_studio,
                    'start' => $jadwal->tanggal . 'T' . $jamMulai,
                    'end' => $jadwal->tanggal . 'T' . $jamSelesai,
                    'description' => $jadwal->nama_mata_kuliah . ' - ' . ($jadwal->dosen->nama_dosen ?? 'Tidak ada dosen'),
                    'color' => $jadwal->jenis_kategori === 'Mooc'
                        ? '#4ade80'
                        : ($jadwal->jenis_kategori === 'Lomba'
                            ? '#facc15'
                            : '#fb923c'),
                    'allDay' => false,
                    'extendedProps' => [
                        'studio' => $jadwal->studio->nama_studio,
                        'mata_kuliah' => $jadwal->nama_mata_kuliah,
                        'dosen' => $jadwal->dosen->nama_dosen ?? '-',
                        'jam' => $jadwal->jam,
                        'jenis' => $jadwal->jenis_kategori,
                        'status' => $jadwal->status,
                    ]
                ];
            });

        return response()->json($approvedEvents);
    }
}

