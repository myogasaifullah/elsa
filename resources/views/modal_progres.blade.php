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

   <!-- Row to contain cards side by side -->
   <div class="row">
      <!-- Task 1: Pra-produksi -->
      <div class="col-md-6 mb-4">
         <div class="card">
            <div class="card-body">
               <h5 class="card-title">Pra-produksi</h5>
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
      <div class="col-md-6 mb-4">
         <div class="card">
            <div class="card-body">
               <h5 class="card-title">Import dan Organisasi Materi</h5>
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
      <div class="col-md-6 mb-4">
         <div class="card">
            <div class="card-body">
               <h5 class="card-title">Rough Cut</h5>
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
      <div class="col-md-6 mb-4">
         <div class="card">
            <div class="card-body">
               <h5 class="card-title">Rough Cut</h5>
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
   </div>

</main>

@include('layout.footer')
