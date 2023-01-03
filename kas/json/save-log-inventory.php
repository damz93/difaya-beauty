<?php
	include 'koneksi.php';	
   	$olehyy = $_POST['usname'];	
	date_default_timezone_set('Asia/Jakarta');
	$username_teknisix = $olehyy;	
	$waktu_skg = date("d/m/Y h:i:s");
	$waktu_skg2 = date("Y/m/d");
	$keter = "diedit oleh ".$olehyy." pada tgl dan jam ".$waktu_skg;	
	
	//$image = $_REQUEST['image'];		
	//$path = "gambar_lokasi/$dd_NPSN.jpg";
	
	$data_tr = mysqli_query($koneksi,"SELECT ID,KODE_LOG FROM tbl_log_inventory ORDER BY ID DESC LIMIT 1");
					 while($d = mysqli_fetch_array($data_tr)){	
						$jum_log        = substr($d['KODE_LOG'],5);									
					 }				      
				      if ($jum_log == 0) {
				      	$kode_log = "LOG-0000000001";
				      }
				      else{
				      	$jum_log++;
						if (strlen($jum_log)== 1){
				      		$kode_log = "LOG-000000000".$jum_log;
				      	}
				      	else if (strlen($jum_log)== 2){
				      		$kode_log = "LOG-00000000".$jum_log;
				      	}
				      	else if (strlen($jum_log)== 3){
				      		$kode_log = "LOG-0000000".$jum_log;
				      	}
				      	else if (strlen($jum_log)== 4){
				      		$kode_log = "LOG-000000".$jum_log;
				      	}
				      	else if (strlen($jum_log)== 5){
				      		$kode_log = "LOG-00000".$jum_log;
				      	}
				      	else if (strlen($jum_log)== 6){
				      		$kode_log = "LOG-0000".$jum_log;
				      	}
				      	else if (strlen($jum_log)== 7){
				      		$kode_log = "LOG-000".$jum_log;
				      	}
				      	else if (strlen($jum_log)== 8){
				      		$kode_log = "LOG-00".$jum_log;
				      	}
				      	else if (strlen($jum_log)== 9){
				      		$kode_log = "LOG-0".$jum_log;
				      	}
				      	else if (strlen($jum_log)== 10){
				      		$kode_log = "LOG-".$jum_log;
				      	}
				      }
	$sql = mysqli_query($koneksi, "select * from tbl_log_inventory_temp WHERE OLEH='".$olehyy."'");	
	while ($data = mysqli_fetch_array($sql)) {
			$tgl = $data['TGL'];
			$waktu = $data['WAKTU'];			
			$oleh = $data['OLEH'];
			$keterangan = $data['KETERANGAN'];
			$kateg = $data['KATEGORI'];
			$kode_barang = $data['KODE_BARANG'];
			$nama_barang = $data['NAMA_BARANG'];
			$qty = $data['QTY'];
			$kuantitas = $qty;				
			$query = "INSERT INTO tbl_log_inventory(KODE_LOG,USERNAME,KATEGORI,KODE_BARANG,NAMA_BARANG,QTY,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$kode_log','$username_teknisix','$kateg','$kode_barang','$nama_barang','$qty','$tgl','$waktu','$oleh','$keterangan')";
			if (mysqli_query($koneksi, $query)) {				
			}
			$stok = mysqli_query($koneksi, "SELECT QTY,TERPINJAM,KEMBALI FROM tbl_inventory WHERE KODE_BARANG='" . $kode_barang . "'");
			while ($data2 = mysqli_fetch_array($stok)) {
				$stok2 = $data2['QTY'];
				$terpinjam = $data2['TERPINJAM'];
				$kembali = $data2['KEMBALI'];
			}
					
			if ($kateg=='BARANG MASUK'){				
			
				$kembali = (int)$kembali + (int)$kuantitas;
				$sisa_stok = (int) $stok2 + (int) $kuantitas;	
				mysqli_query($koneksi,"UPDATE tbl_inventory SET TGL='".$waktu_skg2."',WAKTU='".$waktu_skg."',KETERANGAN='".$keter."',OLEH='".$olehyy."',KEMBALI=".$kembali.",QTY=" . $sisa_stok . " WHERE KODE_BARANG='" . $kode_barang . "'");
			}
			else{
				$terpinjam = (int)$terpinjam + (int)$kuantitas;
				$sisa_stok = (int) $stok2 - (int) $kuantitas;	
				mysqli_query($koneksi, "UPDATE tbl_inventory SET TGL='".$waktu_skg2."',WAKTU='".$waktu_skg."',KETERANGAN='".$keter."',OLEH='".$olehyy."',TERPINJAM=".$terpinjam.",QTY=" . $sisa_stok . " WHERE KODE_BARANG='" . $kode_barang . "'");				
			}			
	}	
	$sql2 = "DELETE FROM tbl_log_inventory_temp where OLEH='" . $olehyy . "'";
	if (mysqli_query($koneksi, $sql2)) {
	//	file_put_contents($path, base64_decode($image));
		$response["success"] = "1";
		$response["get_log"] = $kode_log;
		$response["message"] = "Data sukses disimpan";
		echo json_encode($response);
	}
	else{
		$response["success"] = "0";
		$response["get_log"] = $kode_log;
		$response["message"] = "Maaf , terjadi kesalahan";
		echo json_encode($response);
	}
?>