@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Verifikasi Pengguna</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
        <li class="breadcrumb-item">User</li>
        <li class="breadcrumb-item active">Verifikasi Pengguna</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="col-12">
    <div class="card recent-sales overflow-auto">
      <div class="card-body">
        <h5 class="card-title">Daftar Pengguna Pending <span>| Status: Pending</span></h5>
        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Username</th>
              <th scope="col">Email</th>
              <th scope="col">Fakultas</th>
              <th scope="col">Prodi</th>
              <th scope="col">No Telp</th>
              <th scope="col">Role</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pendingUsers as $user)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->fakultas ? $user->fakultas->nama_fakultas : '-' }}</td>
              <td>{{ $user->prodi ? $user->prodi->nama_prodi : '-' }}</td>
              <td>{{ $user->nomor_telepon ?? '-' }}</td>
              <td>{{ $user->role ?? '-' }}</td>
              <td><span class="badge bg-warning text-dark">Pending</span></td>
              <td>
                <form action="{{ route('user.updateStatus', $user->id) }}" method="POST" style="display: inline;">
  @csrf
  @method('PUT')
  <input type="hidden" name="status" value="active">
  <button type="submit" class="btn btn-sm btn-success btn-verifikasi">Verifikasi</button>
</form>

<form action="{{ route('user.updateStatus', $user->id) }}" method="POST" style="display: inline;">
  @csrf
  @method('PUT')
  <input type="hidden" name="status" value="rejected">
  <button type="submit" class="btn btn-sm btn-danger btn-tolak">Tolak</button>
</form>

                <!-- Debugging CSRF token -->
                <div style="display: none;">
                  CSRF Token: {{ csrf_token() }}
                </div>
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
<h2>Jumlah Editor: {{ isset($editors) ? $editors->count() : 0 }}</h2>
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahEditor">
                        <i class="bi bi-plus-circle"></i> Tambah MOOC
                    </button>
                </div>

                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Editor</th>
                            <th>Akun</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
    @foreach($editors as $index => $editor)
    <tr data-id="{{ $editor->id }}">
        <td>{{ $index + 1 }}</td>
        <td class="nama-editor">{{ $editor->nama }}</td>
        <td class="email-editor">{{ $editor->email }}</td>
        <td>
            <button class="btn btn-sm btn-primary btn-edit-editor" data-id="{{ $editor->id }}">Edit</button>
            <button class="btn btn-sm btn-danger btn-hapus-editor" data-id="{{ $editor->id }}">Hapus</button>
        </td>
    </tr>
    @endforeach
</tbody>

                </table>


            </div>
        </div>
    </div>

    <!-- Modal Edit Editor -->
    <div class="modal fade" id="modalEditEditor" tabindex="-1" aria-labelledby="modalEditEditorLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEditEditor">
                   @csrf
    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Editor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editIdEditor">
    <input type="text" class="form-control mb-2" name="nama" id="editNamaEditor" required placeholder="Nama Editor">
    <input type="email" class="form-control mb-2" name="email" id="editEmailEditor" required placeholder="Email Editor">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Tambah Editor -->
    <div class="modal fade" id="modalTambahEditor" tabindex="-1" aria-labelledby="modalTambahEditorLabel">
        <div class="modal-dialog">
            <div class="modal-content">
<form id="formTambahEditor" method="POST" action="{{ route('editor.store') }}">
    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Editor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
        <input type="text" class="form-control mb-2" placeholder="Nama Editor" name="nama" required>
        <input type="email" class="form-control mb-2" placeholder="Email Editor" name="email" required>
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
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-verifikasi').forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        const form = this.closest('form');
        console.log('Verifikasi button clicked', form);
        Swal.fire({
          title: 'Verifikasi Pengguna?',
          text: 'Pengguna akan diubah menjadi aktif.',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Ya, Verifikasi',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            console.log('Form submitted', form);
            console.log('Form action', form.action);
            console.log('Form method', form.method);
            const formData = new FormData(form);
            for (let [key, value] of formData.entries()) {
              console.log(key, value);
            }
            form.submit();
          }
        });
      });
    });

    document.querySelectorAll('.btn-tolak').forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        const form = this.closest('form');
        console.log('Tolak button clicked', form);
        Swal.fire({
          title: 'Tolak Pengguna?',
          text: 'Pengguna akan ditolak dan tidak bisa login.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, Tolak',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            console.log('Form submitted', form);
            console.log('Form action', form.action);
            console.log('Form method', form.method);
            const formData = new FormData(form);
            for (let [key, value] of formData.entries()) {
              console.log(key, value);
            }
            form.submit();
          }
        });
      });
    });
  });
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    // Edit
    document.querySelectorAll('.btn-edit-editor').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const id = this.dataset.id;
            const nama = row.querySelector('.nama-editor').textContent.trim();
            const email = row.querySelector('.email-editor').textContent.trim();

            document.getElementById('editIdEditor').value = id;
            document.getElementById('editNamaEditor').value = nama;
            document.getElementById('editEmailEditor').value = email;

            new bootstrap.Modal(document.getElementById('modalEditEditor')).show();
        });
    });

    // Simpan Edit
    document.getElementById('formEditEditor').addEventListener('submit', function (e) {
        e.preventDefault();

        const id = document.getElementById('editIdEditor').value;
        const nama = document.getElementById('editNamaEditor').value;
        const email = document.getElementById('editEmailEditor').value;

        fetch(`/editor/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ nama, email })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const row = document.querySelector(`tr[data-id="${id}"]`);
                row.querySelector('.nama-editor').textContent = nama;
                row.querySelector('.email-editor').textContent = email;

                bootstrap.Modal.getInstance(document.getElementById('modalEditEditor')).hide();
                Swal.fire('Tersimpan!', 'Editor berhasil diperbarui.', 'success');
            }
        });
    });

    // Hapus
    document.querySelectorAll('.btn-hapus-editor').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const row = this.closest('tr');
            const nama = row.querySelector('.nama-editor').textContent.trim();

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: `Editor "${nama}" akan dihapus!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/editor/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            row.remove();
                            Swal.fire('Dihapus!', 'Editor berhasil dihapus.', 'success');
                        }
                    });
                }
            });
        });
    });
});
</script>



@include('layout.footer')