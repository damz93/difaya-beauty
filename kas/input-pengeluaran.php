<?php
   include 'koneksi.php';
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Tambah Pengeluaran - DIFAYA BEAUTY | Effortless Care For Priceless You</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" href="img/ic.png">
      <link rel="stylesheet" type="text/css" href="css/jour.css">
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
		<script type="text/javascript">
			function cek_dulu(){        			   		   
			var keter = $('#keterangan').val();
			var nominal = $('#nominal').val();
			var kategori = $('#kategori').val();
						
			
			var isi_teks = "Apakah yakin ingin menyimpan?";			
				  if(kategori=="0"){
					  alert("Pilih Kategori Pengeluaran");
					  document.getElementById("kategori").focus();
					  return false;
				  }	
				  else if(keter==''){
					  alert("Mohon isi keterangan");
					  document.getElementById("keterangan").focus();
					  return false;
				  }
				  else if(nominal==0){
					  alert("Mohon isi Nominal");
					  document.getElementById("nominal").focus();
					  return false;
				  }				
				  else{
					return confirm(isi_teks);
				  }
			}
			
		</script>
      <div class="bg">
	  <?php 	  
				error_reporting(0);
				    session_start();					
				    if($_SESSION['status']!="login"){
				    	echo "<script>alert('Anda belum login.....');window.location.href='index.php?pesan=belum_login';</script>";                    
				    }
			else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="OWNER" AND $_SESSION['level']!="ADMIN"){
					echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";
			}
	?>
            <h1 align='center' style="background-color:#9e7400;color:#FFFFFe">TAMBAH PENGELUARAN</h1>
      <h4 align='center' style="background-color:#dea300;color:#FFFFee">DIFAYA BEAUTY</h4>
     <br>  
		 <button type="button" class="btn btn-secondary"><a href="data-pengeluaran" style="color:#FFFFFe"> Kembali ke Data Pengeluaran </a></button><br>
      <br>
	  
	  <?php 
				include 'koneksi.php';				 
				 $data_pengeluaran = mysqli_query($koneksi,"SELECT ID,KODE_PENGELUARAN FROM t_pengeluaran ORDER BY ID DESC LIMIT 1");
				 while($d = mysqli_fetch_array($data_pengeluaran)){	
					$jum_pengeluaran        = substr($d['KODE_PENGELUARAN'],5);			
					
				 }
				 
				if ($jum_pengeluaran == 0) {
					$kode_pengeluaran = "OUT-000000000001";
				}
				else{
					$jum_pengeluaran++;			
					if (strlen($jum_pengeluaran)== 1){
						$kode_pengeluaran = "OUT-00000000000".$jum_pengeluaran;				
					}
					else if (strlen($jum_pengeluaran)== 2){
						$kode_pengeluaran = "OUT-0000000000".$jum_pengeluaran;
					}
					else if (strlen($jum_pengeluaran)== 3){
						$kode_pengeluaran = "OUT-000000000".$jum_pengeluaran;
					}
					else if (strlen($jum_pengeluaran)== 4){
						$kode_pengeluaran = "OUT-00000000".$jum_pengeluaran;
					}
					else if (strlen($jum_pengeluaran)== 5){
						$kode_pengeluaran = "OUT-0000000".$jum_pengeluaran;
					}
					else if (strlen($jum_pengeluaran)== 6){
						$kode_pengeluaran = "OUT-000000".$jum_pengeluaran;
					}
					else if (strlen($jum_pengeluaran)== 7){
						$kode_pengeluaran = "OUT-00000".$jum_pengeluaran;
					}
					else if (strlen($jum_pengeluaran)== 8){
						$kode_pengeluaran = "OUT-0000".$jum_pengeluaran;
					}
					else if (strlen($jum_pengeluaran)== 9){
						$kode_pengeluaran = "OUT-000".$jum_pengeluaran;
					}
					else if (strlen($jum_pengeluaran)== 10){
						$kode_pengeluaran = "OUT-00".$jum_pengeluaran;
					}
					else if (strlen($jum_pengeluaran)== 11){
						$kode_pengeluaran = "OUT-0".$jum_pengeluaran;
					}
					else if (strlen($jum_pengeluaran)== 12){
						$kode_pengeluaran = "OUT-".$jum_pengeluaran;
					}
				}
				?>    
	  <div class='container'>
         <form method="post" action="save-pengeluaran" onsubmit="return cek_dulu();" enctype="multipart/form-data" autocomplete="off">
		 <div class="form-group">
			 <div class="table-responsive">
				<table class="table" border="0" cellpadding="2" cellspacing="2" align=center>
				   <tr>
					  <th>Kode Pengeluaran</th>
					  <th colspan="2"><input class="form-control form-control-sm" readonly type="text" name="kode_pengeluaran" id="kode_pengeluaran"  value="<?php echo $kode_pengeluaran; ?>"></th>
				   </tr>		 
					<tr>
						<th>Keperluan</th>
						<th colspan="2">

							<select autofocus class="form-control form-control-sm" name="kategori" id="kategori">							
								<option value="0" selected>Pilih Kategori</option>
								<option value="GAJI">Gaji</option>
								<option value="MARKETING">Marketing</option>
								<option value="OPERASIONAL">Operasional</option>
								<option value="PRODUKSI">Produksi</option>
							</select>
							
										 <!--<script hidden type="text/javascript">
											document.getElementById('kategori').value = "<?php //if ($_POST['kategori']==''){ echo 'OPERASIONAL';} else {echo $_POST['kategori'];}?>";
										</script>-->
						</th>
					</tr>
				   <tr>
					  <th>Keterangan</th>
					  <th colspan="2"><textarea class="form-control form-control-sm" placeholder="Keterangan" maxlength="60" type="text" name="keterangan" id="keterangan"></textarea></th>
				   </tr>
				   <tr>
					  <th>Nominal</th>
					  <td width="1%">Rp</td><td><input class="form-control form-control-sm mata-uang" placeholder="0" type="text" id="nominal" onkeyup="inputTerbilang();" name="nominal"></td>
				   </tr>	
				   <tr hidden>
					  <th>Source Transaksi</th>
				    <th colspan="2">
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
						</select>
						<script type="text/javascript">
							document.getElementById('sumber').value = "<?php if ($_POST['sumber']==''){ echo $data_terakhir;} else {echo $_POST['sumber'];}?>";
						</script>
				</td>
				   
				   
				   
				   
				   
				   
				   </tr>
					<tr>
						<th>Upload Foto</th>
						<th colspan="2">
							<input class="form-control form-control-sm" type="file" name="upd_foto" id="upd_foto">
						</th>
					</tr>
				   <tr align='center'>
					  <br>
						 <td colspan="2"><button type="submit" value="simpan" class="btn btn-danger btn-lg btn-block">Simpan</button></th>
						 <td><button onclick="autofocuss()" type="reset" class="btn btn-secondary disabled btn-lg btn-block">Batal</button>
					  </th>
				   </tr>			   
				</table>
				</div>
			</div>
         </form>
         <script src="js/jquery-1.11.2.min.js"></script>
         <script src="js/jquery.mask.min.js"></script>
         <script src="js/terbilang.js"></script>
         <script>
            function autofocuss() {
            	document.getElementById("KODE_BARANG").focus();
            }
             
         </script>
         <script>
            function inputTerbilang() {
              //membuat inputan otomatis jadi mata uang
              $('.mata-uang').mask('0.000.000.000', {reverse: true});
            
              //mengambil data uang yang akan dirubah jadi terbilang
               var input = document.getElementById("terbilang-input").value.replace(/\./g, "");
            
               //menampilkan hasil dari terbilang
               document.getElementById("terbilang-output").value = terbilang(input).replace(/  +/g, ' ');
            } 
         </script>			
      </div>
   </body>
</html>