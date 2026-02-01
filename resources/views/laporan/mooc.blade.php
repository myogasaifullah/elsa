<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="text-center fw-bold mb-4">LIST TAUTAN VIDEO DOSEN MOOC</h4>
      <div>
        <a href="{{ route('laporan.export.mooc.pdf') }}" class="btn btn-danger btn-sm">PDF</a>
        <a href="{{ route('laporan.export.mooc.excel') }}" class="btn btn-success btn-sm">Excel</a>
      </div>
    </div>

    <!-- Filter Form for MOOC Table -->
    <form method="GET" action="{{ route('laporan.index') }}" class="mb-4">
      <div class="row">
        <div class="col-md-4">
          <label for="mooc_date_from" class="form-label">Dari Tanggal</label>
          <input type="date" class="form-control" id="mooc_date_from" name="mooc_date_from" value="{{ $filterMooc['mooc_date_from'] ?? '' }}">
        </div>
        <div class="col-md-4">
          <label for="mooc_date_to" class="form-label">Sampai Tanggal</label>
          <input type="date" class="form-control" id="mooc_date_to" name="mooc_date_to" value="{{ $filterMooc['mooc_date_to'] ?? '' }}">
        </div>
        <div class="col-md-4">
          <label for="mooc_dosen" class="form-label">Dosen</label>
          <input type="text" class="form-control" id="mooc_dosen" name="mooc_dosen" placeholder="Nama Dosen" value="{{ $filterMooc['mooc_dosen'] ?? '' }}">
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
      <table class="table table-bordered text-sm align-middle text-center">
        <thead>
          <tr>
            @php
            $grouped = $progress->groupBy('jadwalBooking.user.fakultas.nama_fakultas');
            $colspan = 5; // jumlah kolom per fakultas
            @endphp

            @foreach($grouped as $fakultas => $items)
            <th colspan="{{ $colspan }}">{{ $fakultas }}</th>
            @endforeach
          </tr>
          <tr>
            @foreach($grouped as $fakultas => $items)
            <th>No</th>
            <th>Nama Dosen</th>
            <th>Kategori MOOC</th>
            <th>Judul Course</th>
            <th>Tautan Video</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @php
          $maxRows = $grouped->map->count()->max();
          @endphp

          @for ($i = 0; $i < $maxRows; $i++)
            <tr>
            @foreach($grouped as $fakultas => $items)
            @php $item = $items[$i] ?? null; @endphp
            <td>{{ $item ? $i+1 : '-' }}</td>
            <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
            <td>{{ $item->jadwalBooking->kategori_mooc ?? '-' }}</td>
            <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
            <td>
              @if($item && !empty($item->publish_link_youtube))
              <a href="{{ $item->publish_link_youtube }}" target="_blank">Tonton</a>
              @else
              -
              @endif
            </td>
            @endforeach
            </tr>
            @endfor
        </tbody>
      </table>
    </div>
  </div>