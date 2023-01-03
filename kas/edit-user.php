<?php
	include 'koneksi.php';
	$id         = $_GET['id'];
	$user  = mysqli_query($koneksi, "select * from tbl_user where ID='$id'");
	$row        = mysqli_fetch_array($user);
	$level = $row['LEVEL'];
	?>
<!DOCTYPE html>
<html>
	<head>
		<title>Edit User - M I S O</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="img/ic.png">
		<link rel="stylesheet" href="css/journ_bootstrap.min.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<style>
			body, html {
			height: 100%;
			margin: 0;
			}
			.bg {
			/* The image used */
			background-image: url("img/bgf.png");
			opacity: .9;
			/* Full height */
			height: 100%; 
			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			}
		</style>
		<style>
			table {
			width:20%;
			background-color:#f4f4f4;			  
			}
			th {
			width:5%;
			}
			tr {
			height:40%;
			}
		</style>
	</head>
	<body>
		<script>
			function cek_dulu() {         		  
				  var passwordx = document.getElementById("password").value; 
				  var nama_lengkapx = document.getElementById("nama_lengkap").value; 
				  var phonex = document.getElementById("phone").value; 
				  //var isi_teks = "Yakin untuk proses dengan metode bayar "+metode+"?";		
				  var isi_teks = "Are you sure you want to update?";		
				  //alert(levelx);
				  //return false;				 
				if(nama_lengkapx==''){
					  alert("Please fill in full name");
					  document.getElementById("nama_lengkap").focus();
					  return false;
				  }
				  else if(passwordx==''){
					  alert("Please fill in password");
					  document.getElementById("password").focus();
					  return false;
				  }
				  else if(phonex==''){
					  alert("Please fill in phone");
					  document.getElementById("phone").focus();
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
					echo "<script>alert('You are not logged in yet.....');window.location.href='index?pesan=belum_login';</script>";                    
				}
				else if ($_SESSION['level']!="SUPER ADMIN" AND $_SESSION['level']!="PETUGAS" AND $_SESSION['level']!="PETUGAS"){
					echo "<script>alert('You dont have access.....');window.location.href='javascript:history.go(-1)';</script>";
				}
				?>
			<h1 align='center' style="background-color:#d13a3a;color:#FFFFFe">EDIT USER</h1>
			<h3 align='center' style="background-color:#f58383;color:#FFFFee">- M I S O -</h3>
			<br>
			<div class='container'>
				<a style="background-color:#f58383;color:#FFFFFe" href="data-user"> [ Back to Data User ] </a><br>
				<br>
				<form method="post" action="update-user" autocomplete="off" onsubmit="return cek_dulu();">
					<div class="table-responsive-lg">
						<table border="0" class="table" cellpadding="2" cellspacing="2" align=center>
							<div class="form-group">
								<tr>
									<th>Username</th>
									<th><input readonly value="<?php echo $row['USERNAME'];?>" id="username" name="USERNAME" class="form-control form-control-sm"></th>
								</tr>
								<tr>
									<th>Full Name</th>
									<th><input autofocus maxlength="30" type="text" id="nama_lengkap"  placeholder="Full Name" value="<?php echo $row['NAMA_LENGKAP'];?>" name="NAMA_LENGKAP" class="form-control form-control-sm"></th>
								</tr>
								<tr>
									<th>Password</th>
									<th><input type='password' maxlength="30" type="text" id="password"  placeholder="Password" value="<?php echo $row['PASSWORD'];?>" name="PASSWORD" class="form-control form-control-sm"></th>
								</tr>
								<tr>
									<th>Phone</th>
									<th><input class="form-control form-control-sm" value="<?php echo $row['PHONE'];?>" placeholder="Phone" maxlength="30" type="number" id="phone" name="PHONE"></th>
								</tr>
								<tr>
									<th>Level</th>
									<th>
										<select name="LEVELX" id="LEVELX" autofocus onchange="autofocus2()" autofocus class="form-control form-control-sm">
											<option value="ADMIN" <?php if($level=="ADMIN") echo 'selected="selected"'; ?> >Admin</option>
											<option value="PENGAWAS" <?php if($level=="PENGAWAS") echo 'selected="selected"'; ?> >Pengawas</option>
											<option value="TEKNISI" <?php if($level=="TEKNISI") echo 'selected="selected"'; ?> >Teknisi</option>
										</select>
									</th>
								</tr>
								<tr align='center'>
									<br>
									<th colspan="4"><button type="submit" value="save" class="btn btn-primary btn-lg btn-block">Update</button></th>
								</tr>
							</div>
						</table>
					</div>
			</div>
		</div>
		</form>
		</div>
	</body>
</html>