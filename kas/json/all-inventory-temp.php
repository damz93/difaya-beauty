<?php
	error_reporting(E_ERROR);
	include 'koneksi.php';
	date_default_timezone_set('Asia/Jakarta');
	$oleh = $_GET['username'];
	$q = mysqli_query($koneksi,"SELECT * from tbl_log_inventory_temp WHERE OLEH='$oleh'");
	$response["LOG_INVENTORY"] = array();
	while ($a = mysqli_fetch_array($q)){
		$output = array();
		$output["kdbr"] = $a["KODE_BARANG"];
		$output["nmbr"] = $a["NAMA_BARANG"];
		$output["qtybr"] = $a["QTY"];
		array_push($response["LOG_INVENTORY"], $output);
	}
	echo json_encode($response);
?>