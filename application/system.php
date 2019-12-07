<?php
date_default_timezone_set('Asia/Jakarta');
date("Y-m-d H:i:s"); 
ob_start();
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
					'message' => 'Sedang menyiapkan. Harap tunggu',
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
	function detail_customer($id){
		$check_penjualan = "SELECT count(*) FROM penjualan WHERE id_customer = $id";
		$query_penjualan = $this->query($check_penjualan);
		$penjualan = $query_penjualan->fetch_assoc();
		$check_pemesanan = "SELECT count(*) FROM pemesanan WHERE id_customer = $id";
		$query_pemesanan = $this->query($check_penjualan);
		$pemesanan = $query_pemesanan->fetch_assoc();
			//
		$sql = "SELECT * FROM customer WHERE id_customer = $id";
		$query = $this->query($sql);
		$data_customer = $query->fetch_assoc();
		$data = array(
			'penjualan' => $penjualan['count(*)'],
			'pemesanan' => $pemesanan['count(*)'],
			$data_customer,
		);
		return @$data;
	}
	function delete_customer($id){
		$sql = "DELETE FROM customer WHERE id_customer = $id";
		$query = $this->query($sql);
		if ($query) {
			$msg = array(
				'success' => true,
				'message' => 'Berhasil menghapus customer!'
			);
		}else{
			$msg = array(
				'success' => false,
				'message' => 'Terjadi kesalahan!'
			);
		}
		return $msg;
	}

	function add_data_barang($kode_barang, $nama_barang, $stok, $harga_1, $harga_2, $harga_3){
		$kode_barang = $this->real_escape_string($kode_barang);
		$nama_barang = $this->real_escape_string($nama_barang);
		$sql_check_kode = $this->query("SELECT kode_barang FROM barang WHERE kode_barang = '$kode_barang'");
		$checked_kode = $sql_check_kode->num_rows;
		if ($checked_kode >= 1) {
			$msg = array(
				'success' => false,
				'message' => "Kode barang sudah terdaftar!"
			);
		}else{

			$sql = "INSERT INTO barang (kode_barang, nama_barang, stok, harga_1, harga_2, harga_3, updated_at) VALUES ('$kode_barang', '$nama_barang', '$stok', '$harga_1', '$harga_2', '$harga_3', NOW())";
			$query = $this->query($sql);
			if ($query) {
				$msg = array(
					'success' => true,
					'message' => "Barang berhasil ditambahkan!"
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
	function edit_data_barang($id_barang, $kode_barang, $nama_barang, $stok, $harga_1, $harga_2, $harga_3){
		$kode_barang = $this->real_escape_string($kode_barang);
		$nama_barang = $this->real_escape_string($nama_barang);
		$sql_check_kode = $this->query("SELECT kode_barang FROM barang WHERE kode_barang = '$kode_barang'");
		$checked_kode = $sql_check_kode->num_rows;
		if ($checked_kode > 1) {
			$msg = array(
				'success' => false,
				'message' => "Kode barang sudah terdaftar!"
			);
		}else{

			$sql = "UPDATE barang SET kode_barang = '$kode_barang', nama_barang = '$nama_barang', stok = '$stok', harga_1 ='$harga_1',harga_2 = '$harga_2', harga_3 ='$harga_3' WHERE id_barang = $id_barang";
			$query = $this->query($sql);
			if ($query) {
				$msg = array(
					'success' => true,
					'message' => "Barang berhasil diubah!"
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
	function delete_data_barang($id_barang){
		$sql = "DELETE FROM barang WHERE id_barang = '$id_barang'";
		$query  = $this->query($sql);
		$msg = array(
			'success' => true,
			'message' => 'Berhasil menghapus barang!'
		);
		return @$msg;
	}
	function get_detail_barang($id_barang){
		$sql = "SELECT * FROM barang WHERE id_barang = '$id_barang'";
		$query  = $this->query($sql);
		$res = $query->fetch_assoc();
		return @$res;
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
			$_SESSION['cart'][$id]=$jumlah;
		}else{
			$jumlah_aktif = $_SESSION['cart'][$id];
			$_SESSION['cart'][$id]=$jumlah+$jumlah_aktif;
		}
		return 1;
	}
	function add_cart_pemesanan($id, $jumlah){
		if (empty($_SESSION['cart_pemesanan'][$id])) {
			$_SESSION['cart_pemesanan'][$id]=$jumlah;
		}else{
			$jumlah_aktif = $_SESSION['cart_pemesanan'][$id];
			$_SESSION['cart_pemesanan'][$id]=$jumlah+$jumlah_aktif;
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
		$barang = $this->get_info_barang($id_barang);
		if($jumlah > 12){
			$harga = $barang['harga_2'];
			$total = $harga*$jumlah;
		}elseif ($jumlah > 24) {
			$harga = $barang['harga_3'];
			$total = $harga*$jumlah;
		}else{
			$harga = $barang['harga_1'];
			$total = $harga*$jumlah;
		}
		$sql = "INSERT INTO penjualan (id_customer, id_barang, trx_code, subharga , jumlah, tgl_penjualan) VALUES ($id_customer, $id_barang, '$trx_code', '$harga' , '$jumlah', NOW())";
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
			return true;
		}else{
			return false;
		}
	}
	function detail_trx($trx_code){
		$trx_code = trim($this->real_escape_string($trx_code));
		$sql = "SELECT transaksi.trx_code,total_harga, jumlah_bayar, tgl_transaksi,id_customer  FROM transaksi INNER JOIN penjualan ON transaksi.trx_code = penjualan.trx_code WHERE transaksi.trx_code = '$trx_code' GROUP BY id_customer";
		$query = $this->query($sql);
		$res = $query->fetch_assoc();
		return $res;

	}
	function view_trx($trx_code){
		$trx_code = trim($this->real_escape_string($trx_code));
		$sql = "SELECT * FROM transaksi LEFT OUTER JOIN penjualan ON transaksi.trx_code = penjualan.trx_code WHERE penjualan.trx_code = '$trx_code'";
		$query = $this->query($sql);
		if ($query) {
				// $res = $query->fetch_assoc();
			$i=0;
			while ($res = $query->fetch_assoc()) {
				$data[$i] = array(
					'id_customer' => $res['id_customer'],
					'id_barang' => $res['id_barang'],
					'jumlah' => $res['jumlah'],
					'subharga' => $res['subharga'],
					'trx_code' => $res['trx_code'],
					'tgl_transaksi' => $res['tgl_transaksi'],
					'total_harga' => $res['total_harga'],
					'jumlah_bayar' => $res['jumlah_bayar'],
				);
				$i++;

			}



		}
		return @$data;
	}
	function list_trx_penjualan(){
			// $sql = "SELECT * FROM transaksi LEFT OUTER JOIN penjualan ON transaksi.trx_code = penjualan.trx_code";
		$sql = "SELECT * FROM transaksi INNER JOIN penjualan ON transaksi.trx_code = penjualan.trx_code GROUP BY transaksi.trx_code ORDER BY tgl_transaksi DESC";
		$query = $this->query($sql);
		$i = 0;
		while ($res = $query->fetch_assoc()) {
			$data[$i] = array(
				'id_trx' => $res['id_trx'],
				'id_customer' => $res['id_customer'],
				'trx_code' => $res['trx_code'],
				'total_harga' => $res['total_harga'],
				'tgl_transaksi' => $res['tgl_transaksi'],
			);
			$i++;
		}
		return @$data;
	}
	function create_pesanan($data = array()){
		$trx_code = $data['trx_code'];
		$jenis_pemesanan = $data['jenis_pemesanan'];
		$sablon_depan = $data['sablon_depan'];
		$sablon_belakang = $data['sablon_belakang'];
		$model_baju = $data['model_baju'];
		$jenis_sablon = $data['jenis_sablon'];
		$keterangan = $data['keterangan'];
			//
		$pendek_s = $data['pendek_s'];
		$pendek_m = $data['pendek_m'];
		$pendek_l = $data['pendek_l'];
		$pendek_xl = $data['pendek_xl'];
		$pendek_xxl = $data['pendek_xxl'];
		$pendek_xxxl = $data['pendek_xxxl'];
			//
		$panjang_s = $data['panjang_s'];
		$panjang_m = $data['panjang_m'];
		$panjang_l = $data['panjang_l'];
		$panjang_xl = $data['panjang_xl'];
		$panjang_xxl = $data['panjang_xxl'];
		$panjang_xxxl = $data['panjang_xxxl'];
			//
		$jumlah_pesanan = $data['jumlah_pesanan'];
		$total = $data['total'];


	}
	function edit_setting($data = array()){
		$nama_bisnis = $data['nama_bisnis'];
		$alamat = $data['alamat'];
		$phone = $data['phone'];
		$email = $data['email'];
		$instagram = $data['instagram'];
		$ucapan = $data['ucapan'];
			//
		$sql = "UPDATE setting SET nama_bisnis = '$nama_bisnis', alamat ='$alamat', phone='$phone', email='$email', instagram='$instagram', ucapan='$ucapan', update_at=NOW() WHERE id=1";
		$query = $this->query($sql);
		if ($query) {
			$msg = array(
				'success' => true,
				'message' => 'Berhasil mengubah pengaturan',
			);
		}else{
			$msg = array(
				'success' => false,
				'message' => 'Terjadi kesalahan',
			);
		}
		return $msg;
	}
	function edit_akun($data = array()){
		$id_admin = $data['id_admin'];
		$username = $data['username'];
		$fullname = $data['fullname'];
			//
		$sql = "UPDATE admin SET username = '$username', fullname ='$fullname' WHERE id_admin=$id_admin";
		$query = $this->query($sql);
		if ($query) {
			$msg = array(
				'success' => true,
				'message' => 'Berhasil mengubah data!',
			);
		}else{
			$msg = array(
				'success' => false,
				'message' => 'Terjadi kesalahan',
			);
		}
		return $msg;
	}
	function edit_password($data = array()){
		$id_admin = $data['id_admin'];
		$old_password = $data['old_password'];
		$new_password = $data['new_password'];
		$confirm_password = $data['confirm_password'];
			//
		$check_admin = $this->query("SELECT password FROM admin WHERE id_admin = $id_admin");
		$data_admin = $check_admin->fetch_assoc();
		$password_old = $data_admin['password'];
		if ($old_password == $password_old) {
			if ($new_password == $confirm_password) {
				$sql = "UPDATE admin SET password = '$new_password' WHERE id_admin=$id_admin";
				$query = $this->query($sql);
				if ($query) {
					$msg = array(
						'success' => true,
						'message' => 'Berhasil mengubah kata sandi!',
					);
				}else{
					$msg = array(
						'success' => false,
						'message' => 'Terjadi kesalahan',
					);
				}
			}else{
				$msg = array(
					'success' => false,
					'message' => 'Konfirmasi tidak cocok!',
				);
			}
			
		}else{
			$msg = array(
				'success' => false,
				'message' => 'Password lama tidak cocok!',
			);
		}
			//

		return $msg;
	}
	/*
		Pemesanan Form

	*/
		function list_barang_pesanan(){
			$sql = "SELECT * FROM barang_pesanan WHERE 1=1";
			$query = $this->query($sql);
			$i = 0;
			while ($res = $query->fetch_assoc()) {
				$data[$i] = array(
					'id_barang' => $res['id_barang'],
					'nama_pesanan' => $res['nama_pesanan'],
					'harga_1' => $res['harga_1'],
					'harga_2' => $res['harga_2'],
					'harga_3' => $res['harga_3'],
					'updated_at' => $res['updated_at'],
				);
				$i++;
			}
			return @$data;
		}
		function detail_barang_pesanan($id_barang){
			$sql = "SELECT * FROM barang_pesanan WHERE id_barang = '$id_barang'";
			$query  = $this->query($sql);
			$res = $query->fetch_assoc();
			return @$res;
		}
		function add_transaksi_pemesanan($data=array()){
			$trx_code = $data['trx_code'];
			$jenis_pemesanan = $data['jenis_pemesanan'];
			$model_baju = $data['model_baju'];
			$jenis_sablon = $data['jenis_sablon'];
			$sablon_depan = @$data['sablon_depan'] ? $data['sablon_depan'] : "";
			$sablon_belakang = @$data['sablon_belakang'] ? $data['sablon_belakang'] : "";
		//
			$check = $this->query("SELECT trx_code FROM transaksi_pemesanan WHERE trx_code = '$trx_code'");
			$jumlah_trx_code = $check->num_rows;
			if ($jumlah_trx_code >= 1) {
				$msg = array(
					'success' => true,
					'message' => 'Trx code telah terdaftar, harap refresh halaman',
				);
			}else{
				$sql = "INSERT INTO transaksi_pemesanan (trx_code, jenis_pemesanan, model_baju, jenis_sablon, sablon_depan, sablon_belakang, status) VALUES ('$trx_code','$jenis_pemesanan','$model_baju','$jenis_sablon','$sablon_depan','$sablon_belakang','diproses')";
				$query = $this->query($sql);
				if ($query) {
					$msg = array(
						'success' => true,
						'message' => 'Transaksi berhasil dilakukan! Isi Form selanjutnya',
					);
				}else{
					$msg = array(
						'success' => false,
						'message' => 'Terjadi kesalahan',
					);
				}
			}
			return @$msg;

		}
		function update_buat_pesanan($data=array()){
			$total_harga = $data['total_harga'];
			$jumlah_bayar = $data['jumlah_bayar'];
			$jumlah_pesanan = $data['jumlah_pesanan'];
			$trx_code = $data['trx_code'];
			//
			$sql = "UPDATE transaksi_pemesanan SET total_harga = '$total_harga', jumlah_bayar ='$jumlah_bayar', jumlah_pesanan='$jumlah_pesanan', tgl_transaksi = NOW() WHERE trx_code = '$trx_code'";
			$query = $this->query($sql);
			if ($query) {
				return 1;
			}else{
				return 0;
			}
		}
		function pemesanan($id_customer, $id_barang, $trx_code, $jumlah){
			$barang = $this->detail_barang_pesanan($id_barang);
			if($jumlah > 12){
				$harga = $barang['harga_2'];
				$total = $harga*$jumlah;
			}elseif ($jumlah > 24) {
				$harga = $barang['harga_3'];
				$total = $harga*$jumlah;
			}else{
				$harga = $barang['harga_1'];
				$total = $harga*$jumlah;
			}
			$sql = "INSERT INTO pemesanan (id_customer, id_barang, trx_code, subharga , jumlah, tanggal_order) VALUES ($id_customer, $id_barang, '$trx_code', '$harga' , '$jumlah', NOW())";
			$query = $this->query($sql);
			if($query){
				return 1;
			}else{
				return 0;
			}

		}
		function delete_trx_pemesanan($trx_code){
			$delete = $this->query("DELETE FROM transaksi_pemesanan WHERE trx_code = '$trx_code'");
			if ($delete) {
				return 1;
			}else{
				return 0;
			}
		}

	}
	$system = new System();
	$setting = $system->get_setting();
	$logged = $system->check_logged();
	$admin = $system->get_admin();
	?>