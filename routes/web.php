<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
// routes/web.php

use App\Http\Controllers\FakultasProdiController;
use App\Http\Controllers\DosenMoocController;
use App\Http\Controllers\StudioMatkulController;

// Index
Route::get('/fakultas-prodi', [FakultasProdiController::class, 'index'])->name('fakultas-prodi.index');

// Fakultas
Route::post('/fakultas', [FakultasProdiController::class, 'storeFakultas'])->name('fakultas.store');
Route::put('/fakultas/{id}', [FakultasProdiController::class, 'updateFakultas'])->name('fakultas.update');
Route::delete('/fakultas/{id}', [FakultasProdiController::class, 'destroyFakultas'])->name('fakultas.destroy');

// Prodi
Route::post('/prodi', [FakultasProdiController::class, 'storeProdi'])->name('prodi.store');
Route::put('/prodi/{id}', [FakultasProdiController::class, 'updateProdi'])->name('prodi.update');
Route::delete('/prodi/{id}', [FakultasProdiController::class, 'destroyProdi'])->name('prodi.destroy');

// Studio & Mata Kuliah
Route::get('/studio-matkul', [StudioMatkulController::class, 'index'])->name('studio-matkul.index');

// Studio
Route::post('/studio', [StudioMatkulController::class, 'storeStudio'])->name('studio.store');
Route::put('/studio/{id}', [StudioMatkulController::class, 'updateStudio'])->name('studio.update');
Route::delete('/studio/{id}', [StudioMatkulController::class, 'destroyStudio'])->name('studio.destroy');

// Gambar Studio
Route::delete('/gambar-studio/{id}', [StudioMatkulController::class, 'destroyGambarStudio'])->name('gambar-studio.destroy');

// Mata Kuliah
Route::post('/mata-kuliah', [StudioMatkulController::class, 'storeMataKuliah'])->name('mata-kuliah.store');
Route::put('/mata-kuliah/{id}', [StudioMatkulController::class, 'updateMataKuliah'])->name('mata-kuliah.update');
Route::delete('/mata-kuliah/{id}', [StudioMatkulController::class, 'destroyMataKuliah'])->name('mata-kuliah.destroy');

Route::get('/', function () {
    return view('index');
});




Route::get('/user', function () {
    return view('user');
});

Route::get('/listuser', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::post('/user', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
Route::put('/user/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::delete('/user/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');

Route::get('/verifikasi', [App\Http\Controllers\UserController::class, 'verifikasi'])->name('user.verifikasi');
Route::put('/verifikasi/status/{id}', [App\Http\Controllers\UserController::class, 'updateStatus'])->name('user.updateStatus');



// Dosen & MOOC Routes
Route::get('/dosen-mooc', [DosenMoocController::class, 'index'])->name('dosen-mooc.index');

// Dosen Routes
Route::post('/dosen', [DosenMoocController::class, 'storeDosen'])->name('dosen.store');
Route::put('/dosen/{dosen}', [DosenMoocController::class, 'updateDosen'])->name('dosen.update');
Route::delete('/dosen/{dosen}', [DosenMoocController::class, 'destroyDosen'])->name('dosen.destroy');

// MOOC Routes
Route::post('/mooc', [DosenMoocController::class, 'storeMooc'])->name('mooc.store');
Route::put('/mooc/{mooc}', [DosenMoocController::class, 'updateMooc'])->name('mooc.update');
Route::delete('/mooc/{mooc}', [DosenMoocController::class, 'destroyMooc'])->name('mooc.destroy');

Route::get('/jadwal', function () {
    return view('jadwal');
});

Route::get('/acc', function () {
    return view('booking/acc');
});

Route::get('/booking', function () {
    return view('booking/booking');
});

Route::get('/laporan', function () {
    return view('laporan');
});

Route::get('/progres', function () {
    return view('progres');
});

Route::get('/modal-progres', function () {
    return view('modal_progres');
});

Route::get('/template', function () {
    return view('template');
});

Route::get('/editor', function () {
    return view('editor');
});




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('password.update');
   });

require __DIR__.'/auth.php';
