<?php 
require '../application/system.php';
$type = @$_SESSION['type'] ? $_SESSION['type'] : 'all';
?>
<?php if (isset($_SESSION['id_customer'])): ?>
  <p>Type : <b><?=$type;?>s</b></p>
  <table id="data_barang" class="table table-bordered table-striped">
    <thead>
      <tr> 
        <th>Lengan</th>
        <th>Ukuran</th>
        <th>Harga</th>
        <th>Opsi</th>
      </tr>
    </thead>
    <tbody>
     <?php 
     $list_barang = $system->list_barang_pesanan($type);
     foreach ($list_barang as $list) {

      ?>
      <tr>
        <td><?=$list['length'];?></span></td>
        <td><?=$list['ukuran'];?></span></td>
        <td>
          <ul style="margin-left: -5px">
            <li>1pcs: Rp.<?=number_format($list['harga_1'],0,',','.');?></li>
            <li>12pcs: Rp.<?=number_format($list['harga_2'],0,',','.');?></li>
            <li>24pcs: Rp.<?=number_format($list['harga_3'],0,',','.');?></li>
          </ul>
        </td>
        <td>
          <form class="add_to_cart">
            <input type="hidden" name="add_barang_pesanan" value="1"> 
            <input type="hidden" name="id" value="<?=$list['id_barang'];?>"> 
            <input type="number" style="width: 50%" class="jmlh float-left form-control" name="jumlah" value="1" min="0" max="<?=$list['stok'];?>">
            <button type="submit" class="btn float-right btn-add btn-lg btn-success"><i class="fa fa-cart-plus"></i></button>
          </form>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<script>
  var loadUrl1 = "json/cart_pemesanan.php";

  $('#data_barang').DataTable({
    "pagination" : false,
    "lengthMenu": [[16, 10, 50, -1], [16, 10, 50, "All"]],
    "fnDrawCallback": function( oSettings ) {
            // Write any code (also ajax code that you want to execute)
            // that you want to be executed after 
            // the table has been redrawn
            

          }
        });
  
  $('.jmlh').click(function(){
    $(this).select();
  });
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
</script>
<?php endif ?>
