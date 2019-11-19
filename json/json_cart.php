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
                  <div style="line-height: 6px">
                    <p>Nama: <?=$customer['nama_lengkap'];?> <span class="badge badge-sm badge-info"><?=ucwords($customer['role']);?></span></p>
                    <p>Instagram: <?=$customer['instagram'];?></p>
                    <p>Nomor Telepon: <?=$customer['phone'];?></p>
                  </div>
                  
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <div class="row">
                    <div class="col-md-12">
                      <table id="data_pelanggan" class="table table-bordered table-striped">
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
                            if(!empty($_SESSION['cart'])){
                            foreach ($cart as $id => $jumlah) {
                              $data = $system->get_info_barang($id);
                              if($jumlah > 12){
                                 $harga = $data['harga_2'];
                                 $total = $harga*$jumlah;
                              }elseif ($jumlah > 24) {
                                 $harga = $data['harga_3'];
                                 $total = $harga*$jumlah;
                              }else{
                                 $harga = $data['harga_1'];
                                 $total = $harga*$jumlah;
                              }
                           ?>
                        <tr>
                          <td><?=$data['kode_barang'];?></td>
                          <td><?=$data['nama_barang'];?></td>
                          <td><?=number_format($jumlah,0,',','.');?></td>
                          <td><?=$harga;?></td>
                          <td><?=$total;?></td>
                          <td>
                            <button class=" btn btn-sm btn-success" title="Edit"><i class="fa fa-pen"></i></button>
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
                    <div class="col-12">
                      <form>
                        <div class="form-group">
                          <label>Total</label>
                          <input type="number" class="form-control" name="total" value="<?=@$total_semua;?>" min="0" disabled></input>
                        </div>
                        <div class="form-group">
                          <label>Jumlah Bayar</label>
                          <input type="number" class="form-control" name="jumlah_bayar" placeholder="Jumlah Bayar" min="0" required></input>
                        </div>
                      </form>
                      <button id="btnBayar" class="float-right btn btn-success"><i class="fa fa-money-bill-wave"></i> Bayar</button>
                    </div>
                  </div>
                 
                </div>
                <!-- /.d-flex -->
              </div>
            </div>
           </div>
            <!-- /.card -->
<script>
  var loadUrl1 = "json/json_cart.php";
  $('.delete_btn').click(function(){
    if (confirm('Apakah anda yakin?')) {
      $('.delete_cart').submit(function(e){
        e.preventDefault();
        $.ajax({
          type : 'POST',
          url : 'application/event.php',
          data : $('.delete_cart').serialize(),
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
                toastr['success'](data.message);
            }else{
                toastr['error'](data.message);
            }
          }
        })
  })
  
</script>