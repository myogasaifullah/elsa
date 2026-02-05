<section class="section">
  <div class="row">

    <!-- Users Card -->
    <div class="col-xxl-4 col-md-6">
      <div class="card info-card users-card">

        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Filter</h6>
            </li>
            <li><a class="dropdown-item" href="#">Today</a></li>
            <li><a class="dropdown-item" href="#">This Month</a></li>
            <li><a class="dropdown-item" href="#">This Year</a></li>
          </ul>
        </div>

        <div class="card-body">
          <h5 class="card-title">Users <span>| Total</span></h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-people"></i>
            </div>
            <div class="ps-3">
              <h6>{{ $data['counts']['users'] }}</h6>
              <span class="text-success small pt-1 fw-bold">Total Users</span>
            </div>
          </div>
        </div>

      </div>
    </div><!-- End Users Card -->

    <!-- Bookings Card -->
    <div class="col-xxl-4 col-md-6">
      <div class="card info-card bookings-card">

        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Filter</h6>
            </li>
            <li><a class="dropdown-item" href="#">Today</a></li>
            <li><a class="dropdown-item" href="#">This Month</a></li>
            <li><a class="dropdown-item" href="#">This Year</a></li>
          </ul>
        </div>

        <div class="card-body">
          <h5 class="card-title">Bookings <span>| Total</span></h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-calendar-check"></i>
            </div>
            <div class="ps-3">
              <h6>{{ $data['counts']['bookings'] }}</h6>
              <span class="text-success small pt-1 fw-bold">Total Bookings</span>
            </div>
          </div>
        </div>

      </div>
    </div><!-- End Bookings Card -->

    <!-- Studios Card -->
    <div class="col-xxl-4 col-xl-12">
      <div class="card info-card studios-card">

        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Filter</h6>
            </li>
            <li><a class="dropdown-item" href="#">Today</a></li>
            <li><a class="dropdown-item" href="#">This Month</a></li>
            <li><a class="dropdown-item" href="#">This Year</a></li>
          </ul>
        </div>

        <div class="card-body">
          <h5 class="card-title">Studios <span>| Total</span></h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-building"></i>
            </div>
            <div class="ps-3">
              <h6>{{ $data['counts']['studios'] }}</h6>
              <span class="text-success small pt-1 fw-bold">Total Studios</span>
            </div>
          </div>
        </div>

      </div>
    </div><!-- End Studios Card -->

    <!-- Additional Statistics Cards -->
    <div class="col-xxl-4 col-md-6">
      <div class="card info-card dosen-card">
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Filter</h6>
            </li>
            <li><a class="dropdown-item" href="#">Today</a></li>
            <li><a class="dropdown-item" href="#">This Month</a></li>
            <li><a class="dropdown-item" href="#">This Year</a></li>
          </ul>
        </div>
        <div class="card-body">
          <h5 class="card-title">Dosen <span>| Total</span></h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-person-badge"></i>
            </div>
            <div class="ps-3">
              <h6>{{ $data['counts']['dosens'] }}</h6>
              <span class="text-success small pt-1 fw-bold">Total Dosen</span>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Dosen Card -->

    <div class="col-xxl-4 col-md-6">
      <div class="card info-card editors-card">
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Filter</h6>
            </li>
            <li><a class="dropdown-item" href="#">Today</a></li>
            <li><a class="dropdown-item" href="#">This Month</a></li>
            <li><a class="dropdown-item" href="#">This Year</a></li>
          </ul>
        </div>
        <div class="card-body">
          <h5 class="card-title">Editors <span>| Total</span></h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-pencil-square"></i>
            </div>
            <div class="ps-3">
              <h6>{{ $data['counts']['editors'] }}</h6>
              <span class="text-success small pt-1 fw-bold">Total Editors</span>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Editors Card -->

    <div class="col-xxl-4 col-md-6">
      <div class="card info-card progress-card">
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Filter</h6>
            </li>
            <li><a class="dropdown-item" href="#">Today</a></li>
            <li><a class="dropdown-item" href="#">This Month</a></li>
            <li><a class="dropdown-item" href="#">This Year</a></li>
          </ul>
        </div>
        <div class="card-body">
          <h5 class="card-title">Progress <span>| Total</span></h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-graph-up"></i>
            </div>
            <div class="ps-3">
              <h6>{{ $data['counts']['progresses'] }}</h6>
              <span class="text-success small pt-1 fw-bold">Total Progress</span>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Progress Card -->

  </div>
  <!-- Users Data -->


  <!-- Bookings Data -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Bookings ({{ $data['bookings']->count() }})</h5>

          <table class="table datatable">
            <thead>
              <tr>
                <!-- <th>ID</th> -->
                <th>User</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Jenis Kategori</th>
                <th>Kategori MOOC</th>
                <th>Studio</th>
                <th>Nama Mata Kuliah</th>
                <th>Judul Course</th>
                <th>Status</th>
                <th>Dosen</th>
                <!-- <th>Created At</th>
                <th>Updated At</th> -->
              </tr>
            </thead>
            <tbody>
              @foreach($data['bookings'] as $booking)
              <tr>
                <!-- <td>{{ $booking->id }}</td> -->
                <td>{{ $booking->user->name ?? '-' }}</td>
                <td>{{ $booking->tanggal ? \Carbon\Carbon::parse($booking->tanggal)->format('d/m/Y') : '-' }}</td>
                <td>{{ $booking->jam ?? '-' }}</td>
                <td>{{ $booking->jenis_kategori ?? '-' }}</td>
                <td>{{ $booking->kategori_mooc ?? '-' }}</td>
                <td>{{ $booking->studio->nama_studio ?? '-' }}</td>
                <td>{{ $booking->nama_mata_kuliah ?? '-' }}</td>
                <td>{{ $booking->judul_course ?? '-' }}</td>
                <td><span class="badge bg-{{ $booking->status == 'approved' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'danger') }}">{{ $booking->status ?? '-' }}</span></td>
                <td>{{ $booking->dosen->nama_dosen ?? '-' }}</td>
                <!-- <td>{{ $booking->created_at ? $booking->created_at->format('d/m/Y H:i') : '-' }}</td>
                <td>{{ $booking->updated_at ? $booking->updated_at->format('d/m/Y H:i') : '-' }}</td> -->
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Fakultas Data -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Fakultas ({{ $data['fakultas']->count() }})</h5>

          <table class="table datatable">
            <thead>
              <tr>
                <!-- <th>ID</th> -->
                <th>Nama Fakultas</th>
                <th>Kode Fakultas</th>
                <th>Singkatan</th>
                <!-- <th>Created At</th>
                <th>Updated At</th> -->
              </tr>
            </thead>
            <tbody>
              @foreach($data['fakultas'] as $fakultas)
              <tr>
                <!-- <td>{{ $fakultas->id }}</td> -->
                <td>{{ $fakultas->nama_fakultas }}</td>
                <td>{{ $fakultas->kode_fakultas ?? '-' }}</td>
                <td>{{ $fakultas->singkatan ?? '-' }}</td>
                <!-- <td>{{ $fakultas->created_at ? $fakultas->created_at->format('d/m/Y H:i') : '-' }}</td>
                <td>{{ $fakultas->updated_at ? $fakultas->updated_at->format('d/m/Y H:i') : '-' }}</td> -->
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Prodi Data -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Prodi ({{ $data['prodis']->count() }})</h5>

          <table class="table datatable">
            <thead>
              <tr>
                <!-- <th>ID</th> -->
                <th>Nama Prodi</th>
                <th>Kode Prodi</th>
                <th>Fakultas</th>
                <!-- <th>Created At</th>
                <th>Updated At</th> -->
              </tr>
            </thead>
            <tbody>
              @foreach($data['prodis'] as $prodi)
              <tr>
                <!-- <td>{{ $prodi->id }}</td> -->
                <td>{{ $prodi->nama_prodi }}</td>
                <td>{{ $prodi->kode_prodi ?? '-' }}</td>
                <td>{{ $prodi->fakultas->nama_fakultas ?? '-' }}</td>
                <!-- <td>{{ $prodi->created_at ? $prodi->created_at->format('d/m/Y H:i') : '-' }}</td>
                <td>{{ $prodi->updated_at ? $prodi->updated_at->format('d/m/Y H:i') : '-' }}</td> -->
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Studios Data -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Studios ({{ $data['studios']->count() }})</h5>
          <div class="row" id="studioContainer">
            @foreach($data['studios'] as $studio)
            <div class="col-lg-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  {{-- Header Card --}}
                  <h5 class="card-title">{{ $studio->nama_studio }}</h5>
                  <p><code>{{ $studio->lokasi }}</code></p>

                  {{-- Carousel Gambar Studio --}}
                  @if($studio->gambarStudio->count() > 0)
                  <div id="carouselFade{{ $studio->id }}" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      @foreach($studio->gambarStudio as $index => $gambar)
                      <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-gambar-id="{{ $gambar->id }}">
                        <div class="position-relative">
                          <img src="{{ asset('storage/' . $gambar->path) }}" class="d-block w-100" alt="Gambar Studio" style="height: 400px; object-fit: cover; object-position: center;">
                        </div>
                      </div>
                      @endforeach
                    </div>

                    {{-- Control Navigasi Carousel --}}
                    @if($studio->gambarStudio->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselFade{{ $studio->id }}" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselFade{{ $studio->id }}" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                    @endif
                  </div>

                  {{-- Indikator gambar --}}
                  @if($studio->gambarStudio->count() > 1)
                  <div class="gambar-indicator" id="indicator{{ $studio->id }}">
                    @foreach($studio->gambarStudio as $index => $gambar)
                    <div class="indicator-dot {{ $index == 0 ? 'active' : '' }}" data-bs-target="#carouselFade{{ $studio->id }}" data-bs-slide-to="{{ $index }}"></div>
                    @endforeach
                  </div>
                  @endif
                  @else
                  <div class="text-center">
                    <img src="{{ asset('assets/img/slides-1.jpg') }}" class="d-block w-100" alt="Gambar Default" style="height: 250px; object-fit: cover; object-position: center;">
                  </div>
                  @endif
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mata Kuliah Data -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Mata Kuliah ({{ $data['mata_kuliahs']->count() }})</h5>

          <table class="table datatable">
            <thead>
              <tr>
                <!-- <th>ID</th> -->
                <th>Fakultas</th>
                <th>Prodi</th>
                <th>Nama Mata Kuliah</th>
                <th>Kode Matakuliah</th>
                <th>SKS</th>
                <th>Keterangan</th>
                <!-- <th>Created At</th>
                <th>Updated At</th> -->
              </tr>
            </thead>
            <tbody>
              @foreach($data['mata_kuliahs'] as $matkul)
              <tr>
                <!-- <td>{{ $matkul->id }}</td> -->
                <td>{{ $matkul->fakultas->nama_fakultas ?? '-' }}</td>
                <td>{{ $matkul->prodi->nama_prodi ?? '-' }}</td>
                <td>{{ $matkul->nama_mata_kuliah }}</td>
                <td>{{ $matkul->kode_matakuliah ?? '-' }}</td>
                <td>{{ $matkul->sks ?? '-' }}</td>
                <td>{{ $matkul->keterangan ?? '-' }}</td>
                <!-- <td>{{ $matkul->created_at ? $matkul->created_at->format('d/m/Y H:i') : '-' }}</td>
                <td>{{ $matkul->updated_at ? $matkul->updated_at->format('d/m/Y H:i') : '-' }}</td> -->
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Progress Data -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Progress ({{ $data['progresses']->count() }})</h5>

          <table class="table datatable">
            <thead>
              <tr>
                <!-- <th>ID</th> -->
                <!-- <th>Jadwal Booking ID</th> -->
                <!-- <th>Editor ID</th> -->
                <th>Jadwal Booking</th>
                <th>Editor</th>
                <th>Persentase</th>
                <th>Keterangan</th>
                <th>Publish Link YouTube</th>
                <!-- <th>Created At</th>
                <th>Updated At</th> -->
              </tr>
            </thead>
            <tbody>
              @foreach($data['progresses'] as $progress)
              <tr>
                <!-- <td>{{ $progress->id }}</td> -->
                <!-- <td>{{ $progress->jadwal_booking_id ?? '-' }}</td>
                <td>{{ $progress->editor_id ?? '-' }}</td> -->
                <td>{{ $progress->jadwalBooking->judul_course ?? '-' }}</td>
                <td>{{ $progress->editor->nama ?? '-' }}</td>
                <td>
                  <span class="badge
                    @if($progress->persentase >= 0 && $progress->persentase <= 25) bg-danger
                    @elseif($progress->persentase > 25 && $progress->persentase <= 50) bg-warning text-dark
                    @elseif($progress->persentase > 50 && $progress->persentase <= 75) bg-info text-dark
                    @elseif($progress->persentase > 75 && $progress->persentase <= 100) bg-success
                    @else bg-secondary
                    @endif">
                    {{ $progress->persentase }}%
                  </span>
                </td>
                <td>
                  <span class="badge
                    @if(strtolower($progress->keterangan) == 'draft') bg-secondary
                    @elseif(strtolower($progress->keterangan) == 'review') bg-warning text-dark
                    @elseif(strtolower($progress->keterangan) == 'editing') bg-info text-dark
                    @elseif(strtolower($progress->keterangan) == 'completed' || strtolower($progress->keterangan) == 'finished') bg-success
                    @elseif(strtolower($progress->keterangan) == 'published' || strtolower($progress->keterangan) == 'sudah terbit') bg-primary
                    @elseif(strtolower($progress->keterangan) == 'belum terbit') bg-danger
                    @else bg-light text-dark
                    @endif">
                    {{ $progress->keterangan ?? '-' }}
                  </span>
                </td>
                <td>{!! $progress->publish_link_youtube ? '<a href="' . $progress->publish_link_youtube . '" target="_blank">Link Video</a>' : '-' !!}</td>
                <!-- <td>{{ $progress->created_at ? $progress->created_at->format('d/m/Y H:i') : '-' }}</td>
                <td>{{ $progress->updated_at ? $progress->updated_at->format('d/m/Y H:i') : '-' }}</td> -->
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <!-- Table Video Berdasarkan Kategori
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Daftar Video</h5>

        <table class="table datatable">
          <thead>
            <tr>
              <th>Judul</th>
              <th>Kategori</th>
              <th>Dosen</th>
              <th>Fakultas</th>
              <th>Prodi</th>
              <th>Mata Kuliah</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data['videos'] as $video)
            <tr>
              <td>{{ $video->judul_mooc }}</td>
              <td>MOOC</td>
              <td>{{ $video->dosen->nama_dosen ?? '-' }}</td>
              <td>{{ $video->dosen->fakultas->nama_fakultas ?? '-' }}</td>
              <td>{{ $video->dosen->prodi->nama_prodi ?? '-' }}</td>
              <td>{{ $video->dosen->mata_kuliah->nama_mata_kuliah ?? '-' }}</td>
              <td><span class="badge bg-success">Published</span></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div> -->

  <!-- log aktifitas -->
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Log Aktivitas</h5>

        <table class="table datatable">
          <thead>
            <tr>
              <th>No</th>
              <th>Waktu</th>
              <th>Nama Pengguna</th>
              <th>Role</th>
              <!-- <th>IP Address</th> -->
              <th>Aktivitas</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data['logs'] as $index => $log)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $log->created_at }}</td>
              <td>{{ $log->user->name ?? '-' }}</td>
              <td>{{ $log->user->role ?? '-' }}</td>
              <!-- <td>-</td> -->
              <td>{{ $log->action }} - {{ $log->description }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>

  <div class="col-lg-12">

  </div><!-- End Left side columns -->
</section>