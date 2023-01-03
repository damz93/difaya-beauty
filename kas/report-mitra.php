<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<head>
		<title>Laporan Mitra - DIFAYA BEAUTY | Effortless Care For Priceless You</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="img/ic.png">
		<!--<meta http-equiv="refresh" content="5; url=data-report">-->
		<link rel="stylesheet" href="css/jour.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>	
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>	
			<style type="text/css">
				.left    { text-align: left;}
				.right   { text-align: right;}
				.center  { text-align: center;}
				.justify { text-align: justify;}
			</style>
			<style type="text/css" media="print">
				@page {
				size: a4;   /* auto is the initial value */
				margin: 1;  /* this affects the margin in the printer settings */
				}
			</style>
	</head>
	</head>
	<body>
		<?php 
		
			include 'koneksi.php';
			error_reporting(0);
			    session_start();		
			$sourcex=$_SESSION['source'];			
			$user_login = $_SESSION['username'];
				include "koneksi.php";
			    if($_SESSION['status']!="login"){
			    	echo "<script>alert('Maaf, Anda belum login...');window.location.href='index?pesan=belum_login';</script>";
			    }
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="MITRA" AND $_SESSION['level']!="OWNER"){
					echo "<script>alert('Maaf, Anda tidak memiliki akses...');window.location.href='javascript:history.go(-1)';</script>";
				}
				
			date_default_timezone_set('Asia/Hong_Kong');
			$waktu_skg = date("d/m/Y");
			$hariini = date('l', strtotime($waktu_skg));
			$jam = date("H:i:s A");
			function formatTanggal($date){
			 return date('d-m-Y', strtotime($date));
			}
			
			if (isset($_POST['tampil_tgl_mitra'])){			
				$tglawal = $_POST['par_tgl_mitra'];
				$tgl_awal = date_create($tglawal);
				$tgl_awalz = date_format($tgl_awal,"Y/m/d");
				
				$tglakhir = $_POST['par_tgl_mitra2'];
				$tgl_akhir = date_create($tglakhir);
				$tgl_akhirz = date_format($tgl_akhir,"Y/m/d");
			
				if((strcmp($tglawal,$tglakhir)==0) OR empty($tglakhir)){
					$nama = "Laporan Summary Mitra Harian - " . formatTanggal($tglawal);
					$data_pemasukan = mysqli_query($koneksi, "SELECT SUM(NOMINAL) AS nomin_mas from t_pemasukan WHERE SOURCE='".$sourcex."' AND TGL='".$tgl_awalz."'");					
									
					$data_pengeluaran = mysqli_query($koneksi, "SELECT SUM(NOMINAL) AS nomin_kel from t_pengeluaran WHERE SOURCE='".$sourcex."' AND TGL='".$tgl_awalz."'");
										
					$data_list = mysqli_query($koneksi, "SELECT * FROM t_pemasukan WHERE SOURCE='".$sourcex."' AND TGL='".$tgl_awalz."' GROUP BY TGL ORDER BY TGL DESC");
					
					$jumtrans_list = mysqli_num_rows($data_list);	
					if($jumtrans_list==0){
						$data_list = mysqli_query($koneksi, "SELECT * FROM t_pengeluaran WHERE SOURCE='".$sourcex."' AND TGL='".$tgl_awalz."' GROUP BY TGL ORDER BY TGL DESC");
					}		
				}
				else{	
					$nama = "Laporan Summary Mitra ( " . formatTanggal($tglawal) ." s.d. ". formatTanggal($tglakhir)." )";
					$data_pemasukan = mysqli_query($koneksi, "SELECT SUM(NOMINAL) AS nomin_mas from t_pemasukan WHERE SOURCE='".$sourcex."' AND TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."'");
					
					
					$data_pengeluaran = mysqli_query($koneksi, "SELECT SUM(NOMINAL) AS nomin_kel from t_pengeluaran WHERE SOURCE='".$sourcex."' AND TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."'");				
					
					$data_list = mysqli_query($koneksi, "SELECT TGL FROM t_pengeluaran UNION SELECT TGL FROM t_pemasukan WHERE SOURCE='".$sourcex."' AND TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."' GROUP BY TGL ORDER BY TGL DESC");
					
				}
			}
			else if (isset($_POST['tampil_bln_mitra'])){		
				$bulawal = $_POST['par_bln_mitra'];
				$bulanaw = substr($bulawal,0,2);
				$tahunaw = substr($bulawal,3,7);
				$tgl_awal = $tahunaw."-".$bulanaw."-01";
				$tgl_awal2 = $tahunaw."-".$bulanaw."-31";
				
				$bulakhir = $_POST['par_bln_mitra2'];
				$bulanak = substr($bulakhir,0,2);
				$tahunak = substr($bulakhir,3,7);
				$tgl_akhir = $tahunak."-".$bulanak."-31";
				
				if((strcmp($bulawal,$bulakhir)==0) OR empty($bulakhir)){
					$nama = "Laporan Summary Mitra Bulanan - " . $bulawal;
					
					$data_pemasukan = mysqli_query($koneksi, "SELECT SUM(NOMINAL) AS nomin_mas from t_pemasukan WHERE SOURCE='".$sourcex."' AND MONTH(TGL)=".$bulanaw." AND YEAR(TGL)=".$tahunaw."");
										
					$data_pengeluaran = mysqli_query($koneksi, "SELECT SUM(NOMINAL) AS nomin_kel from t_pengeluaran WHERE SOURCE='".$sourcex."' AND MONTH(TGL)=".$bulanaw." AND YEAR(TGL)=".$tahunaw."");
										
					$data_list = mysqli_query($koneksi, "SELECT * FROM t_pemasukan WHERE SOURCE='".$sourcex."' AND TGL BETWEEN '".$tgl_awal."' AND '".$tgl_awal2."' GROUP BY TGL ORDER BY TGL DESC");
					
					$jumtrans_list = mysqli_num_rows($data_list);	
					if($jumtrans_list==0){
						$data_list = mysqli_query($koneksi, "SELECT * FROM t_pengeluaran WHERE SOURCE='".$sourcex."' AND TGL BETWEEN '".$tgl_awal."' AND '".$tgl_awal2."' GROUP BY TGL ORDER BY TGL DESC");
					}
					
				}
				else{	
					$nama = "Laporan Summary Mitra ( " . $bulawal ." s.d. ". $bulakhir." )";
					
					$data_pemasukan = mysqli_query($koneksi, "SELECT SUM(NOMINAL) AS nomin_mas from t_pemasukan WHERE SOURCE='".$sourcex."' AND TGL between '".$tgl_awal."' AND '".$tgl_akhir."'");
										
					$data_pengeluaran = mysqli_query($koneksi, "SELECT SUM(NOMINAL) AS nomin_kel from t_pengeluaran WHERE SOURCE='".$sourcex."' AND TGL between '".$tgl_awal."' AND '".$tgl_akhir."'");
					
					$data_list = mysqli_query($koneksi, "SELECT TGL FROM t_pengeluaran UNION SELECT TGL FROM t_pemasukan WHERE SOURCE='".$sourcex."' AND TGL BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' GROUP BY TGL ORDER BY TGL DESC");
					
				
				}
			}
			else if (isset($_POST['tampil_semua_mitra'])){	
				$nama = "Laporan Semua Summary Mitra";
				$data_pemasukan = mysqli_query($koneksi, "SELECT SUM(NOMINAL) AS nomin_mas from t_pemasukan WHERE SOURCE='".$sourcex."'");
								
				$data_pengeluaran = mysqli_query($koneksi, "SELECT SUM(NOMINAL) AS nomin_kel from t_pengeluaran WHERE SOURCE='".$sourcex."'");	
				
				$data_list = mysqli_query($koneksi, "SELECT TGL FROM t_pengeluaran UNION SELECT TGL FROM t_pemasukan WHERE SOURCE='".$sourcex."' GROUP BY TGL ORDER BY TGL DESC");
					
				$jumtrans_list = mysqli_num_rows($data_list);	
				if($jumtrans_list==0){
					$data_list = mysqli_query($koneksi, "SELECT * FROM t_pengeluaran WHERE SOURCE='".$sourcex."' GROUP BY TGL ORDER BY TGL DESC");
				}					
			}
			$jumtrans = mysqli_num_rows($data_pemasukan);										
			$jumtrans = number_format($jumtrans,0,',','.');      	
			$jumtrans = "Jumlah Inputan: " . $jumtrans;
			
			while($data_pemasukan2= mysqli_fetch_array($data_pemasukan)){
				$nomin_mas = $data_pemasukan2['nomin_mas'];							
				$nomin_mas_tamp = number_format($nomin_mas,0,',','.');	
			}
			while($data_pengeluaran2= mysqli_fetch_array($data_pengeluaran)){
				$nomin_kel = $data_pengeluaran2['nomin_kel'];							
				$nomin_kel_tamp = number_format($nomin_kel,0,',','.');	
			}
			$keuntungan =$nomin_mas-$nomin_kel;					
			if($keuntungan<0){
				$keuntunganz = str_replace("-","",$keuntungan);
				$keuntungan_tamp = "-Rp".number_format($keuntunganz,0,',','.');	
			}
			else{				
				$keuntungan_tamp = "Rp".number_format($keuntungan,0,',','.');	
			}		
			
			$kas = $keuntungan/2;
			if($kas<0){
				$kasz = str_replace("-","",$kas);
				$kas_tamp = "-Rp".number_format($kasz,0,',','.');	
			}
			else{				
				$kas_tamp = "Rp".number_format($kas,0,',','.');	
			}
			
			$bersih = $keuntungan/2;		
			if($bersih<0){
				$bersihz = str_replace("-","",$bersih);
				$bersih_tamp = "-Rp".number_format($bersihz,0,',','.');	
			}
			else{				
				$bersih_tamp = "Rp".number_format($bersih,0,',','.');	
			}
										
			$data_persen = mysqli_query($koneksi, "SELECT PERSEN FROM t_user WHERE USERNAME='".$user_login."'");
			while($data_persen2= mysqli_fetch_array($data_persen)){
				$persen = $data_persen2['PERSEN'];						
				$tot_persen = $persen/100;
			}
						
			//$mitra = $bersih*0.1;
			$mitra = $bersih*$tot_persen;
			if($mitra<0){
				$mitraz = str_replace("-","",$mitra);
				$mitra_tamp = "-Rp".number_format($mitraz,0,',','.');	
			}
			else{				
				$mitra_tamp = "Rp".number_format($mitra,0,',','.');	
			}
			?>
			
		<u>
			<h1 class="center">SUMMARY MITRA</h1>
		</u>
			<h4 class="center">-DIFAYA BEAUTY-</h4>
		<br>
		<br>
		<br>
		<table border="0" style="width: 100%" align='center'>
			<tr>
				<td align="left">
					<h5><b><?php echo $nama; ?></b></h5>
				</td>
				<td align="right">							
					<h6><i><?php echo "[".$hariini.", ".$waktu_skg."-".$jam."]"; ?></i></h6>
				</td>
			</tr>
		</table>
		
					<br>
					<br>
		<table border="0" style="width: 50%" align='center'>
			<tr>
				<td align="left" width="8%">
					<h6>Penjualan</h6>
					<h6>Pengeluaran</h6>
					<h6>Keuntungan</h6>
				</td>
				<td align="right" width="12%">
					<h6><?php echo "Rp".$nomin_mas_tamp ?></h6>
					<h6><?php echo "Rp".$nomin_kel_tamp ?></h6>
					<h6><?php echo $keuntungan_tamp ?></h6>
				</td>
				<td align="right" width="15%">
				</td>
				
				<td  align="left" width="8%">
					<h6>Kas</h6>
					<h6>Bersih</h6>
					<h6>Mitra</h6>
				</td>
				<td  align="right" width="12%">
					<h6><?php echo $kas_tamp ?></h6>
					<h6><?php echo $bersih_tamp ?></h6>
					<h6><?php echo $mitra_tamp ?></h6>
				</td>				
			</tr>
		</div>
		
		<table border="1" style="width: 100%" align='center'>
			<tr align='center'>
		<br>
				<th>Tanggal</th>
				<th>Penjualan</th>
				<th>Pengeluaran</th>
			</tr>
			<?php 
				$no = 1;		
				$no_masuk = 1;
				$no_keluar =1;
				$total_masuk=0;
				
				while($data_list2 = mysqli_fetch_array($data_list)){		
					$tglxx = formatTanggal($data_list2['TGL']);  
					$tglxx_tamp =$data_list2['TGL'];
					
					$data_semua_pemasukan = mysqli_query($koneksi, "SELECT SUM(NOMINAL) AS nomin_mas_semua from t_pemasukan WHERE SOURCE='".$sourcex."' AND TGL='".$tglxx_tamp."'");
					while($data_semua_pemasukan2 = mysqli_fetch_array($data_semua_pemasukan)){							
						$nomin_mas_semua = $data_semua_pemasukan2['nomin_mas_semua'];							
						$nomin_mas_semua_tamp = number_format($nomin_mas_semua,0,',','.');	
					}
					
					$data_semua_pengeluaran = mysqli_query($koneksi, "SELECT SUM(NOMINAL) AS nomin_kel_semua from t_pengeluaran WHERE SOURCE='".$sourcex."' AND TGL='".$tglxx_tamp."'");
					
					while($data_semua_pengeluaran2 = mysqli_fetch_array($data_semua_pengeluaran)){						
						$nomin_kel_semua = $data_semua_pengeluaran2['nomin_kel_semua'];							
						$nomin_kel_semua_tamp = number_format($nomin_kel_semua,0,',','.');	
					
					}
				
				?>
			<tr>
				<td align='center'><b><?php echo $tglxx; ?><b></td>
				<td align='right'><font color="#32b68e"><b><?php echo "Rp".$nomin_mas_semua_tamp; ?></font><b></td>
				<td align='right'><font color="#e73036"><b><?php echo "Rp".$nomin_kel_semua_tamp; ?><b></font></td>
			</tr>
			<?php
			
				
				$data_list_pemasukan = mysqli_query($koneksi, "SELECT * FROM t_pemasukan WHERE SOURCE='".$sourcex."' AND TGL='".$tglxx_tamp."' ORDER BY ID DESC");
				while($data_list_pemasukan2 = mysqli_fetch_array($data_list_pemasukan)){				
					$nomi_mas = $data_list_pemasukan2['NOMINAL'];		
					
					$foto = $data_list_pemasukan2['FOTO'];
						if ($foto == ''){
							$foto="#";
						}
						else{
							$foto = "img-pemasukan/".$foto;
						}									
				
					$nomi_mas_tamp = "Rp" . number_format($nomi_mas,0,',','.');					
					//$info= "Pemasukan ".$no_masuk++;	
					$info = $data_list_pemasukan2['NOTES'];	

			?>
			
			<tr>
				<td align='center'>
					<?php echo $info;?>
					<a href="<?php echo $foto; ?>" target="_BLANK">
						<img align="right" src="<?php echo $foto; ?>" width="auto" height="25px"/>
					</a>
				</td>
				<td align='right'><font color="#32b68e"><?php echo $nomi_mas_tamp; ?></font></td>
				<td align='right'><?php echo "-"; } ?></td>
				
			</tr>
			<?php
				
					$data_list_pengeluaran = mysqli_query($koneksi, "SELECT * FROM t_pengeluaran WHERE SOURCE='".$sourcex."' AND TGL='".$tglxx_tamp."' ORDER BY ID DESC");	
					while($data_list_pengeluaran2 = mysqli_fetch_array($data_list_pengeluaran)){										
						$nomi_kel = $data_list_pengeluaran2['NOMINAL'];				
					$foto = $data_list_pengeluaran2['FOTO'];						
				$foto = $data_list_pemasukan2['FOTO'];
						if ($foto == ''){
							$foto="#";
						}
						else{
							$foto = "img-pengeluaran/".$foto;
						}
						
						$nomi_kel_tamp = "Rp" . number_format($nomi_kel,0,',','.');				
						//$info = "Pengeluaran ".$no_keluar++;						
						$info = $data_list_pengeluaran2['NOTES'];						
						
			?>
			
			<tr>
				<td align='center'>				
					<?php echo $info;?> 
					<a href="<?php echo $foto; ?>" target="_BLANK">
						<img align="right" src="<?php echo $foto; ?>" width="auto" height="25px"/>
					</a>
				</td>
				<td align='right'><?php echo "-"; ?></td>
				<td align='right'><font color="#e73036"><?php echo $nomi_kel_tamp; }}?></font></td>			
			
			</tr>
			
		</table>
		<script>
		//	window.print();
		</script>
	</body>
</html>