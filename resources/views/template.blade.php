<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- baru -->
    <!-- DataTables Export Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

</head>

<body>

    @section('title', 'Dashboard')

    @include('layout.sidebar')

    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="" style="height: 30px;">
        <span class="d-block d-lg-block">Elsa</span>
        <!-- Ganti d-none jadi d-block supaya terlihat di semua ukuran -->
    </a>
    <!-- <i class="bi bi-list toggle-sidebar-btn "></i> -->
    <!-- Tambahkan d-block d-lg-none agar toggle muncul di mobile, tidak di desktop -->
</div>


        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>
                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Kevin Anderson</h6>
                            <span>Web Designer</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="profile">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="profile">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="login">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Template Export</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                    <li class="breadcrumb-item">template</li>
                    <li class="breadcrumb-item active">template</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="col-12">
            <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <h5 class="card-title">Template <span>| export</span></h5>
                    <!-- baru -->
                    <div class="mb-2">
                        <h5 class="card-title">Export <span>| </span></h5>
                        <div id="exportButtons"></div>
                    </div>

                    <table id="verifikasiTable" class="table table-striped table-bordered table-hover">
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

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>rafid21</td>
                                <td>rafid@example.com</td>
                                <td>FTIK</td>
                                <td>Informatika</td>
                                <td>089653920595</td>
                                <td>Editor</td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>

                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>nabila_dsn</td>
                                <td>nabila@example.com</td>
                                <td>FTIK</td>
                                <td>Sistem Informasi</td>
                                <td>089653920595</td>
                                <td>Editor</td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>

                            </tr>

                            <!-- Tambahkan baris lainnya sesuai data -->
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

    </main><!-- End #main -->


    <!-- ======= Footer ======= -->
    <footer class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Elsa</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">Elsa</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>

    <!-- baru -->
    <script>
        $(document).ready(function() {
            const table = $('#verifikasiTable').DataTable({
                dom: '<"row mb-3"<"col-md-6"B><"col-md-6 text-end"f>>' +
                    '<"row"<"col-sm-12"tr>>' +
                    '<"row mt-3"<"col-sm-6"i><"col-sm-6"p>>',
                buttons: [{
                        extend: 'excelHtml5',
                        title: 'Verifikasi_User',
                        className: 'btn btn-success btn-sm me-2'
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'Verifikasi_User',
                        className: 'btn btn-primary btn-sm me-2'
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Verifikasi_User',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        className: 'btn btn-danger btn-sm me-2'
                    }
                ]
            });
        });
    </script>


</body>

</html>

<style>
    #verifikasiTable_wrapper .btn {
        font-size: 0.85rem;
        padding: 5px 10px;
    }

    #verifikasiTable_wrapper .dataTables_filter input {
        border-radius: 0.375rem;
        border: 1px solid #ced4da;
        padding: 4px 8px;
        font-size: 0.9rem;
    }

    #verifikasiTable thead th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
    }

    .badge {
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 0.4rem;
    }

    .card-title span {
        font-weight: normal;
        font-size: 0.85rem;
        color: #6c757d;
    }

    /* Pastikan header tetap di atas */
    #header {
        z-index: 1000;
        position: fixed;
        top: 0;
        width: 100%;
    }

    /* Sidebar berada di bawah header */
    #sidebar {
        top: 60px;
        /* Sesuaikan dengan tinggi header */
        z-index: 998;
        /* Lebih rendah dari header */
        position: fixed;
        height: calc(100vh - 60px);
        /* Sisakan ruang header */
        overflow-y: auto;
    }

    /* Atur margin konten utama */
    main.main {
        margin-left: 260px !important;
        /* sesuai lebar sidebar */
        padding-top: 70px !important;
        /* beri ruang untuk header */
    }

    @media (max-width: 991px) {
        #sidebar {
            width: 260px;
            left: 0;
            background: #fff;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
        }

        main.main {
            margin-left: 260px !important;
            padding-top: 70px !important;
        }
    }

    /* Tambahkan untuk DESKTOP (di atas 992px) */
    @media (min-width: 992px) {
        #sidebar {
            width: 260px;
            position: fixed;
            left: 0;
            top: 60px;
            height: calc(100vh - 60px);
            background: #fff;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
            z-index: 998;
        }

        main.main {
            margin-left: 260px !important;
            padding-top: 70px !important;
            padding-left: 20px;
            padding-right: 20px;
            background-color: #f8f9fc;
            min-height: 100vh;
        }
    }
</style>