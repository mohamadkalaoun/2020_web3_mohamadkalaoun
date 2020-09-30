<?php
$con = mysqli_connect("localhost","root","","bulbow") or die("Connection was not established");

    $function = $_POST['function'];
    
    $log = array();
    
switch($function) {
    
    case('report'):
        global $con ;
		$user_id = $_POST['u_id'];
		$update = "UPDATE users SET report=report + 1 WHERE user_id='$user_id'";
		$run = mysqli_query($con,$update);
		if ($run) {
			echo "done-1";
		}
		$reported = $_POST['reported'];
		$userown_id = $_POST['userown_id'];
		$rain="rain";
		if ($reported==$rain) {
			$array=array("$user_id");
			$is7ab=serialize($array);
		}
		else{
			$array=explode(",",$reported);
			array_push($array,"$user_id");
			$is7ab=serialize($array);
		}
		$sec_update = "UPDATE users SET reported='$is7ab' WHERE user_id='$userown_id'";
		$rum = mysqli_query($con,$sec_update);
		if ($rum) {
			echo "done-sec-update";
		}
		header("location: index.php");
   	    break;

   	case('unreport'):
        global $con ;
		$user_id = $_POST['u_id'];
		$update = "UPDATE users SET report=report - 1 WHERE user_id='$user_id'";
		$run = mysqli_query($con,$update);
		if ($run) {
			echo "done-1";
		}
		$reported = $_POST['reported'];
		$userown_id = $_POST['userown_id'];
		$array=explode(",",$reported);
		foreach( $array as $key => $value ){
   			 if ($value==$user_id) {
   			 	unset($array[$key]);
   			 }
			}
		$is7ab=serialize($array);
		
		$sec_update = "UPDATE users SET reported='$is7ab' WHERE user_id='$userown_id'";
		$rum = mysqli_query($con,$sec_update);
		if ($rum) {
			echo "done-sec-update";
		}

   	    break;
}	
?>
