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
                                            {{ $item->jadwalBooking->user->fakultas->nama_fakultas ?? '-' }}
                                        </td>

                                        {{-- Prodi --}}
                                        <td class="text-center">
                                            {{ $item->jadwalBooking->user->prodi->nama_prodi ?? '-' }}
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
                                        <td colspan="21" class="text-center">Tidak ada data arsip progress</td>
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
                            className: 'btn btn-sm btn-outline-danger'
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
                    }
                });

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

                // Filter functionality for date, month, and year
                function applyDateFilters() {
                    const selectedDate = $('#filterDate').val();
                    const selectedMonth = $('#filterMonth').val();
                    const selectedYear = $('#filterYear').val();

                    // If no filters are selected, clear all filters
                    if (!selectedDate && !selectedMonth && !selectedYear) {
                        table.search('').columns().search('').draw();
                        return;
                    }

                    // Apply custom search function
                    table.search(function(searchData, data, dataIndex) {
                        const dateValue = data[10]; // Tgl Upload YouTube column

                        if (!dateValue || dateValue === '-') {
                            return false;
                        }

                        // Parse the date from d/m/Y format
                        const parts = dateValue.split('/');
                        if (parts.length !== 3) {
                            return false;
                        }

                        const day = parseInt(parts[0], 10);
                        const month = parseInt(parts[1], 10);
                        const year = parseInt(parts[2], 10);

                        // Check date filter
                        if (selectedDate) {
                            const filterDate = new Date(selectedDate);
                            const rowDate = new Date(year, month - 1, day);
                            if (rowDate.toDateString() !== filterDate.toDateString()) {
                                return false;
                            }
                        }

                        // Check month filter
                        if (selectedMonth && month !== parseInt(selectedMonth, 10)) {
                            return false;
                        }

                        // Check year filter
                        if (selectedYear && year !== parseInt(selectedYear, 10)) {
                            return false;
                        }

                        return true;
                    }).draw();
                }

                // Event listeners for date filters
                $('#filterDate, #filterMonth, #filterYear').on('change', function() {
                    applyDateFilters();
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