<?php 
require 'application/system.php';
if (!$logged) {
  header("location:login.php");
}
if (!$isAdmin) {
  exit('Akses tidak diijinkan');
}
$menu = "activity";
$menuItem = "";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$setting['nama_bisnis'];?> | Aktifitas Admin</title>

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
              <h1 class="m-0 text-dark">Aktifitas Admin</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Aktifitas Admin</li>
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
                    <h3 class="card-title">Log Aktivitas - Pengubahan Harga Barang</h3>
                  </div>
                </div>
                <div class="card-body">
                  <table id="data_pelanggan" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Barang</th>
                        <th>Harga Lama</th>
                        <th>Harga Baru</th>
                        <th>Terakhir Diubah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $logs_barang = $system->list_logs_barang();
                      foreach ($logs_barang as $list) {
                        $detail_barang = $system->get_detail_barang($list['id_barang']);
                        ?>
                        <tr>
                          <td><?=$detail_barang['nama_barang'];?><br><b>[<?=$detail_barang['kode_barang'];?>]</b></td>
                          <td>
                            <ul>
                              <li>Harga Satuan: Rp.<?=number_format($list['old_harga1'], 0,',','.');?></li>
                              <li>Harga 1 lusin: Rp.<?=number_format($list['old_harga2'], 0,',','.');?></li>
                              <li>Harga 2 lusin: Rp.<?=number_format($list['old_harga3'], 0,',','.');?></li>
                            </ul>
                          </td>
                          <td>
                            <ul>
                              <li>Harga Satuan: Rp.<?=number_format($list['new_harga1'], 0,',','.');?></li>
                              <li>Harga 1 lusin: Rp.<?=number_format($list['new_harga2'], 0,',','.');?></li>
                              <li>Harga 2 lusin: Rp.<?=number_format($list['new_harga3'], 0,',','.');?></li>
                            </ul>
                          </td>
                          <td><?=$list['updated_at'];?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>

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
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
  <div class="modal fade" id="detailUser">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Customer</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_edit_customer">
            <input type="hidden" name="edit_customer" value="1">
            <div class="form-group">
              <label>Detail Customer:</label>
              <input type="hidden" name="id_user" id="id_user">
              <input type="text" class="form-control" id="penjualan" disabled>
            </div>
            <div class="form-group">
              <label>Order Pemesanan:</label>
              <input type="text" class="form-control" id="pemesanan" disabled>
            </div>
            <div class="form-group">
              <label>Nama:</label>
              <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
            </div>
            <div class="form-group">
              <label>Phone:</label>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="Nomor HP Aktif">
            </div>
            <div class="form-group">
              <label>Instagram:</label>
              <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Username IG (tanpa @)">
            </div>
            <label>Status:</label>
            <div class="form-group">
              <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="customer_edit" value="customer" name="role" checked>
                <label for="customer_edit" class="custom-control-label">Customer</label>
              </div>
              <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="reseller_edit" value="reseller" name="role">
                <label for="reseller_edit" class="custom-control-label">Reseller</label>
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
  </div>
  <script>


    $(function(){
    //Setup
    $.ajaxSetup({
      cache:false
    });
    //Data Table
    $('#data_pelanggan').DataTable();
    $('#btn_user_plus').click(function(){
      $('#addUser').modal('show');
    });
    //
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
            window.location.href="manage_pelanggan.php";

          }else{
            toastr['error'](data.message)

          }
        }
      })
    });
    $('.btn-delete').click(function(){
      if (confirm("Apakah anda yakin?")) {
        $('.delete_customer').submit(function(e){
          e.preventDefault();
          $.ajax({
            type : 'POST',
            url : 'application/event.php',
            data : $(this).serialize(),
            dataType : 'json',
            success : function(data){
              if (data.success) {
                toastr['success'](data.message);
                window.location.href="manage_pelanggan.php";
              }else{
                toastr['error'](data.message);
              }
            }
          })
        })
      }else{
        $('.delete_customer').submit(function(e){
          e.preventDefault();
        })
      }
    })

    /*
      Show modal edit user
    */
    $('.detail_customer').submit(function(e){
      e.preventDefault();
      $.ajax({
        type : 'POST',
        url : 'application/event_customer.php',
        data : $(this).serialize(),
        dataType : 'json',
        success : function(data){
            $('#detailUser').modal('show');
            //Getter
            var id_user = data.id_customer;
            var nama = data.nama_lengkap;
            var phone = data.phone;
            var ig = data.instagram;
            var penjualan = data.penjualan;
            var pemesanan = data.pemesanan;
            //Setter
            $('#id_user').val(id_user);
            $('#nama_lengkap').val(nama);
            $('#phone').val(phone);
            $('#instagram').val(ig);
            $('#penjualan').val('Telah melakukan transaksi pembelian sebanyak '+data.penjualan +' kali')
            $('#pemesanan').val('Telah melakukan transaksi pemesanan sebanyak '+data.pemesanan +' kali')

        }
      })
    })

    /*
      Event handling edit data
    */

    $('#form_edit_customer').submit(function(e){
      e.preventDefault();
      $.ajax({
        type : 'POST',
        url : 'application/event_customer.php',
        data : $(this).serialize(),
        dataType : 'json',
        success : function(data){
          if (data.success) {
            toastr['success'](data.message);
            $('#detailUser').modal('hide');
            setTimeout(function(){window.location.replace('manage_pelanggan.php')},800);
            
          }
        }
      });
    })
    

  })
</script>
</body>
</html>
