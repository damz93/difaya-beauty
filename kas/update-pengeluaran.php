<?php
	error_reporting(0);	
	include 'koneksi.php';
	date_default_timezone_set('Asia/Hong_Kong');
	session_start();
	// menyimpan data kedalam variabel
	$waktu_skg = date("d/m/Y h:i:s A");
	$oleh = $_SESSION['username'];
	$sumberrrr = $_SESSION['source'];
	//$sumber = $_POST['sumber'];
	//$_SESSION['source'] = $sumber;
	$level = $_SESSION['level'];
	$tgl_saja = date("Y/m/d");
	$ketee = "diedit oleh ".$oleh." pada tgl dan jam ".$waktu_skg;
	$notes= $_POST['keterangan'];
	$kode_pengeluaran = $_POST['kode_pengeluaran'];
	$kategori = $_POST['kategori'];
	$nominal = $_POST['nominal'];
	$nominal_simp = str_replace(".","",$nominal); 
	
	
	$data_log = mysqli_query($koneksi,"select max(ID) as ID from t_log");
				 while($dlog = mysqli_fetch_array($data_log)){
					$jum_log        = $dlog['ID'];					
				 }
				if ($jum_log == 0) {
					$kode_log = "LOG-000000000001";
				}
				else{
					$jum_log++;			
					if (strlen($jum_log)== 1){
						$kode_log = "LOG-00000000000".$jum_log;				
					}
					else if (strlen($jum_log)== 2){
						$kode_log = "LOG-0000000000".$jum_log;
					}
					else if (strlen($jum_log)== 3){
						$kode_log = "LOG-000000000".$jum_log;
					}
					else if (strlen($jum_log)== 4){
						$kode_log = "LOG-00000000".$jum_log;
					}
					else if (strlen($jum_log)== 5){
						$kode_log = "LOG-0000000".$jum_log;
					}
					else if (strlen($jum_log)== 6){
						$kode_log = "LOG-000000".$jum_log;
					}
					else if (strlen($jum_log)== 7){
						$kode_log = "LOG-00000".$jum_log;
					}
					else if (strlen($jum_log)== 8){
						$kode_log = "LOG-0000".$jum_log;
					}
					else if (strlen($jum_log)== 9){
						$kode_log = "LOG-000".$jum_log;
					}
					else if (strlen($jum_log)== 10){
						$kode_log = "LOG-00".$jum_log;
					}
					else if (strlen($jum_log)== 11){
						$kode_log = "LOG-0".$jum_log;
					}
					else if (strlen($jum_log)== 12){
						$kode_log = "LOG-".$jum_log;
					}
				}		
	$data = mysqli_query($koneksi,"select * from t_pengeluaran WHERE KODE_PENGELUARAN='$kode_pengeluaran'");				
	while ($d = mysqli_fetch_assoc($data)){
		$kodee2 = $d['KODE_PENGELUARAN'];
		$notess2 = $d['NOTES'];
		$kategg2 = $d['KATEGORI'];
		$sourcee2 =$d['SOURCE'];
		$nomin2 = $d['NOMINAL'];
		$nomin_tamp2 = "Rp".number_format($nomin2,0,",",".");	
	}
		if($kategori!=$kategg2){
			$semua = 'Keperluan: '.$kategg2.' -> '.$kategori;
		}
		if($notes!=$notess2){
			if ($semua!=''){
				$semua = $semua." - ";
			}			
			$semua = $semua.'Keterangan: '.$notess2.' -> '.$notes;
		}
		if($sumberrrr!=$sourcee2){
			if ($semua!=''){
				$semua = $semua." - ";
			}			
			$semua = $semua.'Source Transaksi: '.$sourcee2.' -> '.$sumberrrr;
		}
		if($nominal_simp!=$nomin2){			
			if ($semua!=''){
				$semua = $semua." - ";
			}
			$nominal_simp_tamp = "Rp".number_format($nominal_simp,0,",",".");	
			$semua =$semua.'Nominal: '.$nomin_tamp2.' -> '.$nominal_simp_tamp;
		}
		
		
	if ($_FILES['upd_foto']['size'] != 0){
		if ($semua!=''){
			$semua = $semua." - ";
		}
		$semua =$semua.'Foto: Diubah';
	}
	else{
		if ($semua!=''){
			$semua = $semua;
		}
		$semua =$semua;
	}
	
	$notes2 = $oleh." - EDIT - ".$kode_pengeluaran;
	$tanda2 = 'EDIT PENGELUARAN';
	$semua2 = $semua;
	
	if ($semua2!=''){		
		$query_log=mysqli_query($koneksi,"INSERT INTO t_log(KODE_LOG,TANDA,NOTES,ISI,`SOURCE`,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$kode_log','$tanda2','$notes2','$semua2','$sumberrrr','$tgl_saja','$waktu_skg','$oleh','$ketee')");
		
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
						$query=mysqli_query($koneksi,"UPDATE t_pengeluaran SET FOTO='$nama_baru',KATEGORI='$kategori',NOTES='$notes',NOMINAL='$nominal_simp',WAKTU='$waktu_skg',OLEH='$oleh',KETERANGAN='$ketee' WHERE KODE_PENGELUARAN='$kode_pengeluaran'");
						if($query){	
							if($query_log){						
								echo "<script>alert('Data Terupdate...');window.location.href='data-pengeluaran';</script>";						
							}							
						}else{						
							echo "<script>alert('Gagal Mengupdate...');window.location.href='javascript:history.go(-1)';</script>";
						}
					}else{
						echo "<script>alert('Ukuran File Terlalu Besar...');window.location.href='javascript:history.go(-1)';</script>";
					}
					}else{
						echo "<script>alert('Ekstensi file yang diupload tidak diperbolehkan...');window.location.href='javascript:history.go(-1)';</script>";
					}
			}
			else{
				$query=mysqli_query($koneksi,"UPDATE t_pengeluaran SET KATEGORI='$kategori',NOTES='$notes',NOMINAL='$nominal_simp',WAKTU='$waktu_skg',OLEH='$oleh',KETERANGAN='$ketee' WHERE KODE_PENGELUARAN='$kode_pengeluaran'");						
				if($query){	
					if($query_log){						
						echo "<script>alert('Data Terupdate...');window.location.href='data-pengeluaran';</script>";						
					}
				}
			}		
	}
	else{
		echo "<script>alert('Tidak ada data yang diubah...');window.location.href='data-pengeluaran';</script>";	
	}
?>