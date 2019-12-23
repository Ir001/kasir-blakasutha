<?php 
  require 'application/system.php';
  if (!$logged) {
    header("location:login.php");
  }
  $menu = "management";
  $menuItem = "barang";
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
            <h1 class="m-0 text-dark">Manage Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Manage Barang</li>
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
                  <button id="btn_barang_plus" class="btn btn-sm btn-success">Tambah</button>
                </div>
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
                  <input type="hidden" name="add_data_barang" value="1">
                  <div class="form-group">
                    <label>Kode Barang:</label>
                    <input type="text" class="form-control" name="kode_barang" placeholder="Kode">
                  </div>
                  <div class="form-group">
                    <label>Nama Barang:</label>
                    <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" required>
                  </div>
                  <div class="form-group">
                    <label>Stok:</label>
                    <input type="number" class="form-control" name="stok" placeholder="Stok" required>
                  </div>
                  <div class="form-group">
                    <label>Harga Satuan:</label>
                    <input type="number" class="form-control" name="harga_1" placeholder="Harga 1 lusin" required>
                  </div>
                  <div class="form-group">
                    <label>Harga 1 lusin:</label>
                    <input type="number" class="form-control" name="harga_2" placeholder="Harga 1 lusin" required>
                  </div>
                  <div class="form-group">
                    <label>Harga 2 lusin:</label>
                    <input type="number" class="form-control" name="harga_3" placeholder="Harga 2 lusin" required>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
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
    $('#show-barang').load("json/show_barang.php");
    $('#btn_barang_plus').click(function(){
      $('#modalBarang').modal('show');
    });
    //
    $('#form_barang_add').submit(function(e){
      e.preventDefault();
      $.ajax({
        type : 'POST',
        url :'application/event.php',
        data: $('#form_barang_add').serialize(),
        dataType : 'json',
        success : function(data){
          if (data.success) {
            toastr['success'](data.message);
            $('#show-barang').load("json/show_barang.php");
            $('#modalBarang').modal('hide');
          }else{
            toastr['error'](data.message);
          }
        }
      })
    });

  })
</script>
</body>
</html>
