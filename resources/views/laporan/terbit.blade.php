@extends('layouts.admin')

@section('content')

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
        <h1>Laporan Terbit</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('laporan.index') }}">Laporan</a></li>
                <li class="breadcrumb-item active">Terbit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card p-4">
        <div class="d-flex justify-content-center align-items-center mb-3">
            <div>
                <h4 class="text-center fw-bold">UNIVERSITAS TEKNOKRAT INDONESIA</h4>
                <h5 class="text-center mb-4"><br>VIDEO DOSEN</h5>
            </div>
        </div>

        <!-- Filter Form for Dosen Table -->
        <form method="GET" action="{{ route('laporan.terbit') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="dosen_name" class="form-label">Nama Dosen</label>
                    <select class="form-control" id="dosen_name" name="dosen_name">
                        <option value="">Pilih Nama Dosen</option>
                        @foreach($dosens as $dosen)
                        <option value="{{ $dosen->nama_dosen }}" {{ (isset($filterDosen['dosen_name']) && $filterDosen['dosen_name'] == $dosen->nama_dosen) ? 'selected' : '' }}>{{ $dosen->nama_dosen }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="upload_year" class="form-label">Tahun Upload</label>
                    <select class="form-control" id="upload_year" name="upload_year">
                        <option value="">Pilih Tahun</option>
                        @php
                        $currentYear = date('Y');
                        for ($year = $currentYear; $year >= $currentYear - 10; $year--) {
                        echo "<option value='$year' " . ((isset($filterDosen['upload_year']) && $filterDosen['upload_year'] == $year) ? 'selected' : '') . ">$year</option>";
                        }
                        @endphp
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="upload_month" class="form-label">Bulan Upload</label>
                    <select class="form-control" id="upload_month" name="upload_month">
                        <option value="">Pilih Bulan</option>
                        <option value="01" {{ (isset($filterDosen['upload_month']) && $filterDosen['upload_month'] == '01') ? 'selected' : '' }}>Januari</option>
                        <option value="02" {{ (isset($filterDosen['upload_month']) && $filterDosen['upload_month'] == '02') ? 'selected' : '' }}>Februari</option>
                        <option value="03" {{ (isset($filterDosen['upload_month']) && $filterDosen['upload_month'] == '03') ? 'selected' : '' }}>Maret</option>
                        <option value="04" {{ (isset($filterDosen['upload_month']) && $filterDosen['upload_month'] == '04') ? 'selected' : '' }}>April</option>
                        <option value="05" {{ (isset($filterDosen['upload_month']) && $filterDosen['upload_month'] == '05') ? 'selected' : '' }}>Mei</option>
                        <option value="06" {{ (isset($filterDosen['upload_month']) && $filterDosen['upload_month'] == '06') ? 'selected' : '' }}>Juni</option>
                        <option value="07" {{ (isset($filterDosen['upload_month']) && $filterDosen['upload_month'] == '07') ? 'selected' : '' }}>Juli</option>
                        <option value="08" {{ (isset($filterDosen['upload_month']) && $filterDosen['upload_month'] == '08') ? 'selected' : '' }}>Agustus</option>
                        <option value="09" {{ (isset($filterDosen['upload_month']) && $filterDosen['upload_month'] == '09') ? 'selected' : '' }}>September</option>
                        <option value="10" {{ (isset($filterDosen['upload_month']) && $filterDosen['upload_month'] == '10') ? 'selected' : '' }}>Oktober</option>
                        <option value="11" {{ (isset($filterDosen['upload_month']) && $filterDosen['upload_month'] == '11') ? 'selected' : '' }}>November</option>
                        <option value="12" {{ (isset($filterDosen['upload_month']) && $filterDosen['upload_month'] == '12') ? 'selected' : '' }}>Desember</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('laporan.terbit') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <!-- Export Buttons Row -->
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="dt-buttons btn-group">
                    <button class="btn btn-sm btn-outline-primary" onclick="exportTable('copy')">
                        <i class="bi bi-clipboard"></i> Copy
                    </button>
                    <button class="btn btn-sm btn-outline-success" onclick="exportTable('csv')">
                        <i class="bi bi-filetype-csv"></i> CSV
                    </button>
                    <button class="btn btn-sm btn-outline-success" onclick="exportTable('excel')">
                        <i class="bi bi-file-earmark-excel"></i> Excel
                    </button>
                    <button class="btn btn-sm btn-outline-danger" onclick="exportTable('pdf')">
                        <i class="bi bi-file-earmark-pdf"></i> PDF
                    </button>
                    <button class="btn btn-sm btn-outline-secondary" onclick="exportTable('print')">
                        <i class="bi bi-printer"></i> Print
                    </button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table id="terbitTable" class="table table-sm align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Dosen</th>
                        <th>Judul Video</th>
                        <th>Link Video YouTube</th>
                        <th>Durasi</th>
                        <th>Tanggal Upload YouTube</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($terbitData as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
                        <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
                        <td class="text-center">
                            @if($item->publish_link_youtube)
                            <a href="{{ $item->publish_link_youtube }}" target="_blank">{{ $item->publish_link_youtube }}</a>
                            @else
                            -
                            @endif
                        </td>
                        <td class="text-center">{{ $item->durasi ?? '-' }}</td>
                        <td class="text-center">{{ $item->tanggal_upload_youtube ? \Carbon\Carbon::parse($item->tanggal_upload_youtube)->format('d/m/Y') : '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="6">Tidak ada data laporan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</main>



<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.3.2/css/fixedHeader.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">

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
                const table = $('#terbitTable').DataTable({
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
                    dom: '<"row mb-3"<"col-md-6"l><"col-md-6"f>>' +
                        '<"row"<"col-md-12"tr>>' +
                        '<"row"<"col-md-5"i><"col-md-7"p>>',
                    buttons: [{
                            extend: 'copy',
                            text: '<i class="bi bi-clipboard"></i> Copy',
                            className: 'btn btn-sm btn-outline-primary',
                            exportOptions: {
                                modifier: {
                                    search: 'applied',
                                    order: 'applied',
                                    page: 'current'
                                }
                            }
                        },
                        {
                            extend: 'csv',
                            text: '<i class="bi bi-filetype-csv"></i> CSV',
                            className: 'btn btn-sm btn-outline-success',
                            exportOptions: {
                                modifier: {
                                    search: 'applied',
                                    order: 'applied',
                                    page: 'current'
                                }
                            }
                        },
                        {
                            extend: 'excel',
                            text: '<i class="bi bi-file-earmark-excel"></i> Excel',
                            className: 'btn btn-sm btn-outline-success',
                            exportOptions: {
                                modifier: {
                                    search: 'applied',
                                    order: 'applied',
                                    page: 'current'
                                }
                            }
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="bi bi-file-earmark-pdf"></i> PDF',
                            className: 'btn btn-sm btn-outline-danger',
                            exportOptions: {
                                modifier: {
                                    search: 'applied',
                                    order: 'applied',
                                    page: 'current'
                                }
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="bi bi-printer"></i> Print',
                            className: 'btn btn-sm btn-outline-secondary',
                            exportOptions: {
                                modifier: {
                                    search: 'applied',
                                    order: 'applied',
                                    page: 'current'
                                }
                            }
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
                        targets: [] // No non-sortable columns in this table
                    }],
                    stateSave: false, // Disable saving table state to show all data by default
                    fixedHeader: {
                        header: true,
                        footer: false
                    }
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

    function exportTable(type) {
        const table = $('#terbitTable').DataTable();
        switch (type) {
            case 'copy':
                table.button('.buttons-copy').trigger();
                break;
            case 'csv':
                table.button('.buttons-csv').trigger();
                break;
            case 'excel':
                table.button('.buttons-excel').trigger();
                break;
            case 'pdf':
                table.button('.buttons-pdf').trigger();
                break;
            case 'print':
                table.button('.buttons-print').trigger();
                break;
        }
    }
</script>