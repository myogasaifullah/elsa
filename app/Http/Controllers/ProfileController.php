<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $fakultas = Fakultas::all();
        $prodis = Prodi::all();
        return view('profile', [
            'user' => $request->user(),
            'fakultas' => $fakultas,
            'prodis' => $prodis,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        ActivityLogService::log('profile_update', 'User memperbarui informasi profile');

        $request->validate([
            'name' => 'required|string|max:255',
            'nomor_telepon' => 'nullable|string|max:20',
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id' => 'required|exists:prodis,id',
            'role' => 'required|string|in:Mahasiswa,Dosen,Admin',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user()->id,
        ]);

        $user = $request->user();
        $user->update([
            'name' => $request->name,
            'nomor_telepon' => $request->nomor_telepon,
            'fakultas_id' => $request->fakultas_id,
            'prodi_id' => $request->prodi_id,
            'role' => $request->role,
            'email' => $request->email,
        ]);

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
            'newpassword' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();
        $user->password = bcrypt($request->input('newpassword'));
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'password-updated');
    }
}
