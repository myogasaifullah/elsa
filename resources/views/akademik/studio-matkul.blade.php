@extends('layout.header')

@section('title', Auth::check() && in_array(strtolower(Auth::user()->role), ['','dosen']) ? 'Mata Kuliah' : 'Studio & Mata Kuliah')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@include('layout.sidebar')

<main id="main" class="main">

  {{-- ====== Style khusus halaman ini ====== --}}
  <style>
    /* --- PERBAIKAN UTAMA --- */
    .carousel .carousel-item {
      position: relative;
    }

    /* Parent gambar harus relative agar tombol absolute bisa posisinya tepat */
    .carousel-item .position-relative {
      position: relative;
    }

    /* Tombol hapus gambar di luar carousel */
    .btn-hapus-gambar-container {
      display: flex;
      justify-content: flex-end;
      margin-top: 10px;
      margin-bottom: 15px;
    }

    /* Tombol hapus gambar styling */
    .btn-hapus-gambar {
      z-index: 1060;
      pointer-events: auto;
      touch-action: manipulation;
    }

    /* Agar area gambar tidak menangkap klik kecuali tombol (opsional) */
    .carousel-item img {
      pointer-events: none;
    }

    .carousel-control-prev,
    .carousel-control-next {
      z-index: 1040;
    }

    /* Optional: padding agar tombol navigasi tidak bertabrakan */
    .carousel-inner {
      padding-left: 40px;
      padding-right: 40px;
    }

    /* Responsive: tinggi tetap untuk gambar */
    .carousel .carousel-item img {
      height: 250px;
      object-fit: cover;
      object-position: center;
    }

    /* Indikator gambar aktif */
    .gambar-indicator {
      display: flex;
      justify-content: center;
      margin-top: 10px;
      gap: 5px;
    }

    .gambar-indicator .indicator-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background-color: #6c757d;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .gambar-indicator .indicator-dot.active {
      background-color: #0d6efd;
    }
  </style>

  {{-- ====== Breadcrumb ====== --}}
  <div class="pagetitle">
    <h1>@if(Auth::check() && in_array(strtolower(Auth::user()->role), ['','dosen'])) Mata Kuliah @else Studio & Mata Kuliah @endif</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Akademik</li>
        <li class="breadcrumb-item active">@if(Auth::check() && in_array(strtolower(Auth::user()->role), ['','dosen'])) Mata Kuliah @else Studio-Matkul @endif</li>
      </ol>
    </nav>
  </div>

  @if(!(Auth::check() && in_array(strtolower(Auth::user()->role), ['','dosen'])))
  {{-- ====== Section Studio ====== --}}
  <section class="section">

    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="card-title mb-0">Data Studio E-learning</h5>
      <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahStudio">
        <i class="bi bi-plus-circle"></i> Tambah Studio
      </button>
    </div>

    <div class="row" id="studioContainer">
      @foreach($studios as $studio)
      <div class="col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body">

            {{-- ====== Header Card ====== --}}
            <h5 class="card-title">{{ $studio->nama_studio }}</h5>
            <p><code>{{ $studio->lokasi }}</code></p>

            {{-- ====== Carousel Gambar Studio ====== --}}
            @if($studio->gambarStudio->count() > 0)
            <div id="carouselFade{{ $studio->id }}" class="carousel slide carousel-fade" data-bs-ride="carousel">
              <div class="carousel-inner">
                @foreach($studio->gambarStudio as $index => $gambar)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-gambar-id="{{ $gambar->id }}">
                  <div class="position-relative">
                    <img src="{{ asset('storage/' . $gambar->path) }}" class="d-block w-100" alt="Gambar Studio">
                  </div>
                </div>
                @endforeach
              </div>

              {{-- Control Navigasi Carousel --}}
              <button class="carousel-control-prev" type="button"
                data-bs-target="#carouselFade{{ $studio->id }}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              </button>
              <button class="carousel-control-next" type="button"
                data-bs-target="#carouselFade{{ $studio->id }}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
              </button>
            </div>

            {{-- Indikator gambar --}}
            <div class="gambar-indicator" id="indicator{{ $studio->id }}">
              @foreach($studio->gambarStudio as $index => $gambar)
              <div class="indicator-dot {{ $index == 0 ? 'active' : '' }}"
                data-bs-target="#carouselFade{{ $studio->id }}"
                data-bs-slide-to="{{ $index }}"></div>
              @endforeach
            </div>

            {{-- Tombol Hapus Gambar (DI LUAR CAROUSEL) --}}
            <div class="btn-hapus-gambar-container">
              <button class="btn btn-danger btn-sm btn-hapus-gambar"
                data-id=""
                data-studio-id="{{ $studio->id }}"
                id="btnHapusGambar{{ $studio->id }}">
                <i class="bi bi-trash"></i> Hapus Gambar Ini
              </button>
            </div>
            @else
            <div class="text-center">
              <img src="{{ asset('assets/img/slides-1.jpg') }}" class="d-block w-100" alt="Gambar Default">
            </div>
            @endif

            {{-- ====== Action Buttons ====== --}}
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

    {{-- ====== Modal Tambah Studio ====== --}}
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

    {{-- ====== Modal Edit Studio ====== --}}
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

    @endif

    {{-- ====== Include Daftar Mata Kuliah ====== --}}
    @include('akademik.matakuliah')

  </section>
</main>

{{-- ====== Script (fungsi tetap) ====== --}}
<script>
  document.addEventListener('DOMContentLoaded', function() {

    // ===== Form Tambah Studio =====
    document.getElementById('formTambahStudio').addEventListener('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(this);

      fetch("{{ route('studio.store') }}", {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            Swal.fire('Berhasil!', data.success, 'success').then(() => location.reload());
          } else {
            Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan data.', 'error');
          }
        })
        .catch(() => Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error'));
    });

    // ===== Form Edit Studio =====
    document.getElementById('formEditStudio').addEventListener('submit', function(e) {
      e.preventDefault();
      const id = document.getElementById('editStudioId').value;
      const formData = new FormData(this);

      fetch("/studio/" + id, {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-HTTP-Method-Override': 'PUT'
          }
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            Swal.fire('Berhasil!', data.success, 'success').then(() => location.reload());
          } else {
            Swal.fire('Gagal!', 'Terjadi kesalahan saat memperbarui data.', 'error');
          }
        })
        .catch(() => Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error'));
    });

    // ===== Tombol Edit Studio =====
    document.querySelectorAll('.btn-edit-studio').forEach(btn => {
      btn.addEventListener('click', function() {
        document.getElementById('editStudioId').value = this.dataset.id;
        document.getElementById('editNamaStudio').value = this.dataset.nama;
        document.getElementById('editLokasiStudio').value = this.dataset.lokasi;
      });
    });

    // ===== Tombol Hapus Studio =====
    document.querySelectorAll('.btn-hapus-studio').forEach(btn => {
      btn.addEventListener('click', function() {
        const id = this.dataset.id;
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
              .then(res => res.json())
              .then(data => {
                if (data.success) {
                  Swal.fire('Dihapus!', data.success, 'success').then(() => location.reload());
                } else {
                  Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                }
              })
              .catch(() => Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error'));
          }
        });
      });
    });

    // ===== FUNGSI BARU: Update tombol hapus berdasarkan gambar aktif =====
    function updateHapusButton(studioId) {
      const carousel = document.getElementById('carouselFade' + studioId);
      const activeItem = carousel.querySelector('.carousel-item.active');
      const gambarId = activeItem ? activeItem.getAttribute('data-gambar-id') : '';
      const hapusButton = document.getElementById('btnHapusGambar' + studioId);

      if (hapusButton && gambarId) {
        hapusButton.setAttribute('data-id', gambarId);
        hapusButton.style.display = 'inline-block';
      } else {
        hapusButton.style.display = 'none';
      }
    }

    // ===== Inisialisasi tombol hapus untuk setiap studio =====
    document.querySelectorAll('[id^="carouselFade"]').forEach(carousel => {
      const studioId = carousel.id.replace('carouselFade', '');

      // Update tombol hapus saat halaman dimuat
      updateHapusButton(studioId);

      // Update tombol hapus saat carousel berubah
      carousel.addEventListener('slid.bs.carousel', function() {
        updateHapusButton(studioId);

        // Update indikator aktif
        const indicators = document.querySelectorAll('#indicator' + studioId + ' .indicator-dot');
        const activeIndex = Array.from(carousel.querySelectorAll('.carousel-item')).findIndex(item =>
          item.classList.contains('active')
        );

        indicators.forEach((dot, index) => {
          dot.classList.toggle('active', index === activeIndex);
        });
      });
    });

    // ===== Tombol Hapus Gambar Studio (VERSI BARU) =====
    document.querySelectorAll('.btn-hapus-gambar').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        const gambarId = this.getAttribute('data-id');
        const studioId = this.getAttribute('data-studio-id');

        if (!gambarId) {
          Swal.fire('Peringatan!', 'Tidak ada gambar yang dipilih untuk dihapus.', 'warning');
          return;
        }

        Swal.fire({
          title: 'Hapus Gambar?',
          text: 'Gambar akan dihapus permanen.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            fetch("/gambar-studio/" + gambarId, {
                method: 'DELETE',
                headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                  'Content-Type': 'application/json'
                }
              })
              .then(res => {
                if (!res.ok) throw new Error('Network response was not ok');
                return res.json();
              })
              .then(data => {
                if (data.success) {
                  Swal.fire('Dihapus!', data.success, 'success').then(() => location.reload());
                } else {
                  Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus gambar: ' + (data.error || ''), 'error');
                }
              })
              .catch(error => Swal.fire('Error!', 'Terjadi kesalahan jaringan: ' + error.message, 'error'));
          }
        });
      });
    });

    // ===== Fungsi untuk indikator dot =====
    document.querySelectorAll('.gambar-indicator .indicator-dot').forEach(dot => {
      dot.addEventListener('click', function() {
        const target = this.getAttribute('data-bs-target');
        const slideTo = this.getAttribute('data-bs-slide-to');

        const carousel = document.querySelector(target);
        const bsCarousel = bootstrap.Carousel.getInstance(carousel);
        bsCarousel.to(slideTo);
      });
    });

  });
</script>

@include('layout.footer')