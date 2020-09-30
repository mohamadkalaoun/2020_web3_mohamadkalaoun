<?php
$con = mysqli_connect("localhost","root","","bulbow") or die("Connection was not established");
session_start();
include("utype.php");

$get_id = $_GET['post_id'];
$curr_user_id = getuserid();
$user_id = getownerid($get_id);
$select="SELECT size_part , counter_part , banned FROM ideas WHERE post_id='$get_id'";
$run = mysqli_query($con,$select);
$row=mysqli_fetch_array($run);
$size_part = $row['size_part'];
$counter_part = $row['counter_part'];
$banned = $row['banned'];
$lm=0;
if (is_null($banned)) {
	$lm+=1;
}
$part_array=unserialize($counter_part);
$counter=sizeof($part_array);
function get_participaters(){
	global $con;
	global $part_array;
	foreach ($part_array as $key => $value) {
		$selecter="SELECT * FROM users WHERE user_id='$value'";
		$ban = mysqli_query($con,$selecter);
		$raw=mysqli_fetch_array($ban);
		$this_user=$raw['user_id'];
		$username = $raw['user_name'];
		$userimage = $raw['user_image'];
        $report = $raw['report'];
	echo"
	<table class='raja' onclick=\"document.location.href='user_profile.php?u_id=$this_user';\">
		<tr>
			<td><h4>$username</h4></td>
			<td><img src='users/$userimage' width='100px' height='100px'></td>
            <td id='rush'><span id='spain'>Reported $report Times</span></td>
		</tr>
	</table><br>";
	}
}
function get_participaters_admin(){
	global $con;
	global $get_id;
	global $part_array;
	global $lm;
	global $banned;

	foreach ($part_array as $key => $value) {
		$selecter="SELECT * FROM users WHERE user_id='$value'";
		$ban = mysqli_query($con,$selecter);
		$raw=mysqli_fetch_array($ban);
		$this_user=$raw['user_id'];
		$username = $raw['user_name'];
		$userimage = $raw['user_image'];
        $report = $raw['report'];
		$str1="kick$this_user";
		$str2="ban$this_user";
		$str3="unban$this_user";
	echo"
	<table class='raja' onclick=\"document.location.href='user_profile.php?u_id=$this_user';\">
		<tr>
			<td><h4>$username</h4></td>
			<td><img src='users/$userimage' width='100px' height='100px'></td>
            <td id='rush'><span id='spain'>Reported $report Times</span></td>
		</tr>
	</table>
	<form method='post'>
        <input id='leave' type='submit' name='$str1' value='Kick Out'>
        <input id='leave' type='submit' name='$str2' value='Type Ban'>
        <input id='leave' type='submit' name='$str3' value='Type Unban'>
    </form>
	<br>";
	if(isset($_POST[$str1])) {
        foreach ($part_array as $key => $value) {
        	if ($value==$this_user) {
        		unset($part_array[$key]);
        	}
        }
        $new_arr=serialize($part_array);
        $update="UPDATE ideas SET counter_part='$new_arr' WHERE post_id='$get_id'";
    	$rum = mysqli_query($con,$update);
    	if ($rum) {
    		header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); 
    	}    	
    }
    if(isset($_POST[$str2])) {
      if ($lm==0) {
    		$pm=0;
    		$party_array=explode(",", $banned);
    		foreach ($party_array as $key => $value) {
        		if ($value==$this_user) {
        			$pm+=1;
        		} }
    		if ($pm==0) {
    		$news_arr="$banned$this_user,";
        	$updates="UPDATE ideas SET banned='$news_arr' WHERE post_id='$get_id'";
    		$rug = mysqli_query($con,$updates);
    		if ($rug) {
    			header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); 
    			}    	
    		}
    		else{echo "<script>alert('this user is already banned!')</script>";}    	
      }
      else{
      	$array="$this_user,";
      	//$new_arr=serialize($array);
        $update="UPDATE ideas SET banned='$array' WHERE post_id='$get_id'";
    	$rug = mysqli_query($con,$update);
    	if ($rug) {
    		header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); 
    	}   
      }
	}
	if(isset($_POST[$str3])) {
      if ($lm==1) {
		echo "<script>alert('this user is not banned! so you mn fo2 ya rjel cannot Unban him!!')</script>";   	
      }
      else if ($lm==0) {
      	$pj=0;
    	$party=explode(",", $banned);
    		foreach ($party as $key => $value) {
        		if ($value==$this_user) {
        			$pj+=1;
        			unset($party[$key]);
        		} }
        	if ($pj>0) {
        		$new=implode(",", $party);
        		$update="UPDATE ideas SET banned='$new' WHERE post_id='$get_id'";
    			$rum = mysqli_query($con,$update);
    			if ($rum) {
    				header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); 
    			}   
        	}
        	elseif ($pj==0) {
        	 	echo "<script>alert('this user is not banned! so you cannot Unban him!!')</script>";
        	 } 
      }
    }
  }// lal for each kbire
}//lal function
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style/participaters.css">
	<title>Participaters</title>
</head>
<body>
    <br>
<table class="bada">
<tr>
    <td><a href="<?php echo"summary.php?post_id=$get_id";?>">Return To Summary</a></td>
    <td><a href="<?php echo"lobby.php?post_id=$get_id";?>">Return To Lobby</a></td>
</tr>
</table><br>
	<?php 
	if ($curr_user_id==$user_id) {
		get_participaters_admin();
	}
	else{get_participaters();}
	?>
</body>
</html>