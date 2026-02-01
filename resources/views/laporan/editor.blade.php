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

