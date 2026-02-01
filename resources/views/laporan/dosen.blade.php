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