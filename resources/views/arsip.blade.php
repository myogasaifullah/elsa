@extends('layout.header')

@section('title', 'Arsip')

@include('layout.sidebar')

<style>
    /* DataTables Buttons - Transparent Style */
.dt-buttons .btn {
    background-color: transparent !important;
    border: 1px solid transparent;
    color: #0d6efd; /* biru default bootstrap */
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

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0">Tabel Arsip </h5>

                            <!-- Filter Dropdown -->
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
                                        <th>Action</th>
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

                                        {{-- Action --}}
                                        <td class="text-center">
                                            {{-- Detail --}}
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-info"
                                                title="Detail"
                                                aria-label="Detail"
                                                data-toggle="modal"
                                                data-target="#detailModal"
                                                onclick="showDetail(this)"

                                                data-dosen="{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}"
                                                data-fakultas="{{ $item->jadwalBooking->user->fakultas->nama_fakultas ?? '-' }}"
                                                data-prodi="{{ $item->jadwalBooking->user->prodi->nama_prodi ?? '-' }}"
                                                data-mata-kuliah="{{ $item->jadwalBooking->nama_mata_kuliah ?? '-' }}"
                                                data-kategori-mooc="{{ $item->jadwalBooking->kategori_mooc ?? '-' }}"
                                                data-judul-course="{{ $item->jadwalBooking->judul_course ?? '-' }}"
                                                data-studio="{{ $item->jadwalBooking->studio->nama_studio ?? '-' }}"
                                                data-tanggal-shooting="{{ $item->jadwalBooking->tanggal ?? '-' }}"
                                                data-waktu="{{ $item->jadwalBooking->jam ?? '-' }}"
                                                data-jenis-kategori="{{ $item->jadwalBooking->jenis_kategori ?? '-' }}"
                                                data-target-upload="{{ $item->target_upload ? \Carbon\Carbon::parse($item->target_upload)->format('d/m/Y') : '-' }}"
                                                data-persentase="{{ $item->persentase }}"
                                                data-progres="{{ ucfirst($item->progres) }}"
                                                data-keterangan="{{ ucfirst(str_replace('_', ' ', $item->keterangan)) }}"
                                                data-durasi="{{ $item->durasi ?? '-' }}"
                                                data-publish-link="{{ $item->publish_link_youtube ?? '' }}"
                                                data-tanggal-upload-youtube="{{ $item->tanggal_upload_youtube ? \Carbon\Carbon::parse($item->tanggal_upload_youtube)->format('d/m/Y') : '-' }}"
                                                data-editor="{{ $item->editor->nama ?? '-' }}"
                                                data-status="Sudah Shooting">
                                                <i class="bi bi-info-circle"></i>
                                            </button>
                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="13" class="text-center">Tidak ada data arsip progress</td>
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
                        targets: [12] // Action column not sortable
                    }],
                    stateSave: true, // Save table state in localStorage
                    stateDuration: 60 * 60 * 24 * 7, // Save for 7 days
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
                    } else {
                        table.column(6).search(status).draw(); // Filter by status in Progres column
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
                    } else {
                        table.column(7).search(keterangan).draw(); // Filter by keterangan in Keterangan column
                    }

                    // Update active state
                    $('.filter-keterangan').removeClass('active');
                    $(this).addClass('active');
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
</script>