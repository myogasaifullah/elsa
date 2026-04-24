# TODO - Fix Export PDF MOOC Portrait

## Informasi yang Ditemukan

- Controller: `app/Http/Controllers/LaporanController.php`
    - Method `exportMoocPdf()` saat ini menggunakan `setPaper('a4', 'landscape')`
- View PDF: `resources/views/exports/mooc.blade.php`
    - Saat ini menampilkan data secara horizontal (per fakultas sebagai kolom berdampingan), tidak cocok untuk portrait dan tidak sesuai tampilan halaman web
- View Web: `resources/views/laporan/mooc.blade.php`
    - Menampilkan data secara vertikal per fakultas dengan tabel terpisah (No, Nama Dosen, Kategori Mooc, Judul Course, Tautan Video)

## Rencana Perubahan (hanya export PDF)

1. **Ubah orientasi kertas** di `LaporanController.php` dari `landscape` menjadi `portrait`
2. **Redesain layout blade export** `resources/views/exports/mooc.blade.php` agar menyerupai tampilan view web:
    - Setiap fakultas sebagai section terpisah dengan judul
    - Tabel vertikal per fakultas dengan kolom: No, Nama Dosen, Kategori Mooc, Judul Course, Tautan Video
    - CSS yang sesuai untuk kertas portrait A4

## File yang akan diedit

- [x] `app/Http/Controllers/LaporanController.php`
- [x] `resources/views/exports/mooc.blade.php`
