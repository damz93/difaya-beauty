<?php
	require 'koneksi.php';
	$image = $_REQUEST['imagez'];	
	$kode_stok = $_REQUEST['kode_stok'];    
	$path = "gambar-stok-op/$kode_stok.jpg";
	file_put_contents($path, base64_decode($image));			
	$actualpath = "http://minisiteoperation.com/json/$path";	
	$sql = "UPDATE tbl_stok_opn SET `FOTO`='$actualpath' WHERE `KODE`='$kode_stok'";	
	if(mysqli_query($koneksi,$sql)){
		echo "Successfully Uploaded";
	}	
?>