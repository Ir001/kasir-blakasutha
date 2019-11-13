<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="./dist/js/adminlte.js"></script>


<!-- Toastr -->
<!-- DataTables -->
<script src="./plugins/datatables/jquery.dataTables.js"></script>
<script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="./plugins/toastr/toastr.min.js"></script>
<script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    })
  }
</script>
<script type="text/javascript">
  setInterval(function() {
    var date = new Date();
    $('#clock-wrapper').html(
        date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds()
        );
}, 500);
</script>