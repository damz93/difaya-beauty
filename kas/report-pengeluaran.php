<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<head>
		<title>Laporan Pengeluaran - DIFAYA BEAUTY | Effortless Care For Priceless You</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="img/ic.png">
		<!--<meta http-equiv="refresh" content="5; url=data-report">-->
		<link rel="stylesheet" href="css/jour.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>	
<!--		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">-->
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
				include "koneksi.php";
			    if($_SESSION['status']!="login"){
			    	echo "<script>alert('Maaf, Anda belum login...');window.location.href='index?pesan=belum_login';</script>";
			    }
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="ADMIN" AND $_SESSION['level']!="OWNER"){
					echo "<script>alert('Maaf, Anda tidak memiliki akses...');window.location.href='javascript:history.go(-1)';</script>";
				}
				
			date_default_timezone_set('Asia/Hong_Kong');
			$waktu_skg = date("d/m/Y");
			$hariini = date('l', strtotime($waktu_skg));
			$jam = date("H:i:s A");
			function formatTanggal($date){
			 return date('d-m-Y', strtotime($date));
			}
			
			$kategori = 'GAJI';
			if (isset($_POST['tampil_tgl_gaji'])){			
				$tglawal = $_POST['par_tgl_gaji'];
				$tgl_awal = date_create($tglawal);
				$tgl_awalz = date_format($tgl_awal,"Y/m/d");
				
				$tglakhir = $_POST['par_tgl_gaji2'];
				$tgl_akhir = date_create($tglakhir);
				$tgl_akhirz = date_format($tgl_akhir,"Y/m/d");
			
				if((strcmp($tglawal,$tglakhir)==0) OR empty($tglakhir)){
					$nama = "Laporan Pengeluaran Harian - " . formatTanggal($tglawal);
					$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' AND TGL='".$tgl_awalz."' ORDER BY ID ASC");
				}
				else{	
					$nama = "Laporan Pengeluaran ( " . formatTanggal($tglawal) ." s.d. ". formatTanggal($tglakhir)." )";
					$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' AND TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."' ORDER BY ID ASC");
				}
			}
			else if (isset($_POST['tampil_bln_gaji'])){		
				$bulawal = $_POST['par_bln_gaji'];
				$bulanaw = substr($bulawal,0,2);
				$tahunaw = substr($bulawal,3,7);
				$tgl_awal = $tahunaw."-".$bulanaw."-01";
				
				$bulakhir = $_POST['par_bln_gaji2'];
				$bulanak = substr($bulakhir,0,2);
				$tahunak = substr($bulakhir,3,7);
				$tgl_akhir = $tahunak."-".$bulanak."-31";
				
				if((strcmp($bulawal,$bulakhir)==0) OR empty($bulakhir)){
					$nama = "Laporan Pengeluaran Bulanan - " . $bulawal;
					$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' AND MONTH(TGL)=".$bulanaw." AND YEAR(TGL)=".$tahunaw." ORDER BY ID ASC");
				}
				else{	
					$nama = "Laporan Pengeluaran ( " . $bulawal ." s.d. ". $bulakhir." )";
					$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' AND TGL between '".$tgl_awal."' AND '".$tgl_akhir."' ORDER BY KODE_PENGELUARAN ASC");
				}
			}
			else if (isset($_POST['tampil_semua_gaji'])){	
				$nama = "Laporan Semua Pengeluaran - ".$kategori;
				$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' ORDER BY ID ASC");				
			}
			
			$kategori = 'MARKETING';
			if (isset($_POST['tampil_tgl_marketing'])){			
				$tglawal = $_POST['par_tgl_marketing'];
				$tgl_awal = date_create($tglawal);
				$tgl_awalz = date_format($tgl_awal,"Y/m/d");
				
				$tglakhir = $_POST['par_tgl_marketing2'];
				$tgl_akhir = date_create($tglakhir);
				$tgl_akhirz = date_format($tgl_akhir,"Y/m/d");
			
				if((strcmp($tglawal,$tglakhir)==0) OR empty($tglakhir)){
					$nama = "Laporan Pengeluaran Harian - " . formatTanggal($tglawal);
					$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' AND TGL='".$tgl_awalz."' ORDER BY ID ASC");
				}
				else{	
					$nama = "Laporan Pengeluaran ( " . formatTanggal($tglawal) ." s.d. ". formatTanggal($tglakhir)." )";
					$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' AND TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."' ORDER BY ID ASC");
				}
			}
			else if (isset($_POST['tampil_bln_marketing'])){		
				$bulawal = $_POST['par_bln_marketing'];
				$bulanaw = substr($bulawal,0,2);
				$tahunaw = substr($bulawal,3,7);
				$tgl_awal = $tahunaw."-".$bulanaw."-01";
				
				$bulakhir = $_POST['par_bln_marketing2'];
				$bulanak = substr($bulakhir,0,2);
				$tahunak = substr($bulakhir,3,7);
				$tgl_akhir = $tahunak."-".$bulanak."-31";
				
				if((strcmp($bulawal,$bulakhir)==0) OR empty($bulakhir)){
					$nama = "Laporan Pengeluaran Bulanan - " . $bulawal;
					$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' AND MONTH(TGL)=".$bulanaw." AND YEAR(TGL)=".$tahunaw." ORDER BY ID ASC");
				}
				else{	
					$nama = "Laporan Pengeluaran ( " . $bulawal ." s.d. ". $bulakhir." )";
					$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' AND TGL between '".$tgl_awal."' AND '".$tgl_akhir."' ORDER BY KODE_PENGELUARAN ASC");
				}
			}
			else if (isset($_POST['tampil_semua_marketing'])){	
				$nama = "Laporan Semua Pengeluaran - ".$kategori;
				$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' ORDER BY ID ASC");
				
			}
			
			$kategori = 'OPERASIONAL';
			if (isset($_POST['tampil_tgl_operasional'])){			
				$tglawal = $_POST['par_tgl_operasional'];
				$tgl_awal = date_create($tglawal);
				$tgl_awalz = date_format($tgl_awal,"Y/m/d");
				
				$tglakhir = $_POST['par_tgl_operasional2'];
				$tgl_akhir = date_create($tglakhir);
				$tgl_akhirz = date_format($tgl_akhir,"Y/m/d");
			
				if((strcmp($tglawal,$tglakhir)==0) OR empty($tglakhir)){
					$nama = "Laporan Pengeluaran Harian - " . formatTanggal($tglawal);
					$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' AND TGL='".$tgl_awalz."' ORDER BY ID ASC");
				}
				else{	
					$nama = "Laporan Pengeluaran ( " . formatTanggal($tglawal) ." s.d. ". formatTanggal($tglakhir)." )";
					$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' AND TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."' ORDER BY ID ASC");
				}
			}
			else if (isset($_POST['tampil_bln_operasional'])){		
				$bulawal = $_POST['par_bln_operasional'];
				$bulanaw = substr($bulawal,0,2);
				$tahunaw = substr($bulawal,3,7);
				$tgl_awal = $tahunaw."-".$bulanaw."-01";
				
				$bulakhir = $_POST['par_bln_operasional2'];
				$bulanak = substr($bulakhir,0,2);
				$tahunak = substr($bulakhir,3,7);
				$tgl_akhir = $tahunak."-".$bulanak."-31";
				
				if((strcmp($bulawal,$bulakhir)==0) OR empty($bulakhir)){
					$nama = "Laporan Pengeluaran Bulanan - " . $bulawal;
					$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' AND MONTH(TGL)=".$bulanaw." AND YEAR(TGL)=".$tahunaw." ORDER BY ID ASC");
				}
				else{	
					$nama = "Laporan Pengeluaran ( " . $bulawal ." s.d. ". $bulakhir." )";
					$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' AND TGL between '".$tgl_awal."' AND '".$tgl_akhir."' ORDER BY KODE_PENGELUARAN ASC");
				}
			}
			else if (isset($_POST['tampil_semua_operasional'])){	
				$nama = "Laporan Semua Pengeluaran - ".$kategori;
				$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' ORDER BY ID ASC");
			}
			
			$kategori = 'PRODUKSI';
			if (isset($_POST['tampil_tgl_produksi'])){			
				$tglawal = $_POST['par_tgl_produksi'];
				$tgl_awal = date_create($tglawal);
				$tgl_awalz = date_format($tgl_awal,"Y/m/d");
				
				$tglakhir = $_POST['par_tgl_produksi2'];
				$tgl_akhir = date_create($tglakhir);
				$tgl_akhirz = date_format($tgl_akhir,"Y/m/d");
			
				if((strcmp($tglawal,$tglakhir)==0) OR empty($tglakhir)){
					$nama = "Laporan Pengeluaran Harian - " . formatTanggal($tglawal);
					$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' AND TGL='".$tgl_awalz."' ORDER BY ID ASC");
				}
				else{	
					$nama = "Laporan Pengeluaran ( " . formatTanggal($tglawal) ." s.d. ". formatTanggal($tglakhir)." )";
					$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' AND TGL BETWEEN '".$tgl_awalz."' AND '".$tgl_akhirz."' ORDER BY ID ASC");
				}
			}
			else if (isset($_POST['tampil_bln_produksi'])){		
				$bulawal = $_POST['par_bln_produksi'];
				$bulanaw = substr($bulawal,0,2);
				$tahunaw = substr($bulawal,3,7);
				$tgl_awal = $tahunaw."-".$bulanaw."-01";
				
				$bulakhir = $_POST['par_bln_produksi2'];
				$bulanak = substr($bulakhir,0,2);
				$tahunak = substr($bulakhir,3,7);
				$tgl_akhir = $tahunak."-".$bulanak."-31";
				
				if((strcmp($bulawal,$bulakhir)==0) OR empty($bulakhir)){
					$nama = "Laporan Pengeluaran Bulanan - " . $bulawal;
					$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' AND MONTH(TGL)=".$bulanaw." AND YEAR(TGL)=".$tahunaw." ORDER BY ID ASC");
				}
				else{	
					$nama = "Laporan Pengeluaran ( " . $bulawal ." s.d. ". $bulakhir." )";
					$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' AND TGL between '".$tgl_awal."' AND '".$tgl_akhir."' ORDER BY KODE_PENGELUARAN ASC");
				}
			}
			else if (isset($_POST['tampil_semua_produksi'])){	
				$nama = "Laporan Semua Pengeluaran - ".$kategori;
				$data_pengeluaran = mysqli_query($koneksi, "SELECT * from t_pengeluaran WHERE KATEGORI='".$kategori."' AND SOURCE='".$sourcex."' ORDER BY ID ASC");
			}
			$jumtrans = mysqli_num_rows($data_pengeluaran);										
			$jumtrans = number_format($jumtrans,0,',','.');      	
			$jumtrans = "Jumlah Inputan: " . $jumtrans;
			?>
			
		<u>
			<h1 class="center">LAPORAN PENGELUARAN</h1>
		</u>
			<h4 class="center">-DIFAYA BEAUTY-</h4>
		<br>
		<br>
		<br>
		<table border="0" style="width: 100%" align='center'>
			<tr>
				<td align="left" rowspan="2">
					<h5><b><?php echo $nama; ?></b></h5>
				</td>
				<td align="right">							
					<h6><b><?php echo $jumtrans; ?></b></h6>
					<h6><i><?php echo "[".$hariini.", ".$waktu_skg."-".$jam."]"; ?></i></h6>
				</td>
			</tr>
		</table>
		<table border="1" style="width: 100%" align='center'>
			<tr align='center'>
				<th width="5%">No</th>
				<th>Waktu Penginputan</th>
				<th>Kode Pengeluaran</th>
				<th>Kategori</th>
				<th>Keterangan</th>
				<th>Source Transaksi</th>
				<th>Nominal</th>
			</tr>
			<?php 
				$no = 1;		
				$total_masuk=0;
				  while($data = mysqli_fetch_array($data_pengeluaran)){					
				//$waktuu = $data['WAKTU'];
				$tgl = formatTanggal($data['TGL']);  
				$waktu = substr($data['WAKTU'],10,30);
				$hari = date('l', strtotime($data['TGL']));
				$semua = $hari.", ".$tgl." -".$waktu;
				$kodpe = $data['KODE_PENGELUARAN'];
				$katee = $data['KATEGORI'];
				$ketee = $data['NOTES'];
				$nomii = $data['NOMINAL'];
				$total_masuk=$total_masuk+$nomii;   								
				$nomii = "Rp" . number_format($nomii,0,',','.');      				
				?>
			<tr>
				<td align='center'><?php echo $no++; ?></td>
				<td align='left'><?php echo $semua; ?></td>
				<td align='center'><?php echo $kodpe; ?></td>
				<td align='center'><?php echo $katee; ?></td>
				<td align='left'><?php echo $ketee; ?></td>
				<td align='center'><?php echo $sourcex; ?></td>
				<td align='right'><?php echo $nomii; }?></td>
			</tr>
			<tr>
				<?php
					$total_masuktamp = "Rp" . number_format($total_masuk,0,',','.');      
					?>
				<td colspan="6" align="right"><b>Total</td>
				<td align='right'> <?php echo $total_masuktamp; ?></td>
			</tr>
		</table>
		<script>
		//	window.print();
		</script>
	</body>
</html>