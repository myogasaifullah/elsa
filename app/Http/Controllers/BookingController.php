<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\JadwalBooking;
use Illuminate\Http\Request;
use App\Services\ActivityLogService;

class BookingController extends Controller
{
    /**
     * Display a listing of pending bookings for approval.
     */
    public function acc()
    {
        // Log activity
        ActivityLogService::booking('view_pending', 'Admin viewed pending bookings list');
        
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

        // Log activity
        $description = "Approved booking ID {$booking->id} for {$booking->user->name} - Studio {$booking->studio->nama_studio} on {$booking->tanggal} at {$booking->jam}";
        ActivityLogService::approval('approve', $description);

        return redirect()->route('booking.acc')
            ->with('success', 'Booking berhasil disetujui.');
    }

    /**
     * Reject a booking.
     */
    public function reject(Request $request, JadwalBooking $booking)
    {
        $booking->update(['status' => 'rejected']);

        // Log activity
        $description = "Rejected booking ID {$booking->id} for {$booking->user->name} - Studio {$booking->studio->nama_studio} on {$booking->tanggal} at {$booking->jam}";
        ActivityLogService::approval('reject', $description);

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
                'editor_id' => null,
            ]);

            // Update booking status
            $jadwal->update(['status' => 'completed']);

            // Log activity
            $description = "Marked booking ID {$jadwal->id} as done for {$jadwal->user->name} - Studio {$jadwal->studio->nama_studio} and created progress entry ID {$progress->id}";
            ActivityLogService::booking('complete', $description);
            ActivityLogService::progress('create', "Created progress entry ID {$progress->id} for booking ID {$jadwal->id}");

            return redirect()->back()->with('success', 'Booking marked as done and progress entry created successfully.');
        } catch (\Exception $e) {
            // Log error activity
            ActivityLogService::log('error', "Failed to mark booking ID {$jadwal->id} as done: " . $e->getMessage());
            
            return redirect()->back()->with('error', 'Failed to mark booking as done: ' . $e->getMessage());
        }
    }
}
