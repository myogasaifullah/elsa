@extends('layout.header')

@section('title', 'Laporan Booking')

@include('layout.sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Laporan Booking</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                <li class="breadcrumb-item active">Laporan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    @include('laporan.done')
    
    <!-- Tabel Progres Editor -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title">Tabel Progres Editor</h5>
                <div>
                    <a href="{{ route('laporan.export.progress.pdf') }}" class="btn btn-danger btn-sm">PDF</a>
                    <a href="{{ route('laporan.export.progress.excel') }}" class="btn btn-success btn-sm">Excel</a>
                </div>
            </div>
            
            <!-- Filter Form for Progress Table -->
            <form method="GET" action="{{ route('laporan.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <label for="progress_date_from" class="form-label">Dari Tanggal</label>
                        <input type="date" class="form-control" id="progress_date_from" name="progress_date_from" value="{{ $filterProgress['progress_date_from'] ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label for="progress_date_to" class="form-label">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="progress_date_to" name="progress_date_to" value="{{ $filterProgress['progress_date_to'] ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label for="progress_dosen" class="form-label">Dosen</label>
                        <input type="text" class="form-control" id="progress_dosen" name="progress_dosen" placeholder="Nama Dosen" value="{{ $filterProgress['progress_dosen'] ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label for="progress_prodi" class="form-label">Program Studi</label>
                        <select class="form-control" id="progress_prodi" name="progress_prodi">
                            <option value="">Pilih Program Studi</option>
                            @foreach($prodis as $prodi)
                                <option value="{{ $prodi->id }}" {{ (isset($filterProgress['progress_prodi']) && $filterProgress['progress_prodi'] == $prodi->id) ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
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
                                <td>{{ ($progress->currentPage() - 1) * $progress->perPage() + $index + 1 }}</td>
                                <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
                                <td>{{ $item->jadwalBooking->user->fakultas->nama_fakultas ?? '-' }}</td>
                                <td>{{ $item->jadwalBooking->nama_mata_kuliah ?? '-' }}</td>
                                <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
                                <td>{{ $item->jadwalBooking->studio->nama_studio ??  '-' }}</td>
                                <td>{{ $item->jadwalBooking->tanggal ? \Carbon\Carbon::parse($item->jadwalBooking->tanggal)->format('d F Y') : '-' }}</td>
                                <td>{{ $item->jadwalBooking->jenis_kategori ?? '-' }}</td>
                                <td>{{ $item->target_upload ? \Carbon\Carbon::parse($item->target_upload)->format('d F Y') : '-' }}</td>
                                <td>{{ $item->editor->nama ?? '-' }}</td>
                                <td>
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
                                <td>{{ $item->durasi ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">Tidak ada data progres</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination untuk Tabel Progres Editor -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Menampilkan {{ $progress->firstItem() ?? 0 }} - {{ $progress->lastItem() ?? 0 }} dari {{ $progress->total() }} entri
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm justify-content-end mb-0">
                        {{ $progress->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    
    
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="card-title text-center">LAPORAN JADWAL BOOKING</h5>
                    <p class="text-center mb-1">UNIVERSITAS TEKNOKRAT INDONESIA</p>
                </div>
                <div>
                    <a href="{{ route('laporan.export.jadwal.pdf') }}" class="btn btn-danger btn-sm">PDF</a>
                    <a href="{{ route('laporan.export.jadwal.excel') }}" class="btn btn-success btn-sm">Excel</a>
                </div>
            </div>
            
            <!-- Filter Form for Jadwal Table -->
            <form method="GET" action="{{ route('laporan.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <label for="jadwal_date_from" class="form-label">Dari Tanggal</label>
                        <input type="date" class="form-control" id="jadwal_date_from" name="jadwal_date_from" value="{{ $filterJadwal['jadwal_date_from'] ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label for="jadwal_date_to" class="form-label">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="jadwal_date_to" name="jadwal_date_to" value="{{ $filterJadwal['jadwal_date_to'] ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label for="jadwal_dosen" class="form-label">Dosen</label>
                        <input type="text" class="form-control" id="jadwal_dosen" name="jadwal_dosen" placeholder="Nama Dosen" value="{{ $filterJadwal['jadwal_dosen'] ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label for="jadwal_studio" class="form-label">Studio</label>
                        <select class="form-control" id="jadwal_studio" name="jadwal_studio">
                            <option value="">Pilih Studio</option>
                            @foreach($studios as $studio)
                                <option value="{{ $studio->id }}" {{ (isset($filterJadwal['jadwal_studio']) && $filterJadwal['jadwal_studio'] == $studio->id) ? 'selected' : '' }}>{{ $studio->nama_studio }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
            
            @php
                $jadwalBookings = collect();
                if(isset($progress) && $progress->isNotEmpty()) {
                    $jadwalBookings = $progress->pluck('jadwalBooking')->filter()->values();
                }
                
                // Group by date
                $groupedJadwal = $jadwalBookings->groupBy('tanggal')->sortKeys();
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
                        <table class="table table-bordered">
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

    
<div class="card p-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="text-center fw-bold mb-4">LIST TAUTAN VIDEO DOSEN MOOC</h4>
    <div>
      <a href="{{ route('laporan.export.mooc.pdf') }}" class="btn btn-danger btn-sm">PDF</a>
      <a href="{{ route('laporan.export.mooc.excel') }}" class="btn btn-success btn-sm">Excel</a>
    </div>
  </div>
  
  <!-- Filter Form for MOOC Table -->
  <form method="GET" action="{{ route('laporan.index') }}" class="mb-4">
    <div class="row">
      <div class="col-md-4">
        <label for="mooc_date_from" class="form-label">Dari Tanggal</label>
        <input type="date" class="form-control" id="mooc_date_from" name="mooc_date_from" value="{{ $filterMooc['mooc_date_from'] ?? '' }}">
      </div>
      <div class="col-md-4">
        <label for="mooc_date_to" class="form-label">Sampai Tanggal</label>
        <input type="date" class="form-control" id="mooc_date_to" name="mooc_date_to" value="{{ $filterMooc['mooc_date_to'] ?? '' }}">
      </div>
      <div class="col-md-4">
        <label for="mooc_dosen" class="form-label">Dosen</label>
        <input type="text" class="form-control" id="mooc_dosen" name="mooc_dosen" placeholder="Nama Dosen" value="{{ $filterMooc['mooc_dosen'] ?? '' }}">
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Reset</a>
      </div>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-bordered text-sm align-middle text-center">
      <thead>
        <tr>
          @php
            $grouped = $progress->groupBy('jadwalBooking.user.fakultas.nama_fakultas');
            $colspan = 5; // jumlah kolom per fakultas
          @endphp

          @foreach($grouped as $fakultas => $items)
            <th colspan="{{ $colspan }}">{{ $fakultas }}</th>
          @endforeach
        </tr>
        <tr>
          @foreach($grouped as $fakultas => $items)
            <th>No</th>
            <th>Nama Dosen</th>
            <th>Kategori MOOC</th>
            <th>Judul Course</th>
            <th>Tautan Video</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @php
          $maxRows = $grouped->map->count()->max();
        @endphp

        @for ($i = 0; $i < $maxRows; $i++)
          <tr>
            @foreach($grouped as $fakultas => $items)
              @php $item = $items[$i] ?? null; @endphp
              <td>{{ $item ? $i+1 : '-' }}</td>
              <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
              <td>{{ $item->jadwalBooking->kategori_mooc ?? '-' }}</td>
              <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
              <td>
                @if($item && !empty($item->publish_link_youtube))
                  <a href="{{ $item->publish_link_youtube }}" target="_blank">Tonton</a>
                @else
                  -
                @endif
              </td>
            @endforeach
          </tr>
        @endfor
      </tbody>
    </table>
  </div>
</div>


  <div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="fw-bold mb-3">REKAPITULASI SHOOTING MOOC DOSEN</h4>
      <div>
        <a href="{{ route('laporan.export.rekap.pdf') }}" class="btn btn-danger btn-sm">PDF</a>
        <a href="{{ route('laporan.export.rekap.excel') }}" class="btn btn-success btn-sm">Excel</a>
      </div>
    </div>
    
    <!-- Filter Form for Rekap Table -->
    <form method="GET" action="{{ route('laporan.index') }}" class="mb-4">
      <div class="row">
        <div class="col-md-4">
          <label for="rekap_date_from" class="form-label">Dari Tanggal</label>
          <input type="date" class="form-control" id="rekap_date_from" name="rekap_date_from" value="{{ $filterRekap['rekap_date_from'] ?? '' }}">
        </div>
        <div class="col-md-4">
          <label for="rekap_date_to" class="form-label">Sampai Tanggal</label>
          <input type="date" class="form-control" id="rekap_date_to" name="rekap_date_to" value="{{ $filterRekap['rekap_date_to'] ?? '' }}">
        </div>
        <div class="col-md-4">
          <label for="rekap_dosen" class="form-label">Dosen</label>
          <input type="text" class="form-control" id="rekap_dosen" name="rekap_dosen" placeholder="Nama Dosen" value="{{ $filterRekap['rekap_dosen'] ?? '' }}">
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary">Filter</button>
          <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Reset</a>
        </div>
      </div>
    </form>
    
    <div class="table-responsive">
      <table class="table table-bordered text-center align-middle">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Nama Dosen</th>
            <th>Target Shooting</th>
            <th>Sudah Shooting</th>
            <th>Proses Edit</th>
            <th>Belum Shooting</th>
            <th>Sudah Terbit</th>
            <th>Keterangan Shooting</th>
            <th>Keterangan Video</th>
          </tr>
        </thead>
        <tbody>
@php
    $groupedProgress = [];
    foreach ($progress as $item) {
        $dosenName = $item->jadwalBooking->dosen->nama_dosen ?? 'N/A';
        if (!isset($groupedProgress[$dosenName])) {
            $groupedProgress[$dosenName] = [
                'target' => $item->jadwalBooking->dosen->target_video_dosen ?? 0,
                'sudah' => 0,
                'proses' => 0,
                'belum' => 0,
                'terbit' => 0,
                'keterangan_shooting' => '-',
                'keterangan_video' => '-',
            ];
        }
        
        // Hitung jumlah target, sudah shooting, dan sudah terbit
        if ($item->jadwalBooking->status == 'sudah shooting') {
            $groupedProgress[$dosenName]['sudah']++;
        }
        if ($item->progres == 'progres') {
            $groupedProgress[$dosenName]['proses']++;
        }
        if ($item->jadwalBooking->status == 'belum shooting') {
            $groupedProgress[$dosenName]['belum']++;
        }
        if ($item->progres == 'selesai') {
            $groupedProgress[$dosenName]['terbit']++;
        }
        
        // Tentukan keterangan shooting
        if ($groupedProgress[$dosenName]['target'] == $groupedProgress[$dosenName]['sudah']) {
            $groupedProgress[$dosenName]['keterangan_shooting'] = 'sudah shooting';
        } else {
            $groupedProgress[$dosenName]['keterangan_shooting'] = 'belum selesai';
        }
        
        // Tentukan keterangan video
        if ($groupedProgress[$dosenName]['target'] == $groupedProgress[$dosenName]['terbit']) {
            $groupedProgress[$dosenName]['keterangan_video'] = 'selesai terbit';
        } else {
            $groupedProgress[$dosenName]['keterangan_video'] = 'belum terbit';
        }
    }
@endphp
@foreach($groupedProgress as $dosen => $data)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $dosen }}</td>
    <td>{{ $data['target'] }}</td>
    <td>{{ $data['sudah'] }}</td>
    <td>{{ $data['proses'] }}</td>
    <td>{{ $data['belum'] }}</td>
    <td>{{ $data['terbit'] }}</td>
    <td>{{ $data['keterangan_shooting'] }}</td>
    <td>{{ $data['keterangan_video'] }}</td>
</tr>
@endforeach
<tr>
    <td colspan="2">TOTAL</td>
    <td>{{ array_sum(array_column($groupedProgress, 'target')) }}</td>
    <td>{{ array_sum(array_column($groupedProgress, 'sudah')) }}</td>
    <td>{{ array_sum(array_column($groupedProgress, 'proses')) }}</td>
    <td>{{ array_sum(array_column($groupedProgress, 'belum')) }}</td>
    <td>{{ array_sum(array_column($groupedProgress, 'terbit')) }}</td>
    <td colspan="2"></td>
</tr>
        </tbody>
      </table>
    </div>
  </div>


    
<div class="card p-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h4 class="text-center fw-bold">UNIVERSITAS TEKNOKRAT INDONESIA</h4>
      <h5 class="text-center mb-4">SEMESTER GANJIL 2024/2025<br>DOSEN MOOC</h5>
    </div>
    <div>
      <a href="{{ route('laporan.export.dosen.pdf') }}" class="btn btn-danger btn-sm">PDF</a>
      <a href="{{ route('laporan.export.dosen.excel') }}" class="btn btn-success btn-sm">Excel</a>
    </div>
  </div>
  
  <!-- Filter Form for Dosen Table -->
  <form method="GET" action="{{ route('laporan.index') }}" class="mb-4">
    <div class="row">
      <div class="col-md-4">
        <label for="dosen_date_from" class="form-label">Dari Tanggal</label>
        <input type="date" class="form-control" id="dosen_date_from" name="dosen_date_from" value="{{ $filterDosen['dosen_date_from'] ?? '' }}">
      </div>
      <div class="col-md-4">
        <label for="dosen_date_to" class="form-label">Sampai Tanggal</label>
        <input type="date" class="form-control" id="dosen_date_to" name="dosen_date_to" value="{{ $filterDosen['dosen_date_to'] ?? '' }}">
      </div>
      <div class="col-md-4">
        <label for="dosen_status" class="form-label">Status Dosen</label>
        <select class="form-control" id="dosen_status" name="dosen_status">
          <option value="">Pilih Status Dosen</option>
          <option value="tetap" {{ (isset($filterDosen['dosen_status']) && $filterDosen['dosen_status'] == 'tetap') ? 'selected' : '' }}>Tetap</option>
          <option value="tidak tetap" {{ (isset($filterDosen['dosen_status']) && $filterDosen['dosen_status'] == 'tidak tetap') ? 'selected' : '' }}>Tidak Tetap</option>
        </select>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Reset</a>
      </div>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-bordered text-center align-middle">
      <thead class="table-light">
        <tr>
          <th>No</th>
          <th>Nama Dosen</th>
          <th>Judul Video MOOC</th>
          <th>Link Video YouTube</th>
          <th>Durasi</th>
          <th>Tanggal Upload YouTube</th>
        </tr>
      </thead>
      <tbody>
        @forelse($progress as $index => $item)
          @if($item->jadwalBooking && 
              $item->jadwalBooking->judul_course && 
              $item->progres === 'selesai' && 
              $item->jadwalBooking->jenis_kategori === 'Mooc')
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
              <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
              <td>
                @if($item->keterangan)
                  <a href="{{ $item->publish_link_youtube }}" target="_blank" class="text-primary">
                    {{ Str::limit($item->publish_link_youtube, 30) }}
                  </a>
                @else
                  -
                @endif
              </td>
              <td>{{ $item->durasi ?? '-' }}</td>
              <td>{{ $item->tanggal_upload_youtube ? \Carbon\Carbon::parse($item->tanggal_upload_youtube)->format('d M Y') : '-' }}</td>
            </tr>
          @endif
        @empty
          <tr>
            <td colspan="6" class="text-center">Tidak ada data laporan</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <!-- Pagination untuk Tabel Progres Editor -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Menampilkan {{ $progress->firstItem() ?? 0 }} - {{ $progress->lastItem() ?? 0 }} dari {{ $progress->total() }} entri
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end mb-0">
                        {{ $progress->links('pagination::bootstrap-4') }}
                    </ul>
                </nav>
            </div>
   </div>

   
<div class="card p-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h5 class="text-center fw-bold">REKAP VIDEO PEMBELAJARAN DOSEN TETAP</h5>
      <h6 class="text-center mb-3">FAKULTAS TEKNIK DAN ILMU KOMPUTER<br>UNIVERSITAS TEKNOKRAT INDONESIA</h6>
    </div>
    <div>
      <a href="{{ route('laporan.export.fakultas.pdf') }}" class="btn btn-danger btn-sm">PDF</a>
      <a href="{{ route('laporan.export.fakultas.excel') }}" class="btn btn-success btn-sm">Excel</a>
    </div>
  </div>
  
  <!-- Filter Form for Fakultas Table -->
  <form method="GET" action="{{ route('laporan.index') }}" class="mb-4">
    <div class="row">
      <div class="col-md-4">
        <label for="fakultas_date_from" class="form-label">Dari Tanggal</label>
        <input type="date" class="form-control" id="fakultas_date_from" name="fakultas_date_from" value="{{ $filterFakultas['fakultas_date_from'] ?? '' }}">
      </div>
      <div class="col-md-4">
        <label for="fakultas_date_to" class="form-label">Sampai Tanggal</label>
        <input type="date" class="form-control" id="fakultas_date_to" name="fakultas_date_to" value="{{ $filterFakultas['fakultas_date_to'] ?? '' }}">
      </div>
      <div class="col-md-4">
        <label for="fakultas_id" class="form-label">Fakultas</label>
        <select class="form-control" id="fakultas_id" name="fakultas_id">
          <option value="">Pilih Fakultas</option>
          @foreach($fakultases as $fakultas)
            <option value="{{ $fakultas->id }}" {{ (isset($filterFakultas['fakultas_id']) && $filterFakultas['fakultas_id'] == $fakultas->id) ? 'selected' : '' }}>{{ $fakultas->nama_fakultas }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Reset</a>
      </div>
    </div>
  </form>

  
  <div class="table-responsive">
    <table class="table table-bordered text-center align-middle">
      <thead class="table-warning">
        <tr>
          <th rowspan="2">No.</th>
          <th rowspan="2">NUPTK</th>
          <th rowspan="2">Nama Dosen</th>
          <th rowspan="2">Prog Edit</th>
          <th colspan="2">Jumlah Video</th>
          <th rowspan="2">Total</th>
          <th rowspan="2">Target</th>
         
        </tr>
        <tr>
          <th>Pembelajaran</th>
          <th>MOOC</th>
        </tr>
      </thead>
      <tbody>
        @php
          // Group progress by dosen and count by jenis_kategori
          $groupedByDosen = [];
          foreach($progress as $item) {
              $dosen = $item->jadwalBooking->dosen ?? null;
              $jenisKategori = $item->jadwalBooking->jenis_kategori ?? null;
              
              if ($dosen) {
                  $dosenId = $dosen->id;
                  if (!isset($groupedByDosen[$dosenId])) {
                      $groupedByDosen[$dosenId] = [
                          'dosen' => $dosen,
                          'elearning_count' => 0,
                          'mooc_count' => 0,
                          'total_video' => 0,
                          'progres_count' => 0
                      ];
                  }
                  
                  // Count by category
                  if ($jenisKategori === 'E-learning') {
                      $groupedByDosen[$dosenId]['elearning_count']++;
                  } elseif ($jenisKategori === 'Mooc') {
                      $groupedByDosen[$dosenId]['mooc_count']++;
                  }
                  
                  // Count total videos
                  $groupedByDosen[$dosenId]['total_video']++;
                  
                  // Count progress
                  if ($item->progres === 'progres') {
                      $groupedByDosen[$dosenId]['progres_count']++;
                  }
              }
          }
        @endphp
        
        @forelse($groupedByDosen as $index => $data)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $data['dosen']->nuptk_dosen ?? '-' }}</td>
            <td class="text-start">{{ $data['dosen']->nama_dosen ?? '-' }}</td>
            <td>{{ $data['progres_count'] }}</td>
            <td>{{ $data['elearning_count'] }}</td>
            <td>{{ $data['mooc_count'] }}</td>
            <td>{{ $data['total_video'] }}</td>
            <td class="text-start">{{ $data['dosen']->target_video_dosen ?? '-' }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="9" class="text-center">Tidak ada data progress</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

  
<div class="card p-4">
  <h5 class="text-center fw-bold">REKAP VIDEO PEMBELAJARAN DOSEN TETAP</h5>
  <h6 class="text-center mb-3">UNIVERSITAS TEKNOKRAT INDONESIA</h6>

  <div class="table-responsive mb-4">
    <table class="table table-bordered text-center align-middle">
      <thead class="table-warning">
        <tr>
          <th>No</th>
          <th>Fakultas</th>
          <th>Jumlah Dosen</th>
          <th>Video Pembelajaran</th>
          <th>Video MOOC</th>
          <th>Proses Editing</th>
          <th>Jumlah Video</th>
        </tr>
      </thead>
      <tbody>
        @php
          $fakultasDataTetap = [];
          foreach($progressTetap as $item) {
              $dosen = $item->jadwalBooking->dosen;
              $fakultas = $dosen->fakultas->nama_fakultas ?? 'Tidak Diketahui';
              $dosenId = $dosen->id;
              
              if (!isset($fakultasDataTetap[$fakultas])) {
                  $fakultasDataTetap[$fakultas] = [
                      'jumlah_dosen' => \App\Models\Dosen::where('fakultas_id', $dosen->fakultas_id)->count(),
                      'pembelajaran' => 0,
                      'mooc' => 0,
                      'editing' => 0,
                      'total' => 0
                  ];
              }
              
              if($item->progres == 'selesai') {
                  if(str_contains(strtolower($item->judul_video ?? ''), 'mooc')) {
                      $fakultasDataTetap[$fakultas]['mooc']++;
                  } else {
                      $fakultasDataTetap[$fakultas]['pembelajaran']++;
                  }
              } elseif($item->progres == 'progres') {
                  $fakultasDataTetap[$fakultas]['editing']++;
              }
              
              $fakultasDataTetap[$fakultas]['total']++;
          }
          
          $totalDosenTetap = 0;
          $totalPembelajaran = 0;
          $totalMooc = 0;
          $totalEditing = 0;
          $totalVideo = 0;
        @endphp
        
        @if(count($fakultasDataTetap) > 0)
          @foreach($fakultasDataTetap as $fakultas => $data)
            @php
              $totalDosenTetap += $data['jumlah_dosen'];
              $totalPembelajaran += $data['pembelajaran'];
              $totalMooc += $data['mooc'];
              $totalEditing += $data['editing'];
              $totalVideo += $data['total'];
            @endphp
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td class="text-start">{{ $fakultas }}</td>
              <td>{{ $data['jumlah_dosen'] }}</td>
              <td>{{ $data['pembelajaran'] }}</td>
              <td>{{ $data['mooc'] }}</td>
              <td>{{ $data['editing'] }}</td>
              <td>{{ $data['total'] }}</td>
            </tr>
          @endforeach
          
          <tr class="fw-bold">
            <td colspan="2">Jumlah</td>
            <td>{{ $totalDosenTetap }}</td>
            <td>{{ $totalPembelajaran }}</td>
            <td>{{ $totalMooc }}</td>
            <td>{{ $totalEditing }}</td>
            <td>{{ $totalVideo }}</td>
          </tr>
        @else
          <tr>
            <td colspan="7" class="text-center">Tidak ada data dosen tetap</td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="text-center fw-bold">REKAP VIDEO PEMBELAJARAN DOSEN TIDAK TETAP</h5>
    <div>
      <a href="{{ route('laporan.export.fakultas.pdf') }}" class="btn btn-danger btn-sm">PDF</a>
      <a href="{{ route('laporan.export.fakultas.excel') }}" class="btn btn-success btn-sm">Excel</a>
    </div>
  </div>
  
  <!-- Filter Form for Dosen Tidak Tetap Table -->
  <form method="GET" action="{{ route('laporan.index') }}" class="mb-4">
    <div class="row">
      <div class="col-md-4">
        <label for="fakultas_date_from" class="form-label">Dari Tanggal</label>
        <input type="date" class="form-control" id="fakultas_date_from" name="fakultas_date_from" value="{{ $filterFakultas['fakultas_date_from'] ?? '' }}">
      </div>
      <div class="col-md-4">
        <label for="fakultas_date_to" class="form-label">Sampai Tanggal</label>
        <input type="date" class="form-control" id="fakultas_date_to" name="fakultas_date_to" value="{{ $filterFakultas['fakultas_date_to'] ?? '' }}">
      </div>
      <div class="col-md-4">
        <label for="fakultas_id" class="form-label">Fakultas</label>
        <select class="form-control" id="fakultas_id" name="fakultas_id">
          <option value="">Pilih Fakultas</option>
          @foreach($fakultases as $fakultas)
            <option value="{{ $fakultas->id }}" {{ (isset($filterFakultas['fakultas_id']) && $filterFakultas['fakultas_id'] == $fakultas->id) ? 'selected' : '' }}>{{ $fakultas->nama_fakultas }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Reset</a>
      </div>
    </div>
  </form>
  
  <div class="table-responsive">
    <table class="table table-bordered text-center align-middle">
      <thead class="table-warning">
        <tr>
          <th>No</th>
          <th>Fakultas</th>
          <th>Jumlah Dosen</th>
          <th>Video Pembelajaran</th>
          <th>Proses Editing</th>
          <th>Jumlah Video</th>
        </tr>
      </thead>
      <tbody>
        @php
          $fakultasDataTidakTetap = [];
          foreach($progressTidakTetap as $item) {
              $dosen = $item->jadwalBooking->dosen;
              $fakultas = $dosen->fakultas->nama_fakultas ?? 'Tidak Diketahui';
              $dosenId = $dosen->id;
              
              if (!isset($fakultasDataTidakTetap[$fakultas])) {
                  $fakultasDataTidakTetap[$fakultas] = [
                      'jumlah_dosen' => \App\Models\Dosen::where('fakultas_id', $dosen->fakultas_id)->count(),
                      'pembelajaran' => 0,
                      'editing' => 0,
                      'total' => 0
                  ];
              }
              
              if($item->progres == 'selesai') {
                  $fakultasDataTidakTetap[$fakultas]['pembelajaran']++;
              } elseif($item->progres == 'progres') {
                  $fakultasDataTidakTetap[$fakultas]['editing']++;
              }
              
              $fakultasDataTidakTetap[$fakultas]['total']++;
          }
          
          $totalDosenTidakTetap = 0;
          $totalPembelajaranTidakTetap = 0;
          $totalEditingTidakTetap = 0;
          $totalVideoTidakTetap = 0;
        @endphp
        
        @if(count($fakultasDataTidakTetap) > 0)
          @foreach($fakultasDataTidakTetap as $fakultas => $data)
            @php
              $totalDosenTidakTetap += $data['jumlah_dosen'];
              $totalPembelajaranTidakTetap += $data['pembelajaran'];
              $totalEditingTidakTetap += $data['editing'];
              $totalVideoTidakTetap += $data['total'];
            @endphp
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td class="text-start">{{ $fakultas }}</td>
              <td>{{ $data['jumlah_dosen'] }}</td>
              <td>{{ $data['pembelajaran'] }}</td>
              <td>{{ $data['editing'] }}</td>
              <td>{{ $data['total'] }}</td>
            </tr>
          @endforeach
          
          <tr class="fw-bold">
            <td colspan="2">Jumlah</td>
            <td>{{ $totalDosenTidakTetap }}</td>
            <td>{{ $totalPembelajaranTidakTetap }}</td>
            <td>{{ $totalEditingTidakTetap }}</td>
            <td>{{ $totalVideoTidakTetap }}</td>
          </tr>
        @else
          <tr>
            <td colspan="6" class="text-center">Tidak ada data dosen tidak tetap</td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>
</main>

@include('layout.footer')