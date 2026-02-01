 <div class="card p-4">
     <div class="d-flex justify-content-between align-items-center mb-3">
         <div>
             <h5 class="text-center fw-bold">REKAP VIDEO PEMBELAJARAN DOSEN TETAP</h5>
             <h6 class="text-center mb-3">FAKULTAS TEKNIK DAN ILMU KOMPUTER<br>UNIVERSITAS TEKNOKRAT INDONESIA</h6>
         </div>
         <div>
             <a href="{{ route('laporan.export.fakultas.pdf') }}" class="btn btn-danger btn-sm">PDF</a>
             <a href="{{ route('laporan.export.fakultas.excel') }}" class="btn btn-success btn-sm">Excel</a>
         </div>
     </div>

     <!-- Filter Form for Fakultas Table -->
     <form method="GET" action="{{ route('laporan.index') }}" class="mb-4">
         <div class="row">
             <div class="col-md-4">
                 <label for="fakultas_date_from" class="form-label">Dari Tanggal</label>
                 <input type="date" class="form-control" id="fakultas_date_from" name="fakultas_date_from" value="{{ $filterFakultas['fakultas_date_from'] ?? '' }}">
             </div>
             <div class="col-md-4">
                 <label for="fakultas_date_to" class="form-label">Sampai Tanggal</label>
                 <input type="date" class="form-control" id="fakultas_date_to" name="fakultas_date_to" value="{{ $filterFakultas['fakultas_date_to'] ?? '' }}">
             </div>
             <div class="col-md-4">
                 <label for="fakultas_id" class="form-label">Fakultas</label>
                 <select class="form-control" id="fakultas_id" name="fakultas_id">
                     <option value="">Pilih Fakultas</option>
                     @foreach($fakultases as $fakultas)
                     <option value="{{ $fakultas->id }}" {{ (isset($filterFakultas['fakultas_id']) && $filterFakultas['fakultas_id'] == $fakultas->id) ? 'selected' : '' }}>{{ $fakultas->nama_fakultas }}</option>
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
                 @php
                 // Group progress by dosen and count by jenis_kategori
                 $groupedByDosen = [];
                 foreach($progress as $item) {
                 $dosen = $item->jadwalBooking->dosen ?? null;
                 $jenisKategori = $item->jadwalBooking->jenis_kategori ?? null;

                 if ($dosen) {
                 $dosenId = $dosen->id;
                 if (!isset($groupedByDosen[$dosenId])) {
                 $groupedByDosen[$dosenId] = [
                 'dosen' => $dosen,
                 'elearning_count' => 0,
                 'mooc_count' => 0,
                 'total_video' => 0,
                 'progres_count' => 0
                 ];
                 }

                 // Count by category
                 if ($jenisKategori === 'E-learning') {
                 $groupedByDosen[$dosenId]['elearning_count']++;
                 } elseif ($jenisKategori === 'Mooc') {
                 $groupedByDosen[$dosenId]['mooc_count']++;
                 }

                 // Count total videos
                 $groupedByDosen[$dosenId]['total_video']++;

                 // Count progress
                 if ($item->progres === 'progres') {
                 $groupedByDosen[$dosenId]['progres_count']++;
                 }
                 }
                 }
                 @endphp

                 @forelse($groupedByDosen as $index => $data)
                 <tr>
                     <td>{{ $index + 1 }}</td>
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
                     <td colspan="9" class="text-center">Tidak ada data progress</td>
                 </tr>
                 @endforelse
             </tbody>
         </table>
     </div>
 </div>