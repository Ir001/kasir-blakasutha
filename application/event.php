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

	}elseif(isset($_POST['form_bayar'])){
		$id_customer = $_POST['id_customer'];
		$jumlah_bayar = $_POST['jumlah_bayar'];
		$total = $_POST['total'];

		$trx_code = $system->generate_trx_code();
		$transaksi = $system->trx($trx_code, $total, $jumlah_bayar);
		if ($transaksi) {
			foreach ($_SESSION['cart'] as $id_barang => $jumlah) {
				$penjualan = $system->penjualan($id_customer, $id_barang, $trx_code, $jumlah);
				if ($penjualan) {
					// unset($_SESSION['cart']);
					// unset($_SESSION['id_customer']);
					$msg = array(
						'success' => true,
						'message' => 'Berhasil melakukan transaksi',
					);
				}else{
					$msg = array(
						'success' => false,
						'message' => 'Gagal saat melakukan penjualan',

					);
				}

			}
		}else{
			$msg = array(
						'success' => false,
						'message' => 'Gagal saat melakukan transaksi',
			);
		}
		echo $system->convert_to_json($msg);

	}
 ?>