<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;

class FakultasProdiController extends Controller
{
    // Fakultas CRUD

    public function index()
    {
        $fakultas = Fakultas::all();
        $prodis = Prodi::with('fakultas')->get();
        return view('akademik.fakultas-prodi', compact('fakultas', 'prodis'));
    }

    public function storeFakultas(Request $request)
    {
        $request->validate([
            'nama_fakultas' => 'required|string|max:255',
            'singkatan' => 'nullable|string|max:50',
        ]);

        Fakultas::create($request->only('nama_fakultas', 'singkatan'));

        return redirect()->back()->with('success', 'Fakultas berhasil ditambahkan.');
    }

    public function updateFakultas(Request $request, $id)
    {
        $request->validate([
            'nama_fakultas' => 'required|string|max:255',
            'singkatan' => 'nullable|string|max:50',
        ]);

        $fakultas = Fakultas::findOrFail($id);
        $fakultas->update($request->only('nama_fakultas', 'singkatan'));

        return redirect()->back()->with('success', 'Fakultas berhasil diperbarui.');
    }

    public function destroyFakultas($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        $fakultas->delete();

        return redirect()->back()->with('success', 'Fakultas berhasil dihapus.');
    }

    // Prodi CRUD

    public function storeProdi(Request $request)
    {
        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'nama_prodi' => 'required|string|max:255',
            'singkatan' => 'nullable|string|max:50',
        ]);

        Prodi::create($request->only('fakultas_id', 'nama_prodi', 'singkatan'));

        return redirect()->back()->with('success', 'Program Studi berhasil ditambahkan.');
    }

    public function updateProdi(Request $request, $id)
    {
        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'nama_prodi' => 'required|string|max:255',
            'singkatan' => 'nullable|string|max:50',
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->update($request->only('fakultas_id', 'nama_prodi', 'singkatan'));

        return redirect()->back()->with('success', 'Program Studi berhasil diperbarui.');
    }

    public function destroyProdi($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        return redirect()->back()->with('success', 'Program Studi berhasil dihapus.');
    }
}
