@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')


<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

      @include('dashboard.atas')


      <div class="row">

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
                  <!-- Data dummy, ganti dengan loop dari database -->
                  <tr>
                    <td>Video Promosi TI</td>
                    <td>Marketing</td>
                    <td>Dr. Budi</td>
                    <td>FTI</td>
                    <td>Teknik Informatika</td>
                    <td>Pemrograman Web</td>
                    <td><span class="badge bg-success">Published</span></td>
                  </tr>
                  <tr>
                    <td>Lomba Hackathon 2024</td>
                    <td>Lomba</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><span class="badge bg-success">Published</span></td>
                  </tr>
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
                    
                    <th>Aktivitas</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>17/07/2025 14:21</td>
                    <td>Admin Fakultas</td>
                    <td>Super Admin</td>
                    
                    <td>Menambahkan data MOOC</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>17/07/2025 15:03</td>
                    <td>Editor Prodi</td>
                    <td>Editor</td>
                    
                    <td>Mengedit profil dosen</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>17/07/2025 16:10</td>
                    <td>Mahasiswa</td>
                    <td>User</td>
                    
                    <td>Login ke sistem</td>
                  </tr>
                </tbody>
              </table>

            </div>
          </div>
        </div>

        @include('dashboard.bawah')

    </section>

    </div><!-- End Right side columns -->

    </div>
  </section>

</main><!-- End #main -->


@include('layout.footer')