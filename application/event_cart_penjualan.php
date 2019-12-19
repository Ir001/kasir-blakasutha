<?php 
	require 'system.php';
	if (isset($_POST['edit_cart'])) {
		$id = $_POST['id'];
		$jumlah = $_POST['jumlah'];
		$_SESSION['cart'][$id] = $jumlah;
		$msg = array(
			'success' => true,
			'message' => 'Berhasil mengubah keranjang',
		);
		echo json_encode($msg);
	}
 ?>