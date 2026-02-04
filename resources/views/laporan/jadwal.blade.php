@extends('layout.header')

@section('title', 'Laporan Jadwal')

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
    <h1>Laporan Jadwal</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('laporan.index') }}">Laporan</a></li>
        <li class="breadcrumb-item active">Jadwal</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h5 class="card-title text-center">LAPORAN JADWAL BOOKING</h5>
          <p class="text-center mb-1">UNIVERSITAS TEKNOKRAT INDONESIA</p>
        </div>
        <div>
          <button id="exportAllBtn" class="btn btn-danger btn-sm me-2">PDF (Semua)</button>
          <button id="exportAllExcelBtn" class="btn btn-success btn-sm">Excel (Semua)</button>
        </div>
      </div>

      <!-- Filter Form for Jadwal Table -->
      <form id="filterForm" class="mb-4">
        <div class="row">
          <div class="col-md-2">
            <label for="filter_dosen" class="form-label">Dosen</label>
            <select class="form-control" id="filter_dosen" name="filter_dosen">
              <option value="">Semua</option>
              @foreach($uniqueDosen as $dosen)
              <option value="{{ $dosen }}">{{ $dosen }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            <label for="filter_jenis_kategori" class="form-label">Jenis Kategori</label>
            <select class="form-control" id="filter_jenis_kategori" name="filter_jenis_kategori">
              <option value="">Semua</option>
              <option value="E-Learning">E-Learning</option>
              <option value="MOOC">MOOC</option>
              <option value="Lomba">Lomba</option>
              <option value="Marketing">Marketing</option>
            </select>
          </div>
          <div class="col-md-2">
            <label for="filter_studio" class="form-label">Studio</label>
            <select class="form-control" id="filter_studio" name="filter_studio">
              <option value="">Semua</option>
              @foreach($studios as $studio)
              <option value="{{ $studio->nama_studio }}">{{ $studio->nama_studio }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            <label for="filter_tahun" class="form-label">Tahun</label>
            <select class="form-control" id="filter_tahun" name="filter_tahun">
              <option value="">Semua</option>
              @foreach($uniqueYears as $year)
              <option value="{{ $year }}">{{ $year }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            <label for="filter_bulan" class="form-label">Bulan</label>
            <select class="form-control" id="filter_bulan" name="filter_bulan">
              <option value="">Semua</option>
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
          <div class="col-md-2">
            <label for="per_page" class="form-label">Entri per Halaman</label>
            <select class="form-control" id="per_page" name="per_page">
              <option value="5" {{ request('per_page') == '5' ? 'selected' : '' }}>5</option>
              <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
              <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25</option>
              <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
            </select>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-12 d-flex align-items-end">
            <small class="text-muted me-3">Filter akan diterapkan secara otomatis saat Anda mengubah nilai input.</small>
            <a href="#" id="clearFilters" class="text-primary">Bersihkan filter</a>
          </div>
        </div>
      </form>

      @php
      $currentMonth = now()->format('F Y');
      $weeks = [
      1 => 'MINGGU KE-1',
      2 => 'MINGGU KE-2',
      3 => 'MINGGU KE-3',
      4 => 'MINGGU KE-4'
      ];
      @endphp

      <p class="text-center fw-bold">{{ $currentMonth }}</p>

      @if($groupedJadwal->isEmpty())
      <div class="text-center">
        <p>Tidak ada jadwal booking untuk ditampilkan</p>
      </div>
      @else
      @foreach($groupedJadwal as $tanggal => $jadwalHarian)
      @php
      $date = \Carbon\Carbon::parse($tanggal);
      $dayName = $date->translatedFormat('l');
      $formattedDate = $date->translatedFormat('d F Y');
      $weekNumber = ceil($date->day / 7);
      @endphp

      <h6 class="mt-4">{{ $weeks[$weekNumber] ?? 'MINGGU KE-' . $weekNumber }}</h6>
      <h6 class="mt-3">{{ $dayName }}, {{ $formattedDate }}</h6>

      <div class="table-responsive">
        <table class="table table-bordered jadwal-table" data-tanggal="{{ $tanggal }}">
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>Dosen</th>
              <th>Judul Course</th>
              <th>Jenis Kategori</th>
              <th>Waktu</th>
              <th>Studio</th>
            </tr>
          </thead>
          <tbody>
            @forelse($jadwalHarian as $index => $jadwal)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $jadwal->dosen->nama_dosen ?? '-' }}</td>
              <td>{{ $jadwal->judul_course ?? '-' }}</td>
              <td>{{ $jadwal->jenis_kategori ?? '-' }}</td>
              <td>{{ $jadwal->jam ?? '-' }}</td>
              <td>{{ $jadwal->studio->nama_studio ?? '-' }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center">Tidak ada jadwal untuk hari ini</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      @endforeach
      @endif

    </div>
  </div>

</main>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.3.2/css/fixedHeader.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">

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
        // Initialize DataTable for each jadwal table
        $('.jadwal-table').each(function() {
          const table = $(this).DataTable({
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
                className: 'btn btn-sm btn-outline-primary',
                exportOptions: {
                  rows: ':visible'
                }
              },
              {
                extend: 'csv',
                text: '<i class="bi bi-filetype-csv"></i> CSV',
                className: 'btn btn-sm btn-outline-success',
                exportOptions: {
                  rows: ':visible'
                }
              },
              {
                extend: 'excel',
                text: '<i class="bi bi-file-earmark-excel"></i> Excel',
                className: 'btn btn-sm btn-outline-success',
                exportOptions: {
                  rows: ':visible'
                }
              },
              {
                extend: 'pdf',
                text: '<i class="bi bi-file-earmark-pdf"></i> PDF',
                className: 'btn btn-sm btn-outline-danger',
                exportOptions: {
                  rows: ':visible'
                },
                orientation: 'portrait'
              },
              {
                extend: 'print',
                text: '<i class="bi bi-printer"></i> Print',
                className: 'btn btn-sm btn-outline-secondary',
                exportOptions: {
                  rows: ':visible'
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
              targets: [] // No non-sortable columns
            }],
            stateSave: false, // Disable saving table state to show all data by default
            fixedHeader: {
              header: true,
              footer: false
            }
          });
        });

        // Custom filtering function for jadwal tables
        function applyFilters() {
          const dosen = $('#filter_dosen').val();
          const jenisKategori = $('#filter_jenis_kategori').val();
          const studio = $('#filter_studio').val();
          const tahun = $('#filter_tahun').val();
          const bulan = $('#filter_bulan').val();

          // Apply filter to all tables
          $('.jadwal-table').each(function() {
            const table = $(this).DataTable();
            const tableTanggal = $(this).data('tanggal');

            table.rows().every(function() {
              const data = this.data();
              let show = true;

              // Filter by dosen name (column 1: Dosen)
              if (dosen && data[1] !== dosen) {
                show = false;
              }

              // Filter by jenis kategori (column 3: Jenis Kategori)
              if (jenisKategori && data[3] !== jenisKategori) {
                show = false;
              }

              // Filter by studio (column 5: Studio)
              if (studio && data[5] !== studio) {
                show = false;
              }

              // Filter by tahun and bulan based on table date
              if ((tahun || bulan) && show && tableTanggal) {
                const tableDate = new Date(tableTanggal);
                const tableYear = tableDate.getFullYear().toString();
                const tableMonth = (tableDate.getMonth() + 1).toString().padStart(2, '0');

                if (tahun && tableYear !== tahun) {
                  show = false;
                }
                if (bulan && tableMonth !== bulan) {
                  show = false;
                }
              }

              this.node().style.display = show ? '' : 'none';
            });

            table.draw();
          });
        }

        // Filter form submission
        $('#filterForm').on('submit', function(e) {
          e.preventDefault();
          applyFilters();
        });

        // Clear filters
        $('#clearFilters').on('click', function(e) {
          e.preventDefault();
          $('#filter_dosen').val('');
          $('#filter_jenis_kategori').val('');
          $('#filter_studio').val('');
          $('#filter_tahun').val('');
          $('#filter_bulan').val('');

          // Reset all tables
          $('.jadwal-table').each(function() {
            const table = $(this).DataTable();
            table.rows().every(function() {
              this.node().style.display = '';
            });
            table.draw();
          });
        });

        // Real-time filtering on input change
        $('#filter_dosen, #filter_jenis_kategori, #filter_studio, #filter_tahun, #filter_bulan').on('input change', function() {
          applyFilters();
        });

        // Export all button handlers - export all visible data from all tables
        $('#exportAllBtn').on('click', function() {
          // Collect all visible data from all tables
          let allData = [];
          let headers = ['Tanggal', 'No', 'Dosen', 'Judul Course', 'Jenis Kategori', 'Waktu', 'Studio'];

          $('.jadwal-table').each(function() {
            const table = $(this).DataTable();
            const tableTanggal = $(this).data('tanggal');

            // Format the date for export
            const date = new Date(tableTanggal);
            const formattedDate = date.toLocaleDateString('id-ID', {
              day: '2-digit',
              month: 'long',
              year: 'numeric'
            });

            table.rows({
              filter: 'applied'
            }).every(function() {
              const data = this.data();
              if (this.node().style.display !== 'none') {
                allData.push([
                  formattedDate, // Tanggal
                  data[0], // No
                  data[1], // Dosen
                  data[2], // Judul Course
                  data[3], // Jenis Kategori
                  data[4], // Waktu
                  data[5] // Studio
                ]);
              }
            });
          });

          // Sort data by date
          allData.sort((a, b) => {
            const dateA = new Date(a[0].split(' ').reverse().join('-'));
            const dateB = new Date(b[0].split(' ').reverse().join('-'));
            return dateA - dateB;
          });

          // Create a temporary table for export
          const tempTable = $('<table>').append(
            $('<thead>').append(
              $('<tr>').append(
                headers.map(header => $('<th>').text(header))
              )
            ),
            $('<tbody>').append(
              allData.map(row => $('<tr>').append(
                row.map(cell => $('<td>').text(cell))
              ))
            )
          );

          // Use DataTables export on the temporary table
          const exportTable = tempTable.DataTable({
            dom: 'B',
            buttons: [{
              extend: 'pdf',
              text: 'PDF',
              orientation: 'portrait',
              title: 'Laporan Jadwal Booking - Universitas Teknokrat Indonesia'
            }]
          });

          exportTable.button(0).trigger();
        });

        $('#exportAllExcelBtn').on('click', function() {
          // Similar logic for Excel export
          let allData = [];
          let headers = ['Tanggal', 'No', 'Dosen', 'Judul Course', 'Jenis Kategori', 'Waktu', 'Studio'];

          $('.jadwal-table').each(function() {
            const table = $(this).DataTable();
            const tableTanggal = $(this).data('tanggal');

            // Format the date for export
            const date = new Date(tableTanggal);
            const formattedDate = date.toLocaleDateString('id-ID', {
              day: '2-digit',
              month: 'long',
              year: 'numeric'
            });

            table.rows({
              filter: 'applied'
            }).every(function() {
              const data = this.data();
              if (this.node().style.display !== 'none') {
                allData.push([
                  formattedDate, // Tanggal
                  data[0], // No
                  data[1], // Dosen
                  data[2], // Judul Course
                  data[3], // Jenis Kategori
                  data[4], // Waktu
                  data[5] // Studio
                ]);
              }
            });
          });

          // Sort data by date
          allData.sort((a, b) => {
            const dateA = new Date(a[0].split(' ').reverse().join('-'));
            const dateB = new Date(b[0].split(' ').reverse().join('-'));
            return dateA - dateB;
          });

          // Create a temporary table for export
          const tempTable = $('<table>').append(
            $('<thead>').append(
              $('<tr>').append(
                headers.map(header => $('<th>').text(header))
              )
            ),
            $('<tbody>').append(
              allData.map(row => $('<tr>').append(
                row.map(cell => $('<td>').text(cell))
              ))
            )
          );

          // Use DataTables export on the temporary table
          const exportTable = tempTable.DataTable({
            dom: 'B',
            buttons: [{
              extend: 'excel',
              text: 'Excel',
              title: 'Laporan Jadwal Booking'
            }]
          });

          exportTable.button(0).trigger();
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
</script>