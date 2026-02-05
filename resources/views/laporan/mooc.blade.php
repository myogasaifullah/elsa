@extends('layout.header')

@section('title', 'Laporan Mooc')

@include('layout.sidebar')



<main id="main" class="main">

  <!-- Tabel Progres MOOC -->
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="card-title">Tabel Laporan MOOC</h5>
        <div>
          <a href="{{ route('laporan.export.mooc.pdf', request()->query()) }}" class="btn btn-danger btn-sm">PDF</a>
          <a href="{{ route('laporan.export.mooc.excel', request()->query()) }}" class="btn btn-success btn-sm">Excel</a>
        </div>
      </div>

      <!-- Filter Form for MOOC Table -->
      <form id="filterForm" method="GET" action="{{ route('laporan.mooc') }}" class="mb-4">
        <div class="row">
          <div class="col-md-2">
            <label for="rekap_fakultas" class="form-label">Fakultas</label>
            <select class="form-control" id="rekap_fakultas" name="rekap_fakultas">
              <option value="">Semua</option>
              @foreach($uniqueFakultas as $fakultas)
              <option value="{{ $fakultas }}" {{ ($filterRekap['rekap_fakultas'] ?? '') == $fakultas ? 'selected' : '' }}>{{ $fakultas }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            <label for="rekap_dosen" class="form-label">Dosen</label>
            <select class="form-control" id="rekap_dosen" name="rekap_dosen">
              <option value="">Semua</option>
              @foreach($uniqueDosen as $dosen)
              <option value="{{ $dosen }}" {{ ($filterRekap['rekap_dosen'] ?? '') == $dosen ? 'selected' : '' }}>{{ $dosen }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            <label for="rekap_kategori_mooc" class="form-label">Kategori Mooc</label>
            <select class="form-control" id="rekap_kategori_mooc" name="rekap_kategori_mooc">
              <option value="">Semua</option>
              @foreach($uniqueKategoriMooc as $kategori)
              <option value="{{ $kategori }}" {{ $filterRekap['rekap_kategori_mooc'] ?? '' == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            <label for="rekap_year" class="form-label">Tahun</label>
            <select class="form-control" id="rekap_year" name="rekap_year">
              <option value="">Semua</option>
              @foreach($uniqueYears as $year)
              <option value="{{ $year }}" {{ $filterRekap['rekap_year'] ?? '' == $year ? 'selected' : '' }}>{{ $year }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            <label for="rekap_month" class="form-label">Bulan</label>
            <select class="form-control" id="rekap_month" name="rekap_month">
              <option value="">Semua</option>
              @foreach($uniqueMonths as $month)
              <option value="{{ $month }}" {{ $filterRekap['rekap_month'] ?? '' == $month ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month(intval($month))->format('F') }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">Filter</button>
            <a href="{{ route('laporan.mooc') }}" class="btn btn-secondary">Reset</a>
          </div>
        </div>
      </form>

      @forelse($groupedByFakultas as $fakultas => $progressItems)
      <div class="mb-5">
        <h6 class="fw-bold mb-3">{{ $fakultas }}</h6>
        <div class="table-responsive">
          <table class="table table-sm align-middle">
            <thead class="table-light text-center">
              <tr>
                <th>No</th>
                <th>Nama Dosen</th>
                <th>Kategori Mooc</th>
                <th>Judul Course</th>
                <th>Tautan Video</th>
              </tr>
            </thead>
            <tbody>
              @forelse($progressItems as $index => $item)
              <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
                <td>{{ $item->jadwalBooking->kategori_mooc ?? '-' }}</td>
                <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
                <td class="text-center">
                  @if($item->publish_link_youtube)
                  <a href="{{ $item->publish_link_youtube }}" target="_blank">{{ $item->publish_link_youtube }}</a>
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
      @empty
      <div class="text-center">
        <p>Tidak ada data MOOC dengan tautan video yang ditemukan.</p>
      </div>
      @endforelse
    </div>
  </div>

</main>

@include('layout.footer')