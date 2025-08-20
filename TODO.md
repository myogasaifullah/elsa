# TODO List - Tambah Field Status Dosen dan CRUD View

## Progress Tracker
- [x] 1. Buat migration baru untuk field status dosen
- [x] 2. Update model Dosen untuk menambahkan field baru ke fillable
- [x] 3. Update controller untuk validasi field status dosen
- [ ] 4. Update view untuk menambahkan field status dosen di tabel dan form
- [ ] 5. Jalankan migration untuk update database
- [ ] 6. Test CRUD functionality
- [ ] 7. Verify data integrity

## Detail Task
### Migration
- [x] File: `2025_08_08_100000_add_status_to_dosens_table.php`
- [x] Field: `status_dosen` (enum: 'tetap', 'tidak_tetap')

### Model Update
- [x] File: `app/Models/Dosen.php`
- [x] Added: `status_dosen` to fillable array

### Controller Update
- [x] File: `app/Http/Controllers/DosenMoocController.php`
- [x] Added validation for `status_dosen` field

### View Update (Next)
- [ ] File: `resources/views/akademik/dosen-mooc.blade.php`
- [ ] Add status column in table
- [ ] Add status dropdown in form

### Testing
- [ ] Run migration: `php artisan migrate`
- [ ] Test CRUD operations
- [ ] Verify data integrity
