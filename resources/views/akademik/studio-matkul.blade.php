@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Studio & Mata Kuliah</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Akademik</li>
          <li class="breadcrumb-item active">Studio-Matkul</li>
        </ol>
      </nav>
    </div>

<section class="section">
  <div class="d-flex justify-content-between align-items-center mb-3">
  <h5 class="card-title mb-0">Data Studio E-learning</h5>
  <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahStudio">
    <i class="bi bi-plus-circle"></i> Tambah Studio
  </button>
</div>

<div class="row">
  <!-- Card Studio -->
  <div class="col-lg-6 mb-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Studio 1</h5>
        <p><code>.A</code> Gedung A</p>

        <div id="carouselFade1" class="carousel slide carousel-fade" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="assets/img/slides-1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="assets/img/slides-2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="assets/img/slides-3.jpg" class="d-block w-100" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselFade1" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselFade1" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </button>
        </div>

        <div class="mt-3 d-flex justify-content-end gap-2">
          <button class="btn btn-sm btn-primary btn-edit-studio" data-bs-toggle="modal" data-bs-target="#modalEditStudio">
            <i class="bi bi-pencil-square"></i> Edit
          </button>
          <button class="btn btn-sm btn-danger btn-hapus-studio">
            <i class="bi bi-trash"></i> Hapus
          </button>
        </div>
      </div>
    </div>
  </div>

<div class="col-lg-6 mb-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Studio 1</h5>
        <p><code>.A</code> Gedung A</p>

        <div id="carouselFade1" class="carousel slide carousel-fade" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="assets/img/slides-1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="assets/img/slides-2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="assets/img/slides-3.jpg" class="d-block w-100" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselFade1" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselFade1" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </button>
        </div>

        <div class="mt-3 d-flex justify-content-end gap-2">
          <button class="btn btn-sm btn-primary btn-edit-studio" data-bs-toggle="modal" data-bs-target="#modalEditStudio">
            <i class="bi bi-pencil-square"></i> Edit
          </button>
          <button class="btn btn-sm btn-danger btn-hapus-studio">
            <i class="bi bi-trash"></i> Hapus
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Duplikat untuk Studio 2 atau Studio lainnya -->
  <!-- Tambahkan card lain sesuai jumlah studio -->
</div>

<div class="modal fade" id="modalTambahStudio" tabindex="-1" aria-labelledby="modalTambahStudioLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formTambahStudio" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Studio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nama Studio</label>
          <input type="text" class="form-control" id="namaStudio" placeholder="Contoh: Studio 1">
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi / Lokasi</label>
          <input type="text" class="form-control" id="lokasiStudio" placeholder="Contoh: Gedung A">
        </div>
        <div class="mb-3">
          <label class="form-label">Upload Gambar</label>
          <input type="file" class="form-control" id="gambarStudio" multiple>
        </div>
        <div class="mb-3">
          <label class="form-label">Upload Gambar</label>
          <input type="file" class="form-control" id="gambarStudio" multiple>
        </div>
        <div class="mb-3">
          <label class="form-label">Upload Gambar</label>
          <input type="file" class="form-control" id="gambarStudio" multiple>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary" type="submit">Simpan</button>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modalEditStudio" tabindex="-1" aria-labelledby="modalEditStudioLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formEditStudio" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Studio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="editStudioId">
        <div class="mb-3">
          <label class="form-label">Nama Studio</label>
          <input type="text" class="form-control" id="editNamaStudio">
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi / Lokasi</label>
          <input type="text" class="form-control" id="editLokasiStudio">
        </div>
        <div class="mb-3">
          <label class="form-label">Upload Gambar Baru</label>
          <input type="file" class="form-control" id="editGambarStudio" multiple>
        </div>
        <div class="mb-3">
          <label class="form-label">Upload Gambar Baru</label>
          <input type="file" class="form-control" id="editGambarStudio" multiple>
        </div>
        <div class="mb-3">
          <label class="form-label">Upload Gambar Baru</label>
          <input type="file" class="form-control" id="editGambarStudio" multiple>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>


  <div class="col-12">
  <div class="card recent-sales overflow-auto">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="card-title mb-0">Daftar Mata Kuliah <span>| Universitas</span></h5>
        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahMatkul">
          <i class="bi bi-plus-circle"></i> Tambah Mata Kuliah
        </button>
      </div>

      <table class="table table-borderless datatable">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Fakultas</th>
            <th scope="col">Prodi</th>
            <th scope="col">Mata Kuliah</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Fakultas Teknik dan Ilmu Komputer</td>
            <td>Informatika</td>
            <td>Algoritma dan Pemrograman</td>
            <td>
              <button class="btn btn-sm btn-primary btn-editmatkul">Edit</button>
              <button class="btn btn-sm btn-danger btn-hapusmatkul">Hapus</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Tambah Mata Kuliah -->
<div class="modal fade" id="modalTambahMatkul" tabindex="-1" aria-labelledby="modalTambahMatkulLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formTambahMatkul">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Mata Kuliah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Fakultas</label>
            <select class="form-select" id="fakultasMatkul">
              <option selected disabled>Pilih Fakultas</option>
              <option value="FTIK">Fakultas Teknik dan Ilmu Komputer</option>
              <option value="FEB">Fakultas Ekonomi dan Bisnis</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Program Studi</label>
            <select class="form-select" id="prodiMatkul">
              <option selected disabled>Pilih Prodi</option>
              <option value="IF">Informatika</option>
              <option value="TS">Teknik Sipil</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Nama Mata Kuliah</label>
            <input type="text" class="form-control" id="namaMatkul" placeholder="Contoh: Pemrograman Web">
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

<!-- Modal Edit Mata Kuliah -->
<div class="modal fade" id="modalEditMatkul" tabindex="-1" aria-labelledby="modalEditMatkulLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formEditMatkul">
        <div class="modal-header">
          <h5 class="modal-title">Edit Mata Kuliah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editMatkulId">
          <div class="mb-3">
            <label class="form-label">Fakultas</label>
            <select class="form-select" id="editFakultasMatkul">
              <option selected disabled>Pilih Fakultas</option>
              <option value="FTIK">Fakultas Teknik dan Ilmu Komputer</option>
              <option value="FEB">Fakultas Ekonomi dan Bisnis</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Program Studi</label>
            <select class="form-select" id="editProdiMatkul">
              <option selected disabled>Pilih Prodi</option>
              <option value="IF">Informatika</option>
              <option value="TS">Teknik Sipil</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Nama Mata Kuliah</label>
            <input type="text" class="form-control" id="editNamaMatkul">
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

</section>

</main>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-hapus-studio').forEach(btn => {
      btn.addEventListener('click', function () {
        Swal.fire({
          title: 'Hapus Studio?',
          text: 'Data studio dan gambar terkait akan dihapus.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire('Dihapus!', 'Studio berhasil dihapus.', 'success');
            // Tambahkan logika penghapusan disini (AJAX atau hapus elemen DOM)
          }
        });
      });
    });
  });
</script>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Tombol Edit
    document.querySelectorAll('.btn-editmatkul').forEach(btn => {
      btn.addEventListener('click', function () {
        // Simulasi isi data ke modal edit
        document.getElementById('editFakultasMatkul').value = 'FTIK';
        document.getElementById('editProdiMatkul').value = 'IF';
        document.getElementById('editNamaMatkul').value = 'Algoritma dan Pemrograman';
        new bootstrap.Modal(document.getElementById('modalEditMatkul')).show();
      });
    });

    // Tombol Hapus
    document.querySelectorAll('.btn-hapusmatkul').forEach(btn => {
      btn.addEventListener('click', function () {
        Swal.fire({
          title: 'Hapus Mata Kuliah?',
          text: 'Data mata kuliah akan dihapus permanen.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire('Dihapus!', 'Data mata kuliah telah dihapus.', 'success');
            // Tambahkan logika hapus di sini (AJAX atau hapus baris)
          }
        });
      });
    });
  });
</script>


@include('layout.footer')