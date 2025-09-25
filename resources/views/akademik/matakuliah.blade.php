 <div class="col-12">
      <div class="card recent-sales overflow-auto">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">Daftar Mata Kuliah <span>| Universitas</span></h5>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahMatkul">
              <i class="bi bi-plus-circle"></i> Tambah Mata Kuliah
            </button>
          </div>

          <table class="table table-borderless datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Fakultas</th>
                <th scope="col">Prodi</th>
                <th scope="col">Mata Kuliah</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($mataKuliah as $matkul)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $matkul->fakultas->nama_fakultas }}</td>
                <td>{{ $matkul->prodi->nama_prodi }}</td>
                <td>{{ $matkul->nama_mata_kuliah }}</td>
                <td>
                  <button class="btn btn-sm btn-primary btn-editmatkul"
                    data-id="{{ $matkul->id }}"
                    data-fakultas="{{ $matkul->fakultas_id }}"
                    data-prodi="{{ $matkul->prodi_id }}"
                    data-nama="{{ $matkul->nama_mata_kuliah }}">
                    Edit
                  </button>
                  <button class="btn btn-sm btn-danger btn-hapusmatkul" data-id="{{ $matkul->id }}">
                    Hapus
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal Tambah Mata Kuliah -->
    <div class="modal fade" id="modalTambahMatkul" tabindex="-1" aria-labelledby="modalTambahMatkulLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="formTambahMatkul">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title">Tambah Mata Kuliah</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Fakultas</label>
                <select class="form-select" name="fakultas_id" id="fakultasMatkul" required>
                  <option selected disabled>Pilih Fakultas</option>
                  @foreach($fakultas as $fak)
                  <option value="{{ $fak->id }}">{{ $fak->nama_fakultas }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Program Studi</label>
                <select class="form-select" name="prodi_id" id="prodiMatkul" required>
                  <option selected disabled>Pilih Prodi</option>
                  @foreach($prodis as $prodi)
                  <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" class="form-control" name="nama_mata_kuliah" id="namaMatkul" placeholder="Contoh: Pemrograman Web" required>
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

    <!-- Modal Edit Mata Kuliah -->
    <div class="modal fade" id="modalEditMatkul" tabindex="-1" aria-labelledby="modalEditMatkulLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="formEditMatkul">
            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title">Edit Mata Kuliah</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id" id="editMatkulId">
              <div class="mb-3">
                <label class="form-label">Fakultas</label>
                <select class="form-select" name="fakultas_id" id="editFakultasMatkul" required>
                  <option selected disabled>Pilih Fakultas</option>
                  @foreach($fakultas as $fak)
                  <option value="{{ $fak->id }}">{{ $fak->nama_fakultas }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Program Studi</label>
                <select class="form-select" name="prodi_id" id="editProdiMatkul" required>
                  <option selected disabled>Pilih Prodi</option>
                  @foreach($prodis as $prodi)
                  <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" class="form-control" name="nama_mata_kuliah" id="editNamaMatkul" required>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {

  // Form Tambah Mata Kuliah
  document.getElementById('formTambahMatkul').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    fetch("{{ route('mata-kuliah.store') }}", {
        method: 'POST',
        body: formData,
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          Swal.fire('Berhasil!', data.success, 'success').then(() => { location.reload(); });
        } else {
          Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan data.', 'error');
        }
      })
      .catch(() => Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error'));
  });

  // Form Edit Mata Kuliah
  document.getElementById('formEditMatkul').addEventListener('submit', function(e) {
    e.preventDefault();
    var id = document.getElementById('editMatkulId').value;
    var formData = new FormData(this);

    fetch("/mata-kuliah/" + id, {
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
          Swal.fire('Berhasil!', data.success, 'success').then(() => { location.reload(); });
        } else {
          Swal.fire('Gagal!', 'Terjadi kesalahan saat memperbarui data.', 'error');
        }
      })
      .catch(() => Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error'));
  });

  // Tombol Edit Mata Kuliah
  document.querySelectorAll('.btn-editmatkul').forEach(btn => {
    btn.addEventListener('click', function() {
      document.getElementById('editMatkulId').value = this.getAttribute('data-id');
      document.getElementById('editFakultasMatkul').value = this.getAttribute('data-fakultas');
      document.getElementById('editProdiMatkul').value = this.getAttribute('data-prodi');
      document.getElementById('editNamaMatkul').value = this.getAttribute('data-nama');
      new bootstrap.Modal(document.getElementById('modalEditMatkul')).show();
    });
  });

  // Tombol Hapus Mata Kuliah
  document.querySelectorAll('.btn-hapusmatkul').forEach(btn => {
    btn.addEventListener('click', function() {
      var id = this.getAttribute('data-id');
      Swal.fire({
        title: 'Hapus Mata Kuliah?',
        text: 'Data mata kuliah akan dihapus permanen.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          fetch("/mata-kuliah/" + id, {
              method: 'DELETE',
              headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                Swal.fire('Dihapus!', data.success, 'success').then(() => { location.reload(); });
              } else {
                Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
              }
            })
            .catch(() => Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error'));
        }
      });
    });
  });

});
</script>
