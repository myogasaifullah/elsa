@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Data Dosen & MOOC </h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
        <li class="breadcrumb-item">Akademik</li>
        <li class="breadcrumb-item active">Dosen-MOOC</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="col-12">
    <div class="card recent-sales overflow-auto">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Daftar Dosen <span>| Universitas</span></h5>
          <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahDosen">
            <i class="bi bi-plus-circle"></i> Tambah Dosen
          </button>
        </div>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Dosen</th>
              <th>NUPTK</th>
              <th>Target Video</th>
              <th>Fakultas</th>
              <th>Prodi</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Dr. Ahmad Yani</td>
              <td>1234567890</td>
              <td>5</td>
              <td>FTIK</td>
              <td>Informatika</td>
              <td>
                <button class="btn btn-sm btn-primary btn-edit-dosen" data-id="1">Edit</button>
                <button class="btn btn-sm btn-danger btn-hapus-dosen" data-id="1">Hapus</button>
              </td>
            </tr>
            <!-- Tambah baris lainnya -->
          </tbody>
        </table>

      </div>
    </div>
  </div>


  <div class="col-12">
    <div class="card recent-sales overflow-auto">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Daftar MOOC <span>| Universitas</span></h5>
          <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahMooc">
            <i class="bi bi-plus-circle"></i> Tambah MOOC
          </button>
        </div>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>Judul MOOC</th>
              <th>Nama Dosen</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Dasar Pemrograman Web</td>
              <td>Dr. Ahmad Yani</td>
              <td>
                <button class="btn btn-sm btn-primary btn-edit-mooc" data-id="1">Edit</button>
                <button class="btn btn-sm btn-danger btn-hapus-mooc" data-id="1">Hapus</button>
              </td>
            </tr>
            <!-- Tambah baris lainnya -->
          </tbody>
        </table>


      </div>
    </div>
  </div>

  <!-- Modal Tambah Dosen -->
  <div class="modal fade" id="modalTambahDosen" tabindex="-1" aria-labelledby="modalTambahDosenLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="formTambahDosen">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Dosen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
          <input type="text" class="form-control mb-2" placeholder="Nama Dosen" name="nama_dosen">

          <input type="text" class="form-control mb-2" placeholder="NUPTK Dosen" name="nuptk_dosen">

          <input type="text" class="form-control mb-2" placeholder="Target Video Dosen" name="target_video_dosen">

          <select class="form-select mb-2" name="fakultas_id">
            <option selected disabled>Pilih Fakultas</option>
            <option value="1">FTIK</option>
            <option value="2">FEB</option>
          </select>

          <select class="form-select" name="prodi_id">
            <option selected disabled>Pilih Prodi</option>
            <option value="1">Informatika</option>
            <option value="2">Teknik Sipil</option>
          </select>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" type="submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- Modal Tambah MOOC -->
  <div class="modal fade" id="modalTambahMooc" tabindex="-1" aria-labelledby="modalTambahMoocLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="formTambahMooc">
          <div class="modal-header">
            <h5 class="modal-title">Tambah MOOC</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="text" class="form-control mb-2" placeholder="Judul MOOC" name="judul_mooc">

            <select class="form-select" name="dosen_id">
              <option selected disabled>Pilih Dosen</option>
              <option value="1">Dr. Ahmad Yani</option>
              <option value="2">Ir. Sri Wahyuni</option>
            </select>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" type="submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

 <!-- Modal Edit Dosen -->
<div class="modal fade" id="modalEditDosen" tabindex="-1" aria-labelledby="modalEditDosenLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formEditDosen">
        <div class="modal-header">
          <h5 class="modal-title">Edit Dosen</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editDosenId">
          <input type="text" class="form-control mb-2" id="editNamaDosen" placeholder="Nama Dosen">

          <input type="text" class="form-control mb-2" id="editNuptkDosen" placeholder="NUPTK Dosen">

          <input type="text" class="form-control mb-2" id="editTargetVideoDosen" placeholder="Target Video Dosen">

          <select class="form-select mb-2" id="editFakultasId">
            <option value="1">FTIK</option>
            <option value="2">FEB</option>
          </select>
          <select class="form-select" id="editProdiId">
            <option value="1">Informatika</option>
            <option value="2">Teknik Sipil</option>
          </select>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit MOOC -->
<div class="modal fade" id="modalEditMooc" tabindex="-1" aria-labelledby="modalEditMoocLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formEditMooc">
        <div class="modal-header">
          <h5 class="modal-title">Edit MOOC</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editMoocId">
          <input type="text" class="form-control mb-2" id="editJudulMooc" placeholder="Judul MOOC">
          <select class="form-select" id="editDosenMoocId">
            <option value="1">Dr. Ahmad Yani</option>
            <option value="2">Ir. Sri Wahyuni</option>
          </select>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


</main><!-- End #main -->

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Edit Dosen
    document.querySelectorAll('.btn-edit-dosen').forEach(btn => {
      btn.addEventListener('click', function () {
        const row = this.closest('tr');
        const nama = row.children[1].textContent.trim();
        const fakultas = row.children[2].textContent.trim();
        const prodi = row.children[3].textContent.trim();

        document.getElementById('editNamaDosen').value = nama;
        document.getElementById('editFakultasId').value = fakultas;
        document.getElementById('editProdiId').value = prodi;

        new bootstrap.Modal(document.getElementById('modalEditDosen')).show();
      });
    });

    // Edit MOOC
    document.querySelectorAll('.btn-edit-mooc').forEach(btn => {
      btn.addEventListener('click', function () {
        const row = this.closest('tr');
        const judul = row.children[1].textContent.trim();
        const dosen = row.children[2].textContent.trim();

        document.getElementById('editJudulMooc').value = judul;
        document.getElementById('editDosenMoocId').value = dosen;

        new bootstrap.Modal(document.getElementById('modalEditMooc')).show();
      });
    });

    // Hapus Dosen
    document.querySelectorAll('.btn-hapus-dosen').forEach(button => {
      button.addEventListener('click', () => {
        Swal.fire({
          title: 'Hapus Dosen?',
          text: 'Data dosen akan dihapus dari sistem.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        });
      });
    });

    // Hapus MOOC
    document.querySelectorAll('.btn-hapus-mooc').forEach(button => {
      button.addEventListener('click', () => {
        Swal.fire({
          title: 'Hapus MOOC?',
          text: 'Data MOOC akan dihapus dari sistem.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        });
      });
    });
  });
</script>


@include('layout.footer')