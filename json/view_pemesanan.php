<?php 
require '../application/system.php';
?>
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header border-0">
        <div class="d-flex justify-content-between">
          <h3 class="card-title">Form Pemesanan</h3>
        </div>
      </div>
      <div class="card-body">
        <form id="form_pemesanan" method="post" enctype="multipart/form-data">
          <div id="step1">
            <div class="form-group">
              <label>Jenis Pemesanan</label>
              <select name="jenis_pemesanan" class="form-control" id="jenis_pemesanan">
                <option selected disabled>Jenis Pemesanan</option>
                <option value="jaket">Jaket</option>
                <option value="jersey">Jersey</option>
                <option value="kaos">Kaos</option>
                <option value="hoodie">Hoodie</option>
                <option value="kemeja">Kemeja</option>
                <option value="topi">Topi</option>
              </select>
            </div>
            <div class="form-group">
              <label>Sablon Depan</label>
              <br>
              <input type="file">
            </div>
            <div class="form-group" id="sablon_belakang_div">
              <label>Sablon Belakang</label>
              <br>
              <input type="file">
            </div>
            <div class="form-group" id="model_baju_div">
              <label>Model Baju</label>
              <select name="model_baju" class="form-control">
                <option  value="1" selected disabled>Pilih Model Baju</option>
                <option value="v-neck">V Neck</option>
                <option value="u-neck">U Neck</option>
                <option value="kerah">Kerah</option>
                <option value="lainnya">Lainnya</option>
              </select>
            </div>
            <div class="form-group">
              <label>Jenis Sablon</label>
              <div class="row">
                <div class="col-2">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" value="poliflex" for="exampleCheck1">Poliflex</label>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                    <label class="form-check-label" value="plastisol" for="exampleCheck2">Plastisol</label>
                  </div>
                </div>
                <div class="col-10">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck3">
                    <label class="form-check-label" value="rubber" for="exampleCheck3">Rubber</label>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck4">
                    <label class="form-check-label" value="bordir" for="exampleCheck4">Bordir</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="step2">
            <label>Ukuran</label>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Pendek S</label>
                  <input type="number" name="pendek_s" id="pendek_s" class="uk form-control" min="0" value="0" placeholder="S" required>
                </div>
                <div class="form-group">
                  <label>Pendek M</label>
                  <input type="number" name="pendek_m" id="pendek_m" class="uk form-control" min="0" value="0"  placeholder="M" required>
                </div>
                <div class="form-group">
                  <label>Pendek L</label>
                  <input type="number" name="pendek_l" id="pendek_l" class="uk form-control" min="0" value="0"  placeholder="L" required>
                </div>
                <div class="form-group">
                  <label>Pendek XL</label>
                  <input type="number" name="pendek_xl" id="pendek_xl" class="uk form-control" min="0" value="0"  placeholder="XL" required>
                </div>
                <div class="form-group">
                  <label>Pendek XXL</label>
                  <input type="number" name="pendek_xxl" id="pendek_xxl" class="uk form-control" min="0" value="0"  placeholder="XXL" required>
                </div>
                <div class="form-group">
                  <label>Pendek XXXL</label>
                  <input type="number" name="pendek_xxxl" id="pendek_xxxl" class="uk form-control" min="0" value="0"  placeholder="XXXL" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Panjang S</label>
                  <input type="number" name="panjang_s" id="panjang_s" class="uk form-control" min="0" value="0" placeholder="S" required>
                </div>
                <div class="form-group">
                  <label>Panjang M</label>
                  <input type="number" name="panjang_m" id="panjang_m" class="uk form-control" min="0" value="0" placeholder="M">
                </div>
                <div class="form-group">
                  <label>Panjang L</label>
                  <input type="number" name="panjang_l" id="panjang_l" class="uk form-control" min="0" value="0"placeholder="L" required>
                </div>
                <div class="form-group">
                  <label>Panjang XL</label>
                  <input type="number" name="panjang_xl" id="panjang_xl" class="uk form-control" min="0" value="0" placeholder="XL" required>
                </div>
                <div class="form-group">
                  <label>Panjang XXL</label>
                  <input type="number" name="panjang_xxl" id="panjang_xxl" class="uk form-control" min="0" value="0"  placeholder="XXL" required>
                </div>
                <div class="form-group">
                  <label>Panjang XXXL</label>
                  <input type="number" name="panjang_xxxl" id="panjang_xxxl" class="uk form-control" min="0" value="0" placeholder="XXXL" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Jumlah Pesanan</label>
              <input type="number" class="form-control" name="jumlah_pesanan" id="jumlah_pesanan" style="pointer-events:none" readonly></input>
            </div>
            <button class="float-right btn btn-success">Buat Pesanan</button>
          </div>
        </form>
        <button class="float-left btn btn-info" id="btn-back">Kembali</button>
        <button class="float-right btn btn-info" id="btn-next">Berikutnya</button>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  
  <div class="col-md-4">
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
      </div>
    </div>
    <!-- /.card-body -->
  </div>
</div>
<script type="text/javascript">
  var jenis_pemesanan = $('#jenis_pemesanan');
  var step1 = $('#step1');
  var step2 = $('#step2');
  $('#model_baju_div').hide();
  $('#btn-back').hide();

  step2.hide();

  jenis_pemesanan.change(function(){
    if (jenis_pemesanan.val() === 'kaos') {
      $('#model_baju_div').show();
    }
  })
//
$('#btn-next').click(function(){
  step1.hide();
  step2.show();
  $('#btn-back').show();
  $('#btn-next').hide();
});
$('#btn-back').click(function(){
  step1.show();
  step2.hide();
  $('#btn-back').hide();
  $('#btn-next').show();
})
$('.uk').change(function(){
  hitung_jumlah_pesanan();
});
$('.uk').click(function(){
  $(this).select();
});
$('.uk').keyup(function(){
  hitung_jumlah_pesanan();
});
$('#jumlah_pesanan').val(0);
function hitung_jumlah_pesanan(){
  var panjang = 0;
  var pendek = 0;
  //
  var panjang_s = parseInt($('#panjang_s').val());
  var panjang_m = parseInt($('#panjang_m').val());
  var panjang_l = parseInt($('#panjang_l').val());
  var panjang_xl = parseInt($('#panjang_xl').val());
  var panjang_xxl = parseInt($('#panjang_xxl').val());
  var panjang_xxxl = parseInt($('#panjang_xxxl').val());
  //
  var pendek_s = parseInt($('#pendek_s').val());
  var pendek_m = parseInt($('#pendek_m').val());
  var pendek_l = parseInt($('#pendek_l').val());
  var pendek_xl = parseInt($('#pendek_xl').val());
  var pendek_xxl = parseInt($('#pendek_xxl').val());
  var pendek_xxxl = parseInt($('#pendek_xxxl').val());
  //
  var jumlah_pesanan = $('#jumlah_pesanan');
  //
  panjang = panjang_s+panjang_m+panjang_l+panjang_xl+panjang_xxl+panjang_xxxl; 
  pendek = pendek_s+pendek_m+pendek_l+pendek_xl+pendek_xxl+pendek_xxxl;
  var total_pesanan = panjang+pendek;
  jumlah_pesanan.val(total_pesanan);
}
//
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