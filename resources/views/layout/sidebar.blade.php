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

        <!-- Akademik -->
        <li class="nav-item">
          <a class="nav-link {{ Request::is('fakultas-prodi*','studio-matkul*','dosen-mooc*') ? '' : 'collapsed' }}" 
             data-bs-target="#akademik-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-layout-text-window-reverse"></i><span>Akademik</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="akademik-nav" class="nav-content collapse {{ Request::is('fakultas-prodi*','studio-matkul*','dosen-mooc*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
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

        <!-- Kelola Booking -->
        <li class="nav-item">
          <a class="nav-link {{ Request::is('jadwal*','acc*','booking*') ? '' : 'collapsed' }}" data-bs-target="#booking-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Kelola Booking</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="booking-nav" class="nav-content collapse {{ Request::is('jadwal*','acc*','booking*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
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

        <!-- Editor -->
        <li class="nav-item">
          <a class="nav-link {{ Request::is('editor*') ? '' : 'collapsed' }}" href="{{ url('editor') }}">
            <i class="bi bi-card-list"></i><span>Editor</span>
          </a>
        </li>


      {{-- ================= MAHASISWA / DOSEN ================= --}}
      @elseif(Auth::check() && in_array(strtolower(Auth::user()->role), ['mahasiswa','dosen']))

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

        <!-- Progres -->
        <li class="nav-item">
          <a class="nav-link {{ Request::is('progres*') ? '' : 'collapsed' }}" href="{{ url('progres') }}">
            <i class="bi bi-bar-chart"></i><span>Progres</span>
          </a>
        </li>

        <!-- Editor -->
        <li class="nav-item">
          <a class="nav-link {{ Request::is('editor*') ? '' : 'collapsed' }}" href="{{ url('editor') }}">
            <i class="bi bi-card-list"></i><span>Editor</span>
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
