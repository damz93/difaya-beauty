<!DOCTYPE html>
<html>
	<head>
		<title>Data Log - DIFAYA BEAUTY | Effortless Care For Priceless You</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="img/ic.png">
		<link rel="stylesheet" href="css/jour.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>				
		<style>
			body, html {
			height: 100%;
			margin: 0;
			background-image: url("img/bgo.png");
			}
			.bg {
			/* The image used */
			background-image: url("img/bgf.png");			
			/* Full height */
			height: 100%; 
			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			}
		</style>
	</head>
	<body>
		<?php 
			error_reporting(0);
			    session_start();					
			    if($_SESSION['status']!="login"){
			    	echo "<script>alert('Maaf, Anda belum login...');window.location.href='index?pesan=belum_login';</script>";
			    }
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="MITRA" AND $_SESSION['level']!="OWNER"){
					echo "<script>alert('Maaf, Anda tidak memiliki akses...');window.location.href='javascript:history.go(-1)';</script>";
				}
				else{
					$cek_isi = $_SESSION['source'];
					if (($cek_isi == '')or($cek_isi=='BARU')){					
						$sql=mysqli_query($koneksi,"SELECT * FROM t_source order by ID DESC LIMIT 1");									  
						while ($data = mysqli_fetch_assoc($sql)){
							$ter = $data['NAMA_SOURCE']	;
						}
						$isi_source = $ter;
						$_SESSION['source'] = $isi_source;
					}
					else {
						$isi_source = $cek_isi;								
						$_SESSION['source'] = $isi_source;
					}
					$data = mysqli_query($koneksi,"select * from t_log WHERE SOURCE='$isi_source' order by ID desc");		
								
				}
			?>
		<h1 align='center' style="background-color:#9e7400;color:#FFFFFe">DATA LOG</h1>
		<h4 align='center' style="background-color:#dea300;color:#FFFFee">DIFAYA BEAUTY</h4>
		<br>
		<button type="button" class="btn btn-secondary"><a href="utama" style="color:#FFFFFe"> Kembali ke Menu Utama </a></button></br>
		<br>		
		<table id="tabel2" align="left" width="18%" border="0" cellpadding="0" cellspacing="1">
			<tr>
				<td align="left" width="100%">
					<form action="" method="post">
						<select class="form-control form-control-sm" name="sumber" id="sumber">
							<?php 
								include "koneksi.php";
								session_start();										 
								$cek_isi = $_SESSION['source'];
								//echo "<script>alert('$cek_isi')</script>";
								$sql=mysqli_query($koneksi,"SELECT NAMA_SOURCE,ID FROM t_source order by ID DESC");									  
								 while ($data = mysqli_fetch_assoc($sql)){
									
								?>
							<option value="<?php echo $data['NAMA_SOURCE']; ?>"><?php echo $data['NAMA_SOURCE']; ?></option>
							<?php
								}		
								
								$sql33=mysqli_query($koneksi,"SELECT * FROM t_source order by ID DESC LIMIT 1");									  
									while ($data33 = mysqli_fetch_assoc($sql33)){
										$lastt = $data33['NAMA_SOURCE'];
									}
								 
								?>												
							<option value="BARU">+ Tambah Source</option>
						</select>
						<?php
							if ($cek_isi == ''){
								$lastt2 = $lastt;
								$_SESSION['source'] = $lastt2;
							}
							else{
								$lastt2 = $cek_isi;		
								$_SESSION['source'] = $lastt2;
							}																							 
							  $data_terakhir = $lastt2;
							  $data = mysqli_query($koneksi,"select * from t_log WHERE SOURCE='$data_terakhir' order by ID desc");
							  $_SESSION['source'] = $data_terakhir;
							?>
						<script type="text/javascript">
							document.getElementById('sumber').value = "<?php if ($_POST['sumber']==''){ echo $data_terakhir;} else {echo $_POST['sumber'];}?>";
						</script>
						<button type="submit" name="submit" class="btn btn-danger disabled">Pilih</button>				
				<?php
					session_start();
					include "koneksi.php";
					if(isset($_POST['submit'])){
						if(!empty($_POST['sumber'])) {
							$source = $_POST['sumber'];											
							$_SESSION['source'] = $source;
							if($source=='BARU'){
								//echo "<script>alert('Anda memilih Baru...');</script>";
								echo "<script>window.location.href='input-source';</script>";
							}
							else{
								$pilihan = 'Anda memilih '.$source;
								$_SESSION['source'] = $source;
								echo "<script>alert('".$pilihan."');</script>";
								$data = mysqli_query($koneksi,"select * from t_log WHERE SOURCE='$source' order by ID desc");
								
							}
						} else {
						}
					}
					?>
				</form>
				
				<br>
				</td>
			</tr>
		</table>
		<table id="tabel1" class="table table-hover" border="1" cellpadding="0" cellspacing="1">
			<thead align="center">
				<tr align='center' style="background-color:#9e7400;color:#ffffff">
					<th>NO.</th>
					<th>WAKTU</th>
					<th>KODE LOG</th>
					<th>TANDA</th>
					<th>KETERANGAN</th>
					<th>DETAIL</th>
				</tr>
			</thead>
			<?php 
				include 'koneksi.php';
				$no=1;
				
				 function formatTanggal($date){
				                // ubah string menjadi format tanggal
				                return date('d-M-Y', strtotime($date));
				               }	
				while($d = mysqli_fetch_array($data)){            	
				$tanda=$d['TANDA'];
				$kod_log=$d['KODE_LOG'];
				$keterangan=$d['NOTES'];
				$isi=$d['ISI'];
				//$waktu=$d['WAKTU'];				
				$tgl = formatTanggal($d['TGL']);  
				$waktu = substr($d['WAKTU'],10,30);
					$hari = date('l', strtotime($d['TGL']));
					$semua = $hari.", ".$tgl." -".$waktu;
				?>
			<tr align="center">
				<td><?php echo $no++; ?></td>
				<td align="left"><?php echo $semua; ?></td>
				<td><?php echo $kod_log; ?></td>
				<td><?php echo $tanda; ?></td>
				<td><?php echo $keterangan; ?></td>
				<td align="left"><?php echo $isi; ?></td>
			</tr>
			<?php 
				}
				?>
		</table>
		<script type="text/javascript">
			$(document).ready(function() {
			    //$("#tabel1").tablesorter();
			    $("#tabel1").DataTable({
			        "paging": true,
			        "ordering": true,
			        "info": true,
			        // });
			        //$("#tabel1").DataTable({
			        "language": {
			            "decimal": "",
			            "emptyTable": "Tidak ada data yang tersedia di tabel",
			            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ Inputan",
			            "infoEmpty": "Menampilkan 0 sampai 0 dari 0 Inputan",
			            "infoFiltered": "(difilter dari _MAX_ total Inputan)",
			            "infoPostFix": "",
			            "thousands": ".",
			            "lengthMenu": "Menampilkan _MENU_ Data Log",
			            "loadingRecords": "memuat...",
			            "processing": "Sedang di proses...",
			            "search": "Pencarian:",
			            "zeroRecords": "Arsip tidak ditemukan",
			            "paginate": {
			                "first": "Pertama",
			                "last": "Terakhir",
			                "next": "Selanjutnya",
			                "previous": "Kembali"
			            },
			            "aria": {
			                "sortAscending": ": aktifkan urutan kolom ascending",
			                "sortDescending": ": aktifkan urutan kolom descending"
			            }
			        }
			    });
			});
		</script>
	</body>
</html>