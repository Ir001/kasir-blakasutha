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
  <title><?=$setting['nama_bisnis'];?> | Pemesanan</title>

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
            <h1 class="m-0 text-dark">Pemesanan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Pemesanan</li>
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
          <div class="col-lg-12" id="load-content">
          </div>
          <div class="col-lg-12" id="load-customer-div">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Daftar Pelanggan</h3>
                  <button id="btn_user_plus" class="btn btn-sm btn-success">Tambah</button>
                </div>
              </div>
              <div class="card-body">
                <div id="load-customer"></div>
              </div>
            </div>
            <!-- /.card-body -->
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

     
      <div class="modal fade" id="addUser">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Customer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="form_user_add">
                  <input type="hidden" name="customer_add" value="1">
                  <div class="form-group">
                    <label>Nama:</label>
                    <input type="text" class="form-control" name="fullname" placeholder="Nama Lengkap" required>
                  </div>
                  <div class="form-group">
                    <label>Phone:</label>
                    <input type="text" class="form-control" name="phone" placeholder="Nomor HP Aktif">
                  </div>
                  <div class="form-group">
                    <label>Instagram:</label>
                    <input type="text" class="form-control" name="ig" placeholder="Username IG (tanpa @)">
                  </div>
                  <label>Status:</label>
                  <div class="form-group">
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="customer" value="customer" name="role" checked>
                          <label for="customer" class="custom-control-label">Customer</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="reseller" value="reseller" name="role">
                          <label for="reseller" class="custom-control-label">Reseller</label>
                        </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-user-plus"></i></button>
                  </div>
                </form>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

<?php include 'theme/src_foot.php'; ?>
<script>
  $(function(){
    //Setup
    $.ajaxSetup({
      cache:false
    });
    var loadUrl = "json/view_customer.php";
    //
    $('#load-customer').load(loadUrl);

    //Data Table
    $("#data_pelanggan").DataTable();
    //Event
    //Add User for show modal
    $('#btn_user_plus').click(function(){
      $('#addUser').modal('show');
    });
    //End of add user
    //Submit Add customer    
    $('#form_user_add').submit(function(e){
      e.preventDefault();
      $.ajax({
        type : 'POST',
        url :'application/event.php',
        data: $('#form_user_add').serialize(),
        dataType : 'json',
        success : function(data){
          if (data.success) {
            toastr['success'](data.message);
            $('#addUser').modal('hide');
            $('#load_customer').load(loadUrl);
          }else{
            toastr['error'](data.message)

          }
        }
      })
    });
    <?php if (isset($_SESSION['id_customer'])): ?>
      $('#load-content').load('json/view_pemesanan.php');
      $('#load-customer-div').hide();

    <?php endif; ?>

  })
</script>
</body>
</html>
