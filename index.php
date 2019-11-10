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
                  <h3 class="card-title">Daftar Pelanggan</h3>
                  <a href="javascript:void(0);">Tambah</a>
                </div>
              </div>
              <div class="card-body">
                <table id="data_pelanggan" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Custome</th>
                    <th>Phone</th>
                    <th>Instagram</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>Darjo</td>
                    <td>082243440959
                    </td>
                    <td>@hjkwz</td>
                    <td class="text-center"><button class=" btn btn-sm btn-success"><i class="fa fa-user-plus"></i></button></td>
                  </tr>
                  
                  </tbody>
                </table>
                <hr>
                <table id="data_barang" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>BLKHTM</td>
                    <td>Kaos Oblong
                    </td>
                    <td>8</td>
                    <td>78.000</td>
                    <td class="text-center"><button class=" btn btn-sm btn-success"><i class="fa fa-cart-plus"></i></button></td>
                  </tr>
                  
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
           <div class="">
              <div class="card ">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Total Belanja</h3>
                  <!-- <a href="javascript:void(0);">Tambah</a> -->

                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <div class="row">
                    <div class="col-md-12">
                      <table id="data_pelanggan" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Kode</th>
                          <th>Nama</th>
                          <th>Quantity</th>
                          <th>Harga</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td>BLKHTM</td>
                          <td>Kaos Oblong</td>
                          <td>1</td>
                          <td>78.000</td>
                          <td>
                            <button class=" btn btn-sm btn-success" title="Edit"><i class="fa fa-pen"></i></button>
                            <button class=" btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
                          </td>
                        </tr>                    
                        </tbody>
                      </table>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-12">
                      <form>
                        <div class="form-group">
                          <label>Total</label>
                          <input type="number" class="form-control" name="total" value="78000" min="0" disabled></input>
                        </div>
                        <div class="form-group">
                          <label>Jumlah Bayar</label>
                          <input type="number" class="form-control" name="jumlah_bayar" placeholder="Jumlah Bayar" min="0" required></input>
                        </div>
                      </form>
                      <button class="float-right btn btn-success"><i class="fa fa-money-bill-wave"></i> Bayar</button>
                    </div>
                  </div>
                 
                </div>
                <!-- /.d-flex -->
              </div>
            </div>
           </div>
            <!-- /.card -->
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
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0-rc.1
    </div>
  </footer>
</div>

<?php include 'theme/src_foot.php'; ?>
<script>
  $(function () {
    $("#data_pelanggan").DataTable();
    $('#data_barang').DataTable();
  });
</script>
</body>
</html>
