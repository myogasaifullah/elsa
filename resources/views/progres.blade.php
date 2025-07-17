@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Progres</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Progres</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tabel Progres Produksi MOOC</h5>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Dosen</th>
                                        <th>Fakultas</th>
                                        <th>Mata Kuliah</th>
                                        <th>Kategori MOOC</th>
                                        <th>Judul Course</th>
                                        <th>Studio</th>
                                        <th>Tanggal Shooting</th>
                                        <th>Waktu</th>
                                        <th>Jenis Kategori</th>
                                        <th>Target Upload</th>
                                        <th>Progres</th>
                                        <th>Durasi (Menit)</th>
                                        <th>Tautan Video</th>
                                        <th>Tgl Upload YouTube</th>
                                        <th>Editor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Dr. Andi Maulana</td>
                                        <td>Teknik dan Ilmu Komputer</td>
                                        <td>Rekayasa Perangkat Lunak</td>
                                        <td>MOOC Mandiri</td>
                                        <td>Pemrograman Web Lanjut</td>
                                        <td>Studio 1</td>
                                        <td>2025-07-18</td>
                                        <td>08:00 - 10:00</td>
                                        <td>Video Teaching</td>
                                        <td>2025-07-30</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" style="width: 70%;">70%</div>
                                            </div>
                                        </td>
                                        <td>45</td>
                                        <td><a href="https://youtu.be/xxxxxxx" target="_blank">Lihat Video</a></td>
                                        <td>2025-07-19</td>
                                        <td>Rizky Putra</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Siti Rahma, M.Kom</td>
                                        <td>Ilmu Pendidikan</td>
                                        <td>Manajemen Pendidikan</td>
                                        <td>MOOC Nasional</td>
                                        <td>Pengantar Kurikulum</td>
                                        <td>Studio 2</td>
                                        <td>2025-07-20</td>
                                        <td>10:00 - 12:00</td>
                                        <td>Presentasi Video</td>
                                        <td>2025-08-01</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" style="width: 100%;">100%</div>
                                            </div>
                                        </td>
                                        <td>30</td>
                                        <td><a href="https://youtu.be/yyyyyyy" target="_blank">Lihat Video</a></td>
                                        <td>2025-07-22</td>
                                        <td>Nur Azizah</td>
                                    </tr>
                                    <!-- Tambahkan baris lainnya sesuai data -->
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

@include('layout.footer')
