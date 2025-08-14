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

@include('booking.jadwal')

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
