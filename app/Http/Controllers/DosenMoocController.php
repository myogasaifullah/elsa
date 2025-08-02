<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mooc;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;

class DosenMoocController extends Controller
{
    public function index()
    {
        $dosens = Dosen::with(['fakultas', 'prodi'])->get();
        $moocs = Mooc::with('dosen')->get();
        $fakultas = Fakultas::all();
        $prodis = Prodi::all();
        
        return view('akademik.dosen-mooc', compact('dosens', 'moocs', 'fakultas', 'prodis'));
    }

    public function storeDosen(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required|string|max:255',
            'nuptk_dosen' => 'required|string|unique:dosens,nuptk_dosen',
            'target_video_dosen' => 'required|integer',
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id' => 'required|exists:prodis,id',
        ]);

        Dosen::create($request->all());

        return response()->json(['success' => 'Dosen berhasil ditambahkan']);
    }

    public function updateDosen(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nama_dosen' => 'required|string|max:255',
            'nuptk_dosen' => 'required|string|unique:dosens,nuptk_dosen,' . $dosen->id,
            'target_video_dosen' => 'required|integer',
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id' => 'required|exists:prodis,id',
        ]);

        $dosen->update($request->all());

        return response()->json(['success' => 'Dosen berhasil diperbarui']);
    }

    public function destroyDosen(Dosen $dosen)
    {
        $dosen->delete();

        return response()->json(['success' => 'Dosen berhasil dihapus']);
    }

    public function storeMooc(Request $request)
    {
        $request->validate([
            'judul_mooc' => 'required|string|max:255',
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        Mooc::create($request->all());

        return response()->json(['success' => 'MOOC berhasil ditambahkan']);
    }

    public function updateMooc(Request $request, Mooc $mooc)
    {
        $request->validate([
            'judul_mooc' => 'required|string|max:255',
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        $mooc->update($request->all());

        return response()->json(['success' => 'MOOC berhasil diperbarui']);
    }

    public function destroyMooc(Mooc $mooc)
    {
        $mooc->delete();

        return response()->json(['success' => 'MOOC berhasil dihapus']);
    }
}
