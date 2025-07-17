<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('dashboard') ? '' : 'collapsed' }}" href="{{ url('dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <!-- User -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('listuser', 'verifikasi') ? '' : 'collapsed' }}" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-person"></i><span>User</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="user-nav" class="nav-content collapse {{ Request::is('listuser', 'verifikasi') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ url('listuser') }}" class="{{ Request::is('listuser') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>List user</span>
          </a>
        </li>
        <li>
          <a href="{{ url('verifikasi') }}" class="{{ Request::is('verifikasi') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Verifikasi</span>
          </a>
        </li>
      </ul>
    </li>

    <!-- Akademik -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('fakultas-prodi', 'studio-matkul') ? '' : 'collapsed' }}" data-bs-target="#akademik-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Akademik</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="akademik-nav" class="nav-content collapse {{ Request::is('fakultas-prodi', 'studio-matkul') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ url('fakultas-prodi') }}" class="{{ Request::is('fakultas-prodi') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Fakultas-Prodi</span>
          </a>
        </li>
        <li>
          <a href="{{ url('studio-matkul') }}" class="{{ Request::is('studio-matkul') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Studio-Matkul</span>
          </a>
        </li>
      </ul>
    </li>

    <!-- Booking -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('jadwal', 'acc') ? '' : 'collapsed' }}" data-bs-target="#booking-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Booking</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="booking-nav" class="nav-content collapse {{ Request::is('jadwal', 'acc') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ url('jadwal') }}" class="{{ Request::is('jadwal') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Booking Jadwal</span>
          </a>
        </li>
        <li>
          <a href="{{ url('acc') }}" class="{{ Request::is('acc') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Acc Booking</span>
          </a>
        </li>
      </ul>
    </li>

    <!-- Laporan -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('laporan') ? '' : 'collapsed' }}" href="{{ url('laporan') }}">
        <i class="bi bi-menu-button-wide"></i>
        <span>Laporan</span>
      </a>
    </li>

    <!-- progres -->
    <li class="nav-item">
      <a class="nav-link {{ Request::is('progres') ? '' : 'collapsed' }}" href="{{ url('progres') }}">
        <i class="bi bi-bar-chart"></i>
        <span>Progres</span>
      </a>
    </li>

  </ul>
</aside><!-- End Sidebar -->
