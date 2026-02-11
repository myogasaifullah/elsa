@extends('layouts.admin')

@section('content')

<main id="main" class="main">

    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-3">REKAPITULASI SHOOTING MOOC DOSEN</h4>
            <div>
                <a href="{{ route('laporan.export.rekap.pdf', request()->query()) }}" class="btn btn-danger btn-sm">PDF</a>
                <a href="{{ route('laporan.export.rekap.excel', request()->query()) }}" class="btn btn-success btn-sm">Excel</a>
            </div>
        </div>

        <!-- Filter Form for Rekap Table -->
        <form method="GET" action="{{ route('laporan.dosen') }}" class="mb-4">
            <div class="row">
                <div class="col-md-6">
                    <label for="rekap_year" class="form-label">Tahun</label>
                    <select class="form-control" id="rekap_year" name="rekap_year">
                        <option value="">Pilih Tahun</option>
                        @foreach($uniqueYears as $year)
                        <option value="{{ $year }}" {{ ($filterRekap['rekap_year'] ?? '') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="rekap_month" class="form-label">Bulan</label>
                    <select class="form-control" id="rekap_month" name="rekap_month">
                        <option value="">Pilih Bulan</option>
                        @foreach($uniqueMonths as $month)
                        <option value="{{ $month }}" {{ ($filterRekap['rekap_month'] ?? '') == $month ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month(intval($month))->format('F') }}</option>
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

</main>

