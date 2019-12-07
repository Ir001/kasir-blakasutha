<?php 
require '../application/system.php';
?>
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header border-0">
        <div class="d-flex justify-content-between">
          <h3 class="card-title">Form Pemesanan</h3>
        </div>
      </div>
      <div class="card-body">
        <div id="step1">
          <form id="form_pemesanan" method="post" action="application/event.php" enctype="multipart/form-data">
            <input type="hidden" name="add_pesanan" value="1">
            <input type="hidden" name="trx_code" id="trx_code">

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
              <input type="file" name="sablon_depan">
            </div>
            <div class="form-group" id="sablon_belakang_div">
              <label>Sablon Belakang</label>
              <br>
              <input type="file" name="sablon_belakang">
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
                    <input type="checkbox" name="jenis_sablon[]" value="poliflex" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Poliflex</label>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" name="jenis_sablon[]" value="plastisol" class="form-check-input" id="exampleCheck2">
                    <label class="form-check-label" for="exampleCheck2">Plastisol</label>
                  </div>
                </div>
                <div class="col-10">
                  <div class="form-check">
                    <input type="checkbox" name="jenis_sablon[]" value="rubber" class="form-check-input" id="exampleCheck3">
                    <label class="form-check-label" for="exampleCheck3">Rubber</label>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" name="jenis_sablon[]" value="bordir" class="form-check-input" id="exampleCheck4">
                    <label class="form-check-label" for="exampleCheck4">Bordir</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" name="keterangan" placeholder="Deskripsi"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="float-right btn-submit btn btn-success">Simpan</button>
            </div>
          </form>
        </div>
        <div id="step2">
          <label>Ukuran</label>
          <div id="load-barang"></div>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <div class="col-md-6">
    <div id="load-cart"></div>
  </div>

</div>
<script type="text/javascript">
  var cart_page = "json/cart_pemesanan.php";
  var jenis_pemesanan = $('#jenis_pemesanan');
  var step1 = $('#step1');
  var step2 = $('#step2');
  $('#model_baju_div').hide();
  $('#btn-back').hide();
  $('#load-cart').load(cart_page);
  $('#load-barang').load('json/barang_pesanan.php');

  <?php if (isset($_SESSION['trx_code'])) { ?>
  step1.hide();
  step2.show();
  <?php }else{ ?>
  step1.show();
  step2.hide();
  <?php } ?>
  jenis_pemesanan.change(function(){
    if (jenis_pemesanan.val() === 'kaos') {
      $('#model_baju_div').show();
    }
  })
/*
Post an files
*/
$('#form_pemesanan').submit(function(e){
  e.preventDefault();
 
  var formData = new FormData(this);

  $.ajax({
    url: 'application/event.php',
    type: 'POST',
    data: formData,
    dataType : 'json',
    success: function (data) {
      if (data.transaksi.success) {
         step1.hide();
         step2.show();
        if (data.upload_depan.success) {
            toastr['success'](data.upload_depan.message);
        }else{
            toastr['error'](data.upload_depan.message);
        }
        if (data.upload_belakang.success) {
            toastr['success'](data.upload_depan.message);
        }else{
            toastr['error'](data.upload_depan.message);
        }
            toastr['success'](data.transaksi.message);
      }else{
            toastr['error'](data.transaksi.message);
       }
    },
    cache: false,
    contentType: false,
    processData: false
  });
})

var trx_code = '<?php echo $system->generate_trx_code(); ?>';
$('#trx_code').val(trx_code);

</script>