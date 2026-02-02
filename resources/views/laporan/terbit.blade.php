<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="text-center fw-bold">UNIVERSITAS TEKNOKRAT INDONESIA</h4>
            <h5 class="text-center mb-4"><br>DOSEN MOOC</h5>
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
                @forelse($terbitData as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
                    <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
                    <td>
                        @if($item->publish_link_youtube)
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
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data laporan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Pagination untuk Tabel Terbit -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="text-muted">
            Menampilkan {{ $terbitData->firstItem() ?? 0 }} - {{ $terbitData->lastItem() ?? 0 }} dari {{ $terbitData->total() }} entri
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end mb-0">
                {{ $terbitData->links('pagination::bootstrap-4') }}
            </ul>
        </nav>
    </div>
</div>