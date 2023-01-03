<!DOCTYPE html>
<html>
	<head>
		<title>Data Pengeluaran - DIFAYA BEAUTY | Effortless Care For Priceless You</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="img/ic.png">
		<script src="js/jquery.popup.lightbox.js"></script>
		<link href="css/popup-lightbox.css" rel="stylesheet"/>
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
		<style>
			.zoom {
			padding: 10px;
			transition: transform .2s; /* Animation */
			width: auto;
			height: auto;
			margin: 0 auto;
			}
			.zoom:hover {
			transform: scale(2); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
			}
		</style>
	</head>
	<body>
		<?php 
			error_reporting(0);
			    session_start();					
				include "koneksi.php";
			    if($_SESSION['status']!="login"){
			    	echo "<script>alert('Maaf, Anda belum login...');window.location.href='index?pesan=belum_login';</script>";
			    }
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="OWNER" AND $_SESSION['level']!="ADMIN"){
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
					$data = mysqli_query($koneksi,"select * from t_pengeluaran WHERE SOURCE='$isi_source' order by ID desc");		
				}
			?>
		<h1 align='center' style="background-color:#9e7400;color:#FFFFFe">DATA PENGELUARAN</h1>
		<h4 align='center' style="background-color:#dea300;color:#FFFFee">DIFAYA BEAUTY</h4>
		<br>		
		<table id="tabel2" align="center" width="100%" border="0" cellpadding="0" cellspacing="1">
			<tr>
				<td align="left"><button type="button" class="btn btn-secondary"><a href="utama" style="color:#FFFFFe"> Kembali ke Menu Utama </a></button></td>
				<td align="right"><button type="button" class="btn btn-danger"><a href="input-pengeluaran" style="color:#FFFFFe"> + Tambah Pengeluaran </a></button></td>
			</tr>
			<tr>
				<td align="left" width="18%">
					<br>
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
							  $data = mysqli_query($koneksi,"select * from t_pengeluaran WHERE SOURCE='$data_terakhir' order by ID desc");
							  $_SESSION['source'] = $data_terakhir;
							?>
						<script type="text/javascript">
							document.getElementById('sumber').value = "<?php if ($_POST['sumber']==''){ echo $data_terakhir;} else {echo $_POST['sumber'];}?>";
						</script>
						<button type="submit" name="submit" class="btn btn-danger disabled">Pilih</button>
				</td>
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
								$data = mysqli_query($koneksi,"select * from t_pengeluaran WHERE SOURCE='$source' order by ID desc");
								
							}
						} else {
						}
					}
					?>
				</form>
				</td>
			</tr>
		</table>
		<br>
		<table id="tabel1" class="table table-hover" border="1" cellpadding="0" cellspacing="1">
			<thead align="center">
				<tr align='center' style="background-color:#9e7400;color:#ffffff">
					<th>NO.</th>
					<th>WAKTU</th>
					<th>KODE PENGELUARAN</th>
					<th>KEPERLUAN</th>
					<th>KETERANGAN</th>
					<th>NOMINAL</th>
					<th>FOTO</th>
					<th>AKSI</th>
				</tr>
			</thead>
			<?php 
				include 'koneksi.php';
				$no=1;
				         function formatTanggal($date){
				                        // ubah string menjadi format tanggal
				                        return date('d-M-Y', strtotime($date));
				                       }	
				
				//while($d = mysqli_fetch_array($data)){
				while ($d = mysqli_fetch_assoc($data)){
						$kod_pem = $d['KODE_PENGELUARAN'];
						$kateg = $d['KATEGORI'];
						$notes = $d['NOTES'];
						$nomin = $d['NOMINAL'];
						$nomin_tamp = number_format($nomin,0,",",".");	
						$foto = $d['FOTO'];
						if ($foto == ''){
							$foto="#";
						}
						else{
							$foto = "img-pengeluaran/".$foto;
						}
						$tgl = formatTanggal($d['TGL']);  
					$waktu = substr($d['WAKTU'],10,30);
				        		$hari = date('l', strtotime($d['TGL']));
				        		$semua = $hari.", ".$tgl." -".$waktu;
					?>			
			<tr align="center">
				<td><?php echo $no++; ?></td>
				<td align="left"><?php echo $semua; ?></td>
				<td><?php echo $kod_pem; ?></td>
				<td><?php echo $kateg; ?></td>
				<td align="left"><?php echo $notes; ?></td>
				<td align="right"><?php echo "Rp".$nomin_tamp; ?></td>
				<?php
					if($foto == "#"){
					?>
				<td>
					<a href="#">
						<div><img src="#" width="10px" height="auto"/></div>
					</a>
				</td>
				<?php
					}
					else{
						
					?>
				<td>
					<a href="<?php echo $foto; ?>" target="_BLANK">
						<div class="zoom_"><img src="<?php echo $foto; ?>" width="auto" height="25px"/></div>
					</a>
				</td>
				<?php } ?>
				<td>			
					<a href='edit-pengeluaran?id=<?php echo $kod_pem; ?>' title="Edit Pengeluaran"><img src="img/edit.png" class="img-responsive" height="100%"></a>	| 					
					<a href='delete-pengeluaran?id=<?php echo $kod_pem; ?>' title="Hapus Pengeluaran" onclick="return confirm('Apakah yakin ingin menghapus?')"><img src="img/delete.png" height="100%" ></a>					
				</td>
			</tr>
			<?php 
				}
				?>
		</table>
		<script>
			$(function () {
				"use strict";
				
				$(".popup img").click(function () {
					var $src = $(this).attr("src");
					$(".show").fadeIn();
					$(".img-show img").attr("src", $src);
				});
				
				$("span, .overlay").click(function () {
					$(".show").fadeOut();
				});
				
			});
		</script>
		<script>
			function cek_dulu() {         			  
				  var full_namedex = document.getElementById("full_namede").value; 
				  var passworddex = document.getElementById("passwordde").value; 
				  var phonedex = document.getElementById("phonede").value;
				  //var isi_teks = "Yakin untuk proses dengan metode bayar "+metode+"?";		
				  var isi_teks = "Are you sure you want to update?";		
				  //alert(levelx);
				  //return false;	
				  if(nama_lengkapx==''){
					  alert("Please fill in full name");
					  document.getElementById("nama_lengkap").focus();
					  return false;
				  }
				  else if(passworddex==''){
					  alert("Please fill in password");
					  document.getElementById("password").focus();
					  return false;
				  }
				  else if(phonedex==''){
					  alert("Please fill in phone");
					  document.getElementById("phone").focus();
					  return false;
				  }				
				  else{
					return confirm(isi_teks);
				  }
			}			
		</script>
		<script>
			$(document).ready(function(){
				$(".img-container").popupLightbox();
			}); 
		</script>
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
			            "lengthMenu": "Menampilkan _MENU_ Data Pengeluaran",
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