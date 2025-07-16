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

  <!-- FullCalendar JS -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const calendarEl = document.getElementById('calendar');
      if (calendarEl) {
        const calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          height: 500,
          events: [
            {
              title: 'Booking Studio 1',
              start: '2025-07-20',
              description: 'Jadwal Studio'
            }
          ]
        });
        calendar.render();
      }
    });
  </script>

</body>

</html>