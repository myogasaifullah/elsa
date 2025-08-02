@extends('layout.header')

@section('title', 'Studio & Mata Kuliah')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@include('layout.sidebar')
<main id="main" class="main">

  <style>
    .carousel .carousel-item {
      position: relative;
    }

      .btn-hapus-gambar {
    z-index: 1050;
    pointer-events: auto;
    touch-action: manipulation; /* penting untuk mencegah geser saat tap */
  }

  .carousel-control-prev,
  .carousel-control-next {
    z-index: 1040;
  }

    /* Optional: Tambahan padding agar tombol navigasi tidak bertabrakan */
    .carousel-inner {
      padding-left: 40px;
      padding-right: 40px;
    }

    /* Responsive: ukuran tetap */
    .carousel .carousel-item img {
      height: 250px;
      object-fit: cover;
      object-position: center;
    }
  </style>


  <div class="pagetitle">
    <h1>Studio & Mata Kuliah</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
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

    <div class="row" id="studioContainer">
      <!-- Card Studio akan diisi dengan loop -->
      @foreach($studios as $studio)
      <div class="col-lg-6 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ $studio->nama_studio }}</h5>
            <p><code>{{ $studio->lokasi }}</code></p>

            @if($studio->gambarStudio->count() > 0)
            <div id="carouselFade{{ $studio->id }}" class="carousel slide carousel-fade" data-bs-ride="carousel">
              <div class="carousel-inner">
                @foreach($studio->gambarStudio as $index => $gambar)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                  <div class="position-relative">
                    <img src="{{ asset('storage/' . $gambar->path) }}" class="d-block w-100" alt="Gambar Studio">
                    <button
                    class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 btn-hapus-gambar"
                    data-id="{{ $gambar->id }}"
                    data-bs-slide="false"
                    type="button">
                    <i class="bi bi-trash"></i>
                  </button>
                  </div>
                  

                </div>
                @endforeach
              </div>
             
            </div>
             <button class="carousel-control-prev" type="button" data-bs-target="#carouselFade{{ $studio->id }}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselFade{{ $studio->id }}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
              </button>
            @else
            <div class="text-center">
              <img src="{{ asset('assets/img/slides-1.jpg') }}" class="d-block w-100" alt="Gambar Default">
            </div>
            @endif

            <div class="mt-3 d-flex justify-content-end gap-2">
              <button class="btn btn-sm btn-primary btn-edit-studio"
                data-id="{{ $studio->id }}"
                data-nama="{{ $studio->nama_studio }}"
                data-lokasi="{{ $studio->lokasi }}"
                data-bs-toggle="modal"
                data-bs-target="#modalEditStudio">
                <i class="bi bi-pencil-square"></i> Edit
              </button>
              <button class="btn btn-sm btn-danger btn-hapus-studio" data-id="{{ $studio->id }}">
                <i class="bi bi-trash"></i> Hapus
              </button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="modal fade" id="modalTambahStudio" tabindex="-1" aria-labelledby="modalTambahStudioLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form id="formTambahStudio" class="modal-content" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Tambah Studio</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Nama Studio</label>
              <input type="text" class="form-control" name="nama_studio" placeholder="Contoh: Studio 1" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Deskripsi / Lokasi</label>
              <input type="text" class="form-control" name="lokasi" placeholder="Contoh: Gedung A" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Upload Gambar</label>
              <input type="file" class="form-control" name="gambar[]" multiple accept="image/*">
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
        <form id="formEditStudio" class="modal-content" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title">Edit Studio</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" id="editStudioId">
            <div class="mb-3">
              <label class="form-label">Nama Studio</label>
              <input type="text" class="form-control" name="nama_studio" id="editNamaStudio" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Deskripsi / Lokasi</label>
              <input type="text" class="form-control" name="lokasi" id="editLokasiStudio" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Upload Gambar Baru</label>
              <input type="file" class="form-control" name="gambar[]" multiple accept="image/*">
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
              @foreach($mataKuliah as $matkul)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $matkul->fakultas->nama_fakultas }}</td>
                <td>{{ $matkul->prodi->nama_prodi }}</td>
                <td>{{ $matkul->nama_mata_kuliah }}</td>
                <td>
                  <button class="btn btn-sm btn-primary btn-editmatkul"
                    data-id="{{ $matkul->id }}"
                    data-fakultas="{{ $matkul->fakultas_id }}"
                    data-prodi="{{ $matkul->prodi_id }}"
                    data-nama="{{ $matkul->nama_mata_kuliah }}">
                    Edit
                  </button>
                  <button class="btn btn-sm btn-danger btn-hapusmatkul" data-id="{{ $matkul->id }}">
                    Hapus
                  </button>
                </td>
              </tr>
              @endforeach
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
            @csrf
            <div class="modal-header">
              <h5 class="modal-title">Tambah Mata Kuliah</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Fakultas</label>
                <select class="form-select" name="fakultas_id" id="fakultasMatkul" required>
                  <option selected disabled>Pilih Fakultas</option>
                  @foreach($fakultas as $fak)
                  <option value="{{ $fak->id }}">{{ $fak->nama_fakultas }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Program Studi</label>
                <select class="form-select" name="prodi_id" id="prodiMatkul" required>
                  <option selected disabled>Pilih Prodi</option>
                  @foreach($prodis as $prodi)
                  <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" class="form-control" name="nama_mata_kuliah" id="namaMatkul" placeholder="Contoh: Pemrograman Web" required>
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
            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title">Edit Mata Kuliah</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id" id="editMatkulId">
              <div class="mb-3">
                <label class="form-label">Fakultas</label>
                <select class="form-select" name="fakultas_id" id="editFakultasMatkul" required>
                  <option selected disabled>Pilih Fakultas</option>
                  @foreach($fakultas as $fak)
                  <option value="{{ $fak->id }}">{{ $fak->nama_fakultas }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Program Studi</label>
                <select class="form-select" name="prodi_id" id="editProdiMatkul" required>
                  <option selected disabled>Pilih Prodi</option>
                  @foreach($prodis as $prodi)
                  <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" class="form-control" name="nama_mata_kuliah" id="editNamaMatkul" required>
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
  document.addEventListener('DOMContentLoaded', function() {
    // Form Tambah Studio
    document.getElementById('formTambahStudio').addEventListener('submit', function(e) {
      e.preventDefault();

      var formData = new FormData(this);

      fetch("{{ route('studio.store') }}", {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            Swal.fire('Berhasil!', data.success, 'success').then(() => {
              location.reload();
            });
          } else {
            Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan data.', 'error');
          }
        })
        .catch(error => {
          Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error');
        });
    });

    // Form Edit Studio
    document.getElementById('formEditStudio').addEventListener('submit', function(e) {
      e.preventDefault();

      var id = document.getElementById('editStudioId').value;
      var formData = new FormData(this);

      fetch("/studio/" + id, {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-HTTP-Method-Override': 'PUT'
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            Swal.fire('Berhasil!', data.success, 'success').then(() => {
              location.reload();
            });
          } else {
            Swal.fire('Gagal!', 'Terjadi kesalahan saat memperbarui data.', 'error');
          }
        })
        .catch(error => {
          Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error');
        });
    });

    // Tombol Edit Studio
    document.querySelectorAll('.btn-edit-studio').forEach(btn => {
      btn.addEventListener('click', function() {
        document.getElementById('editStudioId').value = this.getAttribute('data-id');
        document.getElementById('editNamaStudio').value = this.getAttribute('data-nama');
        document.getElementById('editLokasiStudio').value = this.getAttribute('data-lokasi');
      });
    });

    // Tombol Hapus Studio
    document.querySelectorAll('.btn-hapus-studio').forEach(btn => {
      btn.addEventListener('click', function() {
        var id = this.getAttribute('data-id');
        Swal.fire({
          title: 'Hapus Studio?',
          text: 'Data studio dan gambar terkait akan dihapus.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            fetch("/studio/" + id, {
                method: 'DELETE',
                headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
              })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  Swal.fire('Dihapus!', data.success, 'success').then(() => {
                    location.reload();
                  });
                } else {
                  Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                }
              })
              .catch(error => {
                Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error');
              });
          }
        });
      });
    });

    // Form Tambah Mata Kuliah
    document.getElementById('formTambahMatkul').addEventListener('submit', function(e) {
      e.preventDefault();

      var formData = new FormData(this);

      fetch("{{ route('mata-kuliah.store') }}", {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            Swal.fire('Berhasil!', data.success, 'success').then(() => {
              location.reload();
            });
          } else {
            Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan data.', 'error');
          }
        })
        .catch(error => {
          Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error');
        });
    });

    // Form Edit Mata Kuliah
    document.getElementById('formEditMatkul').addEventListener('submit', function(e) {
      e.preventDefault();

      var id = document.getElementById('editMatkulId').value;
      var formData = new FormData(this);

      fetch("/mata-kuliah/" + id, {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-HTTP-Method-Override': 'PUT'
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            Swal.fire('Berhasil!', data.success, 'success').then(() => {
              location.reload();
            });
          } else {
            Swal.fire('Gagal!', 'Terjadi kesalahan saat memperbarui data.', 'error');
          }
        })
        .catch(error => {
          Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error');
        });
    });

    // Tombol Edit Mata Kuliah
    document.querySelectorAll('.btn-editmatkul').forEach(btn => {
      btn.addEventListener('click', function() {
        document.getElementById('editMatkulId').value = this.getAttribute('data-id');
        document.getElementById('editFakultasMatkul').value = this.getAttribute('data-fakultas');
        document.getElementById('editProdiMatkul').value = this.getAttribute('data-prodi');
        document.getElementById('editNamaMatkul').value = this.getAttribute('data-nama');
        new bootstrap.Modal(document.getElementById('modalEditMatkul')).show();
      });
    });

    // Tombol Hapus Mata Kuliah
    document.querySelectorAll('.btn-hapusmatkul').forEach(btn => {
      btn.addEventListener('click', function() {
        var id = this.getAttribute('data-id');
        Swal.fire({
          title: 'Hapus Mata Kuliah?',
          text: 'Data mata kuliah akan dihapus permanen.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            fetch("/mata-kuliah/" + id, {
                method: 'DELETE',
                headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
              })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  Swal.fire('Dihapus!', data.success, 'success').then(() => {
                    location.reload();
                  });
                } else {
                  Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                }
              })
              .catch(error => {
                Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error');
              });
          }
        });
      });
    });
  });

  // Tombol Hapus Gambar Studio (di luar DOMContentLoaded untuk memastikan elemen ada)
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-hapus-gambar').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.stopPropagation(); // Mencegah slide carousel
        e.preventDefault(); // Mencegah aksi default jika ada
        e.stopImmediatePropagation(); // Ini penting untuk Bootstrap


        var id = this.getAttribute('data-id');

        // Logging untuk debugging
        console.log('Tombol hapus gambar diklik, ID:', id);

        Swal.fire({
          title: 'Hapus Gambar?',
          text: 'Gambar akan dihapus permanen.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            console.log('Mengirim request DELETE untuk gambar ID:', id);
            fetch("/gambar-studio/" + id, {
                method: 'DELETE',
                headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                  'Content-Type': 'application/json'
                }
              })
              .then(response => {
                console.log('Response diterima:', response);
                if (!response.ok) {
                  throw new Error('Network response was not ok');
                }
                return response.json();
              })
              .then(data => {
                console.log('Data diterima:', data);
                if (data.success) {
                  Swal.fire('Dihapus!', data.success, 'success').then(() => {
                    location.reload();
                  });
                } else {
                  Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus gambar: ' + (data.error || ''), 'error');
                }
              })
              .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'Terjadi kesalahan jaringan: ' + error.message, 'error');
              });
          }
        });
      });
    });
  });
</script>

@include('layout.footer')