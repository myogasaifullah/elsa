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
            <th>Jenis Kategori</th>
            <th>Studio</th>
            <th>Mata Kuliah</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- Data Booking Pending -->
          <tr>
            <th>1</th>
            <td>18/07/2025</td>
            <td>10.00</td>
            <td>Dina</td>
            <td>dina@example.com</td>
            <td>081234567890</td>
            <td>FTIK</td>
            <td>Informatika</td>
            <td>Mooc</td>
            <td>Studio 1</td>
            <td>Jaringan Komputer</td>
            <td>
              <span class="badge bg-warning text-dark">
                <i class="bi bi-hourglass-split me-1"></i> Pending
              </span>
            </td>
            <td>
              <div class="d-flex gap-1">
                <button class="btn btn-sm btn-success" onclick="accJadwal(this)">
                  <i class="bi bi-check-circle"></i> ACC
                </button>
                <button class="btn btn-sm btn-danger" onclick="tolakJadwal(this)">
                  <i class="bi bi-x-circle"></i> Tolak
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

</main>

<script>
  function accJadwal(button) {
    const row = button.closest("tr");
    const statusCell = row.querySelector("td:nth-child(12)");
    statusCell.innerHTML = `<span class="badge bg-success"><i class="bi bi-calendar-check me-1"></i> Schedule</span>`;
    button.parentElement.innerHTML = `<span class="text-success"><i class="bi bi-check-circle"></i> Disetujui</span>`;
  }

  function tolakJadwal(button) {
    const row = button.closest("tr");
    const statusCell = row.querySelector("td:nth-child(12)");
    statusCell.innerHTML = `<span class="badge bg-danger"><i class="bi bi-x-octagon me-1"></i> Ditolak</span>`;
    button.parentElement.innerHTML = `<span class="text-danger"><i class="bi bi-x-circle"></i> Ditolak</span>`;
  }
</script>


@include('layout.footer')