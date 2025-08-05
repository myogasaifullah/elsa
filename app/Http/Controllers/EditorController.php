<?php

namespace App\Http\Controllers;

use App\Models\Editor;
use Illuminate\Http\Request;

class EditorController extends Controller
{
public function index()
{
    $editors = Editor::all();
    return view('user.verifikasi', compact('editors'));
}


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:editors,email',
        ]);

        Editor::create($request->all());

        return redirect()->back()->with('success', 'Editor berhasil ditambahkan.');
    }

    public function update(Request $request, Editor $editor)
{
    $request->validate([
        'nama' => 'required|string',
        'email' => 'required|email|unique:editors,email,' . $editor->id,
    ]);

    $editor->update($request->only('nama', 'email'));

    return response()->json(['success' => true]);
}

public function destroy(Editor $editor)
{
    $editor->delete();
    return response()->json(['success' => true]);
}

}
