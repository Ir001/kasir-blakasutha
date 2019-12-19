<?php 
require 'application/system.php';
if (!$logged) {
  header("location:login.php");
}
$type = @$_GET['type'] ? trim($_GET['type']) : 'all';
$pemasukan = $system->total_pemasukan($type);
$penjualan = $pemasukan['penjualan'];
$pemesanan = $pemasukan['pemesanan'];
$total = $pemasukan['total'];
//
$statistik_penjualan = $system->statistik_penjualan();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$setting['nama_bisnis'];?> | Balance</title>

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
              <h1 class="m-0 text-dark">Balance</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Balance</li>
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
              <form id="setting">
                <div class="form-group">
                  <label>Periode</label>
                  <select class="form-control" name="type" id="type">
                    <option value="all" <?php if (isset($_GET['type']) && $_GET['type'] == "all"): ?>
                    selected
                    <?php endif ?>>Semua</option>
                    <option value="week" <?php if (isset($_GET['type']) && $_GET['type'] == "week"): ?>
                    selected
                    <?php endif ?>>1 Minggu Terakhir</option>
                    <option value="month" <?php if (isset($_GET['type']) && $_GET['type'] == "month"): ?>
                    selected
                    <?php endif ?>>1 Bulan Terakhir</option>
                    <option value="year" <?php if (isset($_GET['type']) && $_GET['type'] == "year"): ?>
                    selected
                    <?php endif ?>>1 Tahun Terakhir</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="col-lg-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill-alt"></i></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Total Pemasukan</span>
                      <span class="info-box-number">
                        Rp. <?=number_format($total,0,',','.');?>
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </div>
               <!--  <div class="col-md-4">
                 <div class="info-box">
                   <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-bill-alt"></i></span>
                   <div class="info-box-content">
                     <div class="float-right"><a href="#"><small>Buat Pengeluaran</small></a></div>
                     <span class="info-box-text">Total Pengeluaran</span>
                     <span class="info-box-number">
                       Rp. 2.800.290
                     </span>
                   </div>
                   /.info-box-content
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="info-box">
                   <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-balance-scale"></i></span>
                   <div class="info-box-content">
                     <span class="info-box-text">Balance</span>
                     <span class="info-box-number">
                       Rp. 2.800.290
                     </span>
                   </div>
                   /.info-box-content
                 </div>
               </div> -->
              </div>
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Laporan Penjualan</h3>
                    <a href="javascript:void(0);">Lihat Laporan</a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex">
                    <p class="d-flex flex-column">
                      <span class="text-bold text-lg" id="terjual">2</span>
                      <span>Produk Terjual</span>
                    </p>
                  </div>
                  <!-- /.d-flex -->

                  <div class="position-relative mb-4">
                    <canvas id="chart-penjualan" height="200"></canvas>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Laporan Pemesanan</h3>
                    <a href="javascript:void(0);">Lihat Laporan</a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex">
                    <p class="d-flex flex-column">
                      <span class="text-bold text-lg">2</span>
                      <span>Terpesan</span>
                    </p>
                  </div>
                  <!-- /.d-flex -->

                  <div class="position-relative mb-4">
                    <canvas id="chart-penjualan" height="200"></canvas>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
              <!-- /.card -->
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

  <?php include 'theme/src_foot.php'; ?>
  <script src="plugins/chart.js/Chart.min.js"></script>
  <script type="text/javascript">
    var ctx = $('#chart-penjualan');
    var data = {
      labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', ' November', 'Desember'],
      datasets: [{
        label: 'Produk Terjual',
        data: [
        
        <?php 
        for ($i=1; $i <= 12 ; $i++) { 
          echo $statistik_penjualan[$i].",";
        }
        ?>

        ],
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

    $('#type').change(function(){
      var type = $('#type').val();
      window.location.href="balance.php?type="+type;
    })
  </script>

</body>
</html>
