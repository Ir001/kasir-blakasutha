<?php 
require 'application/system.php';
if (!$logged) {
  header("location:login.php");
}
$data = $system->show_pelunasan();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$setting['nama_bisnis'];?> | Pelunasan</title>

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
              <h1 class="m-0 text-dark">Pelunasan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Pelunasan</li>
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
                    <h3 class="card-title">Daftar Pemesanan</h3>
                    <a href="pemesanan.php" class="btn btn-sm btn-success">Tambah</a>
                  </div>
                </div>
                <div class="card-body"> 
                  <table id="data_pelunasan" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nama Pemesan</th>
                        <th>Jenis Pesanan</th>
                        <th>File Desain</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Uang Muka</th>
                        <th>Status</th>
                        <th>Tanggal Jadi</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($data as $data): ?>
                        <?php 
                        $customer = $system->detail_customer($data['id_customer']);
                        ?>
                        <tr>
                          <td><?=ucwords($customer['nama_lengkap']);?></td>
                          <td><?=ucwords($data['jenis_pemesanan']);?></td>
                          <td><a href="<?=ltrim($data['file_desain'], "\.\.\/");?>" target="_blank"><img src="<?=ltrim($data['file_desain'], "\.\.\/");?>" class="img img-thumbnail" style="max-height: 100px" alt="<?=$data['jenis_pemesanan']?>"></a></td>
                          <td><?=$data['jumlah_pesanan']?></td>
                          <td><?=number_format($data['total_harga'],0,',','.');?></td>
                          <td><?=number_format($data['jumlah_bayar'],0,',','.');?></td>
                          <td>
                            <?php if ($data['status'] == "diproses"): ?>
                              <span class="badge badge-primary">Diproses</span>
                              <?php elseif($data['status'] == "selesai"): ?>
                                <span class="badge badge-success">Selesai</span>
                              <?php endif ?>
                            </td>
                            <td><?=$data['perkiraan_selesai'];?></td>
                            <td>
                              <form class="formBayar">
                                <input type="hidden" name="get_pelunasan" value="1">
                                <input type="hidden" class="code_trx" name="trx_code" value="<?=$data['trx_code'];?>">
                                <button type="submit" class="btn-bayar btn btn-success">Bayar</button>

                              </form>
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

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->


      <!-- Main Footer -->
      <?php include 'theme/footer.php'; ?>
    </div>
    <div class="modal fade" id="modalPelunasan">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Pelunasan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="bayarPesanan">
              <div class="form-group">
                <input type="hidden" name="pelunasan" value="1">
                <input type="hidden" name="trx_code" id="trx_code">
              </div>
              <div class="form-group">
                <label for="">Nama Pemesan</label>
                <input type="text" class="form-control" name="nama_pemesan" id="nama_pemesan" style="pointer-events:none" readonly>
              </div>
              <div class="form-group">
                <label for="">Grand Total</label>
                <input type="number" class="form-control" name="grand_total" id="grand_total" style="pointer-events:none" readonly>
              </div>
              <div class="form-group">
                <label for="">Kekurangan</label>
                <input type="number" class="form-control" name="kekurangan" id="kekurangan" style="pointer-events:none" readonly>
              </div>
              <div class="form-group">
                <label for="">Jumlah Bayar</label>
                <input type="hidden" name="dp" id="dp">
                <input type="number" class="form-control" name="jumlah_bayar" id="jumlah_bayar" placeholder="Nominal bayar" required>
              </div>
              <div class="form-group">
                <label for="">Kembalian</label>
                <input type="number" class="form-control" name="kembalian" id="kembalian" style="pointer-events:none" readonly>
              </div>
              <div class="form-group">
                <button type="submit" class="float-right btn btn-success">Bayar Pesanan</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </div>
    <?php include 'theme/src_foot.php'; ?>
    <script>
      $(function(){
        //Setup
        $.ajaxSetup({
          cache:false
        });
        $('#data_pelunasan').DataTable();
        //
        
        // From DataTable to Modal
        $('.formBayar').submit(function(e){
          e.preventDefault();
          //Ajax
          $.ajax({
            type : 'POST',
            url : 'application/event_pelunasan.php',
            data : $(this).serialize(),
            dataType : 'json',
            success : function(data){
              var nama_pemesan = data.nama_pemesan;
              var kekurangan = data.kekurangan;
              var total_harga = data.total_harga;
              var dp = data.jumlah_bayar;
              //Setter
              $('#nama_pemesan').val(nama_pemesan);
              $('#kekurangan').val(kekurangan);
              $('#grand_total').val(total_harga);
              $('#dp').val(dp);
              //Show the modal
              $('#modalPelunasan').modal('show');
            }
          });
          
          // Setter on Code Transaksi
          var code_trx = $(this).find('.code_trx').val();
          $('#trx_code').val(code_trx);

        })
        //From modal to process
        $('#bayarPesanan').submit(function(e){
          e.preventDefault();
          $.ajax({
            type : 'POST',
            url : 'application/event_pelunasan.php',
            data : $(this).serialize(),
            dataType : 'json',
            success : function(data){
              if (data.success) {
                toastr['success'](data.message);
                setTimeout(function(){window.open('print_pemesanan.php?trx_code='+data.trx_code+'&status=pelunasan', '_blank')},500);
                setTimeout(function(){window.location.href="pelunasan.php"},800);
              }else{
                toastr['error'](data.message);
              }
            }
          })
        })
















        //Function
        function check_kembalian(){
          $('#jumlah_bayar').keyup(function(){
            var kekurangan = parseInt($('#kekurangan').val());
            var jumlah_bayar = parseInt($('#jumlah_bayar').val());
            var kembalian = jumlah_bayar-kekurangan;
            $('#kembalian').val(kembalian);
          })
        }
        //Caller
        check_kembalian();
      })
    </script>
  </body>
  </html>
