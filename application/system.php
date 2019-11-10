<?php
	date_default_timezone_set('Asia/Jakarta');
	session_start();
	require 'config.php';
	class System extends mysqli{
		function __construct(){
			parent::__construct(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				if (mysqli_connect_error()) {
					exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
				}
			
			parent::set_charset('utf-8');
		}
		function convert_to_json($data = array()){
			return json_encode($data);
		}
		function convert_to_object($data = array()){
			return json_decode($data, 1);
		}
		function login_user($username, $password){
			$msg = array();
			$username = $this->real_escape_string($username);
			$password = $this->real_escape_string(md5($password));
			//
			$sql = "SELECT * FROM admin WHERE username = '$username'";
			$query =  $this->query($sql);
			$row = $query->num_rows;
			if ($row >= 1) {
				$info_user = $query->fetch_assoc();
				if ($info_user['password'] == $password) {
					$msg = array(
						'success' => true,
						'message' => 'Harap tunggu',
						'info_user' => $info_user,
					);
					$_SESSION['user'] = $info_user;
				}else{
					$msg = array(
						'success' => false,
						'message' => 'Kata sandi salah!',
						'info_user' => null,
					);

				}
				
			}else{
				$msg = array(
					'success' => false,
					'message' => 'Username tidak terdaftar!',
					'info_user' => null,
				);

			}
			return @$msg;
		}
		function check_logged(){
			if (isset($_SESSION['user'])) {
				return true;
			}else{
				return false;
			}
		}
		function logout(){
			unset($_SESSION['user']);
			return 1;
		}
		function get_setting(){
			$sql = "SELECT * FROM setting WHERE 1=1";
			$query = $this->query($sql);
			//
			$info_setting = $query->fetch_assoc();
			return @$info_setting;
		}
		function get_admin(){
			$id = @$_SESSION['user']['id_admin'];
			$sql = "SELECT * FROM admin WHERE id_admin = $id";
			$query = $this->query($sql);
			$row = @$query->num_rows;
			if ($row >= 1) {
				$res = $query->fetch_assoc();
			}
			return @$res;
		}
	}
	$system = new System();
	$setting = $system->get_setting();
	$logged = $system->check_logged();
	$admin = $system->get_admin();
 ?>