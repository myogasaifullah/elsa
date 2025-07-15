@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Data Fakultas & Program Studi </h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
        <li class="breadcrumb-item active">Fakultas-Prodi</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

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
              <th scope="col">#</th>
              <th scope="col">Nama Fakultas</th>
              <th scope="col">Singkatan</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Fakultas Teknik dan Ilmu Komputer</td>
              <td>FTIK</td>
              <td>
                <button class="btn btn-sm btn-primary btn-edit">Edit</button>
                <button class="btn btn-sm btn-danger btn-hapus">Hapus</button>
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Fakultas Ekonomi dan Bisnis</td>
              <td>FEB</td>
              <td>
                <button class="btn btn-sm btn-primary btn-edit">Edit</button>
                <button class="btn btn-sm btn-danger btn-hapus">Hapus</button>
              </td>
            </tr>
            <!-- Tambahkan data lainnya -->
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
              <th scope="col">#</th>
              <th scope="col">Nama Fakultas</th>
              <th scope="col">Nama Prodi</th>
              <th scope="col">Singkatan</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Fakultas Teknik dan Ilmu Komputer</td>
              <td>Informatika</td>
              <td>IF</td>
              <td>
                <button class="btn btn-sm btn-primary btn-editprodi">Edit</button>
                <button class="btn btn-sm btn-danger btn-hapusprodi">Hapus</button>
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Fakultas Teknik dan Ilmu Komputer</td>
              <td>Teknik Sipil</td>
              <td>TS</td>
              <td>
                <button class="btn btn-sm btn-primary btn-editprodi">Edit</button>
                <button class="btn btn-sm btn-danger btn-hapusprodi">Hapus</button>
              </td>
            </tr>
            <!-- Tambahkan data lainnya -->
          </tbody>
        </table>

      </div>
    </div>
  </div>

  <!-- Modal Tambah Fakultas -->
<div class="modal fade" id="modalTambahFakultas" tabindex="-1" aria-labelledby="modalTambahFakultasLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahFakultasLabel">Tambah Fakultas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <form id="formTambahFakultas">
          <div class="mb-3">
            <label for="namaFakultas" class="form-label">Nama Fakultas</label>
            <input type="text" class="form-control" id="namaFakultas" placeholder="Masukkan nama fakultas">
          </div>
          <div class="mb-3">
            <label for="singkatanFakultas" class="form-label">Singkatan</label>
            <input type="text" class="form-control" id="singkatanFakultas" placeholder="Contoh: FTIK">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" form="formTambahFakultas">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Prodi -->
<div class="modal fade" id="modalTambahProdi" tabindex="-1" aria-labelledby="modalTambahProdiLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahProdiLabel">Tambah Program Studi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <form id="formTambahProdi">
          <div class="mb-3">
            <label for="fakultasProdi" class="form-label">Fakultas</label>
            <select class="form-select" id="fakultasProdi">
              <option selected disabled>Pilih Fakultas</option>
              <option value="FTIK">Fakultas Teknik dan Ilmu Komputer</option>
              <option value="FEB">Fakultas Ekonomi dan Bisnis</option>
              <option value="FISIP">Fakultas Ilmu Sosial dan Ilmu Politik</option>
              <!-- Tambahkan data fakultas lainnya -->
            </select>
          </div>
          <div class="mb-3">
            <label for="namaProdi" class="form-label">Nama Prodi</label>
            <input type="text" class="form-control" id="namaProdi" placeholder="Contoh: Teknik Informatika">
          </div>
          <div class="mb-3">
            <label for="singkatanProdi" class="form-label">Singkatan</label>
            <input type="text" class="form-control" id="singkatanProdi" placeholder="Contoh: TI">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" form="formTambahProdi">Simpan</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Edit Fakultas -->
<div class="modal fade" id="modalEditFakultas" tabindex="-1" aria-labelledby="modalEditFakultasLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditFakultasLabel">Edit Fakultas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <form id="formEditFakultas">
          <input type="hidden" id="editFakultasId">
          <div class="mb-3">
            <label for="editNamaFakultas" class="form-label">Nama Fakultas</label>
            <input type="text" class="form-control" id="editNamaFakultas">
          </div>
          <div class="mb-3">
            <label for="editSingkatanFakultas" class="form-label">Singkatan</label>
            <input type="text" class="form-control" id="editSingkatanFakultas">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary" form="formEditFakultas">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Edit Prodi -->
<div class="modal fade" id="modalEditProdi" tabindex="-1" aria-labelledby="modalEditProdiLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditProdiLabel">Edit Program Studi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <form id="formEditProdi">
          <input type="hidden" id="editProdiId">
          <div class="mb-3">
            <label for="editFakultasProdi" class="form-label">Fakultas</label>
            <select class="form-select" id="editFakultasProdi">
              <option disabled selected>Pilih Fakultas</option>
              <option value="FTIK">Fakultas Teknik dan Ilmu Komputer</option>
              <option value="FEB">Fakultas Ekonomi dan Bisnis</option>
              <option value="FISIP">Fakultas Ilmu Sosial dan Ilmu Politik</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="editNamaProdi" class="form-label">Nama Prodi</label>
            <input type="text" class="form-control" id="editNamaProdi">
          </div>
          <div class="mb-3">
            <label for="editSingkatanProdi" class="form-label">Singkatan</label>
            <input type="text" class="form-control" id="editSingkatanProdi">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary" form="formEditProdi">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

</main><!-- End #main -->

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-edit').forEach(btn => {
  btn.addEventListener('click', function () {
    // Ambil data dari baris terkait
    const row = this.closest('tr');
    const nama = row.children[1].textContent.trim();
    const singkatan = row.children[2].textContent.trim();

    // Isi data ke dalam modal edit
    document.getElementById('editNamaFakultas').value = nama;
    document.getElementById('editSingkatanFakultas').value = singkatan;

    // Tampilkan modal
    const modal = new bootstrap.Modal(document.getElementById('modalEditFakultas'));
    modal.show();
  });
});

document.querySelectorAll('.btn-editprodi').forEach(btn => {
  btn.addEventListener('click', function () {
    const row = this.closest('tr');
    const fakultas = row.children[1].textContent.trim();
    const prodi = row.children[2].textContent.trim();
    const singkatan = row.children[3].textContent.trim();

    // Isi data ke dalam modal edit prodi
    document.getElementById('editFakultasProdi').value = fakultas;
    document.getElementById('editNamaProdi').value = prodi;
    document.getElementById('editSingkatanProdi').value = singkatan;

    const modal = new bootstrap.Modal(document.getElementById('modalEditProdi'));
    modal.show();
  });
});

    document.querySelectorAll('.btn-hapus').forEach(btn => {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        Swal.fire({
          title: 'Hapus Fakultas?',
          text: 'Data fakultas akan dihapus dari sistem.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire('Dihapus!', 'Data fakultas telah dihapus.', 'success');
            // Tambahkan logika hapus di sini (AJAX atau form submit)
          }
        });
      });
    });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-editprodi').forEach(btn => {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        Swal.fire({
          title: 'Edit Program Studi',
          text: 'Fitur ini akan membuka form edit data Program Studi.',
          icon: 'info',
          confirmButtonText: 'OK'
        });
      });
    });

    document.querySelectorAll('.btn-hapusprodi').forEach(btn => {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        Swal.fire({
          title: 'Hapus Program Studi?',
          text: 'Data Program Studi akan dihapus dari sistem.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire('Dihapus!', 'Data Program Studi telah dihapus.', 'success');
            // Tambahkan logika hapus di sini (AJAX atau form submit)
          }
        });
      });
    });
  });
</script>
@include('layout.footer')
