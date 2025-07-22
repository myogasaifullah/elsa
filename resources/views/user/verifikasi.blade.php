@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Verifikasi user</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
        <li class="breadcrumb-item">User</li>
        <li class="breadcrumb-item active">Verifikasi User</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="col-12">
    <div class="card recent-sales overflow-auto">
      <div class="card-body">
        <h5 class="card-title">Verifikasi Pengguna <span>| Status: Pending</span></h5>
        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Username</th>
              <th scope="col">Email</th>
              <th scope="col">Fakultas</th>
              <th scope="col">Prodi</th>
              <th scope="col">No Telp</th>
              <th scope="col">Role</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>rafid21</td>
              <td>rafid@example.com</td>
              <td>FTIK</td>
              <td>Informatika</td>
              <td>089653920595</td>
              <td>Editor</td>
              <td><span class="badge bg-warning text-dark">Pending</span></td>
              <td>
                <button class="btn btn-sm btn-success btn-verifikasi">Verifikasi</button>
                <button class="btn btn-sm btn-danger btn-tolak">Tolak</button>

              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>nabila_dsn</td>
              <td>nabila@example.com</td>
              <td>FTIK</td>
              <td>Sistem Informasi</td>
              <td>089653920595</td>
              <td>Editor</td>
              <td><span class="badge bg-warning text-dark">Pending</span></td>
              <td>
                <button class="btn btn-sm btn-success btn-verifikasi">Verifikasi</button>
                <button class="btn btn-sm btn-danger btn-tolak">Tolak</button>

              </td>
            </tr>

            <!-- Tambahkan baris lainnya sesuai data -->
          </tbody>
        </table>

      </div>

    </div>
  </div>

   <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Daftar Editor <span>| Universitas</span></h5>
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahEditor">
                        <i class="bi bi-plus-circle"></i> Tambah MOOC
                    </button>
                </div>

                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Editor</th>
                            <th>Akun</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Hapis yuliana</td>
                            <td>hapisyuliana@gmail.com</td>
                            <td>
                                <button class="btn btn-sm btn-primary btn-edit-editor" data-id="1">Edit</button>
                                <button class="btn btn-sm btn-danger btn-hapus-editor" data-id="1">Hapus</button>
                            </td>
                        </tr>
                        <!-- Tambah baris lainnya -->
                    </tbody>
                </table>


            </div>
        </div>
    </div>

    <!-- Modal Edit Editor -->
    <div class="modal fade" id="modalEditEditor" tabindex="-1" aria-labelledby="modalEditEditorLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEditEditor">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit MOOC</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editMoocId">
                        <input type="text" class="form-control mb-2" id="editJudulEditor" placeholder="Nama Editor">
                        <select class="form-select" id="editEditorId">
                            <option value="1">hapisyuliana@gmail.com</option>
                            <option value="2">hapisyuliana@gmail.com</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Tambah Editor -->
    <div class="modal fade" id="modalTambahEditor" tabindex="-1" aria-labelledby="modalTambahEditorLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formTambahEditor">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah MOOC</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control mb-2" placeholder="Nama Editor" name="judul_editor">

                        <select class="form-select" name="editor_id">
                            <option selected disabled>Akun Editor</option>
                            <option value="1">hapisyuliana@gmail.com</option>
                            <option value="2">hapisyuliana@gmail.com</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</main><!-- End #main -->


<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-verifikasi').forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
          title: 'Verifikasi Pengguna?',
          text: 'Pengguna akan diubah menjadi aktif.',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Ya, Verifikasi',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            // Kirim form / AJAX di sini
            Swal.fire('Berhasil!', 'Pengguna telah diverifikasi.', 'success');
          }
        });
      });
    });

    document.querySelectorAll('.btn-tolak').forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
          title: 'Tolak Pengguna?',
          text: 'Pengguna akan ditolak dan tidak bisa login.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Tolak',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            // Kirim form / AJAX di sini
            Swal.fire('Ditolak!', 'Pengguna telah ditolak.', 'error');
          }
        });
      });
    });
  });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- FUNGSI EDIT ---
        document.querySelectorAll('.btn-edit-editor').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const id = this.getAttribute('data-id');
                const judul = row.children[1].textContent.trim();
                const namaDosen = row.children[2].textContent.trim();

                // Set data ke modal edit
                document.getElementById('editMoocId').value = id;
                document.getElementById('editJudulEditor').value = judul;

                const select = document.getElementById('editEditorId');
                for (let i = 0; i < select.options.length; i++) {
                    if (select.options[i].text === namaDosen) {
                        select.selectedIndex = i;
                        break;
                    }
                }

                // Tampilkan modal edit
                const modal = new bootstrap.Modal(document.getElementById('modalEditEditor'));
                modal.show();
            });
        });

        // --- FUNGSI HAPUS ---
        document.querySelectorAll('.btn-hapus-editor').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const id = this.getAttribute('data-id');
                const judul = row.children[1].textContent.trim();

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: `MOOC "${judul}" akan dihapus!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        row.remove(); // Hapus baris dari tabel

                        Swal.fire('Dihapus!', 'MOOC berhasil dihapus.', 'success');
                    }
                });
            });
        });

        // --- SIMPAN EDITOR (opsional: pakai AJAX/Fetch ke server) ---
        document.getElementById('formEditEditor').addEventListener('submit', function(e) {
            e.preventDefault();

            const id = document.getElementById('editMoocId').value;
            const judul = document.getElementById('editJudulEditor').value;
            const dosen = document.getElementById('editEditorId').selectedOptions[0].text;

            const row = [...document.querySelectorAll('.btn-edit-editor')].find(btn => btn.getAttribute('data-id') === id)?.closest('tr');
            if (row) {
                row.children[1].textContent = judul;
                row.children[2].textContent = dosen;
            }

            bootstrap.Modal.getInstance(document.getElementById('modalEditEditor')).hide();
            Swal.fire('Tersimpan!', 'Data editor berhasil diperbarui.', 'success');
        });
    });
</script>


@include('layout.footer')