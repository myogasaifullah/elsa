<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Services\ActivityLogService;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $fakultas = Fakultas::all();
        $prodis = Prodi::all();
        
        ActivityLogService::log('view', 'Melihat halaman registrasi user baru');
        
        return view('auth.register', compact('fakultas', 'prodis'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'fakultas_id' => ['nullable', 'exists:fakultas,id'],
            'prodi_id' => ['nullable', 'exists:prodis,id'],
            'role' => ['required', 'string', 'in:Mahasiswa,Dosen,Editor'],
            'nomor_telepon' => ['nullable', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'fakultas_id' => $request->fakultas_id,
            'prodi_id' => $request->prodi_id,
            'role' => $request->role,
            'nomor_telepon' => $request->nomor_telepon,
            'status' => $request->role === 'Editor' ? 'pending' : 'active',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
