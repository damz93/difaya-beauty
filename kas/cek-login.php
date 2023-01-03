<?php 
	//error_reporting(0);
   // mengaktifkan session php
   session_start();
   
   // menghubungkan dengan koneksi
   include 'koneksi.php';
   
   // menangkap data yang dikirim dari form
   $username = $_POST['username'];
   $password = $_POST['password'];
   $level = $_POST['level'];
   $lev = $level;
   
   // menyeleksi data admin dengan username dan password yang sesuai
   $data = mysqli_query($koneksi,"SELECT * FROM t_user WHERE USERNAME = '$username' and PASSWORD = '$password'");
   $data2 = mysqli_query($koneksi,"SELECT * FROM t_user WHERE USERNAME = '$username' and PASSWORD = '$password' and AKTIF='YA' and LEVEL='$level'");
   
   // menghitung jumlah data yang ditemukan
   $cek = mysqli_num_rows($data);
   $cek2 = mysqli_num_rows($data2);
   
   if (empty($username)||(empty($password))){
   	echo "<script>alert('Username and Password must be filled');window.location.href='index.php?pesan=gagal';</script>";
   }
   else{
   	if($cek > 0){
   	    if ($cek2 > 0) {
   		    $_SESSION['username'] = $username;   		    
   		    $_SESSION['level'] = $level;   		    
   		    $_SESSION['status'] = "login";
			if ($lev == "ADMIN") {
				$welcome = "Selamat Datang ".$username."(Admin)";
				echo "<script>alert('".$welcome."');window.location.href='utama';</script>";
			}			
			else if ($lev == "MITRA") {
				$welcome = "Selamat Datang ".$username."(Mitra)";
				echo "<script>alert('".$welcome."');window.location.href='utama';</script>";
			}
			else if ($lev == "OWNER") {
				$welcome = "Selamat Datang ".$username."(Owner)";
				echo "<script>alert('".$welcome."');window.location.href='utama';</script>";
			}
   	    }
   	    else{
   	        echo "<script>alert('Maaf, anda tidak memiliki akses...');window.location.href='javascript:history.go(-1)';</script>";
   	    }   	
   	}else{
   		echo "<script>alert('Kesalahan Username atau Password...');window.location.href='index?pesan=gagal';</script>";
   	}
   }
?>