<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

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
    Log::info('Request masuk:', $request->all());

    $request->validate([
        'name' => 'required|string|max:255',
        'nomor_telepon' => 'nullable|string|max:20',
        'fakultas_id' => 'nullable|exists:fakultas,id',
        'prodi_id' => 'nullable|exists:prodi,id',
        'role' => 'nullable|string',
    ]);

    $user = $request->user();

    Log::info('User lama:', $user->toArray());

    $user->update([
        'name' => $request->name,
        'nomor_telepon' => $request->nomor_telepon,
        'fakultas_id' => $request->fakultas_id,
        'prodi_id' => $request->prodi_id,
        'role' => $request->role,
    ]);

    Log::info('User baru:', $user->fresh()->toArray());

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
