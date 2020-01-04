<?php 
	// require 'system.php';
	require_once (dirname(__FILE__)."/system.php");
	if (isset($_POST['edit_status'])) {
		$status = $_POST['status'];
		$trx_code = $_POST['trx_code'];
		$edit = $system->edit_status_pemesanan($status, $trx_code);
		echo json_encode($edit);
	}elseif (isset($_POST['edit_cart'])) {
		$id = $_POST['id'];
		$jumlah = $_POST['jumlah'];
		$_SESSION['cart_pemesanan'][$id] = $jumlah;
		$msg['success'] = true;
		$msg['message'] = 'Berhasil mengubah keranjang!';
		echo json_encode($msg);
	}elseif (isset($_POST['delete_cart'])) {
		$id = $_POST['id'];
		unset($_SESSION['cart_pemesanan'][$id]);
		$msg['success'] = true;
		$msg['message'] = 'Berhasil menghapus barang!';
		echo json_encode($msg);
	}elseif (isset($_POST['add_pesanan'])) {
		$trx_code = $_POST['trx_code'];
		$type = $_POST['type'];
		$_SESSION['trx_code'] = $trx_code;
		$_SESSION['type'] = $type;
		$jenis_pemesanan = @$_POST['jenis_pemesanan'];
		$type = @$_POST['type'];
		$harga_tambahan = @$_POST['harga_tambahan'] ? $_POST['harga_tambahan'] : 0;
		$model_baju = @$_POST['model_baju'];
		$jenis_sablon = implode(",", @$_POST['jenis_sablon']);
		$keterangan = @$_POST['keterangan'];
		$perkiraan_selesai = @$_POST['perkiraan_selesai'];
			//Memanggil fungsi
		include 'upload_files.php';
			//Sablon Depan
		$file_desain = @$_FILES['file_desain'];
		$data_file_desain = array(
			'nama_file' => $file_desain['name'], 
			'ukuran_file' => $file_desain['size'], 
			'tipe_file' => $file_desain['type'], 
			'tmp_file' => $file_desain['tmp_name'], 
			'lokasi' => "file_desain", 
			'trx_code' => $trx_code, 
		);
			//Proses Upload
		$upload_file_desain = upload_image($data_file_desain);		
			//Selesai upload
		$image_file_desain = @$upload_file_desain['image'];
			//
		$data = array(
			'trx_code' => $trx_code,
			'model_baju' => $model_baju,
			'type' => $type,
			'jenis_pemesanan' => $jenis_pemesanan,
			'harga_tambahan' => $harga_tambahan,
			'jenis_sablon' => $jenis_sablon,
			'keterangan' => $keterangan,
			'file_desain' => $image_file_desain,
			'perkiraan_selesai' => $perkiraan_selesai,
			'status' => 'diproses',
		);
		$transaksi = $system->add_transaksi_pemesanan($data);
		$msg = array(
			'upload' => $upload_file_desain,
			'transaksi' => $transaksi,
		); 
		echo json_encode($msg);
	}elseif (isset($_POST['batalkan_pesanan'])) {
		$trx_code = $_SESSION['trx_code'];
		$delete = $system->delete_pemesanan($trx_code);
		unset($_SESSION['id_customer']);
		unset($_SESSION['cart_pemesanan']);
		unset($_SESSION['trx_code']);
		unset($_SESSION['type']);
		$msg = array(
			'success' => true,
			'message' => 'Berhasil mereset!'
		);
		echo json_encode($msg);
	}elseif(isset($_POST['form_bayar_pesanan'])){
		$id_customer = $_POST['id_customer'];
		$jumlah_bayar = $_POST['total_bayar'];
		$total_harga = $_POST['total_harga'];
		$jumlah_pesanan = $_POST['jumlah_pesanan'];
		$trx_code = $_POST['trx_code'];
		$kurang = $_POST['kekurangan'];
		$data = array (
			'trx_code' => $trx_code,
			'total_harga' => $total_harga,
			'jumlah_bayar' => $jumlah_bayar,
			'jumlah_pesanan' => $jumlah_pesanan,
			'kurang' => $kurang,
		);
		$transaksi = $system->update_buat_pesanan($data);
		if ($transaksi) {
			foreach ($_SESSION['cart_pemesanan'] as $id_barang => $jumlah) {
				$pemesanan = $system->pemesanan($id_customer, $id_barang, $trx_code, $jumlah);
				if ($pemesanan) {
					$msg = array(
						'success' => true,
						'message' => 'Berhasil melakukan transaksi',
						'trx_code' => $trx_code,
					);
				}else{
					$msg = array(
						'success' => false,
						'message' => 'Gagal saat melakukan penjualan',
						'trx_code' => null,

					);
				}

			}
		}else{
			$msg = array(
				'success' => false,
				'message' => 'Gagal saat melakukan transaksi',
				'trx_code' => null,
			);
		}
		echo $system->convert_to_json($msg);
		if ($msg['success'] == true) {
			unset($_SESSION['cart_pemesanan']);
			unset($_SESSION['id_customer']);
			unset($_SESSION['trx_code']);
			unset($_SESSION['type']);
		}
		
	}elseif (isset($_POST['hapus_pemesanan'])) {
		$trx_code = $_POST['trx_code'];
		$delete = $system->delete_pemesanan($trx_code);
		echo json_encode($delete);
	}
 ?>