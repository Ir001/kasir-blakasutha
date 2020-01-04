<?php 	
require 'application/system.php';
if (!isset($_GET['trx_code'])) {
	header("location:index.php");
}
$trx_code = trim($_GET['trx_code']);
$detail_trx = $system->detail_trx_pemesanan($trx_code);
$cust_id = $detail_trx['id_customer'];
$cust = $system->detail_customer($cust_id);
$kembalian = $detail_trx['jumlah_bayar']-$detail_trx['total_harga'];
$kekurangan = $detail_trx['jumlah_bayar']-$detail_trx['total_harga'];
if (isset($_GET['status']) && $_GET['status'] == "pelunasan") {
	$pelunasan = $system->info_pelunasan($trx_code);
}
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
			<?php if (isset($_GET['status']) && $_GET['status'] == "pelunasan"): ?>
				<h2>Bukti Pelunasan</h2>
				<?php else: ?>
				<h2>Bukti Pembayaran</h2>
				<small style="font-size:6px;color: red;text-align: center;display: block;">Perhatian: Bawa struk ini untuk pengambilan!</small>
			<?php endif ?>
			<p style="font-size: 8px"> 
				Kode Transaksi : <?=$detail_trx['trx_code'];?></br>
				Nama : <?=ucwords($cust['nama_lengkap']);?></br>
				Jenis Pesanan : <?=ucwords($detail_trx['jenis_pemesanan']);?></br>
				Tgl Transaksi : <?=$detail_trx['tgl_transaksi'];?></br>
				Perkiraan Selesai : <?=$detail_trx['perkiraan_selesai'];?></br>
			</p>
		</div>


		<div id="bot">

			<div id="table">
				<table>
					<tr class="tabletitle">
						<th>Lengan</th>
						<th>Ukuran</th>
						<th>Jumlah</th>
						<th>Subharga</th>
						<th>Total</th>
					</tr>

					<?php 
					$data = $system->view_trx_pemesanan($trx_code);
					foreach ($data as $data) {
						$id_barang = $data['id_barang'];
						$id_customer = $data['id_customer'];
						$barang = $system->detail_barang_pesanan($id_barang);
						$customer = $system->detail_customer($id_customer);
						$total = $data['jumlah']*$data['subharga'];
						?>
						<tr class="service">
							<td class="tableitem"><p class="itemtext"><?=$barang['length']." (".$barang['ukuran'].")";?></p></td>
							<td class="tableitem"><p class="itemtext"><?=$barang['ukuran'];?></p></td>
							<td class="tableitem"><p class="itemtext"><?=$data['jumlah'];?></p></td>
							<td class="tableitem"><p class="itemtext"><?=number_format($data['subharga'],0,',','.');?></p></td>
							<td class="tableitem"><p class="itemtext"><?=number_format($total,0,',','.');?></p></td>
						</tr> 
					<?php } ?>  
					<tr class="tabletitle">
						<td></td>
						<td></td>
						<td></td>
						<td class="Rate"><h2>Harga Tambahan</h2></td>
						<td class="payment"><h2>Rp.<?=number_format(@$detail_trx['harga_tambahan'],0,',','.');?></h2></td>
					</tr>
					<tr class="tabletitle">
						<td></td>
						<td></td>
						<td></td>
						<td class="Rate"><h2>Grand Total</h2></td>
						<td class="payment"><h2>Rp.<?=number_format(@$detail_trx['total_harga'],0,',','.');?></h2></td>
					</tr>
					<?php if (isset($_GET['status']) && $_GET['status'] == "pelunasan"): ?>
						<tr class="tabletitle">
							<td></td>
							<td></td>
							<td></td>
							<td class="Rate"><h2>Uang Muka</h2></td>
							<td class="payment"><h2>Rp.<?=number_format(@$detail_trx['jumlah_bayar'],0,',','.');?></h2></td>
						</tr>
					<?php else: ?>
						<tr class="tabletitle">
							<td></td>
							<td></td>
							<td></td>
							<td class="Rate"><h2>Jumlah Bayar</h2></td>
							<td class="payment"><h2>Rp.<?=number_format(@$detail_trx['jumlah_bayar'],0,',','.');?></h2></td>
						</tr>
					<?php endif ?>
					<?php if (!isset($_GET['status'])): ?>
						
					<?php if ($detail_trx['kurang'] == "true"): ?>
						<tr class="tabletitle">
							<td></td>
							<td></td>
							<td></td>
							<td class="Rate"><h2>Kekurangan</h2></td>
							<td class="payment" style="color: red"><h2>Rp.<?=number_format(ltrim($kekurangan,'-'),0,',','.');?></h2></td>
						</tr>
						<?php else: ?>
						<tr class="tabletitle">
							<td></td>
							<td></td>
							<td></td>
							<td class="Rate"><h2>Kembalian</h2></td>
							<td class="payment" style="color: green"><h2>Rp.<?=number_format(@$kembalian,0,',','.');?></h2></td>
						</tr>	
					<?php endif ?>
					<?php endif ?>
					<?php if (isset($_GET['status']) && $_GET['status'] == "pelunasan"): ?>
						<tr class="tabletitle">
							<td></td>
							<td></td>
							<td></td>
							<td class="Rate"><h2>Pelunasan</h2></td>
							<td class="payment" style="color: blue"><h2>Rp.<?=number_format($pelunasan['pelunasan'],0,',','.');?></h2></td>
						</tr>
						<?php 
							$kembalian_pelunasan = $pelunasan['pelunasan']-$pelunasan['dp'];
						 ?>
						<tr class="tabletitle">
							<td></td>
							<td></td>
							<td></td>	
							<td class="Rate"><h2>Kembalian</h2></td>
							<td class="payment" style="color: green"><h2>Rp.<?=number_format(@$kembalian_pelunasan,0,',','.');?></h2></td>
						</tr>
						
					<?php endif ?>

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