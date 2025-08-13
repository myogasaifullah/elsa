@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Progres</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item ">Persentase</li>
                <li class="breadcrumb-item active">Progres</li>
            </ol>
        </nav>
    </div>
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
                                        <th>Prodi</th>
                                        <th>Mata Kuliah</th>
                                        <th>Kategori MOOC</th>
                                        <th>Judul Course</th>
                                        <th>Studio</th>
                                        <th>Tanggal Shooting</th>
                                        <th>Waktu</th>
                                        <th>Jenis Kategori</th>
                                        <th>Target Upload</th>
                                        <th>Persentase</th>
                                        <th>Progres</th>
                                        <th>Keterangan</th>
                                        <th>Durasi (Menit)</th>
                                        <th>Tautan Video</th>
                                        <th>Tgl Upload YouTube</th>
                                        <th>Editor</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $progress->jadwalBooking->dosen->nama_dosen ?? $progress->jadwalBooking->booking->dosen->nama ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->user->fakultas->nama_fakultas ?? $progress->jadwalBooking->booking->dosen->fakultas->nama ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->user->prodi->nama_prodi ?? $progress->jadwalBooking->booking->dosen->prodi->nama ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->nama_mata_kuliah ?? $progress->jadwalBooking->booking->mataKuliah->nama ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->kategori_mooc ?? $progress->jadwalBooking->booking->kategori_mooc ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->judul_course ?? $progress->jadwalBooking->booking->judul_course ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->studio->nama_studio ?? $progress->jadwalBooking->studio->nama ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->tanggal ?? $progress->jadwalBooking->tanggal_shooting ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->jam ?? $progress->jadwalBooking->waktu ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->jenis_kategori ?? $progress->jadwalBooking->booking->jenis_kategori ?? '-' }}</td>
                                        <td>{{ $progress->target_upload ? \Carbon\Carbon::parse($progress->target_upload)->format('d/m/Y') : '-' }}</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" style="width: {{ $progress->persentase ?? 0 }}%;">{{ $progress->persentase ?? 0 }}%</div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge 
                                                @if($progress->progres == 'belum') bg-secondary
                                                @elseif($progress->progres == 'progres') bg-warning text-dark
                                                @else bg-success
                                                @endif">
                                                {{ ucfirst($progress->progres ?? '-') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge 
                                                @if($progress->keterangan == 'belum terbit') bg-danger
                                                @else bg-success
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $progress->keterangan ?? '-')) }}
                                            </span>
                                        </td>
                                        <td>{{ $progress->durasi ?? '-' }}</td>
                                        <td>
                                            @if($progress->jadwalBooking->booking->link_video ?? $progress->tautan_video ?? '')
                                            <a href="{{ $progress->jadwalBooking->booking->link_video ?? $progress->tautan_video ?? '' }}" target="_blank" class="btn btn-sm btn-primary">Lihat Video</a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>{{ $progress->tanggal_upload_youtube ? \Carbon\Carbon::parse($progress->tanggal_upload_youtube)->format('d/m/Y') : '-' }}</td>
                                        <td class="text-center">
                                            @if(empty($progress->editor->nama))
                                            <button type="button"
                                                class="btn btn-sm btn-primary assign-editor-btn"
                                                data-progress-id="{{ $progress->id }}"
                                                onclick="assignEditor({{ $progress->id }})">
                                                <i class="bi bi-person-plus"></i> Isi Nama
                                            </button>
                                            @else
                                            {{ $progress->editor->nama }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-success text-white">Sudah Shooting</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('progres.edit', $progress->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Card for the Progress bar -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Persentase Progres</h5>
                    <div class="progress">
                        <div id="progressBarPersentase" class="progress-bar progress-bar-striped bg-success" 
                             role="progressbar" 
                             style="width: {{ $existingPersentase->persentase ?? 0 }}%" 
                             aria-valuenow="{{ $existingPersentase->persentase ?? 0 }}" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                            {{ $existingPersentase->persentase ?? 0 }}%
                        </div>
                    </div>
                    <div class="mt-2">
                        <small class="text-muted">Perhitungan otomatis berdasarkan catatan yang terisi</small>
                    </div>
                </div>
            </div>

    <!-- Button to transfer data from persentase to progress -->
    @if($existingPersentase)
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Transfer Data ke Progress</h5>
            <button type="button" class="btn btn-success" id="transferDataButton" data-progress-id="{{ $progress->id }}">
                <i class="bi bi-arrow-down-up"></i> Transfer Data dari Persentase
            </button>
            <p class="text-muted mt-2">
                <small>Menyalin data: persentase, target publish, tanggal publish, durasi, dan link YouTube ke tabel progress</small>
            </p>
        </div>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const transferButton = document.getElementById('transferDataButton');
        
        if (transferButton) {
            transferButton.addEventListener('click', function() {
                const progressId = this.getAttribute('data-progress-id');
                
                if (confirm('Apakah Anda yakin ingin mentransfer data dari persentase ke progress?')) {
                    transferButton.disabled = true;
                    transferButton.innerHTML = '<i class="bi bi-arrow-down-up"></i> Memproses...';
                    
                    fetch(`/progres/transfer-data/${progressId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Data berhasil ditransfer!');
                            location.reload();
                        } else {
                            alert('Gagal mentransfer data: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mentransfer data');
                    })
                    .finally(() => {
                        transferButton.disabled = false;
                        transferButton.innerHTML = '<i class="bi bi-arrow-down-up"></i> Transfer Data dari Persentase';
                    });
                }
            });
        }
    });
    </script>
    @endif

    <!-- Form untuk input/update persentase -->
    @php
    // Gunakan variabel existingPersentase yang dikirim dari controller
    // $existingPersentase sudah tersedia dari controller
    @endphp

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ $existingPersentase ? route('persentase.update', $existingPersentase->id) : route('persentase.store') }}" method="POST">
        @csrf
        @if($existingPersentase)
        @method('PUT')
        @endif

        <input type="hidden" name="id_progres" value="{{ $progress->id }}">
        <input type="hidden" name="persentase" id="persentase" value="{{ $existingPersentase->persentase ?? 0 }}">

        <div class="accordion" id="accordionProgres">

            {{-- Bagian Target & Tanggal Publish --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingPublish">
                    <button class="accordion-button" type="button" data-toggle="collapse" data-target="#collapsePublish" aria-expanded="true" aria-controls="collapsePublish">
                        Target & Tanggal Publish
                    </button>
                </h2>
                <div id="collapsePublish" class="accordion-collapse collapse show" aria-labelledby="headingPublish" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPublish">Isi Data</button>
                    </div>
                </div>
            </div>

            {{-- Modal Publish --}}
            <div class="modal fade" id="modalPublish" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Target & Tanggal Publish</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="target_publish" class="form-label">Target Publish</label>
                                    <input type="date" class="form-control @error('target_publish') is-invalid @enderror" id="target_publish" name="target_publish"
                                        value="{{ old('target_publish', isset($existingPersentase->target_publish) ? $existingPersentase->target_publish->format('Y-m-d') : '') }}" required>
                                    @error('target_publish')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_publish" class="form-label">Tanggal Publish</label>
                                    <input type="date" class="form-control @error('tanggal_publish') is-invalid @enderror" id="tanggal_publish" name="tanggal_publish"
                                        value="{{ old('tanggal_publish', isset($existingPersentase->tanggal_publish) ? $existingPersentase->tanggal_publish->format('Y-m-d') : '') }}">
                                    @error('tanggal_publish')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">{{ $existingPersentase ? 'Update' : 'Simpan' }}</button>
            </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Link & Durasi --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingVideo">
                    <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseVideo" aria-expanded="false" aria-controls="collapseVideo">
                        Link YouTube & Durasi Video
                    </button>
                </h2>
                <div id="collapseVideo" class="accordion-collapse collapse" aria-labelledby="headingVideo" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalVideo">Isi Data</button>
                    </div>
                </div>
            </div>

            {{-- Modal Video --}}
            <div class="modal fade" id="modalVideo" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Link & Durasi Video</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="publish_link_youtube" class="form-label">Link YouTube</label>
                                    <input type="url" class="form-control @error('publish_link_youtube') is-invalid @enderror" id="publish_link_youtube" name="publish_link_youtube"
                                        value="{{ old('publish_link_youtube', $existingPersentase->publish_link_youtube ?? '') }}" placeholder="https://youtube.com/...">
                                    @error('publish_link_youtube')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="durasi_video_menit" class="form-label">Durasi Video (Menit)</label>
                                    <input type="number" class="form-control @error('durasi_video_menit') is-invalid @enderror" id="durasi_video_menit" name="durasi_video_menit"
                                        value="{{ old('durasi_video_menit', $existingPersentase->durasi_video_menit ?? '') }}" step="0.01" min="0">
                                    @error('durasi_video_menit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">{{ $existingPersentase ? 'Update' : 'Simpan' }}</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Catatan 1 --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingCatatan1">
                    <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseCatatan1" aria-expanded="false" aria-controls="collapseCatatan1">
                        Pra-produksi
                    </button>
                </h2>
                <div id="collapseCatatan1" class="accordion-collapse collapse" aria-labelledby="headingCatatan1" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan1">Isi Catatan Pra-produksi</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 1 --}}
            <div class="modal fade" id="modalCatatan1" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pra-produksi</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan1" class="form-label">Menerima brief dari dosen/pengampu;
                                    Menyusun rencana editing;
                                    Memastikan ketersediaan materi (video, audio, slide, dll)</label>
                                <input type="text" class="form-control @error('catatan1') is-invalid @enderror" id="catatan1" name="catatan1"
                                    value="{{ old('catatan1', $existingPersentase->catatan1 ?? '') }}" placeholder="Masukkan catatan Pra-produksi">
                                @error('catatan1')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">{{ $existingPersentase ? 'Update' : 'Simpan' }}</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Catatan 2 --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingCatatan2">
                    <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseCatatan2" aria-expanded="false" aria-controls="collapseCatatan2">
                        Import dan Organisasi Materi
                    </button>
                </h2>
                <div id="collapseCatatan2" class="accordion-collapse collapse" aria-labelledby="headingCatatan2" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan2">Isi Catatan Import dan Organisasi Materi</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 2 --}}
            <div class="modal fade" id="modalCatatan2" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Catatan Import dan Organisasi Materi</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan2" class="form-label">Mengimpor footage, audio, dan bahan pendukung ke software;
                                    Membuat folder kerja terstruktur (bining)</label>
                                <input type="text" class="form-control @error('catatan2') is-invalid @enderror" id="catatan2" name="catatan2"
                                    value="{{ old('catatan2', $existingPersentase->catatan2 ?? '') }}" placeholder="Masukkan catatan Import dan Organisasi Materi">
                                @error('catatan2')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">{{ $existingPersentase ? 'Update' : 'Simpan' }}</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Catatan 3 --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingCatatan3">
                    <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseCatatan3" aria-expanded="false" aria-controls="collapseCatatan3">
                        Rough Cut
                    </button>
                </h2>
                <div id="collapseCatatan3" class="accordion-collapse collapse" aria-labelledby="headingCatatan3" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan3">Isi Catatan Rough Cut</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 3 --}}
            <div class="modal fade" id="modalCatatan3" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Rough Cut</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan3" class="form-label">Memilih bagian-bagian penting video;
                                    Menyusun urutan sesuai alur pembelajaran;
                                    Menghapus bagian yang tidak diperlukan</label>
                                <input type="text" class="form-control @error('catatan3') is-invalid @enderror" id="catatan3" name="catatan3"
                                    value="{{ old('catatan3', $existingPersentase->catatan3 ?? '') }}" placeholder="Masukkan catatan Rough Cut">
                                @error('catatan3')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">{{ $existingPersentase ? 'Update' : 'Simpan' }}</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Catatan 4 --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingCatatan4">
                    <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseCatatan4" aria-expanded="false" aria-controls="collapseCatatan4">
                        Fine Cut (Cutting Halus)
                    </button>
                </h2>
                <div id="collapseCatatan4" class="accordion-collapse collapse" aria-labelledby="headingCatatan4" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan4">Isi Catatan Fine Cut (Cutting Halus)</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 4 --}}
            <div class="modal fade" id="modalCatatan4" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Fine Cut (Cutting Halus)</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan4" class="form-label">Memperhalus transisi antar bagian;
                                    Sinkronisasi audio dan video;
                                    Koreksi durasi agar efisien</label>
                                <input type="text" class="form-control @error('catatan4') is-invalid @enderror" id="catatan4" name="catatan4"
                                    value="{{ old('catatan4', $existingPersentase->catatan4 ?? '') }}" placeholder="Masukkan catatan Fine Cut (Cutting Halus)">
                                @error('catatan4')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">{{ $existingPersentase ? 'Update' : 'Simpan' }}</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Catatan 5 --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingCatatan5">
                    <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseCatatan5" aria-expanded="false" aria-controls="collapseCatatan5">
                        Penambahan Elemen Grafis & Visual
                    </button>
                </h2>
                <div id="collapseCatatan5" class="accordion-collapse collapse" aria-labelledby="headingCatatan5" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan5">Isi Catatan Penambahan Elemen Grafis & Visual</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 5 --}}
            <div class="modal fade" id="modalCatatan5" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Penambahan Elemen Grafis & Visual</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan5" class="form-label">Menambahkan judul, nama narasumber, transisi visual;
                                    Menyisipkan gambar, ilustrasi, atau animasi penunjang materi
                                    Menyisipkan bumper opening video</label>
                                <input type="text" class="form-control @error('catatan5') is-invalid @enderror" id="catatan5" name="catatan5"
                                    value="{{ old('catatan5', $existingPersentase->catatan5 ?? '') }}" placeholder="Masukkan catatan Penambahan Elemen Grafis & Visual">
                                @error('catatan5')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">{{ $existingPersentase ? 'Update' : 'Simpan' }}</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Catatan 6 --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingCatatan6">
                    <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseCatatan6" aria-expanded="false" aria-controls="collapseCatatan6">
                        Penyuntingan Audio
                    </button>
                </h2>
                <div id="collapseCatatan6" class="accordion-collapse collapse" aria-labelledby="headingCatatan6" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan6">Isi Catatan Penyuntingan Audio</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 6 --}}
            <div class="modal fade" id="modalCatatan6" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Penyuntingan Audio</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan6" class="form-label">Membersihkan noise;
                                    Menyesuaikan level suara (voice over, musik latar);
                                    Menambahkan sound effect jika dibutuhkan</label>
                                <input type="text" class="form-control @error('catatan6') is-invalid @enderror" id="catatan6" name="catatan6"
                                    value="{{ old('catatan6', $existingPersentase->catatan6 ?? '') }}" placeholder="Masukkan catatan Penyuntingan Audio">
                                @error('catatan6')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">{{ $existingPersentase ? 'Update' : 'Simpan' }}</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Catatan 7 --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingCatatan7">
                    <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseCatatan7" aria-expanded="false" aria-controls="collapseCatatan7">
                        Penyisipan Subtitle atau Teks Narasi
                    </button>
                </h2>
                <div id="collapseCatatan7" class="accordion-collapse collapse" aria-labelledby="headingCatatan7" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan7">Isi Catatan Penyisipan Subtitle atau Teks Narasi</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 7 --}}
            <div class="modal fade" id="modalCatatan7" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Penyisipan Subtitle atau Teks Narasi</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan7" class="form-label">Menambahkan subtitle (bila diperlukan); Menyisipkan poin penting materi dalam bentuk teks visual</label>
                                <input type="text" class="form-control @error('catatan7') is-invalid @enderror" id="catatan7" name="catatan7"
                                    value="{{ old('catatan7', $existingPersentase->catatan7 ?? '') }}" placeholder="Masukkan catatan Penyisipan Subtitle atau Teks Narasi">
                                @error('catatan7')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">{{ $existingPersentase ? 'Update' : 'Simpan' }}</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Catatan 8 --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingCatatan8">
                    <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseCatatan8" aria-expanded="false" aria-controls="collapseCatatan8">
                        Quality Control (QC) dan Revisi
                    </button>
                </h2>
                <div id="collapseCatatan8" class="accordion-collapse collapse" aria-labelledby="headingCatatan8" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan8">Isi Catatan Quality Control (QC) dan Revisi</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 8 --}}
            <div class="modal fade" id="modalCatatan8" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Quality Control (QC) dan Revisi</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan8" class="form-label">Menonton ulang hasil edit untuk deteksi kesalahan; Menyesuaikan revisi dari dosen</label>
                                <input type="text" class="form-control @error('catatan8') is-invalid @enderror" id="catatan8" name="catatan8"
                                    value="{{ old('catatan8', $existingPersentase->catatan8 ?? '') }}" placeholder="Masukkan catatan Quality Control (QC) dan Revisi">
                                @error('catatan8')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">{{ $existingPersentase ? 'Update' : 'Simpan' }}</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Catatan 9 --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingCatatan9">
                    <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseCatatan9" aria-expanded="false" aria-controls="collapseCatatan9">
                        Export dan Finalisasi
                    </button>
                </h2>
                <div id="collapseCatatan9" class="accordion-collapse collapse" aria-labelledby="headingCatatan9" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan9">Isi Catatan Export dan Finalisasi</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 9 --}}
            <div class="modal fade" id="modalCatatan9" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Export dan Finalisasi</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan9" class="form-label">Mengekspor video dalam format dan resolusi sesuai kebutuhan;
                                    Menyimpan arsip kerja</label>
                                <input type="text" class="form-control @error('catatan9') is-invalid @enderror" id="catatan9" name="catatan9"
                                    value="{{ old('catatan9', $existingPersentase->catatan9 ?? '') }}" placeholder="Masukkan catatan Export dan Finalisasi">
                                @error('catatan9')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">{{ $existingPersentase ? 'Update' : 'Simpan' }}</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Catatan 10 --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingCatatan10">
                    <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapseCatatan10" aria-expanded="false" aria-controls="collapseCatatan10">
                        Pasca Produksi
                    </button>
                </h2>
                <div id="collapseCatatan10" class="accordion-collapse collapse" aria-labelledby="headingCatatan10" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan10">Isi Catatan Pasca Produksi</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 10 --}}
            <div class="modal fade" id="modalCatatan10" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pasca Produksi</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan10" class="form-label">Editor mengupload video dengan dilengkapi judul, caption, thumbnail, dan elemen lain yang sesuai dengan video</label>
                                <input type="text" class="form-control @error('catatan10') is-invalid @enderror" id="catatan10" name="catatan10"
                                    value="{{ old('catatan10', $existingPersentase->catatan10 ?? '') }}" placeholder="Masukkan catatan Pasca Produksi">
                                @error('catatan10')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">{{ $existingPersentase ? 'Update' : 'Simpan' }}</button>
                        </div>
                    </div>
                </div>
            </div>

        </div> {{-- end accordion --}}
    </form>


</main>

@include('layout.footer')

<script>
// Fungsi untuk mendapatkan persentase berdasarkan nomor catatan
function getPersentaseCatatan(catatanNumber) {
    const persentaseMap = {
        1: 10, 6: 10, 7: 10,
        2: 5, 8: 5, 9: 5, 10: 5,
        3: 15, 4: 15,
        5: 20
    };
    return persentaseMap[catatanNumber] || 0;
}

// Fungsi untuk menghitung persentase otomatis
function calculatePercentage() {
    let totalPercentage = 0;
    
    for (let i = 1; i <= 10; i++) {
        const catatanField = document.getElementById(`catatan${i}`);
        if (catatanField && catatanField.value && catatanField.value.trim() !== '') {
            totalPercentage += getPersentaseCatatan(i);
        }
    }
    
    // Pastikan tidak melebihi 100%
    totalPercentage = Math.min(totalPercentage, 100);
    
    // Update hidden input
    document.getElementById('persentase').value = totalPercentage;
    
    // Update progress bar
    const progressBar = document.getElementById('progressBarPersentase');
    if (progressBar) {
        progressBar.style.width = totalPercentage + '%';
        progressBar.setAttribute('aria-valuenow', totalPercentage);
        progressBar.textContent = totalPercentage + '%';
    }
}

// Hitung persentase saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    calculatePercentage();
});
</script>
