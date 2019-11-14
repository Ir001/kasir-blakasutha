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
  <title><?=$setting['nama_bisnis'];?> | Penjualan</title>
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
            <h1 class="m-0 text-dark">Penjualan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Penjualan</li>
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
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Pengaturan</h3>
                  <!-- <button id="btn_user_plus" class="btn btn-sm btn-success">Tambah</button> -->
                </div>
              </div>
              <div class="card-body">
                <form id="settingForm">
                  <div class="form-group">
                    <label for="">Nama Bisnis:</label>
                    <input type="text" class="form-control" placeholder="Nama Bisnis">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-info">Simpan</button>
                  </div>
                </form>

              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.col-md-6 -->
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
</body>
</html>
