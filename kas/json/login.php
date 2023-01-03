<?php
	error_reporting(E_ERROR);
	include 'koneksi.php';
	$username = $_GET["usname"];
	$password = $_GET["psword"];
	$levelx = $_GET["level"];
	$q = mysqli_query($koneksi,"SELECT * FROM tbl_user WHERE USERNAME = '$username' and PASSWORD = '$password' and AKTIF='Ya' and LEVEL='$levelx'");
		while($data = mysqli_fetch_array($q)){		
			$nalengk = $data['NAMA_LENGKAP'];
		}           	
		$cek = mysqli_num_rows($q);
		if($cek > 0){
			$v = '{"statuslogin" : [';
			$v .= '{"st" : "ok", "hasil" : "Log In Berhasil..!!!"}';
			$v .= ']}';
			echo $v."_".$nalengk;						
		}
		else{
			$v = '{"statuslogin" : [';
			$v .= '{"st" : "ggl", "hasil" : "Gagal..!!!"}';
			$v .= ']}';
			echo $v."_".$nalengk;
		}
	
?>