@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Booking Jadwal</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                <li class="breadcrumb-item active">Laporan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

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
                        <tr>
                            <td>1</td>
                            <td>Felly Misdalena, S.T., M.T.</td>
                            <td>FTIK</td>
                            <td>Rekayasa Lalu Lintas</td>
                            <td>Persimpangan</td>
                            <td>STUDIO 1</td>
                            <td>30 December 2024</td>
                            <td>Marketing</td>
                            <td>11 January 2025</td>
                            <td>Ilham</td>
                            <td><span class="badge bg-secondary">Belum</span></td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Dr. Erliyan Redi Susanto, S.Kom., M.Kom.</td>
                            <td>FTIK</td>
                            <td>Manajemen dan Keamanan Basisdata</td>
                            <td>Managing Users in a Database</td>
                            <td>STUDIO 1</td>
                            <td>7 January 2025</td>
                            <td>Video Pembelajaran</td>
                            <td>16 January 2025</td>
                            <td>Novi</td>
                            <td><span class="badge bg-warning text-dark">Progres</span></td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Ridwan Mahenra, M.Cs., AI.</td>
                            <td>FTIK</td>
                            <td>-</td>
                            <td>Cognitive Computing</td>
                            <td>STUDIO 2</td>
                            <td>7 January 2025</td>
                            <td>MOOC</td>
                            <td>11 January 2025</td>
                            <td>Erdi</td>
                            <td><span class="badge bg-success">Selesai</span></td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Jadwal Shooting Video Pembelajaran -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title text-center">JADWAL SHOOTING VIDEO PEMBELAJARAN DOSEN</h5>
    <p class="text-center mb-1">UNIVERSITAS TEKNOKRAT INDONESIA</p>
    <p class="text-center fw-bold">BULAN JUNI 2025</p>

    <!-- Minggu Ke-1 -->
    <h6 class="mt-4">MINGGU KE-1</h6>

    <!-- Senin, 9 Juni 2025 -->
    <h6 class="mt-3">Senin, 9 Juni 2025</h6>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Dosen</th>
            <th>Judul Course</th>
            <th>Jenis Shooting</th>
            <th>Waktu</th>
            <th>Editor</th>
          </tr>
        </thead>
        <tbody>
          <tr><td>1</td><td>Tri Widodo, S.T., M.Kom.</td><td>Transistor</td><td>MOOC</td><td>10.00 WIB - 11.00 WIB</td><td>Novi</td></tr>
          <tr><td>2</td><td>Ade Dwi Putra, S.Kom., M.Kom.</td><td>Pengenalan Spada</td><td>VIDEO PEMBELAJARAN</td><td>11.00 WIB - 12.00 WIB</td><td>Erdi</td></tr>
          <tr><td>3</td><td>Ridwan Mahenra, M.Cs., AI.</td><td>Artificial Intelligence</td><td>MOOC</td><td>13.30 WIB - 14.30 WIB</td><td>Izza</td></tr>
        </tbody>
      </table>
    </div>

    <!-- Selasa, 10 Juni 2025 -->
    <h6 class="mt-4">Selasa, 10 Juni 2025</h6>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Dosen</th>
            <th>Judul Course</th>
            <th>Jenis Shooting</th>
            <th>Waktu</th>
            <th>Editor</th>
          </tr>
        </thead>
        <tbody>
          <tr><td>1</td><td>Aditia Yudhistira, S.Kom., M.Kom.</td><td>Data Mining</td><td>VIDEO PEMBELAJARAN</td><td>10.00 WIB - 11.00 WIB</td><td>Izza</td></tr>
          <tr><td>2</td><td>Sigit Doni R., M.Eng.</td><td>-</td><td>VIDEO PEMBELAJARAN</td><td>11.00 WIB - 12.00 WIB</td><td>Erdi</td></tr>
          <tr><td>3</td><td>Destiana Safitri, S.T., M.T.</td><td>-</td><td>VIDEO PEMBELAJARAN</td><td>13.30 WIB - 14.30 WIB</td><td>Novi</td></tr>
        </tbody>
      </table>
    </div>

    <!-- Rabu, 11 Juni 2025 -->
    <h6 class="mt-4">Rabu, 11 Juni 2025</h6>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Dosen</th>
            <th>Judul Course</th>
            <th>Jenis Shooting</th>
            <th>Waktu</th>
            <th>Editor</th>
          </tr>
        </thead>
        <tbody>
          <tr><td>1</td><td>Fadila Shely Amalia, S.Kom., M.Cs.</td><td>Computer Networking</td><td>VIDEO PEMBELAJARAN</td><td>10.00 WIB - 11.00 WIB</td><td>Erdi</td></tr>
          <tr><td>2</td><td>Dyah Ayu Megawaty, S.Kom., M.Kom.</td><td>Rekayasa Perangkat Lunak</td><td>VIDEO PEMBELAJARAN</td><td>11.00 WIB - 12.00 WIB</td><td>Novi</td></tr>
          <tr><td>3</td><td>Rusliyawati, S.Kom., M.T.I.</td><td>MPSI</td><td>VIDEO PEMBELAJARAN</td><td>13.30 WIB - 14.30 WIB</td><td>Izza</td></tr>
        </tbody>
      </table>
    </div>

    <!-- Kamis, 12 Juni 2025 -->
    <h6 class="mt-4">Kamis, 12 Juni 2025</h6>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Dosen</th>
            <th>Judul Course</th>
            <th>Jenis Shooting</th>
            <th>Waktu</th>
            <th>Editor</th>
          </tr>
        </thead>
        <tbody>
          <tr><td>1</td><td>Angga Bayu Santoso, S.Kom., M.Kom.</td><td>-</td><td>VIDEO PEMBELAJARAN</td><td>10.00 WIB - 11.00 WIB</td><td>Novi</td></tr>
          <tr><td>2</td><td>Dr. Amarudin, S.Kom., M.Eng.</td><td>Data Mining</td><td>VIDEO PEMBELAJARAN</td><td>11.00 WIB - 12.00 WIB</td><td>Izza</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="card p-4">
  <h4 class="text-center fw-bold mb-4">LIST TAUTAN VIDEO DOSEN MOOC</h4>

  <div class="table-responsive">
    <table class="table table-bordered text-sm align-middle text-center">
      <thead>
        <tr>
          <th colspan="5">Fakultas Teknik dan Ilmu Komputer</th>
          <th colspan="5">Fakultas Ekonomi dan Bisnis</th>
          <th colspan="5">Fakultas Sastra dan Ilmu Pendidikan</th>
        </tr>
        <tr>
          <!-- FTIK -->
          <th>No</th>
          <th>Nama Dosen</th>
          <th>Kategori MOOC</th>
          <th>Judul Course</th>
          <th>Tautan Video</th>

          <!-- FEB -->
          <th>No</th>
          <th>Nama Dosen</th>
          <th>Kategori MOOC</th>
          <th>Judul Course</th>
          <th>Tautan Video</th>

          <!-- FSIP -->
          <th>No</th>
          <th>Nama Dosen</th>
          <th>Kategori MOOC</th>
          <th>Judul Course</th>
          <th>Tautan Video</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <!-- FTIK -->
          <td>1</td>
          <td>Yuri Rahmanto, M.Kom</td>
          <td>Metaverse</td>
          <td>Defining the Metaverse</td>
          <td><a href="https://youtu.be/s8shV-nZ1fA" target="_blank">Tonton</a></td>

          <!-- FEB -->
          <td>1</td>
          <td>Rosmala Sari, S.E</td>
          <td>Entrepreneurship</td>
          <td>Ethic in the Marketplace</td>
          <td><a href="https://youtu.be/kG0REzGSfeo" target="_blank">Tonton</a></td>

          <!-- FSIP -->
          <td>1</td>
          <td>Dwi Puspaning</td>
          <td>Calculus</td>
          <td>Introduction to Integral</td>
          <td><a href="https://youtu.be/N36Pt4aUBFU" target="_blank">Tonton</a></td>
        </tr>
        <tr>
          <!-- FTIK -->
          <td>2</td>
          <td>Slamet Samsugi, M.Eng</td>
          <td>Smart Agriculture</td>
          <td>Evolution of Smart Agriculture</td>
          <td><a href="https://youtu.be/mH_CLGbfrYQs" target="_blank">Tonton</a></td>

          <!-- FEB -->
          <td>2</td>
          <td>Suhdyasari S. Ak</td>
          <td>Entrepreneurship</td>
          <td>Business Model</td>
          <td><a href="https://youtu.be/w5uJaTYw2oA" target="_blank">Tonton</a></td>

          <!-- FSIP -->
          <td>2</td>
          <td>Dina Amelia</td>
          <td>English for Daily Activity</td>
          <td>Describing People</td>
          <td><a href="https://youtu.be/dLioq5ZoGfA" target="_blank">Tonton</a></td>
        </tr>
        <tr>
          <!-- FTIK -->
          <td>3</td>
          <td>Elka Pranita, S.Pd., M.T.</td>
          <td>Renewable Energy</td>
          <td>MOOC - Renewable Energy</td>
          <td><a href="https://youtu.be/KqVHhGfYKVk" target="_blank">Tonton</a></td>

          <!-- FEB -->
          <td>3</td>
          <td>Monica Septiani, M.M.</td>
          <td>Entrepreneurship</td>
          <td>Marketing</td>
          <td><a href="https://youtu.be/K5GzLrDhvTE" target="_blank">Tonton</a></td>

          <!-- FSIP -->
          <td>3</td>
          <td>Sprayogi, S.S., M.Hum</td>
          <td>Public Speaking</td>
          <td>Public Speaking Basic</td>
          <td><a href="https://youtu.be/EV4ULXoeiqQ" target="_blank">Tonton</a></td>
        </tr>
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
        <tr>
          <td>1</td>
          <td>Yuri Rahmanto</td>
          <td>5</td>
          <td>5</td>
          <td>0</td>
          <td>0</td>
          <td>5</td>
          <td><span class="badge bg-success">Selesai Shooting</span></td>
          <td><a href="#" class="badge bg-primary">Selesai Terbit</a></td>
        </tr>
        <tr>
          <td>2</td>
          <td>Slamet Samsugi</td>
          <td>5</td>
          <td>4</td>
          <td>0</td>
          <td>1</td>
          <td>0</td>
          <td><span class="badge bg-warning text-dark">Belum Selesai</span></td>
          <td><a href="#" class="badge bg-info text-dark">Belum Selesai</a></td>
        </tr>
        <tr>
          <td>3</td>
          <td>Elka Pranita</td>
          <td>5</td>
          <td>5</td>
          <td>0</td>
          <td>0</td>
          <td>5</td>
          <td><span class="badge bg-success">Selesai Shooting</span></td>
          <td><a href="#" class="badge bg-primary">Selesai Terbit</a></td>
        </tr>
        <tr>
          <td>4</td>
          <td>Ridwan Mahendra</td>
          <td>5</td>
          <td>3</td>
          <td>0</td>
          <td>2</td>
          <td>0</td>
          <td><span class="badge bg-warning text-dark">Belum Selesai</span></td>
          <td><a href="#" class="badge bg-info text-dark">Belum Selesai</a></td>
        </tr>
        <!-- Tambahkan data dosen lainnya sesuai kebutuhan -->
        <tr class="table-secondary fw-bold">
          <td colspan="2">TOTAL</td>
          <td>20</td>
          <td>17</td>
          <td>0</td>
          <td>3</td>
          <td>10</td>
          <td colspan="2">—</td>
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
        <tr>
          <td>1</td>
          <td>Yuri Rahmanto, S.Kom., M.Kom.</td>
          <td>Defining the Metaverse: A Complete Overview</td>
          <td><a href="https://youtu.be/josxAy" target="_blank">youtu.be/josxAy</a></td>
          <td>14:54</td>
          <td>30 May 2024</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Yuri Rahmanto, S.Kom., M.Kom.</td>
          <td>MOOC_Evolution of Virtual Worlds</td>
          <td><a href="https://youtu.be/WrnL4f" target="_blank">youtu.be/WrnL4f</a></td>
          <td>10:19</td>
          <td>28 July 2024</td>
        </tr>
        <tr>
          <td>3</td>
          <td>Yuri Rahmanto, S.Kom., M.Kom.</td>
          <td>Key Components of the Metaverse</td>
          <td><a href="https://youtu.be/3sfy_pQ" target="_blank">youtu.be/3sfy_pQ</a></td>
          <td>18:01</td>
          <td>26 April 2024</td>
        </tr>
        <tr>
          <td>4</td>
          <td>Yuri Rahmanto, S.Kom., M.Kom.</td>
          <td>Exploring the Metaverse Across Fields</td>
          <td><a href="https://youtu.be/EXUO4r" target="_blank">youtu.be/EXUO4r</a></td>
          <td>13:47</td>
          <td>27 July 2024</td>
        </tr>
        <tr>
          <td>5</td>
          <td>Yuri Rahmanto, S.Kom., M.Kom.</td>
          <td>Building Identity in the Metaverse</td>
          <td><a href="https://youtu.be/e9K1qG" target="_blank">youtu.be/e9K1qG</a></td>
          <td>16:18</td>
          <td>27 July 2024</td>
        </tr>
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
          <th rowspan="2">Target Tambahan<br>Mei Juni 2025</th>
        </tr>
        <tr>
          <th>Pembelajaran</th>
          <th>MOOC</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>1</td><td>938756657230202</td><td>Ade Dwi Putra, S.Kom., M.Kom.</td><td>2</td><td>37</td><td>0</td><td>37</td><td>4</td></tr>
        <tr><td>2</td><td>5644774765732022</td><td>Dr. Si. Dedi Darwis, S.Kom., M.Kom.</td><td></td><td>27</td><td>5</td><td>32</td><td></td></tr>
        <tr><td>3</td><td>833476869130263</td><td>Yuri Rahmanto, S.Kom., M.Kom.</td><td>3</td><td>38</td><td>5</td><td>43</td><td></td></tr>
        <tr><td>4</td><td>4560777678230062</td><td>Dr. Erliyan Redi, S.Kom., M.Kom.</td><td>4</td><td>29</td><td>4</td><td>33</td><td></td></tr>
        <tr><td>5</td><td>345076865923703</td><td>M. Ghufron Ain Ars, S.Pd., M.T.</td><td>2</td><td>16</td><td>2</td><td>18</td><td>4</td></tr>
        <tr><td>6</td><td>761771672320282</td><td>Selamet Samsugi, S.Kom., M.Eng.</td><td>2</td><td>18</td><td>0</td><td>20</td><td></td></tr>
        <tr><td>7</td><td>856077167232082</td><td>Dr. Damayanti, S.Kom., M.Kom.</td><td>2</td><td>25</td><td>0</td><td>27</td><td>1</td></tr>
        <tr><td>8</td><td>9040774689230143</td><td>Debby Alita, S.Kom., M.T.</td><td>2</td><td>16</td><td>2</td><td>18</td><td></td></tr>
        <tr><td>9</td><td>4344776683170303</td><td>Styawati, S.T., M.Cs.</td><td></td><td>10</td><td>0</td><td>10</td><td></td></tr>
        <tr><td>10</td><td>2035760661311373</td><td>Gadhil Jafar Adrian, Bmm., MIT.</td><td>2</td><td>10</td><td>0</td><td>12</td><td></td></tr>
        <tr><td>11</td><td>556476865720132</td><td>Fajar Dewantoro, S.T., M.T.</td><td>2</td><td>10</td><td>0</td><td>10</td><td></td></tr>
        <tr><td>12</td><td>545676665723012</td><td>Dr. Heni Sulistiani, S.Kom.</td><td>1</td><td>11</td><td>0</td><td>12</td><td></td></tr>
        <tr><td>13</td><td>175275966013202</td><td>Muhammad Anwar Saadat Faidar, ST., MT.</td><td>1</td><td>10</td><td>0</td><td>12</td><td></td></tr>
        <tr><td>14</td><td>783776768130512</td><td>Elka Pranita, S.Pd., M.T.</td><td>2</td><td>9</td><td>5</td><td>14</td><td></td></tr>
        <tr><td>15</td><td>913765565730023</td><td>Nirwana Rediani, S.Kom.M.Cs.</td><td>2</td><td>8</td><td>0</td><td>10</td><td></td></tr>
        <tr><td>16</td><td>434477668130003</td><td>Try Ruliyanti, SH., M.H</td><td>2</td><td>6</td><td>0</td><td>8</td><td>1</td></tr>
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
          <th rowspan="2">No</th>
          <th rowspan="2">Fakultas</th>
          <th rowspan="2">Jumlah Dosen</th>
          <th colspan="2">Video</th>
          <th rowspan="2">Proses Editing</th>
          <th rowspan="2">Jumlah Video</th>
        </tr>
        <tr>
          <th>Pembelajaran</th>
          <th>MOOC</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>1</td><td>FTIK</td><td>41</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>
        <tr><td>2</td><td>FSIP</td><td>20</td><td>3</td><td>1</td><td>0</td><td>4</td></tr>
        <tr><td>3</td><td>FEB</td><td>13</td><td>23</td><td>64</td><td>0</td><td>87</td></tr>
        <tr class="fw-bold"><td colspan="2">Jumlah</td><td>74</td><td>26</td><td>65</td><td>0</td><td>91</td></tr>
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
        <tr><td>1</td><td>FTIK</td><td>22</td><td>71</td><td>0</td><td>71</td></tr>
        <tr><td>2</td><td>FSIP</td><td>9</td><td>78</td><td>5</td><td>78</td></tr>
        <tr><td>3</td><td>FEB</td><td>5</td><td>12</td><td>0</td><td>12</td></tr>
        <tr class="fw-bold"><td colspan="2">Jumlah</td><td>36</td><td>161</td><td>5</td><td>161</td></tr>
      </tbody>
    </table>
  </div>
</div>

</main>



@include('layout.footer')