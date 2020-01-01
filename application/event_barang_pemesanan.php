<?php 
	// require 'system.php';
	require_once (dirname(__FILE__)."/system.php");
	if(isset($_POST['add_data_barang_pesanan'])){
		$nama_pesanan = $_POST['nama_pesanan'];
		$ukuran = $_POST['ukuran'];
		$harga_1 = $_POST['harga_1'];
		$harga_2 = $_POST['harga_2'];
		$harga_3 = $_POST['harga_3'];
		$add_data_barang = $system->add_data_barang_pesanan($nama_pesanan, $ukuran, $harga_1, $harga_2, $harga_3);
		echo $system->convert_to_json($add_data_barang);
	}elseif(isset($_POST['delete_barang_pesanan'])){
		$id_barang = $_POST['id'];
		$delete_barang = $system->delete_data_barang_pesanan($id_barang);
		echo $system->convert_to_json($delete_barang);
	}elseif(isset($_POST['edit_data_barang_pemesanan'])){
		$id_barang = $_POST['id_barang'];
		$type = $_POST['type'];
		$length = $_POST['length'];
		$harga_1 = $_POST['harga_1'];
		$harga_2 = $_POST['harga_2'];
		$harga_3 = $_POST['harga_3'];
		$data = array(
			'id_barang' => $id_barang,
			'type' => $type,
			'length' => $length,
			'harga_1' => $harga_1,
			'harga_2' => $harga_2,
			'harga_3' => $harga_3,
		);
		$edit_data_barang = $system->edit_data_barang_pemesanan($data);
		echo json_encode($edit_data_barang);
	}else{
		$data['success'] = false;
		$data['message'] = "Server sedang sibuk";
		echo json_encode($data);
	}
?>