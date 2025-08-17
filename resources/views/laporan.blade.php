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

@include('laporan.mentah')
</main>

@include('layout.footer')
