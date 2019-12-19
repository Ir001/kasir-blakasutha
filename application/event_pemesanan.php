<?php 
	require 'system.php';
	if (isset($_POST['detail_pemesanan'])) {
		$trx_code = $_POST['trx_code'];
		$data = $system->view_trx_pemesanan($trx_code);
		echo json_encode($data);
	}
 ?>