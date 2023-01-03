<!DOCTYPE html>
<html>
   <head>
		<title>Data Laporan - DIFAYA BEAUTY | Effortless Care For Priceless You</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="img/ic.png">
		<link rel="stylesheet" href="css/jour.css">
		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>	
<!--		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		 <style>
			 body, html {
			 height: 100%;
			 margin: 0;
			 }
			 .bg {
			 /* The image used */
			 background-image: url("img/bgo.png");
			 /* Full height */
			 height: 100%; 
			 /* Center and scale the image nicely */
			 background-position: center;
			 background-repeat: no-repeat;
			 background-size: cover;
			 }
		  </style>
   </head>
	<style>
	.responsive {
	  width: 100%;
	  max-width: 400px;
	  height: auto;
	}
	</style>
	
	<style>
		img {
		  opacity: 0.8;
		}

		img:hover {
		  opacity: 1.0;
		}
	  </style>
   <body>
      <div class="bg">
		<?php 
				error_reporting(0);
			    session_start();					
			    if($_SESSION['status']!="login"){
			    	echo "<script>alert('Maaf, Anda belum login...');window.location.href='index?pesan=belum_login';</script>";
			    }
				else if ($_SESSION['level']!="MITRA" AND $_SESSION['level']!="ADMIN" AND $_SESSION['level']!="OWNER"){
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
					$data = mysqli_query($koneksi,"select * from t_pemasukan WHERE SOURCE='$isi_source' order by ID desc");		
				}
			?>     
		<h1 align='center' style="background-color:#9e7400;color:#FFFFFe">DATA REPORT</h1>
		<h4 align='center' style="background-color:#dea300;color:#FFFFee">DIFAYA BEAUTY</h4>
		<br>		
		<table id="tabel2" align="left" width="18%" border="0" cellpadding="0" cellspacing="1">
			<tr>
				<td align="left"><button type="button" class="btn btn-secondary"><a href="utama" style="color:#FFFFFe"> Kembali ke Menu Utama </a></button></td>
			</tr>
			
			<tr>
				<td>
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
							  $data = mysqli_query($koneksi,"select * from t_pemasukan WHERE SOURCE='$data_terakhir' order by ID desc");
							  $_SESSION['source'] = $data_terakhir;
							?>
						<script type="text/javascript">
							document.getElementById('sumber').value = "<?php if ($_POST['sumber']==''){ echo $data_terakhir;} else {echo $_POST['sumber'];}?>";
						</script>
						<button type="submit" name="submit" class="btn btn-danger disabled">Pilih</button>
		<br>
		<br>
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
								$data = mysqli_query($koneksi,"select * from t_pemasukan WHERE SOURCE='$source' order by ID desc");
								
							}
						} else {
						}
					}
					?>
				</form>
				</td>
			</tr>
			
		</table>			
         <div class="main">
            <div class="main-content">
               <table style="width:100%;height:100%">
                  <tr style="height:50%">
				  
					<td style="width:20%" valign="center" align="center">
                        <a href="#">
                        <img data-toggle="collapse" data-target="#lap_pemasukan" class="collapsible" src="img/ut_report.png" style="display: block; margin: auto;"/></a>
                        <figcaption class="figure-caption" align='center'>      
							<h4 style="color:#dea300">Laporan Pemasukan</h4>
                           </figcaption>
						<div id="lap_pemasukan" class="collapse">                				 					
                              <h4><a data-toggle="collapse" data-target="#data_target_online" class="btn btn-outline-success">Online</a></h4>   
								<div id="data_target_online" class="collapse">
									<form method="post" action="report-pemasukan" target="_BLANK">
										 <h6>Laporan Harian</h6>
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Awal(yyyy/mm/dd)"  id="tgl_online" name="par_tgl_online">	
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Akhir(yyyy/mm/dd)"  id="tgl_online2" name="par_tgl_online2">	
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_tgl_online">Tampilkan Harian</button><h6>-</h6>
										 <h6>Laporan Bulanan</h6>
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Awal(mm/yyyy)"  id="bln_online" name="par_bln_online">
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Akhir(mm/yyyy)"  id="bln_online2" name="par_bln_online2">										 
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_bln_online">Tampilkan Bulanan</button><h6>-</h6>
										 </button><br><button onclick="" type="submit" class="btn btn-secondary" name="tampil_semua_online">Tampilkan Semua</button>
										<br>										 
									 </form>
									 <br>						
								</div>       				
                              <h4><a data-toggle="collapse" data-target="#data_target_reseller" class="btn btn-outline-success">Reseller</a></h4>   
								<div id="data_target_reseller" class="collapse">
									<form method="post" action="report-pemasukan" target="_BLANK">
										 <h6>Laporan Harian</h6>
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Awal(yyyy/mm/dd)"  id="tgl_reseller" name="par_tgl_reseller">	
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Akhir(yyyy/mm/dd)"  id="tgl_reseller2" name="par_tgl_reseller2">	
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_tgl_reseller">Tampilkan Harian</button><h6>-</h6>
										 <h6>Laporan Bulanan</h6>
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Awal(mm/yyyy)"  id="bln_reseller" name="par_bln_reseller">
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Akhir(mm/yyyy)"  id="bln_reseller2" name="par_bln_reseller2">										 
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_bln_reseller">Tampilkan Bulanan</button><h6>-</h6>
										 </button><br><button onclick="" type="submit" class="btn btn-secondary" name="tampil_semua_reseller">Tampilkan Semua</button>
										<br>										 
									 </form>
									 <br>						
								</div>              	
			
							<h4><a data-toggle="collapse" data-target="#data_target_shopee" class="btn btn-outline-success">Shopee</a></h4>   
								<div id="data_target_shopee" class="collapse">
									<form method="post" action="report-pemasukan" target="_BLANK">
										 <h6>Laporan Harian</h6>
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Awal(yyyy/mm/dd)"  id="tgl_shopee" name="par_tgl_shopee">	
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Akhir(yyyy/mm/dd)"  id="tgl_shopee2" name="par_tgl_shopee2">
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_tgl_shopee">Tampilkan Harian</button><h6>-</h6>
										 <h6>Laporan Bulanan</h6>
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Awal(mm/yyyy)"  id="bln_shopee" name="par_bln_shopee">
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Akhir(mm/yyyy)"  id="bln_shopee2" name="par_bln_shopee2">										 
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_bln_shopee">Tampilkan Bulanan</button><h6>-</h6>
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_semua_shopee">Tampilkan Semua</button>
									</form>
									<br>						
								</div>        								
                              
                        </div>
                     </td>
				  			
					<td style="width:20%" valign="center" align="center">
                        <a href="#">
                        <img data-toggle="collapse" data-target="#lap_pengeluaran" class="collapsible" src="img/ut_report.png" style="display: block; margin: auto;"/></a>
                        <figcaption class="figure-caption" align='center'>      
							<h4 style="color:#dea300">Laporan Pengeluaran</h4>
                           </figcaption>
						<div id="lap_pengeluaran" class="collapse">                							
							<h4><a data-toggle="collapse" data-target="#data_target_gaji" class="btn btn-outline-primary">Gaji</a></h4>   
								<div id="data_target_gaji" class="collapse">
									<form method="post" action="report-pengeluaran" target="_BLANK">
										 <h6>Laporan Harian</h6>
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Awal(yyyy/mm/dd)"  id="tgl_gaji" name="par_tgl_gaji">	
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Akhir(yyyy/mm/dd)"  id="tgl_gaji2" name="par_tgl_gaji2">
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_tgl_gaji">Tampilkan Harian</button><h6>-</h6>
										 <h6>Laporan Bulanan</h6>
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Awal(mm/yyyy)"  id="bln_gaji" name="par_bln_gaji">
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Akhir(mm/yyyy)"  id="bln_gaji2" name="par_bln_gaji2">
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_bln_gaji">Tampilkan Bulanan</button><h6>-</h6>
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_semua_gaji">Tampilkan Semua</button>
									</form>
									<br>						
								</div>         					
                              <h4><a data-toggle="collapse" data-target="#data_target_marketing" class="btn btn-outline-primary">Marketing</a></h4>   
								<div id="data_target_marketing" class="collapse">
									<form method="post" action="report-pengeluaran" target="_BLANK">
										 <h6>Laporan Harian</h6>
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Awal(yyyy/mm/dd)"  id="tgl_marketing" name="par_tgl_marketing">	
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Akhir(yyyy/mm/dd)"  id="tgl_marketing2" name="par_tgl_marketing2">	
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_tgl_marketing">Tampilkan Harian</button><h6>-</h6>
										 <h6>Laporan Bulanan</h6>
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Awal(mm/yyyy)"  id="bln_marketing" name="par_bln_marketing">
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Akhir(mm/yyyy)"  id="bln_marketing2" name="par_bln_marketing2">										 
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_bln_marketing">Tampilkan Bulanan</button><h6>-</h6>
										 </button><br><button onclick="" type="submit" class="btn btn-secondary" name="tampil_semua_marketing">Tampilkan Semua</button>
										<br>										 
									 </form>
									 <br>						
								</div>       				
                              <h4><a data-toggle="collapse" data-target="#data_target_operasional" class="btn btn-outline-primary">Operasional</a></h4>   
								<div id="data_target_operasional" class="collapse">
									<form method="post" action="report-pengeluaran" target="_BLANK">
										 <h6>Laporan Harian</h6>
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Awal(yyyy/mm/dd)"  id="tgl_operasional" name="par_tgl_operasional">	
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Akhir(yyyy/mm/dd)"  id="tgl_operasional2" name="par_tgl_operasional2">	
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_tgl_operasional">Tampilkan Harian</button><h6>-</h6>
										 <h6>Laporan Bulanan</h6>
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Awal(mm/yyyy)"  id="bln_operasional" name="par_bln_operasional">
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Akhir(mm/yyyy)"  id="bln_operasional2" name="par_bln_operasional2">										 
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_bln_operasional">Tampilkan Bulanan</button><h6>-</h6>
										 </button><br><button onclick="" type="submit" class="btn btn-secondary" name="tampil_semua_operasional">Tampilkan Semua</button>
										<br>										 
									 </form>
									 <br>						
								</div>              							
                              			
                              <h4><a data-toggle="collapse" data-target="#data_target_produksi" class="btn btn-outline-primary">Produksi</a></h4>   
								<div id="data_target_produksi" class="collapse">
									<form method="post" action="report-pengeluaran" target="_BLANK">
										 <h6>Laporan Harian</h6>
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Awal(yyyy/mm/dd)"  id="tgl_produksi" name="par_tgl_produksi">	
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Akhir(yyyy/mm/dd)"  id="tgl_produksi2" name="par_tgl_produksi2">	
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_tgl_produksi">Tampilkan Harian</button><h6>-</h6>
										 <h6>Laporan Bulanan</h6>
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Awal(mm/yyyy)"  id="bln_produksi" name="par_bln_produksi">
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Akhir(mm/yyyy)"  id="bln_produksi2" name="par_bln_produksi2">										 
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_bln_produksi">Tampilkan Bulanan</button><h6>-</h6>
										 </button><br><button onclick="" type="submit" class="btn btn-secondary" name="tampil_semua_produksi">Tampilkan Semua</button>
										<br>										 
									 </form>
									 <br>						
								</div>              							
                              
                        </div>
                     </td>
				  				  
                     <td style="width:20%" valign="center" align="center">
                        <a href="#">
                        <img data-toggle="collapse" data-target="#lap_mitra" class="collapsible" src="img/ut_report.png" style="display: block; margin: auto;"/></a>
                        <figcaption class="figure-caption" align='center'>                           
							  <h4 style="color:#dea300">Laporan Mitra</h4>                           
                        </figcaption>
                           <form method="post" action="report-mitra" target="_BLANK">                              
                              <div id="lap_mitra" class="collapse">					
								  <h6>Laporan Harian</h6>
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Awal(yyyy/mm/dd)"  id="tgl_mitra" name="par_tgl_mitra">	
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Akhir(yyyy/mm/dd)"  id="tgl_mitra2" name="par_tgl_mitra2">	
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_tgl_mitra">Tampilkan Harian</button><h6>-</h6>
										 <h6>Laporan Bulanan</h6>
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Awal(mm/yyyy)"  id="bln_mitra" name="par_bln_mitra">
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Akhir(mm/yyyy)"  id="bln_mitra2" name="par_bln_mitra2">										 
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_bln_mitra">Tampilkan Bulanan</button><h6>-</h6>
										 </button><br><button onclick="" type="submit" class="btn btn-secondary" name="tampil_semua_mitra">Tampilkan Semua</button>
                              </div>
                           </form> 
                     </td>      
				  				  
                     <td style="width:20%" valign="center" align="center">
                        <a href="#">
                        <img data-toggle="collapse" data-target="#lap_admin" class="collapsible" src="img/ut_report.png" style="display: block; margin: auto;"/></a>
                        <figcaption class="figure-caption" align='center'>                           
							  <h4 style="color:#dea300">Laporan Admin</h4>                           
                        </figcaption>
                           <form method="post" action="report-admin" target="_BLANK">
							<div id="lap_admin" class="collapse">					
								  <h6>Laporan Harian</h6>
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Awal(yyyy/mm/dd)"  id="tgl_admin" name="par_tgl_admin">	
										 <input class="form-control form-control-sm datepicker" type="text" placeholder="Tgl Akhir(yyyy/mm/dd)"  id="tgl_admin2" name="par_tgl_admin2">	
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_tgl_admin">Tampilkan Harian</button><h6>-</h6>
										 <h6>Laporan Bulanan</h6>
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Awal(mm/yyyy)"  id="bln_admin" name="par_bln_admin">
										 <input type="text" class="form-control form-control-sm datepicker" placeholder="Bulan Akhir(mm/yyyy)"  id="bln_admin2" name="par_bln_admin2">										 
										 <button onclick="" type="submit" class="btn btn-secondary" name="tampil_bln_admin">Tampilkan Bulanan</button><h6>-</h6>
										 </button><br><button onclick="" type="submit" class="btn btn-secondary" name="tampil_semua_admin">Tampilkan Semua</button>
                              </div>
                           </form> 
                     </td>      							
                  </tr>
               </table>
            </div>
         </div>
      </div>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_admin2').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_admin').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_admin').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_admin2').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_mitra2').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_mitra').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_mitra').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_mitra2').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_shopee2').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_shopee').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_shopee').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_shopee2').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
   
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_online2').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_online').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_online').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_online2').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_reseller2').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_reseller').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_reseller').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_reseller2').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_gaji2').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_gaji').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_gaji').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_gaji2').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_marketing2').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_marketing').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_marketing').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_marketing2').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_operasional2').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_operasional').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_operasional').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_operasional2').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_produksi2').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#tgl_produksi').datepicker({
         minViewMode: 3,
         autoclose: true,
         format: 'yyyy-mm-dd'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_produksi').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
      <script type='text/javascript'>
         $(document).ready(function () {
         $('#bln_produksi2').datepicker({
         minViewMode: 1,
         autoclose: true,
         format: 'mm-yyyy'
         });  
         
         });
      </script>
   </body>
</html>