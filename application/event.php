<?php 
// require 'system.php';
require_once (dirname(__FILE__)."/system.php");
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
	$setelah_diskon = $_POST['setelah_diskon'];
	$diskon = $_POST['potongan_harga'];
	$trx_code = $_POST['trx_code'];
	/*Data Array */
	$data = array(
		'trx_code' => $trx_code,
		'subharga' => $total,
		'total' => $setelah_diskon,
		'diskon' => $diskon,
		'dibayar' => $jumlah_bayar,
	);
	$transaksi = $system->trx($data);
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
	if ($msg['success']) {
		unset($_SESSION['cart']);
		unset($_SESSION['id_customer']);
	}
	echo json_encode($msg);
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
}elseif(isset($_POST['edit_data_barang'])){
	$id_barang = $_POST['id_barang'];
	$kode_barang = $_POST['kode_barang'];
	$nama_barang = $_POST['nama_barang'];
	$stok = $_POST['stok'];
	$harga_1 = $_POST['harga_1'];
	$harga_2 = $_POST['harga_2'];
	$harga_3 = $_POST['harga_3'];
	#Data Array
	$data = array(
		'id_barang' => $id_barang,
		'kode_barang' => $kode_barang,
		'nama_barang' => $nama_barang,
		'stok' => $stok,
		'harga_1' => $harga_1,
		'harga_2' => $harga_2,
		'harga_3' => $harga_3,
	);
	$edit_data_barang = $system->edit_data_barang($id_barang,$kode_barang, $nama_barang, $stok, $harga_1, $harga_2, $harga_3);
	echo $system->convert_to_json($edit_data_barang);
}elseif(isset($_POST['delete_barang'])){
	$id_barang = $_POST['id'];
	$delete_barang = $system->delete_data_barang($id_barang);
	echo $system->convert_to_json($delete_barang);
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
}
?>