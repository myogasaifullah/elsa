@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Data Fakultas & Program Studi </h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
        <li class="breadcrumb-item">Akademik</li>
        <li class="breadcrumb-item active">Fakultas-Prodi</li>
      </ol>
    </nav>
  </div>

  <div class="col-12">
    <div class="card recent-sales overflow-auto">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Daftar Fakultas <span>| Universitas</span></h5>
          <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahFakultas">
            <i class="bi bi-plus-circle"></i> Tambah Fakultas
          </button>
        </div>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Fakultas</th>
              <th>Singkatan</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($fakultas as $index => $f)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $f->nama_fakultas }}</td>
              <td>{{ $f->singkatan }}</td>
              <td>
                <button type="button" class="btn btn-sm btn-primary btn-edit"
                  data-id="{{ $f->id }}"
                  data-nama="{{ $f->nama_fakultas }}"
                  data-singkatan="{{ $f->singkatan }}">
                  Edit
                </button>
                <form action="{{ route('fakultas.destroy', $f->id) }}" method="POST" class="form-hapus-fakultas d-inline">
  @csrf
  @method('DELETE')
  <button type="button" class="btn btn-sm btn-danger btn-hapusfakultas">Hapus</button>
</form>

              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="card recent-sales overflow-auto">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Daftar Prodi <span>| Universitas</span></h5>
          <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahProdi">
            <i class="bi bi-plus-circle"></i> Tambah Prodi
          </button>
        </div>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Fakultas</th>
              <th>Nama Prodi</th>
              <th>Singkatan</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($prodis as $index => $p)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $p->fakultas->nama_fakultas }}</td>
              <td>{{ $p->nama_prodi }}</td>
              <td>{{ $p->singkatan }}</td>
              <td>
                <button type="button" class="btn btn-sm btn-primary btn-edit-prodi"
                  data-id="{{ $p->id }}"
                  data-nama="{{ $p->nama_prodi }}"
                  data-singkatan="{{ $p->singkatan }}"
                  data-fakultas="{{ $p->fakultas_id }}">
                  Edit
                </button>
               <form action="{{ route('prodi.destroy', $p->id) }}" method="POST" class="form-hapus-prodi d-inline">
  @csrf
  @method('DELETE')
  <button type="button" class="btn btn-sm btn-danger btn-hapusprodi">Hapus</button>
</form>

              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>

  @include('akademik.modal-fakultas')
  @include('akademik.modal-prodi')
</main>

@include('layout.footer')

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Konfirmasi hapus Fakultas
    document.querySelectorAll('.btn-hapusfakultas').forEach(button => {
      button.addEventListener('click', function (e) {
        const form = button.closest('.form-hapus-fakultas');
        Swal.fire({
          title: 'Hapus Fakultas?',
          text: 'Data Fakultas akan dihapus secara permanen.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    });

    // Konfirmasi hapus Prodi
    document.querySelectorAll('.btn-hapusprodi').forEach(button => {
      button.addEventListener('click', function (e) {
        const form = button.closest('.form-hapus-prodi');
        Swal.fire({
          title: 'Hapus Program Studi?',
          text: 'Data Prodi akan dihapus dari sistem.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    });
  });
</script>
