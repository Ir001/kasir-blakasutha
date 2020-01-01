<?php 
require '../application/system.php';
header("Content-Type: application/json");
if (isset($_POST['id_barang'])) {
	$id = $_POST['id_barang'];
	$data = $system->get_detail_barang($id);
	echo $system->convert_to_json($data);
}elseif (isset($_POST['detail_customer'])) {
		$id = $_POST['id'];
		$detail = $system->detail_customer($id);
		echo $system->convert_to_json($detail);
}elseif (isset($_POST['edit_setting'])) {
	$nama_bisnis = $_POST['nama_bisnis'];
	$alamat = $_POST['alamat'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$instagram = $_POST['instagram'];
	$ucapan = $_POST['ucapan'];
	$data = array(
		'nama_bisnis' => $nama_bisnis,
		'alamat' => $alamat,
		'email' => $email,
		'phone' => $phone,
		'instagram' => $instagram,
		'ucapan' => $ucapan,
	);
	$edit_setting = $system->edit_setting($data);
	echo $system->convert_to_json($edit_setting);

}elseif (isset($_POST['change_password'])) {
	$id_admin = $_POST['id_admin'];
	$old_password = md5($_POST['old_password']);
	$new_password = md5($_POST['new_password']);
	$confirm_password = md5($_POST['confirm_password']);
	//
	$data = array(
		'id_admin' => $id_admin,
		'old_password' => $old_password,
		'new_password' => $new_password,
		'confirm_password' => $confirm_password,
	);
	$edit_password = $system->edit_password($data);
	echo $system->convert_to_json($edit_password);
}elseif (isset($_POST['edit_akun'])) {
	$id_admin = $_POST['id_admin'];
	$username = $_POST['username'];	
	$fullname = $_POST['fullname'];	
	//
	$data = array(
		'id_admin' => $id_admin,
		'username' => $username,
		'fullname' => $fullname,
	);
	$edit_akun = $system->edit_akun($data);
	echo $system->convert_to_json($edit_akun);
}elseif (isset($_POST['edit_barang_pemesanan'])) {
	$id = $_POST['id'];
	$data = $system->detail_barang_pesanan($id);
	echo json_encode($data);
}
?>