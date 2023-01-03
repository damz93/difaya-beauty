<?php
   include 'koneksi.php';
   $kode_pemasukan         = $_GET['id'];
   //$pem = mysqli_query($koneksi,"select * from t_pemasukan where KODE_PEMASUKAN='$kode_pemasukan'");
   $pem = mysqli_query($koneksi,"select * from t_pemasukan where KODE_PEMASUKAN='$kode_pemasukan'");
   //while ($row = mysqli_fetch_assoc($pem)){
	   $row = mysqli_fetch_array($pem);   
	   $kode=$row['KODE_PEMASUKAN'];
	   $keter=$row['NOTES'];
	   $sumber=$row['KATEGORI'];
	   $sourcee=$row['SOURCE'];
	   $nomi=number_format($row['NOMINAL'],0,",",".");
	   $foto = $row['FOTO'];
	   if ($foto==''){
		   $foto = '#';
	   }
	   else{
		$foto = "img-pemasukan/".$foto;		  
	   }
 //  } 
 ?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Edit Pemasukan - DIFAYA BEAUTY | Effortless Care For Priceless You</title>
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
		
		<style>
			.zoom_2 {
			padding: 10px;
			transition: transform .2s; /* Animation */
			width: auto;
			height: auto;
			margin: 0 auto;
			}
			.zoom_2:hover {
			transform: scale(2); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
			}
		</style>
   </head>
   <body>
   
   <script type="text/javascript">
			function cek_dulu(){        			   		   
			var keter = $('#keterangan').val();
			var nominal = $('#nominal').val();
						
			
			var isi_teks = "Apakah yakin ingin menyimpan?";			
				  if(keter==''){
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
			    	echo "<script>alert('Maaf, Anda belum login...');window.location.href='index?pesan=belum_login';</script>";
			    }
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="OWNER" AND $_SESSION['level']!="ADMIN"){
					echo "<script>alert('Maaf, Anda tidak memiliki akses...');window.location.href='javascript:history.go(-1)';</script>";
				}
	?>
            <h1 align='center' style="background-color:#9e7400;color:#FFFFFe">EDIT PEMASUKAN</h1>
      <h4 align='center' style="background-color:#dea300;color:#FFFFee">DIFAYA BEAUTY</h4>
     <br>  
		 <button type="button" class="btn btn-secondary"><a href="data-pemasukan" style="color:#FFFFFe"> Kembali ke Data Pemasukan </a></button><br>
      <br>
	  <div class='container'>
         <form method="post" action="update-pemasukan" onsubmit="return cek_dulu();" autocomplete="off" enctype="multipart/form-data">
		 <div class="form-group">
			 <div class="table-responsive">
				<table class="table" border="0" cellpadding="2" cellspacing="2" align=center>
				   <tr>
					  <th>Kode Pemasukan</th>
					  <th colspan="2"><input class="form-control form-control-sm" readonly type="text" name="kode_pemasukan" id="kode_pemasukan"  value="<?php echo $kode; ?>"></th>
				   </tr>		 
					<tr>
						<th>Sumber</th>
						<th colspan="2">
							<select autofocus class="form-control form-control-sm" name="kategori" id="kategori">	
								<option value="ONLINE" <?php if($sumber=="ONLINE") echo 'selected="selected"'; ?> >Online</option>
								<option value="RESELLER" <?php if($sumber=="RESELLER") echo 'selected="selected"'; ?> >Reseller</option>
								<option value="SHOPEE" <?php if($sumber=="SHOPEE") echo 'selected="selected"'; ?> >Shopee</option>
							</select>
						</th>
					</tr>
				   <tr>
					  <th>Keterangan</th>
					  <th colspan="2"><textarea class="form-control form-control-sm" placeholder="Keterangan" maxlength="60" type="text" name="keterangan" id="keterangan"><?php echo $keter; ?></textarea></th>
				   </tr>
				   <tr>
					  <th>Nominal</th>
					  <td width="1%">Rp</td><td><input class="form-control form-control-sm mata-uang" placeholder="0" type="text" id="nominal" onkeyup="inputTerbilang();" name="nominal"  value="<?php echo $nomi; ?>"></td>
				   </tr>	
				   <tr hidden>
					  <th>Source Transaksi</th>
				    <th colspan="2">
						<select class="form-control form-control-sm" name="sumber" id="sumber">
							<?php 
								include "koneksi.php";
								session_start();								
								$sql=mysqli_query($koneksi,"SELECT NAMA_SOURCE,ID FROM t_source order by ID DESC");									  
								 while ($data = mysqli_fetch_assoc($sql)){
									
								?>
							<option value="<?php echo $data['NAMA_SOURCE']; ?>"><?php echo $data['NAMA_SOURCE']; ?></option>
							<?php
								}
							?>
						</select>
						<script type="text/javascript">
							document.getElementById('sumber').value = "<?php if ($sourcee==''){ echo $data_terakhir;} else {echo $sourcee;}?>";
						</script>
				</td>
					<tr>
						<th>Upload Foto</th>
						<th colspan="2">
							<input class="form-control form-control-sm" type="file" name="upd_foto" id="upd_foto">
						</th>
					</tr>
					<tr>
						<th>Foto dalam Database</th>			
						
						<?php
							if($foto == "#"){
						?>
						<td><a href="#"><img src="<?php echo $foto; ?>"/></a></td>
						<?php
							}
							else{
								
						?>
						<td colspan="2"><a href="<?php echo $foto; ?>" target="_BLANK"><div class="zoom"><img src="<?php echo $foto; ?>" width="150px" height="auto" title="Foto dalam Database"/></a></td>
						<?php } ?>						
					</tr>
				    <tr align='center'>
					  <br>
						 <td colspan="2"><button type="submit" value="simpan" class="btn btn-danger btn-lg btn-block">Update</button></th>
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