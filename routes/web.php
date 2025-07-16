<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
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

Route::get('/studio-matkul', function () {
    return view('akademik/studio-matkul');
});

Route::get('/jadwal', function () {
    return view('booking/jadwal');
});

Route::get('/acc', function () {
    return view('booking/acc');
});