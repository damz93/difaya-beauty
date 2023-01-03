<?php
	include 'koneksi.php';
	$kod_bar = $_GET['kode_barang'];
	$query = mysqli_query($koneksi, "select * from tbl_inventory where KODE_BARANG='$kod_bar'");
	$us = mysqli_fetch_array($query);
	$data = array(
				'kode_barang'      =>  $us['KODE_BARANG'],);
	 echo json_encode($data);
?>