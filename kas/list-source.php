<?php
	include 'koneksi.php';
	$nm = $_GET['nama_sourceee'];
	$query = mysqli_query($koneksi,"select * from t_source where NAMA_SOURCE='$nm'");
	$sour = mysqli_fetch_array($query);
	$data = array(
				'nama_sourcee'      =>  $sour['NAMA_SOURCE'],);
	 echo json_encode($data);
?>