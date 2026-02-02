<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Prodi;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FakultasImport;
use App\Imports\ProdiImport;

class FakultasProdiController extends Controller
{
    // Fakultas CRUD

    public function index()
    {
        // Catat aktivitas: melihat halaman fakultas dan prodi
        ActivityLogService::log('lihat_fakultas_prodi', 'Melihat daftar fakultas dan program studi');

        $fakultas = Fakultas::all();
        $prodis = Prodi::with('fakultas')->get();
        return view('akademik.fakultas-prodi', compact('fakultas', 'prodis'));
    }

    public function storeFakultas(Request $request)
    {
        $request->validate([
            'nama_fakultas' => 'required|string|max:255',
            'kode_fakultas' => 'nullable|string|max:50',
            'singkatan' => 'nullable|string|max:50',
        ]);

        $fakultas = Fakultas::create($request->only('nama_fakultas', 'kode_fakultas', 'singkatan'));

        // Catat aktivitas: menambahkan fakultas baru
        ActivityLogService::create('fakultas', "Menambahkan fakultas baru: {$fakultas->nama_fakultas} ({$fakultas->kode_fakultas})");

        return redirect()->back()->with('success', 'Fakultas berhasil ditambahkan.');
    }

    public function updateFakultas(Request $request, $id)
    {
        $request->validate([
            'nama_fakultas' => 'required|string|max:255',
            'kode_fakultas' => 'nullable|string|max:50',
            'singkatan' => 'nullable|string|max:50',
        ]);

        $fakultas = Fakultas::findOrFail($id);
        $oldData = "Nama: {$fakultas->nama_fakultas}, Kode: {$fakultas->kode_fakultas}, Singkatan: {$fakultas->singkatan}";
        $fakultas->update($request->only('nama_fakultas', 'kode_fakultas', 'singkatan'));
        $newData = "Nama: {$request->nama_fakultas}, Kode: {$request->kode_fakultas}, Singkatan: {$request->singkatan}";

        // Catat aktivitas: memperbarui fakultas
        ActivityLogService::update('fakultas', "Memperbarui fakultas ID {$id}. Data lama: {$oldData} -> Data baru: {$newData}");

        return redirect()->back()->with('success', 'Fakultas berhasil diperbarui.');
    }

    public function destroyFakultas($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        $fakultasInfo = "{$fakultas->nama_fakultas} ({$fakultas->kode_fakultas})";
        $fakultas->delete();

        // Catat aktivitas: menghapus fakultas
        ActivityLogService::delete('fakultas', "Menghapus fakultas: {$fakultasInfo}");

        return redirect()->back()->with('success', 'Fakultas berhasil dihapus.');
    }

    public function importFakultas(Request $request)
    {
        \Log::info('Import Fakultas: Starting import process');

        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        \Log::info('Import Fakultas: File validated', ['file' => $request->file('file')->getClientOriginalName()]);

        try {
            $import = new FakultasImport();
            Excel::import($import, $request->file('file'));

            \Log::info('Import Fakultas: Import completed successfully');

            // Catat aktivitas: import fakultas
            ActivityLogService::create('fakultas', 'Import data fakultas dari file Excel');

            return redirect()->back()->with('success', 'Data fakultas berhasil diimpor.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = 'Row ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }
            \Log::error('Import Fakultas: Validation error', ['errors' => $errorMessages]);
            return redirect()->back()->with('error', 'Kesalahan validasi data: ' . implode('; ', $errorMessages));
        } catch (\Exception $e) {
            \Log::error('Import Fakultas: General error', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }

    public function importProdi(Request $request)
    {
        \Log::info('Import Prodi: Starting import process');

        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        \Log::info('Import Prodi: File validated', ['file' => $request->file('file')->getClientOriginalName()]);

        try {
            $import = new ProdiImport();
            Excel::import($import, $request->file('file'));

            \Log::info('Import Prodi: Import completed successfully');

            // Catat aktivitas: import prodi
            ActivityLogService::create('prodi', 'Import data prodi dari file Excel');

            return redirect()->back()->with('success', 'Data prodi berhasil diimpor.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = 'Row ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }
            \Log::error('Import Prodi: Validation error', ['errors' => $errorMessages]);
            return redirect()->back()->with('error', 'Kesalahan validasi data: ' . implode('; ', $errorMessages));
        } catch (\Exception $e) {
            \Log::error('Import Prodi: General error', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }

    // Prodi CRUD

    public function storeProdi(Request $request)
    {
        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'nama_prodi' => 'required|string|max:255',
            'kode_prodi' => 'nullable|string|max:50',
            'singkatan' => 'nullable|string|max:50',
        ]);

        $prodi = Prodi::create($request->only('fakultas_id', 'nama_prodi', 'kode_prodi', 'singkatan'));
        $fakultas = Fakultas::find($request->fakultas_id);

        // Catat aktivitas: menambahkan prodi baru
        ActivityLogService::create('prodi', "Menambahkan program studi baru: {$prodi->nama_prodi} ({$prodi->kode_prodi}) di fakultas {$fakultas->nama_fakultas}");

        return redirect()->back()->with('success', 'Program Studi berhasil ditambahkan.');
    }

    public function updateProdi(Request $request, $id)
    {
        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'nama_prodi' => 'required|string|max:255',
            'kode_prodi' => 'nullable|string|max:50',
            'singkatan' => 'nullable|string|max:50',
        ]);

        $prodi = Prodi::findOrFail($id);
        $oldData = "Nama: {$prodi->nama_prodi}, Kode: {$prodi->kode_prodi}, Singkatan: {$prodi->singkatan}, Fakultas ID: {$prodi->fakultas_id}";
        $prodi->update($request->only('fakultas_id', 'nama_prodi', 'kode_prodi', 'singkatan'));
        $newData = "Nama: {$request->nama_prodi}, Kode: {$request->kode_prodi}, Singkatan: {$request->singkatan}, Fakultas ID: {$request->fakultas_id}";

        // Catat aktivitas: memperbarui prodi
        ActivityLogService::update('prodi', "Memperbarui program studi ID {$id}. Data lama: {$oldData} -> Data baru: {$newData}");

        return redirect()->back()->with('success', 'Program Studi berhasil diperbarui.');
    }

    public function destroyProdi($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodiInfo = "{$prodi->nama_prodi} ({$prodi->kode_prodi})";
        $prodi->delete();

        // Catat aktivitas: menghapus prodi
        ActivityLogService::delete('prodi', "Menghapus program studi: {$prodiInfo}");

        return redirect()->back()->with('success', 'Program Studi berhasil dihapus.');
    }
}
