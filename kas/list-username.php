<?php
	include 'koneksi.php';
	$usnm = $_GET['username'];
	$query = mysqli_query($koneksi, "select * from t_user where USERNAME='$usnm'");
	$us = mysqli_fetch_array($query);
	$data = array(
				'usernamee'      =>  $us['USERNAME'],);
	 echo json_encode($data);
?>