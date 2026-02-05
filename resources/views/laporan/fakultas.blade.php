@extends('layout.header')

@section('title', 'Laporan Fakultas')

@include('layout.sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Laporan Fakultas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('laporan.index') }}">Laporan</a></li>
                <li class="breadcrumb-item active">Fakultas</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="text-center fw-bold">REKAP VIDEO PEMBELAJARAN DOSEN TETAP</h5>
                <h6 class="text-center mb-3">UNIVERSITAS TEKNOKRAT INDONESIA</h6>
            </div>

            <div>
                <a href="{{ route('laporan.export.combined-fakultas.pdf', request()->query()) }}" class="btn btn-danger btn-sm ms-2">PDF</a>
                <a href="{{ route('laporan.export.combined-fakultas.excel', request()->query()) }}" class="btn btn-success btn-sm ms-2">Excel</a>
            </div>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('laporan.fakultas') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="fakultas_year" class="form-label">Tahun</label>
                    <select class="form-control" id="fakultas_year" name="fakultas_year">
                        <option value="">Pilih Tahun</option>
                        @foreach($uniqueYears as $year)
                        <option value="{{ $year }}" {{ (isset($filterFakultas['fakultas_year']) && $filterFakultas['fakultas_year'] == $year) ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="fakultas_month" class="form-label">Bulan</label>
                    <select class="form-control" id="fakultas_month" name="fakultas_month">
                        <option value="">Pilih Bulan</option>
                        @foreach($uniqueMonths as $month)
                        <option value="{{ $month }}" {{ (isset($filterFakultas['fakultas_month']) && $filterFakultas['fakultas_month'] == $month) ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month((int)$month)->format('F') }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('laporan.fakultas') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>


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

        </div>
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