@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">

      <div class="col-xl-12">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Display success and error messages -->
            @if(session('status') == 'profile-updated')
                <div class="alert alert-success" role="alert">
                    Profile updated successfully.
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">
    <div class="tab-pane fade show active profile-overview" id="profile-overview">
        
        <h5 class="card-title">Profile Details</h5>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">Nama Lengkap</div>
            <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">Nomor Telepon</div>
            <div class="col-lg-9 col-md-8">{{ $user->nomor_telepon }}</div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">Fakultas</div>
            <div class="col-lg-9 col-md-8">{{ $user->fakultas->nama_fakultas }}</div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">Program Studi</div>
            <div class="col-lg-9 col-md-8">{{ $user->prodi->nama_prodi }}</div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">Role</div>
            <div class="col-lg-9 col-md-8">{{ $user->role }}</div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 label">Email</div>
            <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
        </div>
    </div>

    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="row mb-3">
                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                <div class="col-md-8 col-lg-9">
                    <input name="fullName" type="text" class="form-control" id="fullName" value="{{ $user->name }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="phone" class="col-md-4 col-lg-3 col-form-label">Nomor Telepon</label>
            <div class="col-md-8 col-lg-9">
                <input name="nomor_telepon" type="text" class="form-control" id="nomor_telepon" value="{{ $user->nomor_telepon }}">
            </div>
            </div>

            <div class="row mb-3">
                <label for="fakultas" class="col-md-4 col-lg-3 col-form-label">Fakultas</label>
                <div class="col-md-8 col-lg-9">
                    <select class="form-select" id="fakultas" name="fakultas">
                        <option value="">Pilih Fakultas</option>
                        @foreach ($fakultas as $fak)
                            <option value="{{ $fak->id }}" {{ $user->fakultas_id == $fak->id ? 'selected' : '' }}>{{ $fak->nama_fakultas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="prodi" class="col-md-4 col-lg-3 col-form-label">Program Studi</label>
                <div class="col-md-8 col-lg-9">
                    <select class="form-select" id="prodi" name="prodi">
                        <option value="">Pilih Program Studi</option>
                        @foreach ($prodis as $prodi)
                            <option value="{{ $prodi->id }}" {{ $user->prodi_id == $prodi->id ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="role" class="col-md-4 col-lg-3 col-form-label">Role</label>
                <div class="col-md-8 col-lg-9">
                    <select class="form-select" id="role" name="role">
                        <option value="">Pilih Role</option>
                        <option value="Mahasiswa" {{ $user->role == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        <option value="Dosen" {{ $user->role == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                        <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                <div class="col-md-8 col-lg-9">
                    <input name="email" type="email" class="form-control" id="email" value="{{ $user->email }}">
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <div class="tab-pane fade pt-3" id="profile-change-password">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                <div class="col-md-8 col-lg-9">
                    <input name="password" type="password" class="form-control" id="currentPassword">
                </div>
            </div>

            <div class="row mb-3">
                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                <div class="col-md-8 col-lg-9">
                    <input name="newpassword" type="password" class="form-control" id="newPassword">
                </div>
            </div>

            <div class="row mb-3">
                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                <div class="col-md-8 col-lg-9">
                    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Change Password</button>
            </div>
        </form>
    </div>
</div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

@include('layout.footer')