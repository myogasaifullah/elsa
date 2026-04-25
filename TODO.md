# TODO: Fix ACC Booking Status to "approved"

## Plan

1. [x] `app/Http/Controllers/BookingController.php` - Change `approve()` to set `status = 'approved'` instead of `'belum shooting'`
2. [x] `app/Http/Controllers/LaporanController.php` - Update `dosen()` to count `'approved'` instead of `'belum shooting'`
3. [x] `resources/views/exports/rekap.blade.php` - Update status check from `'belum shooting'` to `'approved'`
4. [x] `app/Http/Controllers/JadwalBookingController.php` - Remove duplicate buggy `'status'` line in `show()`
5. [x] `resources/views/booking/booking.blade.php` - Make status badge dynamic based on actual model status
6. [x] Clear view cache and test
