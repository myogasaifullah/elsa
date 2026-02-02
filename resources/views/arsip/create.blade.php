@extends('layout.header')

@section('title', 'Tambah Arsip')

@include('layout.sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tambah Arsip</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('arsip.index') }}">Arsip</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Tambah Data Arsip</h5>

                        <form action="{{ route('arsip.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jadwal_booking_id" class="form-label">Jadwal Booking</label>
                                        <select class="form-select" id="jadwal_booking_id" name="jadwal_booking_id" required>
                                            <option value="">Pilih Jadwal Booking</option>
                                            @foreach($jadwalBookings as $jadwal)
                                            <option value="{{ $jadwal->id }}">{{ $jadwal->judul_course }} - {{ $jadwal->dosen->nama_dosen ?? 'N/A' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="target_upload" class="form-label">Target Upload</label>
                                        <input type="date" class="form-control" id="target_upload" name="target_upload">
                                    </div>
                                    <div class="mb-3">
                                        <label for="persentase" class="form-label">Persentase</label>
                                        <input type="number" class="form-control" id="persentase" name="persentase" min="0" max="100" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="progres" class="form-label">Progres</label>
                                        <select class="form-select" id="progres" name="progres" required>
                                            <option value="">Pilih Progres</option>
                                            <option value="belum">Belum</option>
                                            <option value="progres">Sedang Progres</option>
                                            <option value="selesai">Selesai</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <select class="form-select" id="keterangan" name="keterangan" required>
                                            <option value="">Pilih Keterangan</option>
                                            <option value="belum terbit">Belum Terbit</option>
                                            <option value="sudah terbit">Sudah Terbit</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="durasi" class="form-label">Durasi (Menit)</label>
                                        <input type="number" class="form-control" id="durasi" name="durasi" min="0">
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_upload_youtube" class="form-label">Tanggal Upload YouTube</label>
                                        <input type="date" class="form-control" id="tanggal_upload_youtube" name="tanggal_upload_youtube">
                                    </div>
                                    <div class="mb-3">
                                        <label for="publish_link_youtube" class="form-label">Tautan Video YouTube</label>
                                        <input type="url" class="form-control" id="publish_link_youtube" name="publish_link_youtube">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editor_id" class="form-label">Editor</label>
                                        <select class="form-select" id="editor_id" name="editor_id">
                                            <option value="">Pilih Editor</option>
                                            @foreach($editors as $editor)
                                            <option value="{{ $editor->id }}">{{ $editor->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('arsip.index') }}" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

@include('layout.footer')