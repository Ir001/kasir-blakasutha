<?php 
	require 'system.php';
	if (isset($_POST['edit_status'])) {
		$status = $_POST['status'];
		$trx_code = $_POST['trx_code'];
		$edit = $system->edit_status_pemesanan($status, $trx_code);
		echo json_encode($edit);
	}elseif (isset($_POST['edit_cart'])) {
		$id = $_POST['id'];
		$jumlah = $_POST['jumlah'];
		$_SESSION['cart_pemesanan'][$id] = $jumlah;
		$msg['success'] = true;
		$msg['message'] = 'Berhasil mengubah keranjang!';
		echo json_encode($msg);
	}elseif (isset($_POST['delete_cart'])) {
		$id = $_POST['id'];
		unset($_SESSION['cart_pemesanan'][$id]);
		$msg['success'] = true;
		$msg['message'] = 'Berhasil menghapus barang!';
		echo json_encode($msg);
	}
 ?>