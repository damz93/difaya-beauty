<!DOCTYPE html>
<html>
	<head>
		<title>Data User - DIFAYA BEAUTY | Effortless Care For Priceless You</title>
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
		<style>
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
				else if ($_SESSION['level']!="OWNER" AND $_SESSION['level']!="OWNER" AND $_SESSION['level']!="OWNER"){
					echo "<script>alert('Maaf, Anda tidak memiliki akses...');window.location.href='javascript:history.go(-1)';</script>";
				}
				else{
					$cek_isi = $_SESSION['source'];
					if ($cek_isi == ''){					
						$sql=mysqli_query($koneksi,"SELECT * FROM t_source order by ID DESC LIMIT 1");									  
						while ($data = mysqli_fetch_assoc($sql)){
							$ter = $data['NAMA_SOURCE']	;
						}
						$isi_source = $ter;							
					}
					else {
						$isi_source = $cek_isi;		
					}
					//echo "<script>alert('".$isi_source."');</script>";
				}
			?>
		<h1 align='center' style="background-color:#9e7400;color:#FFFFFe">DATA USER</h1>
		<h4 align='center' style="background-color:#dea300;color:#FFFFee">DIFAYA BEAUTY</h4>
		<br>		
		<table id="tabel2" align="center" width="100%" border="0" cellpadding="0" cellspacing="1">
			<tr>
				<td align="left"><button type="button" class="btn btn-secondary"><a href="utama" style="color:#FFFFFe"> Kembali ke Menu Utama </a></button></td>
				<td align="right"><button data-toggle="modal" data-target="#add-user" type="button" class="btn btn-danger"><a style="color:#FFFFFe"> + Tambah User </a></button></td>
			</tr>
		</table>
		<br>
		<table id="tabel1" class="table table-hover" border="1" cellpadding="0" cellspacing="1">
			<thead align="center">
				<tr align='center' style="background-color:#9e7400;color:#ffffff">
					<th>NO.</th>
					<th>USERNAME</th>
					<th>NAMA</th>
					<th>LEVEL</th>
					<th>PERSEN</th>
					<th>KETERANGAN</th>
					<th>AKSI</th>
				</tr>
			</thead>
			<?php 
				include 'koneksi.php';
				$no=1;
				$data = mysqli_query($koneksi,"select * from t_user WHERE AKTIF='YA' AND LEVEL<>'OWNER' order by ID asc");
				//while($d = mysqli_fetch_array($data)){
				while ($d = mysqli_fetch_assoc($data)){
						$userx = $d['USERNAME'];
						$nama_lengkap = $d['NAMA_LENGKAP'];
						$level = $d['LEVEL'];
						$keterangan = $d['KETERANGAN'];
						if($level=='MITRA'){							
							$persen = $d['PERSEN']."%";						
						}
						else{
							$persen = '-';
						}
					?>			
			<tr align="center">
				<td><?php echo $no++; ?></td>
				<td align="left"><?php echo $userx; ?></td>
				<td align="left"><?php echo $nama_lengkap; ?></td>
				<td align="center"><?php echo $level; ?></td>
				<td align="center"><?php echo $persen; ?></td>
				<td align="left"><?php echo $keterangan; ?></td>
				<td>			
					<a  href="#" type="button" data-toggle="modal" data-target="#editt<?php echo $userx; ?>"><img src="img/edit.png" class="img-responsive" height="100%" title="Edit User"></a> |						
					<a href='delete-user?id=<?php echo $userx; ?>' title="Hapus User" onclick="return confirm('Apakah yakin ingin menghapus?')"><img src="img/delete.png" height="100%" ></a>					
				</td>
			</tr>
			<div class="modal fade" id="editt<?php echo $d['USERNAME']; ?>" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h3>Edit Data User</h3>
						</div>
						<div class="modal-body">
							<form role="form" action="update-user" method="get" onsubmit="return cek_dulu();" autocomplete="off">
								<?php
									$query_edit = mysqli_query($koneksi,"SELECT * FROM t_user WHERE USERNAME='$userx'");		
										while($ded = mysqli_fetch_array($query_edit)){	
									?>		
								<div class="form-group">								
									<label>Username</label>										
									<input placeholder="Username" readonly="readonly" type="text" name="usernamede" value="<?php echo $ded['USERNAME']; ?>" id="usernamede" class="form-control form-control-sm">
								</div>
								<div class="form-group">
									<label>Full Name</label>
									<input placeholder="Full Name" type="text" name="full_namede" id="full_namede" autofocus value="<?php echo $ded['NAMA_LENGKAP']; ?>" class="form-control form-control-sm">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input placeholder="Password" type="password" name="passwordde" id="passwordde" value="<?php echo $ded['PASSWORD']; ?>"  class="form-control form-control-sm">
								</div>
								<div class="form-group">
									<label>Level</label>
									<select class="form-control form-control-sm" name="levelde" id="levelde">
										<option value="ADMIN" <?php if($ded['LEVEL']=="ADMIN") echo 'selected="selected"'; ?> >Admin</option>
										<option value="PETUGAS" <?php if($ded['LEVEL']=="MITRA") echo 'selected="selected"'; ?> >Mitra</option>
									</select>
								</div>               
								<?php
									}
									?>
								<div class="modal-footer">					
									<button hidden value="update" name="updatee" id="updatee" class="btn btn-primary">Update</button>
									<button type="submit"  class="btn btn-primary">Update</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php 
				}
				?>
		</table>
		
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
                     "lengthMenu": "Menampilkan _MENU_ Data User",
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
		<div id="add-user" class="modal fade" role="dialog">
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
								<select class="form-control form-control-sm" name="leveld" id="leveld" onchange="cek_level()">
									<option selected value="0">Pilih Level</option>
									<option value="ADMIN">Admin</option>
									<option value="MITRA">Mitra</option>
								</select>
								<label>Persen</label>
								<input value="0" readonly type="text" name="persend" onkeyup="inputTerbilang();" maxlength="2" id="persend" class="form-control form-control-sm mata-uang">
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
		<script type="text/javascript">
			$(document).ready(function(){
				$('#savee').on('click',function(){
					var username = $('#usernamed').val();
					var full_name = $('#full_named').val();
					var password = $('#passwordd').val();
					var persen = $('#persend').val();
					var level = $('#leveld').val();
					if (username==""){
						alert("Mohon isi Username");
						document.getElementById("usernamed").focus();
						return false;										
					}
					else if (full_name==""){
						alert("Mohon isi Nama Lengkap");
						document.getElementById("full_named").focus();
						return false;										
					}		
					else if (password==""){
						alert("Mohon isi Password");
						document.getElementById("passwordd").focus();
						return false;										
					}		
					else if (level=="0"){
						alert("Mohon pilih level");
						document.getElementById("leveld").focus();
						return false;										
					}
					else if (persen==""){						
						document.getElementById("persend").value = "0";		
						alert("Mohon isi persen (0 - 99)");
						document.getElementById("persend").focus();
						return false;										
					}
					else if (persen==" "){
						document.getElementById("persend").value = "0";		
						alert("Mohon isi persen (0 - 99)");
						document.getElementById("persend").focus();
						return false;										
					}
					else{
						$.ajax({
						  method: "POST",
						  url: "save-user.php",
						  data: { persen : persen,username : username,full_name : full_name,password : password,level : level,type:"insert"},	
						  success	: function(data){
										document.getElementById("input-user").reset();									
										//location.reload(true);											
									},
									error: function(response){
										console.log(response.responseText);
									}
						});	
						alert('saved data');            		         	
						location.reload(true);	
					}	
				});
			});
		</script>
		<script type="text/javascript">
			function cek_username(){        			   		   
				var username = $('#usernamed').val();
				//alert(a);   
				$.ajax({
					url: 'list-username.php',
					method: 'GET',
					data: { username : username},
					success	: function(data){
					//document.getElementById("myForm").reset();									
					var json = data,
					obj = JSON.parse(json);
					$('#usernamed2').val(obj.usernamee);	     
					var usn2 = $('#usernamed2').val(); 
					if (username == usn2){
						alert('Username sudah ada...');
						document.getElementById("usernamed").focus();    
						document.getElementById("usernamed").value = "";    
						document.getElementById("usernamed2").value = "Username sudah ada..."; 
					 }},
					error: function(response){
						console.log(response.responseText);
					}
				});	
			}			 
		</script>		
		<script type="text/javascript">
			function cek_level(){        			   		   
				var level = document.getElementById("leveld").value;
				if (level=='MITRA'){
					document.getElementById("persend").readOnly = false;
					document.getElementById("persend").focus();
				}
				else{
					document.getElementById("persend").readOnly = true;					
					document.getElementById("persend").value = "0";					
				}
			}			 
		</script>		
		<script type="text/javascript">
			$(document).ready(function(){
				$('#updatee').on('click',function(){
				//alert('kok diam?');
				var username = $('#usernamede').val();
				var full_name = $('#full_namede').val();
				var password = $('#passwordde').val();
				var level = $('#levelde').val();
				if (full_name==""){
					alert("Mohon isi Nama Lengkap");
					document.getElementById("full_namede").focus();
					return false;										
				}		
				else if (password==""){
					alert("Mohon isi Password");
					document.getElementById("passwordde").focus();
					return false;										
				}	
				else if (level=="0"){
					alert("Mohon pilih level");
					document.getElementById("levelde").focus();
					return false;										
				}								
				else{
					$.ajax({
					  method: "POST",
					  url: "update-user.php",
					  data: { username : username,full_name : full_name,password : password,phone : phone,level : level,type:"insert"},	
					  success	: function(data){
									document.getElementById("editus1").reset();									
									//location.reload(true);											
								},
								error: function(response){
									console.log(response.responseText);
								}
					});	
					alert('updated data');            		         	
					location.reload(true);	
				}
			  });
			});
		</script>	
	</body>	
		<script src="js/jquery.mask.min.js"></script>
         <script src="js/terbilang.js"></script>
		 <script>
            function inputTerbilang() {
              $('.mata-uang').mask('00', {reverse: true});
			   var persen = $("#persend").val();
				if (persen=="00"){
						$("#persend").val() = "0";
					}
				else if (persen==' '){
					$("#persend").val() = "0";
				}
				else if (persen==''){
					$("#persend").val()= "0";
				}					
            } 
         </script>		
</html>