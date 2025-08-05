@extends('layout.header')

@section('title', 'Booking Jadwal')

@include('layout.sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Booking Jadwal</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
        <li class="breadcrumb-item">Booking</li>
        <li class="breadcrumb-item active">Jadwal</li>
      </ol>
    </nav>
  </div>

  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <div class="col-12">
    <div class="card recent-sales overflow-auto">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Booking <span>| Jadwal</span></h5>
          <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahJadwal">
            <i class="bi bi-plus-circle"></i> Tambah Jadwal
          </button>
        </div>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Jam</th>
              <th scope="col">Jenis Kategori</th>
              <th scope="col">Kategori MOOC</th>
              <th scope="col">Studio</th>
              <th scope="col">Mata Kuliah</th>
              <th scope="col">Judul Course</th>
              <th scope="col">Dosen</th>
              <th scope="col">Status</th>
              <th scope="col">User Name</th>
              <th scope="col">Email</th>
              <th scope="col">Telepon</th>
              <th scope="col">Fakultas</th>
              <th scope="col">Prodi</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($jadwals as $index => $jadwal)
            <tr>
              <th scope="row">{{ $index + 1 }}</th>
              <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}</td>
              <td>{{ $jadwal->jam }}</td>
              <td>{{ $jadwal->jenis_kategori }}</td>
              <td>{{ $jadwal->kategori_mooc ?? '-' }}</td>
              <td>{{ $jadwal->studio->nama_studio }}</td>
              <td>{{ $jadwal->nama_mata_kuliah }}</td>
              <td>{{ $jadwal->judul_course }}</td>
              <td>{{ $jadwal->dosen->nama_dosen ?? '-' }}</td>
              <td>
                @if($jadwal->status == 'pending')
                <span class="badge bg-warning text-dark">
                  <i class="bi bi-hourglass-split me-1"></i> Pending
                </span>
                @elseif($jadwal->status == 'schedule')
                <span class="badge bg-success">
                  <i class="bi bi-calendar-check me-1"></i> Schedule
                </span>
                @else
                <span class="badge bg-secondary">{{ $jadwal->status }}</span>
                @endif
              </td>
              <td>{{ $jadwal->user->name ?? '-' }}</td>
              <td>{{ $jadwal->user->email ?? '-' }}</td>
              <td>{{ $jadwal->user->nomor_telepon ?? '-' }}</td>
              <td>{{ $jadwal->user->fakultas->nama_fakultas ?? '-' }}</td>
              <td>{{ $jadwal->user->prodi->nama_prodi ?? '-' }}</td>
              <td>
                <button class="btn btn-sm btn-primary btn-editJadwal"
                  data-id="{{ $jadwal->id }}"
                  data-tanggal="{{ $jadwal->tanggal }}"
                  data-jam="{{ $jadwal->jam }}"
                  data-jenis="{{ $jadwal->jenis_kategori }}"
                  data-kategori="{{ $jadwal->kategori_mooc }}"
                  data-studio="{{ $jadwal->studio }}"
                  data-matkul="{{ $jadwal->nama_mata_kuliah }}"
                  data-judul="{{ $jadwal->judul_course }}"
                  data-bs-toggle="modal"
                  data-bs-target="#modalEditJadwal">
                  Edit
                </button>
                <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" class="d-inline" id="deleteForm{{ $jadwal->id }}">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $jadwal->id }}">
                    Hapus
                  </button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="15" class="text-center">Tidak ada jadwal booking</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  @include('components.delete-confirmation-modal')

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
              <select name="studio_id" required>
    @foreach($studios as $studio)
        <option value="{{ $studio->id }}">{{ $studio->nama_studio }}</option>
    @endforeach
</select>

            </div>
            <div class="mb-3">
              <label class="form-label">Nama Mata Kuliah</label>
              <select class="form-select" name="nama_mata_kuliah" required>
                <option selected disabled>Pilih Mata Kuliah</option>
                @foreach($mataKuliahs as $mataKuliah)
                <option value="{{ $mataKuliah->nama_mata_kuliah }}">{{ $mataKuliah->nama_mata_kuliah }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Judul Course</label>
              <input type="text" class="form-control" name="judul_course" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Dosen</label>
              <select class="form-select" name="dosen_id" required>
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
                <option value="Mooc">Mooc</option>
                <option value="Lomba">Lomba</option>
                <option value="Pembelajaran">Pembelajaran</option>
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
              <select name="studio_id" required>
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
        document.getElementById('editDosen').value = dosen_id || '';

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
<
  question> Should I proceed with implementing the Friday prayer time validation
  for both modals ? The validation will prevent booking on Fridays from 11 : 00 - 13: 00 WIB and show an appropriate error message. < /question>

    @include('layout.footer')