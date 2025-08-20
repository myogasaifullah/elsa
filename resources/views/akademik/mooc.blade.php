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
