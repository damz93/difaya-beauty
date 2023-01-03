<?php       
	error_reporting(E_ERROR);
	include 'koneksi.php';
	$kode_barang = $_GET["kode_barang"];
	$q = mysqli_query($koneksi,'SELECT * FROM `tbl_inventory` where `KODE_BARANG`="'.$kode_barang.'"');
	$response["NAMA"] = array();
	while ($a = mysqli_fetch_array($q)){
		$output = array();
		$output["nama_barang"] = $a["NAMA_BARANG"];
		$output["qty"] = $a["QTY"];
		array_push($response["NAMA"], $output);
	}
	echo json_encode($response);
?>