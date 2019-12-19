<?php 
	$tgl1 = date;// pendefinisian tanggal awal
	$tgl2 = date('Y-m-d', strtotime('-1 day', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
	echo $tgl1; //print tanggal
	echo "<hr>"; //print tanggal
	echo $tgl2; //print tanggal
?>