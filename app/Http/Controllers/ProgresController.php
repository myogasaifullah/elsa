<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\JadwalBooking;
use App\Models\Editor;
use Illuminate\Http\Request;

class ProgresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $progress = Progress::with([
            'jadwalBooking.dosen.fakultas',
            'jadwalBooking.dosen.prodi',
            'jadwalBooking.studio',
            'editor'
        ])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('progres', compact('progress'));
    }

    public function editor()
{
    $userId = auth()->user()->id; // Get the logged-in user's ID
    
    // Get editor_id for the logged-in user
    $editor = \App\Models\Editor::where('email', auth()->user()->email)->first();
    
    if (!$editor) {
        // If no editor record exists, return empty collection
        $progress = collect();
    } else {
        $progress = Progress::with([
            'jadwalBooking.dosen.fakultas',
            'jadwalBooking.dosen.prodi',
            'jadwalBooking.studio',
            'editor'
        ])
        ->where('editor_id', $editor->id) // Filter by editor_id
        ->orderBy('created_at', 'desc')
        ->get();
    }
    
    return view('editor', compact('progress'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jadwalBookings = JadwalBooking::all();
        $editors = Editor::all();
        
        return view('progres.create', compact('jadwalBookings', 'editors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jadwal_booking_id' => 'required|exists:jadwal_bookings,id',
            'target_upload' => 'nullable|date',
            'persentase' => 'nullable|numeric|min:0|max:100',
            'progres' => 'required|in:belum,progres,selesai',
            'keterangan' => 'required|in:sudah terbit,belum terbit',
            'durasi' => 'nullable|integer|min:0',
            'tanggal_upload_youtube' => 'nullable|date',
            'editor_id' => 'required|exists:editors,id',
        ]);

        Progress::create($validated);

        return redirect()->route('progres.index')
            ->with('success', 'Progress berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Progress $progress)
    {
        return view('progres.show', compact('progress'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Progress $progress)
    {
        $jadwalBookings = JadwalBooking::all();
        $editors = Editor::all();
        
        return view('progres.edit', compact('progress', 'jadwalBookings', 'editors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Progress $progress)
    {
        $validated = $request->validate([
            'jadwal_booking_id' => 'required|exists:jadwal_bookings,id',
            'target_upload' => 'nullable|date',
            'persentase' => 'nullable|numeric|min:0|max:100',
            'progres' => 'required|in:belum,progres,selesai',
            'keterangan' => 'required|in:sudah terbit,belum terbit',
            'durasi' => 'nullable|integer|min:0',
            'tanggal_upload_youtube' => 'nullable|date',
            'editor_id' => 'required|exists:editors,id',
        ]);

        $progress->update($validated);

        return redirect()->route('progres.index')
            ->with('success', 'Progress berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Progress $progress)
    {
        $progress->delete();

        return redirect()->route('progres.index')
            ->with('success', 'Progress berhasil dihapus');
    }

    /**
     * Display data based on jadwal_booking_id
     */
    public function showByJadwal($jadwal_booking_id)
    {
        $jadwalBookings = JadwalBooking::with(['booking.dosen.fakultas', 'booking.dosen.prodi', 'booking.mataKuliah', 'booking.studio'])
            ->where('id', $jadwal_booking_id)
            ->get();

        return view('progres-detail', compact('jadwalBookings'));
    }

    /**
     * Display modal view for progress
     */
    public function modal($id)
    {
        $progress = Progress::with([
            'jadwalBooking.dosen.fakultas',
            'jadwalBooking.dosen.prodi',
            'jadwalBooking.studio',
            'editor'
        ])->findOrFail($id);

        // Ambil data persentase terkait progress ini
        $existingPersentase = \App\Models\Persentase::where('id_progres', $progress->id)->first();

        return view('modal_progres', compact('progress', 'existingPersentase'));
    }

    /**
     * Assign the current logged-in user as editor for a progress
     */
    public function assignEditor(Request $request, Progress $progress)
    {
        try {
            // Get or create editor for current user
            $user = auth()->user();
            $editor = Editor::firstOrCreate(
                ['email' => $user->email],
                ['nama' => $user->name ?? $user->email]
            );

            // Update the progress with the editor
            $progress->update(['editor_id' => $editor->id]);

            return response()->json([
                'success' => true,
                'message' => 'Editor berhasil ditambahkan',
                'editor_name' => $editor->nama
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan editor: ' . $e->getMessage()
            ], 500);
        }
    }
}
