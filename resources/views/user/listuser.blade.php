@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>List user</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
        <li class="breadcrumb-item">User</li>
        <li class="breadcrumb-item active">List User</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!-- Recent Sales -->
  <div class="col-12">
    <div class="card recent-sales overflow-auto">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Filter</h6>
          </li>
          <li><a class="dropdown-item" href="#">Today</a></li>
          <li><a class="dropdown-item" href="#">This Month</a></li>
          <li><a class="dropdown-item" href="#">This Year</a></li>
        </ul>
      </div>

      <div class="card-body d-flex justify-content-between align-items-center mb-3">
        <h5 class="card-title">Data Pengguna <span>| Today</span></h5>
        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
          <i class="bi bi-plus-circle"></i> Tambah User
        </button>
      </div>

      <table class="table table-borderless datatable">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Fakultas</th> <!-- baru -->
            <th scope="col">Prodi</th>
            <th scope="col">No. Telp</th> <!-- baru -->
            <th scope="col">Role</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->fakultas ? $user->fakultas->nama_fakultas : '-' }}</td>
            <td>{{ $user->prodi ? $user->prodi->nama_prodi : '-' }}</td>
            <td>{{ $user->nomor_telepon ?? '-' }}</td>
            <td>{{ $user->role ?? '-' }}</td>
            <td>
              @if($user->status == 'active')
                <span class="badge bg-success">Aktif</span>
              @elseif($user->status == 'pending')
                <span class="badge bg-warning">Pending</span>
              @else
                <span class="badge bg-secondary">{{ $user->status }}</span>
              @endif
            </td>
            <td>
              <button class="btn btn-sm btn-primary" 
                      data-bs-toggle="modal" 
                      data-bs-target="#modalEditUser"
                      data-user-id="{{ $user->id }}"
                      data-user-name="{{ $user->name }}"
                      data-user-email="{{ $user->email }}"
                      data-user-nomor-telepon="{{ $user->nomor_telepon }}"
                      data-user-fakultas-id="{{ $user->fakultas_id }}"
                      data-user-prodi-id="{{ $user->prodi_id }}"
                      data-user-role="{{ $user->role }}"
                      data-user-status="{{ $user->status }}">
                Edit
              </button>
              <form action="{{ route('user.destroy', $user) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-sm btn-danger btn-hapus">Hapus</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>

      </table>

    </div>

  </div>
  </div>
  <!-- Modal Tambah User -->
  <div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('user.store') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="modalTambahUserLabel">Tambah User Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="name" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="no_telp" class="form-label">No. Telp</label>
                <input type="text" name="nomor_telepon" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="fakultas" class="form-label">Fakultas</label>
                <select name="fakultas_id" class="form-select" required>
                  <option value="" disabled selected>- Pilih Fakultas -</option>
                  @foreach($fakultas as $fak)
                  <option value="{{ $fak->id }}">{{ $fak->nama_fakultas }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label for="prodi" class="form-label">Program Studi</label>
                <select name="prodi_id" class="form-select" required>
                  <option value="" disabled selected>- Pilih Prodi -</option>
                  @foreach($prodis as $prodi)
                  <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label for="role" class="form-label">Role</label>
                <select name="role" class="form-select" required>
                  <option value="" disabled selected>- Pilih Role -</option>
                  <option value="Admin">Admin</option>
                  <option value="Dosen">Dosen</option>
                  <option value="Mahasiswa">Mahasiswa</option>
                  <option value="Editor">Editor</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-select" required>
                  <option value="active">Aktif</option>
                  <option value="pending">Pending</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="modal-footer mt-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal -->
  <!-- Modal Edit User -->
  <div class="modal fade" id="modalEditUser" tabindex="-1" aria-labelledby="modalEditUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="editUserForm" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditUserLabel">Edit Data User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label for="edit_username" class="form-label">Username</label>
                <input type="text" id="edit_username" name="name" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="edit_email" class="form-label">Email</label>
                <input type="email" id="edit_email" name="email" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="edit_no_telp" class="form-label">No. Telp</label>
                <input type="text" id="edit_no_telp" name="nomor_telepon" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="edit_fakultas" class="form-label">Fakultas</label>
                <select id="edit_fakultas" name="fakultas_id" class="form-select" required>
                  <option value="" disabled selected>- Pilih Fakultas -</option>
                  @foreach($fakultas as $fak)
                  <option value="{{ $fak->id }}">{{ $fak->nama_fakultas }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label for="edit_prodi" class="form-label">Program Studi</label>
                <select id="edit_prodi" name="prodi_id" class="form-select" required>
                  <option value="" disabled selected>- Pilih Prodi -</option>
                  @foreach($prodis as $prodi)
                  <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label for="edit_role" class="form-label">Role</label>
                <select id="edit_role" name="role" class="form-select" required>
                  <option value="" disabled selected>- Pilih Role -</option>
                  <option value="Admin">Admin</option>
                  <option value="Dosen">Dosen</option>
                  <option value="Mahasiswa">Mahasiswa</option>
                  <option value="Editor">Editor</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="edit_status" class="form-label">Status</label>
                <select id="edit_status" name="status" class="form-select" required>
                  <option value="active">Aktif</option>
                  <option value="pending">Pending</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="edit_password" class="form-label">Password Baru (opsional)</label>
                <input type="password" id="edit_password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
              </div>
            </div>
          </div>
          <div class="modal-footer mt-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal -->

</main><!-- End #main -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Handle edit button click
    document.querySelectorAll('[data-bs-target="#modalEditUser"]').forEach(btn => {
      btn.addEventListener('click', function() {
        // Get user data from button attributes
        const userId = this.getAttribute('data-user-id');
        const userName = this.getAttribute('data-user-name');
        const userEmail = this.getAttribute('data-user-email');
        const userNomorTelepon = this.getAttribute('data-user-nomor-telepon');
        const userFakultasId = this.getAttribute('data-user-fakultas-id');
        const userProdiId = this.getAttribute('data-user-prodi-id');
        const userRole = this.getAttribute('data-user-role');
        const userStatus = this.getAttribute('data-user-status');
        
        // Populate modal fields
        document.getElementById('edit_username').value = userName;
        document.getElementById('edit_email').value = userEmail;
        document.getElementById('edit_no_telp').value = userNomorTelepon;
        document.getElementById('edit_fakultas').value = userFakultasId;
        document.getElementById('edit_prodi').value = userProdiId;
        document.getElementById('edit_role').value = userRole;
        document.getElementById('edit_status').value = userStatus;
        
        // Set form action
        const form = document.getElementById('editUserForm');
        form.action = `/user/${userId}`;
      });
    });
    
    // Handle delete button click
    document.querySelectorAll('.btn-hapus').forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
          title: 'Hapus User?',
          text: 'Data User akan dihapus dari sistem.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            // Submit the form
            this.closest('form').submit();
          }
        });
      });
    });
  });
</script>
@include('layout.footer')
