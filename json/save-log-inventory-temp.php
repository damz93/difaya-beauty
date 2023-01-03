<?php
	error_reporting(E_ERROR);
	include 'koneksi.php';
	date_default_timezone_set('Asia/Jakarta');
	$waktu_skg2 = date("d/m/Y h:i:s");
   	$tgl = date("Y/m/d");
   	$oleh = $_POST['username'];
	$keterangan = "ditambah oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;   	
	$bar_masuk = 'BARANG KELUAR';
	$kode_barangx = $_POST['kode_barang'];
	$nama_barangx = $_POST['nama_barang'];
	$qty = $_POST['qty'];	
	$qtyx = str_replace(".","",$qty); 
	
	$prosescek= mysqli_query($koneksi,"select QTY from tbl_log_inventory_temp where KODE_BARANG='$kode_barangx' AND OLEH='$oleh'");
	while($d = mysqli_fetch_array($prosescek)){
		$qty_sebelum=$d['QTY'];
	}	
	if (mysqli_num_rows($prosescek)>0) {    
		$qty_skg = (int)$qty_sebelum + (int)$qtyx;
		$query = mysqli_query($koneksi,"UPDATE tbl_log_inventory_temp SET QTY='$qty_skg' where KODE_BARANG='$kode_barangx' AND OLEH='$oleh'");						
	}
	else{	
		$query = mysqli_query($koneksi,"INSERT into tbl_log_inventory_temp(KODE_BARANG,NAMA_BARANG,QTY,KETERANGAN,WAKTU,TGL,OLEH,USERNAME,KATEGORI) VALUES('$kode_barangx','$nama_barangx','$qtyx','$keterangan','$waktu_skg2','$tgl','$oleh','$oleh','$bar_masuk')");			
	}	
	if($query){
		$response["success"] = "1";
		$response["message"] = "Data sukses disimpan";
		echo json_encode($response);
	}
	else{
		$response["success"] = "0";
		$response["message"] = "Maaf , terjadi kesalahan";
		echo json_encode($response);
	}
?>