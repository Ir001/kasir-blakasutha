<?php 	
	require 'application/system.php';
	$trx_code = trim($_GET['trx_code']);
	$detail_trx = $system->detail_trx($trx_code);
	$cust_id = $detail_trx['id_customer'];
	$cust = $system->detail_customer($cust_id);
	$kembalian = $detail_trx['jumlah_bayar']-$detail_trx['total_harga'];

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
            Nama : <?=$cust['nama_lengkap'];?></br>
            Kode Transaksi : <?=$detail_trx['trx_code'];?></br>
            Tgl Transaksi : <?=$detail_trx['tgl_transaksi'];?></br>
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
	                            $data = $system->view_trx($trx_code);
	                            foreach ($data as $data) {
	                            	$id_barang = $data['id_barang'];
	                            	$id_customer = $data['id_customer'];
	                            	$barang = $system->get_detail_barang($id_barang);
	                            	$customer = $system->detail_customer($id_customer);
	                            	$total = $data['jumlah']*$data['subharga'];

	                           ?>
	                        <tr class="service">
	                          <td class="tableitem"><p class="itemtext"><?=$barang['kode_barang'];?></p></td>
	                          <td class="tableitem"><p class="itemtext"><?=$barang['nama_barang'];?></p></td>
	                          <td class="tableitem"><p class="itemtext"><?=$data['jumlah'];?></p></td>
	                          <td class="tableitem"><p class="itemtext"><?=number_format($data['subharga'],0,',','.');?></p></td>
	                          <td class="tableitem"><p class="itemtext"><?=number_format($total,0,',','.');?></p></td>
	                        </tr> 
	                        <?php } ?>  
							<tr class="tabletitle">
								<td></td>
								<td></td>
								<td></td>
								<td class="Rate"><h2>Total</h2></td>
								<td class="payment"><h2>Rp.<?=number_format(@$detail_trx['total_harga'],0,',','.');?></h2></td>
							</tr>
							<tr class="tabletitle">
								<td></td>
								<td></td>
								<td></td>
								<td class="Rate"><h2>Jumlah Bayar</h2></td>
								<td class="payment"><h2>Rp.<?=number_format(@$detail_trx['jumlah_bayar'],0,',','.');?></h2></td>
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

 	<script type="text/javascript">
 		window.print();
 	</script>
 </body>
 </html>