<?php 
require '../application/system.php';
header("Content-Type: application/json");
if (isset($_POST['id_barang'])) {
	$id = $_POST['id_barang'];
	$data = $system->get_detail_barang($id);
	echo $system->convert_to_json($data);
}
?>