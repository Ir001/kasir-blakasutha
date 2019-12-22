<?php 
		$conn = mysqli_connect('localhost', 'root', 'root', 'blakasutha');
		$sql = "SELECT count(*) as terjual FROM transaksi";
		$query = $conn->query($sql);
		$res = $query->fetch_assoc();
		print_r($res);
		echo $res['terjual'];
?>