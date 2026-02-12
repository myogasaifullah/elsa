@extends('layout.header')

@section('title', 'Acc Booking')

@include('layout.sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Acc Booking</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
        <li class="breadcrumb-item">Booking</li>
        <li class="breadcrumb-item active">Acc</li>
      </ol>
    </nav>
  </div>

  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <div class="col-12">
    <div class="card recent-sales overflow-auto">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Booking <span>| Jadwal</span></h5>
        </div>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Jam</th>
              <th scope="col">Jenis Kategori</th>
              <th scope="col">Kategori MOOC</th>
              <th scope="col">Studio</th>
              <th scope="col">Mata Kuliah</th>
              <th scope="col">Judul Course</th>
              <th scope="col">Dosen</th>
              <th scope="col">Status</th>
              <th scope="col">User Name</th>
              <!-- <th scope="col">Email</th>
              <th scope="col">Telepon</th>
              <th scope="col">Fakultas</th>
              <th scope="col">Prodi</th> -->
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($bookings as $booking)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d/m/Y') }}</td>
              <td>{{ $booking->jam }}</td>
              <td>{{ $booking->jenis_kategori }}</td>
              <td>{{ $booking->kategori_mooc ?? '-' }}</td>
              <td>{{ $booking->studio->nama_studio }}</td>
              <td>{{ $booking->nama_mata_kuliah }}</td>
              <td>{{ $booking->judul_course }}</td>
              <td>{{ $booking->dosen->nama_dosen ?? '-' }}</td>
              <td>
                @if($booking->status == 'pending')
                <span class="badge bg-warning text-dark">
                  <i class="bi bi-hourglass-split me-1"></i> Pending
                </span>
                @elseif($booking->status == 'approved')
                <span class="badge bg-success">
                  <i class="bi bi-calendar-check me-1"></i> Approved
                </span>
                @elseif($booking->status == 'rejected')
                <span class="badge bg-danger">
                  <i class="bi bi-x-octagon me-1"></i> Rejected
                </span>
                @else
                <span class="badge bg-secondary">{{ $booking->status }}</span>
                @endif
              </td>
              <td>{{ $booking->user->name ?? '-' }}</td>
              <!-- <td>{{ $booking->user->email ?? '-' }}</td>
              <td>{{ $booking->user->nomor_telepon ?? '-' }}</td>
              <td>{{ $booking->user->fakultas->nama_fakultas ?? '-' }}</td>
              <td>{{ $booking->user->prodi->nama_prodi ?? '-' }}</td> -->
              <td>
                <div class="d-flex gap-1">
                  <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" style="display: inline" data-bs-target="#detailModal{{ $booking->id }}">
                    <i class="bi bi-eye"></i> Detail
                  </button>
                  <form action="{{ route('booking.approve', $booking) }}" method="POST" style="display: inline;" id="approveForm{{ $booking->id }}">
                    @csrf
                    <button type="button" class="btn btn-sm btn-success btn-approve" data-id="{{ $booking->id }}" data-judul="{{ $booking->judul_course }}">
                      <i class="bi bi-check-circle"></i> ACC
                    </button>
                  </form>
                  <form action="{{ route('booking.reject', $booking) }}" method="POST" style="display: inline;" id="rejectForm{{ $booking->id }}">
                    @csrf
                    <button type="button" class="btn btn-sm btn-danger btn-reject" data-id="{{ $booking->id }}" data-judul="{{ $booking->judul_course }}">
                      <i class="bi bi-x-circle"></i> Tolak
                    </button>
                  </form>
                </div>
              </td>
            </tr>

            <!-- Detail Modal -->
            <div class="modal fade" id="detailModal{{ $booking->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $booking->id }}" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel{{ $booking->id }}">Detail Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-6">
                        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->tanggal)->format('d/m/Y') }}</p>
                        <p><strong>Jam:</strong> {{ $booking->jam }}</p>
                        <p><strong>Jenis Kategori:</strong> {{ $booking->jenis_kategori }}</p>
                        <p><strong>Kategori MOOC:</strong> {{ $booking->kategori_mooc ?? '-' }}</p>
                        <p><strong>Studio:</strong> {{ $booking->studio->nama_studio }}</p>
                        <p><strong>Mata Kuliah:</strong> {{ $booking->nama_mata_kuliah }}</p>
                        <p><strong>Judul Course:</strong> {{ $booking->judul_course }}</p>
                        <p><strong>Dosen:</strong> {{ $booking->dosen->nama_dosen ?? '-' }}</p>
                      </div>
                      <div class="col-md-6">
                        <p><strong>Status:</strong>
                          @if($booking->status == 'pending')
                          <span class="badge bg-warning text-dark">Pending</span>
                          @elseif($booking->status == 'approved')
                          <span class="badge bg-success">Approved</span>
                          @elseif($booking->status == 'rejected')
                          <span class="badge bg-danger">Rejected</span>
                          @else
                          <span class="badge bg-secondary">{{ $booking->status }}</span>
                          @endif
                        </p>
                        <p><strong>User Name:</strong> {{ $booking->user->name ?? '-' }}</p>
                        <p><strong>Email:</strong> {{ $booking->user->email ?? '-' }}</p>
                        <p><strong>Telepon:</strong> {{ $booking->user->nomor_telepon ?? '-' }}</p>
                        <p><strong>Fakultas:</strong> {{ $booking->user->fakultas->nama_fakultas ?? '-' }}</p>
                        <p><strong>Prodi:</strong> {{ $booking->user->prodi->nama_prodi ?? '-' }}</p>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            @empty
            <tr>
              <td colspan="16" class="text-center">Tidak ada booking pending</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

</main>

@include('layout.footer')

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Handle Approve Button Click
    document.querySelectorAll('.btn-approve').forEach(button => {
      button.addEventListener('click', function() {
        const id = this.dataset.id;
        const judul = this.dataset.judul;

        Swal.fire({
          title: 'Apakah Anda yakin?',
          text: `ACC booking untuk "${judul}"?`,
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Ya, ACC',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            document.getElementById('approveForm' + id).submit();
          }
        });
      });
    });

    // Handle Reject Button Click
    document.querySelectorAll('.btn-reject').forEach(button => {
      button.addEventListener('click', function() {
        const id = this.dataset.id;
        const judul = this.dataset.judul;

        Swal.fire({
          title: 'Apakah Anda yakin?',
          text: `Tolak booking untuk "${judul}"?`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#dc3545',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Ya, Tolak',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            document.getElementById('rejectForm' + id).submit();
          }
        });
      });
    });
  });
</script>