<?php 
  require 'application/system.php';
  if (!$logged) {
    header("location:login.php");
  }
  $menu = "setting";
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
                        <input type="hidden" name="edit_setting" value="1">
                        <input type="text" class="form-control" name="nama_bisnis" placeholder="Nama Bisnis" value="<?=$setting['nama_bisnis'];?>" required>
                      </div>
                      <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat" class="form-control" placeholder="Alamat"><?=$setting['alamat'];?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="Nomor Telepon" value="<?=$setting['phone'];?>">
                      </div>
                      <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Alamat Email" value="<?=$setting['email'];?>">
                      </div>
                      <div class="form-group">
                        <label for="">Instagram</label>
                        <input type="text" class="form-control" name="instagram" placeholder="Instagram" value="<?=$setting['instagram'];?>">
                      </div>
                      <div class="form-group">
                        <label for="">Ucapan terimakasih</label>
                        <textarea name="ucapan" class="form-control" placeholder="Ucapan"><?=$setting['ucapan'];?></textarea>
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
          <!-- /.col-lg-6 -->
            <div class="col-lg-6">
            <div class="card" id="hide-customer">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Akun <span class="badge badge-info"><?=ucwords($admin['role']);?></span></h3>
                  <button class="btn btn-sm btn-danger" id="btn-pw">Ganti Password</button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <form id="edit_akun">
                      <input type="hidden" name="edit_akun" value="1">
                      <input type="hidden" name="id_admin" value="<?=$_SESSION['user']['id_admin']?>">
                      <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" value="<?=$admin['username'];?>" required>
                      </div>
                      <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" class="form-control" name="fullname" placeholder="Nama Lengkap" value="<?=$admin['fullname'];?>" required>
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
<div class="modal fade" id="modal-pw">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ganti Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="change_password">
                  <input type="hidden" name="change_password" value="1">
                  <input type="hidden" name="id_admin" value="<?=$_SESSION['user']['id_admin']?>">
                  <div class="form-group">
                    <label>Password Lama:</label>
                    <input type="password" class="form-control" name="old_password" placeholder="Kata Sandi Lama">
                  </div>
                  <div class="form-group">
                    <label>Password Baru:</label>
                    <input type="password" class="form-control" name="new_password" placeholder="Kata Sandi Baru">
                  </div>
                  <div class="form-group">
                    <label>Konfirmasi Password:</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Konfirmasi Kata Sandi Baru">
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
</div>
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
    $('#btn-pw').click(function(){
      $('#modal-pw').modal('show');
    });
    //Form Pw
    $('#change_password').submit(function(e){
      e.preventDefault();
      $.ajax({
        type : 'POST',
        url : 'json/json_edit.php',
        data: $('#change_password').serialize(),
        dataType : 'json',
        success : function(data){
          if (data.success) {
            toastr['success'](data.message);
            $('#modal-pw').modal('hide');
            setTimeout(function(){window.location.href="setting.php"},1000);
          }else{
            toastr['error'](data.message);
          }
        }
      })
    });

    //Form Setting
    $('#form_setting').submit(function(e){
      e.preventDefault();
      $.ajax({
        type : 'POST',
        url : 'json/json_edit.php',
        data: $('#form_setting').serialize(),
        dataType : 'json',
        success : function(data){
          if (data.success) {
            toastr['success'](data.message);
            setTimeout(function(){window.location.href="setting.php"},1000);
          }else{
            toastr['error'](data.message);
          }
        }
      })
    });
    //
    $('#edit_akun').submit(function(e){
      e.preventDefault();
      $.ajax({
        type : 'POST',
        url : 'json/json_edit.php',
        data: $('#edit_akun').serialize(),
        dataType : 'json',
        success : function(data){
          if (data.success) {
            toastr['success'](data.message);
            setTimeout(function(){window.location.href="setting.php"},1000);
          }else{
            toastr['error'](data.message);
          }
        }
      })
    })
  });
</script>
</body>
</html>
