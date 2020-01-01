<?php require '../application/system.php'; ?>
<?php if (isset($_POST['detail_pemesanan'])): ?>
  <?php 
  $trx_code = trim($_POST['trx_code']);
  $data = $system->view_trx_pemesanan($trx_code);
  ?>
  <div class="modal fade" id="detailModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Pesanan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h2>Ukuran</h2>
          <table id="tbl_ukuran" class="table table-bordered table-striped">
            <tr>
              <th>No</th>
              <th>Barang</th>
              <th>Ukuran</th>
              <th>Jumlah</th>
            </tr>
            <?php $no=1; ?>
            <?php foreach ($data as $data): ?>
              <tr>
                <?php $barang = $system->detail_barang_pesanan($data['id_barang']); ?>
                <td><?=$no;?></td>
                <td><?=$barang['length'];?> (<?=$barang['type'];?>s)</td>
                <td><?=$barang['ukuran'];?></td>
                <td><?=$data['jumlah'];?></td>
                <?php $no++; ?>
              </tr>
            <?php endforeach ?>
          </table>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
  <?php endif ?>