@extends('layout.header')

@section('title', 'Booking Jadwal')


@include('layout.sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Booking Jadwal</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
        <li class="breadcrumb-item">Booking</li>
        <li class="breadcrumb-item active">Jadwal</li>
      </ol>
    </nav>
  </div>
  <div class="card p-3">
    <div class="calendar-wrapper">
      <!-- Sidebar -->
      <div class="calendar-sidebar">
        <!-- Mini Calendar -->
        <div class="card mb-3">
          <div class="mini-calendar" id="mini-calendar"></div>
        </div>

        <!-- Filter -->
        <div class="card p-3">
          <h6 class="mb-2">Event Filters</h6>
          <div class="event-filters">
            <label><input type="checkbox" checked /> Semua</label>
            <label><input type="checkbox" checked style="accent-color: red;" /> MOOC</label>
            <label><input type="checkbox" checked style="accent-color: green;" /> Pembelajaran</label>
            <label><input type="checkbox" checked style="accent-color: orange;" /> Lomba</label>
          </div>
        </div>
      </div>

      <!-- Main Calendar -->
      <div class="calendar-content p-6">
        <div id="calendar"></div>
      </div>
    </div>
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
          <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahJadwal">
            <i class="bi bi-plus-circle"></i> Tambah Jadwal
          </button>
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
              <th scope="col">Telepon</th> -->
              <th scope="col">Fakultas</th>
              <th scope="col">Prodi</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($jadwals as $index => $jadwal)
            <tr>
              <th scope="row">{{ $index + 1 }}</th>
              <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}</td>
              <td>{{ $jadwal->jam }}</td>
              <td>{{ $jadwal->jenis_kategori }}</td>
              <td>{{ $jadwal->kategori_mooc ?? '-' }}</td>
              <td>{{ $jadwal->studio->nama_studio }}</td>
              <td>{{ $jadwal->nama_mata_kuliah }}</td>
              <td>{{ $jadwal->judul_course }}</td>
              <td>{{ $jadwal->dosen->nama_dosen ?? '-' }}</td>
              <td>
                @if($jadwal->status == 'pending')
                <span class="badge bg-warning text-dark">
                  <i class="bi bi-hourglass-split me-1"></i> Pending
                </span>
                @elseif($jadwal->status == 'schedule')
                <span class="badge bg-success">
                  <i class="bi bi-calendar-check me-1"></i> Schedule
                </span>
                @else
                <span class="badge bg-secondary">{{ $jadwal->status }}</span>
                @endif
              </td>
              <td>{{ $jadwal->user->name ?? '-' }}</td>
              <!-- <td>{{ $jadwal->user->email ?? '-' }}</td>
              <td>{{ $jadwal->user->nomor_telepon ?? '-' }}</td> -->
              <td>{{ $jadwal->user->fakultas->singkatan ?? '-' }}</td>
              <td>{{ $jadwal->user->prodi->singkatan ?? '-' }}</td>
              <td>
                <button class="btn btn-sm btn-primary btn-editJadwal"
                  data-id="{{ $jadwal->id }}"
                  data-tanggal="{{ $jadwal->tanggal }}"
                  data-jam="{{ $jadwal->jam }}"
                  data-jenis="{{ $jadwal->jenis_kategori }}"
                  data-kategori="{{ $jadwal->kategori_mooc }}"
                  data-studio="{{ $jadwal->studio_id }}"
                  data-matkul="{{ $jadwal->nama_mata_kuliah }}"
                  data-judul="{{ $jadwal->judul_course }}"
                  data-dosen="{{ $jadwal->dosen_id }}"
                  data-bs-toggle="modal"

                  data-bs-target="#modalEditJadwal"
    title="Edit">
    <i class="bi bi-pencil-square"></i>
                </button>
                <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" class="d-inline" id="deleteForm{{ $jadwal->id }}">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="btn btn-sm btn-outline-danger btn-delete" data-id="{{ $jadwal->id }}" title="Hapus">
      <i class="bi bi-trash"></i>
    </button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="15" class="text-center">Tidak ada jadwal booking</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  @include('components.delete-confirmation-modal')

     @include('action_jadwal')



@include('layout.footer')

<!-- ======================== Init Script ======================== -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    let calendar; // buat variabel global

    if (calendarEl) {
      calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 530,
        locale: 'id',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        events: {
          url: '/jadwal-approved', // endpoint backend
          method: 'GET',
          failure: function() {
            alert('Gagal memuat data');
          },
          success: function(data) {
            console.log('Events received:', data); // Log the received events
            data.forEach(event => {
              console.log('Event:', event); // Log each event
              console.log('Event properties:', event.extendedProps); // Log event properties
            });
          }
        },

        eventClick: function(info) {
          const event = info.event;
          const props = event.extendedProps;
          alert(
            'Judul: ' + event.title + '\n' +
            'Mata Kuliah: ' + props.mata_kuliah + '\n' +
            'Studio: ' + props.studio + '\n' +
            'Dosen: ' + props.dosen + '\n' +
            'Jam: ' + props.jam + '\n' +
            'Tanggal: ' + event.start.toLocaleDateString('id-ID') + '\n' +
            'Jenis: ' + props.jenis + '\n' +
            'Status: ' + props.status
          );
        },
        eventMouseEnter: function(info) {
          info.el.style.cursor = 'pointer';
        },
        eventMouseLeave: function(info) {
          info.el.style.cursor = 'default';
        }
      });

      calendar.render();
    }

    const miniCal = document.getElementById('mini-calendar');
    if (miniCal) {
      new Datepicker(miniCal, {
        calendarInline: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
      });
    }

    setInterval(() => {
      if (calendar) {
        calendar.refetchEvents();
      }
    }, 30000);
  });
</script>
