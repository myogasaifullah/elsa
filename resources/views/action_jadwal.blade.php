<!-- Modal Tambah Jadwal -->
<div class="modal fade" id="modalTambahJadwal" tabindex="-1" aria-labelledby="modalTambahJadwalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form action="{{ route('jadwal.store') }}" method="POST" id="formTambahJadwal">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Tambah Jadwal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4 mb-3">
              <label class="form-label">Tanggal</label>
              <input type="date" class="form-control" name="tanggal" id="tambahTanggal" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Jam Mulai</label>
              <input type="time" class="form-control" name="jam_mulai" id="tambahJamMulai" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Jam Selesai</label>
              <input type="time" class="form-control" name="jam_selesai" id="tambahJamSelesai" required>
            </div>
          </div>
          <div class="alert alert-danger d-none" id="errorTambahJumat" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            Maaf, pada hari Jumat jam 11.00 WIB - 13.00 WIB tidak dapat digunakan karena waktu sholat Jumat.
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Jenis Kategori</label>
              <select class="form-select" name="jenis_kategori" id="jenisKategori" required>
                <option selected disabled>Pilih Kategori</option>
                <option value="Lomba">Lomba</option>
                <option value="Marketing">Marketing</option>
                <option value="E-Learning">E-Learning</option>
                <option value="Mooc">Mooc</option>
              </select>
            </div>
            <div class="col-md-6 mb-3 d-none" id="kategoriMoocGroup">
              <label class="form-label">Kategori MOOC</label>
              <select class="form-select" name="kategori_mooc" id="kategoriMooc">
                <option selected disabled>Pilih Kategori MOOC</option>
                @foreach($moocs as $mooc)
                <option value="{{ $mooc->judul_mooc }}" data-dosen-id="{{ $mooc->dosen_id }}">{{ $mooc->judul_mooc }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Studio</label>
              <select class="form-select" name="studio_id" id="tambahStudio" required>
                <option selected disabled>Pilih Studio</option>
                @foreach($studios as $studio)
                <option value="{{ $studio->id }}">{{ $studio->nama_studio }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6 mb-3" id="namaMataKuliahGroup">
              <label class="form-label">Nama Mata Kuliah</label>
              <select class="form-select" name="nama_mata_kuliah" id="tambahNamaMataKuliah">
                <option selected disabled>Pilih Mata Kuliah</option>
                @foreach($mataKuliahs as $mataKuliah)
                <option value="{{ $mataKuliah->nama_mata_kuliah }}">{{ $mataKuliah->nama_mata_kuliah }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Judul Course</label>
              <input type="text" class="form-control" name="judul_course" id="tambahJudulCourse" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Dosen</label>
              <select class="form-select" name="dosen_id" id="tambahDosen" required>
                <option selected disabled>Pilih Dosen</option>
                @foreach($dosens as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Jadwal -->
<div class="modal fade" id="modalEditJadwal" tabindex="-1" aria-labelledby="modalEditJadwalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form action="" method="POST" id="formEditJadwal">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit Jadwal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="editId">
          <div class="row">
            <div class="col-md-4 mb-3">
              <label class="form-label">Tanggal</label>
              <input type="date" class="form-control" name="tanggal" id="editTanggal" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Jam Mulai</label>
              <input type="time" class="form-control" name="jam_mulai" id="editJamMulai" required>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Jam Selesai</label>
              <input type="time" class="form-control" name="jam_selesai" id="editJamSelesai" required>
            </div>
          </div>
          <div class="alert alert-danger d-none" id="errorEditJumat" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            Maaf, pada hari Jumat jam 11.00 WIB - 13.00 WIB tidak dapat digunakan karena waktu sholat Jumat.
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Jenis Kategori</label>
              <select class="form-select" name="jenis_kategori" id="editJenisKategori" required>
                <option selected disabled>Pilih Kategori</option>
                <option value="Lomba">Lomba</option>
                <option value="Marketing">Marketing</option>
                <option value="E-Learning">E-Learning</option>
                <option value="Mooc">Mooc</option>
              </select>
            </div>
            <div class="col-md-6 mb-3 d-none" id="editKategoriMoocGroup">
              <label class="form-label">Kategori MOOC</label>
              <select class="form-select" name="kategori_mooc" id="editKategoriMooc">
                <option selected disabled>Pilih Kategori MOOC</option>
                @foreach($moocs as $mooc)
                <option value="{{ $mooc->judul_mooc }}">{{ $mooc->judul_mooc }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Studio</label>
              <select class="form-select" name="studio_id" id="editStudio" required>
                <option selected disabled>Pilih Studio</option>
                @foreach($studios as $studio)
                <option value="{{ $studio->id }}">{{ $studio->nama_studio }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Nama Mata Kuliah</label>
              <select class="form-select" name="nama_mata_kuliah" id="editNamaMataKuliah" required>
                <option selected disabled>Pilih Mata Kuliah</option>
                @foreach($mataKuliahs as $mataKuliah)
                <option value="{{ $mataKuliah->nama_mata_kuliah }}">{{ $mataKuliah->nama_mata_kuliah }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Judul Course</label>
              <input type="text" class="form-control" name="judul_course" id="editJudulCourse" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Dosen</label>
              <select class="form-select" name="dosen_id" id="editDosen" required>
                <option selected disabled>Pilih Dosen</option>
                @foreach($dosens as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    let deleteFormId = null;
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    const confirmDeleteButton = document.getElementById('confirmDeleteButton');

    document.querySelectorAll('.btn-delete').forEach(button => {
      button.addEventListener('click', function() {
        deleteFormId = 'deleteForm' + this.dataset.id;
        deleteModal.show();
      });
    });

    confirmDeleteButton.addEventListener('click', function() {
      if (deleteFormId) {
        document.getElementById(deleteFormId).submit();
      }
    });
  });
</script>

<!-- Modal Detail Jadwal -->
<div class="modal fade" id="modalDetailJadwal" tabindex="-1" aria-labelledby="modalDetailJadwalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Jadwal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Tanggal:</label>
            <p id="detailTanggal"></p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Jam:</label>
            <p id="detailJam"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Jenis Kategori:</label>
            <p id="detailJenis"></p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Kategori MOOC:</label>
            <p id="detailKategori"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Studio:</label>
            <p id="detailStudio"></p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Mata Kuliah:</label>
            <p id="detailMatkul"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Judul Course:</label>
            <p id="detailJudul"></p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Dosen:</label>
            <p id="detailDosen"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Status:</label>
            <p id="detailStatus"></p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">User Name:</label>
            <p id="detailUsername"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Email:</label>
            <p id="detailEmail"></p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Telepon:</label>
            <p id="detailTelepon"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Fakultas:</label>
            <p id="detailFakultas"></p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Prodi:</label>
            <p id="detailProdi"></p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>





</main>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Handle Kategori MOOC visibility
    const jenisKategori = document.getElementById('jenisKategori');
    const kategoriMoocGroup = document.getElementById('kategoriMoocGroup');

    const editJenisKategori = document.getElementById('editJenisKategori');
    const editKategoriMoocGroup = document.getElementById('editKategoriMoocGroup');

    // Friday prayer time validation function
    function validateFridayPrayerTime(date, startTime, endTime) {
      if (!date || !startTime || !endTime) return true;

      const selectedDate = new Date(date);
      const dayOfWeek = selectedDate.getDay(); // 5 = Friday

      if (dayOfWeek !== 5) return true; // Not Friday, allow

      // Prayer time: 11:00 - 13:00
      const prayerStart = '11:00';
      const prayerEnd = '13:00';

      // Check if the selected time overlaps with prayer time
      if (startTime < prayerEnd && endTime > prayerStart) {
        return false;
      }

      return true;
    }

    // Show/hide error messages
    function showError(elementId, show) {
      const errorElement = document.getElementById(elementId);
      if (errorElement) {
        if (show) {
          errorElement.classList.remove('d-none');
        } else {
          errorElement.classList.add('d-none');
        }
      }
    }

    // Setup validation for forms
    function setupFormValidation(formId, dateId, startTimeId, endTimeId, errorId) {
      const form = document.getElementById(formId);
      const dateInput = document.getElementById(dateId);
      const startTimeInput = document.getElementById(startTimeId);
      const endTimeInput = document.getElementById(endTimeId);

      if (!form || !dateInput || !startTimeInput || !endTimeInput) return;

      // Real-time validation
      dateInput.addEventListener('change', function() {
        showError(errorId, !validateFridayPrayerTime(this.value, startTimeInput.value, endTimeInput.value));
      });

      startTimeInput.addEventListener('change', function() {
        showError(errorId, !validateFridayPrayerTime(dateInput.value, this.value, endTimeInput.value));
      });

      endTimeInput.addEventListener('change', function() {
        showError(errorId, !validateFridayPrayerTime(dateInput.value, startTimeInput.value, this.value));
      });

      // Form submission validation
      form.addEventListener('submit', function(e) {
        if (!validateFridayPrayerTime(dateInput.value, startTimeInput.value, endTimeInput.value)) {
          e.preventDefault();
          showError(errorId, true);
          return false;
        }
      });
    }

    // Setup validation for both forms
    setupFormValidation('formTambahJadwal', 'tambahTanggal', 'tambahJamMulai', 'tambahJamSelesai', 'errorTambahJumat');
    setupFormValidation('formEditJadwal', 'editTanggal', 'editJamMulai', 'editJamSelesai', 'errorEditJumat');

    // Tambah Jadwal
    jenisKategori?.addEventListener('change', function() {
      if (this.value === 'Mooc') {
        kategoriMoocGroup.classList.remove('d-none');
      } else {
        kategoriMoocGroup.classList.add('d-none');
      }
    });

    // Auto-fill dosen when MOOC is selected
    const kategoriMooc = document.getElementById('kategoriMooc');
    kategoriMooc?.addEventListener('change', function() {
      const selectedOption = this.options[this.selectedIndex];
      const dosenId = selectedOption.getAttribute('data-dosen-id');
      if (dosenId) {
        document.getElementById('tambahDosen').value = dosenId;
      }
    });

    // Edit Jadwal
    editJenisKategori?.addEventListener('change', function() {
      if (this.value === 'Mooc') {
        editKategoriMoocGroup.classList.remove('d-none');
      } else {
        editKategoriMoocGroup.classList.add('d-none');
      }
    });

    // Handle Edit Button Click
    document.querySelectorAll('.btn-editJadwal').forEach(btn => {
      btn.addEventListener('click', function() {
        const id = this.dataset.id;
        const tanggal = this.dataset.tanggal;
        const jam = this.dataset.jam;
        const jenis = this.dataset.jenis;
        const kategori = this.dataset.kategori;
        const studio = this.dataset.studio;
        const matkul = this.dataset.matkul;
        const judul = this.dataset.judul;
        const dosen = this.dataset.dosen;

        // Parse jam to get start and end times
        // Format: "09.00 WIB - 11.00 WIB"
        const timeParts = jam.split(' - ');
        const startTime = timeParts[0] ? timeParts[0].replace(' WIB', '').replace('.', ':') : '';
        const endTime = timeParts[1] ? timeParts[1].replace(' WIB', '').replace('.', ':') : '';

        // Set form action
        document.getElementById('formEditJadwal').action = `/jadwal/${id}`;

        // Fill form fields
        document.getElementById('editId').value = id;
        document.getElementById('editTanggal').value = tanggal;
        document.getElementById('editJamMulai').value = startTime;
        document.getElementById('editJamSelesai').value = endTime;
        document.getElementById('editJenisKategori').value = jenis;
        document.getElementById('editStudio').value = studio;
        document.getElementById('editNamaMataKuliah').value = matkul;
        document.getElementById('editJudulCourse').value = judul;
        document.getElementById('editDosen').value = dosen || '';
        document.getElementById('editKategoriMooc').value = kategori || '';

        // Clear any previous error messages
        showError('errorEditJumat', false);

        // Handle Kategori MOOC
        if (jenis === 'Mooc') {
          editKategoriMoocGroup.classList.remove('d-none');
          document.getElementById('editKategoriMooc').value = kategori || '';
        } else {
          editKategoriMoocGroup.classList.add('d-none');
        }
      });
    });

    // Handle delete confirmation
    let deleteFormId = null;
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    const confirmDeleteButton = document.getElementById('confirmDeleteButton');

    document.querySelectorAll('.btn-delete').forEach(button => {
      button.addEventListener('click', function() {
        deleteFormId = 'deleteForm' + this.dataset.id;
        deleteModal.show();
      });
    });

    confirmDeleteButton.addEventListener('click', function() {
      if (deleteFormId) {
        document.getElementById(deleteFormId).submit();
      }
    });
  });
</script>