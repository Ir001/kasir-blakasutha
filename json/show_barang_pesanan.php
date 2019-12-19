<?php 
require '../application/system.php';
?>
<table id="data_barang" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Nama Pesanan</th>
      <th>Harga Satuan</th>
      <th>Harga 1 Lusin</th>
      <th>Harga 2 Lusin</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
   <?php 
   $list_barang = $system->list_barang_pesanan();
   foreach ($list_barang as $list) {

    ?>
    <tr>
      <td><?=$list['nama_pesanan'];?></span></td>
      <td><?=number_format($list['harga_1'],0,',','.');?></td>
      <td><?=number_format($list['harga_2'],0,',','.');?></td>
      <td><?=number_format($list['harga_3'],0,',','.');?></td>
      <td>
        <form class="btn-edit">
          <input type="hidden" name="id_barang" value="<?=$list['id_barang'];?>">
          <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</button>
        </form>
        <form class="form-delete">
          <input type="hidden" name="delete_barang_pesanan" value="1">
          <input type="hidden" name="id" value="<?=$list['id_barang'];?>">
          <button type="submit" class="btn btn-delete btn-danger btn-sm"><i class="fa fa-remove"></i> Hapus</button>
        </form>
      </td>
    </tr>
  <?php } ?>
</tbody>
</table>
<!-- Modal Edit Barang -->
<div class="modal fade" id="edit_modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Barang</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="form_barang_edit">
                  <input type="hidden" name="edit_data_barang" value="1">
                  <input type="hidden" name="id_barang" id="id_barang">
                  <div class="form-group">
                    <label>Kode Barang:</label>
                    <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Kode">
                  </div>
                  <div class="form-group">
                    <label>Nama Barang:</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang"placeholder="Nama Barang" required>
                  </div>
                  <div class="form-group">
                    <label>Stok:</label>
                    <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok" required>
                  </div>
                  <div class="form-group">
                    <label>Harga Satuan:</label>
                    <input type="number" class="form-control" id="harga_1" name="harga_1" placeholder="Harga 1 lusin" required>
                  </div>
                  <div class="form-group">
                    <label>Harga 1 lusin:</label>
                    <input type="number" class="form-control" id="harga_2" name="harga_2" placeholder="Harga 1 lusin" required>
                  </div>
                  <div class="form-group">
                    <label>Harga 2 lusin:</label>
                    <input type="number" class="form-control" id="harga_3" name="harga_3" placeholder="Harga 2 lusin" required>
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
<!-- End of Modal -->
<script type="text/javascript">
    $('#data_barang').DataTable();
    $('.btn-delete').click(function(){
      if (confirm("Apakah anda yakin?")) {
        $('.form-delete').submit(function(e){
          e.preventDefault();
          $.ajax({
            type : 'POST',
            url : 'application/event.php',
            data : $(this).serialize(),
            dataType : 'json',
            success : function(data){
              if (data.success) {
                toastr['success'](data.message);
                window.$('#show-barang').load("json/show_barang_pesanan.php");
              }else{
                toastr['error'](data.message);
              }
            }
          })
        })
      }else{
        $('.form-delete').submit(function(e){
          e.preventDefault();
        })
      }
    })
</script>