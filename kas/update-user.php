<?php
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	// menyimpan data kedalam variabel
	$waktu_skg = date("d/m/Y h:i:s");
	$waktu_skg2 = date("Y/m/d");
	$oleh = $_SESSION['username'];
	$keter = "diedit oleh ".$oleh." pada tgl dan jam ".$waktu_skg;	
	$username = $_GET['usernamede'];
	$nama_lengkap = $_GET['full_namede'];
	$password = $_GET['passwordde'];
	$level = $_GET['levelde'];
	if($_SESSION['status']!="login"){
		echo "<script>alert('Maaf, Anda belum login...');window.location.href='index?pesan=belum_login';</script>";
	}
	else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="OWNER" AND $_SESSION['level']!="OWNER"){
		echo "<script>alert('Maaf, Anda tidak memiliki akses...');window.location.href='javascript:history.go(-1)';</script>";
	}
	else{	
		if (($nama_lengkap=='') OR ($password=='') OR $password==''){
			echo "<script>alert('Update dibatalkan, ada data yang kosong...');window.location.href='data-user';</script>";	
		}
		else{
			$query="UPDATE t_user SET KETERANGAN='$keter',WAKTU='$waktu_skg',LEVEL='$level',NAMA_LENGKAP='$nama_lengkap',OLEH='$oleh',PASSWORD='$password' where USERNAME='$username'";
			if (mysqli_query($koneksi, $query)) {
				echo "<script>alert('Data Terupdate...');window.location.href='data-user';</script>";		
				echo "<script>window.location.reload();</script>";		
				//header("Refresh:0");
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
			}
		}
	}
?>