# Fix Jadwal PDF Export

## Steps
- [x] 1. Update `app/Http/Controllers/LaporanController.php`
  - Refactor `jadwal()` to query JadwalBooking directly via `getFilteredJadwal()`
  - Expand `getFilteredJadwal()` to support jenis_kategori, year, month, and studio name filters
- [x] 2. Update `app/Exports/JadwalExport.php`
  - Sync `getFilteredJadwal()` with the controller logic
- [x] 3. Rewrite `resources/views/laporan/jadwal.blade.php`
  - Change filter form to `method="GET"`
  - Rename inputs to match backend keys (`jadwal_dosen`, `jadwal_studio`, `jadwal_jenis_kategori`, `jadwal_year`, `jadwal_month`)
  - Replace client-side PDF/Excel buttons with anchor tags to backend export routes
  - Remove DataTables scripts, CSS, and custom export JavaScript

