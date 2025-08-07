@extends('layout.header')

@section('title', 'Dashboard')

@include('layout.sidebar')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Progres</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item ">Persentase</li>
                <li class="breadcrumb-item active">Progres</li>
            </ol>
        </nav>
    </div>
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
                                        <th>Prodi</th>
                                        <th>Mata Kuliah</th>
                                        <th>Kategori MOOC</th>
                                        <th>Judul Course</th>
                                        <th>Studio</th>
                                        <th>Tanggal Shooting</th>
                                        <th>Waktu</th>
                                        <th>Jenis Kategori</th>
                                        <th>Target Upload</th>
                                        <th>Persentase</th>
                                        <th>Progres</th>
                                        <th>Keterangan</th>
                                        <th>Durasi (Menit)</th>
                                        <th>Tautan Video</th>
                                        <th>Tgl Upload YouTube</th>
                                        <th>Editor</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $progress->jadwalBooking->dosen->nama_dosen ?? $progress->jadwalBooking->booking->dosen->nama ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->user->fakultas->nama_fakultas ?? $progress->jadwalBooking->booking->dosen->fakultas->nama ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->user->prodi->nama_prodi ?? $progress->jadwalBooking->booking->dosen->prodi->nama ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->nama_mata_kuliah ?? $progress->jadwalBooking->booking->mataKuliah->nama ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->kategori_mooc ?? $progress->jadwalBooking->booking->kategori_mooc ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->judul_course ?? $progress->jadwalBooking->booking->judul_course ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->studio->nama_studio ?? $progress->jadwalBooking->studio->nama ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->tanggal ?? $progress->jadwalBooking->tanggal_shooting ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->jam ?? $progress->jadwalBooking->waktu ?? '-' }}</td>
                                        <td>{{ $progress->jadwalBooking->jenis_kategori ?? $progress->jadwalBooking->booking->jenis_kategori ?? '-' }}</td>
                                        <td>{{ $progress->target_upload ? \Carbon\Carbon::parse($progress->target_upload)->format('d/m/Y') : '-' }}</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" style="width: {{ $progress->persentase ?? 0 }}%;">{{ $progress->persentase ?? 0 }}%</div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge 
                                                @if($progress->progres == 'belum') bg-secondary
                                                @elseif($progress->progres == 'progres') bg-warning text-dark
                                                @else bg-success
                                                @endif">
                                                {{ ucfirst($progress->progres ?? '-') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge 
                                                @if($progress->keterangan == 'belum terbit') bg-danger
                                                @else bg-success
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $progress->keterangan ?? '-')) }}
                                            </span>
                                        </td>
                                        <td>{{ $progress->durasi ?? '-' }}</td>
                                        <td>
                                            @if($progress->jadwalBooking->booking->link_video ?? $progress->tautan_video ?? '')
                                            <a href="{{ $progress->jadwalBooking->booking->link_video ?? $progress->tautan_video ?? '' }}" target="_blank" class="btn btn-sm btn-primary">Lihat Video</a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>{{ $progress->tanggal_upload_youtube ? \Carbon\Carbon::parse($progress->tanggal_upload_youtube)->format('d/m/Y') : '-' }}</td>
                                        <td class="text-center">
                                            @if(empty($progress->editor->nama))
                                            <button type="button"
                                                class="btn btn-sm btn-primary assign-editor-btn"
                                                data-progress-id="{{ $progress->id }}"
                                                onclick="assignEditor({{ $progress->id }})">
                                                <i class="bi bi-person-plus"></i> Isi Nama
                                            </button>
                                            @else
                                            {{ $progress->editor->nama }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-success text-white">Sudah Shooting</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('progres.edit', $progress->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   <!-- Card for the Progress bar -->
   <div class="card mb-4">
      <div class="card-body">
         <h5 class="card-title">Persentase Progres</h5>
         <!-- Progress Bars with labels-->
         <div class="progress">
            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
         </div>
      </div>
   </div>

   <!-- Accordion for Task Sections -->
   <div class="accordion" id="accordionExample">
      
      <!-- Task 1: Pra-produksi -->
      <div class="accordion-item">
         <h2 class="accordion-header" id="headingPraProduksi">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePraProduksi" aria-expanded="true" aria-controls="collapsePraProduksi">
               Pra-produksi
            </button>
         </h2>
         <div id="collapsePraProduksi" class="accordion-collapse collapse show" aria-labelledby="headingPraProduksi" data-bs-parent="#accordionExample">
            <div class="accordion-body">
               <p>"Menerima brief dari dosen/pengampu; Menyusun rencana editing; Memastikan ketersediaan materi (video, audio, slide, dll)"</p>
               
               <!-- Button to trigger modal for Task 1 -->
               <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPraProduksi">
                  Progres
               </button>

               <!-- Modal for Task 1 -->
               <div class="modal fade" id="modalPraProduksi" tabindex="-1">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Pra-produksi</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <p>"Menerima brief dari dosen/pengampu; Menyusun rencana editing; Memastikan ketersediaan materi (video, audio, slide, dll)"</p>

                           <!-- Catatan input field -->
                           <div class="mb-3">
                              <label for="catatanPraProduksi" class="form-label">Catatan</label>
                              <textarea class="form-control" id="catatanPraProduksi" rows="3" placeholder="Tambahkan catatan"></textarea>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           <button type="button" class="btn btn-primary">Simpan perubahan</button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- End Modal for Task 1 -->
            </div>
         </div>
      </div>

      <!-- Task 2: Import dan Organisasi Materi -->
      <div class="accordion-item">
         <h2 class="accordion-header" id="headingImportOrganisasi">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseImportOrganisasi" aria-expanded="false" aria-controls="collapseImportOrganisasi">
               Import dan Organisasi Materi
            </button>
         </h2>
         <div id="collapseImportOrganisasi" class="accordion-collapse collapse" aria-labelledby="headingImportOrganisasi" data-bs-parent="#accordionExample">
            <div class="accordion-body">
               <p>"Mengimpor footage, audio, dan bahan pendukung ke software; Membuat folder kerja terstruktur (bining)"</p>

               <!-- Button to trigger modal for Task 2 -->
               <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalImportOrganisasi">
                  Progres
               </button>

               <!-- Modal for Task 2 -->
               <div class="modal fade" id="modalImportOrganisasi" tabindex="-1">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Import dan Organisasi Materi</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <p>"Mengimpor footage, audio, dan bahan pendukung ke software; Membuat folder kerja terstruktur (bining)"</p>

                           <!-- Catatan input field -->
                           <div class="mb-3">
                              <label for="catatanImportOrganisasi" class="form-label">Catatan</label>
                              <textarea class="form-control" id="catatanImportOrganisasi" rows="3" placeholder="Tambahkan catatan"></textarea>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           <button type="button" class="btn btn-primary">Simpan perubahan</button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- End Modal for Task 2 -->
            </div>
         </div>
      </div>

      <!-- Task 3: Rough Cut -->
      <div class="accordion-item">
         <h2 class="accordion-header" id="headingRoughCut">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRoughCut" aria-expanded="false" aria-controls="collapseRoughCut">
               Rough Cut
            </button>
         </h2>
         <div id="collapseRoughCut" class="accordion-collapse collapse" aria-labelledby="headingRoughCut" data-bs-parent="#accordionExample">
            <div class="accordion-body">
               <p>"Memilih bagian-bagian penting video; Menyusun urutan sesuai alur pembelajaran; Menghapus bagian yang tidak diperlukan"</p>

               <!-- Button to trigger modal for Task 3 -->
               <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRoughCut">
                  Progres
               </button>

               <!-- Modal for Task 3 -->
               <div class="modal fade" id="modalRoughCut" tabindex="-1">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Rough Cut</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <p>"Memilih bagian-bagian penting video; Menyusun urutan sesuai alur pembelajaran; Menghapus bagian yang tidak diperlukan"</p>

                           <!-- Catatan input field -->
                           <div class="mb-3">
                              <label for="catatanRoughCut" class="form-label">Catatan</label>
                              <textarea class="form-control" id="catatanRoughCut" rows="3" placeholder="Tambahkan catatan"></textarea>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           <button type="button" class="btn btn-primary">Simpan perubahan</button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- End Modal for Task 3 -->
            </div>
         </div>
      </div>
   </div><!-- End Accordion -->

</main>

@include('layout.footer')
