<?php
	include 'koneksi.php';
	$username = $_GET['username'];
	$query = mysqli_query($koneksi, "select * from tbl_user where USERNAME='$username'");
	$username = mysqli_fetch_array($query);
	$data = array(
				'username'      =>  $username['USERNAME'],
				'nama_lengkap'      =>  $username['NAMA_LENGKAP'],);				
	 echo json_encode($data);
?>