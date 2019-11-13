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
	}
 ?>