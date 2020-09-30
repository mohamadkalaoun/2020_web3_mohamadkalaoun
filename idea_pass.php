<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
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
//$curr_user_id = getuserid();
//$user_id = getownerid($get_id);
$select="SELECT group_pass , size_part FROM ideas WHERE post_id='$get_id'";
$run = mysqli_query($con,$select);
$row=mysqli_fetch_array($run);
$group_pass = $row['group_pass'];
$size_part = $row['size_part'];
if (is_null($group_pass)) {
	$group_pass="Password Not Set";
}
?>
<body>
<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8">
		<form action="" method="post" enctype="multipart/form-data">
					<table class="table table-bordered table-hover">
						<tr align="center">
							<td colspan="6" class="active"><h2>Set / Change The Password</h2></td>
						</tr>
						<tr>
							<td style="font-weight: bold;">Password</td>
							<td>
							<input class="form-control" type="password" name="u_pass" id="mypass" value="<?php echo $group_pass;?>"/><!-- onfocus="this.value=''" -->
							<input type="checkbox" onclick="show_password()"> <strong>Show Password</strong>
							</td>
						</tr>
						<tr>
							<td style="font-weight: bold;">Confirm Password</td>
							<td><input class="form-control" type="password" name="c_pass"/></td>
						</tr>
						<tr>
							<td colspan="6">
								<select class="browser-default custom-select" name="cooldown">
								  <option selected>Choose Cooldown Speed</option>
								  <option value="one">5 seconds</option>
								  <option value="two">30 seconds</option>
								  <option value="tea">1 min</option>
								</select>
							</td>
						</tr>
						<tr>
							<td style="font-weight: bold;">Change Participaters Size</td>
							<td><input class="form-control" type="number" name="size" value="<?php echo $size_part;?>"/></td>
						</tr>
						<tr align="center">
							<td colspan="6">
							<input class="btn btn-info" style="width: 250px;" type="submit" name="update" value="Update"/>
							</td>
						</tr>
						<tr align="center">
							<td colspan="6"><a href="<?php echo"summary.php?post_id=$get_id";?>" class="btn btn-warning">Back</a></td>
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
		$c_pass = htmlentities($_POST['c_pass']);
		$selected_val = $_POST['cooldown'];
		$size_part = $_POST['size'];
		if (is_null($size_part) || empty($size_part)) {
			echo "<script>alert('Size Part cannot be Empty')</script>";
		}
		else{$cools="UPDATE ideas SET size_part='$size_part' WHERE post_id='$get_id'";
			$dum = mysqli_query($con,$cools);}
		if ($selected_val=="one" || $selected_val=="two" || $selected_val=="tea") {
			$cool="UPDATE ideas SET cooldown='$selected_val' WHERE post_id='$get_id'";
			$dun = mysqli_query($con,$cool);
		}
		if ($u_pass==$c_pass) {
			$update="UPDATE ideas SET group_pass='$c_pass' WHERE post_id='$get_id'";
			$run = mysqli_query($con,$update); 
			if($run){	
				echo "DONE";
				echo "<script>window.open('home.php','_self')</script>";
			}
		}
		else{echo "<script>alert('Wrong Combination!')</script>";}	
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