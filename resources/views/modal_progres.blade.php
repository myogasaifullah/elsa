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
        09/08 <!-- Progress Bars with labels-->
         <div class="progress">
            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
         </div>
      </div>
   </div>

   <!-- Form untuk input/update persentase -->
   @php
       // Gunakan variabel existingPersentase yang dikirim dari controller
       // $existingPersentase sudah tersedia dari controller
   @endphp

   @if ($errors->any())
       <div class="alert alert-danger">
           <ul class="mb-0">
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
   @endif

   <form action="{{ $existingPersentase ? route('persentase.update', $existingPersentase->id) : route('persentase.store') }}" method="POST">
       @csrf
       @if($existingPersentase)
           @method('PUT')
       @endif
       
       <input type="hidden" name="id_progres" value="{{ $progress->id }}">
       
       <div class="row">
           <div class="col-md-6 mb-3">
               <label for="target_publish" class="form-label">Target Publish</label>
               <input type="date" class="form-control @error('target_publish') is-invalid @enderror" id="target_publish" name="target_publish" 
                      value="{{ old('target_publish', isset($existingPersentase->target_publish) ? $existingPersentase->target_publish->format('Y-m-d') : '') }}" required>
               @error('target_publish')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
           </div>
           <div class="col-md-6 mb-3">
               <label for="tanggal_publish" class="form-label">Tanggal Publish</label>
               <input type="date" class="form-control @error('tanggal_publish') is-invalid @enderror" id="tanggal_publish" name="tanggal_publish" 
                      value="{{ old('tanggal_publish', isset($existingPersentase->tanggal_publish) ? $existingPersentase->tanggal_publish->format('Y-m-d') : '') }}">
               @error('tanggal_publish')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
           </div>
       </div>

       <div class="row">
           <div class="col-md-6 mb-3">
               <label for="publish_link_youtube" class="form-label">Link YouTube</label>
               <input type="url" class="form-control @error('publish_link_youtube') is-invalid @enderror" id="publish_link_youtube" name="publish_link_youtube" 
                      value="{{ old('publish_link_youtube', $existingPersentase->publish_link_youtube ?? '') }}" 
                      placeholder="https://youtube.com/...">
               @error('publish_link_youtube')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
           </div>
           <div class="col-md-6 mb-3">
               <label for="durasi_video_menit" class="form-label">Durasi Video (Menit)</label>
               <input type="number" class="form-control @error('durasi_video_menit') is-invalid @enderror" id="durasi_video_menit" name="durasi_video_menit" 
                      value="{{ old('durasi_video_menit', $existingPersentase->durasi_video_menit ?? '') }}" 
                      step="0.01" min="0">
               @error('durasi_video_menit')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
           </div>
       </div>

       <div class="mb-3">
           <label class="form-label">Catatan</label>
           @for($i = 1; $i <= 10; $i++)
           <div class="mb-2">
               <input type="text" class="form-control @error('catatan'.$i) is-invalid @enderror" name="catatan{{ $i }}" 
                      placeholder="Catatan {{ $i }}"
                      value="{{ old('catatan'.$i, $existingPersentase->{'catatan'.$i} ?? '') }}">
               @error('catatan'.$i)
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
           </div>
           @endfor
       </div>

       <div class="text-center">
           <button type="submit" class="btn btn-primary">
               {{ $existingPersentase ? 'Update Persentase' : 'Simpan Persentase' }}
           </button>
       </div>
   </form>

</main>

@include('layout.footer')
