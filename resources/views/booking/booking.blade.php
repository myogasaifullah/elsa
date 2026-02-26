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
  </div>

  <div class="col-12">
    <div class="card recent-sales overflow-auto">
      <div class="card-body">
        <h5 class="card-title">Booking <span>| Jadwal</span></h5>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>Tanggal</th>
              <th>Jam</th>
              <th>Nama Dosen</th>
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
            <tr
              data-id="{{ $jadwal->id }}"
              data-nama="{{ $jadwal->user->name ?? '-' }}"
              data-email="{{ $jadwal->user->email ?? '-' }}"
              data-telpon="{{ $jadwal->user->nomor_telepon ?? '-' }}"
              data-fakultas="{{ $jadwal->user->fakultas->nama_fakultas ?? '-' }}"
              data-prodi="{{ $jadwal->user->prodi->nama_prodi ?? '-' }}"
              data-dosen="{{ $jadwal->dosen->nama_dosen ?? '-' }}">
              <th>{{ $index + 1 }}</th>
              <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}</td>
              <td>{{ $jadwal->jam }}</td>
              <td>{{ $jadwal->dosen->nama_dosen ?? '-' }}</td>
              <td>{{ $jadwal->jenis_kategori }}</td>
              <td>{{ $jadwal->kategori_mooc }}</td>
              <td>{{ $jadwal->studio->nama_studio ?? '-' }}</td>
              <td>{{ $jadwal->nama_mata_kuliah }}</td>
              <td>{{ $jadwal->judul_course }}</td>
              <td class="status-cell">
                <span class="badge bg-secondary text-white">
                  <i class="bi bi-camera-video-off me-1"></i> Belum Shooting
                </span>
              </td>
              <td>
                <button class="btn btn-sm btn-info btn-detail" data-toggle="modal" data-target="#detailModal">
                  <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-sm btn-primary btn-done">
                  <i class="bi bi-check2-square"></i>
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

{{-- SCRIPT --}}
<script>
  document.addEventListener('DOMContentLoaded', function() {

    // DONE BUTTON - Using event delegation for dynamic content
    document.addEventListener('click', function(e) {
      if (e.target.classList.contains('btn-done') || e.target.closest('.btn-done')) {
        const btn = e.target.classList.contains('btn-done') ? e.target : e.target.closest('.btn-done');
        const row = btn.closest('tr');
        const jadwalId = row.dataset.id;

        Swal.fire({
          title: 'Tandai Sudah Shooting?',
          text: 'Status akan diubah menjadi sudah shooting.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Tandai',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            fetch(`/jadwal/${jadwalId}/done`, {
                method: 'POST',
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  'Content-Type': 'application/json'
                }
              })
              .then(res => res.json())
              .then(data => {
                if (data.success) {
                  row.querySelector('.status-cell').innerHTML =
                    `<span class="badge bg-success text-white">
                  <i class="bi bi-camera-video me-1"></i> Sudah Shooting
                </span>`;

                  btn.parentElement.innerHTML =
                    `<span class="text-success">
                  <i class="bi bi-check-circle"></i> Selesai
                </span>`;

                  Swal.fire('Sukses!', data.message, 'success');
                } else {
                  Swal.fire('Gagal!', data.message, 'error');
                }
              })
              .catch(() => {
                Swal.fire('Gagal!', 'Terjadi kesalahan.', 'error');
              });
          }
        });
      }
    });

    // DETAIL MODAL - Using event delegation for dynamic content
    document.addEventListener('click', function(e) {
      if (e.target.classList.contains('btn-detail') || e.target.closest('.btn-detail')) {
        const btn = e.target.classList.contains('btn-detail') ? e.target : e.target.closest('.btn-detail');
        const row = btn.closest('tr');
        const cells = row.children;

        document.getElementById('modal-tanggal').textContent = cells[1].textContent;
        document.getElementById('modal-jam').textContent = cells[2].textContent;
        document.getElementById('modal-nama').textContent = row.dataset.nama;
        document.getElementById('modal-email').textContent = row.dataset.email;
        document.getElementById('modal-telpon').textContent = row.dataset.telpon;
        document.getElementById('modal-fakultas').textContent = row.dataset.fakultas;
        document.getElementById('modal-prodi').textContent = row.dataset.prodi;
        document.getElementById('modal-dosen').textContent = row.dataset.dosen;
        document.getElementById('modal-jenis-kategori').textContent = cells[4].textContent;
        document.getElementById('modal-kategori-mooc').textContent = cells[5].textContent;
        document.getElementById('modal-studio').textContent = cells[6].textContent;
        document.getElementById('modal-mata-kuliah').textContent = cells[7].textContent;
        document.getElementById('modal-judul-course').textContent = cells[8].textContent;
        document.getElementById('modal-status').textContent = cells[9].innerText.trim();
      }
    });

  });
</script>

{{-- MODAL DETAIL --}}
<div class="modal fade" id="detailModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Booking</h5>
        <button type="button" class="btn-close" data-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <p><strong>Tanggal:</strong> <span id="modal-tanggal"></span></p>
            <p><strong>Jam:</strong> <span id="modal-jam"></span></p>
            <p><strong>Nama:</strong> <span id="modal-nama"></span></p>
            <p><strong>Email:</strong> <span id="modal-email"></span></p>
            <p><strong>Telpon:</strong> <span id="modal-telpon"></span></p>
          </div>
          <div class="col-md-6">
            <p><strong>Fakultas:</strong> <span id="modal-fakultas"></span></p>
            <p><strong>Prodi:</strong> <span id="modal-prodi"></span></p>
            <p><strong>Dosen:</strong> <span id="modal-dosen"></span></p>
            <p><strong>Jenis Kategori:</strong> <span id="modal-jenis-kategori"></span></p>
            <p><strong>Kategori MOOC:</strong> <span id="modal-kategori-mooc"></span></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <p><strong>Studio:</strong> <span id="modal-studio"></span></p>
            <p><strong>Mata Kuliah:</strong> <span id="modal-mata-kuliah"></span></p>
          </div>
          <div class="col-md-6">
            <p><strong>Judul Course:</strong> <span id="modal-judul-course"></span></p>
            <p><strong>Status:</strong> <span id="modal-status"></span></p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@include('layout.footer')