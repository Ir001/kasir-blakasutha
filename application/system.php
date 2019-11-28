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
			session_destroy();
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
			$check_ig = substr($ig, 0, 1);
			if ($check_ig == "@") {
				$ig = $this->real_escape_string($ig);
			}else{
				$ig = "@".$this->real_escape_string($ig);
			}
			$role = $this->real_escape_string($role);
			//
			$sql_check_phone = $this->query("SELECT phone FROM customer WHERE phone = '$phone'");
			$checked_phone = $sql_check_phone->num_rows;
			if ($checked_phone >= 1) {
				$msg = array(
					'success' => false,
					'message' => "Nomor telephone telah terdaftar!"
				);
			}else{
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
		function list_barang(){
			$sql = "SELECT * FROM barang WHERE 1=1";
			$query = $this->query($sql);
			$i = 0;
			while ($res = $query->fetch_assoc()) {
				$data[$i] = array(
					'id_barang' => $res['id_barang'],
					'kode_barang' => $res['kode_barang'],
					'nama_barang' => $res['nama_barang'],
					'stok' => $res['stok'],
					'harga_1' => $res['harga_1'],
					'harga_2' => $res['harga_2'],
					'harga_3' => $res['harga_3'],
					'updated_at' => $res['updated_at'],
				);
				$i++;
			}
			return @$data;
		}
		function get_info_barang($id){
				$sql = "SELECT * FROM barang WHERE id_barang = '$id'";
				$query = $this->query($sql);
				$res = $query->fetch_assoc();
				return @$res;
		}
		function add_cart($id, $jumlah){
			if (empty($_SESSION['cart'][$id])) {
				$_SESSION['cart'][$id]=1;
			}else{
				$jumlah_aktif = $_SESSION['cart'][$id];
				$_SESSION['cart'][$id]=$jumlah+$jumlah_aktif;
			}
			return 1;
		}
		function remove_cart($id){
			unset($_SESSION['cart'][$id]);
			return 1;
		}
		function generate_trx_code($length = 10) {
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
		}
		function penjualan($id_customer, $id_barang, $trx_code, $jumlah){
			// $data_customer = get_info_customer($id_customer);
			// $data_barang = get_info_customer($id_barang);
			$sql = "INSERT INTO penjualan (id_customer, id_barang, trx_code, jumlah, tgl_penjualan) VALUES ($id_customer, $id_barang, '$trx_code', '$jumlah', NOW())";
			$query = $this->query($sql);
			if($query){
				$sql_update = "UPDATE barang SET stok = stok-$jumlah WHERE id_barang = $id_barang";
				$query_update = $this->query($sql_update);
				if($query_update){
						$msg = array(
						'success' => true,
						'message' => 'Transaksi sukses!',
						'trx_id' => $trx_code,
					);
				}else{
					$msg = array(
						'success' => false,
						'message' => 'Gagal pada update stok!',
						'trx_id' => $trx_code,
					);
				}
			}else{
				$msg = array(
					'success' => false,
					'message' => 'Transaksi gagal!',
					'trx_id' => $trx_code,
				);
			}
			return $msg;

		}
		function trx($trx_code, $total_harga, $jumlah_bayar){
			$sql = "INSERT INTO transaksi (trx_code, total_harga, jumlah_bayar, tgl_transaksi) VALUES ('$trx_code', '$total_harga', '$jumlah_bayar', NOW())";
			$query = $this->query($sql);
			if($query){
				$msg = array(
					'success' => true,
					'message' => 'Berhasil menyimpan data transaksi'
				);
			}else{
				$msg = array(
					'success' => false,
					'message' => 'Gagal menyimpan data transaksi'
				);
			}
			return $msg;
		}
		function view_trx($trx_code){
			$sql = "SELECT * FROM penjualan LEFT JOIN transaksi ON penjualan.trx_code = transaksi.trx_code LEFT JOIN barang ON penjualan.id_barang=barang.id_barang LEFT JOIN customer ON customer.id_customer = penjualan.id_customer WHERE penjualan.trx_code = '$trx_code'";
			$query = $this->query($sql);
			if ($query) {
				// $res = $query->fetch_assoc();
				$i=0;
				while ($res = $query->fetch_assoc()) {
					$data['nama_lengkap'] = $res['nama_lengkap'];
					$data['trx_code'] = $res['trx_code'];
					$data['total_harga'] = $res['total_harga'];
					$data['jumlah_bayar'] = $res['jumlah_bayar'];
					$data['tgl_transaksi'] = $res['tgl_transaksi'];
					$data[$i] = array(
							'kode_barang' => $res['kode_barang'],
							'nama_barang' => $res['nama_barang'],
							'jumlah' => $res['jumlah'],
							'harga_1' => $res['harga_1'],
							'harga_2' => $res['harga_2'],
							'harga_3' => $res['harga_3'],
					);
					$i++;

				}


				
			}
			return @$data;
		}
	}
	$system = new System();
	$setting = $system->get_setting();
	$logged = $system->check_logged();
	$admin = $system->get_admin();
 ?>