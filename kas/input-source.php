<?php
   include 'koneksi.php';
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Tambah Source - DIFAYA BEAUTY | Effortless Care For Priceless You</title>
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
      <script type="text/javascript">
         $(document).ready(function(){
         	$('#input_source').on('click',function(){
         	var nama_s = $('#nama_source').val();
         	var keter = $('#keterangan').val();
			 if(nama_s==''){
				 alert("Isi Nama Source terlebih dahulu");
				 document.getElementById("nama_source").focus();
				 return false; 
			 }
			 else if(keter==0){
				 alert("Isi Keterangan terlebih dahulu");
				 document.getElementById("keterangan").focus();
				 return false; 
			 }
			 else{
					$.ajax({
					  method: "POST",
					  url: "save-source.php",
					  data: { nama_s : nama_s,keter : keter,type:"insert"},					  
					  success	: function(data){
									document.getElementById("myForm").reset();									
								},
								error: function(response){
									console.log(response.responseText);
								}
					});	
				 alert('Data source tersimpan...');
				 location.reload(true);				 
			 }         
			});         
         });
      </script>
	  <script type="text/javascript">
		 function cek_source(){			   				
				var nama_source = $("#nama_source").val();
				if (nama_source == ""){
				}
				else{
					$.ajax({
						url: 'list-source.php',
						type: 'get',
						data     : 'nama_sourceee='+nama_source,
						success: function (data) {
							 var json = data,
							 obj = JSON.parse(json);
							 $('#nama_source2').val(obj.nama_sourcee);		
							 var namsour2 = $('#nama_source2').val();
							 var namsour1 = $('#nama_source').val();
							 var isi = 'Nama source *'+namsour1+'* sudah ada';
							if (namsour1 == namsour2){
								alert(isi);					
								document.getElementById("nama_source").focus();	
								document.getElementById("nama_source").value = ""; 
								document.getElementById("nama_source2").value = "...."; 
							}
						}
					});
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
         else if($_SESSION['level']!="OWNER"){
         	echo "<script>alert('Anda tidak memiliki akses.....');window.location.href='javascript:history.go(-1)';</script>";                    
         }
         ?>
      <h1 align='center' style="background-color:#9e7400;color:#FFFFFe">TAMBAH SOURCE</h1>
      <h4 align='center' style="background-color:#dea300;color:#FFFFee">DIFAYA BEAUTY</h4>
      <br>  
      <button type="button" class="btn btn-secondary"><a href="utama" style="color:#FFFFFe"> Kembali ke Menu Utama </a></button><br>
      <br>
      <div class='container'>
         <form method="post" id="myForm">
            <div class="table-responsive">
               <table width="30%" class="table" border="0" cellpadding="2" cellspacing="2" align=center>
                  <div class="form-group">
                     <tr>
                        <th>Nama Source</th>
                        <th><input class="form-control form-control-sm" placeholder="Nama Source" maxlength="30" type="text" name="nama_source" id="nama_source" autofocus onchange="cek_source()"><input hidden class="form-control form-control-sm" placeholder="Nama Source" maxlength="30" type="text" name="nama_source2" id="nama_source2"></th>
                     </tr>
                     <tr>
                        <th>Keterangan</th>
                        <th><input class="form-control form-control-sm" placeholder="Keterangan" maxlength="50" type="text" name="keterangan" id="keterangan"></th>
                     </tr>
                     <tr align='center'>
                        <br>
                        <td><button value="simpan" name="input_source" id="input_source" class="btn btn-danger btn-lg btn-block">Simpan</button></td>
                        <td><button onclick="autofocuss()" type="reset" class="btn btn-secondary disabled btn-lg btn-block">Batal</button></td>
                     </tr>
                  </div>
               </table>
            </div>
         </form>
      </div>
      <table id="tabel1" class="table table-hover" border="1" cellpadding="0" cellspacing="1">
         <thead align="center">
            <tr align='center' style="background-color:#9e7400;color:#ffffff">
               <th>NO.</th>
               <th>NAMA SOURCE</th>
               <th>KETERANGAN</th>
               <th>WAKTU INPUT</th>
            </tr>
         </thead>
         <?php 
            include 'koneksi.php';
             function formatTanggal($date){
                            // ubah string menjadi format tanggal
                            return date('d-M-Y', strtotime($date));
                           }	
            $no=1;
            $data = mysqli_query($koneksi,"select * from t_source order by ID DESC");				
            while ($d = mysqli_fetch_assoc($data)){
            		$nama_source = $d['NAMA_SOURCE'];
            		$ketr = $d['PENJELASAN'];
            		$tgl = formatTanggal($d['TGL']);  
					$waktu = substr($d['WAKTU'],10,30);
            		$hari = date('l', strtotime($d['TGL']));
            		$semua = $hari.", ".$tgl." -".$waktu;
            	?>			
         <tr align="center">
            <td><?php echo $no++; ?></td>
            <td align="left"><?php echo $nama_source; ?></td>
            <td align="left"><?php echo $ketr; ?></td>
            <td align="left"><?php echo $semua; ?></td>
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
                     "lengthMenu": "Menampilkan _MENU_ Data Source",
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