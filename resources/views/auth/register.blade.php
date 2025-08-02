<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Register - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
  <div class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
              <a href="{{ url('/') }}" class="logo d-flex align-items-center w-auto">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">Elsa</span>
              </a>
            </div>

            <div class="card mb-3">
              <div class="card-body">
                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                  <p class="text-center small">Enter your personal details to create account</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="row g-3 needs-validation" novalidate>
                  @csrf

                  <div class="col-12">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                    <x-input-error :messages="$errors->get('name')" class="invalid-feedback d-block" />
                  </div>

                  <div class="col-12">
                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" class="form-control" id="nomor_telepon" value="{{ old('nomor_telepon') }}" required>
                    <x-input-error :messages="$errors->get('nomor_telepon')" class="invalid-feedback d-block" />
                  </div>

                  <div class="col-12">
                    <label for="fakultas_id" class="form-label">Fakultas</label>
                    <select name="fakultas_id" id="fakultas_id" class="form-select" required>
                      <option value="" disabled selected>Pilih Fakultas</option>
                      @foreach ($fakultas as $fak)
                        <option value="{{ $fak->id }}" {{ old('fakultas_id') == $fak->id ? 'selected' : '' }}>{{ $fak->nama_fakultas }}</option>
                      @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('fakultas_id')" class="invalid-feedback d-block" />
                  </div>

                  <div class="col-12">
                    <label for="prodi_id" class="form-label">Program Studi</label>
                    <select name="prodi_id" id="prodi_id" class="form-select" required>
                      <option value="" disabled selected>Pilih Program Studi</option>
                      @foreach ($prodis as $prodi)
                        <option value="{{ $prodi->id }}" {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                      @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('prodi_id')" class="invalid-feedback d-block" />
                  </div>

                  <div class="col-12">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-select" required>
                      <option value="" disabled selected>Pilih Role</option>
                      <option value="Mahasiswa" {{ old('role') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                      <option value="Dosen" {{ old('role') == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                      <option value="Editor" {{ old('role') == 'Editor' ? 'selected' : '' }}>Editor</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="invalid-feedback d-block" />
                  </div>

                  <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                      <x-input-error :messages="$errors->get('email')" class="invalid-feedback d-block" />
                    </div>
                  </div>

                  <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                    <x-input-error :messages="$errors->get('password')" class="invalid-feedback d-block" />
                  </div>

                  <div class="col-12">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="invalid-feedback d-block" />
                  </div>

                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" name="terms" type="checkbox" value="1" id="acceptTerms" required>
                      <label class="form-check-label" for="acceptTerms">Saya setuju dengan <a href="#">syarat dan ketentuan</a></label>
                    </div>
                  </div>

                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Create Account</button>
                  </div>

                  <div class="col-12">
                    <p class="small mb-0">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
                  </div>

                </form>
              </div>
            </div>

            <div class="credits text-center mt-2">
              &copy; {{ date('Y') }} <a href="https://bootstrapmade.com/">Elsa</a>. All Rights Reserved.
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>
</main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>