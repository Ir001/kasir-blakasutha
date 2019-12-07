<?php 
require 'system.php';
if (isset($_POST['user_login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$login = $system->login_user($username, $password);
	echo $system->convert_to_json($login);
}elseif (isset($_POST['customer_add'])) {
	$fullname = $_POST['fullname'];
	$phone = $_POST['phone'];
	$ig = $_POST['ig'];
	$role = $_POST['role'];
	$add = $system->customer_add($fullname, $phone, $ig, $role);
	echo $system->convert_to_json($add);
}elseif (isset($_POST['set_user'])) {
	$id = $_POST['id'];
	$_SESSION['id_customer'] = $id;
	$msg = array(
		'success' => true
	);
	echo $system->convert_to_json($msg);
}elseif(isset($_POST['add_barang'])){
	$id = $_POST['id'];
	$jumlah = $_POST['jumlah'];
	$add_cart = $system->add_cart($id, $jumlah);
	if ($add_cart) {
		$msg = array(
			'success' => true,
			'message' => 'Berhasil menambah barang',
		);
	}
	echo $system->convert_to_json($msg);
}elseif(isset($_POST['delete_cart'])){
	$id = $_POST['id'];
	$remove = $system->remove_cart($id);
	if($remove){
		$msg = array(
			'success' => true,
			'message' => 'Berhasil menghapus barang',
		);	
	}else{
		$msg = array(
			'success' => false,
			'message' => 'Gagal',
		);
	}		
	echo $system->convert_to_json($msg);
}elseif (isset($_POST['reset_user'])) {
	unset($_SESSION['id_customer']);
	$msg = array(
		'success' => true,
		'message' => 'Customer berhasil direset',
	);
	echo $system->convert_to_json($msg);

}elseif (isset($_POST['reset_cart'])) {
	unset($_SESSION['cart']);
	$msg = array(
		'success' => true,
		'message' => 'Berhasil menghapus keranjang',
	);
	echo $system->convert_to_json($msg);

}elseif (isset($_POST['reset_cart_pesanan'])) {
	unset($_SESSION['cart_pemesanan']);
	$msg = array(
		'success' => true,
		'message' => 'Berhasil menghapus keranjang',
	);
	echo $system->convert_to_json($msg);

}elseif(isset($_POST['form_bayar'])){
	$id_customer = $_POST['id_customer'];
	$jumlah_bayar = $_POST['jumlah_bayar'];
	$total = $_POST['total'];
	$trx_code = $_POST['trx_code'];
	$transaksi = $system->trx($trx_code, $total, $jumlah_bayar);
	if ($transaksi) {
		foreach ($_SESSION['cart'] as $id_barang => $jumlah) {
			$penjualan = $system->penjualan($id_customer, $id_barang, $trx_code, $jumlah);
			if ($penjualan) {
				$msg = array(
					'success' => true,
					'message' => 'Berhasil melakukan transaksi',
					'trx_code' => $trx_code,
				);
			}else{
				$msg = array(
					'success' => false,
					'message' => 'Gagal saat melakukan penjualan',
					'trx_code' => null,

				);
			}

		}
	}else{
		$msg = array(
			'success' => false,
			'message' => 'Gagal saat melakukan transaksi',
			'trx_code' => null,
		);
	}
	unset($_SESSION['cart']);
	unset($_SESSION['id_customer']);
	echo $system->convert_to_json($msg);

}elseif(isset($_POST['form_bayar_pesanan'])){
	$id_customer = $_POST['id_customer'];
	$jumlah_bayar = $_POST['total_bayar'];
	$total_harga = $_POST['total_harga'];
	$jumlah_pesanan = $_POST['jumlah_pesanan'];
	$trx_code = $_POST['trx_code'];
	$data = array (
		'trx_code' => $trx_code,
		'total_harga' => $total_harga,
		'jumlah_bayar' => $jumlah_bayar,
		'jumlah_pesanan' => $jumlah_pesanan,
	);
	$transaksi = $system->update_buat_pesanan($data);
	if ($transaksi) {
		foreach ($_SESSION['cart_pemesanan'] as $id_barang => $jumlah) {
			$pemesanan = $system->pemesanan($id_customer, $id_barang, $trx_code, $jumlah);
			if ($pemesanan) {
				$msg = array(
					'success' => true,
					'message' => 'Berhasil melakukan transaksi',
					'trx_code' => $trx_code,
				);
			}else{
				$msg = array(
					'success' => false,
					'message' => 'Gagal saat melakukan penjualan',
					'trx_code' => null,

				);
			}

		}
	}else{
		$msg = array(
			'success' => false,
			'message' => 'Gagal saat melakukan transaksi',
			'trx_code' => null,
		);
	}
	unset($_SESSION['cart']);
	unset($_SESSION['id_customer']);
	echo $system->convert_to_json($msg);

}elseif(isset($_POST['add_data_barang'])){
	$kode_barang = $_POST['kode_barang'];
	$nama_barang = $_POST['nama_barang'];
	$stok = $_POST['stok'];
	$harga_1 = $_POST['harga_1'];
	$harga_2 = $_POST['harga_2'];
	$harga_3 = $_POST['harga_3'];
	$add_data_barang = $system->add_data_barang($kode_barang, $nama_barang, $stok, $harga_1, $harga_2, $harga_3);
	echo $system->convert_to_json($add_data_barang);
}elseif(isset($_POST['edit_data_barang'])){
	$id_barang = $_POST['id_barang'];
	$kode_barang = $_POST['kode_barang'];
	$nama_barang = $_POST['nama_barang'];
	$stok = $_POST['stok'];
	$harga_1 = $_POST['harga_1'];
	$harga_2 = $_POST['harga_2'];
	$harga_3 = $_POST['harga_3'];
	$edit_data_barang = $system->edit_data_barang($id_barang,$kode_barang, $nama_barang, $stok, $harga_1, $harga_2, $harga_3);
	echo $system->convert_to_json($edit_data_barang);
}elseif(isset($_POST['delete_barang'])){
	$id_barang = $_POST['id'];
	$delete_barang = $system->delete_data_barang($id_barang);
	echo $system->convert_to_json($delete_barang);
}elseif (isset($_POST['add_pesanan'])) {
	$trx_code = $_POST['trx_code'];
	$_SESSION['trx_code'] = $trx_code;
	$jenis_pemesanan = @$_POST['jenis_pemesanan'];
	$model_baju = @$_POST['model_baju'];
	$jenis_sablon = implode(",", @$_POST['jenis_sablon']);
	$keterangan = @$_POST['keterangan'];
		//Memanggil fungsi
	include 'upload_files.php';
		//Sablon Depan
	$sablon_depan = @$_FILES['sablon_depan'];
	$data_sablon_depan = array(
		'nama_file' => $sablon_depan['name'], 
		'ukuran_file' => $sablon_depan['size'], 
		'tipe_file' => $sablon_depan['type'], 
		'tmp_file' => $sablon_depan['tmp_name'], 
		'lokasi' => "image/sablon_depan", 
		'trx_code' => $trx_code, 
		'type' => "depan", 
	);
		//Sablon Belakang
	$sablon_belakang = @$_FILES['sablon_belakang'];
	$data_sablon_belakang = array(
		'nama_file' => $sablon_belakang['name'], 
		'ukuran_file' => $sablon_belakang['size'], 
		'tipe_file' => $sablon_belakang['type'], 
		'tmp_file' => $sablon_belakang['tmp_name'], 
		'lokasi' => "image/sablon_belakang", 
		'trx_code' => $trx_code, 
		'type' => "belakang", 
	);
		//Proses Upload
	$upload_depan = upload_image($data_sablon_depan);		
	$upload_belakang = upload_image($data_sablon_belakang);
		//Selesai upload
	$image_depan = @$upload_depan['image'];
	$image_belakang = @$upload_belakang['image'];
		//
	$data = array(
		'trx_code' => $trx_code,
		'model_baju' => $model_baju,
		'jenis_pemesanan' => $jenis_pemesanan,
		'jenis_sablon' => $jenis_sablon,
		'keterangan' => $keterangan,
		'sablon_depan' => $image_depan,
		'sablon_belakang' => $image_belakang,
		'status' => 'diproses',
	);
	$transaksi = $system->add_transaksi_pemesanan($data);
	$msg = array(
		'upload_depan' => $upload_depan,
		'upload_belakang' => $upload_belakang,
		'transaksi' => $transaksi,
	); 
	echo $system->convert_to_json($msg);
}elseif(isset($_POST['add_barang_pesanan'])){
	$id = $_POST['id'];
	$jumlah = $_POST['jumlah'];
	$add_cart = $system->add_cart_pemesanan($id, $jumlah);
	if ($add_cart) {
		$msg = array(
			'success' => true,
			'message' => 'Berhasil menambah barang',
		);
	}
	echo $system->convert_to_json($msg);
}elseif (isset($_POST['delete_customer'])) {
	$id = $_POST['id'];
	$delete = $system->delete_customer($id);
	echo $system->convert_to_json($delete);
}elseif (isset($_POST['detail_customer'])) {
	$id = $_POST['id'];
	$detail = $system->detail_customer($id);
	echo $system->convert_to_json($detail);
}elseif (isset($_POST['batalkan_pesanan'])) {
	$trx_code = $_SESSION['trx_code'];
	$delete = $system->delete_trx_pemesanan($trx_code);
	if ($delete) {
		unset($_SESSION['id_customer']);
		unset($_SESSION['cart_pemesanan']);
		unset($_SESSION['trx_code']);
		$msg = array(
			'success' => true,
			'message' => 'Berhasil mereset!'
		);
	}else{
		$msg = array(
			'success' => false,
			'message' => 'Gagal!'
		);
	}
	echo $system->convert_to_json($msg);
}
?>