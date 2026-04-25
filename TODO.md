# TODO: Group Laporan Dosen & Progres by Fakultas + Export

## Steps

- [x] 1. Understand current code structure (controller, views, models)
- [x] 2. Update `LaporanController::dosen()` to group data by fakultas
- [x] 3. Update `resources/views/laporan/dosen.blade.php` to show tables per fakultas
- [x] 4. Update `LaporanController::progres()` to group data by fakultas
- [x] 5. Update `resources/views/laporan/progres.blade.php` to show tables per fakultas
- [x] 6. Update `LaporanController::index()` to support grouped data in combined report page
- [x] 7. Update `resources/views/laporan.blade.php` to pass grouped variables to includes
- [x] 8. Update `resources/views/exports/rekap.blade.php` for grouped PDF/Excel export
- [x] 9. Update `resources/views/exports/fakultas.blade.php` for grouped PDF/Excel export
- [x] 10. Update `app/Exports/FakultasExport.php` to accept groupedByFakultas
- [x] 11. Update `LaporanController::exportFakultasPdf()` to compute groupedByFakultas
- [x] 12. Update `LaporanController::exportFakultasExcel()` to compute groupedByFakultas
- [x] 13. Syntax validation passed for all modified files

