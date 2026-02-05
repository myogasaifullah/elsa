@extends('layout.header')

@section('title', 'Laporan Mooc')

@include('layout.sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Laporan Mooc</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('laporan.index') }}">Laporan</a></li>
        <li class="breadcrumb-item active">Mooc</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="fw-bold mb-3">REKAPITULASI SHOOTING MOOC DOSEN</h4>
      <div>
        <a href="{{ route('laporan.export.rekap.pdf') }}" class="btn btn-danger btn-sm">PDF</a>
        <a href="{{ route('laporan.export.rekap.excel') }}" class="btn btn-success btn-sm">Excel</a>
      </div>
    </div>

    <!-- Filter Form for Rekap Table -->
    <form method="GET" action="{{ route('laporan.mooc') }}" class="mb-4">
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
          <a href="{{ route('laporan.mooc') }}" class="btn btn-secondary">Reset</a>
        </div>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-bordered text-center align-middle">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Nama Dosen</th>
            <th>Kategori Mooc</th>
            <th>Judul Course</th>
            <th>Tautan Video</th>
          </tr>
        </thead>
        <tbody>
          @forelse($progress as $item)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
            <td>{{ $item->jadwalBooking->kategori_mooc ?? '-' }}</td>
            <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
            <td>
              @if($item->publish_link_youtube)
              <a href="{{ $item->publish_link_youtube }}" target="_blank" class="btn btn-sm btn-primary">Lihat Video</a>
              @else
              -
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center">Tidak ada data MOOC dengan tautan video yang ditemukan.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</main>

@include('layout.footer')