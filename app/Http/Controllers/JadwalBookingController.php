<?php

namespace App\Http\Controllers;

use App\Models\JadwalBooking;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Add this line
use Illuminate\Support\Facades\Auth;


class JadwalBookingController extends Controller
{
    public function index()
    {
        $jadwals = JadwalBooking::with(['user.fakultas', 'user.prodi', 'dosen'])->latest()->get();
        $moocs = \App\Models\Mooc::all();
        $mataKuliahs = \App\Models\MataKuliah::all();
        $dosens = \App\Models\Dosen::all();
        $studios = Studio::all();

        return view('jadwal', compact('jadwals', 'moocs', 'mataKuliahs', 'dosens', 'studios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'jam' => 'required|string',
            'jenis_kategori' => 'required|string',
            'kategori_mooc' => 'nullable|string',
            'studio_id' => 'required|exists:studios,id', // Changed from 'studio' string
            'nama_mata_kuliah' => 'required|string|max:255',
            'judul_course' => 'required|string|max:255',
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        JadwalBooking::create([
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'jenis_kategori' => $request->jenis_kategori,
            'kategori_mooc' => $request->kategori_mooc,
            'studio_id' => $request->studio_id, // Changed from 'studio' string
            'nama_mata_kuliah' => $request->nama_mata_kuliah,
            'judul_course' => $request->judul_course,
            'user_id' => Auth::id(),
            'dosen_id' => $request->dosen_id,
            'status' => 'pending'
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }


    public function update(Request $request, JadwalBooking $jadwal)
    {
        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'jam' => 'required|string',
            'jenis_kategori' => 'required|string',
            'kategori_mooc' => 'nullable|string',
            'studio_id' => 'required|exists:studios,id',
            'nama_mata_kuliah' => 'required|string|max:255',
            'judul_course' => 'required|string|max:255',
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        $jadwal->update([
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'jenis_kategori' => $request->jenis_kategori,
            'kategori_mooc' => $request->kategori_mooc,
            'studio_id' => $request->studio_id,
            'nama_mata_kuliah' => $request->nama_mata_kuliah,
            'judul_course' => $request->judul_course,
            'dosen_id' => $request->dosen_id,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy(JadwalBooking $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }

    /**
     * Display approved bookings
     */
    public function scheduledBookings()
    {
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

            // Create progress entry with the jadwal_booking_id
            $progress = \App\Models\Progress::create([
                'jadwal_booking_id' => $jadwal->id,
                'target_upload' => now()->addDays(7), // Default target upload in 7 days
                'persentase' => 0.00,
                'progres' => 'belum',
                'keterangan' => 'belum terbit',
                'durasi' => null,
                'tanggal_upload_youtube' => null,
                'editor_id' => null, // Default editor, can be updated later
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil ditandai sebagai sudah shooting dan progress berhasil dibuat.'
            ]);
        } catch (\Exception $e) {
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
                'target_upload' => now()->addDays(7), // Default target upload in 7 days
                'persentase' => 0.00,
                'progres' => 'belum',
                'keterangan' => 'belum terbit',
                'durasi' => null,
                'tanggal_upload_youtube' => null,
                'editor_id' => null, // Default editor, can be updated later
            ]);

            // Update the jadwal status to completed
            $jadwal->update(['status' => 'completed']);

            return redirect()->back()->with('success', 'Booking marked as done and progress entry created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to mark booking as done: ' . $e->getMessage());
        }
    }

    /**
     * Get approved jadwal events for calendar display
     */
    public function getApprovedEvents()
{
    $approvedEvents = JadwalBooking::with(['studio', 'dosen'])
        ->whereIn('status', ['approved', 'schedule'])
        ->get()
        ->map(function ($jadwal) {
            // Ambil jam mulai & selesai dari format "15.00 WIB - 17.00 WIB"
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
