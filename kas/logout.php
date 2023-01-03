<?php
   session_start();
   if(session_destroy()) {
	  echo "<script>alert('Berhasil Logout...');</script>";
      header("Location:index.php?pesan=logout");	  
   }
?>