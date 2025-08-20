<!-- Tabel Progres Editor -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tabel Progres Editor</h5>
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
                                <td>{{ $index + 1 }}</td>
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
        </div>
    </div>

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
