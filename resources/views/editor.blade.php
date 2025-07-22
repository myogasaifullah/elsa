@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Progres</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Editor</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tabel Progres Produksi MOOC</h5>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Dosen</th>
                                        <th>Fakultas</th>
                                        <th>Mata Kuliah</th>
                                        <th>Kategori MOOC</th>
                                        <th>Judul Course</th>
                                        <th>Studio</th>
                                        <th>Tanggal Shooting</th>
                                        <th>Waktu</th>
                                        <th>Jenis Kategori</th>
                                        <th>Target Upload</th>
                                        <th>Progres</th>
                                        <th>Durasi (Menit)</th>
                                        <th>Tautan Video</th>
                                        <th>Tgl Upload YouTube</th>
                                        <th>Editor</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Dr. Andi Maulana</td>
                                        <td>Teknik dan Ilmu Komputer</td>
                                        <td>Rekayasa Perangkat Lunak</td>
                                        <td>MOOC Mandiri</td>
                                        <td>Pemrograman Web Lanjut</td>
                                        <td>Studio 1</td>
                                        <td>2025-07-18</td>
                                        <td>08:00 - 10:00</td>
                                        <td>Video Teaching</td>
                                        <td>2025-07-30</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" style="width: 70%;">70%</div>
                                            </div>
                                        </td>
                                        <td>45</td>
                                        <td><a href="https://youtu.be/xxxxxxx" target="_blank">Lihat Video</a></td>
                                        <td>2025-07-19</td>
                                        <td class="text-center">Hapis yuliana</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-progres">Progres</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Siti Rahma, M.Kom</td>
                                        <td>Ilmu Pendidikan</td>
                                        <td>Manajemen Pendidikan</td>
                                        <td>MOOC Nasional</td>
                                        <td>Pengantar Kurikulum</td>
                                        <td>Studio 2</td>
                                        <td>2025-07-20</td>
                                        <td>10:00 - 12:00</td>
                                        <td>Presentasi Video</td>
                                        <td>2025-08-01</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-danger" style="width: 50%;">50%</div>
                                            </div>
                                        </td>
                                        <td>30</td>
                                        <td><a href="https://youtu.be/yyyyyyy" target="_blank">Lihat Video</a></td>
                                        <td>2025-07-22</td>
                                        <td class="text-center">Hapis yuliana</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-progres">Progres</button>
                                        </td>
                                    </tr>
                                    <!-- Tambahkan baris lainnya sesuai data -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tabel Produksi MOOC Selesai</h5>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Dosen</th>
                                        <th>Fakultas</th>
                                        <th>Mata Kuliah</th>
                                        <th>Kategori MOOC</th>
                                        <th>Judul Course</th>
                                        <th>Studio</th>
                                        <th>Tanggal Shooting</th>
                                        <th>Waktu</th>
                                        <th>Jenis Kategori</th>
                                        <th>Target Upload</th>
                                        <th>Progres</th>
                                        <th>Durasi (Menit)</th>
                                        <th>Tautan Video</th>
                                        <th>Tgl Upload YouTube</th>
                                        <th>Editor</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Dr. Andi Maulana</td>
                                        <td>Teknik dan Ilmu Komputer</td>
                                        <td>Rekayasa Perangkat Lunak</td>
                                        <td>MOOC Mandiri</td>
                                        <td>Pemrograman Web Lanjut</td>
                                        <td>Studio 1</td>
                                        <td>2025-07-18</td>
                                        <td>08:00 - 10:00</td>
                                        <td>Video Teaching</td>
                                        <td>2025-07-30</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" style="width: 100%;">100%</div>
                                            </div>
                                        </td>
                                        <td>45</td>
                                        <td><a href="https://youtu.be/xxxxxxx" target="_blank">Lihat Video</a></td>
                                        <td>2025-07-19</td>
                                        <td class="text-center">Hapis yuliana</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-progres">Progres</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Siti Rahma, M.Kom</td>
                                        <td>Ilmu Pendidikan</td>
                                        <td>Manajemen Pendidikan</td>
                                        <td>MOOC Nasional</td>
                                        <td>Pengantar Kurikulum</td>
                                        <td>Studio 2</td>
                                        <td>2025-07-20</td>
                                        <td>10:00 - 12:00</td>
                                        <td>Presentasi Video</td>
                                        <td>2025-08-01</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" style="width: 100%;">100%</div>
                                            </div>
                                        </td>
                                        <td>30</td>
                                        <td><a href="https://youtu.be/yyyyyyy" target="_blank">Lihat Video</a></td>
                                        <td>2025-07-22</td>
                                        <td class="text-center">Hapis yuliana</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-progres">Progres</button>
                                        </td>
                                    </tr>
                                    <!-- Tambahkan baris lainnya sesuai data -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Progres -->
    <div class="modal fade" id="modalProgres" tabindex="-1" aria-labelledby="modalProgresLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formProgres">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalProgresLabel">Progres Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">

                        <!-- Progress Bar -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Progress</label>
                            <div class="progress">
                                <div class="progress-bar" id="progressBar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                        </div>

                        <!-- Tanggal Shooting -->
                        <div class="mb-3">
                            <label for="tanggalShooting" class="form-label">Tanggal Shooting</label>
                            <input type="date" class="form-control" id="tanggalShooting" name="tanggalShooting">
                        </div>

                        <!-- Waktu Dari - Sampai -->
                        <div class="mb-3">
                            <label class="form-label">Waktu (Dari - Sampai)</label>
                            <div class="d-flex gap-2">
                                <input type="time" class="form-control" id="waktuDari" name="waktuDari">
                                <input type="time" class="form-control" id="waktuSampai" name="waktuSampai">
                            </div>
                        </div>

                        <!-- Target Publish -->
                        <div class="mb-3">
                            <label for="target" class="form-label">Target Publish</label>
                            <input type="date" class="form-control" id="target" name="target">
                        </div>

                        <!-- Durasi -->
                        <div class="mb-3">
                            <label for="durasi" class="form-label">Durasi (menit)</label>
                            <input type="number" class="form-control" id="durasi" name="durasi" min="1">
                        </div>

                        <!-- Publish -->
                        <div class="mb-3">
                            <label for="publish" class="form-label">Publish</label>
                            <input type="text" class="form-control" id="publish" name="publish">
                        </div>

                        <!-- Tanggal Publish -->
                        <div class="mb-3">
                            <label for="tanggalPublish" class="form-label">Tanggal Publish</label>
                            <input type="date" class="form-control" id="tanggalPublish" name="tanggalPublish">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


 <!-- Modal Progres -->
    <div class="modal fade" id="modalProgres" tabindex="-1" aria-labelledby="modalProgresLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formProgres">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalProgresLabel">Progres Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">

                        <!-- Progress Bar -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Progress</label>
                            <div class="progress">
                                <div class="progress-bar" id="progressBar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                        </div>

                        <!-- Tanggal Shooting -->
                        <div class="mb-3">
                            <label for="tanggalShooting" class="form-label">Tanggal Shooting</label>
                            <input type="date" class="form-control" id="tanggalShooting" name="tanggalShooting">
                        </div>

                        <!-- Waktu Dari - Sampai -->
                        <div class="mb-3">
                            <label class="form-label">Waktu (Dari - Sampai)</label>
                            <div class="d-flex gap-2">
                                <input type="time" class="form-control" id="waktuDari" name="waktuDari">
                                <input type="time" class="form-control" id="waktuSampai" name="waktuSampai">
                            </div>
                        </div>

                        <!-- Target Publish -->
                        <div class="mb-3">
                            <label for="target" class="form-label">Target Publish</label>
                            <input type="date" class="form-control" id="target" name="target">
                        </div>

                        <!-- Durasi -->
                        <div class="mb-3">
                            <label for="durasi" class="form-label">Durasi (menit)</label>
                            <input type="number" class="form-control" id="durasi" name="durasi" min="1">
                        </div>

                        <!-- Publish -->
                        <div class="mb-3">
                            <label for="publish" class="form-label">Publish</label>
                            <input type="text" class="form-control" id="publish" name="publish">
                        </div>

                        <!-- Tanggal Publish -->
                        <div class="mb-3">
                            <label for="tanggalPublish" class="form-label">Tanggal Publish</label>
                            <input type="date" class="form-control" id="tanggalPublish" name="tanggalPublish">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>

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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Buka modal
    document.querySelectorAll('.btn-progres').forEach(button => {
      button.addEventListener('click', function () {
        document.getElementById('formProgres').reset();
        updateProgress(); // reset progress
        const modal = new bootstrap.Modal(document.getElementById('modalProgres'));
        modal.show();
      });
    });

    // Event input untuk update progres real-time
    const inputs = [
      'tanggalShooting', 'waktuDari', 'waktuSampai',
      'target', 'durasi', 'publish', 'tanggalPublish'
    ];
    inputs.forEach(id => {
      document.getElementById(id).addEventListener('input', updateProgress);
    });

    // Fungsi update progres bar
    function updateProgress() {
      const total = inputs.length;
      let filled = 0;
      inputs.forEach(id => {
        if (document.getElementById(id).value.trim() !== '') {
          filled++;
        }
      });
      const percent = Math.floor((filled / total) * 100);
      const bar = document.getElementById('progressBar');
      bar.style.width = percent + '%';
      bar.innerText = percent + '%';
      bar.setAttribute('aria-valuenow', percent);
    }

    // Submit form
    document.getElementById('formProgres').addEventListener('submit', function (e) {
      e.preventDefault();

      // Ambil nilai dari form
      const dataProgres = {};
      inputs.forEach(id => {
        dataProgres[id] = document.getElementById(id).value;
      });

      localStorage.setItem('dataProgres', JSON.stringify(dataProgres));

      Swal.fire('Tersimpan!', 'Progres video telah diperbarui.', 'success');
      console.log('Data progres:', dataProgres);
    });
  });
</script>


@include('layout.footer')