<!-- Modal Tambah Jadwal -->
  <div class="modal fade" id="modalTambahJadwal" tabindex="-1" aria-labelledby="modalTambahJadwalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('jadwal.store') }}" method="POST" id="formTambahJadwal">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Tambah Jadwal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Tanggal</label>
              <input type="date" class="form-control" name="tanggal" id="tambahTanggal" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Jam</label>
              <select class="form-select" name="jam" id="tambahJam" required>
                <option selected disabled>Pilih Jam</option>
                <option value="09.00 WIB - 11.00 WIB">09.00 WIB - 11.00 WIB</option>
                <option value="11.00 WIB - 13.00 WIB">11.00 WIB - 13.00 WIB</option>
                <option value="13.00 WIB - 15.00 WIB">13.00 WIB - 15.00 WIB</option>
                <option value="15.00 WIB - 17.00 WIB">15.00 WIB - 17.00 WIB</option>
                <option value="17.00 WIB - 19.00 WIB">17.00 WIB - 19.00 WIB</option>
              </select>
            </div>
            <div class="alert alert-danger d-none" id="errorTambahJumat" role="alert">
              <i class="bi bi-exclamation-triangle-fill me-2"></i>
              Maaf, pada hari Jumat jam 11.00 WIB - 13.00 WIB tidak dapat digunakan karena waktu sholat Jumat.
            </div>
            <div class="mb-3">
              <label class="form-label">Jenis Kategori</label>
              <select class="form-select" name="jenis_kategori" id="jenisKategori" required>
                <option selected disabled>Pilih Kategori</option>
                <option value="Lomba">Lomba</option>
                <option value="Marketing">Marketing</option>
                <option value="E-Learning">E-Learning</option>
                <option value="Mooc">Mooc</option>
              </select>
            </div>
            <div class="mb-3 d-none" id="kategoriMoocGroup">
              <label class="form-label">Kategori MOOC</label>
              <select class="form-select" name="kategori_mooc" id="kategoriMooc">
                <option selected disabled>Pilih Kategori MOOC</option>
                @foreach($moocs as $mooc)
                <option value="{{ $mooc->judul_mooc }}">{{ $mooc->judul_mooc }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Studio</label>
              <select class="form-select" name="studio_id" id="tambahStudio" required>
                <option selected disabled>Pilih Studio</option>
                @foreach($studios as $studio)
                <option value="{{ $studio->id }}">{{ $studio->nama_studio }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Nama Mata Kuliah</label>
              <select class="form-select" name="nama_mata_kuliah" id="tambahNamaMataKuliah" required>
                <option selected disabled>Pilih Mata Kuliah</option>
                @foreach($mataKuliahs as $mataKuliah)
                <option value="{{ $mataKuliah->nama_mata_kuliah }}">{{ $mataKuliah->nama_mata_kuliah }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Judul Course</label>
              <input type="text" class="form-control" name="judul_course" id="tambahJudulCourse" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Dosen</label>
              <select class="form-select" name="dosen_id" id="tambahDosen" required>
                <option selected disabled>Pilih Dosen</option>
                @foreach($dosens as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                @endforeach
              </select>
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
    <div class="modal-dialog">
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
            <div class="mb-3">
              <label class="form-label">Tanggal</label>
              <input type="date" class="form-control" name="tanggal" id="editTanggal" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Jam</label>
              <select class="form-select" name="jam" id="editJam" required>
                <option selected disabled>Pilih Jam</option>
                <option value="09.00 WIB - 11.00 WIB">09.00 WIB - 11.00 WIB</option>
                <option value="11.00 WIB - 13.00 WIB">11.00 WIB - 13.00 WIB</option>
                <option value="13.00 WIB - 15.00 WIB">13.00 WIB - 15.00 WIB</option>
                <option value="15.00 WIB - 17.00 WIB">15.00 WIB - 17.00 WIB</option>
                <option value="17.00 WIB - 19.00 WIB">17.00 WIB - 19.00 WIB</option>
              </select>
            </div>
            <div class="alert alert-danger d-none" id="errorEditJumat" role="alert">
              <i class="bi bi-exclamation-triangle-fill me-2"></i>
              Maaf, pada hari Jumat jam 11.00 WIB - 13.00 WIB tidak dapat digunakan karena waktu sholat Jumat.
            </div>
            <div class="mb-3">
              <label class="form-label">Jenis Kategori</label>
              <select class="form-select" name="jenis_kategori" id="editJenisKategori" required>
                <option selected disabled>Pilih Kategori</option>
                <option value="Lomba">Lomba</option>
                <option value="Marketing">Marketing</option>
                <option value="E-Learning">E-Learning</option>
                <option value="Mooc">Mooc</option>
              </select>
            </div>
            <div class="mb-3 d-none" id="editKategoriMoocGroup">
              <label class="form-label">Kategori MOOC</label>
              <select class="form-select" name="kategori_mooc" id="editKategoriMooc">
                <option selected disabled>Pilih Kategori MOOC</option>
                @foreach($moocs as $mooc)
                <option value="{{ $mooc->judul_mooc }}">{{ $mooc->judul_mooc }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Studio</label>
              <select class="form-select" name="studio_id" id="editStudio" required>
                <option selected disabled>Pilih Studio</option>
                @foreach($studios as $studio)
                <option value="{{ $studio->id }}">{{ $studio->nama_studio }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Nama Mata Kuliah</label>
              <select class="form-select" name="nama_mata_kuliah" id="editNamaMataKuliah" required>
                <option selected disabled>Pilih Mata Kuliah</option>
                @foreach($mataKuliahs as $mataKuliah)
                <option value="{{ $mataKuliah->nama_mata_kuliah }}">{{ $mataKuliah->nama_mata_kuliah }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Judul Course</label>
              <input type="text" class="form-control" name="judul_course" id="editJudulCourse" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Dosen</label>
              <select class="form-select" name="dosen_id" id="editDosen" required>
                <option selected disabled>Pilih Dosen</option>
                @foreach($dosens as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                @endforeach
              </select>
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

  

</main>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Handle Kategori MOOC visibility
    const jenisKategori = document.getElementById('jenisKategori');
    const kategoriMoocGroup = document.getElementById('kategoriMoocGroup');

    const editJenisKategori = document.getElementById('editJenisKategori');
    const editKategoriMoocGroup = document.getElementById('editKategoriMoocGroup');

    // Friday prayer time validation function
    function validateFridayPrayerTime(date, timeSlot) {
      if (!date || !timeSlot) return true;

      const selectedDate = new Date(date);
      const dayOfWeek = selectedDate.getDay(); // 5 = Friday

      // Check if it's Friday and time slot is 11:00-13:00 WIB
      if (dayOfWeek === 5 && timeSlot === '11.00 WIB - 13.00 WIB') {
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
    function setupFormValidation(formId, dateId, timeId, errorId) {
      const form = document.getElementById(formId);
      const dateInput = document.getElementById(dateId);
      const timeSelect = document.getElementById(timeId);

      if (!form || !dateInput || !timeSelect) return;

      // Real-time validation
      dateInput.addEventListener('change', function() {
        showError(errorId, !validateFridayPrayerTime(this.value, timeSelect.value));
      });

      timeSelect.addEventListener('change', function() {
        showError(errorId, !validateFridayPrayerTime(dateInput.value, this.value));
      });

      // Form submission validation
      form.addEventListener('submit', function(e) {
        if (!validateFridayPrayerTime(dateInput.value, timeSelect.value)) {
          e.preventDefault();
          showError(errorId, true);
          return false;
        }
      });
    }

    // Setup validation for both forms
    setupFormValidation('formTambahJadwal', 'tambahTanggal', 'tambahJam', 'errorTambahJumat');
    setupFormValidation('formEditJadwal', 'editTanggal', 'editJam', 'errorEditJumat');

    // Tambah Jadwal
    jenisKategori?.addEventListener('change', function() {
      if (this.value === 'Mooc') {
        kategoriMoocGroup.classList.remove('d-none');
      } else {
        kategoriMoocGroup.classList.add('d-none');
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

        // Set form action
        document.getElementById('formEditJadwal').action = `/jadwal/${id}`;

        // Fill form fields
        document.getElementById('editId').value = id;
        document.getElementById('editTanggal').value = tanggal;
        document.getElementById('editJam').value = jam;
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