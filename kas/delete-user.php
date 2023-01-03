<?php
	session_start();
	include 'koneksi.php';
	error_reporting(0);	
	$id   = $_GET['id'];
	if ($_SESSION['status']!="login") {
		echo "<script>alert('Maaf, Anda belum login...');window.location.href='index?pesan=belum_login';</script>";
	}
	else if(($_SESSION['level']!="OWNER")AND($_SESSION['level']!="OWNER")) {
		echo "<script>alert('Maaf, Anda tidak memiliki akses...');window.location.href='javascript:history.go(-1)';</script>";
	}
	else {
		$query="DELETE from t_user where USERNAME='$id'";
		if (mysqli_query($koneksi, $query)) {
				echo "<script>alert('Data Terhapus...');window.location.href='data-user';</script>";		
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
			}	
	}
?>