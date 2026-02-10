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

  <!-- Tabel Progres Editor -->
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="card-title">Tabel Progres Editor</h5>
      </div>

      <!-- Filter Form for Progress Table -->
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
            <label for="filter_fakultas" class="form-label">Fakultas</label>
            <select class="form-control" id="filter_fakultas" name="filter_fakultas">
              <option value="">Semua</option>
              @foreach($uniqueFakultas as $fakultas)
              <option value="{{ $fakultas }}">{{ $fakultas }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            <label for="filter_matakuliah" class="form-label">Mata Kuliah</label>
            <select class="form-control" id="filter_matakuliah" name="filter_matakuliah">
              <option value="">Semua</option>
              @foreach($uniqueMataKuliah as $matakuliah)
              <option value="{{ $matakuliah }}">{{ $matakuliah }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            <label for="filter_lokasi" class="form-label">Lokasi</label>
            <select class="form-control" id="filter_lokasi" name="filter_lokasi">
              <option value="">Semua</option>
              @foreach($uniqueLokasi as $lokasi)
              <option value="{{ $lokasi }}">{{ $lokasi }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            <label for="filter_jenis_shooting" class="form-label">Jenis Shooting</label>
            <select class="form-control" id="filter_jenis_shooting" name="filter_jenis_shooting">
              <option value="">Semua</option>
              <option value="E-Learning">E-Learning</option>
              <option value="MOOC">MOOC</option>
              <option value="Lomba">Lomba</option>
              <option value="Marketing">Marketing</option>
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
        </div>
        <div class="row mt-3">
          <div class="col-md-2">
            <label for="filter_bulan" class="form-label">Bulan</label>
            <select class="form-control" id="filter_bulan" name="filter_bulan">
              <option value="">Semua</option>
              @foreach($uniqueMonths as $month)
              <option value="{{ $month }}">{{ \Carbon\Carbon::create()->month(intval($month))->format('F') }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            <label for="filter_editor" class="form-label">Editor</label>
            <select class="form-control" id="filter_editor" name="filter_editor">
              <option value="">Semua</option>
              @foreach($uniqueEditor as $editor)
              <option value="{{ $editor }}">{{ $editor }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            <label for="filter_progres" class="form-label">Progres</label>
            <select class="form-control" id="filter_progres" name="filter_progres">
              <option value="">Semua</option>
              <option value="Belum">Belum</option>
              <option value="Progres">Progres</option>
              <option value="Selesai">Selesai</option>
            </select>
          </div>
          <div class="col-md-4 d-flex align-items-end">
            <small class="text-muted me-3">Filter akan diterapkan secara otomatis saat Anda mengubah nilai input.</small>
            <a href="#" id="clearFilters" class="text-primary">Bersihkan filter</a>
          </div>
        </div>
      </form>

      <div class="table-responsive">
        <table id="editorTable" class="table table-sm align-middle">
          <thead class="table-light text-center">
            <tr>
              <th>No</th>
              <th>Dosen</th>
              <th>FAK</th>
              <th>Mata Kuliah / Tema</th>
              <th>Judul Course</th>
              <th>Lokasi</th>
              <th>Tanggal Shooting</th>
              <th>Jenis Shooting</th>
              <th>Target Upload</th>
              <th>Editor</th>
              <th>Progres</th>
              <th>Durasi (Menit)</th>
            </tr>
          </thead>
          <tbody>
            @forelse($progress as $index => $item)
            <tr>
              <td class="text-center">{{ $index + 1 }}</td>
              <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
              <td>{{ $item->jadwalBooking->user->fakultas->nama_fakultas ?? '-' }}</td>
              <td>{{ $item->jadwalBooking->nama_mata_kuliah ?? '-' }}</td>
              <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
              <td>{{ $item->jadwalBooking->studio->nama_studio ??  '-' }}</td>
              <td>{{ $item->jadwalBooking->tanggal ? \Carbon\Carbon::parse($item->jadwalBooking->tanggal)->format('d F Y') : '-' }}</td>
              <td>{{ $item->jadwalBooking->jenis_kategori ?? '-' }}</td>
              <td>{{ $item->target_upload ? \Carbon\Carbon::parse($item->target_upload)->format('d F Y') : '-' }}</td>
              <td>{{ $item->editor->nama ?? '-' }}</td>
              <td class="text-center">
                @if($item->progres == 'Belum')
                <span class="badge bg-secondary">Belum</span>
                @elseif($item->progres == 'Progres')
                <span class="badge bg-warning text-dark">Progres</span>
                @elseif($item->progres == 'Selesai')
                <span class="badge bg-success">Selesai</span>
                @else
                <span class="badge bg-info">{{ $item->progres }}</span>
                @endif
              </td>
              <td class="text-center">{{ $item->durasi ?? '-' }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="12" class="text-center">Tidak ada data progres</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
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
        // Initialize DataTable with sorting, pagination, and export features
        const table = $('#editorTable').DataTable({
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
              orientation: 'landscape'
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

        // Custom filtering function
        function applyFilters() {
          const dosen = $('#filter_dosen').val();
          const fakultas = $('#filter_fakultas').val();
          const matakuliah = $('#filter_matakuliah').val();
          const lokasi = $('#filter_lokasi').val();
          const jenisShooting = $('#filter_jenis_shooting').val();
          const tahun = $('#filter_tahun').val();
          const bulan = $('#filter_bulan').val();
          const editor = $('#filter_editor').val();
          const progres = $('#filter_progres').val();

          table.rows().every(function() {
            const data = this.data();
            let show = true;

            // Filter by dosen name (column 1: Dosen)
            if (dosen && data[1] !== dosen) {
              show = false;
            }

            // Filter by fakultas (column 2: FAK)
            if (fakultas && data[2] !== fakultas) {
              show = false;
            }

            // Filter by mata kuliah (column 3: Mata Kuliah / Tema)
            if (matakuliah && data[3] !== matakuliah) {
              show = false;
            }

            // Filter by lokasi (column 5: Lokasi)
            if (lokasi && data[5] !== lokasi) {
              show = false;
            }

            // Filter by jenis shooting (column 7: Jenis Shooting)
            if (jenisShooting && data[7] !== jenisShooting) {
              show = false;
            }

            // Filter by tahun and bulan (column 8: Target Upload)
            if ((tahun || bulan)) {
              const uploadDate = data[8];
              if (uploadDate !== '-') {
                const dateParts = uploadDate.split(' ');
                if (dateParts.length >= 3) {
                  const day = dateParts[0];
                  const month = dateParts[1];
                  const year = dateParts[2];
                  const monthMap = {
                    'Januari': '01',
                    'Februari': '02',
                    'Maret': '03',
                    'April': '04',
                    'Mei': '05',
                    'Juni': '06',
                    'Juli': '07',
                    'Agustus': '08',
                    'September': '09',
                    'Oktober': '10',
                    'November': '11',
                    'Desember': '12'
                  };
                  const rowYear = year;
                  const rowMonth = monthMap[month];

                  if (tahun && rowYear !== tahun) {
                    show = false;
                  }
                  if (bulan && rowMonth !== bulan) {
                    show = false;
                  }
                }
              } else {
                // If no target upload date, hide if filtering by year or month
                if (tahun || bulan) {
                  show = false;
                }
              }
            }

            // Filter by editor (column 9: Editor)
            if (editor && data[9] !== editor) {
              show = false;
            }

            // Filter by progres (column 10: Progres)
            if (progres && !data[10].toLowerCase().includes(progres.toLowerCase())) {
              show = false;
            }

            this.node().style.display = show ? '' : 'none';
          });

          table.draw();
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
          $('#filter_fakultas').val('');
          $('#filter_matakuliah').val('');
          $('#filter_lokasi').val('');
          $('#filter_jenis_shooting').val('');
          $('#filter_tahun').val('');
          $('#filter_bulan').val('');
          $('#filter_editor').val('');
          $('#filter_progres').val('');
          table.rows().every(function() {
            this.node().style.display = '';
          });
          table.draw();
        });

        // Real-time filtering on input change
        $('#filter_dosen, #filter_fakultas, #filter_matakuliah, #filter_lokasi, #filter_jenis_shooting, #filter_tahun, #filter_bulan, #filter_editor, #filter_progres').on('input change', function() {
          applyFilters();
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