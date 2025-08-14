<script>
  const formTambahProdi = document.getElementById('formTambahProdi');
  if (formTambahProdi) {
    formTambahProdi.addEventListener('submit', function(e) {
      e.preventDefault();

      const fakultas = document.getElementById('fakultasProdi').value;
      const namaProdi = document.getElementById('namaProdi').value;
      const singkatanProdi = document.getElementById('singkatanProdi').value;

      if (!fakultas || !namaProdi || !singkatanProdi) {
        Swal.fire('Gagal', 'Semua field wajib diisi.', 'error');
        return;
      }

      Swal.fire('Berhasil', 'Program Studi berhasil ditambahkan.', 'success');

      // Reset form dan tutup modal
      this.reset();
      const modal = bootstrap.Modal.getInstance(document.getElementById('modalTambahProdi'));
      modal.hide();
    });
  }
</script>

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
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


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 500,
        events: [{
          title: 'Booking Studio 1',
          start: '2025-07-20',
          description: 'Jadwal Studio'
        }]
      });
      calendar.render();
    }
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.4/dist/js/datepicker-full.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script> -->
<!-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script> -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/id.js'></script>
<!-- <script src='https://cdn.jsdelivr.net/npm/flatpickr'></script> -->
<script src='https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js'></script>
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