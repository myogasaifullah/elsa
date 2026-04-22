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
                                        <!-- <th>No</th>
                                        <th>Dosen</th>
                                        <th>Fakultas</th>
                                        <th>Prodi</th>
                                        <th>Mata Kuliah</th>
                                        <th>Kategori MOOC</th> -->
                                        <th>Judul Course</th>
                                        <!-- <th>Studio</th> -->
                                        <th>Tanggal Shooting</th>
                                        <!-- <th>Waktu</th> -->
                                        <!-- <th>Jenis Kategori</th> -->
                                        <th>Target Upload</th>
                                        <th>Persentase</th>
                                        <th>Progres</th>
                                        <th>Keterangan</th>
                                        <th>Durasi (Menit)</th>
                                        <th>Tautan Video</th>
                                        <th>Tgl Upload YouTube</th>
                                        <th>Editor</th>
                                        <!-- <th>Status</th> -->
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- <td>1</td>
                                        <td>{{ $progress->jadwalBooking->dosen->nama_dosen ?? $progress->jadwalBooking->booking->dosen->nama ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->user->fakultas->nama_fakultas ?? $progress->jadwalBooking->booking->dosen->fakultas->nama ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->user->prodi->nama_prodi ?? $progress->jadwalBooking->booking->dosen->prodi->nama ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->nama_mata_kuliah ?? $progress->jadwalBooking->booking->mataKuliah->nama ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->kategori_mooc ?? $progress->jadwalBooking->booking->kategori_mooc ?? '-' }}</td> -->
                                        <td>{{ $progress->jadwalBooking->judul_course ?? $progress->jadwalBooking->booking->judul_course ?? '-' }}</td>
                                        <!-- <td>{{ $progress->jadwalBooking->studio->nama_studio ?? $progress->jadwalBooking->studio->nama ?? '-' }}</td> -->
                                        <td>{{ $progress->jadwalBooking->tanggal ?? $progress->jadwalBooking->tanggal_shooting ?? '-' }}</td>
                                        <!-- <td>{{ $progress->jadwalBooking->jam ?? $progress->jadwalBooking->waktu ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->jenis_kategori ?? $progress->jadwalBooking->booking->jenis_kategori ?? '-' }}</td> -->
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
                                            @if($progress->publish_link_youtube ?? '')
                                            <a href="{{ $progress->publish_link_youtube ?? '' }}" target="_blank" class="btn btn-sm btn-primary">Lihat Video</a>
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
                                        <!-- <td class="text-center">
                                            <span class="badge bg-success text-white">Sudah Shooting</span>
                                        </td> -->
                                        <!-- <td class="text-center">
                                            <a href="{{ route('progres.edit', $progress->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        </td> -->
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
                    const form = document.querySelector('form');

                    if (confirm('Simpan persentase dulu lalu transfer?')) {
                        transferButton.disabled = true;
                        transferButton.innerHTML = '<i class="bi bi-arrow-down-up"></i> Saving...';

                        // First save persentase form via AJAX
                        const formData = new FormData(form);
                        fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.text())
                        .then(() => {
                            transferButton.innerHTML = '<i class="bi bi-arrow-down-up"></i> Transferring...';
                            // Then transfer
                            return fetch(`/progres/transfer-data/${progressId}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            });
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Persentase disimpan dan data berhasil ditransfer!');
                                location.reload();
                            } else {
                                alert('Transfer gagal: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error saving or transferring');
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
                        Target & Tanggal Publish (Wajib isi target terlebih dahulu)
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
                            <h5 class="modal-title">Target & Tanggal Publish (Wajib isi target terlebih dahulu)</h5>
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
                        1. Pra-produksi (10%) <span id="status1" class="badge bg-secondary ms-2">Pending</span>
                    </button>
                </h2>
                <div id="collapseCatatan1" class="accordion-collapse collapse" aria-labelledby="headingCatatan1" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="checkbox1" name="checkbox1">
                            <label class="form-check-label" for="checkbox1">
                                Quick Complete (Auto-fill "(sudah)")
                            </label>
                            <input type="hidden" id="catatan1" name="catatan1" value="{{ old('catatan1', $existingPersentase->catatan1 ?? '') }}">
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan1">Edit Detail</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 1 --}}
            <div class="modal fade" id="modalCatatan1" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">1. Pra-produksi (10%)</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan1_detail" class="form-label">Detail Catatan (Override checkbox)</label>
                                <input type="text" class="form-control @error('catatan1') is-invalid @enderror" id="catatan1_detail" placeholder="Edit detail (opsional)" value="{{ old('catatan1', $existingPersentase->catatan1 ?? '') }}">
                                <div class="form-text">Checkbox quick-fill used default text; edit here to override.</div>
                                @error('catatan1')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <script>
                                // Sync modal input to hidden
                                document.getElementById('catatan1_detail').addEventListener('input', function() {
                                    document.getElementById('catatan1').value = this.value;
                                    calculatePercentage();
                                });
                            </script>
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
                        2. Import dan Organisasi Materi (5%) <span id="status2" class="badge bg-secondary ms-2">Pending</span>
                    </button>
                </h2>
                <div id="collapseCatatan2" class="accordion-collapse collapse" aria-labelledby="headingCatatan2" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="checkbox2" name="checkbox2">
                            <label class="form-check-label" for="checkbox2">
                                Quick Complete (Auto-fill "(sudah)")
                            </label>
                            <input type="hidden" id="catatan2" name="catatan2" value="{{ old('catatan2', $existingPersentase->catatan2 ?? '') }}">
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan2">Edit Detail</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 2 --}}
            <div class="modal fade" id="modalCatatan2" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">2. Import dan Organisasi Materi (5%)</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan2_detail" class="form-label">Detail Catatan (Override checkbox)</label>
                                <input type="text" class="form-control @error('catatan2') is-invalid @enderror" id="catatan2_detail" placeholder="Edit detail (opsional)" value="{{ old('catatan2', $existingPersentase->catatan2 ?? '') }}">
                                <div class="form-text">Checkbox quick-fill used default text; edit here to override.</div>
                                @error('catatan2')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <script>
                                document.getElementById('catatan2_detail').addEventListener('input', function() {
                                    document.getElementById('catatan2').value = this.value;
                                    calculatePercentage();
                                });
                            </script>
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
                        3. Rough Cut (15%) <span id="status3" class="badge bg-secondary ms-2">Pending</span>
                    </button>
                </h2>
                <div id="collapseCatatan3" class="accordion-collapse collapse" aria-labelledby="headingCatatan3" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="checkbox3" name="checkbox3">
                            <label class="form-check-label" for="checkbox3">
                                Quick Complete (Auto-fill "(sudah)")
                            </label>
                            <input type="hidden" id="catatan3" name="catatan3" value="{{ old('catatan3', $existingPersentase->catatan3 ?? '') }}">
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan3">Edit Detail</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 3 --}}
            <div class="modal fade" id="modalCatatan3" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">3. Rough Cut (15%)</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan3_detail" class="form-label">Detail Catatan (Override checkbox)</label>
                                <input type="text" class="form-control @error('catatan3') is-invalid @enderror" id="catatan3_detail" placeholder="Edit detail (opsional)" value="{{ old('catatan3', $existingPersentase->catatan3 ?? '') }}">
                                <div class="form-text">Checkbox quick-fill used default text; edit here to override.</div>
                                @error('catatan3')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <script>
                                document.getElementById('catatan3_detail').addEventListener('input', function() {
                                    document.getElementById('catatan3').value = this.value;
                                    calculatePercentage();
                                });
                            </script>
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
                        4. Fine Cut (Cutting Halus) (15%) <span id="status4" class="badge bg-secondary ms-2">Pending</span>
                    </button>
                </h2>
                <div id="collapseCatatan4" class="accordion-collapse collapse" aria-labelledby="headingCatatan4" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="checkbox4" name="checkbox4">
                            <label class="form-check-label" for="checkbox4">
                                Quick Complete (Auto-fill "(sudah)")
                            </label>
                            <input type="hidden" id="catatan4" name="catatan4" value="{{ old('catatan4', $existingPersentase->catatan4 ?? '') }}">
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan4">Edit Detail</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 4 --}}
            <div class="modal fade" id="modalCatatan4" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">4. Fine Cut (Cutting Halus) (15%)</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan4_detail" class="form-label">Detail Catatan (Override checkbox)</label>
                                <input type="text" class="form-control @error('catatan4') is-invalid @enderror" id="catatan4_detail" placeholder="Edit detail (opsional)" value="{{ old('catatan4', $existingPersentase->catatan4 ?? '') }}">
                                <div class="form-text">Checkbox quick-fill used default text; edit here to override.</div>
                                @error('catatan4')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <script>
                                document.getElementById('catatan4_detail').addEventListener('input', function() {
                                    document.getElementById('catatan4').value = this.value;
                                    calculatePercentage();
                                });
                            </script>
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
                        5. Penambahan Elemen Grafis & Visual (20%) <span id="status5" class="badge bg-secondary ms-2">Pending</span>
                    </button>
                </h2>
                <div id="collapseCatatan5" class="accordion-collapse collapse" aria-labelledby="headingCatatan5" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="checkbox5" name="checkbox5">
                            <label class="form-check-label" for="checkbox5">
                                Quick Complete (Auto-fill "(sudah)")
                            </label>
                            <input type="hidden" id="catatan5" name="catatan5" value="{{ old('catatan5', $existingPersentase->catatan5 ?? '') }}">
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan5">Edit Detail</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 5 --}}
            <div class="modal fade" id="modalCatatan5" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">5. Penambahan Elemen Grafis & Visual (20%)</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan5_detail" class="form-label">Detail Catatan (Override checkbox)</label>
                                <input type="text" class="form-control @error('catatan5') is-invalid @enderror" id="catatan5_detail" placeholder="Edit detail (opsional)" value="{{ old('catatan5', $existingPersentase->catatan5 ?? '') }}">
                                <div class="form-text">Checkbox quick-fill used default text; edit here to override.</div>
                                @error('catatan5')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <script>
                                document.getElementById('catatan5_detail').addEventListener('input', function() {
                                    document.getElementById('catatan5').value = this.value;
                                    calculatePercentage();
                                });
                            </script>
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
                        6. Penyuntingan Audio (10%) <span id="status6" class="badge bg-secondary ms-2">Pending</span>
                    </button>
                </h2>
                <div id="collapseCatatan6" class="accordion-collapse collapse" aria-labelledby="headingCatatan6" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="checkbox6" name="checkbox6">
                            <label class="form-check-label" for="checkbox6">
                                Quick Complete (Auto-fill "(sudah)")
                            </label>
                            <input type="hidden" id="catatan6" name="catatan6" value="{{ old('catatan6', $existingPersentase->catatan6 ?? '') }}">
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan6">Edit Detail</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 6 --}}
            <div class="modal fade" id="modalCatatan6" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">6. Penyuntingan Audio (10%)</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan6_detail" class="form-label">Detail Catatan (Override checkbox)</label>
                                <input type="text" class="form-control @error('catatan6') is-invalid @enderror" id="catatan6_detail" placeholder="Edit detail (opsional)" value="{{ old('catatan6', $existingPersentase->catatan6 ?? '') }}">
                                <div class="form-text">Checkbox quick-fill used default text; edit here to override.</div>
                                @error('catatan6')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <script>
                                document.getElementById('catatan6_detail').addEventListener('input', function() {
                                    document.getElementById('catatan6').value = this.value;
                                    calculatePercentage();
                                });
                            </script>
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
                        7. Penyisipan Subtitle atau Teks Narasi (10%) <span id="status7" class="badge bg-secondary ms-2">Pending</span>
                    </button>
                </h2>
                <div id="collapseCatatan7" class="accordion-collapse collapse" aria-labelledby="headingCatatan7" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="checkbox7" name="checkbox7">
                            <label class="form-check-label" for="checkbox7">
                                Quick Complete (Auto-fill "(sudah)")
                            </label>
                            <input type="hidden" id="catatan7" name="catatan7" value="{{ old('catatan7', $existingPersentase->catatan7 ?? '') }}">
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan7">Edit Detail</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 7 --}}
            <div class="modal fade" id="modalCatatan7" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">7. Penyisipan Subtitle atau Teks Narasi (10%)</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan7_detail" class="form-label">Detail Catatan (Override checkbox)</label>
                                <input type="text" class="form-control @error('catatan7') is-invalid @enderror" id="catatan7_detail" placeholder="Edit detail (opsional)" value="{{ old('catatan7', $existingPersentase->catatan7 ?? '') }}">
                                <div class="form-text">Checkbox quick-fill used default text; edit here to override.</div>
                                @error('catatan7')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <script>
                                document.getElementById('catatan7_detail').addEventListener('input', function() {
                                    document.getElementById('catatan7').value = this.value;
                                    calculatePercentage();
                                });
                            </script>
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
                        8. Quality Control (QC) dan Revisi (5%) <span id="status8" class="badge bg-secondary ms-2">Pending</span>
                    </button>
                </h2>
                <div id="collapseCatatan8" class="accordion-collapse collapse" aria-labelledby="headingCatatan8" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="checkbox8" name="checkbox8">
                            <label class="form-check-label" for="checkbox8">
                                Quick Complete (Auto-fill "(sudah)")
                            </label>
                            <input type="hidden" id="catatan8" name="catatan8" value="{{ old('catatan8', $existingPersentase->catatan8 ?? '') }}">
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan8">Edit Detail</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 8 --}}
            <div class="modal fade" id="modalCatatan8" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">8. Quality Control (QC) dan Revisi (5%)</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan8_detail" class="form-label">Detail Catatan (Override checkbox)</label>
                                <input type="text" class="form-control @error('catatan8') is-invalid @enderror" id="catatan8_detail" placeholder="Edit detail (opsional)" value="{{ old('catatan8', $existingPersentase->catatan8 ?? '') }}">
                                <div class="form-text">Checkbox quick-fill used default text; edit here to override.</div>
                                @error('catatan8')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <script>
                                document.getElementById('catatan8_detail').addEventListener('input', function() {
                                    document.getElementById('catatan8').value = this.value;
                                    calculatePercentage();
                                });
                            </script>
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
                        9. Export dan Finalisasi (5%) <span id="status9" class="badge bg-secondary ms-2">Pending</span>
                    </button>
                </h2>
                <div id="collapseCatatan9" class="accordion-collapse collapse" aria-labelledby="headingCatatan9" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="checkbox9" name="checkbox9">
                            <label class="form-check-label" for="checkbox9">
                                Quick Complete (Auto-fill "(sudah)")
                            </label>
                            <input type="hidden" id="catatan9" name="catatan9" value="{{ old('catatan9', $existingPersentase->catatan9 ?? '') }}">
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan9">Edit Detail</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 9 --}}
            <div class="modal fade" id="modalCatatan9" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">9. Export dan Finalisasi (5%)</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan9_detail" class="form-label">Detail Catatan (Override checkbox)</label>
                                <input type="text" class="form-control @error('catatan9') is-invalid @enderror" id="catatan9_detail" placeholder="Edit detail (opsional)" value="{{ old('catatan9', $existingPersentase->catatan9 ?? '') }}">
                                <div class="form-text">Checkbox quick-fill used default text; edit here to override.</div>
                                @error('catatan9')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <script>
                                document.getElementById('catatan9_detail').addEventListener('input', function() {
                                    document.getElementById('catatan9').value = this.value;
                                    calculatePercentage();
                                });
                            </script>
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
                        10. Pasca Produksi (5%) <span id="status10" class="badge bg-secondary ms-2">Pending</span>
                    </button>
                </h2>
                <div id="collapseCatatan10" class="accordion-collapse collapse" aria-labelledby="headingCatatan10" data-parent="#accordionProgres">
                    <div class="accordion-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="checkbox10" name="checkbox10">
                            <label class="form-check-label" for="checkbox10">
                                Quick Complete (Auto-fill "(sudah)")
                            </label>
                            <input type="hidden" id="catatan10" name="catatan10" value="{{ old('catatan10', $existingPersentase->catatan10 ?? '') }}">
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCatatan10">Edit Detail</button>
                    </div>
                </div>
            </div>

            {{-- Modal Catatan 10 --}}
            <div class="modal fade" id="modalCatatan10" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">10. Pasca Produksi (5%)</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan10_detail" class="form-label">Detail Catatan (Override checkbox)</label>
                                <input type="text" class="form-control @error('catatan10') is-invalid @enderror" id="catatan10_detail" placeholder="Edit detail (opsional)" value="{{ old('catatan10', $existingPersentase->catatan10 ?? '') }}">
                                <div class="form-text">Checkbox quick-fill used default text; edit here to override.</div>
                                @error('catatan10')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <script>
                                document.getElementById('catatan10_detail').addEventListener('input', function() {
                                    document.getElementById('catatan10').value = this.value;
                                    calculatePercentage();
                                });
                            </script>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">{{ $existingPersentase ? 'Update' : 'Simpan' }}</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body text-center">
                    <button type="submit" id="globalSaveBtn" class="btn btn-success btn-lg">
                        <i class="bi bi-save"></i> Simpan Semua Perubahan (<span id="currentPct">{{ $existingPersentase->persentase ?? 0 }}%</span>)
                    </button>
                    <p class="mt-2 text-muted">
                        <small>Gunakan checkbox di bawah untuk quick fill otomatis, atau edit detail di modal</small>
                    </p>
                </div>
            </div>
        </div> {{-- end accordion --}}
    </form>


</main>

@include('layout.footer')

<script>
    // Data for each stage: % and default text
    const stageData = {
        1: {pct: 10, text: 'Menerima brief dari dosen/pengampu; Menyusun rencana editing; Memastikan ketersediaan materi (video, audio, slide, dll)'},
        2: {pct: 5, text: 'Mengimpor footage, audio, dan bahan pendukung ke software; Membuat folder kerja terstruktur (bining)'},
        3: {pct: 15, text: 'Memilih bagian-bagian penting video; Menyusun urutan sesuai alur pembelajaran; Menghapus bagian yang tidak diperlukan'},
        4: {pct: 15, text: 'Memperhalus transisi antar bagian; Sinkronisasi audio dan video; Koreksi durasi agar efisien'},
        5: {pct: 20, text: 'Menambahkan judul, nama narasumber, transisi visual; Menyisipkan gambar, ilustrasi, atau animasi penunjang materi; Menyisipkan bumper opening video'},
        6: {pct: 10, text: 'Membersihkan noise; Menyesuaikan level suara (voice over, musik latar); Menambahkan sound effect jika dibutuhkan'},
        7: {pct: 10, text: 'Menambahkan subtitle (bila diperlukan); Menyisipkan poin penting materi dalam bentuk teks visual'},
        8: {pct: 5, text: 'Menonton ulang hasil edit untuk deteksi kesalahan; Menyesuaikan revisi dari dosen'},
        9: {pct: 5, text: 'Mengekspor video dalam format dan resolusi sesuai kebutuhan; Menyimpan arsip kerja'},
        10: {pct: 5, text: 'Editor mengupload video dengan dilengkapi judul, caption, thumbnail, dan elemen lain yang sesuai dengan video'}
    };

    // Fungsi untuk mendapatkan persentase berdasarkan nomor catatan
    function getPersentaseCatatan(catatanNumber) {
        const persentaseMap = {
            1: 10,
            6: 10,
            7: 10,
            2: 5,
            8: 5,
            9: 5,
            10: 5,
            3: 15,
            4: 15,
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

    // Checkbox event listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Existing calculate
        calculatePercentage();

        // Checkbox handlers
        document.querySelectorAll('input[name^=\"checkbox\"]').forEach(function(cb) {
            cb.addEventListener('change', function(e) {
                const num = this.name.match(/checkbox(\d+)/)[1];
                const catInput = document.getElementById('catatan' + num);
                const statusSpan = document.getElementById('status' + num);
                
                if (this.checked) {
                    catInput.value = '(sudah)';
                    if (statusSpan) statusSpan.textContent = 'Done';
                    statusSpan.className = 'badge bg-success ms-2';
                } else {
                    catInput.value = '';
                    if (statusSpan) statusSpan.textContent = 'Pending';
                    statusSpan.className = 'badge bg-secondary ms-2';
                }
                calculatePercentage();
            });
        });

        // Init checkboxes from existing data
        for (let i = 1; i <= 10; i++) {
            const catInput = document.getElementById('catatan' + i);
            const cb = document.getElementById('checkbox' + i);
            const statusSpan = document.getElementById('status' + i);
            if (catInput && catInput.value.trim() !== '') {
                if (cb) cb.checked = true;
                if (statusSpan) statusSpan.className = 'badge bg-success ms-2';
            } else {
                if (cb) cb.checked = false;
                if (statusSpan) statusSpan.className = 'badge bg-secondary ms-2';
            }
        }

        // Live update save btn % if exists
        const saveBtn = document.getElementById('globalSaveBtn');
        if (saveBtn) {
            const updateBtnText = () => {
                const pct = document.getElementById('persentase').value;
                saveBtn.innerHTML = `Simpan Progres (${pct}%)`;
            };
            updateBtnText();
            // Listen for changes
            document.getElementById('persentase').addEventListener('change', updateBtnText);
        }
    });
</script>
