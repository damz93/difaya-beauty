<?php
error_reporting(0);	
include 'koneksi.php';
date_default_timezone_set('Asia/Hong_Kong');
session_start();
$oleh = $_SESSION['username'];
$waktu_skg2 = date("d/m/Y h:i:s A");
$waktu_skg = date("Y/m/d");
$ketern = "ditambahkan oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;
$username = $_POST['username'];
$nama_lengkap = $_POST['full_name'];
$password = $_POST['password'];
$persen = $_POST['persen'];
$level = $_POST['level'];
// query SQL untuk insert data
	if($_SESSION['status']!="login"){
		echo "<script>alert('Maaf, Anda belum login...');window.location.href='index?pesan=belum_login';</script>";
	}
	else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="OWNER" AND $_SESSION['level']!="OWNER"){
		echo "<script>alert('Maaf, Anda tidak memiliki akses...');window.location.href='javascript:history.go(-1)';</script>";
	}
	else{
		$query="INSERT INTO t_user(PERSEN,AKTIF,USERNAME,NAMA_LENGKAP,PASSWORD,TGL,KETERANGAN,WAKTU,OLEH,LEVEL)VALUES('$persen','YA','$username','$nama_lengkap','$password','$waktu_skg','$ketern','$waktu_skg2','$oleh','$level')";
		//mysqli_query($koneksi,$query);
		$cekdulu= "select * from t_user where USERNAME='$username'";
		$prosescek= mysqli_query($koneksi, $cekdulu);
		if (mysqli_num_rows($prosescek)>0) {    
			echo "<script>alert('Maaf, username sudah ada...');history.go(-1) </script>";
		}
		else {
			if (mysqli_query($koneksi, $query)) {
				echo "<script>alert('Data Tersimpan...');window.location.href='data-user';</script>";		
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
			}
		}
	}
?>