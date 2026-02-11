@extends('layout.header')

@section('title', 'Arsip')

@include('layout.sidebar')

<style>
    /* DataTables Buttons - Transparent Style */
    .dt-buttons .btn {
        background-color: transparent !important;
        border: 1px solid transparent;
        color: #0d6efd;
        /* biru default bootstrap */
        box-shadow: none;
    }

    /* Hover effect */
    .dt-buttons .btn:hover {
        background-color: rgba(13, 110, 253, 0.1) !important;
        border-color: #0d6efd;
    }

    /* Focus & active */
    .dt-buttons .btn:focus,
    .dt-buttons .btn:active {
        background-color: rgba(13, 110, 253, 0.15) !important;
        box-shadow: none !important;
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Arsip</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Arsip</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

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

                <div class="card">
                    <div class="card-body">
                        @include('action_arsip')

                        <!-- Filter Dropdown -->
                        <div class="d-flex justify-content-end mb-3">
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                    <li>
                                        <h6 class="dropdown-header">Filter Berdasarkan Status</h6>
                                    </li>
                                    <li><a class="dropdown-item filter-status" href="#" data-status="all">Semua Data</a></li>
                                    <li><a class="dropdown-item filter-status" href="#" data-status="belum">Belum Progres</a></li>
                                    <li><a class="dropdown-item filter-status" href="#" data-status="progres">Sedang Progres</a></li>
                                    <li><a class="dropdown-item filter-status" href="#" data-status="selesai">Selesai</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <h6 class="dropdown-header">Filter Berdasarkan Keterangan</h6>
                                    </li>
                                    <li><a class="dropdown-item filter-keterangan" href="#" data-keterangan="all">Semua Keterangan</a></li>
                                    <li><a class="dropdown-item filter-keterangan" href="#" data-keterangan="belum_terbit">Belum Terbit</a></li>
                                    <li><a class="dropdown-item filter-keterangan" href="#" data-keterangan="sudah_terbit">Sudah Terbit</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Date Filter Row -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="filterDate" class="form-label">Filter Tanggal Upload</label>
                                <input type="date" class="form-control form-control-sm" id="filterDate">
                            </div>
                            <div class="col-md-4">
                                <label for="filterMonth" class="form-label">Filter Bulan</label>
                                <select class="form-select form-select-sm" id="filterMonth">
                                    <option value="">Semua Bulan</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="filterYear" class="form-label">Filter Tahun</label>
                                <select class="form-select form-select-sm" id="filterYear">
                                    <option value="">Semua Tahun</option>
                                    @php
                                    $currentYear = date('Y');
                                    for ($year = $currentYear; $year >= $currentYear - 10; $year--) {
                                    echo "<option value='$year'>$year</option>";
                                    }
                                    @endphp
                                </select>
                            </div>
                        </div>

                        <!-- Additional Filters Row -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="filterDosen" class="form-label">Filter Dosen</label>
                                <select class="form-select form-select-sm" id="filterDosen">
                                    <option value="">Semua Dosen</option>
                                    @php
                                    $dosenOptions = $progress->pluck('jadwalBooking.dosen.nama_dosen')->unique()->filter()->sort();
                                    @endphp
                                    @foreach($dosenOptions as $dosen)
                                    <option value="{{ $dosen }}">{{ $dosen }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="filterFakultas" class="form-label">Filter Fakultas</label>
                                <select class="form-select form-select-sm" id="filterFakultas">
                                    <option value="">Semua Fakultas</option>
                                    @php
                                    $fakultasOptions = $progress->pluck('jadwalBooking.dosen.fakultas.nama_fakultas')->unique()->filter()->sort();
                                    @endphp
                                    @foreach($fakultasOptions as $fakultas)
                                    <option value="{{ $fakultas }}">{{ $fakultas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="filterProdi" class="form-label">Filter Prodi</label>
                                <select class="form-select form-select-sm" id="filterProdi">
                                    <option value="">Semua Prodi</option>
                                    @php
                                    $prodiOptions = $progress->pluck('jadwalBooking.dosen.prodi.nama_prodi')->unique()->filter()->sort();
                                    @endphp
                                    @foreach($prodiOptions as $prodi)
                                    <option value="{{ $prodi }}">{{ $prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="filterMataKuliah" class="form-label">Filter Mata Kuliah</label>
                                <select class="form-select form-select-sm" id="filterMataKuliah">
                                    <option value="">Semua Mata Kuliah</option>
                                    @php
                                    $mataKuliahOptions = $progress->pluck('jadwalBooking.nama_mata_kuliah')->unique()->filter()->sort();
                                    @endphp
                                    @foreach($mataKuliahOptions as $mataKuliah)
                                    <option value="{{ $mataKuliah }}">{{ $mataKuliah }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- More Filters Row -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="filterKategoriMooc" class="form-label">Filter Kategori MOOC</label>
                                <select class="form-select form-select-sm" id="filterKategoriMooc">
                                    <option value="">Semua Kategori MOOC</option>
                                    @php
                                    $kategoriMoocOptions = $progress->pluck('jadwalBooking.kategori_mooc')->unique()->filter()->sort();
                                    @endphp
                                    @foreach($kategoriMoocOptions as $kategoriMooc)
                                    <option value="{{ $kategoriMooc }}">{{ $kategoriMooc }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="filterStudio" class="form-label">Filter Studio</label>
                                <select class="form-select form-select-sm" id="filterStudio">
                                    <option value="">Semua Studio</option>
                                    @php
                                    $studioOptions = $progress->pluck('jadwalBooking.studio.nama_studio')->unique()->filter()->sort();
                                    @endphp
                                    @foreach($studioOptions as $studio)
                                    <option value="{{ $studio }}">{{ $studio }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="filterJenisKategori" class="form-label">Filter Jenis Kategori</label>
                                <select class="form-select form-select-sm" id="filterJenisKategori">
                                    <option value="">Semua Jenis Kategori</option>
                                    @php
                                    $jenisKategoriOptions = $progress->pluck('jadwalBooking.jenis_kategori')->unique()->filter()->sort();
                                    @endphp
                                    @foreach($jenisKategoriOptions as $jenisKategori)
                                    <option value="{{ $jenisKategori }}">{{ $jenisKategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="button" class="btn btn-secondary btn-sm" id="clearFilters">Clear Filters</button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="arsipTable" class="table table-sm  align-middle">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Dosen</th>
                                        <th>Judul Course</th>
                                        <th>Tanggal Shooting</th>
                                        <th>Target Upload</th>
                                        <th>Persentase</th>
                                        <th>Progres</th>
                                        <th>Keterangan</th>
                                        <th>Durasi (Menit)</th>
                                        <th>Tautan Video</th>
                                        <th>Tgl Upload YouTube</th>
                                        <th>Editor</th>
                                        <th>Fakultas</th>
                                        <th>Prodi</th>
                                        <th>Mata Kuliah</th>
                                        <th>Kategori MOOC</th>
                                        <th>Studio</th>
                                        <th>Waktu</th>
                                        <th>Jenis Kategori</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($progress as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
                                        <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
                                        <td>{{ $item->jadwalBooking->tanggal ?? '-' }}</td>
                                        <td>{{ $item->target_upload ? \Carbon\Carbon::parse($item->target_upload)->format('d/m/Y') : '-' }}</td>

                                        {{-- Persentase --}}
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" style="width: {{ $item->persentase }}%">
                                                    {{ $item->persentase }}%
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Progres --}}
                                        <td class="text-center">
                                            <span class="badge
                                                @if($item->progres == 'belum') bg-secondary
                                                @elseif($item->progres == 'progres') bg-warning text-dark
                                                @else bg-success
                                                @endif">
                                                {{ ucfirst($item->progres) }}
                                            </span>
                                        </td>

                                        {{-- Keterangan --}}
                                        <td class="text-center">
                                            <span class="badge
                                                @if($item->keterangan == 'belum_terbit') bg-danger
                                                @else bg-success
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $item->keterangan)) }}
                                            </span>
                                        </td>

                                        <td class="text-center">{{ $item->durasi ?? '-' }}</td>

                                        <td class="text-center">
                                            @if($item->publish_link_youtube)
                                            <a href="{{ $item->publish_link_youtube }}" target="_blank" class="btn btn-sm btn-primary">
                                                Lihat
                                            </a>
                                            @else
                                            -
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            {{ $item->tanggal_upload_youtube ? \Carbon\Carbon::parse($item->tanggal_upload_youtube)->format('d/m/Y') : '-' }}
                                        </td>

                                        {{-- Editor --}}
                                        <td class="text-center">
                                            {{ $item->editor->nama ?? '-' }}
                                        </td>

                                        {{-- Fakultas --}}
                                        <td class="text-center">
                                            {{ $item->jadwalBooking->dosen->fakultas->nama_fakultas ?? '-' }}
                                        </td>

                                        {{-- Prodi --}}
                                        <td class="text-center">
                                            {{ $item->jadwalBooking->dosen->prodi->nama_prodi ?? '-' }}
                                        </td>

                                        {{-- Mata Kuliah --}}
                                        <td class="text-center">
                                            {{ $item->jadwalBooking->nama_mata_kuliah ?? '-' }}
                                        </td>

                                        {{-- Kategori MOOC --}}
                                        <td class="text-center">
                                            {{ $item->jadwalBooking->kategori_mooc ?? '-' }}
                                        </td>

                                        {{-- Studio --}}
                                        <td class="text-center">
                                            {{ $item->jadwalBooking->studio->nama_studio ?? '-' }}
                                        </td>

                                        {{-- Waktu --}}
                                        <td class="text-center">
                                            {{ $item->jadwalBooking->jam ?? '-' }}
                                        </td>

                                        {{-- Jenis Kategori --}}
                                        <td class="text-center">
                                            {{ $item->jadwalBooking->jenis_kategori ?? '-' }}
                                        </td>

                                        {{-- Status --}}
                                        <td class="text-center">
                                            Sudah Shooting
                                        </td>

                                        {{-- Actions --}}
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-warning me-1" onclick="editArsip({{ $item->id }})">
                                                <i class="bi bi-pencil"></i> Edit
                                            </button>
                                            <form action="{{ route('arsip.destroy', $item->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center">Tidak ada data arsip progress</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.3.2/css/fixedHeader.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Arsip</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Dosen:</strong> <span id="detailDosen"></span></p>
                        <p><strong>Fakultas:</strong> <span id="detailFakultas"></span></p>
                        <p><strong>Prodi:</strong> <span id="detailProdi"></span></p>
                        <p><strong>Mata Kuliah:</strong> <span id="detailMataKuliah"></span></p>
                        <p><strong>Kategori MOOC:</strong> <span id="detailKategoriMooc"></span></p>
                        <p><strong>Judul Course:</strong> <span id="detailJudulCourse"></span></p>
                        <p><strong>Studio:</strong> <span id="detailStudio"></span></p>
                        <p><strong>Tanggal Shooting:</strong> <span id="detailTanggalShooting"></span></p>
                        <p><strong>Waktu:</strong> <span id="detailWaktu"></span></p>
                        <p><strong>Jenis Kategori:</strong> <span id="detailJenisKategori"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Target Upload:</strong> <span id="detailTargetUpload"></span></p>
                        <p><strong>Persentase:</strong> <span id="detailPersentase"></span></p>
                        <p><strong>Progres:</strong> <span id="detailProgres"></span></p>
                        <p><strong>Keterangan:</strong> <span id="detailKeterangan"></span></p>
                        <p><strong>Durasi (Menit):</strong> <span id="detailDurasi"></span></p>
                        <p><strong>Tautan Video:</strong> <span id="detailTautanVideo"></span></p>
                        <p><strong>Tgl Upload YouTube:</strong> <span id="detailTglUploadYoutube"></span></p>
                        <p><strong>Editor:</strong> <span id="detailEditor"></span></p>
                        <p><strong>Status:</strong> <span id="detailStatus"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')

<!-- Modal Edit Arsip -->
<div class="modal fade" id="editArsipModal" tabindex="-1" aria-labelledby="editArsipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editArsipModalLabel">Edit Data Arsip</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editArsipForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Data Dosen -->
                            <div class="mb-3">
                                <label for="edit_dosen_id" class="form-label">Dosen</label>
                                <select class="form-select" id="edit_dosen_id" name="dosen_id">
                                    <option value="">Pilih Dosen</option>
                                    @foreach(\App\Models\Dosen::all() as $dosen)
                                    <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Fakultas -->
                            <div class="mb-3">
                                <label for="edit_fakultas_id" class="form-label">Fakultas</label>
                                <select class="form-select" id="edit_fakultas_id" name="fakultas_id">
                                    <option value="">Pilih Fakultas</option>
                                    @foreach(\App\Models\Fakultas::all() as $fakultas)
                                    <option value="{{ $fakultas->id }}">{{ $fakultas->nama_fakultas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Prodi -->
                            <div class="mb-3">
                                <label for="edit_prodi_id" class="form-label">Prodi</label>
                                <select class="form-select" id="edit_prodi_id" name="prodi_id">
                                    <option value="">Pilih Prodi</option>
                                    @foreach(\App\Models\Prodi::all() as $prodi)
                                    <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Mata Kuliah -->
                            <div class="mb-3">
                                <label for="edit_mata_kuliah_id" class="form-label">Mata Kuliah</label>
                                <select class="form-select" id="edit_mata_kuliah_id" name="mata_kuliah_id">
                                    <option value="">Pilih Mata Kuliah</option>
                                    @foreach(\App\Models\MataKuliah::all() as $mataKuliah)
                                    <option value="{{ $mataKuliah->id }}">{{ $mataKuliah->nama_mata_kuliah }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Judul Course -->
                            <div class="mb-3">
                                <label for="edit_judul_course" class="form-label">Judul Course</label>
                                <input type="text" class="form-control" id="edit_judul_course" name="judul_course">
                            </div>
                            <!-- Data Kategori MOOC -->
                            <div class="mb-3" id="editMoocField" style="display: none;">
                                <label for="edit_kategori_mooc" class="form-label">Kategori MOOC</label>
                                <select class="form-select" id="edit_kategori_mooc" name="kategori_mooc">
                                    <option value="">Pilih Kategori MOOC</option>
                                    @foreach(\App\Models\Mooc::all() as $mooc)
                                    <option value="{{ $mooc->judul_mooc }}">{{ $mooc->judul_mooc }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Studio -->
                            <div class="mb-3">
                                <label for="edit_studio_id" class="form-label">Studio</label>
                                <select class="form-select" id="edit_studio_id" name="studio_id">
                                    <option value="">Pilih Studio</option>
                                    @foreach(\App\Models\Studio::all() as $studio)
                                    <option value="{{ $studio->id }}">{{ $studio->nama_studio }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Tanggal Shooting -->
                            <div class="mb-3">
                                <label for="edit_tanggal_shooting" class="form-label">Tanggal Shooting</label>
                                <input type="date" class="form-control" id="edit_tanggal_shooting" name="tanggal_shooting">
                            </div>
                            <!-- Data Jam Mulai -->
                            <div class="mb-3">
                                <label for="edit_jam_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control" id="edit_jam_mulai" name="jam_mulai">
                            </div>
                            <!-- Data Jam Selesai -->
                            <div class="mb-3">
                                <label for="edit_jam_selesai" class="form-label">Jam Selesai</label>
                                <input type="time" class="form-control" id="edit_jam_selesai" name="jam_selesai">
                            </div>
                            <!-- Data Jenis Kategori -->
                            <div class="mb-3">
                                <label for="edit_jenis_kategori" class="form-label">Jenis Kategori</label>
                                <select class="form-select" id="edit_jenis_kategori" name="jenis_kategori">
                                    <option value="">Pilih Jenis Kategori</option>
                                    <option value="Lomba">Lomba</option>
                                    <option value="E-Learning">E-Learning</option>
                                    <option value="MOOC">MOOC</option>
                                    <option value="Marketing">Marketing</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Data Target Upload -->
                            <div class="mb-3">
                                <label for="edit_target_upload" class="form-label">Target Upload</label>
                                <input type="date" class="form-control" id="edit_target_upload" name="target_upload">
                            </div>
                            <!-- Data Persentase -->
                            <div class="mb-3">
                                <label for="edit_persentase" class="form-label">Persentase</label>
                                <input type="number" class="form-control" id="edit_persentase" name="persentase" min="0" max="100" required>
                            </div>
                            <!-- Data Progres -->
                            <div class="mb-3">
                                <label for="edit_progres" class="form-label">Progres</label>
                                <select class="form-select" id="edit_progres" name="progres" required>
                                    <option value="">Pilih Progres</option>
                                    <option value="belum">Belum</option>
                                    <option value="progres">Sedang Progres</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                            <!-- Data Keterangan -->
                            <div class="mb-3">
                                <label for="edit_keterangan" class="form-label">Keterangan</label>
                                <select class="form-select" id="edit_keterangan" name="keterangan" required>
                                    <option value="">Pilih Keterangan</option>
                                    <option value="belum terbit">Belum Terbit</option>
                                    <option value="sudah terbit">Sudah Terbit</option>
                                </select>
                            </div>
                            <!-- Data Durasi -->
                            <div class="mb-3">
                                <label for="edit_durasi" class="form-label">Durasi (Menit)</label>
                                <input type="number" class="form-control" id="edit_durasi" name="durasi" min="0">
                            </div>
                            <!-- Data Tautan Video -->
                            <div class="mb-3">
                                <label for="edit_publish_link_youtube" class="form-label">Tautan Video YouTube</label>
                                <input type="url" class="form-control" id="edit_publish_link_youtube" name="publish_link_youtube">
                            </div>
                            <!-- Data Tgl Upload YouTube -->
                            <div class="mb-3">
                                <label for="edit_tanggal_upload_youtube" class="form-label">Tanggal Upload YouTube</label>
                                <input type="date" class="form-control" id="edit_tanggal_upload_youtube" name="tanggal_upload_youtube">
                            </div>
                            <!-- Data Editor -->
                            <div class="mb-3">
                                <label for="edit_editor_id" class="form-label">Editor</label>
                                <select class="form-select" id="edit_editor_id" name="editor_id" required>
                                    <option value="">Pilih Editor</option>
                                    @foreach(\App\Models\Editor::all() as $editor)
                                    <option value="{{ $editor->id }}">{{ $editor->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editJenisKategoriSelect = document.getElementById('edit_jenis_kategori');
        const editMoocField = document.getElementById('editMoocField');

        editJenisKategoriSelect.addEventListener('change', function() {
            if (this.value === 'MOOC') {
                editMoocField.style.display = 'block';
            } else {
                editMoocField.style.display = 'none';
            }
        });
    });
</script>

<!-- Initialize DataTable after all scripts are loaded -->
<script>
    // Function to load DataTables scripts dynamically
    function loadDataTables() {
        if (typeof jQuery === 'undefined' || typeof $ === 'undefined') {
            setTimeout(loadDataTables, 100);
            return;
        }

        // Load DataTables scripts dynamically
        const scripts = [
            'https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js',
            'https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js',
            'https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js',
            'https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js',
            'https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js',
            'https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js',
            'https://cdn.datatables.net/fixedheader/3.3.2/js/dataTables.fixedHeader.min.js',
            'https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js',
            'https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js'
        ];

        let loadedCount = 0;

        scripts.forEach(function(src) {
            const script = document.createElement('script');
            script.src = src;
            script.onload = function() {
                loadedCount++;
                if (loadedCount === scripts.length) {
                    // All scripts loaded, initialize DataTable
                    initDataTable();
                }
            };
            script.onerror = function() {
                loadedCount++;
                if (loadedCount === scripts.length) {
                    // All scripts loaded (even with errors), initialize DataTable
                    initDataTable();
                }
            };
            document.head.appendChild(script);
        });
    }

    function initDataTable() {
        if (typeof $ !== 'undefined' && $.fn.DataTable) {
            $(document).ready(function() {
                // Initialize DataTable with sorting, pagination, and export features
                const table = $('#arsipTable').DataTable({
                    language: {
                        "emptyTable": "Tidak ada data yang tersedia",
                        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                        "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                        "infoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                        "lengthMenu": "Tampilkan _MENU_ entri",
                        "loadingRecords": "Sedang memuat...",
                        "processing": "Sedang memproses...",
                        "search": "Cari:",
                        "zeroRecords": "Tidak ditemukan data yang sesuai",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Selanjutnya",
                            "previous": "Sebelumnya"
                        },
                        "aria": {
                            "sortAscending": ": aktifkan untuk mengurutkan kolom ke atas",
                            "sortDescending": ": aktifkan untuk mengurutkan kolom ke bawah"
                        }
                    },
                    dom: '<"row mb-3"<"col-md-4"B><"col-md-4"l><"col-md-4"f>>' +
                        '<"row"<"col-md-12"tr>>' +
                        '<"row"<"col-md-5"i><"col-md-7"p>>',
                    buttons: [{
                            extend: 'copy',
                            text: '<i class="bi bi-clipboard"></i> Copy',
                            className: 'btn btn-sm btn-outline-primary'
                        },
                        {
                            extend: 'csv',
                            text: '<i class="bi bi-filetype-csv"></i> CSV',
                            className: 'btn btn-sm btn-outline-success'
                        },
                        {
                            extend: 'excel',
                            text: '<i class="bi bi-file-earmark-excel"></i> Excel',
                            className: 'btn btn-sm btn-outline-success'
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="bi bi-file-earmark-pdf"></i> PDF',
                            className: 'btn btn-sm btn-outline-danger',
                            orientation: 'landscape'
                        },
                        {
                            extend: 'print',
                            text: '<i class="bi bi-printer"></i> Print',
                            className: 'btn btn-sm btn-outline-secondary'
                        }
                    ],
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "Semua"]
                    ],
                    order: [
                        [0, 'asc']
                    ],
                    columnDefs: [{
                        orderable: false,
                        targets: [20] // Actions column not sortable
                    }],
                    stateSave: false, // Disable saving table state to show all data by default
                    fixedHeader: {
                        header: true,
                        footer: false
                    },
                    initComplete: function() {
                        // Filter dropdowns are already populated by PHP
                    }
                });

                // Function to populate filter dropdowns
                function populateFilterDropdowns(table) {
                    const dosenSet = new Set();
                    const fakultasSet = new Set();
                    const prodiSet = new Set();
                    const mataKuliahSet = new Set();
                    const kategoriMoocSet = new Set();
                    const studioSet = new Set();
                    const jenisKategoriSet = new Set();

                    table.rows().every(function() {
                        const data = this.data();
                        if (data[1] && data[1] !== '-') dosenSet.add(data[1]); // Dosen
                        if (data[12] && data[12] !== '-') fakultasSet.add(data[12]); // Fakultas
                        if (data[13] && data[13] !== '-') prodiSet.add(data[13]); // Prodi
                        if (data[14] && data[14] !== '-') mataKuliahSet.add(data[14]); // Mata Kuliah
                        if (data[15] && data[15] !== '-') kategoriMoocSet.add(data[15]); // Kategori MOOC
                        if (data[16] && data[16] !== '-') studioSet.add(data[16]); // Studio
                        if (data[18] && data[18] !== '-') jenisKategoriSet.add(data[18]); // Jenis Kategori
                    });

                    // Populate Dosen filter
                    const dosenSelect = $('#filterDosen');
                    Array.from(dosenSet).sort().forEach(value => {
                        dosenSelect.append(`<option value="${value}">${value}</option>`);
                    });

                    // Populate Fakultas filter
                    const fakultasSelect = $('#filterFakultas');
                    Array.from(fakultasSet).sort().forEach(value => {
                        fakultasSelect.append(`<option value="${value}">${value}</option>`);
                    });

                    // Populate Prodi filter
                    const prodiSelect = $('#filterProdi');
                    Array.from(prodiSet).sort().forEach(value => {
                        prodiSelect.append(`<option value="${value}">${value}</option>`);
                    });

                    // Populate Mata Kuliah filter
                    const mataKuliahSelect = $('#filterMataKuliah');
                    Array.from(mataKuliahSet).sort().forEach(value => {
                        mataKuliahSelect.append(`<option value="${value}">${value}</option>`);
                    });

                    // Populate Kategori MOOC filter
                    const kategoriMoocSelect = $('#filterKategoriMooc');
                    Array.from(kategoriMoocSet).sort().forEach(value => {
                        kategoriMoocSelect.append(`<option value="${value}">${value}</option>`);
                    });

                    // Populate Studio filter
                    const studioSelect = $('#filterStudio');
                    Array.from(studioSet).sort().forEach(value => {
                        studioSelect.append(`<option value="${value}">${value}</option>`);
                    });

                    // Populate Jenis Kategori filter
                    const jenisKategoriSelect = $('#filterJenisKategori');
                    Array.from(jenisKategoriSet).sort().forEach(value => {
                        jenisKategoriSelect.append(`<option value="${value}">${value}</option>`);
                    });
                }

                // Filter functionality for status
                $('.filter-status').on('click', function(e) {
                    e.preventDefault();
                    const status = $(this).data('status');

                    if (status === 'all') {
                        table.column(6).search('').draw(); // Clear filter for Progres column
                    } else if (status === 'belum') {
                        table.column(6).search('Belum').draw(); // Filter by status in Progres column
                    } else if (status === 'progres') {
                        table.column(6).search('Sedang Progres').draw(); // Filter by status in Progres column
                    } else if (status === 'selesai') {
                        table.column(6).search('Selesai').draw(); // Filter by status in Progres column
                    }

                    // Update active state
                    $('.filter-status').removeClass('active');
                    $(this).addClass('active');
                });

                // Filter functionality for keterangan
                $('.filter-keterangan').on('click', function(e) {
                    e.preventDefault();
                    const keterangan = $(this).data('keterangan');

                    if (keterangan === 'all') {
                        table.column(7).search('').draw(); // Clear filter for Keterangan column
                    } else if (keterangan === 'belum_terbit') {
                        table.column(7).search('Belum Terbit').draw(); // Filter by keterangan in Keterangan column
                    } else if (keterangan === 'sudah_terbit') {
                        table.column(7).search('Sudah Terbit').draw(); // Filter by keterangan in Keterangan column
                    }

                    // Update active state
                    $('.filter-keterangan').removeClass('active');
                    $(this).addClass('active');
                });

                // Combined filter functionality
                function applyFilters() {
                    const selectedDate = $('#filterDate').val();
                    const selectedMonth = $('#filterMonth').val();
                    const selectedYear = $('#filterYear').val();
                    const selectedDosen = $('#filterDosen').val();
                    const selectedFakultas = $('#filterFakultas').val();
                    const selectedProdi = $('#filterProdi').val();
                    const selectedMataKuliah = $('#filterMataKuliah').val();
                    const selectedKategoriMooc = $('#filterKategoriMooc').val();
                    const selectedStudio = $('#filterStudio').val();
                    const selectedJenisKategori = $('#filterJenisKategori').val();

                    // Apply column searches for individual filters
                    table.column(1).search(selectedDosen || '', false, false); // Dosen
                    table.column(12).search(selectedFakultas || '', false, false); // Fakultas
                    table.column(13).search(selectedProdi || '', false, false); // Prodi
                    table.column(14).search(selectedMataKuliah || '', false, false); // Mata Kuliah
                    table.column(15).search(selectedKategoriMooc || '', false, false); // Kategori MOOC
                    table.column(16).search(selectedStudio || '', false, false); // Studio
                    table.column(18).search(selectedJenisKategori || '', false, false); // Jenis Kategori

                    // Handle date filters with column search
                    let dateSearch = '';
                    let dateRegex = false;
                    if (selectedDate) {
                        const date = new Date(selectedDate);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0');
                        const year = date.getFullYear();
                        dateSearch = `${day}/${month}/${year}`;
                        dateRegex = false;
                    } else if (selectedMonth && selectedYear) {
                        dateSearch = `/${selectedMonth}/${selectedYear}$`;
                        dateRegex = true;
                    } else if (selectedMonth) {
                        dateSearch = `/${selectedMonth}/`;
                        dateRegex = true;
                    } else if (selectedYear) {
                        dateSearch = `/${selectedYear}$`;
                        dateRegex = true;
                    }
                    table.column(10).search(dateSearch, dateRegex, false); // Tgl Upload YouTube

                    table.draw();
                }

                // Event listeners for all filters
                $('#filterDate, #filterMonth, #filterYear, #filterDosen, #filterFakultas, #filterProdi, #filterMataKuliah, #filterKategoriMooc, #filterStudio, #filterJenisKategori').on('change', function() {
                    applyFilters();
                });

                // Clear filters button
                $('#clearFilters').on('click', function() {
                    $('#filterDate').val('');
                    $('#filterMonth').val('');
                    $('#filterYear').val('');
                    $('#filterDosen').val('');
                    $('#filterFakultas').val('');
                    $('#filterProdi').val('');
                    $('#filterMataKuliah').val('');
                    $('#filterKategoriMooc').val('');
                    $('#filterStudio').val('');
                    $('#filterJenisKategori').val('');
                    $('.filter-status').removeClass('active');
                    $('.filter-keterangan').removeClass('active');
                    table.search('').columns().search('').draw();
                });
            });
        } else {
            // Retry initialization
            setTimeout(initDataTable, 500);
        }
    }

    // Start loading DataTables when page is fully loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', loadDataTables);
    } else {
        loadDataTables();
    }

    function showDetail(button) {
        // Populate modal with item data from data attributes
        document.getElementById('detailDosen').textContent = button.getAttribute('data-dosen');
        document.getElementById('detailFakultas').textContent = button.getAttribute('data-fakultas');
        document.getElementById('detailProdi').textContent = button.getAttribute('data-prodi');
        document.getElementById('detailMataKuliah').textContent = button.getAttribute('data-mata-kuliah');
        document.getElementById('detailKategoriMooc').textContent = button.getAttribute('data-kategori-mooc');
        document.getElementById('detailJudulCourse').textContent = button.getAttribute('data-judul-course');
        document.getElementById('detailStudio').textContent = button.getAttribute('data-studio');
        document.getElementById('detailTanggalShooting').textContent = button.getAttribute('data-tanggal-shooting');
        document.getElementById('detailWaktu').textContent = button.getAttribute('data-waktu');
        document.getElementById('detailJenisKategori').textContent = button.getAttribute('data-jenis-kategori');
        document.getElementById('detailTargetUpload').textContent = button.getAttribute('data-target-upload');
        document.getElementById('detailPersentase').textContent = button.getAttribute('data-persentase') + '%';
        document.getElementById('detailProgres').textContent = button.getAttribute('data-progres');
        document.getElementById('detailKeterangan').textContent = button.getAttribute('data-keterangan');
        document.getElementById('detailDurasi').textContent = button.getAttribute('data-durasi');
        document.getElementById('detailTautanVideo').innerHTML = button.getAttribute('data-publish-link') ? `<a href="${button.getAttribute('data-publish-link')}" target="_blank">Lihat Video</a>` : '-';
        document.getElementById('detailTglUploadYoutube').textContent = button.getAttribute('data-tanggal-upload-youtube');
        document.getElementById('detailEditor').textContent = button.getAttribute('data-editor');
        document.getElementById('detailStatus').textContent = button.getAttribute('data-status');

        // Show modal using Bootstrap 5 syntax
        if (typeof bootstrap !== 'undefined') {
            const modal = new bootstrap.Modal(document.getElementById('detailModal'));
            modal.show();
        }
    }

    function editArsip(id) {
        fetch(`/arsip/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                const progress = data.progress;
                const jadwalBooking = data.jadwal_booking;

                // Populate form fields with existing data
                document.getElementById('edit_dosen_id').value = jadwalBooking?.dosen_id || '';
                document.getElementById('edit_fakultas_id').value = jadwalBooking?.dosen?.fakultas?.id || '';
                document.getElementById('edit_prodi_id').value = jadwalBooking?.dosen?.prodi?.id || '';
                document.getElementById('edit_mata_kuliah_id').value = jadwalBooking?.mata_kuliah_id || '';
                document.getElementById('edit_judul_course').value = jadwalBooking?.judul_course || '';
                document.getElementById('edit_kategori_mooc').value = jadwalBooking?.kategori_mooc || '';
                document.getElementById('edit_studio_id').value = jadwalBooking?.studio_id || '';
                document.getElementById('edit_tanggal_shooting').value = jadwalBooking?.tanggal || '';
                const jamParts = jadwalBooking?.jam ? jadwalBooking.jam.split(' - ') : ['', ''];
                document.getElementById('edit_jam_mulai').value = jamParts[0] || '';
                document.getElementById('edit_jam_selesai').value = jamParts[1] || '';
                document.getElementById('edit_jenis_kategori').value = jadwalBooking?.jenis_kategori || '';
                document.getElementById('edit_target_upload').value = progress.target_upload || '';
                document.getElementById('edit_persentase').value = progress.persentase || '';
                document.getElementById('edit_progres').value = progress.progres || '';
                document.getElementById('edit_keterangan').value = progress.keterangan || '';
                document.getElementById('edit_durasi').value = progress.durasi || '';
                document.getElementById('edit_publish_link_youtube').value = progress.publish_link_youtube || '';
                document.getElementById('edit_tanggal_upload_youtube').value = progress.tanggal_upload_youtube || '';
                document.getElementById('edit_editor_id').value = progress.editor_id || '';

                // Handle MOOC field visibility based on jenis_kategori
                const jenisKategori = jadwalBooking?.jenis_kategori;
                const moocField = document.getElementById('editMoocField');
                if (jenisKategori === 'MOOC') {
                    moocField.style.display = 'block';
                } else {
                    moocField.style.display = 'none';
                }

                // Set form action
                document.getElementById('editArsipForm').action = `/arsip/${id}`;

                // Show modal
                if (typeof bootstrap !== 'undefined') {
                    const modal = new bootstrap.Modal(document.getElementById('editArsipModal'));
                    modal.show();
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    }
</script>