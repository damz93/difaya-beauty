<?php
	error_reporting(E_ERROR);
	include 'koneksi.php';
	date_default_timezone_set('Asia/Jakarta');
	$waktu_skg2 = date("d/m/Y h:i:s");
   	$tgl = date("Y/m/d");
   	$oleh = $_POST['username'];
	$keterangan = "ditambah oleh ".$oleh." pada tgl dan jam ".$waktu_skg2;   	
	$kode_barangx = $_POST['kode_barang'];
	$nama_barangx = $_POST['nama_barang'];
	$qty = $_POST['qty'];	
	$qty2 = $_POST['qty2'];	
	$qtyx = str_replace(".","",$qty); 
	$qty2x = str_replace(".","",$qty2); 
	
	$prosescek= mysqli_query($koneksi,"select QTY_FISIK from tbl_stok_opn_temp where KODE_BARANG='$kode_barangx'");
	while($d = mysqli_fetch_array($prosescek)){
		$qty_sebelum=$d['QTY_FISIK'];
	}	
	if (mysqli_num_rows($prosescek)>0) {    
		$qty_skg = $qty2x;
		$query = mysqli_query($koneksi,"UPDATE tbl_stok_opn_temp SET QTY_FISIK='$qty_skg' where KODE_BARANG='$kode_barangx' AND OLEH='$oleh'");		
				
	}
	else{	
		$query = mysqli_query($koneksi,"INSERT into tbl_stok_opn_temp(KODE_BARANG,NAMA_BARANG,QTY_SYSTEM,QTY_FISIK,KETERANGAN,WAKTU,TGL,OLEH) VALUES('$kode_barangx','$nama_barangx','$qtyx','$qty2x','$keterangan','$waktu_skg2','$tgl','$oleh')");			
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