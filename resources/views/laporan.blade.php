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
    
    <!-- Tabel Progres Editor -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tabel Progres Editor</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Dosen</th>
                            <th>FAK</th>
                            <th>Mata Kuliah / Tema</th>
                            <th>Judul Course</th>
                            <th>Lokasi</th>
                            <th>Tanggal Shooting</th>
                            <th>Jenis Shooting</th>
                            <th>Target Upload</th>
                            <th>Editor</th>
                            <th>Progres</th>
                            <th>Durasi (Menit)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($progress as $index => $item)
                            <tr>
                                <td>{{ ($progress->currentPage() - 1) * $progress->perPage() + $index + 1 }}</td>
                                <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
                                <td>{{ $item->jadwalBooking->user->fakultas->nama_fakultas ?? '-' }}</td>
                                <td>{{ $item->jadwalBooking->nama_mata_kuliah ?? '-' }}</td>
                                <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
                                <td>{{ $item->jadwalBooking->studio->nama_studio ??  '-' }}</td>
                                <td>{{ $item->jadwalBooking->tanggal ? \Carbon\Carbon::parse($item->jadwalBooking->tanggal)->format('d F Y') : '-' }}</td>
                                <td>{{ $item->jadwalBooking->jenis_kategori ?? '-' }}</td>
                                <td>{{ $item->target_upload ? \Carbon\Carbon::parse($item->target_upload)->format('d F Y') : '-' }}</td>
                                <td>{{ $item->editor->nama ?? '-' }}</td>
                                <td>
                                    @if($item->progres == 'Belum')
                                        <span class="badge bg-secondary">Belum</span>
                                    @elseif($item->progres == 'Progres')
                                        <span class="badge bg-warning text-dark">Progres</span>
                                    @elseif($item->progres == 'Selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @else
                                        <span class="badge bg-info">{{ $item->progres }}</span>
                                    @endif
                                </td>
                                <td>{{ $item->durasi ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">Tidak ada data progres</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination untuk Tabel Progres Editor -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Menampilkan {{ $progress->firstItem() ?? 0 }} - {{ $progress->lastItem() ?? 0 }} dari {{ $progress->total() }} entri
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm justify-content-end mb-0">
                        {{ $progress->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    @include('laporan.mentah')
</main>

@include('layout.footer')