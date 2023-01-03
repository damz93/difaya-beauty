<?php
	error_reporting(E_ERROR);
	include 'koneksi.php';
	$username = $_GET["username"];
	$password = $_GET["password"];	
	$q = mysqli_query($koneksi,"SELECT * FROM tbl_user WHERE USERNAME = '$username' and PASSWORD = '$password'");
	$cek = mysqli_num_rows($q);
    if($cek > 0){
		$v = '{"statuslogin" : [';
		$v .= '{"st" : "ok", "id" : "'.$username.'", "hasil" : "Log In Berhasil..!!!"}';
		$v .= ']}';
		echo $v;
	}
	else{
		$v = '{"statuslogin" : [';
		$v .= '{"st" : "gagal", "id" : "'.$username.'", "hasil" : "Username atau Password Salah..!!!"}';
		$v .= ']}';
		echo $v;
	}
?>