<?php 
require '../application/system.php';
?>
<?php if (isset($_SESSION['id_customer'])): ?>

  <table id="data_barang" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Harga Satuan</th>
        <th>Harga 1 Lusin</th>
        <th>Harga 2 Lusin</th>
        <!-- <th>Jumlah</th> -->
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
          <form class="add_to_cart">
            <input type="hidden" name="add_barang_pesanan" value="1"> 
            <input type="hidden" name="id" value="<?=$list['id_barang'];?>"> 
            <input type="number" class="jmlh form-control" name="jumlah" value="1" min="0" max="<?=$list['stok'];?>">
            <button type="submit" class="btn btn-add btn-sm btn-success"><i class="fa fa-cart-plus"></i></button>
          </form>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<script>
  var loadUrl1 = "json/cart_pemesanan.php";

  $('#data_barang').DataTable({
    "lengthMenu": [[3, 10, 50, -1], [3, 10, 50, "All"]],
    "fnDrawCallback": function( oSettings ) {

            // Write any code (also ajax code that you want to execute)
            // that you want to be executed after 
            // the table has been redrawn
            $('.add_to_cart').submit(function(e){
              e.preventDefault();
              $.ajax({
                type : 'POST',
                url : 'application/event.php',
                data : $(this).serialize(),
                dataType : 'json',
                success : function (data){
                  if (data.success) {
                    toastr['success'](data.message);
                    window.$('#load-cart').load(loadUrl1);
                  }else{
                    toastr['error'](data.message);

                  }
                }
              })
            })             

          }
        });
 
  $('.jmlh').click(function(){
    $(this).select();
  });
</script>
<?php endif ?>