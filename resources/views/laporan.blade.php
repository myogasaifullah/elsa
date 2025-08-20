@extends('layout.header')

@section('title', 'Laporan Booking')

@include('layout.sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Laporan Booking</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                <li class="breadcrumb-item active">Laporan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    @include('laporan.done')
    
  
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

    @include('laporan.mentah')
</main>

@include('layout.footer')
