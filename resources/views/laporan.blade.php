@extends('layout.header')

@section('title', 'Laporan Booking')

@include('layout.sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Laporan Video</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
        <li class="breadcrumb-item active">Laporan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  @include('laporan.editor')
  @include('laporan.jadwal')
  @include('laporan.mooc')
  @include('laporan.dosen', ['groupedByFakultas' => $groupedByFakultasDosen, 'filterRekap' => $filterRekap, 'uniqueYears' => $uniqueYears, 'uniqueMonths' => $uniqueMonths])
  @include('laporan.terbit')
  @include('laporan.progres', ['groupedByFakultas' => $groupedByFakultasProgres, 'filterFakultas' => $filterFakultas, 'fakultases' => $fakultases, 'uniqueYears' => $uniqueYears, 'uniqueMonths' => $uniqueMonths])
  @include('laporan.fakultas')

</main>

@include('layout.footer')