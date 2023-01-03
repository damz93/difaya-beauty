<?php
	error_reporting(E_ERROR);
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	$username = $_GET["usname"];
	$password = $_GET["psword"];
	$waktu_skg = date("d/m/Y h:i:s");
	$waktu_skg2 = date("Y/m/d");
	$oleh = $username;
	$keter = "diedit oleh ".$oleh." pada tgl dan jam ".$waktu_skg;	
	$query="UPDATE tbl_user set PASSWORD='$password',KETERANGAN='$keter',WAKTU='$waktu_skg',OLEH='$oleh' WHERE USERNAME='$username'";
	if (mysqli_query($koneksi, $query)) {
		$response["success"] = "1";
		$response["message"] = "Data sukses diupdate";
		echo json_encode($response);
	} else {
		$response["success"] = "0";
		$response["message"] = "Maaf , terjadi kesalahan";
		echo json_encode($response);
	}
?>