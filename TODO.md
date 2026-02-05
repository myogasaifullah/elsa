# TODO: Add Features to Bookings Data Section

## Completed Tasks

- [x] Update HomeController.php to handle query parameters for search, filter, sort, pagination, and entries per page
- [x] Modify home.blade.php to add UI elements for search, filter, sorting, entries per page, and pagination
- [x] Start Laravel development server for testing
- [x] Modify dosen-mooc.blade.php import section to accept nama_dosen, nuptk_dosen, target_video_dosen (optional), status_dosen (optional), nama_fakultas, nama_prodi
- [x] Update DosenImport.php to handle nama_fakultas and nama_prodi lookup

## Remaining Tasks

- [ ] Test search functionality (by user name, studio name, status)
- [ ] Test filter by status (pending, approved, rejected)
- [ ] Test sorting by ID and Created At (ascending/descending)
- [ ] Test pagination (navigate through pages)
- [ ] Test entries per page (10, 25, 50, 100)
- [ ] Test reset functionality
- [ ] Verify UI responsiveness and Bootstrap styling
- [ ] Test dosen import with new column names (nama_fakultas, nama_prodi)
