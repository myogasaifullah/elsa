<!-- Modal Tambah Prodi -->
<div class="modal fade" id="modalTambahProdi" tabindex="-1" aria-labelledby="modalTambahProdiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('prodi.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Program Studi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_prodi" class="form-label">Nama Prodi</label>
                        <input type="text" class="form-control" name="nama_prodi" required>
                    </div>

                    <div class="mb-3">
                        <label for="fakultas_id" class="form-label">Fakultas</label>
                        <select class="form-control" name="fakultas_id" required>
                            @foreach($fakultas as $f)
                                <option value="{{ $f->id }}">{{ $f->nama_fakultas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="singkatan_prodi" class="form-label">Singkatan</label>
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

<!-- Modal Edit Prodi -->
<div class="modal fade" id="modalEditProdi" tabindex="-1" aria-labelledby="modalEditProdiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="formEditProdi">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Program Studi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nama_prodi" class="form-label">Nama Prodi</label>
                        <input type="text" class="form-control" name="nama_prodi" id="edit_nama_prodi" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_singkatan_prodi" class="form-label">Singkatan</label>
                        <input type="text" class="form-control" name="singkatan" id="edit_singkatan_prodi">
                    </div>

                    <div class="mb-3">
                        <label for="edit_id_fakultas" class="form-label">Fakultas</label>
                        <select class="form-control" name="fakultas_id" id="edit_id_fakultas" required>
                            @foreach($fakultas as $f)
                                <option value="{{ $f->id }}">{{ $f->nama_fakultas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-edit-prodi').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                const singkatan = this.dataset.singkatan;
                const idFakultas = this.dataset.fakultas;
                

                document.getElementById('edit_nama_prodi').value = nama;
                document.getElementById('edit_singkatan_prodi').value = singkatan;
                document.getElementById('edit_id_fakultas').value = idFakultas;
                document.getElementById('formEditProdi').action = `/prodi/${id}`;

                new bootstrap.Modal(document.getElementById('modalEditProdi')).show();
            });
        });
    });
</script>
