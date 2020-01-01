<?php 
require 'application/system.php';
if (!$logged) {
  header("location:login.php");
}
if (!$isAdmin) {
  exit('Akses tidak diijinkan');
}
$penjualan = $system->list_trx_penjualan();
$menu = "laporan";
$menuItem = "penjualan_l";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$setting['nama_bisnis'];?> | Laporan Penjualan</title>

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
              <h1 class="m-0 text-dark">Laporan Penjualan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Laporan Penjualan</li>
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
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Laporan Penjualan</h3>
                  </div>
                </div>
                <div class="card-body">
                  <table id="tbl_penjualan" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Customer</th>
                        <th>Barang</th>
                        <th>Grand Total</th>
                        <th>Jumlah Bayar</th>
                        <th>Tanggal Transaksi</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($penjualan as $data): ?>
                        <?php 
                          //Customer
                          $id_cs = $data['id_customer'];
                          $customer = $system->detail_customer($id_cs);
                          //Barang
                          $trx_code = $data['trx_code'];
                          $barang_penjualan = $system->view_trx($trx_code);
                         ?>
                        
                      <tr>
                        <td><?php echo $customer['nama_lengkap']; ?><span class="badge badge-info"><?php echo $customer['role']; ?></span></td>
                        <td>
                          <ul>
                            <?php foreach ($barang_penjualan as $barang): ?>
                              <?php 
                                $id_barang = $barang['id_barang'];
                                $detail_barang = $system->get_detail_barang($id_barang);
                               ?>
                              <li><?=$detail_barang['nama_barang'];?> Rp.<?=number_format($barang['subharga'],0,',','.');?> @ <?=$barang['jumlah'];?> =  <?=$barang['subharga']*$barang['jumlah']?></li>
                                
                            <?php endforeach ?>
                          </ul>
                        </td>
                        <td>Rp. <?=number_format($data['total_harga'],0,',','.');?></td>
                        <td>Rp. <?=number_format($data['jumlah_bayar'],0,',','.');?></td>
                        <td><?=$data['tgl_transaksi']?></td>
                        <td>
                          <a title="Cetak" href="print.php?trx_code=<?=$data['trx_code'];?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-print"></i></a>
                        </td>
                      </tr>
                      <?php endforeach ?>
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

    <!-- Main Footer -->
    <?php include 'theme/footer.php'; ?>
  </div>
  <div class="modal fade" id="detailw">
    <div class="43-dialog">
      <div class="e-content">
        <div class="modal-header">
          <h4 class="modal-title">Laporan Penjualan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
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
    $('#tbl_penjualan').DataTable();
    //Get Detail
   

  })
</script>
</body>
</html>
