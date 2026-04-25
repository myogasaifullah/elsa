@extends('layouts.admin')

@section('content')

<main id="main" class="main">

    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="text-center fw-bold">REKAP VIDEO PEMBELAJARAN DOSEN TETAP</h5>
                <h6 class="text-center mb-3">UNIVERSITAS TEKNOKRAT INDONESIA</h6>
            </div>
            <div>
                <a href="{{ route('laporan.export.fakultas.pdf', request()->query()) }}" class="btn btn-danger btn-sm">PDF</a>
                <a href="{{ route('laporan.export.fakultas.excel', request()->query()) }}" class="btn btn-success btn-sm">Excel</a>
            </div>
        </div>

        <!-- Filter Form for Fakultas Table -->
        <form method="GET" action="{{ route('laporan.progres') }}" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <label for="fakultas_id" class="form-label">Fakultas</label>
                    <select class="form-control" id="fakultas_id" name="fakultas_id">
                        <option value="">Pilih Fakultas</option>
                        @foreach($fakultases as $fakultas)
                        <option value="{{ $fakultas->id }}" {{ (isset($filterFakultas['fakultas_id']) && $filterFakultas['fakultas_id'] == $fakultas->id) ? 'selected' : '' }}>{{ $fakultas->nama_fakultas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="fakultas_year" class="form-label">Tahun</label>
                    <select class="form-control" id="fakultas_year" name="fakultas_year">
                        <option value="">Pilih Tahun</option>
                        @foreach($uniqueYears as $year)
                        <option value="{{ $year }}" {{ (isset($filterFakultas['fakultas_year']) && $filterFakultas['fakultas_year'] == $year) ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="fakultas_month" class="form-label">Bulan</label>
                    <select class="form-control" id="fakultas_month" name="fakultas_month">
                        <option value="">Pilih Bulan</option>
                        @foreach($uniqueMonths as $month)
                        <option value="{{ $month }}" {{ (isset($filterFakultas['fakultas_month']) && $filterFakultas['fakultas_month'] == $month) ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month((int)$month)->format('F') }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('laporan.progres') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        @forelse($groupedByFakultas as $fakultas => $groupedByDosen)
        <div class="mb-5">
            <h5 class="fw-bold mb-3">{{ $fakultas }}</h5>
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
                        @php $no = 1; @endphp
                        @forelse($groupedByDosen as $index => $data)
                        <tr>
                            <td>{{ $no++ }}</td>
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
                            <td colspan="8" class="text-center">Tidak ada data progress</td>
                        </tr>
                        @endforelse
                        @if(count($groupedByDosen) > 0)
                        <tr class="fw-bold">
                            <td colspan="3">TOTAL</td>
                            <td>{{ array_sum(array_column($groupedByDosen, 'progres_count')) }}</td>
                            <td>{{ array_sum(array_column($groupedByDosen, 'elearning_count')) }}</td>
                            <td>{{ array_sum(array_column($groupedByDosen, 'mooc_count')) }}</td>
                            <td>{{ array_sum(array_column($groupedByDosen, 'total_video')) }}</td>
                            <td></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @empty
        <div class="text-center">
            <p>Tidak ada data progress yang ditemukan.</p>
        </div>
        @endforelse
    </div>

</main>

@endsection