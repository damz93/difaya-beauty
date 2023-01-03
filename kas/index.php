<html>
   <head>
    <title>Halaman Login - DIFAYA BEAUTY | Effortless Care For Priceless You</title>
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
         background-image: url("img/bgo.png");
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
		.header {
		  padding: 10px;
		  text-align: center;
		  background: #ffedbb;		
		  height: 28%;
		  color:#FFFFFe;
		}
	</style>
	<script> 
			$(function(){
			  $("#header").load("head.html"); 
			  $("#footer").load("footer.html"); 
			});
	</script> 
	<style>
	.responsive {
	  width: 100%;
	  max-width: 420px;
	  height: auto;
	}
	</style>
   </head>
   <body>   
      <div class="bg">                
         <br><br><br><br>
         <div id="login">
            <div class="container">
               <div id="login-row" class="row justify-content-center align-items-center">
                  <div id="login-column" class="col-md-6">
                     <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="cek-login" autocomplete="off" method="post">
                           <div class="table-responsive">
                              <div class="form-group">
                                 <div class="container">
                                    <table border="0" width="30%" height="80%" style="background-color:#ffedbb;" class="table" align=center>
                                       <tr>
                                          <td>
                                             <div class="form-group">
                                                <div>
													<img src="img/logo_t2.png" class="responsive" style="display: block; margin: auto;">		<br>
                                                   <!--<h5 align="center" valign="middle" style="color:#653a3a;background-color:#f4f4f4;">L O G I N</h5>-->
                                                </div>
                                                <div class="form-floating mb-3">
                                                   <p><input type="text" name="username" id="username"  class="form-control form-control-sm" placeholder="Username" autofocus>	</p>
                                                   <p><input type="password" name="password" id="password"  class="form-control form-control-sm" placeholder="Password"></p>
                                                   <p>
                                                      <select class="form-control form-control-sm"  name="level">
                                                         <option selected>Choose Level</option>
                                                         <option value="ADMIN">Admin</option>
														 <option value="MITRA">Mitra</option>		
                                                         <option value="OWNER">Owner</option>
                                                      </select>
                                                   </p>
                                                   <!--     <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>-->
												   
													<input type="submit" name="submit" class="btn btn-danger btn-block" value="Login">
												   
                                                   <button hidden type="reset" onclick="focuss()" class="btn btn-secondary btn-block">Cancel</button>
                                                </div>
                                          </td>
                                       </tr>
                                       </div>															
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script>
         function focuss() {
         	document.getElementById("username").focus();
         }
          
      </script>
   </body>
</html>