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
                                        <th>Prodi</th>
                                        <th>Mata Kuliah</th>
                                        <th>Kategori MOOC</th>
                                        <th>Judul Course</th>
                                        <th>Studio</th>
                                        <th>Tanggal Shooting</th>
                                        <th>Waktu</th>
                                        <th>Jenis Kategori</th>
                                        <th>Target Upload</th>
                                        <th>Persentase</th> <!-- Ganti dari 'Progres' menjadi 'Persentase' -->
                                        <th>Progres</th> <!-- Field Progres -->
                                        <th>Keterangan</th> <!-- Field Keterangan -->
                                        <th>Durasi (Menit)</th>
                                        <th>Tautan Video</th>
                                        <th>Tgl Upload YouTube</th>
                                        <th>Editor</th>
                                        <th>Status</th> <!-- Status -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($progress as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
                                        <td>{{ $item->jadwalBooking->user->fakultas->nama_fakultas ?? '-' }}</td>
                                        <td>{{ $item->jadwalBooking->user->prodi->nama_prodi ?? '-' }}</td>
                                        <td>{{ $item->jadwalBooking->nama_mata_kuliah ?? '-' }}</td>
                                        <td>{{ $item->jadwalBooking->kategori_mooc ?? '-' }}</td>
                                        <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
                                        <td>{{ $item->jadwalBooking->studio->nama_studio ?? '-' }}</td>
                                        <td>{{ $item->jadwalBooking->tanggal ?? '-' }}</td>
                                        <td>{{ $item->jadwalBooking->jam ?? '-' }}</td>
                                        <td>{{ $item->jadwalBooking->jenis_kategori ?? '-' }}</td>
                                        <td>{{ $item->target_upload ? \Carbon\Carbon::parse($item->target_upload)->format('d/m/Y') : '-' }}</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" style="width: {{ $item->persentase }}%;">{{ $item->persentase }}%</div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge 
                                                @if($item->progres == 'belum') bg-secondary
                                                @elseif($item->progres == 'progres') bg-warning text-dark
                                                @else bg-success
                                                @endif">
                                                {{ ucfirst($item->progres) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge 
                                                @if($item->keterangan == 'belum terbit') bg-danger
                                                @else bg-success
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $item->keterangan)) }}
                                            </span>
                                        </td>
                                        <td>{{ $item->durasi ?? '-' }}</td>
                                        <td>
                                            @if($item->jadwalBooking->booking->link_video ?? '')
                                            <a href="{{ $item->jadwalBooking->booking->link_video ?? '' }}" target="_blank" class="btn btn-sm btn-primary">Lihat Video</a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>{{ $item->tanggal_upload_youtube ? \Carbon\Carbon::parse($item->tanggal_upload_youtube)->format('d/m/Y') : '-' }}</td>
                                        <td class="text-center">
                                            @if(empty($item->editor->nama))
                                            <button type="button"
                                                class="btn btn-sm btn-primary assign-editor-btn"
                                                data-progress-id="{{ $item->id }}"
                                                onclick="assignEditor({{ $item->id }})">
                                                <i class="bi bi-person-plus"></i> Isi Nama
                                            </button>
                                            @else
                                            {{ $item->editor->nama }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-success text-white">Sudah Shooting</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('modal-progres/' . $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="20" class="text-center">Tidak ada data progress</td>
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
</script>



@include('layout.footer')