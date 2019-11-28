<?php 	
	require 'application/system.php';
	$trx_code = trim($_GET['trx_code']);
	$data = $system->view_trx($trx_code);
	$kembalian = $data['jumlah_bayar']-$data['total_harga']; 
	$jumlah_bayar = $data['jumlah_bayar'];

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Invoice</title>
 	<link rel="stylesheet" href="json/invoice.css">
 </head>
 <body>

  <div id="invoice-POS">
  	<div class="info">
        <h2>Bukti Pembayaran</h2>
        <p style="font-size: 8px"> 
            Nama : <?=$data['nama_lengkap'];?></br>
            Kode Transaksi : <?=$data['trx_code'];?></br>
            Tgl Transaksi : <?=$data['tgl_transaksi'];?></br>
        </p>
      </div>
    
    
    <div id="bot">

					<div id="table">
						<table>
							<tr class="tabletitle">
	                          	<th>Kode</th>
	                          	<th>Nama</th>
	                          	<th>Quantity</th>
	                         	<th>Subharga</th>
	                         	<th>Harga</th>
							</tr>

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
	                        <tr class="service">
	                          <td class="tableitem"><p class="itemtext"><?=$data['kode_barang'];?></p></td>
	                          <td class="tableitem"><p class="itemtext"><?=$data['nama_barang'];?></p></td>
	                          <td class="tableitem"><p class="itemtext"><?=$jumlah;?></p></td>
	                          <td class="tableitem"><p class="itemtext"><?=number_format($harga,0,',','.');?></p></td>
	                          <td class="tableitem"><p class="itemtext"><?=number_format($total,0,',','.');?></p></td>
	                        </tr> 
	                        <?php @$total_semua+=$total; ?>
	                        <?php }} ?>  
							<tr class="tabletitle">
								<td></td>
								<td></td>
								<td></td>
								<td class="Rate"><h2>Total</h2></td>
								<td class="payment"><h2>Rp.<?=number_format(@$total_semua,0,',','.');?></h2></td>
							</tr>
							<tr class="tabletitle">
								<td></td>
								<td></td>
								<td></td>
								<td class="Rate"><h2>Jumlah Bayar</h2></td>
								<td class="payment"><h2>Rp.<?=number_format(@$jumlah_bayar,0,',','.');?></h2></td>
							</tr>

							<tr class="tabletitle">
								<td></td>
								<td></td>
								<td></td>
								<td class="Rate"><h2>Kembalian</h2></td>
								<td class="payment"><h2>Rp.<?=number_format(@$kembalian,0,',','.');?></h2></td>
							</tr>

						</table>
					</div><!--End Table-->

					<div id="legalcopy">
						<p class="legal"><strong>Thank you!</strong> 
						</p>
					</div>


				</div><!--End InvoiceBot-->
				<div id="mid">
      <div class="info">
        <h2>Contact Info</h2>
        <p style="font-size: 8px"> 
            Address : <?=$setting['alamat'];?></br>
            Email   : <?=$setting['email'];?></br>
            Phone   : <?=$setting['phone'];?></br>
        </p>
      </div>
    </div><!--End Invoice Mid-->
    
  </div><!--End Invoice-->

 	
 </body>
 </html>