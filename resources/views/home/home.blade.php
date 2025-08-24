
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Users ({{ $data['users']->count() }})</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['users'] as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><span class="badge bg-info">{{ $user->role }}</span></td>
                                        <td>{{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bookings Data -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Bookings ({{ $data['bookings']->count() }})</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Studio</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['bookings'] as $booking)
                                    <tr>
                                        <td>{{ $booking->id }}</td>
                                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                                        <td>{{ $booking->studio->nama ?? 'N/A' }}</td>
                                        <td><span class="badge bg-{{ $booking->status == 'approved' ? 'success' : 'warning' }}">{{ $booking->status }}</span></td>
                                        <td>{{ $booking->created_at ? $booking->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dosen Data -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Dosen ({{ $data['dosens']->count() }})</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>NIDN</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['dosens'] as $dosen)
                                    <tr>
                                        <td>{{ $dosen->id }}</td>
                                        <td>{{ $dosen->nama }}</td>
                                        <td>{{ $dosen->nidn }}</td>
                                        <td>{{ $dosen->email }}</td>
                                        <td><span class="badge bg-{{ $dosen->status == 'active' ? 'success' : 'secondary' }}">{{ $dosen->status }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Editors Data -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Editors ({{ $data['editors']->count() }})</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Specialization</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['editors'] as $editor)
                                    <tr>
                                        <td>{{ $editor->id }}</td>
                                        <td>{{ $editor->nama }}</td>
                                        <td>{{ $editor->email }}</td>
                                        <td>{{ $editor->specialization }}</td>
                                        <td><span class="badge bg-{{ $editor->status == 'active' ? 'success' : 'secondary' }}">{{ $editor->status }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Fakultas</th>
                                        <th>Kode</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['fakultas'] as $fakultas)
                                    <tr>
                                        <td>{{ $fakultas->id }}</td>
                                        <td>{{ $fakultas->nama_fakultas }}</td>
                                        <td>{{ $fakultas->kode_fakultas }}</td>
                                        <td>{{ $fakultas->created_at ? $fakultas->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Prodi</th>
                                        <th>Kode</th>
                                        <th>Fakultas</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['prodis'] as $prodi)
                                    <tr>
                                        <td>{{ $prodi->id }}</td>
                                        <td>{{ $prodi->nama_prodi }}</td>
                                        <td>{{ $prodi->kode_prodi }}</td>
                                        <td>{{ $prodi->fakultas->nama_fakultas ?? 'N/A' }}</td>
                                        <td>{{ $prodi->created_at ? $prodi->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Studio</th>
                                        <th>Lokasi</th>
                                        <th>Kapasitas</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['studios'] as $studio)
                                    <tr>
                                        <td>{{ $studio->id }}</td>
                                        <td>{{ $studio->nama }}</td>
                                        <td>{{ $studio->lokasi }}</td>
                                        <td>{{ $studio->kapasitas }}</td>
                                        <td><span class="badge bg-{{ $studio->status == 'available' ? 'success' : 'secondary' }}">{{ $studio->status }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Mata Kuliah</th>
                                        <th>Kode</th>
                                        <th>SKS</th>
                                        <th>Semester</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['mata_kuliahs'] as $matkul)
                                    <tr>
                                        <td>{{ $matkul->id }}</td>
                                        <td>{{ $matkul->nama_matkul }}</td>
                                        <td>{{ $matkul->kode_matkul }}</td>
                                        <td>{{ $matkul->sks }}</td>
                                        <td>{{ $matkul->semester }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Jadwal Booking</th>
                                        <th>Progress</th>
                                        <th>Editor</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['progresses'] as $progress)
                                    <tr>
                                        <td>{{ $progress->id }}</td>
                                        <td>{{ $progress->jadwalBooking->id ?? 'N/A' }}</td>
                                        <td>{{ $progress->progres }}%</td>
                                        <td>{{ $progress->editor->nama ?? 'N/A' }}</td>
                                        <td><span class="badge bg-{{ $progress->status == 'completed' ? 'success' : 'warning' }}">{{ $progress->status }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Table Video Berdasarkan Kategori -->
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
                    <td>{{ $video->dosen->nama_dosen ?? 'N/A' }}</td>
                    <td>{{ $video->dosen->fakultas->nama_fakultas ?? 'N/A' }}</td>
                    <td>{{ $video->dosen->prodi->nama_prodi ?? 'N/A' }}</td>
                    <td>N/A</td>
                    <td><span class="badge bg-success">Published</span></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

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
                    <th>IP Address</th>
                    <th>Aktivitas</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data['logs'] as $index => $log)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $log->created_at }}</td>
                    <td>{{ $log->user->name ?? 'N/A' }}</td>
                    <td>{{ $log->user->role ?? 'N/A' }}</td>
                    <td>N/A</td>
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