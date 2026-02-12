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

  <!-- Flash Messages -->
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  @if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <div class="col-12">
    <div class="card recent-sales overflow-auto">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Daftar Fakultas <span>| Universitas</span></h5>
          <div>
            <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalImportFakultas">
              <i class="bi bi-upload"></i> Import Fakultas
            </button>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahFakultas">
              <i class="bi bi-plus-circle"></i> Tambah Fakultas
            </button>
          </div>
        </div>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Fakultas</th>
              <th>Kode Fakultas</th>
              <th>Singkatan</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($fakultas as $index => $f)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $f->nama_fakultas }}</td>
              <td>{{ $f->kode_fakultas }}</td>
              <td>{{ $f->singkatan }}</td>
              <td>
                <button type="button" class="btn btn-sm btn-primary btn-edit"
                  data-id="{{ $f->id }}"
                  data-nama="{{ $f->nama_fakultas }}"
                  data-kode="{{ $f->kode_fakultas }}"
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
          <div>
            <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalImportProdi">
              <i class="bi bi-upload"></i> Import Prodi
            </button>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahProdi">
              <i class="bi bi-plus-circle"></i> Tambah Prodi
            </button>
          </div>
        </div>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Fakultas</th>
              <th>Nama Prodi</th>
              <th>Kode Prodi</th>
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
              <td>{{ $p->kode_prodi }}</td>
              <td>{{ $p->singkatan }}</td>
              <td class="text-center">
                {{-- Edit --}}
                <button
                  type="button"
                  class="btn btn-sm btn-primary btn-edit-prodi"
                  title="Edit"
                  aria-label="Edit"
                  data-id="{{ $p->id }}"
                  data-nama="{{ $p->nama_prodi }}"
                  data-kode="{{ $p->kode_prodi }}"
                  data-singkatan="{{ $p->singkatan }}"
                  data-fakultas="{{ $p->fakultas_id }}">
                  <i class="bi bi-pencil-square"></i>
                </button>

                {{-- Hapus --}}
                <form
                  action="{{ route('prodi.destroy', $p->id) }}"
                  method="POST"
                  class="form-hapus-prodi d-inline">
                  @csrf
                  @method('DELETE')
                  <button
                    type="button"
                    class="btn btn-sm btn-danger btn-hapusprodi"
                    title="Hapus"
                    aria-label="Hapus">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>


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

  <!-- Modal Import Fakultas -->
  <div class="modal fade" id="modalImportFakultas" tabindex="-1" aria-labelledby="modalImportFakultasLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalImportFakultasLabel">Import Data Fakultas dari Excel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('fakultas.import') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="file" class="form-label">Pilih File Excel</label>
              <input type="file" class="form-control" id="file" name="file" accept=".xlsx,.xls,.csv" required>
              <div class="form-text">Format file: .xlsx, .xls, atau .csv. Kolom yang diperlukan: nama_fakultas (wajib), kode_fakultas (opsional), singkatan (opsional).</div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Import Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Import Prodi -->
  <div class="modal fade" id="modalImportProdi" tabindex="-1" aria-labelledby="modalImportProdiLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalImportProdiLabel">Import Data Program Studi dari Excel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('prodi.import') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="file_prodi" class="form-label">Pilih File Excel</label>
              <input type="file" class="form-control" id="file_prodi" name="file" accept=".xlsx,.xls,.csv" required>
              <div class="form-text">Format file: .xlsx, .xls, atau .csv. Kolom yang diperlukan: nama_fakultas (wajib), nama_prodi (wajib), kode_prodi (opsional), singkatan (opsional).</div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Import Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

@include('layout.footer')

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Konfirmasi hapus Fakultas - using event delegation for DataTables compatibility
    document.addEventListener('click', function(e) {
      if (e.target.classList.contains('btn-hapusfakultas')) {
        const button = e.target;
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
      }
    });

    // Konfirmasi hapus Prodi - using event delegation for DataTables compatibility
    document.addEventListener('click', function(e) {
      if (e.target.classList.contains('btn-hapusprodi')) {
        const button = e.target;
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
      }
    });
  });
</script>