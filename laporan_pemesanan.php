<?php 
require 'application/system.php';
if (!$logged) {
  header("location:login.php");
}
$data = $system->list_trx_penjualan();
$menu = "laporan";
$menuItem = "pemesanan_l";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$setting['nama_bisnis'];?> | Laporan Pemesanan</title>

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
              <h1 class="m-0 text-dark">Laporan Pemesanan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Laporan Transaksi</li>
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
            <!-- Laporan -->
            <div class="col-lg-12">
              <div class="card" id="hide-customer">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Daftar Laporan Penjualan</h3>
                  </div>
                </div>
                <div class="card-body">
                  <table id="data_barang" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php
                       $no = 1; 
                       foreach ($data as $data):
                        $customer = $system->detail_customer($data['id_customer']);
                        ?>
                        <tr>
                          <td><?=$no;?></span></td>
                          <td><?=$customer['nama_lengkap'];?></td>
                          <td>Rp. <?=number_format($data['total_harga'],0,',','.');?></td>
                          <td><?=$data['tgl_transaksi'];?></td>
                          <td>
                            <!-- <button class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</button> -->
                            <button trx_code="<?=$data['trx_code'];?>" class="btn-cetak btn btn-primary btn-sm"><i class="fa fa-print"></i> Cetak</button>
                          </td>
                        </tr>
                        <?php $no++; ?>
                      <?php endforeach; ?> 

                      
                    </tbody>
                  </table>
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
          <form id="form_user_add">
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
              <label>Harga Selusin:</label>
              <input type="number" class="form-control" name="harga_1" placeholder="Harga 1 lusin" required>
            </div>
            <div class="form-group">
              <label>Harga 2 lusin:</label>
              <input type="number" class="form-control" name="harga_2" placeholder="Harga 2 lusin" required>
            </div>
            <div class="form-group">
              <label>Harga 3 lusin:</label>
              <input type="number" class="form-control" name="harga_3" placeholder="Harga 3 lusin" required>
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

    //
    $('.btn-cetak').click(function(){
      var trx_code = $('.btn-cetak').attr('trx_code');
      window.open('print.php?trx_code='+trx_code);
    })

  })
</script>
<script src="plugins/chart.js/Chart.min.js"></script>

<script type="text/javascript">
  var ctx = $('#chart-penjualan');
  var data = {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', ' November', 'Desember'],
        datasets: [{
            label: 'Produk Terjual',
            data: [12, 19, 3, 5, 2, 3, 15, 9, 21, 8, 3, 12],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    };
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: data,

});
</script>

</body>
</html>
