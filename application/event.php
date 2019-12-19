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
	$customer = $system->get_info_customer($id_customer);
	if ($transaksi) {  
		foreach ($_SESSION['cart'] as $id_barang => $jumlah) {
			$data = $system->get_info_barang($id_barang);
			if($jumlah > 12){
				if($customer['role'] == "reseller"){
					$harga = $data['harga_2']-$data['harga_2']*10/100;
				}else{
					$harga = $data['harga_2'];
				}
			}elseif ($jumlah > 24) {
				if($customer['role'] == "reseller"){
					$harga = $data['harga_3']-$data['harga_3']*10/100;
				}else{
					$harga = $data['harga_3'];
				}
			}else{
				if($customer['role'] == "reseller"){
					$harga = $data['harga_1']-$data['harga_3']*10/100;
				}else{
					$harga = $data['harga_1'];
				}
			}
			$penjualan = $system->penjualan($id_customer, $id_barang, $trx_code, $harga, $jumlah);
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
	$kurang = $_POST['kekurangan'];
	$data = array (
		'trx_code' => $trx_code,
		'total_harga' => $total_harga,
		'jumlah_bayar' => $jumlah_bayar,
		'jumlah_pesanan' => $jumlah_pesanan,
		'kurang' => $kurang,
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
	echo $system->convert_to_json($msg);
	if ($msg['success'] == true) {
		unset($_SESSION['cart_pemesanan']);
		unset($_SESSION['id_customer']);
		unset($_SESSION['trx_code']);
	}
	
}elseif(isset($_POST['add_data_barang'])){
	$kode_barang = $_POST['kode_barang'];
	$nama_barang = $_POST['nama_barang'];
	$stok = $_POST['stok'];
	$harga_1 = $_POST['harga_1'];
	$harga_2 = $_POST['harga_2'];
	$harga_3 = $_POST['harga_3'];
	$add_data_barang = $system->add_data_barang($kode_barang, $nama_barang, $stok, $harga_1, $harga_2, $harga_3);
	echo $system->convert_to_json($add_data_barang);
}elseif(isset($_POST['add_data_barang_pesanan'])){
	$nama_pesanan = $_POST['nama_pesanan'];
	$ukuran = $_POST['ukuran'];
	$harga_1 = $_POST['harga_1'];
	$harga_2 = $_POST['harga_2'];
	$harga_3 = $_POST['harga_3'];
	$add_data_barang = $system->add_data_barang_pesanan($nama_pesanan, $ukuran, $harga_1, $harga_2, $harga_3);
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
}elseif(isset($_POST['delete_barang_pesanan'])){
	$id_barang = $_POST['id'];
	$delete_barang = $system->delete_data_barang_pesanan($id_barang);
	echo $system->convert_to_json($delete_barang);
}elseif (isset($_POST['add_pesanan'])) {
	$trx_code = $_POST['trx_code'];
	$_SESSION['trx_code'] = $trx_code;
	$jenis_pemesanan = @$_POST['jenis_pemesanan'];
	$model_baju = @$_POST['model_baju'];
	$jenis_sablon = implode(",", @$_POST['jenis_sablon']);
	$keterangan = @$_POST['keterangan'];
	$perkiraan_selesai = @$_POST['perkiraan_selesai'];
		//Memanggil fungsi
	include 'upload_files.php';
		//Sablon Depan
	$file_desain = @$_FILES['file_desain'];
	$data_file_desain = array(
		'nama_file' => $file_desain['name'], 
		'ukuran_file' => $file_desain['size'], 
		'tipe_file' => $file_desain['type'], 
		'tmp_file' => $file_desain['tmp_name'], 
		'lokasi' => "image", 
		'trx_code' => $trx_code, 
	);
		//Proses Upload
	$upload_file_desain = upload_image($data_file_desain);		
		//Selesai upload
	$image_file_desain = @$upload_file_desain['image'];
		//
	$data = array(
		'trx_code' => $trx_code,
		'model_baju' => $model_baju,
		'jenis_pemesanan' => $jenis_pemesanan,
		'jenis_sablon' => $jenis_sablon,
		'keterangan' => $keterangan,
		'file_desain' => $image_file_desain,
		'perkiraan_selesai' => $perkiraan_selesai,
		'status' => 'diproses',
	);
	$transaksi = $system->add_transaksi_pemesanan($data);
	$msg = array(
		'upload' => $upload_file_desain,
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