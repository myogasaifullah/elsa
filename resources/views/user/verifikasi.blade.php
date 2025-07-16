@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

 <main id="main" class="main">

    <div class="pagetitle">
      <h1>Verifikasi user</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
          <li class="breadcrumb-item">User</li>
          <li class="breadcrumb-item active">Verifikasi User</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

     <div class="col-12">
  <div class="card recent-sales overflow-auto">

    <div class="card-body">
      <h5 class="card-title">Verifikasi Pengguna <span>| Status: Pending</span></h5>

      <table class="table table-borderless datatable">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Fakultas</th>
            <th scope="col">Prodi</th>
            <th scope="col">No Telp</th>
            <th scope="col">Role</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>rafid21</td>
            <td>rafid@example.com</td>
            <td>FTIK</td>
            <td>Informatika</td>
            <td>089653920595</td>
            <td>Editor</td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td>
              <button class="btn btn-sm btn-success btn-verifikasi">Verifikasi</button>
<button class="btn btn-sm btn-danger btn-tolak">Tolak</button>

            </td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>nabila_dsn</td>
            <td>nabila@example.com</td>
            <td>FTIK</td>
            <td>Sistem Informasi</td>
            <td>089653920595</td>
            <td>Editor</td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td>
              <button class="btn btn-sm btn-success btn-verifikasi">Verifikasi</button>
<button class="btn btn-sm btn-danger btn-tolak">Tolak</button>

            </td>
          </tr>
        
          <!-- Tambahkan baris lainnya sesuai data -->
        </tbody>
      </table>

    </div>

  </div>
</div>

  </main><!-- End #main -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-verifikasi').forEach(btn => {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        Swal.fire({
          title: 'Verifikasi Pengguna?',
          text: 'Pengguna akan diubah menjadi aktif.',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Ya, Verifikasi',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            // Kirim form / AJAX di sini
            Swal.fire('Berhasil!', 'Pengguna telah diverifikasi.', 'success');
          }
        });
      });
    });

    document.querySelectorAll('.btn-tolak').forEach(btn => {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        Swal.fire({
          title: 'Tolak Pengguna?',
          text: 'Pengguna akan ditolak dan tidak bisa login.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Tolak',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            // Kirim form / AJAX di sini
            Swal.fire('Ditolak!', 'Pengguna telah ditolak.', 'error');
          }
        });
      });
    });
  });
</script>


@include('layout.footer')