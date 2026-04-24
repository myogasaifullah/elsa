@extends('layouts.admin')

@section('content')

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
          <a href="{{ route('laporan.export.jadwal.pdf', request()->query()) }}" class="btn btn-danger btn-sm me-2">PDF</a>
          <a href="{{ route('laporan.export.jadwal.excel', request()->query()) }}" class="btn btn-success btn-sm">Excel</a>
        </div>
      </div>

      <!-- Filter Form for Jadwal Table -->
      <form method="GET" action="{{ route('laporan.jadwal') }}" class="mb-4">
        <div class="row">
          <div class="col-md-2">
            <label for="jadwal_dosen" class="form-label">Dosen</label>
            <select class="form-control" id="jadwal_dosen" name="jadwal_dosen">
              <option value="">Semua</option>
              @foreach($uniqueDosen as $dosen)
              <option value="{{ $dosen }}" {{ ($filterJadwal['jadwal_dosen'] ?? '') == $dosen ? 'selected' : '' }}>{{ $dosen }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            <label for="jadwal_jenis_kategori" class="form-label">Jenis Kategori</label>
            <select class="form-control" id="jadwal_jenis_kategori" name="jadwal_jenis_kategori">
              <option value="">Semua</option>
              <option value="E-Learning" {{ ($filterJadwal['jadwal_jenis_kategori'] ?? '') == 'E-Learning' ? 'selected' : '' }}>E-Learning</option>
              <option value="MOOC" {{ ($filterJadwal['jadwal_jenis_kategori'] ?? '') == 'MOOC' ? 'selected' : '' }}>MOOC</option>
              <option value="Lomba" {{ ($filterJadwal['jadwal_jenis_kategori'] ?? '') == 'Lomba' ? 'selected' : '' }}>Lomba</option>
              <option value="Marketing" {{ ($filterJadwal['jadwal_jenis_kategori'] ?? '') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
            </select>
          </div>
          <div class="col-md-2">
            <label for="jadwal_studio" class="form-label">Studio</label>
            <select class="form-control" id="jadwal_studio" name="jadwal_studio">
              <option value="">Semua</option>
              @foreach($studios as $studio)
              <option value="{{ $studio->nama_studio }}" {{ ($filterJadwal['jadwal_studio'] ?? '') == $studio->nama_studio ? 'selected' : '' }}>{{ $studio->nama_studio }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            <label for="jadwal_year" class="form-label">Tahun</label>
            <select class="form-control" id="jadwal_year" name="jadwal_year">
              <option value="">Semua</option>
              @foreach($uniqueYears as $year)
              <option value="{{ $year }}" {{ ($filterJadwal['jadwal_year'] ?? '') == $year ? 'selected' : '' }}>{{ $year }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            <label for="jadwal_month" class="form-label">Bulan</label>
            <select class="form-control" id="jadwal_month" name="jadwal_month">
              <option value="">Semua</option>
              <option value="01" {{ ($filterJadwal['jadwal_month'] ?? '') == '01' ? 'selected' : '' }}>Januari</option>
              <option value="02" {{ ($filterJadwal['jadwal_month'] ?? '') == '02' ? 'selected' : '' }}>Februari</option>
              <option value="03" {{ ($filterJadwal['jadwal_month'] ?? '') == '03' ? 'selected' : '' }}>Maret</option>
              <option value="04" {{ ($filterJadwal['jadwal_month'] ?? '') == '04' ? 'selected' : '' }}>April</option>
              <option value="05" {{ ($filterJadwal['jadwal_month'] ?? '') == '05' ? 'selected' : '' }}>Mei</option>
              <option value="06" {{ ($filterJadwal['jadwal_month'] ?? '') == '06' ? 'selected' : '' }}>Juni</option>
              <option value="07" {{ ($filterJadwal['jadwal_month'] ?? '') == '07' ? 'selected' : '' }}>Juli</option>
              <option value="08" {{ ($filterJadwal['jadwal_month'] ?? '') == '08' ? 'selected' : '' }}>Agustus</option>
              <option value="09" {{ ($filterJadwal['jadwal_month'] ?? '') == '09' ? 'selected' : '' }}>September</option>
              <option value="10" {{ ($filterJadwal['jadwal_month'] ?? '') == '10' ? 'selected' : '' }}>Oktober</option>
              <option value="11" {{ ($filterJadwal['jadwal_month'] ?? '') == '11' ? 'selected' : '' }}>November</option>
              <option value="12" {{ ($filterJadwal['jadwal_month'] ?? '') == '12' ? 'selected' : '' }}>Desember</option>
            </select>
          </div>
          <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">Filter</button>
            <a href="{{ route('laporan.jadwal') }}" class="btn btn-secondary">Reset</a>
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

