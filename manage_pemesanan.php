<?php 
require 'application/system.php';
if (!$logged) {
  header("location:login.php");
}
/**/
if (!$isAdmin) {
  exit('Akses tidak diijinkan');
}
$menu = "management";
$menuItem = "pemesanan_m";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$setting['nama_bisnis'];?> | Manage Pemesanan</title>

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
                        <th>Model Baju</th>
                        <th>File Desain</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Tgl Trx</th>
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
                          <td><?=$customer['nama_lengkap'];?> 
                          <?php if ($customer['role'] == "customer"): ?>
                            <span class="badge badge-sm badge-info"><?=ucwords($customer['role']);?></span>
                            <?php else: ?>
                              <span class="badge badge-sm badge-warning text-white"><?=ucwords($customer['role']);?></span>
                            <?php endif ?>
                          </td>
                          <td><?=ucwords($list['jenis_pemesanan']);?></td>
                          <td><?=ucwords($list['jenis_sablon']);?></td>
                          <td><?=@$list['model_baju'] ? ucwords($list['model_baju']) : "-";?></td>
                          <td>
						  <?php
						   $file_desain = ltrim($list['file_desain'], "\.\.\.\/");
							if (file_exists("$file_desain")):
							
							
						  ?>
						  <a target="_blank" href="<?=$file_desain;?>" class="btn btn-sm btn-info"><i class="fa fa-download"></i> Download</a>
						  <?php else: ?>
						  <span class="badge badge-danger">File belum ada.</span>
						  <form class="upload">
						  <input type="hidden" name="trx_code" value="<?=$list['trx_code'];?>">
						  <input type="hidden" name="edit_file_desain">
						  <input type="file" name="file_desain">
						  <button type="submit" class="btn btn-sm btn-primary text-center">Upload</button>
						  </form>
						  <?php endif; ?>
						  </td>
                          <td><?=$list['deskripsi'];?></td>
                          <td>
                            <?php if ($list['status'] == "diproses"): ?>
                              <span class="badge badge-info"><?=ucwords($list['status']);?></span>
                              <?php else: ?>
                                <span class="badge badge-success"><?=ucwords($list['status']);?></span>
                              <?php endif ?>
                          </td>
                          <?php
                            $tgl = explode(" ", $list['tgl_transaksi']);
                            $jam = explode(":", $tgl[1]);
                            $jam_menit = $jam[0].":".$jam[1];
                          ?>
                          <td><?=$tgl[0]." Pkl ".$jam_menit?></td>

                            <td class="d-flex">
                              <form class="detail_pemesanan">
                                <input type="hidden" name="detail_pemesanan" value="1"> 
								<input type="hidden" name="upload_file" value="1">
                                <input type="hidden" name="trx_code" value="<?=$list['trx_code'];?>"> 
                                <button type="submit" title="Detail" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button>
                              </form>
                              |
                              <form class="edit_pemesanan">
                                <input type="hidden" name="edit_pemesanan" value="1"> 
                                <input type="hidden" name="trx_code" class="trx_code_edit" value="<?=$list['trx_code'];?>"> 
                                <input type="hidden" name="status" class="status_edit" value="<?=$list['status'];?>"> 
                                <button type="submit" title="Edit" class="btn btn-sm text-white btn-warning"><i class="fa fa-pen"></i></button>
                              </form>
                              |
                              <form class="hapus_pemesanan">
                                <input type="hidden" name="hapus_pemesanan" value="1"> 
                                <input type="hidden" name="trx_code" class="trx_code_edit" value="<?=$list['trx_code'];?>"> 
                                <button type="submit" title="Delete" class="btn btn-delete btn-sm  btn-danger"><i class="fa fa-trash"></i></button>
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
	$('.upload').submit(function(e){
		e.preventDefault();
		var formData = new FormData(this);
		$.ajax({
			url: 'application/event_pemesanan.php',
			type: 'POST',
			data: formData,
			dataType: 'json',
			success: function (data) {
				if(data.success){
					toastr['success'](data.message);
					setTimeout(function(){window.location.reload()}, 500);
				}else{
					toastr['error'](data.message);
				}
			  
		  },
		  cache: false,
		  contentType: false,
		  processData: false
		});
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
            setTimeout(function(){window.location.reload()},500);
          }else{
            toastr['error'](data.message);
          }
        }
      })

    })
    $('.btn-delete').click(function(){
      if (confirm('Apakah anda yakin?')) {
        $('.hapus_pemesanan').submit(function(e){
          e.preventDefault();
          $.ajax({
            type : 'POST',
            url : 'application/event_pemesanan.php',
            data : $(this).serialize(),
            dataType : 'json',
            success : function(data){
              if (data.success) {
                toastr['success'](data.message);
                setTimeout(function(){window.location.reload()},800);
              } else {
                toastr['error'](data.message);
              }
            }
          })
        });
      } else {
        $('.hapus_pemesanan').submit(function(e){
          e.preventDefault();
        });
      }
    });

  })
</script>
</body>
</html>
