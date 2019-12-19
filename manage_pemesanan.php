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
              <h1 class="m-0 text-dark">Manage Pemesanan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Manage Pemesanan</li>
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
                  <table id="tb_pemesanan" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Customer</th>
                        <th>Jenis</th>
                        <th>Sablon</th>
                        <th>File Desain</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Aksi</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $list_trx_pemesanan = $system->list_trx_pemesanan();
                      foreach ($list_trx_pemesanan as $list) {
                        $id = $list['id_customer'];
                        $customer = $system->detail_customer($id);
                        ?>
                        <tr>
                          <td><?=$customer[0]['nama_lengkap'];?> <span class="badge badge-sm badge-info"><?=ucwords($customer[0]['role']);?></span></td>
                          <td><?=ucwords($list['jenis_pemesanan']);?></td>
                          <td><?=$list['jenis_sablon'];?></td>
                          <td><img src="<?=ltrim($list['file_desain'], "\.\.\.\/");?>" class="img img-thumbnail" style="max-width: 100px" alt="<?=$list['jenis_pemesanan'];?>"></td>
                          <td><?=$list['deskripsi'];?></td>
                          <td>
                            <?php if ($list['status'] == "diproses"): ?>
                              <span class="badge badge-info"><?=ucwords($list['status']);?></span>
                              <?php else: ?>
                                <span class="badge badge-success"><?=ucwords($list['status']);?></span>
                              <?php endif ?>
                            </td>
                            <td class="d-flex">
                              <form class="detail_pemesanan">
                                <input type="hidden" name="detail_pemesanan" value="1"> 
                                <input type="hidden" name="trx_code" value="<?=$list['trx_code'];?>"> 
                                <button type="submit" title="Detail" class="btn btn-sm btn-info">Detail</button>
                              </form>
                              |
                              <form class="edit_pemesanan">
                                <input type="hidden" name="edit_pemesanan" value="1"> 
                                <input type="hidden" name="trx_code" class="trx_code_edit" value="<?=$list['trx_code'];?>"> 
                                <input type="hidden" name="status" class="status_edit" value="<?=$list['status'];?>"> 
                                <button type="submit" title="Edit" class="btn btn-sm btn-warning">Edit</button>
                              </form>
                            </td>
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

      <!-- Main Footer -->
      <?php include 'theme/footer.php'; ?>
    </div>
    <?php include 'theme/src_foot.php'; ?>

    <div id="response"></div>
    <div class="modal fade" id="editModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Pesanan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="editForm">
              <input type="hidden" name="edit_status" value="1">
              <input type="hidden" name="trx_code" id="editTrx">
              <div class="form-group">
                <label for="">Status</label>
                <select name="status" id="editStatus" class="form-control">
                  <option value="diproses">Diproses</option>
                  <option value="selesai">Selesai</option>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="float-right btn btn-success">Simpan</button>
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
    $('#tb_pemesanan').DataTable();
    //Get Detail
    $('.detail_pemesanan') .submit(function(e){
      e.preventDefault();
      $('#detailModal').modal('show');
      $.ajax({
        type : 'POST',
        url : 'json/view_detail_pemesanan.php',
        data : $(this).serialize(),
        success : function(data){
          $('.show').remove();
          $('#response').empty();
          setTimeout(function(){
            $('#response').html(data);
            $('#response').find('#detailModal').modal('show');
          },800);
        }
      })
    }) 
    $('.edit_pemesanan').submit(function(e){
      e.preventDefault();
      //Getter
      var trx_code = $(this).find('.trx_code_edit').val();
      var status = $(this).find('.status_edit').val();
      //Setter
      $('#editTrx').val(trx_code);
      $('#editStatus').val(status);
      //
      $('#editModal').modal('show');

    });
    $('#editForm').submit(function(e){
      e.preventDefault();
      $.ajax({
        type : 'POST',
        url : 'application/event_pemesanan.php',
        data : $(this).serialize(),
        dataType : 'json',
        success : function(data){
          if (data.success) {
            toastr['success'](data.message);
            $('#editModal').modal('hide');
            $('#editTrx').val('');
            $('#editStatus').val('');
            setTimeout(function(){window.location.replace('manage_pemesanan.php')},500);
          }else{
            toastr['error'](data.message);
          }
        }
      })

    })

  })
</script>
</body>
</html>