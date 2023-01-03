<?php
   include('koneksi.php');
   session_start();   
   $user_check = $_SESSION['login'];
   $ses_sql = mysqli_query($koneksi,"select USERNAME,LEVEL from tbl_user where USERNAME = '$user_check'");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $login_session = $row['USERNAME'];  
   if(!isset($_SESSION['login'])){
      header("location:index.php");
      die();
   }
?>