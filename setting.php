<?php 
  require 'application/system.php';
  if (!$logged) {
    header("location:login.php");
  }
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
            <h1 class="m-0 text-dark">Pengaturan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Pengaturan</li>
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
          <div class="col-lg-6">
            <div class="card" id="hide-customer">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Pengaturan</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <form id="form_setting">
                      <div class="form-group">
                        <label for="">Nama Bisnis</label>
                        <input type="text" class="form-control" placeholder="Nama Bisnis" required>
                      </div>
                      <div class="form-group">
                        <label for="">Alamat</label>
                        <!-- <input type="text" class="form-control" placeholder="Nama Bisnis"> -->
                        <textarea name="address" id="" class="form-control" placeholder="Alamat"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" class="form-control" placeholder="Nomor Telepon">
                      </div>
                      <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" placeholder="Alamat Email">
                      </div>
                      <div class="form-group">
                        <label for="">Instagram</label>
                        <input type="text" class="form-control" placeholder="Instagram">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="float-right btn btn-success">Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
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
<?php include 'theme/src_foot.php'; ?>
<script>
  $(function(){
    //Setup
    $.ajaxSetup({
      cache:false
    });
    //Data Table
    $('#data_barang').DataTable();
    $('#btn_barang_plus').click(function(){
      $('#modalBarang').modal('show');
    });

  })
</script>
</body>
</html>
