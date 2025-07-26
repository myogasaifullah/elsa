@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Acc Booking</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
        <li class="breadcrumb-item">Booking</li>
        <li class="breadcrumb-item active">Acc</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="col-12">
    <div class="card recent-sales overflow-auto">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Booking <span>| Jadwal</span></h5>
        </div>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>Tanggal</th>
              <th>Jam</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Telpon</th>
              <th>Fakultas</th>
              <th>Prodi</th>
              <th>Dosen</th>
              <th>Jenis Kategori</th>
              <th>Kategori MOOC</th>
              <th>Studio</th>
              <th>Mata Kuliah</th>
              <th>Judul Course</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Data Booking -->
            <tr>
              <th>1</th>
              <td>18/07/2025</td>
              <td>10.00</td>
              <td>Dina</td>
              <td>dina@example.com</td>
              <td>081234567890</td>
              <td>FTIK</td>
              <td>Informatika</td>
              <td>Dr. Andi Maulana</td>
              <td>Mooc</td>
              <td>MOOC Mandiri</td>
              <td>Studio 1</td>
              <td>Jaringan Komputer</td>
              <td>Methamorz</td>
              <td>
                <span class="badge bg-secondary text-white">
                  <i class="bi bi-camera-video-off me-1"></i> Belum Shooting
                </span>
              </td>
              <td>
                <button class="btn btn-sm btn-primary btn-done">
                  <i class="bi bi-check2-square"></i> Done
                </button>
              </td>
            </tr>
            <!-- Tambah data jika perlu -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

</main>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-done').forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
          title: 'Tandai Sudah Shooting?',
          text: 'Status akan diubah menjadi sudah shooting.',
          icon: 'success',
          showCancelButton: true,
          confirmButtonText: 'Ya, Tandai',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            const row = btn.closest("tr");
            const statusCell = row.querySelector("td:nth-child(15)");
            statusCell.innerHTML = `<span class="badge bg-success text-white"><i class="bi bi-camera-video me-1"></i> Sudah Shooting</span>`;
            btn.parentElement.innerHTML = `<span class="text-success"><i class="bi bi-check-circle"></i> Selesai</span>`;
            Swal.fire('Sukses!', 'Status telah diperbarui.', 'success');
          }
        });
      });
    });
  });
</script>

@include('layout.footer')
