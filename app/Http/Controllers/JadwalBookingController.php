<?php

namespace App\Http\Controllers;

use App\Models\JadwalBooking;
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
        return view('jadwal', compact('jadwals', 'moocs', 'mataKuliahs', 'dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'jam' => 'required|string',
            'jenis_kategori' => 'required|string',
            'kategori_mooc' => 'nullable|string',
            'studio' => 'required|string',
            'nama_mata_kuliah' => 'required|string|max:255',
            'judul_course' => 'required|string|max:255',
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        JadwalBooking::create([
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'jenis_kategori' => $request->jenis_kategori,
            'kategori_mooc' => $request->kategori_mooc,
            'studio' => $request->studio,
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
}
