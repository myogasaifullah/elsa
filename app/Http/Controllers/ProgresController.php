<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\JadwalBooking;
use App\Models\Editor;
use App\Models\Persentase;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Catat aktivitas: melihat daftar progress
        ActivityLogService::log('lihat_progress', 'Melihat daftar semua progress');
        
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
        // Catat aktivitas: melihat progress editor
        ActivityLogService::log('lihat_progress_editor', 'Melihat progress untuk editor');
        
        $user = Auth::user();
        $userId = $user->id;

        // Get editor_id for the logged-in user
        $editor = Editor::where('email', $user->email)->first();

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
                ->where('editor_id', $editor->id)
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
        // Catat aktivitas: membuka form tambah progress
        ActivityLogService::log('buka_form_tambah_progress', 'Membuka form tambah progress baru');
        
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

        $progress = Progress::create($validated);
        
        // Catat aktivitas: menambahkan progress baru
        ActivityLogService::create('progress', "Menambahkan progress baru untuk jadwal booking ID {$validated['jadwal_booking_id']} dengan status {$validated['progres']}");

        return redirect()->route('progres.index')
            ->with('success', 'Progress berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Progress $progress)
    {
        // Catat aktivitas: melihat detail progress
        ActivityLogService::log('lihat_detail_progress', "Melihat detail progress ID {$progress->id}");
        
        return view('progres.show', compact('progress'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Progress $progress)
    {
        // Catat aktivitas: membuka form edit progress
        ActivityLogService::log('buka_form_edit_progress', "Membuka form edit progress ID {$progress->id}");
        
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

        $oldData = $progress->toArray();
        $progress->update($validated);
        
        // Catat aktivitas: memperbarui progress
        ActivityLogService::update('progress', "Memperbarui progress ID {$progress->id}. Data lama: " . json_encode($oldData) . " -> Data baru: " . json_encode($validated));

        return redirect()->route('progres.index')
            ->with('success', 'Progress berhasil diperbarui');
    }

    /**
     * Transfer data from persentase to progress table
     */
    public function transferToProgress(Request $request, $id)
    {
        try {
            // Find the progress record
            $progress = Progress::findOrFail($id);
            
            // Find the related persentase record
            $persentase = Persentase::where('id_progres', $id)->first();
            
            if (!$persentase) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data persentase tidak ditemukan untuk progress ini'
                ], 404);
            }
            
            // Determine progress status based on percentage
            $persentaseValue = $persentase->persentase ?? 0;
            $progresStatus = 'belum';
            
            if ($persentaseValue == 0) {
                $progresStatus = 'belum';
            } elseif ($persentaseValue == 100) {
                $progresStatus = 'selesai';
            } else {
                $progresStatus = 'progres';
            }
            
            // Determine keterangan based on YouTube link
            $keteranganStatus = 'belum terbit';
            if (!empty($persentase->publish_link_youtube)) {
                $keteranganStatus = 'sudah terbit';
            }
            
            // Update progress with data from persentase
            $updateData = [
                'persentase' => $persentaseValue,
                'target_upload' => $persentase->target_publish,
                'tanggal_upload_youtube' => $persentase->tanggal_publish,
                'durasi' => $persentase->durasi_video_menit,
                'progres' => $progresStatus,
                'keterangan' => $keteranganStatus,
            ];
            
            $progress->update($updateData);
            
            // Catat aktivitas: transfer data dari persentase ke progress
            ActivityLogService::log('transfer_data', "Mentransfer data dari persentase ke progress ID {$id}");
            
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil ditransfer dari persentase ke progress',
                'data' => $updateData
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mentransfer data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display data based on jadwal_booking_id
     */
    public function showByJadwal($jadwal_booking_id)
    {
        // Catat aktivitas: melihat progress berdasarkan jadwal booking
        ActivityLogService::log('lihat_progress_jadwal', "Melihat progress untuk jadwal booking ID {$jadwal_booking_id}");
        
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
        // Catat aktivitas: membuka modal progress
        ActivityLogService::log('buka_modal_progress', "Membuka modal progress ID {$id}");
        
        $progress = Progress::with([
            'jadwalBooking.dosen.fakultas',
            'jadwalBooking.dosen.prodi',
            'jadwalBooking.studio',
            'editor'
        ])->findOrFail($id);

        // Ambil data persentase terkait progress ini
        $existingPersentase = Persentase::where('id_progres', $progress->id)->first();

        return view('modal_progres', compact('progress', 'existingPersentase'));
    }

    /**
     * Transfer data from persentase table to progress table
     */
    public function transferFromPersentase(Request $request, $progressId)
    {
        try {
            // Find the progress record
            $progress = Progress::findOrFail($progressId);
            
            // Find the related persentase record
            $persentase = Persentase::where('id_progres', $progressId)->first();
            
            if (!$persentase) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data persentase tidak ditemukan untuk progress ini'
                ], 404);
            }
            
            // Determine progress status based on percentage
            $persentaseValue = $persentase->persentase ?? 0;
            $progresStatus = 'belum';
            
            if ($persentaseValue == 0) {
                $progresStatus = 'belum';
            } elseif ($persentaseValue == 100) {
                $progresStatus = 'selesai';
            } else {
                $progresStatus = 'progres';
            }
            
            // Determine keterangan based on YouTube link
            $keteranganStatus = 'belum terbit';
            if (!empty($persentase->publish_link_youtube)) {
                $keteranganStatus = 'sudah terbit';
            }
            
            // Update progress with data from persentase
            $updateData = [
                'persentase' => $persentaseValue,
                'target_upload' => $persentase->target_publish,
                'tanggal_upload_youtube' => $persentase->tanggal_publish,
                'durasi' => $persentase->durasi_video_menit,
                'progres' => $progresStatus,
                'keterangan' => $keteranganStatus,
            ];
            
            // Only update tautan_video if the field exists in the progress table
            if (isset($persentase->publish_link_youtube)) {
                $updateData['tautan_video'] = $persentase->publish_link_youtube;
            }
            
            $progress->update($updateData);
            
            // Catat aktivitas: transfer data dari persentase ke progress
            ActivityLogService::log('transfer_data_persentase', "Mentransfer data dari persentase ke progress ID {$progressId}");
            
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dipindahkan dari persentase ke progress',
                'data' => $updateData
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memindahkan data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Assign the current logged-in user as editor for a progress
     */
    public function assignEditor(Request $request, Progress $progress)
    {
        try {
            // Get or create editor for current user
            $user = Auth::user();
            $editor = Editor::firstOrCreate(
                ['email' => $user->email],
                ['nama' => $user->name ?? $user->email]
            );

            // Update the progress with the editor
            $progress->update(['editor_id' => $editor->id]);
            
            // Catat aktivitas: menetapkan editor untuk progress
            ActivityLogService::log('assign_editor', "Menetapkan editor {$editor->nama} untuk progress ID {$progress->id}");

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Progress $progress)
    {
        // Catat aktivitas: menghapus progress
        ActivityLogService::delete('progress', "Menghapus progress ID {$progress->id} untuk jadwal booking ID {$progress->jadwal_booking_id}");
        
        $progress->delete();

        return redirect()->route('progres.index')
            ->with('success', 'Progress berhasil dihapus');
    }
}
