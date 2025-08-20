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

    @include('laporan.mentah')
</main>

@include('layout.footer')
