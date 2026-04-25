@extends('layout.header')

@section('title', 'Progres')

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
                                        <th>Judul Course</th>
                                        <th>Tanggal Shooting</th>
                                        <th>Target Upload</th>
                                        <th>Persentase</th>
                                        <th>Progres</th>
                                        <th>Keterangan</th>
                                        <th>Durasi (Menit)</th>
                                        <th>Tautan Video</th>
                                        <th>Tgl Upload YouTube</th>
                                        <th>Editor</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($progress as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
                                        <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
                                        <td>{{ $item->jadwalBooking->tanggal ?? '-' }}</td>
                                        <td>{{ $item->target_upload ? \Carbon\Carbon::parse($item->target_upload)->format('d/m/Y') : '-' }}</td>

                                        {{-- Persentase --}}
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" style="width: {{ $item->persentase }}%">
                                                    {{ $item->persentase }}%
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Progres --}}
                                        <td class="text-center">
                                            <span class="badge 
                                                @if($item->progres == 'belum') bg-secondary
                                                @elseif($item->progres == 'progres') bg-warning text-dark
                                                @else bg-success
                                                @endif">
                                                {{ ucfirst($item->progres) }}
                                            </span>
                                        </td>

                                        {{-- Keterangan --}}
                                        <td class="text-center">
                                            @if($item->persentase == 100)
                                            <span class="badge bg-success">Sudah Terbit</span>
                                            @elseif($item->persentase == 95)
                                            <span class="badge bg-success">Acc</span>
                                            @elseif($item->persentase == 90)
                                            <span class="badge bg-danger">Revisi</span>
                                            @elseif($item->persentase == 85 || !empty($item->publish_link_youtube))
                                            <span class="badge bg-warning text-dark">Menunggu Validasi</span>
                                            @else
                                            <span class="badge 
                                                    @if($item->keterangan == 'belum terbit') bg-danger
                                                    @else bg-success
                                                    @endif">
                                                {{ ucfirst(str_replace('_', ' ', $item->keterangan)) }}
                                            </span>
                                            @endif
                                        </td>

                                        <td class="text-center">{{ $item->durasi ?? '-' }}</td>

                                        <td class="text-center">
                                            @if($item->publish_link_youtube)
                                            <a href="{{ $item->publish_link_youtube }}" target="_blank" class="btn btn-sm btn-primary">
                                                Lihat
                                            </a>
                                            @else
                                            -
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            {{ $item->tanggal_upload_youtube ? \Carbon\Carbon::parse($item->tanggal_upload_youtube)->format('d/m/Y') : '-' }}
                                        </td>

                                        {{-- Editor --}}
                                        <td class="text-center">
                                            @if(empty($item->editor->nama))
                                            <button class="btn btn-sm btn-primary"
                                                data-progress-id="{{ $item->id }}"
                                                onclick="assignEditor({{ $item->id }})">
                                                <i class="bi bi-person-plus"></i>
                                            </button>
                                            @else
                                            {{ $item->editor->nama }}
                                            @endif
                                        </td>

                                        {{-- Action --}}
                                        <td class="text-center">
                                            {{-- Detail --}}
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-info"
                                                title="Detail"
                                                aria-label="Detail"
                                                data-toggle="modal"
                                                data-target="#detailModal"
                                                onclick="showDetail(this)"

                                                data-dosen="{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}"
                                                data-fakultas="{{ $item->jadwalBooking->user->fakultas->nama_fakultas ?? '-' }}"
                                                data-prodi="{{ $item->jadwalBooking->user->prodi->nama_prodi ?? '-' }}"
                                                data-mata-kuliah="{{ $item->jadwalBooking->nama_mata_kuliah ?? '-' }}"
                                                data-kategori-mooc="{{ $item->jadwalBooking->kategori_mooc ?? '-' }}"
                                                data-judul-course="{{ $item->jadwalBooking->judul_course ?? '-' }}"
                                                data-studio="{{ $item->jadwalBooking->studio->nama_studio ?? '-' }}"
                                                data-tanggal-shooting="{{ $item->jadwalBooking->tanggal ?? '-' }}"
                                                data-waktu="{{ $item->jadwalBooking->jam ?? '-' }}"
                                                data-jenis-kategori="{{ $item->jadwalBooking->jenis_kategori ?? '-' }}"
                                                data-target-upload="{{ $item->target_upload ? \Carbon\Carbon::parse($item->target_upload)->format('d/m/Y') : '-' }}"
                                                data-persentase="{{ $item->persentase }}"
                                                data-progres="{{ ucfirst($item->progres) }}"
                                                data-keterangan="{{ ucfirst(str_replace('_', ' ', $item->keterangan)) }}"
                                                data-durasi="{{ $item->durasi ?? '-' }}"
                                                data-publish-link="{{ $item->publish_link_youtube ?? '' }}"
                                                data-tanggal-upload-youtube="{{ $item->tanggal_upload_youtube ? \Carbon\Carbon::parse($item->tanggal_upload_youtube)->format('d/m/Y') : '-' }}"
                                                data-editor="{{ $item->editor->nama ?? '-' }}"
                                                data-status="Sudah Shooting">
                                                <i class="bi bi-info-circle"></i>
                                            </button>

                                            {{-- Edit --}}
                                            <a
                                                href="{{ url('modal-progres/' . $item->id) }}"
                                                class="btn btn-sm btn-primary"
                                                title="Edit"
                                                aria-label="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="13" class="text-center">Tidak ada data progress</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-edit-editor').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                const name = this.getAttribute('data-name');
                const button = this;
                const actionTd = this.closest('tr').querySelector('.action-col');
                const statusTd = this.closest('tr').querySelector('.status-col');
                const progressText = this.closest('tr').querySelector('.progress-text');
                const keteranganText = this.closest('tr').querySelector('.keterangan-text');

                Swal.fire({
                    title: 'Edit Editor?',
                    text: 'Apakah Anda ingin Mengedit ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Ubah',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Ganti tombol menjadi nama editor
                        button.outerHTML = `<span>${name}</span>`;

                        // Update status menjadi "Proses Edit"
                        statusTd.innerHTML = `<span class="badge bg-warning text-dark">Proses Edit</span>`;

                        // Tampilkan tombol Action
                        if (actionTd) {
                            actionTd.style.display = 'table-cell';
                        }

                        // Update text progres sesuai dengan persentase
                        let persentase = parseInt(this.closest('tr').querySelector('.progress-bar').style.width);
                        if (persentase === 0) {
                            progressText.innerHTML = "Belum";
                        } else if (persentase === 100) {
                            progressText.innerHTML = "Selesai";
                        } else {
                            progressText.innerHTML = "Progres";
                        }

                        // Update keterangan sesuai dengan persentase
                        if (persentase === 100) {
                            keteranganText.innerHTML = "Sudah Terbit";
                        } else {
                            keteranganText.innerHTML = "Belum Terbit";
                        }

                        Swal.fire(
                            'Berhasil!',
                            'Lakukan Progres.',
                            'success'
                        );
                    }
                });
            });
        });
    });

    function assignEditor(progressId) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda ingin menjadi editor untuk progress ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Saya Setuju',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Get current user name
                const userName = '{{ auth()->user()->name ?? auth()->user()->email }}';

                // Send AJAX request to assign editor
                fetch(`/progres/${progressId}/assign-editor`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            editor_name: userName
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update the button to show the editor name
                            const button = document.querySelector(`button[data-progress-id="${progressId}"]`);
                            if (button) {
                                button.outerHTML = `<span>${userName}</span>`;
                            }

                            Swal.fire(
                                'Berhasil!',
                                'Anda telah ditambahkan sebagai editor.',
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Error!',
                                data.message || 'Gagal menambahkan editor.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat mengirim request.',
                            'error'
                        );
                    });
            }
        });
    }

    function showDetail(button) {
        // Populate modal with item data from data attributes
        document.getElementById('detailDosen').textContent = button.getAttribute('data-dosen');
        document.getElementById('detailFakultas').textContent = button.getAttribute('data-fakultas');
        document.getElementById('detailProdi').textContent = button.getAttribute('data-prodi');
        document.getElementById('detailMataKuliah').textContent = button.getAttribute('data-mata-kuliah');
        document.getElementById('detailKategoriMooc').textContent = button.getAttribute('data-kategori-mooc');
        document.getElementById('detailJudulCourse').textContent = button.getAttribute('data-judul-course');
        document.getElementById('detailStudio').textContent = button.getAttribute('data-studio');
        document.getElementById('detailTanggalShooting').textContent = button.getAttribute('data-tanggal-shooting');
        document.getElementById('detailWaktu').textContent = button.getAttribute('data-waktu');
        document.getElementById('detailJenisKategori').textContent = button.getAttribute('data-jenis-kategori');
        document.getElementById('detailTargetUpload').textContent = button.getAttribute('data-target-upload');
        document.getElementById('detailPersentase').textContent = button.getAttribute('data-persentase') + '%';
        document.getElementById('detailProgres').textContent = button.getAttribute('data-progres');
        document.getElementById('detailKeterangan').textContent = button.getAttribute('data-keterangan');
        document.getElementById('detailDurasi').textContent = button.getAttribute('data-durasi');
        document.getElementById('detailTautanVideo').innerHTML = button.getAttribute('data-publish-link') ? `<a href="${button.getAttribute('data-publish-link')}" target="_blank">Lihat Video</a>` : '-';
        document.getElementById('detailTglUploadYoutube').textContent = button.getAttribute('data-tanggal-upload-youtube');
        document.getElementById('detailEditor').textContent = button.getAttribute('data-editor');
        document.getElementById('detailStatus').textContent = button.getAttribute('data-status');
    }
</script>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Progres</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Dosen:</strong> <span id="detailDosen"></span></p>
                        <p><strong>Fakultas:</strong> <span id="detailFakultas"></span></p>
                        <p><strong>Prodi:</strong> <span id="detailProdi"></span></p>
                        <p><strong>Mata Kuliah:</strong> <span id="detailMataKuliah"></span></p>
                        <p><strong>Kategori MOOC:</strong> <span id="detailKategoriMooc"></span></p>
                        <p><strong>Judul Course:</strong> <span id="detailJudulCourse"></span></p>
                        <p><strong>Studio:</strong> <span id="detailStudio"></span></p>
                        <p><strong>Tanggal Shooting:</strong> <span id="detailTanggalShooting"></span></p>
                        <p><strong>Waktu:</strong> <span id="detailWaktu"></span></p>
                        <p><strong>Jenis Kategori:</strong> <span id="detailJenisKategori"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Target Upload:</strong> <span id="detailTargetUpload"></span></p>
                        <p><strong>Persentase:</strong> <span id="detailPersentase"></span></p>
                        <p><strong>Progres:</strong> <span id="detailProgres"></span></p>
                        <p><strong>Keterangan:</strong> <span id="detailKeterangan"></span></p>
                        <p><strong>Durasi (Menit):</strong> <span id="detailDurasi"></span></p>
                        <p><strong>Tautan Video:</strong> <span id="detailTautanVideo"></span></p>
                        <p><strong>Tgl Upload YouTube:</strong> <span id="detailTglUploadYoutube"></span></p>
                        <p><strong>Editor:</strong> <span id="detailEditor"></span></p>
                        <p><strong>Status:</strong> <span id="detailStatus"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')