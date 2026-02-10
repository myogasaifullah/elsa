<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    @auth
    <!-- Debug sementara (bisa dihapus nanti) -->
    <!-- <p>User Role: {{ Auth::user()->role }}</p> -->

    {{-- ================= ADMIN ================= --}}
    @if(Auth::check() && strtolower(Auth::user()->role) === 'admin')

    <!-- Home -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('/') ? '' : 'collapsed' }}" href="{{ url('/') }}">
        <i class="bi bi-house"></i><span>Home</span>
      </a>
    </li>

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('dashboard*') ? '' : 'collapsed' }}" href="{{ url('dashboard') }}">
        <i class="bi bi-grid"></i><span>Dashboard</span>
      </a>
    </li>

    <!-- Dosen -->
    <li class="nav-item"> <a class="nav-link {{ Request::is('dosen*') ? '' : 'collapsed' }}" href="{{ url('dosen') }}"> <i class="bi bi-person-badge"></i> <span>Dosen</span> </a> </li>

    <!-- Editor -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('editor*') ? '' : 'collapsed' }}" href="{{ url('editor') }}">
        <i class="bi bi-card-list"></i><span>Editor</span>
      </a>
    </li>

    <!-- User -->
    <li class="nav-item"> <a class="nav-link {{ Request::is('listuser', 'verifikasi') ? '' : 'collapsed' }}" data-target="#user-nav" data-toggle="collapse" href="#"> <i class="bi bi-person"></i><span>User</span><i class="bi bi-chevron-down ms-auto"></i> </a>
      <ul id="user-nav" class="nav-content collapse {{ Request::is('listuser', 'verifikasi') ? 'show' : '' }}" data-parent="#sidebar-nav">
        <li> <a href="{{ url('listuser') }}" class="{{ Request::is('listuser') ? 'active' : '' }}"> <i class="bi bi-circle"></i><span>List user</span> </a> </li>
        <li> <a href="{{ url('verifikasi') }}" class="{{ Request::is('verifikasi') ? 'active' : '' }}"> <i class="bi bi-circle"></i><span>Verifikasi</span> </a> </li>
      </ul>
    </li>

    <!-- Akademik -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('fakultas-prodi*','studio-matkul*','dosen-mooc*') ? '' : 'collapsed' }}"
        data-target="#akademik-nav" data-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Akademik</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="akademik-nav" class="nav-content collapse {{ Request::is('fakultas-prodi*','studio-matkul*','dosen-mooc*') ? 'show' : '' }}" data-parent="#sidebar-nav">
        <li>
          <a href="{{ url('fakultas-prodi') }}" class="{{ Request::is('fakultas-prodi*') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Fakultas-Prodi</span>
          </a>
        </li>
        <li>
          <a href="{{ url('dosen-mooc') }}" class="{{ Request::is('dosen-mooc*') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Dosen-Mooc</span>
          </a>
        </li>
        <li>
          <a href="{{ url('studio-matkul') }}" class="{{ Request::is('studio-matkul*') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Studio-Matkul</span>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ Request::is('jadwal*') ? '' : 'collapsed' }}" href="{{ url('jadwal') }}">
        <i class="bi bi-journal-text"></i><span>Booking Studio</span>
      </a>
    </li>

    <!-- Kelola Booking -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('','acc*','booking*') ? '' : 'collapsed' }}" data-target="#booking-nav" data-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Kelola Booking</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="booking-nav" class="nav-content collapse {{ Request::is('','acc*','booking*') ? 'show' : '' }}" data-parent="#sidebar-nav">
        <li>
          <a href="{{ url('acc') }}" class="{{ Request::is('acc*') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Acc Booking</span>
          </a>
        </li>
        <li>
          <a href="{{ url('booking') }}" class="{{ Request::is('booking*') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Booking Jadwal</span>
          </a>
        </li>
      </ul>
    </li>

    <!-- Progres -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('progres*') ? '' : 'collapsed' }}" href="{{ url('progres') }}">
        <i class="bi bi-bar-chart"></i><span>Progres</span>
      </a>
    </li>

    <!-- Laporan -->
    <li class="nav-item"> <a class="nav-link {{ Request::is('laporan*') ? '' : 'collapsed' }}" data-target="#laporan-nav" data-toggle="collapse" href="#"> <i class="bi bi-file-earmark"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i> </a>
      <ul id="laporan-nav" class="nav-content collapse {{ Request::is('laporan*') ? 'show' : '' }}" data-parent="#sidebar-nav">
        <li> <a href="{{ url('laporan/editor') }}" class="{{ Request::is('laporan/editor') ? 'active' : '' }}"> <i class="bi bi-circle"></i><span>Editor</span> </a> </li>
        <li> <a href="{{ url('laporan/jadwal') }}" class="{{ Request::is('laporan/jadwal') ? 'active' : '' }}"> <i class="bi bi-circle"></i><span>Jadwal</span> </a> </li>
        <li> <a href="{{ url('laporan/mooc') }}" class="{{ Request::is('laporan/mooc') ? 'active' : '' }}"> <i class="bi bi-circle"></i><span>Mooc</span> </a> </li>
        <li> <a href="{{ url('laporan/dosen') }}" class="{{ Request::is('laporan/dosen') ? 'active' : '' }}"> <i class="bi bi-circle"></i><span>Dosen</span> </a> </li>
        <li> <a href="{{ url('laporan/terbit') }}" class="{{ Request::is('laporan/terbit') ? 'active' : '' }}"> <i class="bi bi-circle"></i><span>Terbit</span> </a> </li>
        <li> <a href="{{ url('laporan/progres') }}" class="{{ Request::is('laporan/progres') ? 'active' : '' }}"> <i class="bi bi-circle"></i><span>Progres</span> </a> </li>
        <li> <a href="{{ url('laporan/fakultas') }}" class="{{ Request::is('laporan/fakultas') ? 'active' : '' }}"> <i class="bi bi-circle"></i><span>Fakultas</span> </a> </li>
      </ul>
    </li>

    <!-- Arsip -->
    <li class="nav-item"> <a class="nav-link {{ Request::is('arsip*') ? '' : 'collapsed' }}" href="{{ url('arsip') }}"> <i class="bi bi-archive"></i> <span>Arsip</span> </a> </li>

    {{-- ================= MAHASISWA ================= --}}
    @elseif(Auth::check() && in_array(strtolower(Auth::user()->role), ['mahasiswa','']))

    <!-- Home -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('/') ? '' : 'collapsed' }}" href="{{ url('/') }}">
        <i class="bi bi-house"></i><span>Home</span>
      </a>
    </li>

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('dashboard*') ? '' : 'collapsed' }}" href="{{ url('dashboard') }}">
        <i class="bi bi-grid"></i><span>Dashboard</span>
      </a>
    </li>

    <!-- Booking Studio -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('jadwal*') ? '' : 'collapsed' }}" href="{{ url('jadwal') }}">
        <i class="bi bi-journal-text"></i><span>Booking Studio</span>
      </a>
    </li>

    {{-- ================= DOSEN ================= --}}
    @elseif(Auth::check() && in_array(strtolower(Auth::user()->role), ['','dosen']))

    <!-- Home -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('/') ? '' : 'collapsed' }}" href="{{ url('/') }}">
        <i class="bi bi-house"></i><span>Home</span>
      </a>
    </li>

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('dashboard*') ? '' : 'collapsed' }}" href="{{ url('dashboard') }}">
        <i class="bi bi-grid"></i><span>Dashboard</span>
      </a>
    </li>

    <!-- Booking Studio -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('jadwal*') ? '' : 'collapsed' }}" href="{{ url('jadwal') }}">
        <i class="bi bi-journal-text"></i><span>Booking Studio</span>
      </a>
    </li>

    <!-- Dosen -->
    <li class="nav-item">
      <a class="nav-link {{ (!Request::is('dosen-mooc*') && Request::is('dosen*')) ? '' : 'collapsed' }}" href="{{ url('dosen') }}">
        <i class="bi bi-person-badge"></i><span>Dosen</span>
      </a>
    </li>

    <!-- Booking Studio -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('dosen-mooc*') ? '' : 'collapsed' }}" href="{{ url('dosen-mooc') }}">
        <i class="bi bi-layout-text-window-reverse"></i><span>Dosen - Mooc</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ Request::is('studio-matkul*') ? '' : 'collapsed' }}" href="{{ url('studio-matkul') }}">
        <i class="bi bi-layout-text-window-reverse"></i><span>Mata Kuliah</span>
      </a>
    </li>

    {{-- ================= EDITOR ================= --}}
    @elseif(Auth::check() && strtolower(Auth::user()->role) === 'editor')

    <!-- Home -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('/') ? '' : 'collapsed' }}" href="{{ url('/') }}">
        <i class="bi bi-house"></i><span>Home</span>
      </a>
    </li>

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('dashboard*') ? '' : 'collapsed' }}" href="{{ url('dashboard') }}">
        <i class="bi bi-grid"></i><span>Dashboard</span>
      </a>
    </li>

    <!-- Editor -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('editor*') ? '' : 'collapsed' }}" href="{{ url('editor') }}">
        <i class="bi bi-card-list"></i><span>Editor</span>
      </a>
    </li>

    <!-- Progres -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('progres*') ? '' : 'collapsed' }}" href="{{ url('progres') }}">
        <i class="bi bi-bar-chart"></i><span>Progres</span>
      </a>
    </li>


    @endif

    @else
    {{-- ================= GUEST (belum login) ================= --}}
    <li class="nav-item">
      <a class="nav-link {{ Request::is('/') ? '' : 'collapsed' }}" href="{{ url('/') }}">
        <i class="bi bi-house"></i><span>Home</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Request::is('dashboard*') ? '' : 'collapsed' }}" href="{{ url('dashboard') }}">
        <i class="bi bi-grid"></i><span>Dashboard</span>
      </a>
    </li>
    @endauth

  </ul>

</aside>
<!-- End Sidebar -->