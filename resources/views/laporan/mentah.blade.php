
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">LAPORAN JADWAL BOOKING</h5>
            <p class="text-center mb-1">UNIVERSITAS TEKNOKRAT INDONESIA</p>
            
            @php
                $jadwalBookings = collect();
                if(isset($progress) && $progress->isNotEmpty()) {
                    $jadwalBookings = $progress->pluck('jadwalBooking')->filter()->values();
                }
                
                // Group by date
                $groupedJadwal = $jadwalBookings->groupBy('tanggal')->sortKeys();
                $currentMonth = now()->format('F Y');
                $weeks = [
                    1 => 'MINGGU KE-1',
                    2 => 'MINGGU KE-2',
                    3 => 'MINGGU KE-3',
                    4 => 'MINGGU KE-4'
                ];
            @endphp
            
            <p class="text-center fw-bold">{{ $currentMonth }}</p>

            @if($groupedJadwal->isEmpty())
                <div class="text-center">
                    <p>Tidak ada jadwal booking untuk ditampilkan</p>
                </div>
            @else
                @foreach($groupedJadwal as $tanggal => $jadwalHarian)
                    @php
                        $date = \Carbon\Carbon::parse($tanggal);
                        $dayName = $date->translatedFormat('l');
                        $formattedDate = $date->translatedFormat('d F Y');
                        $weekNumber = ceil($date->day / 7);
                    @endphp
                    
                    <h6 class="mt-4">{{ $weeks[$weekNumber] ?? 'MINGGU KE-' . $weekNumber }}</h6>
                    <h6 class="mt-3">{{ $dayName }}, {{ $formattedDate }}</h6>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Dosen</th>
                                    <th>Judul Course</th>
                                    <th>Jenis Kategori</th>
                                    <th>Waktu</th>
                                    <th>Studio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jadwalHarian as $index => $jadwal)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $jadwal->dosen->nama_dosen ?? '-' }}</td>
                                        <td>{{ $jadwal->judul_course ?? '-' }}</td>
                                        <td>{{ $jadwal->jenis_kategori ?? '-' }}</td>
                                        <td>{{ $jadwal->jam ?? '-' }}</td>
                                        <td>{{ $jadwal->studio->nama_studio ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada jadwal untuk hari ini</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endforeach
            @endif
            
        </div>
    </div>

    
<div class="card p-4">
  <h4 class="text-center fw-bold mb-4">LIST TAUTAN VIDEO DOSEN MOOC</h4>

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


  <div class="card p-4">
        <h4 class="fw-bold mb-3">REKAPITULASI SHOOTING MOOC DOSEN</h4>
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


    
<div class="card p-4">
  <h4 class="text-center fw-bold">UNIVERSITAS TEKNOKRAT INDONESIA</h4>
  <h5 class="text-center mb-4">SEMESTER GANJIL 2024/2025<br>DOSEN MOOC</h5>

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
        @forelse($progress as $index => $item)
          @if($item->jadwalBooking && 
              $item->jadwalBooking->judul_course && 
              $item->progres === 'selesai' && 
              $item->jadwalBooking->jenis_kategori === 'Mooc')
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
              <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
              <td>
                @if($item->keterangan)
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
          @endif
        @empty
          <tr>
            <td colspan="6" class="text-center">Tidak ada data laporan</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <!-- Pagination untuk Tabel Progres Editor -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Menampilkan {{ $progress->firstItem() ?? 0 }} - {{ $progress->lastItem() ?? 0 }} dari {{ $progress->total() }} entri
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end mb-0">
                        {{ $progress->links('pagination::bootstrap-4') }}
                    </ul>
                </nav>
            </div>
   </div>

   
<div class="card p-4">
  <h5 class="text-center fw-bold">REKAP VIDEO PEMBELAJARAN DOSEN TETAP</h5>
  <h6 class="text-center mb-3">FAKULTAS TEKNIK DAN ILMU KOMPUTER<br>UNIVERSITAS TEKNOKRAT INDONESIA</h6>

  
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

  
<div class="card p-4">
  <h5 class="text-center fw-bold">REKAP VIDEO PEMBELAJARAN DOSEN TETAP</h5>
  <h6 class="text-center mb-3">UNIVERSITAS TEKNOKRAT INDONESIA</h6>

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
          $fakultasDataTetap = [];
          foreach($progressTetap as $item) {
              $dosen = $item->jadwalBooking->dosen;
              $fakultas = $dosen->fakultas->nama_fakultas ?? 'Tidak Diketahui';
              $dosenId = $dosen->id;
              
              if (!isset($fakultasDataTetap[$fakultas])) {
                  $fakultasDataTetap[$fakultas] = [
                      'jumlah_dosen' => \App\Models\Dosen::where('fakultas_id', $dosen->fakultas_id)->count(),
                      'pembelajaran' => 0,
                      'mooc' => 0,
                      'editing' => 0,
                      'total' => 0
                  ];
              }
              
              if($item->progres == 'selesai') {
                  if(str_contains(strtolower($item->judul_video ?? ''), 'mooc')) {
                      $fakultasDataTetap[$fakultas]['mooc']++;
                  } else {
                      $fakultasDataTetap[$fakultas]['pembelajaran']++;
                  }
              } elseif($item->progres == 'progres') {
                  $fakultasDataTetap[$fakultas]['editing']++;
              }
              
              $fakultasDataTetap[$fakultas]['total']++;
          }
          
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

  <h5 class="text-center fw-bold">REKAP VIDEO PEMBELAJARAN DOSEN TIDAK TETAP</h5>
  <h6 class="text-center mb-3">UNIVERSITAS TEKNOKRAT INDONESIA</h6>

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
          $fakultasDataTidakTetap = [];
          foreach($progressTidakTetap as $item) {
              $dosen = $item->jadwalBooking->dosen;
              $fakultas = $dosen->fakultas->nama_fakultas ?? 'Tidak Diketahui';
              $dosenId = $dosen->id;
              
              if (!isset($fakultasDataTidakTetap[$fakultas])) {
                  $fakultasDataTidakTetap[$fakultas] = [
                      'jumlah_dosen' => \App\Models\Dosen::where('fakultas_id', $dosen->fakultas_id)->count(),
                      'pembelajaran' => 0,
                      'editing' => 0,
                      'total' => 0
                  ];
              }
              
              if($item->progres == 'selesai') {
                  $fakultasDataTidakTetap[$fakultas]['pembelajaran']++;
              } elseif($item->progres == 'progres') {
                  $fakultasDataTidakTetap[$fakultas]['editing']++;
              }
              
              $fakultasDataTidakTetap[$fakultas]['total']++;
          }
          
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