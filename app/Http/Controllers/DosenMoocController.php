<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mooc;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;
use App\Services\ActivityLogService;

class DosenMoocController extends Controller
{
    public function index()
    {
        $dosens = Dosen::with(['fakultas', 'prodi'])->get();
        $moocs = Mooc::with('dosen')->get();
        $fakultas = Fakultas::all();
        $prodis = Prodi::all();
        
        // Log aktivitas akses halaman dosen dan mooc
        ActivityLogService::log('view', 'Mengakses halaman manajemen dosen dan MOOC');
        
        return view('akademik.dosen-mooc', compact('dosens', 'moocs', 'fakultas', 'prodis'));
    }

    public function storeDosen(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required|string|max:255',
            'nuptk_dosen' => 'required|string|unique:dosens,nuptk_dosen',
            'target_video_dosen' => 'required|integer',
            'status_dosen' => 'required|in:tetap,tidak_tetap',
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id' => 'required|exists:prodis,id',
        ]);

        $dosen = Dosen::create($request->all());

        // Log aktivitas tambah dosen
        ActivityLogService::create('Dosen', "Menambahkan dosen baru: {$dosen->nama_dosen} (NUPTK: {$dosen->nuptk_dosen})");

        return response()->json(['success' => 'Dosen berhasil ditambahkan']);
    }

    public function updateDosen(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nama_dosen' => 'required|string|max:255',
            'nuptk_dosen' => 'required|string|unique:dosens,nuptk_dosen,' . $dosen->id,
            'target_video_dosen' => 'required|integer',
            'status_dosen' => 'required|in:tetap,tidak_tetap',
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id' => 'required|exists:prodis,id',
        ]);

        $dosen->update($request->all());

        // Log aktivitas update dosen
        ActivityLogService::update('Dosen', "Memperbarui data dosen: {$dosen->nama_dosen} (ID: {$dosen->id})");

        return response()->json(['success' => 'Dosen berhasil diperbarui']);
    }

    public function destroyDosen(Dosen $dosen)
    {
        $namaDosen = $dosen->nama_dosen;
        $dosenId = $dosen->id;
        $dosen->delete();

        // Log aktivitas hapus dosen
        ActivityLogService::delete('Dosen', "Menghapus dosen: {$namaDosen} (ID: {$dosenId})");

        return response()->json(['success' => 'Dosen berhasil dihapus']);
    }

    public function storeMooc(Request $request)
    {
        $request->validate([
            'judul_mooc' => 'required|string|max:255',
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        $mooc = Mooc::create($request->all());
        $dosen = Dosen::find($request->dosen_id);

        // Log aktivitas tambah MOOC
        ActivityLogService::create('MOOC', "Menambahkan MOOC baru: {$mooc->judul_mooc} untuk dosen {$dosen->nama_dosen}");

        return response()->json(['success' => 'MOOC berhasil ditambahkan']);
    }

    public function updateMooc(Request $request, Mooc $mooc)
    {
        $request->validate([
            'judul_mooc' => 'required|string|max:255',
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        $mooc->update($request->all());
        $dosen = Dosen::find($request->dosen_id);

        // Log aktivitas update MOOC
        ActivityLogService::update('MOOC', "Memperbarui MOOC: {$mooc->judul_mooc} untuk dosen {$dosen->nama_dosen} (ID: {$mooc->id})");

        return response()->json(['success' => 'MOOC berhasil diperbarui']);
    }

    public function destroyMooc(Mooc $mooc)
    {
        $judulMooc = $mooc->judul_mooc;
        $moocId = $mooc->id;
        $dosen = Dosen::find($mooc->dosen_id);
        $mooc->delete();

        // Log aktivitas hapus MOOC
        ActivityLogService::delete('MOOC', "Menghapus MOOC: {$judulMooc} untuk dosen {$dosen->nama_dosen} (ID: {$moocId})");

        return response()->json(['success' => 'MOOC berhasil dihapus']);
    }
}
