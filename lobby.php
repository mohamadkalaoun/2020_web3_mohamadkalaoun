<!doctype html>
<?php
$con = mysqli_connect("localhost","root","","bulbow") or die("Connection was not established");
session_start();
include("utype.php");

$get_id = $_GET['post_id'];
$curr_user_id = getuserid();
$user_id = getownerid($get_id);
$select="SELECT size_part , counter_part , group_pass FROM ideas WHERE post_id='$get_id'";
$run = mysqli_query($con,$select);
$row=mysqli_fetch_array($run);
$size_part = $row['size_part'];
$counter_part = $row['counter_part'];
$group_pass = $row['group_pass'];
$dg=0;
if (is_null($group_pass) || empty($group_pass)) {
  $dg+=1;
}
$part_array=unserialize($counter_part);
$counter=sizeof($part_array);
$im=0;
$tm=0;
foreach( $part_array as $key => $value ){
         if ($value==$curr_user_id) {
          $im+=1;
         } }
if ($im==0 && $counter<$size_part) {
    array_push($part_array,"$curr_user_id");
    $tm+=1;
    $new_arr=serialize($part_array);
    $update="UPDATE ideas SET counter_part='$new_arr' WHERE post_id='$get_id'";
    $rum = mysqli_query($con,$update);
  }
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="style/lobby.css">
<!--<script type="text/javascript">document.body.style.zoom="60%"</script>-->
<title>idea_lobby</title>
</head>
<body>
<div class="container-fluid">
  <div class="row justify-content-around">
  	<div class="col-lg-12">
  		<a class="btn btn-secondary" href="home.php">Return to home page</a>
  	</div>
  	<div class="col-lg-4" id="zoom">
      	<?php echo"<a href='index01.php?post_id=$get_id'><img src='images/globalchat.png' width='500' height='480' alt=''/></a>"?>
    </div>
<?php
if (($im>0 || $tm==1) && $dg==1){
      echo"<div class='col-lg-4' id='zoom'> 
           <a href='brains.php?post_id=$get_id'><img src='images/brainS.png' width='500' height='480' alt=''/></a> 
         </div>"; 
 }
elseif (($im>0 || $tm==1) && $dg==0) {
  //hit the password to enter
  echo"<div class='col-lg-4' id='zoom'> 
           <a href='pass_verify.php?post_id=$get_id'><img src='images/locked.png' width='500' height='480' alt=''/></a> 
         </div>"; 
}
else{
  echo "<div class='col-lg-4'><p>This Idea is now full : 50/50 participaters!!</p></div>";
}
?>
	<div class="col-lg-4" id="zoom">
    	<?php echo"<a href='summary.php?post_id=$get_id'><img src='images/summary.png' width='500' height='480' alt='summary'/></a>";?>
    </div>
  </div>
</div>
<?php
if($curr_user_id== $user_id) {
		 echo"welcome to your idea";
		 return true ;
		}
else{
			echo"feel free to participate";
			return false ;
		}
?>

</div>
</body>
</html>
