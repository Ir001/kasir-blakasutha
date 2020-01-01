<?php 
	// require 'system.php';
	require_once (dirname(__FILE__)."/system.php");
	if (isset($_POST['detail_customer'])) {
		$id_user = $_POST['id'];
		$detail = $system->detail_customer($id_user);
		echo json_encode($detail);
	}elseif(isset($_POST['edit_customer'])){
		$id_user = $_POST['id_user'];
		$nama_lengkap = $_POST['nama_lengkap'];
		$phone = $_POST['phone'];
		$instagram = $_POST['instagram'];
		$role = $_POST['role'];
		//
		$data = array(
			'id_user' => $id_user,
			'nama_lengkap' => $nama_lengkap,
			'phone' => $phone,
			'instagram' => $instagram,
			'role' => $role,
		);
		$update = $system->update_customer($data);
		echo json_encode($update);
	}
 ?>