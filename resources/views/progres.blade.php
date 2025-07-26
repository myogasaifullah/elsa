@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Progres</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Progres</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tabel Progres Produksi MOOC</h5>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Dosen</th>
                                        <th>Fakultas</th>
                                        <th>Mata Kuliah</th>
                                        <th>Kategori MOOC</th>
                                        <th>Judul Course</th>
                                        <th>Studio</th>
                                        <th>Tanggal Shooting</th>
                                        <th>Waktu</th>
                                        <th>Jenis Kategori</th>
                                        <th>Target Upload</th>
                                        <th>Persentase</th> <!-- Ganti dari 'Progres' menjadi 'Persentase' -->
                                        <th>Progres</th> <!-- Field Progres -->
                                        <th>Keterangan</th> <!-- Field Keterangan -->
                                        <th>Durasi (Menit)</th>
                                        <th>Tautan Video</th>
                                        <th>Tgl Upload YouTube</th>
                                        <th>Editor</th>
                                        <th>Status</th> <!-- Status -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Dr. Andi Maulana</td>
                                        <td>Teknik dan Ilmu Komputer</td>
                                        <td>Rekayasa Perangkat Lunak</td>
                                        <td>MOOC Mandiri</td>
                                        <td>Pemrograman Web Lanjut</td>
                                        <td>Studio 1</td>
                                        <td>2025-07-18</td>
                                        <td>08:00 - 10:00</td>
                                        <td>Video Teaching</td>
                                        <td>2025-07-30</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" style="width: 70%;">70%</div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="progress-text">Progres</span> <!-- Menampilkan Progres -->
                                        </td>
                                        <td>
                                            <span class="keterangan-text">Belum Terbit</span> <!-- Keterangan -->
                                        </td>
                                        <td>45</td>
                                        <td><a href="https://youtu.be/xxxxxxx" target="_blank">Lihat Video</a></td>
                                        <td>2025-07-19</td>
                                        <td class="text-center">
                                            <button class="btn btn-warning btn-edit-editor" data-name="Rizky Putra">Edit</button>
                                        </td>
                                        <td class="text-center status-col">
                                            <span class="badge bg-success text-white">Sudah Shooting</span> <!-- Status awal -->
                                        </td>
                                        <td class="text-center action-col" style="display: none;">
                                            <a href="{{ url('modal-progres') }}"> <button class="btn btn-primary btn-progres">Progres</button></a>
                                        </td>
                                    </tr>
                                    <!-- Tambahkan baris lainnya sesuai data -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-edit-editor').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                const name = this.getAttribute('data-name');
                const button = this;
                const actionTd = this.closest('tr').querySelector('.action-col');
                const statusTd = this.closest('tr').querySelector('.status-col');
                const progressText = this.closest('tr').querySelector('.progress-text');
                const keteranganText = this.closest('tr').querySelector('.keterangan-text');

                Swal.fire({
                    title: 'Edit Editor?',
                    text: 'Apakah Anda ingin Mengedit ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Ubah',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Ganti tombol menjadi nama editor
                        button.outerHTML = `<span>${name}</span>`;

                        // Update status menjadi "Proses Edit"
                        statusTd.innerHTML = `<span class="badge bg-warning text-dark">Proses Edit</span>`;

                        // Tampilkan tombol Action
                        if (actionTd) {
                            actionTd.style.display = 'table-cell';
                        }

                        // Update text progres sesuai dengan persentase
                        let persentase = parseInt(this.closest('tr').querySelector('.progress-bar').style.width);
                        if (persentase === 0) {
                            progressText.innerHTML = "Belum";
                        } else if (persentase === 100) {
                            progressText.innerHTML = "Selesai";
                        } else {
                            progressText.innerHTML = "Progres";
                        }

                        // Update keterangan sesuai dengan persentase
                        if (persentase === 100) {
                            keteranganText.innerHTML = "Sudah Terbit";
                        } else {
                            keteranganText.innerHTML = "Belum Terbit";
                        }

                        Swal.fire(
                            'Berhasil!',
                            'Lakukan Progres.',
                            'success'
                        );
                    }
                });
            });
        });


    });
</script>



@include('layout.footer')