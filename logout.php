<?php 
	require 'application/system.php';
	$logout = $system->logout();
	if ($logout) {
		header("location:login.php");
	}
 ?>