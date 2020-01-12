<?php 
require '../application/system.php';
?>
<div class="">
  <div class="card ">
    <div class="card-header border-0">
      <div class="d-flex justify-content-between">
        <h3 class="card-title">Keranjang Belanja</h3>
        <!-- <a href="javascript:void(0);">Tambah</a> -->
      </div>
      <?php 
      $customer = $system->get_info_customer();
      ?><div class="float-right">
        <form id="reset_user">
          <input type="hidden" name="reset_user" value="1">
          <button type="submit" class="btn btn-sm btn-danger">Reset User</button>
        </form>
      </div>
      <h6>Detail Customer:</h6>
      <hr>
      <div>
        <p>Nama: <h2><?=$customer['nama_lengkap'];?>
        <?php if ($customer['role'] == "customer"): ?>
          <span class="badge badge-sm badge-info"><?=ucwords($customer['role']);?></span>
          <?php else: ?>
            <span class="badge badge-sm badge-warning text-white"><?=ucwords($customer['role']);?></span>
          <?php endif ?>
        </h2></p>
        <p>Instagram: <?=$customer['instagram'];?></p>
        <p>Nomor Telepon: <?=$customer['phone'];?></p>
      </div>

    </div>
    <div class="card-body">
      <!-- <div class="d-flex"> -->
        <div class="row" style="margin-top: -25px">
          <div class="col-md-12">
           <?php if (isset($_SESSION['cart'])): ?>
            <form id="reset_cart">
              <input type="hidden" name="reset_cart" value="1">
              <button type="submit" id="reset_cart_btn" class="float-right btn btn-sm btn-danger">Bersihkan Keranjang <i class="fa fa-cart-minus"></i></button>
            </form>
          <?php endif ?>
          <table id="data_pelanggan" class="mt-5 table table-responsive table-bordered table-striped">
            <thead>
              <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Quantity</th>
                <th>Subharga</th>
                <th>Harga</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $cart = @$_SESSION['cart'];
              $id_customer = @$_SESSION['id_customer'];
              $customer = $system->get_info_customer($id_customer);
              if(!empty($_SESSION['cart'])){
                foreach ($cart as $id => $jumlah) {
                  $data = $system->get_info_barang($id);
                  if($jumlah > 12){
                    if($customer['role'] == "reseller"){
                      $harga = $data['harga_2']-$data['harga_2']*10/100;
                      $total = $harga*$jumlah;

                    }else{
                     $harga = $data['harga_2'];
                     $total = $harga*$jumlah;
                   }

                 }elseif ($jumlah > 24) {
                  if($customer['role'] == "reseller"){
                    $harga = $data['harga_3']-$data['harga_3']*10/100;
                    $total = $harga*$jumlah;

                  }else{
                   $harga = $data['harga_3'];
                   $total = $harga*$jumlah;
                 }
               }else{
                if($customer['role'] == "reseller"){
                  $harga = $data['harga_1']-$data['harga_1']*10/100;
                  $total = $harga*$jumlah;

                }else{
                 $harga = $data['harga_1'];
                 $total = $harga*$jumlah;
               }
             }
             ?>
             <tr>
              <td><?=$data['kode_barang'];?></td>
              <td><?=$data['nama_barang'];?></td>
              <td><?=number_format($jumlah,0,',','.');?></td>
              <td><?=$harga;?></td>
              <td><?=$total;?></td>
              <td>
                <form class="edit_cart">
                  <input type="hidden" name="id" class="id" value="<?=$id;?>">
                  <input type="hidden" name="kode_barang" class="kode_barang" value="<?=$data['kode_barang'];?>">
                  <input type="hidden" name="nama_barang" class="nama_barang" value="<?=$data['nama_barang'];?>">
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
          <?php }} ?>                   
        </tbody>
      </table>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
      <form id="form_bayar">
        <div class="form-group">
          <div class="row">
            <div class="col-12">
              <label>Total:</label>
              <input type="hidden" name="form_bayar" value="1">
              <input type="hidden" name="trx_code" value="<?=$system->generate_trx_code();?>">
              <input type="hidden" name="id_customer" value="<?=$customer['id_customer'];?>">
              <input type="number" class="form-control" name="total" id="total" value="<?=@$total_semua;?>" min="0" style="pointer-events:none" readonly></input> 
            </div>
            <div class="col-6">
              <label>Potongan Harga</label>
              <input type="number" class="form-control" name="potongan_harga" value="0" id="diskon" placeholder="Diskon" min="0" max="80000" <?php if (!isset($_SESSION['cart'])): ?>
              disabled
              <?php endif ?>></input>
            </div>
            <div class="col-6">
              <label>Setelah Diskon</label>
              <input type="number" class="form-control" name="setelah_diskon" id="setelah_diskon" value="<?=@$total_semua;?>" placeholder="Diskon" min="0" style="pointer-events:none" readonly>
            </div>
          </div>
        </div> 
        <div class="form-group">
          <div class="row">
            <div class="col-6">
              <label>Jumlah Bayar</label>
              <input type="number" class="form-control" name="jumlah_bayar" id="jumlah_bayar" placeholder="Jumlah Bayar" min="0" required></input>
            </div>
            <div class="col-6">
              <label>Kembalian</label>
              <input type="number" class="form-control" name="kembalian" id="kembalian" min="0" style="pointer-events:none" readonly></input>
            </div>
          </div>
        </div>
        <button id="btnBayar" class="float-right btn-lg btn btn-success"><i class="fa fa-money-bill-wave"></i> Bayar</button>
      </form>
    </div>
  </div>

  <!-- </div> -->
  <!-- /.d-flex -->
</div>
</div>
</div>
<!-- /.card -->
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
          <div class="form-group">
            <label for="">Kode</label>
            <input type="hidden" name="edit_cart" value="1">
            <input type="hidden" name="id" id="idForm" class="form-control">
            <input type="text" id="kodeForm" class="form-control" disabled="">
          </div>
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
<script>
  $('#jumlah_bayar').keyup(function(){
    var total = parseInt($('#setelah_diskon').val());
    var jumlah_bayar = parseInt($('#jumlah_bayar').val());
    var kembalian = jumlah_bayar-total;
    $('#kembalian').val(kembalian);
  });
  //
  if ($('#total').val() === "") {
    $('#btnBayar').attr("disabled", true)
  }
  $('#diskon').keyup(function(){
    var total = parseInt($('#total').val());
    var diskon = parseInt($('#diskon').val());
    var total_semua = parseInt(total-diskon);
    if (diskon > total) {
      $('#setelah_diskon').val();
    } else {
      $('#setelah_diskon').val(total_semua);
    }

  })
  var load_barang = "json/json_barang.php";
  var loadUrl1 = "json/json_cart.php";
  $('.delete_btn').click(function(){
    if (confirm('Apakah anda yakin?')) {
      $('.delete_cart').submit(function(e){
        e.preventDefault();
        $.ajax({
          type : 'POST',
          url : 'application/event.php',
          data : $(this).serialize(),
          dataType : 'json',
          success : function(data){
            if (data.success) {
              window.$('#load-cart').load(loadUrl1);
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
              window.$('#load-cart').load(loadUrl1);
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
  $('#reset_user').submit(function(e){
    e.preventDefault();
    $.ajax({
      type : 'POST',
      url : 'application/event.php',
      data : $('#reset_user').serialize(),
      dataType : 'json',
      success : function(data){
        if (data.success) {
          window.$('#load-cart').load(loadUrl1);
          window.$('#load-barang').load(load_barang);
          window.$('#hide-customer').show();
          window.$('#load-customer').show();
          window.$('#hide-barang').hide();
          toastr['success'](data.message);
        }else{
          toastr['error'](data.message);
        }
      }
    })
  });
  $('#form_bayar').submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url : 'application/event.php',
      data : $('#form_bayar').serialize(),
      dataType : 'json',
      success : function(data){
        if (data.success) {
          toastr['success'](data.message);
          setTimeout(function(){
            window.location.href="index.php";
          }, 1000);
          setTimeout(function(){
            window.open('print.php?trx_code='+data.trx_code, '_blank');
          }, 800);
        }
      }
    })
  })
  /*
    Edit Keranjang
    */
    $('.edit_cart').submit(function(e){
      e.preventDefault();
      //Getter
      var id = $(this).find('.id').val();
      var kode_barang = $(this).find('.kode_barang').val();
      var nama_barang = $(this).find('.nama_barang').val();
      var jumlah = $(this).find('.jumlah').val();
      //Setter
      $('#idForm').val(id);
      $('#kodeForm').val(kode_barang);
      $('#namaForm').val(nama_barang);
      $('#quantityForm').val(jumlah);
      //
      $('#modalEdit').modal('show');
    })
    $('#editForm').submit(function(e){
      e.preventDefault();
      $('#modalEdit').modal('hide');
      $.ajax({
        type : 'POST',
        url : 'application/event_cart_penjualan.php',
        data : $(this).serialize(),
        dataType : 'json',
        success : function (data){
          if (data.success) {
           window.$('#load-cart').load("json/json_cart.php");
           toastr['success'](data.message);
         }else{
           toastr['error'](data.message);

         }
       }
     })
    })
  </script>
