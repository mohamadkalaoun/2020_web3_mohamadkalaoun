<!DOCTYPE html>
<html>
<head>
	<title>Password</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/2home_style2.css" media="all"/>
</head>
<style>

</style>
<?php
$con = mysqli_connect("localhost","root","","bulbow") or die("Connection was not established");
session_start();
$get_id = $_GET['post_id'];
$select="SELECT group_pass FROM ideas WHERE post_id='$get_id'";
$run = mysqli_query($con,$select);
$row=mysqli_fetch_array($run);
$group_pass = $row['group_pass'];
?>
<body>
<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8">
		<form action="" method="post" enctype="multipart/form-data">
					<table class="table table-bordered table-hover">
						<tr align="center">
							<td colspan="6" class="active"><h2>Type the correct password so that you can access the group</h2></td>
						</tr>
						<tr>
							<td style="font-weight: bold;">Password</td>
							<td>
							<input class="form-control" type="password" name="u_pass" id="mypass"/><!-- onfocus="this.value=''" -->
							<input type="checkbox" onclick="show_password()"> <strong>Show Password</strong>
							</td>
						</tr>
						<tr align="center">
							<td colspan="6">
							<input class="btn btn-info" style="width: 250px;" type="submit" name="update" value="Join"/>
							</td>
						</tr>
						<tr align="center">
							<td colspan="6"><a href="<?php echo"lobby.php?post_id=$get_id";?>" class="btn btn-warning">Back</a></td>
						</tr>
					</table>
				</form>
	</div>
	<div class="col-sm-2">
	</div>
</div>
</body>
</html>
					
<?php 
	if(isset($_POST['update'])){
	
		$u_pass = htmlentities($_POST['u_pass']);
		
		if ($u_pass==$group_pass) {
			header("Location: brains.php?post_id=$get_id");
		}
		else{echo "<script>alert('Wrong Password!')</script>";}	
	}
?>
<script>
function show_password() {
    var x = document.getElementById("mypass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>