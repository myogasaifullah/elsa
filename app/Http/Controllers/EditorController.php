<?php

namespace App\Http\Controllers;

use App\Models\Editor;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function index()
    {
        // Catat aktivitas: melihat daftar editor
        ActivityLogService::log('lihat_editor', 'Melihat daftar semua editor');
        
        $editors = Editor::all();
        return view('user.verifikasi', compact('editors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:editors,email',
        ]);

        $editor = Editor::create($request->all());
        
        // Catat aktivitas: menambahkan editor baru
        ActivityLogService::create('editor', "Menambahkan editor baru: {$editor->nama} ({$editor->email})");

        return redirect()->back()->with('success', 'Editor berhasil ditambahkan.');
    }

    public function update(Request $request, Editor $editor)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:editors,email,' . $editor->id,
        ]);

        $oldData = "Nama: {$editor->nama}, Email: {$editor->email}";
        $editor->update($request->only('nama', 'email'));
        $newData = "Nama: {$request->nama}, Email: {$request->email}";
        
        // Catat aktivitas: memperbarui data editor
        ActivityLogService::update('editor', "Memperbarui data editor ID {$editor->id}. Data lama: {$oldData} -> Data baru: {$newData}");

        return response()->json(['success' => true]);
    }

    public function destroy(Editor $editor)
    {
        $editorInfo = "{$editor->nama} ({$editor->email})";
        $editor->delete();
        
        // Catat aktivitas: menghapus editor
        ActivityLogService::delete('editor', "Menghapus editor: {$editorInfo}");

        return response()->json(['success' => true]);
    }
}
