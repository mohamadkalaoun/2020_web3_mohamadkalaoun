<?php 
$con = mysqli_connect("localhost","root","","bulbow") or die("Connection was not established");

function getuserid(){
//session_start();
global $con;
if(!isset($_SESSION['user_email'])){
 	header("location: main.php");		
}
else{
		$user_com = $_SESSION['user_email']; 
		$get_com = "select * from users where user_email='$user_com'";
		$run_com = mysqli_query($con,$get_com);
		$row_com=mysqli_fetch_array($run_com);

		$user_com_id = $row_com['user_id']; // C'EST L'ID DU COURANT UTILISATEURE
		//$user_com_name = $row_com['user_name'];
		return $user_com_id ;
	}
}


function getownerid($idea_id){
global $con;
$get_posts = "select * from ideas where post_id='$idea_id'";

$run_posts = mysqli_query($con,$get_posts);
$row_posts=mysqli_fetch_array($run_posts);

//$post_id = $row_posts['post_id'];
$owner_id = $row_posts['user_id'];

return $owner_id ;
}

function getusername($id){
global $con;
$jib ="select * from users where user_id='$id'";
$run = mysqli_query($con,$jib);
$row=mysqli_fetch_array($run);
$user_name = $row['user_name'];
return $user_name ;
}
?>