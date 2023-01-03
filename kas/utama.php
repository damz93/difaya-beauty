<html>
	<head>
		<title>Menu Utama - DIFAYA BEAUTY | Effortless Care For Priceless You</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="img/ic.png">
		<link rel="stylesheet" href="css/jour.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<style>
			body, html {
			height: 100%;
			margin: 0;
			}
			.bg {
			/* The image used */
			background-image: url("img/bgf.png");			
			/* Full height */
			height: 75%; 
			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			}
		</style>
		<style>
			.footer {
			position: fixed;
			left: 0;
			bottom: 0;
			width: 100%;
			height: 5%;
			background-color: #9e7400;		   
			text-align: center;
			}
		</style>
		<style>
			.header {
			padding: 20px;
			text-align: center;
			background: #be8b00;		
			height: 20%;
			color:#FFFFFe;
			}
		</style>
	<style>
	.responsive {
	  width: 100%;
	  max-width: 400px;
	  height: auto;
	}
	</style>
	<style>
		button {
		  opacity: 0.8;
		}

		button:hover {
		  opacity: 1.0;
		}
		select {
		  opacity: 0.6;
		}

		select:hover {
		  opacity: 1.0;
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
	  
	</head>
	<body>
		<?php 
			error_reporting(0);
			    session_start();					
			    if($_SESSION['status']!="login"){
			    	echo "<script>alert('Maaf, Anda belum login...');window.location.href='index?pesan=belum_login';</script>";                    
			    }
					else if ($_SESSION['level']!="ADMIN" AND $_SESSION['level']!="OWNER" AND $_SESSION['level']!="MITRA"){
					echo "<script>alert('Maaf, Anda tidak memiliki akses...');window.location.href='javascript:history.go(-1)';</script>";
				}
			?> 
		<div class="header">
			<h1><b> MENU UTAMA</b></h1>
			<h5>DIFAYA BEAUTY - <i>Effortless Care For Priceless You</i></h5>
		</div>
		<div class="bg">
			<div class="main">
				<div class="main-content">
					<div class="table-responsive">
						<table style="width;100%;height:100%" border="0" cellpadding="2" cellspacing="2" align="center">
							<tr style="height:5%">
								<td valign="top" style="background-color:#ffedbb;" align="left" colspan="1">
									<form action="" method="post" onsubmit="cek_source()">
										<select class="form-control form-control-sm" name="sumber" id="sumber">
											<?php 
											 include "koneksi.php";
											 session_start();										 
											 $cek_isi = $_SESSION['source'];
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
												}
												//echo "<script>alert('tidak kosong...');</script>";
											} else {
											//	echo "<script>alert('kosong...');</script>";
											}
										}/*
										else{
											$sql2=mysqli_query($koneksi,"SELECT * FROM t_source order by ID DESC LIMIT 1");
											while ($data2 = mysqli_fetch_assoc($sql2)){
												$ter = $data2['NAMA_SOURCE']	;
											}
											$tes = $ter;
											$_SESSION['source'] = $tes;
											//echo "<script>alert(''".$tes."'');</script>";
										}*/
									?>
									</form>
								<td colspan="4" style="background-color:#ffedbb;">
								</td>
							</tr>
							<tr style="height:15%">
								<td valign="top" align="center" style="background-color:#ffedbb;width:20%">
									<a href="data-pemasukan" title="Data Pemasukan">
										<img src="img/ut_pemasukan.png" class="responsive" style="display: block; margin: auto;">
										<figcaption class="figure-caption" align='center'>
											<h4 style="color:#dea300">
											DATA PEMASUKAN</h4>
										</figcaption>
									</a>
								</td>
								<td valign="top" align="center" style="background-color:#ffedbb;width:20%">
									<a href="data-pengeluaran" title="Data Pengeluaran">
										<img src="img/ut_pengeluaran.png" class="responsive"style="display: block; margin: auto;">
										<figcaption class="figure-caption" align='center'>
											<h4 style="color:#dea300">
											DATA PENGELUARAN</h4>
										</figcaption>
									</a>
								</td>
								<td valign="top" align="center" style="background-color:#ffedbb;width:20%">
									<a href="data-user" title="Data User">
										<img src="img/ut_user.png" class="responsive"style="display: block; margin: auto;">
										<figcaption class="figure-caption" align='center'>
											<h4 style="color:#dea300">
											DATA USER</h4>
										</figcaption>
									</a>
								</td>
								<td valign="top" align="center" style="background-color:#ffedbb;width:20%">
									<a href="data-log" title="Data Log">
										<img src="img/ut_log.png" class="responsive"style="display: block; margin: auto;">
										<figcaption class="figure-caption" align='center'>
											<h4 style="color:#dea300">
											DATA LOG</h4>
										</figcaption>
									</a>
								</td>
								<td valign="top" align="center" style="background-color:#ffedbb;width:20%">
									<a href="data-report" title="Data Report">
										<img src="img/ut_report.png" class="responsive"style="display: block; margin: auto;">
										<figcaption class="figure-caption" align='center'>
											<h4 style="color:#dea300">
											DATA LAPORAN</h4>
										</figcaption>
									</a>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="footer">
			<p style="font-size:100%;">
				<b>			
					<a style="background-color:#7f5d00;color:#fffffe" href="logout"> _L O G O U T_ </a><br>
				</b>
			</p>
		</div>
	
	<div id="add-source" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3>Tambah User Baru</h3>
					</div>
					<div class="modal-body">
						<form id="input-user" name="inputuser" role="form" autocomplete="off">
							<div class="form-group">
								<label>Username</label>
								<input placeholder="Username" type="text" name="usernamed" id="usernamed" autofocus onchange="cek_username();" class="form-control form-control-sm">
								<input hidden readonly="readonly" type="text" value="0" id="usernamed2" name="usernamed2">
								<label>Nama Lengkap</label>
								<input placeholder="Full Name" type="text" name="full_named" id="full_named" class="form-control form-control-sm">
								<label>Password</label>
								<input placeholder="Password" type="password" name="passwordd" id="passwordd" class="form-control form-control-sm">
								<label>Level</label>
								<select class="form-control form-control-sm" name="leveld" id="leveld">
									<option selected value="0">Choose a Level</option>
									<option value="ADMIN">Admin</option>
									<option value="MITRA">Mitra</option>
								</select>
							</div>
						</form>
					</div>
					<div class="modal-footer">					
						<button  value="add" name="savee" id="savee" class="btn btn-primary">Tambah</button>	
						<button type="reset" value="reset" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					</div>
				</div>
			</div>
		</div>
	
	</body>
</html>