<?php
	include 'koneksi.php';	
   	$olehyy = $_POST['usname'];	
	$data_tr = mysqli_query($koneksi,"SELECT ID,KODE FROM tbl_stok_opn ORDER BY ID DESC LIMIT 1");
					 while($d = mysqli_fetch_array($data_tr)){	
						$jum_stok  = substr($d['KODE'],5);									
					 }				      
				      if ($jum_stok == 0) {
				      	$kode_stok = "STO-0000000001";
				      }
				      else{
				      	$jum_stok++;
						if (strlen($jum_stok)== 1){
				      		$kode_stok = "STO-000000000".$jum_stok;
				      	}
				      	else if (strlen($jum_stok)== 2){
				      		$kode_stok = "STO-00000000".$jum_stok;
				      	}
				      	else if (strlen($jum_stok)== 3){
				      		$kode_stok = "STO-0000000".$jum_stok;
				      	}
				      	else if (strlen($jum_stok)== 4){
				      		$kode_stok = "STO-000000".$jum_stok;
				      	}
				      	else if (strlen($jum_stok)== 5){
				      		$kode_stok = "STO-00000".$jum_stok;
				      	}
				      	else if (strlen($jum_stok)== 6){
				      		$kode_stok = "STO-0000".$jum_stok;
				      	}
				      	else if (strlen($jum_stok)== 7){
				      		$kode_stok = "STO-000".$jum_stok;
				      	}
				      	else if (strlen($jum_stok)== 8){
				      		$kode_stok = "STO-00".$jum_stok;
				      	}
				      	else if (strlen($jum_stok)== 9){
				      		$kode_stok = "STO-0".$jum_stok;
				      	}
				      	else if (strlen($jum_stok)== 10){
				      		$kode_stok = "STO-".$jum_stok;
				      	}
				      }
	$sql = mysqli_query($koneksi, "select * from tbl_stok_opn_temp WHERE OLEH='".$olehyy."'");	
	while ($data = mysqli_fetch_array($sql)) {
			$tgl = $data['TGL'];
			$waktu = $data['WAKTU'];			
			$oleh = $data['OLEH'];
			$keterangan = $data['KETERANGAN'];
			$kode_barang = $data['KODE_BARANG'];
			$nama_barang = $data['NAMA_BARANG'];
			$qty_sys = $data['QTY_SYSTEM'];
			$qty_fis = $data['QTY_FISIK'];
			$query = "INSERT INTO tbl_stok_opn(KODE,KODE_BARANG,NAMA_BARANG,QTY_SYSTEM,QTY_FISIK,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$kode_stok','$kode_barang','$nama_barang','$qty_sys','$qty_fis','$tgl','$waktu','$oleh','$keterangan')";
			if (mysqli_query($koneksi, $query)) {				
			}	
	}	
	$sql2 = "DELETE FROM tbl_stok_opn_temp where OLEH='" . $olehyy . "'";
	if (mysqli_query($koneksi, $sql2)) {
	//	file_put_contents($path, base64_decode($image));
		$response["success"] = "1";
		$response["get_kode"] = $kode_stok;
		$response["message"] = "Data sukses disimpan";
		echo json_encode($response);
	}
	else{
		$response["success"] = "0";
		$response["get_kode"] = $kode_stok;
		$response["message"] = "Maaf , terjadi kesalahan";
		echo json_encode($response);
	}
?>