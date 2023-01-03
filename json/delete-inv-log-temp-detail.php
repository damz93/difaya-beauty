<?php
	error_reporting(E_ERROR);
	include 'koneksi.php';
	$username = $_GET["usname"];	
	$kod_barang = $_GET["kod_barang"];	
	$query="DELETE from tbl_log_inventory_temp where OLEH='$username' and KODE_BARANG='$kod_barang'";
	
	if (mysqli_query($koneksi, $query)) {
		$response["success"] = "1";
		$response["message"] = "Data sukses dihapus";
		echo json_encode($response);
	} else {
		$response["success"] = "0";
		$response["message"] = "Maaf , terjadi kesalahan";
		echo json_encode($response);
	}
?>