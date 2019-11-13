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
			return json_decode($data, true);
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
		function customer_add($fullname, $phone, $ig, $role){
			$msg = null;
			$fullname = $this->real_escape_string($fullname);
			$phone = $this->real_escape_string($phone);
			$ig = "@".$this->real_escape_string($ig);
			$role = $this->real_escape_string($role);
			$sql = "INSERT INTO customer (nama_lengkap, phone, instagram, role, created_at) VALUES ('$fullname', '$phone', '$ig', '$role', NOW())";
			$query = $this->query($sql);
			if ($query) {
				$msg = array(
					'success' => true,
					'message' => "Customer baru berhasil ditambahkan!"
				);
			}else{
				$msg = array(
					'success' => false,
					'message' => "Error!"
				);
			}
			return @$msg;
		}
		function list_customer(){
			$sql = "SELECT * FROM customer WHERE 1=1";
			$query = $this->query($sql);
			$i = 0;
			while ($res = $query->fetch_assoc()) {
				$data[$i] = array(
					'id_customer' => $res['id_customer'],
					'nama_lengkap' => $res['nama_lengkap'],
					'phone' => $res['phone'],
					'instagram' => $res['instagram'],
					'role' => $res['role'],
					'created_at' => $res['created_at'],
				);
				$i++;
			}
			return @$data;
		}
		function get_info_customer(){
			if (isset($_SESSION['id_customer'])) {
				$id = @$_SESSION['id_customer'];
				$sql = "SELECT * FROM customer WHERE id_customer = '$id'";
				$query = $this->query($sql);
				$res = $query->fetch_assoc();
				return $res;
			}else{
				return null;
			}


		}
	}
	$system = new System();
	$setting = $system->get_setting();
	$logged = $system->check_logged();
	$admin = $system->get_admin();
 ?>