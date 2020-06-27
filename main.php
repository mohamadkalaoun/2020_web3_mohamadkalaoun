<!DOCTYPE html>
<html>
<head>
	<title>BulBow Login And Sign Up</title>
	<meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="viewport" content="width=520, target-densitydpi=high-dpi" />
    <meta http-equiv="Content-Type" content="application/vnd.wap.xhtml+xml; charset=utf-8" />
    <meta name="HandheldFriendly" content="true" />
    <meta name="apple-mobile-web-app-capable" content="yes" /> 

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
/*
    body, html{
	  overflow:hidden; 
    }
	body{
		overflow-x: hidden;
	}*/
	#signup{
		width: 60%;
		border-radius: 30px;
	}
	#login{
		width: 60%;
		background-color: #fff;
		border: 1px solid #1da1f2;
		color: #1da1f2;
		border-radius: 30px;
	}
	#login:hover{
		width: 60%;
		background-color: #fff;
		color: #1da1f2;
		border: 2px solid #1da1f2;
		border-radius: 30px;
	}
	.well{
		background-color:#2272e3 ;
		width: 694px ;
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
			<div class="col-sm-6" style="left:0.5%;">
				<img src="images/bulbow.png" class="img-rounded" title="BulBow" width="650vw" height="565vw">
			</div>
			<div class="col-sm-6" style="left: 8%;">
				
				<img src="images/logo.png" class="img-rounded" title="BulBow" width="80px" height="80px">
				<h2><strong>Create and help <br> the world Newest ideas</strong></h2><br><br>
				<h4><strong>Join BulBow Today.</strong></h4>
				<form method="post" action="">
					<button id="signup" class="btn btn-info btn-lg" name="signup">Sign up</button><br><br>
					<?php
						if(isset($_POST['signup'])){
							echo"<script>window.open('signup.php','_self')</script>";
						}
					?>
					<button id="login" class="btn btn-primary btn-lg" name="login">Login</button>
					<?php
						if(isset($_POST['login'])){
							echo"<script>window.open('signin.php','_self')</script>";
						}
					?>
				</form>
			</div>
		</div>
</body>
</html>