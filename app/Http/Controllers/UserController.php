<?php

namespace App\Http\Controllers;

use App\Models\Editor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\ActivityLogService;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    //     public function editor()
    // {
    //     $editors = Editor::all();
    //     return view('user.verifikasi', compact('editors'));
    // }

    public function index()
    {
        $users = User::with(['fakultas', 'prodi'])->get();
        $fakultas = \App\Models\Fakultas::all();
        $prodis = \App\Models\Prodi::all();
        $editors = Editor::all();

        return view('user', compact('users', 'fakultas', 'prodis', 'editors'));
    }

    /**
     * Display a listing of pending users for verification.
     *
     * @return \Illuminate\View\View
     */
    public function verifikasi()
    {
        Log::info('UserController@verifikasi called');
        $pendingUsers = User::with(['fakultas', 'prodi'])
            ->where('status', 'pending')
            ->get();
        Log::info('Pending users count', ['count' => $pendingUsers->count()]);
        Log::info('Pending users', $pendingUsers->toArray());
        $fakultas = \App\Models\Fakultas::all();
        $prodis = \App\Models\Prodi::all();
        $editors = Editor::all();
        return view('user.verifikasi', compact('pendingUsers', 'fakultas', 'prodis', 'editors'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // This would be used for the create modal
        // For now, we'll handle this in the frontend
        return view('user.listuser');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'nomor_telepon' => 'nullable|string|max:20',
            'fakultas_id' => 'nullable|exists:fakultas,id',
            'prodi_id' => 'nullable|exists:prodis,id',
            'role' => 'required|string|in:Mahasiswa,Dosen,Admin,Editor',
            'status' => 'required|string|in:active,pending,rejected',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'fakultas_id' => $request->fakultas_id,
            'prodi_id' => $request->prodi_id,
            'role' => $request->role,
            'status' => $request->status,
            'password' => bcrypt($request->password),
        ]);

        // Auto create Editor if role is Editor
        if ($request->role === 'Editor') {
            Editor::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'email' => $user->email,
            ]);
            ActivityLogService::create('Editor', "Menambahkan editor otomatis dari tambah user: {$user->name} ({$user->email})");
        }

        // Log aktivitas create user
        ActivityLogService::create('User', "Menambahkan user baru: {$user->name}");

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        // For showing individual user details if needed
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        // For the edit modal
        return view('user.listuser', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $userId)
    {
        try {
            // Find the user by ID
            $user = User::findOrFail($userId);

            // Debugging
            Log::info('UserController@update called', [
                'user_id' => $user->id,
                'request_data' => $request->all(),
                'request_method' => $request->method(),
                'content_type' => $request->header('Content-Type'),
                'all_headers' => $request->headers->all()
            ]);

            // Validation rules
            try {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|max:255|unique:users,email,' . $user->id,
                    'nomor_telepon' => 'nullable|string|max:20',
                    'fakultas_id' => 'nullable|exists:fakultas,id',
                    'prodi_id' => 'nullable|exists:prodis,id',
                    'role' => 'required|string|in:Mahasiswa,Dosen,Admin,Editor',
                    'status' => 'required|string|in:active,pending,rejected',
                    'password' => 'nullable|string|min:8',
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                Log::error('Validation failed', [
                    'user_id' => $user->id,
                    'errors' => $e->errors(),
                    'request_data' => $request->all()
                ]);

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Validation failed',
                        'errors' => $e->errors()
                    ], 422);
                }
                throw $e;
            }

            // Update user data
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'nomor_telepon' => $request->nomor_telepon,
                'fakultas_id' => $request->fakultas_id,
                'prodi_id' => $request->prodi_id,
                'role' => $request->role,
                'status' => $request->status,
            ];

            // Only update password if provided
            if ($request->filled('password')) {
                $userData['password'] = bcrypt($request->password);
            }

            Log::info('User data to update', [
                'user_id' => $user->id,
                'userData' => $userData
            ]);

            $user->update($userData);

            // Debugging
            Log::info('User updated successfully', [
                'user_id' => $user->id,
                'updated_data' => $userData,
                'user_after_update' => $user->fresh()->toArray()
            ]);

            // Return JSON response for AJAX requests
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'User updated successfully.',
                    'user' => $user->fresh()
                ]);
            }

            return redirect()->route('user.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            Log::error('User update failed', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while updating the user',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->route('user.index')->with('error', 'An error occurred while updating the user.');
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,rejected',
        ]);

        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        if ($request->status === 'active') {
            Editor::firstOrCreate(
                ['email' => $user->email],
                ['nama' => $user->name]
            );
            ActivityLogService::create('Editor', "Menambahkan editor otomatis dari verifikasi user: {$user->name} ({$user->email})");
            return redirect()->route('user.verifikasi')->with('success', 'Status pengguna berhasil diperbarui dan ditambahkan sebagai editor.');
        }

        Log::info('Status pengguna diperbarui', [
            'user_id' => $id,
            'status_baru' => $request->status,
        ]);

        return redirect()->route('user.verifikasi')->with('success', 'Status pengguna berhasil diperbarui.');
    }

    /**
     * Get user data for AJAX request.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserData(User $user)
    {
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'nomor_telepon' => $user->nomor_telepon,
            'fakultas_id' => $user->fakultas_id,
            'prodi_id' => $user->prodi_id,
            'role' => $user->role,
            'status' => $user->status,
        ]);
    }

    /**
     * Display a listing of progress data.
     * For admin: show all progress data.
     * For dosen: show progress data filtered by logged-in dosen's name.
     *
     * @return \Illuminate\View\View
     */
    public function dosenIndex()
    {
        $user = auth()->user();
        $query = \App\Models\Progress::with([
            'jadwalBooking.dosen',
            'jadwalBooking.user.fakultas',
            'jadwalBooking.user.prodi',
            'jadwalBooking.studio',
            'editor'
        ]);

        // If not admin, filter by dosen's name
        if (strtolower($user->role) !== 'admin') {
            $query->whereHas('jadwalBooking.dosen', function ($query) use ($user) {
                $query->where('nama_dosen', $user->name);
            });
        }

        $progress = $query->get();

        return view('dosen', compact('progress'));
    }
}
