<?php 
require 'application/system.php';
if (!$logged) {
  header("location:login.php");
}
if (!$isAdmin) {
  exit('Akses tidak diijinkan');
}
$menu = "management";
$menuItem = "barang_pemesanan";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$setting['nama_bisnis'];?> | Manage Barang</title>

  <?php include 'theme/src_head.php'; ?>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include 'theme/top_navbar.php'; ?>

    <!-- Main Sidebar Container -->

    <?php include 'theme/sidebar.php'; ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Manage Barang Pesanan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Manage Barang Pesanan</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card" id="hide-customer">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Daftar Barang</h3>
                    <div class="form-group">

                    </div>
                    <button id="btn_barang_plus" class="btn btn-sm btn-success">Tambah</button>
                  </div>
                  <label for="">Hanya tampilkan:</label>
                  <select name="type" id="type-form" class="form-control">
                    <option value="all">Semua</option>
                    <option value="30">Type 30s</option>
                    <option value="24">Type 24s</option>
                    <option value="other">Lainnya</option>
                  </select>
                </div>
                <div class="card-body" id="show-barang">

                </div>
              </div>
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?php include 'theme/footer.php'; ?>
  </div>

  <!-- /.modal -->
  <div class="modal fade" id="modalBarang">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_barang_add">
            <input type="hidden" name="form_barang_add" value="1">
            <input type="hidden" name="id_barang" id="id_barang">
            <div class="form-group">
              <label>Length:</label>
              <div class="radio">
                <label id="panjang">
                  <input id="panjang" type="radio" class="length" name="length" value="Panjang">
                  Panjang
                </label>
                <label id="pendek">
                  <input id="pendek" type="radio" class="length" name="length" value="Pendek">
                  Pendek
                </label>
                <label id="other">
                  <input id="other" type="radio" class="length" name="length" value="Other">
                  Lainnya
                </label>
              </div>
            </div>
            <div class="form-group">
              <label>Bahan Katun:</label>
              <div class="radio">
                <label id="type-30">
                  <input id="type-30" type="radio" class="type" name="type" value="30">
                  Katun 30s
                </label>
                <label id="type-24">
                  <input id="type-24" type="radio" class="type" name="type" value="24">
                  Katun 24s
                </label>
                <label id="other_type">
                  <input id="other_type" type="radio" class="type" name="type" value="other">
                  Lainnya
                </label>
              </div>
            </div>
            <div class="form-group">
              <label>Harga Satuan:</label>
              <input type="number" class="form-control" id="harga_1" name="harga_1" placeholder="Harga satuan" required>
            </div>
            <div class="form-group">
              <label>Harga 1 lusin:</label>
              <input type="number" class="form-control" id="harga_2" name="harga_2" placeholder="Harga 1 lusin" required>
            </div>
            <div class="form-group">
              <label>Harga 2 lusin:</label>
              <input type="number" class="form-control" id="harga_3" name="harga_3" placeholder="Harga 2 lusin" required>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan </button>
            </div>
          </form>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <div id="modal-edit"></div>

    <?php include 'theme/src_foot.php'; ?>
    <script>
      $(function(){
    //Setup
    $.ajaxSetup({
      cache:false
    });
    //Data Table
    <?php if (isset($_GET['type'])): ?>
      $('#type-form').val(<?=$_GET['type']?>)
    <?php endif ?>
    $('#show-barang').load("json/show_barang_pesanan.php");
    $('#btn_barang_plus').click(function(){
      $('#modalBarang').modal('show');
    });
    //
    $('#form_barang_add').submit(function(e){
      e.preventDefault();
      $.ajax({
        type : 'POST',
        url :'application/event_barang_pemesanan.php',
        data: $(this).serialize(),
        dataType : 'json',
        success : function(data){
          if (data.success) {
            toastr['success'](data.message);
            $('#show-barang').load("json/show_barang_pesanan.php");
            $('#modalBarang').modal('hide');
          }else{
            toastr['error'](data.message);
          }
        }
      })
    });
    $('#type-form').change(function(e){
      var value = $(this).val();
      $('#show-barang').empty();
      $('#show-barang').load("json/show_barang_pesanan.php?type="+value);
      
    });


  })
</script>
</body>
</html>
