@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Data Dosen & MOOC </h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Akademik</li>
        <li class="breadcrumb-item active">Dosen-MOOC</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="col-12">
    <div class="card recent-sales overflow-auto">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Daftar Dosen <span>| Universitas</span></h5>
          <div>
            <button class="btn btn-sm btn-success me-2" data-bs-toggle="modal" data-bs-target="#modalTambahDosen">
              <i class="bi bi-plus-circle"></i> Tambah Dosen
            </button>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalImportDosen">
              <i class="bi bi-upload"></i> Import Dosen
            </button>
          </div>
        </div>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Dosen</th>
              <th>NUPTK</th>
              <th>Target Video</th>
              <th>Status</th>
              <th>Fakultas</th>
              <th>Prodi</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($dosens as $dosen)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $dosen->nama_dosen }}</td>
              <td>{{ $dosen->nuptk_dosen }}</td>
              <td>{{ $dosen->target_video_dosen }}</td>
              <td>
                <span class="badge {{ $dosen->status_dosen == 'tetap' ? 'bg-success' : 'bg-warning' }}">
                  {{ ucfirst($dosen->status_dosen) }}
                </span>
              </td>
              <td>{{ $dosen->fakultas->nama_fakultas }}</td>
              <td>{{ $dosen->prodi->nama_prodi }}</td>
              <td>
                <button class="btn btn-sm btn-primary btn-edit-dosen"
                  data-id="{{ $dosen->id }}"
                  data-nama="{{ $dosen->nama_dosen }}"
                  data-nuptk="{{ $dosen->nuptk_dosen }}"
                  data-target="{{ $dosen->target_video_dosen }}"
                  data-status="{{ $dosen->status_dosen }}"
                  data-fakultas="{{ $dosen->fakultas_id }}"
                  data-fakultas-name="{{ $dosen->fakultas->nama_fakultas }}"
                  data-prodi="{{ $dosen->prodi_id }}">
                  Edit
                </button>
                <button class="btn btn-sm btn-danger btn-hapus-dosen" data-id="{{ $dosen->id }}">Hapus</button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>


  <!-- Modal Tambah Dosen -->
  <div class="modal fade" id="modalTambahDosen" tabindex="-1" aria-labelledby="modalTambahDosenLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="formTambahDosen">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Tambah Dosen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="nama_dosen" class="form-label">Nama Dosen</label>
              <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" required>
            </div>

            <div class="mb-3">
              <label for="nuptk_dosen" class="form-label">NUPTK Dosen</label>
              <input type="text" class="form-control" id="nuptk_dosen" name="nuptk_dosen" required>
            </div>

            <div class="mb-3">
              <label for="target_video_dosen" class="form-label">Target Video Dosen</label>
              <input type="number" class="form-control" id="target_video_dosen" name="target_video_dosen" required>
            </div>

            <div class="mb-3">
              <label for="status_dosen" class="form-label">Status Dosen</label>
              <select class="form-select" id="status_dosen" name="status_dosen" required>
                <option selected disabled>Pilih Status</option>
                <option value="tetap">Tetap</option>
                <option value="tidak_tetap">Tidak Tetap</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="fakultas_id" class="form-label">Fakultas</label>
              <input type="text" class="form-control" id="fakultas_id_display" readonly>
              <input type="hidden" id="fakultas_id" name="fakultas_id">
            </div>

            <div class="mb-3">
              <label for="prodi_id" class="form-label">Prodi</label>
              <select class="form-select" id="prodi_id" name="prodi_id" required>
                <option selected disabled>Pilih Prodi</option>
                @foreach($prodis as $p)
                <option value="{{ $p->id }}" data-fakultas-id="{{ $p->fakultas_id }}" data-fakultas-name="{{ $p->fakultas->nama_fakultas }}">{{ $p->nama_prodi }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" type="submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- Modal Import Dosen -->
  <div class="modal fade" id="modalImportDosen" tabindex="-1" aria-labelledby="modalImportDosenLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="formImportDosen" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Import Dosen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="file_import" class="form-label">Pilih File Excel (.xlsx atau .xls)</label>
              <input type="file" class="form-control" id="file_import" name="file" accept=".xlsx,.xls" required>
              <small class="form-text text-muted">File harus berisi kolom: nama_dosen, nuptk_dosen, target_video_dosen (opsional), status_dosen (opsional), fakultas_id, prodi_id</small>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" type="submit">Import</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit Dosen -->
  <div class="modal fade" id="modalEditDosen" tabindex="-1" aria-labelledby="modalEditDosenLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="formEditDosen">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title">Edit Dosen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="editDosenId" name="id">

            <div class="mb-3">
              <label for="editNamaDosen" class="form-label">Nama Dosen</label>
              <input type="text" class="form-control" id="editNamaDosen" name="nama_dosen" required>
            </div>

            <div class="mb-3">
              <label for="editNuptkDosen" class="form-label">NUPTK Dosen</label>
              <input type="text" class="form-control" id="editNuptkDosen" name="nuptk_dosen" required>
            </div>

            <div class="mb-3">
              <label for="editTargetVideoDosen" class="form-label">Target Video Dosen</label>
              <input type="number" class="form-control" id="editTargetVideoDosen" name="target_video_dosen" required>
            </div>

            <div class="mb-3">
              <label for="editStatusDosen" class="form-label">Status Dosen</label>
              <select class="form-select" id="editStatusDosen" name="status_dosen" required>
                <option selected disabled>Pilih Status</option>
                <option value="tetap">Tetap</option>
                <option value="tidak_tetap">Tidak Tetap</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="editFakultasId" class="form-label">Fakultas</label>
              <input type="text" class="form-control" id="editFakultasIdDisplay" readonly>
              <input type="hidden" id="editFakultasId" name="fakultas_id">
            </div>

            <div class="mb-3">
              <label for="editProdiId" class="form-label">Prodi</label>
              <select class="form-select" id="editProdiId" name="prodi_id" required>
                <option selected disabled>Pilih Prodi</option>
                @foreach($prodis as $p)
                <option value="{{ $p->id }}" data-fakultas-id="{{ $p->fakultas_id }}" data-fakultas-name="{{ $p->fakultas->nama_fakultas }}">{{ $p->nama_prodi }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" type="submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @include('akademik.mooc')

</main><!-- End #main -->

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Auto-fill fakultas when prodi is selected for add dosen
    document.getElementById('prodi_id').addEventListener('change', function() {
      const selectedOption = this.options[this.selectedIndex];
      const fakultasId = selectedOption.getAttribute('data-fakultas-id');
      const fakultasName = selectedOption.getAttribute('data-fakultas-name');
      document.getElementById('fakultas_id').value = fakultasId;
      document.getElementById('fakultas_id_display').value = fakultasName;
    });

    // Auto-fill fakultas when prodi is selected for edit dosen
    document.getElementById('editProdiId').addEventListener('change', function() {
      const selectedOption = this.options[this.selectedIndex];
      const fakultasId = selectedOption.getAttribute('data-fakultas-id');
      const fakultasName = selectedOption.getAttribute('data-fakultas-name');
      document.getElementById('editFakultasId').value = fakultasId;
      document.getElementById('editFakultasIdDisplay').value = fakultasName;
    });

    // Submit form tambah dosen
    document.getElementById('formTambahDosen').addEventListener('submit', function(e) {
      e.preventDefault();
      var formData = new FormData(this);

      fetch("{{ route('dosen.store') }}", {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            location.reload();
          } else {
            alert('Terjadi kesalahan: ' + JSON.stringify(data));
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Terjadi kesalahan saat menyimpan data.');
        });
    });

    // Submit form tambah mooc
    document.getElementById('formTambahMooc').addEventListener('submit', function(e) {
      e.preventDefault();
      var formData = new FormData(this);

      fetch("{{ route('mooc.store') }}", {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            location.reload();
          } else {
            alert('Terjadi kesalahan: ' + JSON.stringify(data));
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Terjadi kesalahan saat menyimpan data.');
        });
    });

    // Edit Dosen
    document.querySelectorAll('.btn-edit-dosen').forEach(btn => {
      btn.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const nama = this.getAttribute('data-nama');
        const nuptk = this.getAttribute('data-nuptk');
        const target = this.getAttribute('data-target');
        const status = this.getAttribute('data-status');
        const fakultas = this.getAttribute('data-fakultas');
        const fakultasName = this.getAttribute('data-fakultas-name');
        const prodi = this.getAttribute('data-prodi');

        document.getElementById('editDosenId').value = id;
        document.getElementById('editNamaDosen').value = nama;
        document.getElementById('editNuptkDosen').value = nuptk;
        document.getElementById('editTargetVideoDosen').value = target;
        document.getElementById('editStatusDosen').value = status;
        document.getElementById('editFakultasId').value = fakultas;
        document.getElementById('editFakultasIdDisplay').value = fakultasName;
        document.getElementById('editProdiId').value = prodi;

        new bootstrap.Modal(document.getElementById('modalEditDosen')).show();
      });
    });

    // Submit form edit dosen
    document.getElementById('formEditDosen').addEventListener('submit', function(e) {
      e.preventDefault();
      var id = document.getElementById('editDosenId').value;
      var formData = new FormData(this);

      fetch(`/dosen/${id}`, {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-HTTP-Method-Override': 'PUT'
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            location.reload();
          } else {
            alert('Terjadi kesalahan: ' + JSON.stringify(data));
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Terjadi kesalahan saat menyimpan data.');
        });
    });

    // Edit MOOC
    document.querySelectorAll('.btn-edit-mooc').forEach(btn => {
      btn.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const judul = this.getAttribute('data-judul');
        const dosen = this.getAttribute('data-dosen');

        document.getElementById('editMoocId').value = id;
        document.getElementById('editJudulMooc').value = judul;
        document.getElementById('editDosenMoocId').value = dosen;

        new bootstrap.Modal(document.getElementById('modalEditMooc')).show();
      });
    });

    // Submit form edit mooc
    document.getElementById('formEditMooc').addEventListener('submit', function(e) {
      e.preventDefault();
      var id = document.getElementById('editMoocId').value;
      var formData = new FormData(this);

      fetch(`/mooc/${id}`, {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-HTTP-Method-Override': 'PUT'
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            location.reload();
          } else {
            alert('Terjadi kesalahan: ' + JSON.stringify(data));
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Terjadi kesalahan saat menyimpan data.');
        });
    });

    // Submit form import dosen
    document.getElementById('formImportDosen').addEventListener('submit', function(e) {
      e.preventDefault();
      var formData = new FormData(this);

      fetch("{{ route('dosen.import') }}", {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            location.reload();
          } else {
            alert('Terjadi kesalahan: ' + JSON.stringify(data.error || 'Terjadi kesalahan saat mengimpor data.'));
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Terjadi kesalahan saat mengimpor data.');
        });
    });

    // Hapus Dosen
    document.querySelectorAll('.btn-hapus-dosen').forEach(button => {
      button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        Swal.fire({
          title: 'Hapus Dosen?',
          text: 'Data dosen akan dihapus dari sistem.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            fetch(`/dosen/${id}`, {
                method: 'DELETE',
                headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
              })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  location.reload();
                } else {
                  alert('Terjadi kesalahan: ' + JSON.stringify(data));
                }
              })
              .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus data.');
              });
          }
        });
      });
    });

    // Hapus MOOC
    document.querySelectorAll('.btn-hapus-mooc').forEach(button => {
      button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        Swal.fire({
          title: 'Hapus MOOC?',
          text: 'Data MOOC akan dihapus dari sistem.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            fetch(`/mooc/${id}`, {
                method: 'DELETE',
                headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
              })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  location.reload();
                } else {
                  alert('Terjadi kesalahan: ' + JSON.stringify(data));
                }
              })
              .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus data.');
              });
          }
        });
      });
    });
  });
</script>


@include('layout.footer')