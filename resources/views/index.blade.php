 @extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Selamat Datang di eStudio</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">
            <!-- Hero Card -->
            <div class="col-12">
              <div class="card hero-card">
                <div class="card-body">
                  <h5 class="card-title">Sistem Pemesanan Studio e-Learning</h5>
                  <p>Layanan shooting video untuk kebutuhan pembelajaran, MOOC, marketing, dan lomba. Dapatkan pengalaman produksi video profesional dengan fasilitas lengkap dan tim editor berpengalaman.</p>
                  <a href="booking.html" class="btn btn-primary">Pesan Studio Sekarang</a>
                </div>
              </div>
            </div>

            <!-- Studio Availability -->
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Jadwal Studio Tersedia</h5>
                  <div class="calendar">
                    <div class="calendar-header">
                      <button class="btn btn-sm btn-outline-primary"><i class="bi bi-chevron-left"></i></button>
                      <span>Minggu Ini</span>
                      <button class="btn btn-sm btn-outline-primary"><i class="bi bi-chevron-right"></i></button>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Jam</th>
                            <th>Senin</th>
                            <th>Selasa</th>
                            <th>Rabu</th>
                            <th>Kamis</th>
                            <th>Jumat</th>
                            <th>Sabtu</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>09.00</td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                          </tr>
                          <tr>
                            <td>11.00</td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-secondary">Libur</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                          </tr>
                          <tr>
                            <td>13.00</td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-danger">Booked</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-danger">Booked</span></td>
                          </tr>
                          <tr>
                            <td>15.00</td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-danger">Booked</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                          </tr>
                          <tr>
                            <td>17.00</td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-danger">Booked</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Video Categories -->
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Koleksi Video Terbaru</h5>
                  <div class="row">
                    <div class="col-lg-3 col-md-6">
                      <div class="category-card">
                        <div class="category-icon bg-primary">
                          <i class="bi bi-book"></i>
                        </div>
                        <h6>MOOC</h6>
                        <a href="videos.html?category=mooc" class="btn btn-sm btn-outline-primary">Lihat Koleksi</a>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                      <div class="category-card">
                        <div class="category-icon bg-success">
                          <i class="bi bi-mortarboard"></i>
                        </div>
                        <h6>e-Learning</h6>
                        <a href="videos.html?category=elearning" class="btn btn-sm btn-outline-success">Lihat Koleksi</a>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                      <div class="category-card">
                        <div class="category-icon bg-info">
                          <i class="bi bi-megaphone"></i>
                        </div>
                        <h6>Marketing</h6>
                        <a href="videos.html?category=marketing" class="btn btn-sm btn-outline-info">Lihat Koleksi</a>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                      <div class="category-card">
                        <div class="category-icon bg-warning">
                          <i class="bi bi-trophy"></i>
                        </div>
                        <h6>Lomba</h6>
                        <a href="videos.html?category=competition" class="btn btn-sm btn-outline-warning">Lihat Koleksi</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right side columns -->
        <div class="col-lg-4">
          <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Aktivitas Terkini</h5>
              <div class="activity">
                <div class="activity-item d-flex">
                  <div class="activite-label">32 min</div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    Video "Pengantar Kecerdasan Buatan" telah dipublikasikan
                  </div>
                </div>

                <div class="activity-item d-flex">
                  <div class="activite-label">56 min</div>
                  <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                  <div class="activity-content">
                    Dr. Ahmad memesan Studio 1 untuk Jumat, 15.00
                  </div>
                </div>

                <div class="activity-item d-flex">
                  <div class="activite-label">2 jam</div>
                  <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                  <div class="activity-content">
                    Video "Strategi Pemasaran Digital" selesai diedit
                  </div>
                </div>

                <div class="activity-item d-flex">
                  <div class="activite-label">1 hari</div>
                  <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                  <div class="activity-content">
                    Mahasiswa TI memesan Studio 2 untuk Rabu, 09.00
                  </div>
                </div>

                <div class="activity-item d-flex">
                  <div class="activite-label">2 hari</div>
                  <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                  <div class="activity-content">
                    Video "Fisika Dasar" progres editing 75%
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Editor Performance -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Kinerja Editor</h5>
              <div class="chart-container">
                <canvas id="editorChart" width="100%" height="200"></canvas>
              </div>
              <div class="mt-3">
                <a href="statistics.html" class="btn btn-sm btn-outline-secondary">Lihat Detail</a>
              </div>
            </div>
          </div>

          <!-- Quick Booking -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Pesan Cepat</h5>
              <form class="quick-booking-form">
                <div class="mb-3">
                  <label for="studioSelect" class="form-label">Studio</label>
                  <select class="form-select" id="studioSelect">
                    <option selected>Pilih Studio</option>
                    <option value="1">Studio 1</option>
                    <option value="2">Studio 2</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="dateSelect" class="form-label">Tanggal</label>
                  <input type="date" class="form-control" id="dateSelect">
                </div>
                <div class="mb-3">
                  <label for="timeSelect" class="form-label">Waktu</label>
                  <select class="form-select" id="timeSelect">
                    <option selected>Pilih Waktu</option>
                    <option value="9">09.00</option>
                    <option value="11">11.00</option>
                    <option value="13">13.00</option>
                    <option value="15">15.00</option>
                    <option value="17">17.00</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Cek Ketersediaan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  @include('layout.footer')

  <script src="assets/js/main.js"></script>

  <script>
    // Editor Performance Chart
    document.addEventListener("DOMContentLoaded", () => {
      new Chart(document.querySelector('#editorChart'), {
        type: 'doughnut',
        data: {
          labels: ['Selesai', 'Dalam Proses', 'Belum Dikerjakan'],
          datasets: [{
            data: [45, 30, 25],
            backgroundColor: [
              '#4CAF50',
              '#FFC107',
              '#F44336'
            ],
            hoverOffset: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false
        }
      });
    });
  </script>