<!-- Modal Tambah Fakultas -->
<div class="modal fade" id="modalTambahFakultas" tabindex="-1" aria-labelledby="modalTambahFakultasLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('fakultas.store') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahFakultasLabel">Tambah Fakultas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama_fakultas" class="form-label">Nama Fakultas</label>
            <input type="text" class="form-control" name="nama_fakultas" required>
          </div>
          <div class="mb-3">
            <label for="singkatan" class="form-label">Singkatan</label>
            <input type="text" class="form-control" name="singkatan">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit Fakultas -->
<div class="modal fade" id="modalEditFakultas" tabindex="-1" aria-labelledby="modalEditFakultasLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="formEditFakultas">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditFakultasLabel">Edit Fakultas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="edit_nama_fakultas" class="form-label">Nama Fakultas</label>
            <input type="text" class="form-control" name="nama_fakultas" id="edit_nama_fakultas" required>
          </div>
          <div class="mb-3">
            <label for="edit_singkatan" class="form-label">Singkatan</label>
            <input type="text" class="form-control" name="singkatan" id="edit_singkatan">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Perbarui</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-edit').forEach(button => {
      button.addEventListener('click', function () {
        const id = this.dataset.id;
        const nama = this.dataset.nama;
        const singkatan = this.dataset.singkatan;

        document.getElementById('edit_nama_fakultas').value = nama;
        document.getElementById('edit_singkatan').value = singkatan;
        document.getElementById('formEditFakultas').action = `/fakultas/${id}`;

        new bootstrap.Modal(document.getElementById('modalEditFakultas')).show();
      });
    });
  });
</script>