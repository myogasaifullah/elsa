<?php

namespace App\Policies;

use App\Models\JadwalBooking;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JadwalBookingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // All authenticated users can view jadwal
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, JadwalBooking $jadwalBooking): bool
    {
        return true; // All authenticated users can view individual jadwal
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can create jadwal
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, JadwalBooking $jadwalBooking): bool
    {
        // Admin can update all, others can only update their own
        return $user->role === 'Admin' || $user->id === $jadwalBooking->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, JadwalBooking $jadwalBooking): bool
    {
        // Admin can delete all, others can only delete their own
        return $user->role === 'Admin' || $user->id === $jadwalBooking->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, JadwalBooking $jadwalBooking): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, JadwalBooking $jadwalBooking): bool
    {
        return false;
    }
}
