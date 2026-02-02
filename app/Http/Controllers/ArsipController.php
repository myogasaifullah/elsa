<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;
use App\Models\JadwalBooking;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\Editor;
use Illuminate\Support\Facades\DB;

class ArsipController extends Controller
{
    public function index()
    {
        // Get all progress data for DataTables client-side processing
        $progress = Progress::with([
            'jadwalBooking.dosen.fakultas',
            'jadwalBooking.dosen.prodi',
            'jadwalBooking.studio',
            'editor'
        ])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('arsip', compact('progress'));
    }

    public function create()
    {
        $jadwalBookings = JadwalBooking::with('dosen')->get();
        $editors = Editor::all();

        return view('arsip.create', compact('jadwalBookings', 'editors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dosen_id' => 'nullable|exists:dosens,id',
            'fakultas_id' => 'nullable|exists:fakultas,id',
            'prodi_id' => 'nullable|exists:prodis,id',
            'mata_kuliah_id' => 'nullable|exists:mata_kuliahs,id',
            'judul_course' => 'nullable|string|max:255',
            'kategori_mooc' => 'nullable|string|max:255',
            'studio_id' => 'nullable|exists:studios,id',
            'tanggal_shooting' => 'nullable|date',
            'jam_mulai' => 'nullable',
            'jam_selesai' => 'nullable',
            'jenis_kategori' => 'nullable|string|max:255',
            'target_upload' => 'nullable|date',
            'persentase' => 'nullable|numeric|min:0|max:100',
            'progres' => 'nullable|in:belum,progres,selesai',
            'keterangan' => 'nullable|in:belum terbit,sudah terbit',
            'durasi' => 'nullable|integer|min:0',
            'tanggal_upload_youtube' => 'nullable|date',
            'publish_link_youtube' => 'nullable|url',
            'editor_id' => 'nullable|exists:editors,id',
        ]);

        DB::transaction(function () use ($request) {
            // Ambil data dari ID yang dipilih (nullable)
            $dosen = $request->dosen_id ? \App\Models\Dosen::find($request->dosen_id) : null;
            $fakultas = $request->fakultas_id ? \App\Models\Fakultas::find($request->fakultas_id) : null;
            $prodi = $request->prodi_id ? \App\Models\Prodi::find($request->prodi_id) : null;
            $mataKuliah = $request->mata_kuliah_id ? \App\Models\MataKuliah::find($request->mata_kuliah_id) : null;
            $studio = $request->studio_id ? \App\Models\Studio::find($request->studio_id) : null;
            $editor = $request->editor_id ? \App\Models\Editor::find($request->editor_id) : null;

            // Cari atau buat User (untuk relasi dengan fakultas dan prodi) jika dosen ada
            $user = null;
            if ($dosen) {
                $user = \App\Models\User::firstOrCreate(
                    ['name' => $dosen->nama_dosen],
                    [
                        'name' => $dosen->nama_dosen,
                        'email' => strtolower(str_replace(' ', '.', $dosen->nama_dosen)) . '@example.com',
                        'password' => bcrypt('password'),
                        'fakultas_id' => $fakultas ? $fakultas->id : null,
                        'prodi_id' => $prodi ? $prodi->id : null,
                    ]
                );
            }

            // Buat Jadwal Booking
            $jadwalBooking = \App\Models\JadwalBooking::create([
                'tanggal' => $request->tanggal_shooting,
                'jam' => $request->jam_mulai && $request->jam_selesai ? $request->jam_mulai . ' - ' . $request->jam_selesai : null,
                'jenis_kategori' => $request->jenis_kategori,
                'kategori_mooc' => $request->kategori_mooc,
                'nama_mata_kuliah' => $mataKuliah ? $mataKuliah->nama_mata_kuliah : $request->judul_course,
                'judul_course' => $request->judul_course,
                'status' => 'approved',
                'user_id' => $user ? $user->id : null,
                'dosen_id' => $dosen ? $dosen->id : null,
                'studio_id' => $studio ? $studio->id : null,
            ]);

            // Buat Progress
            Progress::create([
                'jadwal_booking_id' => $jadwalBooking->id,
                'target_upload' => $request->target_upload,
                'persentase' => $request->persentase,
                'progres' => $request->progres,
                'keterangan' => $request->keterangan,
                'durasi' => $request->durasi,
                'tanggal_upload_youtube' => $request->tanggal_upload_youtube,
                'publish_link_youtube' => $request->publish_link_youtube,
                'editor_id' => $editor ? $editor->id : null,
            ]);
        });

        return redirect()->route('arsip.index')->with('success', 'Data arsip berhasil ditambahkan.');
    }
}
