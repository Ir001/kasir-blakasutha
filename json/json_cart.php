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
                 ?>
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
                          <th>Harga</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td>BLKHTM</td>
                          <td>Kaos Oblong</td>
                          <td>1</td>
                          <td>78.000</td>
                          <td>
                            <button class=" btn btn-sm btn-success" title="Edit"><i class="fa fa-pen"></i></button>
                            <button class=" btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
                          </td>
                        </tr>                    
                        </tbody>
                      </table>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-12">
                      <form>
                        <div class="form-group">
                          <label>Total</label>
                          <input type="number" class="form-control" name="total" value="78000" min="0" disabled></input>
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
