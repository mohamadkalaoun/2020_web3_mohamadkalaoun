<?php 
include("login.php");
      
if(isset($_COOKIE["email"])) {
         $encryption=$_COOKIE["email"]; 

         $decryption1 = udecrypt($encryption);
       }

       if(isset($_COOKIE["password"])) {
         $encryption2=$_COOKIE["password"]; 

         $decryption2 = udecrypt($encryption2);
       } ?>
<!DOCTYPE html>
<html>
<head>
	<title>SignIn</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="jquery.js"></script>
</head>
<style>
	body{
		overflow-x: hidden;
	}
	.main-content {
	  width: 85%;
	  height: 40%;
	  margin: 10px auto;
	  background-color: #fff;
	  border: 2px solid #e6e6e6;
	  padding: 40px 50px;
	}
	.header {
	  border: 0px solid #000;
	  margin-bottom: 5px;
	}
	.well{
		background-color: #187FAB;
	}
	#signin{
		width: 60%;
		border-radius: 30px;
	}
	.overlap-text {
	  position: relative;
	}

	.overlap-text a {
	  position: absolute;
	  top: 8px;
	  right: 10px;
	  font-size: 14px;
	  text-decoration: none;
	  font-family: 'Overpass Mono', monospace;
	  letter-spacing: -1px;
	}
</style>
<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="well">
				<center><h1 style="color: white;"><strong>BulBow</strong></h1></center>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="main-content">
		        <div class="header">
		          <h3 style="text-align: center;"><strong>let's participate</strong></h3><hr>
		        </div>
		        <div class="l-part">
		          <form  action="" method="post">
		          	<input type="email" placeholder="Email" name="email" required class="form-control input-md" value="<?php if(isset($_COOKIE["email"])) { echo "$decryption1";}?>" /><br>
		          	<div class="overlap-text">
						<input type="password" placeholder="Password" name="pass" required class="form-control input-md" value="<?php if(isset($_COOKIE["password"])) { echo "$decryption2";}?>" /><br>
						<p><input type="checkbox" name="remember" /> Remember me
			            <a style="text-decoration:none; color:#187FAB;" data-toggle="tooltip" title="Reset Password"  href="forgot_password.php">Forgot?</a>
		       		</div>
		       		<a style="text-decoration:none;float: right; color:#187FAB;" data-toggle="tooltip" title="Create Account!" href="signup.php">Don't have an account?</a><br><br>
		            <center><button id="signin" class="btn btn-info btn-lg" name="login">Login</button></center>
		            <?php // include("login.php"); ?>
		          </form>
		        </div>
	      </div>
		</div>
	</div>
</body>
</html>
