@extends('layout.header')

@section('title', 'Laporan Jadwal')

@include('layout.sidebar')

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
          <a href="{{ route('laporan.export.jadwal.pdf') }}" class="btn btn-danger btn-sm">PDF</a>
          <a href="{{ route('laporan.export.jadwal.excel') }}" class="btn btn-success btn-sm">Excel</a>
        </div>
      </div>

      <!-- Filter Form for Jadwal Table -->
      <form method="GET" action="{{ route('laporan.jadwal') }}" class="mb-4">
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

</main>

@include('layout.footer')