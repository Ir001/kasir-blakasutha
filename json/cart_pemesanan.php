<?php   
require '../application/system.php';
?>
<div class="card">
  <div class="card-body">
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
      <p>Nomor Telepon: <?=$customer['phone'];?></p>
    </div>
    <hr>
    <h6>Rincian</h6>
    <table id="data_pemesanan" class="mt-5 table table-bordered table-striped">
      <thead>
        <tr>
          <th>Ukuran</th>
          <th>Quantity</th>
          <th>Subharga</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
           <tr>
            <td>asd</td>
            <td>asd</td>
            <td>asd</td>
            <td>asd</td>
            <td>
              <button class="btn btn-sm btn-success" title="Edit"><i class="fa fa-pen"></i></button>
              <form class="delete_cart">
                <input type="hidden" name="delete_cart" value="1">
                <input type="hidden" name="id" value="<?=$id;?>">
                <button type="submit" class="delete_btn btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
              </form>
            </td>
          </tr>                 
      </tbody>
    </table>
    <button class="mt-3 float-right btn btn-success">Buat Pesanan</button>

  </div>
  <!-- /.card-body -->
</div>
<script type="text/javascript">
  $('#reset_user').submit(function(e){
    e.preventDefault();
    $.ajax({
      type : 'POST',
      url : 'application/event.php',
      data : $('#reset_user').serialize(),
      dataType : 'json',
      success : function(data){
        if (data.success) {
          window.$('#load-customer-div').show();
          window.$('#load-content').hide();
          toastr['success'](data.message);
        }else{
          toastr['error'](data.message);
        }
      }
    })
  });
</script>