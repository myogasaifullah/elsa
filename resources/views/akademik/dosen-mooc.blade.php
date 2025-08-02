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
          <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahDosen">
            <i class="bi bi-plus-circle"></i> Tambah Dosen
          </button>
        </div>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Dosen</th>
              <th>NUPTK</th>
              <th>Target Video</th>
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
              <td>{{ $dosen->fakultas->nama_fakultas }}</td>
              <td>{{ $dosen->prodi->nama_prodi }}</td>
              <td>
                <button class="btn btn-sm btn-primary btn-edit-dosen" 
                        data-id="{{ $dosen->id }}"
                        data-nama="{{ $dosen->nama_dosen }}"
                        data-nuptk="{{ $dosen->nuptk_dosen }}"
                        data-target="{{ $dosen->target_video_dosen }}"
                        data-fakultas="{{ $dosen->fakultas_id }}"
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


  <div class="col-12">
    <div class="card recent-sales overflow-auto">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="card-title mb-0">Daftar MOOC <span>| Universitas</span></h5>
          <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahMooc">
            <i class="bi bi-plus-circle"></i> Tambah MOOC
          </button>
        </div>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>Judul MOOC</th>
              <th>Nama Dosen</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($moocs as $mooc)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $mooc->judul_mooc }}</td>
              <td>{{ $mooc->dosen->nama_dosen }}</td>
              <td>
                <button class="btn btn-sm btn-primary btn-edit-mooc" 
                        data-id="{{ $mooc->id }}"
                        data-judul="{{ $mooc->judul_mooc }}"
                        data-dosen="{{ $mooc->dosen_id }}">
                  Edit
                </button>
                <button class="btn btn-sm btn-danger btn-hapus-mooc" data-id="{{ $mooc->id }}">Hapus</button>
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
              <label for="fakultas_id" class="form-label">Fakultas</label>
              <select class="form-select" id="fakultas_id" name="fakultas_id" required>
                <option selected disabled>Pilih Fakultas</option>
                @foreach($fakultas as $f)
                  <option value="{{ $f->id }}">{{ $f->nama_fakultas }}</option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="prodi_id" class="form-label">Prodi</label>
              <select class="form-select" id="prodi_id" name="prodi_id" required>
                <option selected disabled>Pilih Prodi</option>
                @foreach($prodis as $p)
                  <option value="{{ $p->id }}">{{ $p->nama_prodi }}</option>
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


  <!-- Modal Tambah MOOC -->
  <div class="modal fade" id="modalTambahMooc" tabindex="-1" aria-labelledby="modalTambahMoocLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="formTambahMooc">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Tambah MOOC</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="text" class="form-control mb-2" placeholder="Judul MOOC" name="judul_mooc" required>

            <select class="form-select" name="dosen_id" required>
              <option selected disabled>Pilih Dosen</option>
              @foreach($dosens as $d)
                <option value="{{ $d->id }}">{{ $d->nama_dosen }}</option>
              @endforeach
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
          <input type="text" class="form-control mb-2" id="editNamaDosen" placeholder="Nama Dosen" name="nama_dosen" required>

          <input type="text" class="form-control mb-2" id="editNuptkDosen" placeholder="NUPTK Dosen" name="nuptk_dosen" required>

          <input type="number" class="form-control mb-2" id="editTargetVideoDosen" placeholder="Target Video Dosen" name="target_video_dosen" required>

          <select class="form-select mb-2" id="editFakultasId" name="fakultas_id" required>
            <option selected disabled>Pilih Fakultas</option>
            @foreach($fakultas as $f)
              <option value="{{ $f->id }}">{{ $f->nama_fakultas }}</option>
            @endforeach
          </select>
          <select class="form-select" id="editProdiId" name="prodi_id" required>
            <option selected disabled>Pilih Prodi</option>
            @foreach($prodis as $p)
              <option value="{{ $p->id }}">{{ $p->nama_prodi }}</option>
            @endforeach
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

<!-- Modal Edit MOOC -->
<div class="modal fade" id="modalEditMooc" tabindex="-1" aria-labelledby="modalEditMoocLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formEditMooc">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit MOOC</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editMoocId" name="id">
          <input type="text" class="form-control mb-2" id="editJudulMooc" placeholder="Judul MOOC" name="judul_mooc" required>
          <select class="form-select" id="editDosenMoocId" name="dosen_id" required>
            <option selected disabled>Pilih Dosen</option>
            @foreach($dosens as $d)
              <option value="{{ $d->id }}">{{ $d->nama_dosen }}</option>
            @endforeach
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
  document.addEventListener('DOMContentLoaded', function () {
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
        if(data.success) {
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
        if(data.success) {
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
      btn.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        const nama = this.getAttribute('data-nama');
        const nuptk = this.getAttribute('data-nuptk');
        const target = this.getAttribute('data-target');
        const fakultas = this.getAttribute('data-fakultas');
        const prodi = this.getAttribute('data-prodi');

        document.getElementById('editDosenId').value = id;
        document.getElementById('editNamaDosen').value = nama;
        document.getElementById('editNuptkDosen').value = nuptk;
        document.getElementById('editTargetVideoDosen').value = target;
        document.getElementById('editFakultasId').value = fakultas;
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
        if(data.success) {
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
      btn.addEventListener('click', function () {
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
        if(data.success) {
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
              if(data.success) {
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
              if(data.success) {
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
