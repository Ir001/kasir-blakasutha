<?php   
require '../application/system.php';
$trx_code = @$_SESSION['trx_code'];
$harga_tambahan = $system->get_harga_tambahan($trx_code);
$harga_desain = $system->get_harga_desain($trx_code);
?>
<div class="card">
  <div class="card-body">
    <?php 
    $customer = $system->get_info_customer();
    ?>
    <div class="float-right">
      <form id="reset_user">
        <input type="hidden" name="reset_user" value="1">
        <button type="submit" class="btn btn-sm btn-danger">Reset User</button>
      </form>
    </div>
    <h6>Detail Customer:</h6>
    <hr>
    <div style="line-height: 6px">
      <p>Nama: <h2><?=$customer['nama_lengkap'];?>
      <?php if ($customer['role'] == "customer"): ?>
        <span class="badge badge-lg badge-info"><?=ucwords($customer['role']);?></span>
        <?php else: ?>
          <span class="badge badge-lg badge-warning text-white"><?=ucwords($customer['role']);?></span>
        <?php endif ?>

      </h2></p>
      <p>Nomor Telepon: <?=$customer['phone'];?></p>
    </div>
    <hr>
    <div style="line-height: 6px">
     <form id="reset_cart">
      <input type="hidden" name="reset_cart_pesanan" value="1">
      <button type="submit" id="reset_cart_btn" class="float-right btn btn-sm btn-danger">Hapus Semua</button>
    </form>
    <h6>Rincian</h6>
  </div>

  <table id="data_pemesanan" class="mt-5 table table-bordered table-striped">
    <thead>
      <tr>
        <th>Ukuran</th>
        <th>Jumlah</th>
        <th>Subharga</th>
        <th>Total</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
     <?php 
     $cart = @$_SESSION['cart_pemesanan'];
     $id_customer = @$_SESSION['id_customer'];
     $customer = $system->get_info_customer($id_customer);
     if(!empty($_SESSION['cart_pemesanan'])){
      foreach ($cart as $id => $jumlah) {
        $data = $system->detail_barang_pesanan($id);
        if($jumlah > 12){
          if($customer['role'] == "reseller"){
            $harga = $data['harga_2']-10000;
            $total = $harga*$jumlah;
          }else{
           $harga = $data['harga_2'];
           $total = $harga*$jumlah;
         }
       }elseif ($jumlah > 24) {
        if($customer['role'] == "reseller"){
          $harga = $data['harga_3']-10000;
          $total = $harga*$jumlah;
        }else{
         $harga = $data['harga_3'];
         $total = $harga*$jumlah;
       }
     }else{
      if($customer['role'] == "reseller"){
        $harga = $data['harga_1']-10000;
        $total = $harga*$jumlah;
      }else{
        $harga = $data['harga_1'];
        $total = $harga*$jumlah;
      }
    }
    ?>
    <tr>
      <td><?=$data['length']." (".$data['ukuran'].")";?></td>
      <td><?=number_format($jumlah,0,',','.');?></td>
      <td><?=$harga;?></td>
      <td><?=$total;?></td>
      <td>
        <form class="edit_cart">
          <input type="hidden" name="edit_cart" value="1">
          <input type="hidden" name="id" class="id" value="<?=$id;?>">
          <input type="hidden" name="nama_pesanan" class="nama_pesanan" value="<?=$data['length']." (".$data['ukuran'].")";?>">
          <input type="hidden" name="jumlah" class="jumlah" value="<?=$jumlah;?>">
          <button type="submit" class="btn btn-sm btn-success" title="Edit"><i class="fa fa-pen"></i></button>
        </form>
        <form class="delete_cart">
          <input type="hidden" name="delete_cart" value="1">
          <input type="hidden" name="id" value="<?=$id;?>">
          <button type="submit" class="delete_btn btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
        </form>
      </td>
    </tr> 
    <?php @$total_semua+=$total; ?>
    <?php @$jumlah_semua+=$jumlah; ?>
  <?php }} ?>              
</tbody>
</table>
<form id="form_bayar">
  <input type="hidden" name="form_bayar_pesanan" value="1">
  <input type="hidden" id="trx_code_1" name="trx_code">
  <input type="hidden" name="id_customer" value="<?=$customer['id_customer'];?>">
  <div class="form-group">
    <label>Jumlah Pesanan</label>
    <input type="number" class="form-control" name="jumlah_pesanan" id="jumlah_pesanan" style="pointer-events:none" value="<?=@$jumlah_semua?>" readonly></input>
  </div>
  <div class="form-group">
    <label>Harga Lainnya</label>
    <input type="number" class="form-control" value="<?=@$harga_tambahan?>" disabled></input>
  </div>
   <div class="form-group">
    <label>Biaya Desain</label>
    <input type="number" class="form-control" value="<?=@$harga_desain?>" disabled></input>
  </div>
  <div class="form-group">
    <label>Grand Total</label>
    <input type="number" class="form-control" name="total_harga" id="total_harga" style="pointer-events:none" value="<?=@$total_semua+$harga_tambahan+$harga_desain?>" readonly></input>
  </div>
  <div class="form-group">
    <label>Harga 50%</label>
    <input type="number" class="form-control" name="harga_setengah" id="harga_setengah" style="pointer-events:none" value="<?=@$total_semua?>" readonly></input>
  </div>
  <div class="form-group">
    <label>Jumlah Bayar</label>
    <input type="hidden" name="kekurangan" id="kekuranan_check"></input>
    <input type="number" class="form-control" name="total_bayar" id="total_bayar" min="0"></input>
    <label id="check_cash"></label>
    <input type="number" class="form-control" name="kembalian" id="kembalian" min="0" style="pointer-events:none" readonly></input>
  </div>
  <button class="mt-3 float-right btn btn-success">Buat Pesanan</button>
</form>
<form id="batalkan">
  <input type="hidden" name="batalkan_pesanan" value="1">
  <button type="submit" class="mt-3 btn-cancel float-left btn btn-danger">Batalkan</button>
</form>

</div>
</div>
<div class="modal fade" id="modalEdit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Keranjang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
        <form id="editForm">
          <input type="hidden" name="edit_cart" value="1">
          <input type="hidden" name="id" id="idForm">
          <div class="form-group">
            <label for="">Nama Barang</label>
            <input type="text" id="namaForm" class="form-control" disabled="">
          </div>
          <div class="form-group">
            <label for="">Quantity</label>
            <input type="number" name="jumlah" id="quantityForm" class="form-control" min="0" required="">
          </div>
          <div class="form-group">
            <button type="submit" class="float-right btn btn-success">Ubah</button>
          </div>
        </form>              

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<script type="text/javascript">
  var total_harga = parseInt($('#total_harga').val());

  $('#harga_setengah').val(total_harga*50/100);
  $('#check_cash').append('Kembalian');
  $('#total_bayar').keyup(function(){
    var total = parseInt($('#total_harga').val());
    var jumlah_bayar = parseInt($('#total_bayar').val());
    var kembalian = jumlah_bayar-total;
    if (kembalian < 0) {
      $('#check_cash').html('Kekurangan');
      $('#kekuranan_check').val(true);
    }else{
      $('#check_cash').html('Kembalian');
      $('#kekuranan_check').val(false);
    }
    $('#kembalian').val(kembalian);
  });

  //Kekurangan Check

  $('#reset_user').submit(function(e){
    e.preventDefault();
    $.ajax({
      type : 'POST',
      url : 'application/event.php',
      data : $('#reset_user').serialize(),
      dataType : 'json',
      success : function(data){
        alert(data.message);
        if (data.success) {
          window.$('#show-customer').show();
          window.$('#show-content').hide();
          window.$('#load-cart').load("json/cart_pemesanan.php");
          toastr['success'](data.message);
        }else{
          toastr['error'](data.message);
        }
      }
    })
  });
  $('#reset_cart_btn').click(function(){
    if (confirm('Apakah anda yakin?')) {
      $('#reset_cart').submit(function(e){
        e.preventDefault();
        $.ajax({
          type : 'POST',
          url : 'application/event.php',
          data : $('#reset_cart').serialize(),
          dataType : 'json',
          success : function(data){
            if (data.success) {
              window.$('#load-cart').load("json/cart_pemesanan.php");
              toastr['success'](data.message);
            }else{
              toastr['error'](data.message);
            }
          }
        })
      });

    }else{
     $('#reset_cart').submit(function(e){
      e.preventDefault();
    });
   }
 });
  <?php if (isset($_SESSION['trx_code'])) { ?>
    var trx_code = '<?php echo $_SESSION['trx_code'] ?>';
  <?php }else{ ?>
    var trx_code = window.trx_code;
  <?php } ?>
  $('#trx_code_1').val(trx_code);
  //
  $('#form_bayar').submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url : 'application/event_pemesanan.php',
      data : $('#form_bayar').serialize(),
      dataType : 'json',
      success : function(data){
        if (data.success) {
          toastr['success'](data.message);
          setTimeout(function(){
            window.location.href="pemesanan.php";
          }, 1000);
          setTimeout(function(){
            window.open('print_pemesanan.php?trx_code='+data.trx_code, '_blank');
          }, 800);
        }
      }
    })
  })

  ///

  $('.btn-cancel').click(function(){
    if (confirm('Apakah anda yakin?')) {
      $('#batalkan').submit(function(e){
        e.preventDefault();
        $.ajax({
          type : 'POST',
          url : 'application/event_pemesanan.php',
          data : $('#batalkan').serialize(),
          dataType : 'json',
          success : function(data){
            if (data.success) {
              toastr['success'](data.message);
              window.location.href="pemesanan.php";
            }else{
              toastr['error'](data.message);
            }
          }
        })
      });

    }else{
     $('#batalkan').submit(function(e){
      e.preventDefault();
    });
   }
 });



  // Edit
  $('.edit_cart').submit(function(e){
    e.preventDefault();
    var idForm = $('#idForm');
    var namaForm = $('#namaForm');
    var quantityForm = $('#quantityForm');
    /*                                  */
    var id = $(this).find('.id').val();
    var nama_pesanan = $(this).find('.nama_pesanan').val();
    var jumlah = $(this).find('.jumlah').val();
    //
    idForm.val(id);
    namaForm.val(nama_pesanan);
    quantityForm.val(jumlah);

    $('#modalEdit').modal('show');

  });
  $('#editForm').submit(function(e){
    e.preventDefault();
    $('#modalEdit').modal('hide');
    $.ajax({
      type : 'POST',
      url : 'application/event_pemesanan.php',
      data : $(this).serialize(),
      dataType : 'json',
      success : function (data){
        if (data.success) {
         window.$('#load-cart').load("json/cart_pemesanan.php");
         toastr['success'](data.message);
       }else{
         toastr['error'](data.message);

       }
     }
   })
  })
  $('.delete_btn').click(function(){
    if (confirm('Apakah anda yakin?')) {
      $('.delete_cart').submit(function(e){
        e.preventDefault();
        $.ajax({
          type : 'POST',
          url : 'application/event_pemesanan.php',
          data : $(this).serialize(),
          dataType : 'json',
          success : function(data){
            if (data.success) {
              window.$('#load-cart').load('json/cart_pemesanan.php');
              toastr['success'](data.message);
            }else{
              toastr['error'](data.message);
            }
          }
        })
      });

    }else{
     $('.delete_cart').submit(function(e){
      e.preventDefault();
    });
   }
 });
</script>
