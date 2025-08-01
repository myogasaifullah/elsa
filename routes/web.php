<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/v2', function () {
    return view('v2');
});

Route::get('/v3', function () {
    return view('v3');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/login', function () {
    return view('auth/login');
});

Route::get('/register', function () {
    return view('auth/register');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/user', function () {
    return view('user');
});

Route::get('/listuser', function () {
    return view('user/listuser');
});

Route::get('/verifikasi', function () {
    return view('user/verifikasi');
});

Route::get('/fakultas-prodi', function () {
    return view('akademik/fakultas-prodi');
});

Route::get('/dosen-mooc', function () {
    return view('akademik/dosen-mooc');
});

Route::get('/studio-matkul', function () {
    return view('akademik/studio-matkul');
});

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
