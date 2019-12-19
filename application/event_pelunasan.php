<?php 
	require 'system.php';
	if(isset($_POST['get_pelunasan'])):
		$trx_code = $_POST['trx_code'];
		$pemesanan = $system->get_detail_pelunasan($trx_code);
		//Process 
		$nama_lengkap = $pemesanan['nama_lengkap'];
		$trx_code = $pemesanan['trx_code'];
		$total_harga = $pemesanan['total_harga'];
		$jumlah_bayar = $pemesanan['jumlah_bayar'];
		//
		$kekurangan = $total_harga - $jumlah_bayar;
		//
		$data = array(
			'trx_code' => $trx_code,
			'nama_pemesan' => $nama_lengkap,
			'kekurangan' => $kekurangan,
			'total_harga' => $total_harga,
			'jumlah_bayar' => $jumlah_bayar,
		);
		echo json_encode($data);
	elseif(isset($_POST['pelunasan'])):
		$trx_code = $_POST['trx_code'];
		$dp = $_POST['dp'];
		$jumlah_bayar = $_POST['jumlah_bayar'];
		$kekurangan = $_POST['kekurangan'];
		$data = array(
			'trx_code' => $trx_code,
			'dp' => $dp,
			'jumlah_bayar' => $jumlah_bayar,
		);
		if ($jumlah_bayar < $kekurangan) {
			$msg = array(
				'success' => false,
				'message' => 'Jumlah pembayaran harus melebihi kekurangan!',
			);
		}else{
			$pelunasan = $system->create_pelunasan($data);
			$update = $system->update_for_pelunasan($trx_code);
			$msg = $update;
		}
		$msg['trx_code'] = $trx_code;
		echo $system->convert_to_json($msg);

	else:
		echo "Forbidden";
	endif;
 ?>
