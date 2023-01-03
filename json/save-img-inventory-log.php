<?php
	require 'koneksi.php';
	$image = $_REQUEST['imagez'];	
	$kode_log = $_REQUEST['kode_logz'];    
	$path = "gambar-inv-log/$kode_log.jpg";
	file_put_contents($path, base64_decode($image));			
	$actualpath = "http://minisiteoperation.com/json/$path";
	$sql = "UPDATE tbl_log_inventory SET `FOTO`='$actualpath' WHERE `KODE_LOG`='$kode_log'";	
	if(mysqli_query($koneksi,$sql)){
		echo "Successfully Uploaded";
	}	
?>