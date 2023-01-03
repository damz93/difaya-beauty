<?php
	error_reporting(0);	
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	// menyimpan data kedalam variabel
	$waktu_skg = date("d/m/Y h:i:s A");
	$oleh = $_SESSION['username'];	
	$sumber = $_SESSION['source'];
	//$sumber = $_POST['sumber'];
	//$_SESSION['source'] = $sumber;
	$level = $_SESSION['level'];
	$tgl_saja = date("Y/m/d");
	$ketee = "ditambahkan oleh ".$oleh." pada tgl dan jam ".$waktu_skg;
	$notes= $_POST['keterangan'];
	$kode_pengeluaran = $_POST['kode_pengeluaran'];
	$kategori = $_POST['kategori'];
	$nominal = $_POST['nominal'];
	$nominal_simp = str_replace(".","",$nominal); 
	//UNTUK SIMPAN GAMBAR
	if ($_FILES['upd_foto']['size'] != 0){
			$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
			$nama = $_FILES['upd_foto']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['upd_foto']['size'];
			$file_tmp = $_FILES['upd_foto']['tmp_name'];	
 
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 1044070){			
					//move_uploaded_file($file_tmp, 'img-pengeluaran/'.$nama);
					$nama_baru = $kode_pengeluaran.".".$ekstensi;
					move_uploaded_file($file_tmp, 'img-pengeluaran/'.$nama_baru);
					$query=mysqli_query($koneksi,"INSERT INTO t_pengeluaran(FOTO,SOURCE,KODE_PENGELUARAN,KATEGORI,NOTES,NOMINAL,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$nama_baru','$sumber','$kode_pengeluaran','$kategori','$notes','$nominal_simp','$tgl_saja','$waktu_skg','$oleh','$ketee')");
					//$query2 = mysqli_query($koneksi,"UPDATE t_pengeluaran SET FOTO='$nama_baru' WHERE KODE_PENGELUARAN='$kode_pengeluaran'");					
					if($query){
						echo "<script>alert('Data tersimpan...');window.location.href='data-pengeluaran';</script>";						
					}else{						
						echo "<script>alert('Gagal Menyimpan...');window.location.href='javascript:history.go(-1)';</script>";
					}
				}else{
					echo "<script>alert('Ukuran File Terlalu Besar...');window.location.href='javascript:history.go(-1)';</script>";
				}
			}else{
				echo "<script>alert('Ekstensi file yang diupload tidak diperbolehkan...');window.location.href='javascript:history.go(-1)';</script>";
			}
	}
	else{	
		$query=mysqli_query($koneksi,"INSERT INTO t_pengeluaran(SOURCE,KODE_PENGELUARAN,KATEGORI,NOTES,NOMINAL,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$sumber','$kode_pengeluaran','$kategori','$notes','$nominal_simp','$tgl_saja','$waktu_skg','$oleh','$ketee')");						
		if($query){
			echo "<script>alert('Data tersimpan...');window.location.href='data-pengeluaran';</script>";						
		}
	}
?>