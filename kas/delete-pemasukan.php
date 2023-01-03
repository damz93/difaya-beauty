<?php
	session_start();
	include 'koneksi.php';
	error_reporting(0);	
	$id   = $_GET['id'];
	
	
	$semua = "";
	$waktu_skg = date("d/m/Y h:i:s A");
	$oleh = $_SESSION['username'];
	$tgl_saja = date("Y/m/d");
	$ketee = "dihapus oleh ".$oleh." pada tgl dan jam ".$waktu_skg;	
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
	$data = mysqli_query($koneksi,"select * from t_pemasukan WHERE kode_pemasukan='$id'");				
	while ($d = mysqli_fetch_assoc($data)){
		$kodee = $d['KODE_PEMASUKAN'];
		$notess = $d['NOTES'];
		$kategg = $d['KATEGORI'];
		$sourcee =$d['SOURCE'];
		$nomin = $d['NOMINAL'];
		$nomin_tamp = "Rp".number_format($nomin,0,",",".");	
		$semua = "Kode: ".$kodee." - Keterangan: ".$notess." - Kategori: ".$kategg." - Source: ".$sourcee." - Nominal: ".$nomin_tamp;		
	}
	$notes = $oleh." - HAPUS - ".$id;
	$tanda = 'HAPUS PEMASUKAN';
	$query_log="INSERT INTO t_log(KODE_LOG,TANDA,NOTES,ISI,`SOURCE`,TGL,WAKTU,OLEH,KETERANGAN)VALUES('$kode_log','$tanda','$notes','$semua','$sourcee','$tgl_saja','$waktu_skg','$oleh','$ketee')";
		
		
	if($_SESSION['status']!="login"){
		echo "<script>alert('Maaf, Anda belum login...');window.location.href='index?pesan=belum_login';</script>";
	}
	else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="ADMIN" AND $_SESSION['level']!="OWNER"){
		echo "<script>alert('Maaf, Anda tidak memiliki akses...');window.location.href='javascript:history.go(-1)';</script>";
	}
	else {
		$query="DELETE from t_pemasukan where KODE_PEMASUKAN='$id'";
		if (mysqli_query($koneksi, $query)) {
				if (mysqli_query($koneksi, $query_log)) {
					echo "<script>alert('Data terhapus');window.location.href='data-pemasukan';</script>";		
				}				
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
			}
	}
?>