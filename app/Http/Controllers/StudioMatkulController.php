<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use App\Models\GambarStudio;
use App\Models\MataKuliah;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\ActivityLogService;

class StudioMatkulController extends Controller
{
    public function index()
    {
        $studios = Studio::with('gambarStudio')->get();
        $mataKuliah = MataKuliah::with(['fakultas', 'prodi'])->get();
        $fakultas = Fakultas::all();
        $prodis = Prodi::all();
        
        return view('akademik.studio-matkul', compact('studios', 'mataKuliah', 'fakultas', 'prodis'));
    }

    public function storeStudio(Request $request)
    {
        $request->validate([
            'nama_studio' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'gambar' => 'nullable|array',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $studio = Studio::create([
            'nama_studio' => $request->nama_studio,
            'lokasi' => $request->lokasi,
        ]);

        // Handle upload gambar
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $gambar) {
                $path = $gambar->store('studio_images', 'public');
                GambarStudio::create([
                    'studio_id' => $studio->id,
                    'path' => $path,
                ]);
            }
        }

        return response()->json(['success' => 'Studio berhasil ditambahkan.']);
    }

    public function updateStudio(Request $request, $id)
    {
        $request->validate([
            'nama_studio' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'gambar' => 'nullable|array',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $studio = Studio::findOrFail($id);
        $studio->update([
            'nama_studio' => $request->nama_studio,
            'lokasi' => $request->lokasi,
        ]);

        // Handle upload gambar baru
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $gambar) {
                $path = $gambar->store('studio_images', 'public');
                GambarStudio::create([
                    'studio_id' => $studio->id,
                    'path' => $path,
                ]);
            }
        }

        ActivityLogService::update('Studio', "Memperbarui studio: {$studio->nama_studio}");

        return response()->json(['success' => 'Studio berhasil diperbarui.']);
    }

    public function destroyStudio($id)
    {
        $studio = Studio::findOrFail($id);
        
        // Hapus gambar terkait
        foreach ($studio->gambarStudio as $gambar) {
            Storage::disk('public')->delete($gambar->path);
            $gambar->delete();
        }
        
        $studio->delete();

        return response()->json(['success' => 'Studio berhasil dihapus.']);
    }

    public function storeMataKuliah(Request $request)
    {
        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id' => 'required|exists:prodis,id',
            'nama_mata_kuliah' => 'required|string|max:255',
        ]);

        MataKuliah::create($request->all());

        return response()->json(['success' => 'Mata kuliah berhasil ditambahkan.']);
    }

    public function updateMataKuliah(Request $request, $id)
    {
        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id' => 'required|exists:prodis,id',
            'nama_mata_kuliah' => 'required|string|max:255',
        ]);

        $mataKuliah = MataKuliah::findOrFail($id);
        $mataKuliah->update($request->all());

        return response()->json(['success' => 'Mata kuliah berhasil diperbarui.']);
    }

    public function destroyMataKuliah($id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        $mataKuliah->delete();

        return response()->json(['success' => 'Mata kuliah berhasil dihapus.']);
    }
    
    public function destroyGambarStudio($id)
    {
        try {
            $gambarStudio = GambarStudio::findOrFail($id);
            Storage::disk('public')->delete($gambarStudio->path);
            $gambarStudio->delete();

            return response()->json(['success' => 'Gambar berhasil dihapus.'])->setStatusCode(200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus gambar: ' . $e->getMessage()])->setStatusCode(500);
        }
    }
}
