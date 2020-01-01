<?php 
require '../application/system.php';
?>
<table id="data_barang" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Type</th>
      <th>Lengan</th>
      <th>Ukuran</th>
      <th>Harga Satuan</th>
      <th>Harga 1 Lusin</th>
      <th>Harga 2 Lusin</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
   <?php 
   $type = @$_GET['type'] ? trim($_GET['type']) : 'all';
    if (isset($_GET['type']) && $_GET['type'] == "30") {
       $list_barang = $system->list_barang_pesanan($type);
    }elseif(isset($_GET['type']) && $_GET['type'] == "24"){
       $list_barang = $system->list_barang_pesanan($type);
    }else{
       $list_barang = $system->list_barang_pesanan($type);
    }
   foreach ($list_barang as $list) {

    ?>
    <tr>
      <td><?=$list['type'];?>s</span></td>
      <td><?=$list['length'];?></span></td>
      <td><?=$list['ukuran'];?></span></td>
      <td><?=number_format($list['harga_1'],0,',','.');?></td>
      <td><?=number_format($list['harga_2'],0,',','.');?></td>
      <td><?=number_format($list['harga_3'],0,',','.');?></td>
      <td>
        <form class="btn-edit">
          <input type="hidden" name="edit_barang_pemesanan" value="1">
          <input type="hidden" name="id" value="<?=$list['id_barang'];?>">
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
        <h4 class="modal-title">Edit Barang Pemesanan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_barang_edit">
          <input type="hidden" name="edit_data_barang_pemesanan" value="1">
          <input type="hidden" name="id_barang" id="id_barang">
           <div class="form-group">
            <label>Length:</label>
            <div class="radio">
              <label id="panjang">
                <input id="panjang" type="radio" class="length" name="length" value="Panjang">
                Panjang
              </label>
              <label id="pendek">
                <input id="pendek" type="radio" class="length" name="length" value="Pendek">
                Pendek
              </label>
            </div>
          </div>
          <div class="form-group">
            <label>Type Kaos:</label>
            <div class="radio">
              <label id="type-30">
                <input id="type-30" type="radio" class="type" name="type" value="30">
                Type 30
              </label>
              <label id="type-24">
                <input id="type-24" type="radio" class="type" name="type" value="24">
                Type 24
              </label>
            </div>
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
    $('#data_barang').DataTable({
      "fnDrawCallback": function( oSettings ) {
        // componentHandler.upgradeDOM();
        $('.btn-delete').click(function(){
          if (confirm("Apakah anda yakin?")) {
            $('.form-delete').submit(function(e){
              e.preventDefault();
              $.ajax({
                type : 'POST',
                url : 'application/event_barang_pemesanan.php',
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
        });
        // Edit Form
        var id_barang = $('#id_barang');
        var length = $('.length');
        var ukuran = $('.ukuran');
        var harga_1 = $('#harga_1');
        var harga_2 = $('#harga_2');
        var harga_3 = $('#harga_3');
        $('.btn-edit').submit(function(e){
          e.preventDefault();
          $.ajax({
            type : 'POST',
            url : 'json/json_edit.php',
            data : $(this).serialize(),
            dataType : 'json',
            success : function(data){
              if(data.length == "Panjang"){
                setRadio('length','Panjang');
              }else if(data.length == "Pendek"){
                setRadio('length', 'Pendek');
              }
              /*
                Type
              */
              if(data.type == "30"){
                setRadio('type', '30');
              }else if(data.type == "24"){
                setRadio('type', '24');
              }
              id_barang.val(data.id_barang);
              harga_1.val(data.harga_1);
              harga_2.val(data.harga_2);
              harga_3.val(data.harga_3);
              $('#edit_modal').modal('show');
            }
          })
        });

        /*
          Edit Barang Form
        */
        $('#form_barang_edit').submit(function(e){
          e.preventDefault();
          $('#edit_modal').modal('hide');
          $.ajax({
            type : 'POST',
            url : 'application/event_barang_pemesanan.php',
            data : $(this).serialize(),
            dataType : 'json',
            success : function(data){
              if(data.success){
                var value = <?=@$_GET['type'] ? $_GET['type'] : 'all'?>;
                window.$('#show-barang').empty();
                window.$('#show-barang').load("json/show_barang_pesanan.php?type="+value);
                toastr['success'](data.message);
              }else{
                toastr['error'](data.message);
              }
            }
          })
        })


        /*
          Function
        */
        function setRadio(name, value){
          $('input[name="'+name+'"][value="'+value+'"]').prop('checked', true);
        }
        

      }

    });
  </script>