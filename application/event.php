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

	}
 ?>