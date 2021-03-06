<?php 
require '../application/system.php';
?>
<!-- <div class="row"> -->
  <div class="card">
    <div class="card-header border-0">
      <div class="d-flex justify-content-between">
        <h3 class="card-title">Form Pemesanan</h3>
      </div>
    </div>
    <div class="card-body">
      <div id="step1">
        <form id="form_pemesanan" method="post" action="application/event_pemesanan.php" enctype="multipart/form-data">
          <input type="hidden" name="add_pesanan" value="1">
          <input type="hidden" name="trx_code" id="trx_code">

          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label>Jenis Pemesanan</label>
                <select name="jenis_pemesanan" class="form-control" id="jenis_pemesanan" required>
                  <option selected disabled>Jenis Pemesanan</option>
                  <option value="kaos">Kaos</option>
                  <option value="jaket">Jaket</option>
                  <option value="jersey">Jersey</option>
                  <option value="hoodie">Hoodie</option>
                  <option value="kemeja">Kemeja</option>
                  <option value="topi">Topi</option>
                </select>
              </div>
              <div class="col-6">
                <label>File Desain</label>
                <input type="file" name="file_desain">
              </div>
            </div>
          </div>
          <div id="model_baju_div">
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label>Model Baju</label>
                  <select name="model_baju" class="form-control">
                    <option  value="1" selected disabled>Pilih Model Baju</option>
                    <option value="v-neck">O Neck</option>
                    <option value="u-neck">U Neck</option>
                    <option value="kerah">Kerah</option>
                    <option value="lainnya">Lainnya</option>
                  </select>
                </div>
                <div class="col-6">
                  <label for="">Bahan Kaos</label>
                  <div class="radio">
                    <label>
                      <input type="radio" id="type-30" name="type" value="30" checked>
                      Katun 30s
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" id="type-24" name="type" value="24">
                      Katun 24s
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="">Perkiraan Selesai</label>
                <input type="date" name="perkiraan_selesai" class="form-control" required>
              </div>
              <div class="col-6">
                <label>Jenis Sablon</label>
                <div class="row">
                  <div class="col-6">
                    <div class="form-check">
                      <input type="checkbox" name="jenis_sablon[]" value="poliflex" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Poliflex</label>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" name="jenis_sablon[]" value="plastisol" class="form-check-input" id="exampleCheck2">
                      <label class="form-check-label" for="exampleCheck2">Plastisol</label>
                    </div>
                  </div>
                  <div class="col-6">
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
            </div>
            
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
               <label>Harga lainnya</label>
               <input type="number" class="form-control" name="harga_tambahan" min="0" placeholder="Harga tambahan">
             </div>
             <div class="col-6">
              <label>Biaya desain</label>
              <input type="number" class="form-control" name="biaya_desain" min="0" placeholder="Biaya desain">
            </div>
          </div>

        </div>
        <div class="form-group">
          <label>Keterangan</label>
          <textarea class="form-control" name="keterangan" placeholder="Deskripsi"></textarea>
        </div>
        <div class="form-group">              
          <button type="submit" class="float-right btn-submit btn btn-success"><span id="loading"><i class="fas fa-2x fa-sync-alt fa-spin"></i></span> Simpan</button>
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
<!-- </div> -->
<div class="modal">
</div>
<script type="text/javascript">
  var jenis_pemesanan = $('#jenis_pemesanan');
  var step1 = $('#step1');
  var step2 = $('#step2');
  $('#load-barang').load('json/barang_pesanan.php');
  $('#model_baju_div').hide();

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
$('#loading').hide();
$('#form_pemesanan').submit(function(e){
  e.preventDefault();


  var formData = new FormData(this);

  $.ajax({
    url: 'application/event_pemesanan.php',
    type: 'POST',
    data: formData,
    dataType: 'json',
    success: function (data) {
     toastr['info']('Harap tunggu, sedang memproses data!');
     $('.btn-submit').attr('disabled',true);
     $('#loading').show();
     if (data.transaksi.success) {
       step1.hide();
       step2.show();
       $('#load-barang').load('json/barang_pesanan.php');
       window.$('#load-cart').load('json/cart_pemesanan.php');
       toastr['success'](data.transaksi.message);
       if (data.upload.success) {
        toastr['success'](data.upload.message);
      }else{
        toastr['error'](data.upload.message);
      }
    }else{
     $('.btn-submit').attr('disabled',false);
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
