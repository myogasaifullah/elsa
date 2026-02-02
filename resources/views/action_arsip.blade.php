<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="card-title mb-0">Tabel Arsip</h5>

    <!-- Tombol Tambah -->
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addArsipModal">
        <i class="bi bi-plus-circle"></i> Tambah
    </button>
</div>

<!-- Modal Tambah Arsip -->
<div class="modal fade" id="addArsipModal" tabindex="-1" aria-labelledby="addArsipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addArsipModalLabel">Tambah Data Arsip</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('arsip.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Data Dosen -->
                            <div class="mb-3">
                                <label for="dosen_id" class="form-label">Dosen</label>
                                <select class="form-select" id="dosen_id" name="dosen_id">
                                    <option value="">Pilih Dosen</option>
                                    @foreach(\App\Models\Dosen::all() as $dosen)
                                    <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Fakultas -->
                            <div class="mb-3">
                                <label for="fakultas_id" class="form-label">Fakultas</label>
                                <select class="form-select" id="fakultas_id" name="fakultas_id">
                                    <option value="">Pilih Fakultas</option>
                                    @foreach(\App\Models\Fakultas::all() as $fakultas)
                                    <option value="{{ $fakultas->id }}">{{ $fakultas->nama_fakultas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Prodi -->
                            <div class="mb-3">
                                <label for="prodi_id" class="form-label">Prodi</label>
                                <select class="form-select" id="prodi_id" name="prodi_id">
                                    <option value="">Pilih Prodi</option>
                                    @foreach(\App\Models\Prodi::all() as $prodi)
                                    <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Mata Kuliah -->
                            <div class="mb-3">
                                <label for="mata_kuliah_id" class="form-label">Mata Kuliah</label>
                                <select class="form-select" id="mata_kuliah_id" name="mata_kuliah_id">
                                    <option value="">Pilih Mata Kuliah</option>
                                    @foreach(\App\Models\MataKuliah::all() as $mataKuliah)
                                    <option value="{{ $mataKuliah->id }}">{{ $mataKuliah->nama_mata_kuliah }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Judul Course -->
                            <div class="mb-3">
                                <label for="judul_course" class="form-label">Judul Course</label>
                                <input type="text" class="form-control" id="judul_course" name="judul_course">
                            </div>
                            <!-- Data Kategori MOOC -->
                            <div class="mb-3" id="moocField" style="display: none;">
                                <label for="kategori_mooc" class="form-label">Kategori MOOC</label>
                                <select class="form-select" id="kategori_mooc" name="kategori_mooc">
                                    <option value="">Pilih Kategori MOOC</option>
                                    @foreach(\App\Models\Mooc::all() as $mooc)
                                    <option value="{{ $mooc->judul_mooc }}">{{ $mooc->judul_mooc }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Studio -->
                            <div class="mb-3">
                                <label for="studio_id" class="form-label">Studio</label>
                                <select class="form-select" id="studio_id" name="studio_id">
                                    <option value="">Pilih Studio</option>
                                    @foreach(\App\Models\Studio::all() as $studio)
                                    <option value="{{ $studio->id }}">{{ $studio->nama_studio }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Tanggal Shooting -->
                            <div class="mb-3">
                                <label for="tanggal_shooting" class="form-label">Tanggal Shooting</label>
                                <input type="date" class="form-control" id="tanggal_shooting" name="tanggal_shooting">
                            </div>
                            <!-- Data Jam Mulai -->
                            <div class="mb-3">
                                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai">
                            </div>
                            <!-- Data Jam Selesai -->
                            <div class="mb-3">
                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai">
                            </div>
                            <!-- Data Jenis Kategori -->
                            <div class="mb-3">
                                <label for="jenis_kategori" class="form-label">Jenis Kategori</label>
                                <select class="form-select" id="jenis_kategori" name="jenis_kategori">
                                    <option value="">Pilih Jenis Kategori</option>
                                    <option value="Lomba">Lomba</option>
                                    <option value="E-Learning">E-Learning</option>
                                    <option value="MOOC">MOOC</option>
                                    <option value="Marketing">Marketing</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Data Target Upload -->
                            <div class="mb-3">
                                <label for="target_upload" class="form-label">Target Upload</label>
                                <input type="date" class="form-control" id="target_upload" name="target_upload">
                            </div>
                            <!-- Data Persentase -->
                            <div class="mb-3">
                                <label for="persentase" class="form-label">Persentase</label>
                                <input type="number" class="form-control" id="persentase" name="persentase" min="0" max="100" required>
                            </div>
                            <!-- Data Progres -->
                            <div class="mb-3">
                                <label for="progres" class="form-label">Progres</label>
                                <select class="form-select" id="progres" name="progres" required>
                                    <option value="">Pilih Progres</option>
                                    <option value="belum">Belum</option>
                                    <option value="progres">Sedang Progres</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                            <!-- Data Keterangan -->
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <select class="form-select" id="keterangan" name="keterangan" required>
                                    <option value="">Pilih Keterangan</option>
                                    <option value="belum terbit">Belum Terbit</option>
                                    <option value="sudah terbit">Sudah Terbit</option>
                                </select>
                            </div>
                            <!-- Data Durasi -->
                            <div class="mb-3">
                                <label for="durasi" class="form-label">Durasi (Menit)</label>
                                <input type="number" class="form-control" id="durasi" name="durasi" min="0">
                            </div>
                            <!-- Data Tautan Video -->
                            <div class="mb-3">
                                <label for="publish_link_youtube" class="form-label">Tautan Video YouTube</label>
                                <input type="url" class="form-control" id="publish_link_youtube" name="publish_link_youtube">
                            </div>
                            <!-- Data Tgl Upload YouTube -->
                            <div class="mb-3">
                                <label for="tanggal_upload_youtube" class="form-label">Tanggal Upload YouTube</label>
                                <input type="date" class="form-control" id="tanggal_upload_youtube" name="tanggal_upload_youtube">
                            </div>
                            <!-- Data Editor -->
                            <div class="mb-3">
                                <label for="editor_id" class="form-label">Editor</label>
                                <select class="form-select" id="editor_id" name="editor_id" required>
                                    <option value="">Pilih Editor</option>
                                    @foreach(\App\Models\Editor::all() as $editor)
                                    <option value="{{ $editor->id }}">{{ $editor->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jenisKategoriSelect = document.getElementById('jenis_kategori');
        const moocField = document.getElementById('moocField');

        jenisKategoriSelect.addEventListener('change', function() {
            if (this.value === 'MOOC') {
                moocField.style.display = 'block';
            } else {
                moocField.style.display = 'none';
            }
        });
    });
</script>

<!-- Modal Edit Arsip -->
<div class="modal fade" id="editArsipModal" tabindex="-1" aria-labelledby="editArsipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editArsipModalLabel">Edit Data Arsip</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editArsipForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Data Dosen -->
                            <div class="mb-3">
                                <label for="edit_dosen_id" class="form-label">Dosen</label>
                                <select class="form-select" id="edit_dosen_id" name="dosen_id">
                                    <option value="">Pilih Dosen</option>
                                    @foreach(\App\Models\Dosen::all() as $dosen)
                                    <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Fakultas -->
                            <div class="mb-3">
                                <label for="edit_fakultas_id" class="form-label">Fakultas</label>
                                <select class="form-select" id="edit_fakultas_id" name="fakultas_id">
                                    <option value="">Pilih Fakultas</option>
                                    @foreach(\App\Models\Fakultas::all() as $fakultas)
                                    <option value="{{ $fakultas->id }}">{{ $fakultas->nama_fakultas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Prodi -->
                            <div class="mb-3">
                                <label for="edit_prodi_id" class="form-label">Prodi</label>
                                <select class="form-select" id="edit_prodi_id" name="prodi_id">
                                    <option value="">Pilih Prodi</option>
                                    @foreach(\App\Models\Prodi::all() as $prodi)
                                    <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Mata Kuliah -->
                            <div class="mb-3">
                                <label for="edit_mata_kuliah_id" class="form-label">Mata Kuliah</label>
                                <select class="form-select" id="edit_mata_kuliah_id" name="mata_kuliah_id">
                                    <option value="">Pilih Mata Kuliah</option>
                                    @foreach(\App\Models\MataKuliah::all() as $mataKuliah)
                                    <option value="{{ $mataKuliah->id }}">{{ $mataKuliah->nama_mata_kuliah }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Judul Course -->
                            <div class="mb-3">
                                <label for="edit_judul_course" class="form-label">Judul Course</label>
                                <input type="text" class="form-control" id="edit_judul_course" name="judul_course">
                            </div>
                            <!-- Data Kategori MOOC -->
                            <div class="mb-3" id="editMoocField" style="display: none;">
                                <label for="edit_kategori_mooc" class="form-label">Kategori MOOC</label>
                                <select class="form-select" id="edit_kategori_mooc" name="kategori_mooc">
                                    <option value="">Pilih Kategori MOOC</option>
                                    @foreach(\App\Models\Mooc::all() as $mooc)
                                    <option value="{{ $mooc->judul_mooc }}">{{ $mooc->judul_mooc }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Studio -->
                            <div class="mb-3">
                                <label for="edit_studio_id" class="form-label">Studio</label>
                                <select class="form-select" id="edit_studio_id" name="studio_id">
                                    <option value="">Pilih Studio</option>
                                    @foreach(\App\Models\Studio::all() as $studio)
                                    <option value="{{ $studio->id }}">{{ $studio->nama_studio }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Data Tanggal Shooting -->
                            <div class="mb-3">
                                <label for="edit_tanggal_shooting" class="form-label">Tanggal Shooting</label>
                                <input type="date" class="form-control" id="edit_tanggal_shooting" name="tanggal_shooting">
                            </div>
                            <!-- Data Jam Mulai -->
                            <div class="mb-3">
                                <label for="edit_jam_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control" id="edit_jam_mulai" name="jam_mulai">
                            </div>
                            <!-- Data Jam Selesai -->
                            <div class="mb-3">
                                <label for="edit_jam_selesai" class="form-label">Jam Selesai</label>
                                <input type="time" class="form-control" id="edit_jam_selesai" name="jam_selesai">
                            </div>
                            <!-- Data Jenis Kategori -->
                            <div class="mb-3">
                                <label for="edit_jenis_kategori" class="form-label">Jenis Kategori</label>
                                <select class="form-select" id="edit_jenis_kategori" name="jenis_kategori">
                                    <option value="">Pilih Jenis Kategori</option>
                                    <option value="Lomba">Lomba</option>
                                    <option value="E-Learning">E-Learning</option>
                                    <option value="MOOC">MOOC</option>
                                    <option value="Marketing">Marketing</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Data Target Upload -->
                            <div class="mb-3">
                                <label for="edit_target_upload" class="form-label">Target Upload</label>
                                <input type="date" class="form-control" id="edit_target_upload" name="target_upload">
                            </div>
                            <!-- Data Persentase -->
                            <div class="mb-3">
                                <label for="edit_persentase" class="form-label">Persentase</label>
                                <input type="number" class="form-control" id="edit_persentase" name="persentase" min="0" max="100" required>
                            </div>
                            <!-- Data Progres -->
                            <div class="mb-3">
                                <label for="edit_progres" class="form-label">Progres</label>
                                <select class="form-select" id="edit_progres" name="progres" required>
                                    <option value="">Pilih Progres</option>
                                    <option value="belum">Belum</option>
                                    <option value="progres">Sedang Progres</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                            <!-- Data Keterangan -->
                            <div class="mb-3">
                                <label for="edit_keterangan" class="form-label">Keterangan</label>
                                <select class="form-select" id="edit_keterangan" name="keterangan" required>
                                    <option value="">Pilih Keterangan</option>
                                    <option value="belum terbit">Belum Terbit</option>
                                    <option value="sudah terbit">Sudah Terbit</option>
                                </select>
                            </div>
                            <!-- Data Durasi -->
                            <div class="mb-3">
                                <label for="edit_durasi" class="form-label">Durasi (Menit)</label>
                                <input type="number" class="form-control" id="edit_durasi" name="durasi" min="0">
                            </div>
                            <!-- Data Tautan Video -->
                            <div class="mb-3">
                                <label for="edit_publish_link_youtube" class="form-label">Tautan Video YouTube</label>
                                <input type="url" class="form-control" id="edit_publish_link_youtube" name="publish_link_youtube">
                            </div>
                            <!-- Data Tgl Upload YouTube -->
                            <div class="mb-3">
                                <label for="edit_tanggal_upload_youtube" class="form-label">Tanggal Upload YouTube</label>
                                <input type="date" class="form-control" id="edit_tanggal_upload_youtube" name="tanggal_upload_youtube">
                            </div>
                            <!-- Data Editor -->
                            <div class="mb-3">
                                <label for="edit_editor_id" class="form-label">Editor</label>
                                <select class="form-select" id="edit_editor_id" name="editor_id" required>
                                    <option value="">Pilih Editor</option>
                                    @foreach(\App\Models\Editor::all() as $editor)
                                    <option value="{{ $editor->id }}">{{ $editor->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
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
        const editJenisKategoriSelect = document.getElementById('edit_jenis_kategori');
        const editMoocField = document.getElementById('editMoocField');

        editJenisKategoriSelect.addEventListener('change', function() {
            if (this.value === 'MOOC') {
                editMoocField.style.display = 'block';
            } else {
                editMoocField.style.display = 'none';
            }
        });
    });
</script>