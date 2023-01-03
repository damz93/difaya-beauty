<?php
   error_reporting(0);
   session_start();
   include 'koneksi.php';
    date_default_timezone_set('Asia/Hong_Kong');
    $waktu_skg2 = date("d/m/Y h:i:s A");
   	$tgl = date("Y/m/d");
   	$oleh = $_SESSION['username'];
   	$keterangan = "ditambah oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;
	$nama_ = $_POST['nama_s'];
	$isii = $_POST['keter'];	
	$query = "INSERT into t_source(NAMA_SOURCE,PENJELASAN,KETERANGAN,WAKTU,TGL,OLEH) VALUES('$nama_','$isii','$keterangan','$waktu_skg2','$tgl','$oleh')";
	if (mysqli_query($koneksi, $query)) {
		echo "<script>alert('Data Tersimpan...');window.location.href='input-source';</script>";
	} 
	else {
		echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
	}
	mysqli_close($koneksi);   	
?>