# TODO: Tambah Field Status (Sudah Shooting/Belum Shooting) di Import Arsip

## Rencana (gunakan kolom `status` yang sudah ada di tabel `jadwal_bookings`)

- [x]   1. Update `app/Imports/ArsipImport.php`
    - Tambahkan validasi `status` di `rules()`
    - Gunakan nilai `status` dari Excel saat membuat `JadwalBooking` (fallback: `belum shooting`)
- [x]   2. Update `app/Http/Controllers/ArsipController.php`
    - Tambahkan validasi `status` di `store()` dan `update()`
    - Sertakan `status` saat create/update `JadwalBooking`
- [x]   3. Update `resources/views/action_arsip.blade.php`
    - Tambahkan dropdown `status` di modal Tambah Arsip
    - Tambahkan penjelasan kolom `status` di info format import Excel
- [x]   4. Update `resources/views/arsip.blade.php`
    - Tampilkan status dinamis dari `$item->jadwalBooking->status`
    - Tambahkan filter dropdown "Status Shooting"
    - Tambahkan field `status` di modal Edit Arsip
