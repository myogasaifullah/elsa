@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Booking Jadwal</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
        <li class="breadcrumb-item">Booking</li>
        <li class="breadcrumb-item active">Jadwal</li>
      </ol>
    </nav>
  </div>

  <div class="card p-3">
    <div class="calendar-wrapper">
      <!-- Sidebar -->
      <div class="calendar-sidebar">
        <!-- Mini Calendar -->
        <div class="card mb-3">
          <div class="mini-calendar" id="mini-calendar"></div>
        </div>

        <!-- Filter -->
        <div class="card p-3">
          <h6 class="mb-2">Event Filters</h6>
          <div class="event-filters">
            <label><input type="checkbox" checked /> Semua</label>
            <label><input type="checkbox" checked style="accent-color: red;" /> MOOC</label>
            <label><input type="checkbox" checked style="accent-color: green;" /> Pembelajaran</label>
            <label><input type="checkbox" checked style="accent-color: orange;" /> Lomba</label>
          </div>
        </div>
      </div>

      <!-- Main Calendar -->
      <div class="calendar-content">
        <div id="calendar"></div>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="card recent-sales overflow-auto">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Booking <span>| Jadwal</span></h5>
          <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahJadwal">
            <i class="bi bi-plus-circle"></i> Tambah Jadwal
          </button>
        </div>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Jam</th>
              <th scope="col">Nama</th>
              <th scope="col">Email</th>
              <th scope="col">Telpon</th>
              <th scope="col">Fakultas</th>
              <th scope="col">Prodi</th>
              <th scope="col">Jenis Kategori</th>
              <th scope="col">Dosen</th>
              <th scope="col">Kategori MOOC</th>
              <th scope="col">Studio</th>
              <th scope="col">Mata Kuliah</th>
              <th scope="col">Judul Course</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>31/05/03</td>
              <td>12.00</td>
              <td>Yosa</td>
              <td>yosa@gmail.com</td>
              <td>089643920595</td>
              <td>FTIK</td>
              <td>IF</td>
              <td>Lomba</td>
              <td>Dr. Andi Maulana</td>
              <td>MOOC Mandiri</td>
              <td>Studio 1</td>
              <td>Pemrograman</td>
              <td>Methamorz</td>
              <td>
                <span class="badge bg-warning text-dark">
                  <i class="bi bi-hourglass-split me-1"></i> Pending
                </span>
              </td>
              <td>
                <button class="btn btn-sm btn-primary btn-editJadwal" data-bs-toggle="modal" data-bs-target="#modalEditjadwal">Edit</button>
                <button class="btn btn-sm btn-danger btn-hapusJadwal">Hapus</button>
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>01/06/03</td>
              <td>09.00</td>
              <td>Putri</td>
              <td>putri@gmail.com</td>
              <td>082199887766</td>
              <td>FTIK</td>
              <td>TS</td>
              <td>Mooc</td>
              <td>Dr. Andi Maulana</td>
              <td>MOOC Mandiri</td>
              <td>Studio 2</td>
              <td>Sistem Informasi</td>
              <td>Methamorz</td>
              <td>
                <span class="badge bg-success">
                  <i class="bi bi-calendar-check me-1"></i> Schedule
                </span>
              </td>
              <td>
                <button class="btn btn-sm btn-primary btn-editJadwal" data-bs-toggle="modal" data-bs-target="#modalEditjadwal">Edit</button>
                <button class="btn btn-sm btn-danger btn-hapusJadwal">Hapus</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modalTambahjadwal" tabindex="-1" aria-labelledby="modalTambahJadwalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="formTambahJadwal">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Jadwal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Tanggal</label>
              <input type="date" class="form-control" id="tanggal">
            </div>
            <div class="mb-3">
              <label class="form-label">Jam</label>
              <select class="form-select" id="jam">
                <option selected disabled>Pilih Jam</option>
                <option value="09.00 WIB - 11.00 WIB">09.00 WIB - 11.00 WIB</option>
                <option value="11.00 WIB - 13.00 WIB">11.00 WIB - 13.00 WIB</option>
                <option value="13.00 WIB - 15.00 WIB">13.00 WIB - 15.00 WIB</option>
                <option value="15.00 WIB - 17.00 WIB">15.00 WIB - 17.00 WIB</option>
                <option value="17.00 WIB - 19.00 WIB">17.00 WIB - 19.00 WIB</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Jenis Kategori</label>
              <select class="form-select" id="jenisKategori">
                <option selected disabled>Pilih Kategori</option>
                <option value="Mooc">Mooc</option>
                <option value="Lomba">Lomba</option>
                <option value="Pembelajaran">Pembelajaran</option>
              </select>
            </div>
            <div class="mb-3 d-none" id="kategoriMoocGroup">
              <label class="form-label">Kategori MOOC</label>
              <select class="form-select" id="kategoriMooc">
                <option selected disabled>Pilih Kategori MOOC</option>
                <option value="MOOC Nasional">MOOC Nasional</option>
                <option value="MOOC Mandiri">MOOC Mandiri</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Studio</label>
              <select class="form-select" id="studio">
                <option selected disabled>Pilih Studio</option>
                <option value="1">Studio 1</option>
                <option value="2">Studio 2</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Nama Mata Kuliah</label>
              <input type="text" class="form-control" id="namaJadwal" placeholder="Contoh: Pemrograman Web">
            </div>
            <div class="mb-3">
              <label class="form-label">Judul Course</label>
              <input type="text" class="form-control" id="judul">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalEditJadwal" tabindex="-1" aria-labelledby="modalEditJadwalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="formEditJadwal">
          <div class="modal-header">
            <h5 class="modal-title">Edit Jadwal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="editJadwalId">
            <div class="mb-3">
              <label class="form-label">Tanggal</label>
              <input type="date" class="form-control" id="editTanggal">
            </div>
            <div class="mb-3">
              <label class="form-label">Jam</label>
              <select class="form-select" id="editJam">
                <option selected disabled>Pilih Jam</option>
                <option value="09.00 WIB - 11.00 WIB">09.00 WIB - 11.00 WIB</option>
                <option value="11.00 WIB - 13.00 WIB">11.00 WIB - 13.00 WIB</option>
                <option value="13.00 WIB - 15.00 WIB">13.00 WIB - 15.00 WIB</option>
                <option value="15.00 WIB - 17.00 WIB">15.00 WIB - 17.00 WIB</option>
                <option value="17.00 WIB - 19.00 WIB">17.00 WIB - 19.00 WIB</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Jenis Kategori</label>
              <select class="form-select" id="editJenisKategori">
                <option selected disabled>Pilih Kategori</option>
                <option value="Mooc">Mooc</option>
                <option value="Lomba">Lomba</option>
                <option value="Pembelajaran">Pembelajaran</option>
              </select>
            </div>
            <div class="mb-3 d-none" id="editKategoriMoocGroup">
              <label class="form-label">Kategori MOOC</label>
              <select class="form-select" id="editKategoriMooc">
                <option selected disabled>Pilih Kategori MOOC</option>
                <option value="MOOC Nasional">MOOC Nasional</option>
                <option value="MOOC Mandiri">MOOC Mandiri</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Studio</label>
              <select class="form-select" id="editStudio">
                <option selected disabled>Pilih Studio</option>
                <option value="1">Studio 1</option>
                <option value="2">Studio 2</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Nama Mata Kuliah</label>
              <input type="text" class="form-control" id="editNamaJadwal" placeholder="Contoh: Pemrograman Web">
            </div>
            <div class="mb-3">
              <label class="form-label">Judul Course</label>
              <input type="text" class="form-control" id="editJudul">
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</main>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const jenisKategori = document.getElementById('jenisKategori');
    const kategoriMoocGroup = document.getElementById('kategoriMoocGroup');

    const editJenisKategori = document.getElementById('editJenisKategori');
    const editKategoriMoocGroup = document.getElementById('editKategoriMoocGroup');

    // Tambah Jadwal
    jenisKategori.addEventListener('change', function() {
      if (this.value === 'Mooc') {
        kategoriMoocGroup.classList.remove('d-none');
      } else {
        kategoriMoocGroup.classList.add('d-none');
      }
    });

    // Edit Jadwal
    editJenisKategori.addEventListener('change', function() {
      if (this.value === 'Mooc') {
        editKategoriMoocGroup.classList.remove('d-none');
      } else {
        editKategoriMoocGroup.classList.add('d-none');
      }
    });
  });
</script>


@include('layout.footer')



<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Tombol Edit
    document.querySelectorAll('.btn-editJadwal').forEach(btn => {
      btn.addEventListener('click', function() {
        // Simulasi isi data ke modal edit
        document.getElementById('editFakultasJadwal').value = 'FTIK';
        document.getElementById('editProdiJadwal').value = 'IF';
        document.getElementById('editNamaJadwal').value = 'Algoritma dan Pemrograman';
        new bootstrap.Modal(document.getElementById('modalEditJadwal')).show();
      });
    });

    // Tombol Hapus
    document.querySelectorAll('.btn-hapusJadwal').forEach(btn => {
      btn.addEventListener('click', function() {
        Swal.fire({
          title: 'Hapus Booking?',
          text: 'Data Booking akan dihapus permanen.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire('Dihapus!', 'Data Booking telah dihapus.', 'success');
            // Tambahkan logika hapus di sini (AJAX atau hapus baris)
          }
        });
      });
    });
  });
</script>

<!-- ======================== FullCalendar & Datepicker CDN ======================== -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.4/dist/css/datepicker.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.4/dist/js/datepicker-full.min.js"></script>

<!-- ======================== Style (bisa pindahkan ke CSS file utama) ======================== -->

<style>
  .calendar-wrapper {
    display: flex;
    gap: 24px;
  }

  .calendar-sidebar {
    width: 260px;
  }

  .calendar-content {
    width: 900px;
    /* ubah sesuai kebutuhan */
  }

  .event-filters label {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
    gap: 8px;
  }

  .event-filters input[type="checkbox"] {
    transform: scale(1.2);
  }

  .fc {
    background: white;
    padding: 16px;
    border-radius: 12px;
  }

  .mini-calendar {
    padding: 8px 10px;
  }

  .add-event-btn {
    width: 100%;
    margin-bottom: 16px;
    font-weight: 500;
  }
</style>

<!-- ======================== Init Script ======================== -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi FullCalendar
    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 530, // atur tinggi kalender
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        events: [{
            title: 'Booking Studio 1',
            start: '2025-07-20T09:00:00',
            color: '#4ade80'
          },
          {
            title: 'Pembelajaran Multimedia',
            start: '2025-07-22T13:00:00',
            end: '2025-07-22T15:00:00',
            color: '#facc15'
          },
          {
            title: 'Lomba Nasional',
            start: '2025-07-25',
            color: '#fb923c'
          }
        ]
      });

      calendar.render();
    }

    // Inisialisasi Mini Calendar
    const miniCal = document.getElementById('mini-calendar');
    if (miniCal) {
      new Datepicker(miniCal, {
        calendarInline: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
      });
    }
  });
</script>