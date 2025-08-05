<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of pending bookings for approval.
     */
    public function acc()
    {
        // Fetch bookings with status 'pending' and eager load related data
        $bookings = Booking::with(['user', 'studio', 'mataKuliah', 'dosen'])
            ->where('status', 'pending')
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->get();

        return view('booking.acc', compact('bookings'));
    }

    /**
     * Approve a booking.
     */
    public function approve(Request $request, Booking $booking)
    {
        $booking->update(['status' => 'approved']);

        return redirect()->route('booking.acc')
            ->with('success', 'Booking berhasil disetujui.');
    }

    /**
     * Reject a booking.
     */
    public function reject(Request $request, Booking $booking)
    {
        $booking->update(['status' => 'rejected']);

        return redirect()->route('booking.acc')
            ->with('success', 'Booking berhasil ditolak.');
    }
}
