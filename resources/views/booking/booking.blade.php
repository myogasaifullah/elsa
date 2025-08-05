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
            @foreach($jadwals as $index => $jadwal)
            <tr data-id="{{ $jadwal->id }}">
              <th>{{ $index + 1 }}</th>
              <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}</td>
              <td>{{ $jadwal->jam }}</td>
              <td>{{ $jadwal->user->name ?? '-' }}</td>
              <td>{{ $jadwal->user->email ?? '-' }}</td>
              <td>{{ $jadwal->user->nomor_telepon ?? '-' }}</td>
              <td>{{ $jadwal->user->fakultas->nama_fakultas ?? '-' }}</td>
              <td>{{ $jadwal->user->prodi->nama_prodi ?? '-' }}</td>
              <td>{{ $jadwal->dosen->nama_dosen ?? '-' }}</td>
              <td>{{ $jadwal->jenis_kategori }}</td>
              <td>{{ $jadwal->kategori_mooc }}</td>
              <td>{{ $jadwal->studio->nama_studio ?? '-' }}</td>
              <td>{{ $jadwal->nama_mata_kuliah }}</td>
              <td>{{ $jadwal->judul_course }}</td>
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
            @endforeach
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
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Tandai',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            const row = btn.closest("tr");
            const jadwalId = row.getAttribute('data-id');
            fetch(`/jadwal/${jadwalId}/done`, {
              method: 'POST',
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
              },
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                const statusCell = row.querySelector("td:nth-child(15)");
                statusCell.innerHTML = `<span class="badge bg-success text-white"><i class="bi bi-camera-video me-1"></i> Sudah Shooting</span>`;
                btn.parentElement.innerHTML = `<span class="text-success"><i class="bi bi-check-circle"></i> Selesai</span>`;
                Swal.fire('Sukses!', data.message, 'success');
              } else {
                Swal.fire('Gagal!', data.message, 'error');
              }
            })
            .catch(error => {
              Swal.fire('Gagal!', 'Terjadi kesalahan saat mengubah status.', 'error');
            });
          }
        });
      });
    });
  });
</script>

@include('layout.footer')
