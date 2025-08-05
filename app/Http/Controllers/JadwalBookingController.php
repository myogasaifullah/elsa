<?php

namespace App\Http\Controllers;

use App\Models\JadwalBooking;
use App\Models\Studio;
use Illuminate\Http\Request;
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

        return view('jadwal', compact('jadwals', 'moocs', 'mataKuliahs', 'dosens','studios'));
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
            'studio' => 'required|string',
            'nama_mata_kuliah' => 'required|string|max:255',
            'judul_course' => 'required|string|max:255',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy(JadwalBooking $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }

    /**
     * Mark a booking as done and create progress entry
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
                'editor_id' => 1, // Default editor, can be updated later
            ]);

            // Update the jadwal status to completed
            $jadwal->update(['status' => 'completed']);

            return redirect()->back()->with('success', 'Booking marked as done and progress entry created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to mark booking as done: ' . $e->getMessage());
        }
    }
}
