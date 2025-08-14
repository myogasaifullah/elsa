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
                                            @if($item->publish_link_youtube ?? '')
                                            <a href="{{ $item->publish_link_youtube ?? '' }}" target="_blank" class="btn btn-sm btn-primary">Lihat Video</a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>{{ $item->tanggal_upload_youtube ? \Carbon\Carbon::parse($item->tanggal_upload_youtube)->format('d/m/Y') : '-' }}</td>
                                        <td class="text-center">
                                            {{ auth()->user()->name }} <!-- Always show logged-in user as editor -->
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
    // JavaScript for handling editor assignment remains the same
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-edit-editor').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                // Handle editor assignment
                // ...
            });
        });
    });
</script>

@include('layout.footer')
