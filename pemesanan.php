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
                  <button id="btn_user_plus" class="btn btn-sm btn-success">Tambah</button>
                </div>
              </div>
              <div class="card-body">
                <div id="load_customer"></div>
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
                  <h3 class="card-title">Keranjang Belanja</h3>
                  <!-- <a href="javascript:void(0);">Tambah</a> -->
                </div>
                <?php 
                  $customer = $system->get_info_customer();
                  // print_r($customer)
                  print_r($_SESSION);
                 ?>
                <div class="d-flex">
                  <p>Nama: </p>
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
                      <button id="btnBayar" class="float-right btn btn-success"><i class="fa fa-money-bill-wave"></i> Bayar</button>
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
  <?php include 'theme/footer.php'; ?>
</div>

      <div class="modal fade" id="paymentModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pembayaran Berhasil!</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="d-block">
                <div class="row">
                  <div class="col-6" style="line-height: 6px">
                    <p>Kode Trx : <b>jsdfn73dbf237</b></p>
                    <p>Customer : <b>Darjo</b></p>
                  </div>
                  <div class="col-6" style="line-height: 6px">
                    <p>Tanggal : <b><?php echo date('d/M/Y H:i') ?> WIB</b></p>                    
                    <p>Kasir : <b>Kasirnya Darjo</b></p>
                  </div>
                </div>
              </div>
              <table class="table table-striped">
                <tr>
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Qty</th>
                  <th>Satuan</th>
                  <th>Subtotal</th>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Oblong Putih</td>
                  <td>1</td>
                  <td>Rp.78.000</td>
                  <td class="float-right">Rp.78.000</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Oblong Hitam</td>
                  <td>3</td>
                  <td>Rp.50.000</td>
                  <td class="float-right">Rp.150.000</td>
                </tr>
                
              </table>
              <div class="row">
                <div class="offset-md-4 col-8" style="line-height: 5px;">
                  <p>Total: <span class="float-right">Rp.78.000</span></p>
                  <hr>
                  <p>Diskon: <span class="float-right">Rp.8.000</span></p>
                  <hr>
                  <p>Setelah Diskon: <span class="float-right">Rp.70.000</span></p>
                  <hr>
                  <p>Jumlah Bayar: <span class="float-right">Rp.100.000</span></p>
                  <hr>
                  <p>Kembalian: <span class="float-right">Rp.30.000</span></p>
                  <hr>
                </div>
              </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Cetak <i class="fa fa-copy"></i></button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
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
  $(function () {
    $("#data_pelanggan").DataTable();
    $('#data_barang').DataTable();
  });
  $('#btnBayar').click(function(){
    $('#paymentModal').modal('show');
  });
  $('#btn_user_plus').click(function(){
    $('#addUser').modal('show');
  });
  $('#form_user_add').submit(function(e){
    e.preventDefault();
    $.ajax({
      type : 'POST',
      url :'application/event.php',
      data: $('#form_user_add').serialize(),
      dataType : 'json',
      success : function(data){
        alert(data);
        if (data.success) {
          toastr['success'](data.message);
          $('#addUser').modal('hide');

        }else{
          toastr['error'](data.message)

        }
      }
    })
  })

  $(function(){
    $.ajaxSetup({
      cache:false
    });
    var loadUrl = "json/json_customer.php";
    setInterval(function(){
      $('#load_customer').load(loadUrl);
    }, 500)
  })
</script>
</body>
</html>
