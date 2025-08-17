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