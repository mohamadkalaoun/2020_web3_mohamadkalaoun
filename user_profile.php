<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");
?>
<?php

if(!isset($_SESSION['user_email'])){

	header("location: index.php");

}
else{ ?>
<html>
<head>
	<title>Welcomme to Home</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="style/2home_style2.css" media="all"/>
</head>
<style>
#own_posts{
    border: 5px solid #e6e6e6;
    padding: 40px 50px;
	width:90%;
}
#posts_img {
    height:300px;
   	width:100%;
}
</style>

<body>
<div class="row">
	<?php
	global $con;

			if(isset($_GET['u_id'])){
			$u_id = $_GET['u_id'];
			}
			if($u_id < 0 OR $u_id == ""){
				echo"<script>window.open('home.php','_self')</script>";
			}else{ //else hehe start

	?>



	<div class="col-sm-12">
		<?php
			if(isset($_GET['u_id'])){

			global $con;

			$user_id = $_GET['u_id'];

			$select = "select * from users where user_id='$user_id'";
			$run = mysqli_query($con,$select);
			$row=mysqli_fetch_array($run);

			$name = $row['user_name'];
			}

		?>


		<?php

		if(isset($_GET['u_id'])){

				global $con;

				$user_id = $_GET['u_id'];

				$select = "select * from users where user_id='$user_id'";
				$run = mysqli_query($con,$select);
				$row=mysqli_fetch_array($run);

				$id = $row['user_id'];
				$image = $row['user_image'];
				$name = $row['user_name'];
				$f_name = $row['f_name'];
				$l_name = $row['l_name'];
				$describe_user = $row['describe_user'];
				// gender and coundry maybe done later
				$gender = "coming soon";
				$user_country = "coming soon" ;
				$register_date = $row['user_reg_date'];
				$report = $row['report'];
				if(is_null($report)){
					$report=0;
				}

					$user = $_SESSION['user_email'];
					$get_user = "select * from users where user_email='$user'";
					$run_user = mysqli_query($con,$get_user);
					$row=mysqli_fetch_array($run_user);

					$userown_id = $row['user_id'];
					$user_name = $row['user_name'];
					$user_image = $row['user_image'];
					$reported = $row['reported'];

					if(is_null($reported)){
						$reported="rain";
						$im=0;
					}
					else{
						$im=0;	
						$array=unserialize($reported);
						$reported=implode(',', $array);
						foreach( $array as $key => $value ){
    						if ($value==$u_id) {
    							$im+=1;
    						}
						}
					}
					if($user_id == $userown_id){
						echo"<a href='edit_profile.php?u_id=$userown_id' class='btn btn-success'/>Edit Profile</a><br><br><br>";
					}

					echo"
					</div>
					</center>
					";
				echo "
				<div class='row'>
					<div class='col-sm-1'>
					</div>
					<center>
					<div style='background-color: #e6e6e6;' class='col-sm-3'>
					<h2>Information about</h2>
					<img class='img-circle' src='users/$image' width='150' height='150' />
					<br><br>
					<ul class='list-group'>
					  <li class='list-group-item' title='Username'><strong>$f_name $l_name</strong></li>
					  <li class='list-group-item' title='User Status'><strong style='color:grey;'>$describe_user</strong></li>
					  <li class='list-group-item' title='Gender'>$gender</li>
					  <li class='list-group-item' title='Country'>$user_country</li>
					  <li class='list-group-item' title='User Registration Date'>$register_date</li><br>
					  <form method='post'>
        				<input id='leave' type='submit' name='atr1' value='Message'>
        			  </form><br>
					  <li class='list-group-item list-group-item-warning' title='Reported'>Reported $report times</li>";
					 if ($im==0) {
					 	echo " <button id='jreport' type='button' class='btn btn-danger'>Report User</button></ul>";
					 }
					 else if ($im>0) {
					 	echo " <button id='ureport' type='button' class='btn btn-secondary'>Unreport User</button></ul>";
					 }
					 

				}
			?>
	<div class='col-sm-8'>
		<center><h1><strong><?php echo "$f_name $l_name"; ?></strong> Posts</h1></center>
			<?php
				global $con;

				if(isset($_GET['u_id'])){
				$u_id = $_GET['u_id'];
				}
				$get_posts = "select * from ideas where user_id='$u_id' ORDER by 1 DESC LIMIT 5";

				$run_posts = mysqli_query($con,$get_posts);

				while($row_posts=mysqli_fetch_array($run_posts)){

				$post_id = $row_posts['post_id'];
				$user_id = $row_posts['user_id'];
				$title_idea = $row_posts['title_idea'];
				$content = $row_posts['desc_idea'];
				$upload_image = $row_posts['upload_image'];
				$post_date = $row_posts['post_date'];

				//getting the user who has posted the thread

				$user = "select * from users where user_id='$user_id' AND posts='yes'";

				$run_user = mysqli_query($con,$user);
				$row_user=mysqli_fetch_array($run_user);

				$user_name = $row_user['user_name'];
				$f_name = $row['f_name'];
				$l_name = $row['l_name'];
				$user_image = $row_user['user_image'];


				//now displaying all at once
             if(strlen($content) >= 1 && strlen($upload_image) >= 1 && strlen($title_idea) >= 1){
				echo "
				<div id='own_posts'>
					<div class='row'>
						<div class='col-sm-2'>
							<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
							<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>

						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
						    <h3>$title_idea</h3> <br>
							<p>$content</p>
							<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
				</div><br/><br/>";
				}			
		}
		?>
		</div>
	</div>
</div>
<?php }  ?>
<script>
$(document).ready(function(){
		var u_id = "<?php echo $u_id ?>";
    	var reported = "<?php echo"$reported"; ?>";
    	//var reported = res.replace(/\"/g, "\'");
    	var userown_id = "<?php echo $userown_id ?>";
    $("#jreport").click(function(){
         $.ajax({
           type: "POST",
           url: "report.php",
           data: {  
              'function': 'report',
              'u_id': u_id,
              'reported': reported,
              'userown_id': userown_id,
              },
           dataType: "json",

           success: function(data){
           	<?php // echo "header('location: user_profile.php?u_id=$user_id');"; ?>
           	console.log("mshe l 7al");
           	history.go(0);
           },
        }); 
    });
    $("#ureport").click(function(){
         $.ajax({
           type: "POST",
           url: "report.php",
           data: {  
              'function': 'unreport',
              'u_id': u_id,
              'reported': reported,
              'userown_id': userown_id,
              },
           dataType: "json",

           success: function(data){
           	<?php // echo "header('location: user_profile.php?u_id=$user_id');"; ?>
           	console.log("mshe l 7al");
           	window.location.reload();
           },
        }); 
    });
 });
</script>
<?php
	if(isset($_POST['atr1'])) {
    		header("Location: messages.php?u_id=$user_id"); 
    	}    	
?>
</body>
</html>
<?php } ?>

