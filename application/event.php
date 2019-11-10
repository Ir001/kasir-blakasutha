<?php 
	require 'system.php';
	if (isset($_POST['user_login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$login = $system->login_user($username, $password);
		echo $system->convert_to_json($login);
	}
 ?>