<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\JadwalBooking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of pending bookings for approval.
     */
    public function acc()
    {
        // Fetch bookings with status 'pending' and eager load related data
        $bookings = JadwalBooking::with(['user', 'studio', 'dosen'])
            ->where('status', 'pending')
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->get();

        return view('booking.acc', compact('bookings'));
    }

    /**
     * Approve a booking.
     */
    public function approve(Request $request, JadwalBooking $booking)
    {
        $booking->update(['status' => 'approved']);

        return redirect()->route('booking.acc')
            ->with('success', 'Booking berhasil disetujui.');
    }

    /**
     * Reject a booking.
     */
    public function reject(Request $request, JadwalBooking $booking)
    {
        $booking->update(['status' => 'rejected']);

        return redirect()->route('booking.acc')
            ->with('success', 'Booking berhasil ditolak.');
    }

    /**
     * Mark a booking as done and create progress entry
     */
    public function done(Request $request, JadwalBooking $jadwal)
    {
        try {
            // Create progress entry with the jadwal_booking_id
            $progress = \App\Models\Progress::create([
                'jadwal_booking_id' => $jadwal->id,
                'target_upload' => now()->addDays(7),
                'persentase' => 0.00,
                'progres' => 'belum',
                'keterangan' => 'belum terbit',
                'durasi' => null,
                'tanggal_upload_youtube' => null,
                'editor_id' => 1,
            ]);

            // Update booking status
            $jadwal->update(['status' => 'completed']);

            return redirect()->back()->with('success', 'Booking marked as done and progress entry created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to mark booking as done: ' . $e->getMessage());
        }
    }
    
}
