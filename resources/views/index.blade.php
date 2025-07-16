<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>YouTube Clone</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    body {
      background-color: #0f0f0f;
      color: #fff;
      font-family: Arial, sans-serif;
    }
    .navbar {
      background-color: #212121;
    }
    .search-bar {
      background-color: #121212;
      border: 1px solid #333;
      color: #fff;
    }
    .search-bar:focus {
      background-color: #121212;
      color: #fff;
    }
    .filter-bar {
      overflow-x: auto;
      white-space: nowrap;
    }
    .filter-btn {
      background-color: #272727;
      color: white;
      border: none;
      margin-right: 8px;
    }
    .filter-btn.active {
      background-color: white;
      color: black;
    }
    .video-card {
      background-color: transparent;
      color: white;
      margin-bottom: 20px;
    }
    .video-thumb {
      width: 100%;
      border-radius: 8px;
    }
    .video-title {
      font-size: 14px;
      font-weight: 600;
      margin-top: 8px;
    }
    .video-info {
      font-size: 12px;
      color: #aaa;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark px-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">YouTube</a>
    <form class="d-flex w-50">
      <input class="form-control me-2 search-bar" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
    </form>
    <div>
      <i class="bi bi-bell-fill text-white me-3"></i>
      <i class="bi bi-person-circle text-white fs-4"></i>
    </div>
  </div>
</nav>

<!-- Filter Bar -->
<div class="px-3 py-2 filter-bar">
  <button class="btn filter-btn active">Semua</button>
  <button class="btn filter-btn">Musik</button>
  <button class="btn filter-btn">Mix</button>
  <button class="btn filter-btn">Game</button>
  <button class="btn filter-btn">Live</button>
  <button class="btn filter-btn">Kartun</button>
  <button class="btn filter-btn">Musik Rap</button>
  <button class="btn filter-btn">Baru diupload</button>
  <button class="btn filter-btn">Ditonton</button>
  <button class="btn filter-btn">Baru untuk Anda</button>
</div>

<!-- Video Grid -->
<div class="container mt-3">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

    <!-- Video Card 1 -->
    <div class="col">
      <div class="video-card">
        <img src="https://i.ytimg.com/vi_webp/PRa1w4ycMfM/mqdefault.webp" alt="thumbnail" class="video-thumb">
        <div class="video-title">Mix - The 1975 - About You</div>
        <div class="video-info">Yung Kai, Sombrr · Diputar hari ini</div>
      </div>
    </div>

    <!-- Video Card 2 -->
    <div class="col">
      <div class="video-card">
        <img src="https://i.ytimg.com/vi_webp/EXAMPLEID/mqdefault.webp" alt="thumbnail" class="video-thumb">
        <div class="video-title">Kenapa SABAR Bisa Mengubah Takdir? | Ustadz Khalid Basalamah</div>
        <div class="video-info">Kajian Sunnah Al Hayyin · 9 hari yang lalu</div>
      </div>
    </div>

    <!-- Video Card 3 -->
    <div class="col">
      <div class="video-card">
        <img src="https://i.ytimg.com/vi_webp/EXAMPLEID2/mqdefault.webp" alt="thumbnail" class="video-thumb">
        <div class="video-title">Coki & Felix: Pertemuan Bersejarah</div>
        <div class="video-info">MALAKA · 2,6 jt x · 3 bulan lalu</div>
      </div>
    </div>

    <!-- Tambah video lainnya sesuai kebutuhan -->
    
  </div>
</div>

</body>
</html>
