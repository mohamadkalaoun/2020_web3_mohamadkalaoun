<?php
$con = mysqli_connect("localhost","root","","bulbow") or die("Connection was not established");
session_start();
include("utype.php");

$get_id = $_GET['post_id'];
$curr_user_id = getuserid();
$user_id = getownerid($get_id);
$select="SELECT size_part , counter_part FROM ideas WHERE post_id='$get_id'";
$run = mysqli_query($con,$select);
$row=mysqli_fetch_array($run);
$size_part = $row['size_part'];
$counter_part = $row['counter_part'];
$part_array=unserialize($counter_part);
$counter=sizeof($part_array);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Summary</title>
</head>
<body>
<div class="container-fluid">
        <br>
        <ul class="list-group">
        	<a class="btn btn-secondary" href="<?php echo"lobby.php?post_id=$get_id";?>">Return To Lobby</a><br>
            <a href="<?php echo"particpaters.php?post_id=$get_id";?>"><li class="list-group-item d-flex justify-content-between align-items-center">
                Participaters
                <span class="badge badge-primary badge-pill"><?php echo "$counter"; ?></span>
            </li></a>
            <?php 
            if ($curr_user_id==$user_id) {
            	echo "
            	<a href='idea_pass.php?post_id=$get_id'><li class='list-group-item d-flex justify-content-between align-items-center'>Brain Storming Configuration</li></a>
            	";
            }
            ?>
            <a href="<?php echo"idea_info.php?post_id=$get_id";?>" class="list-group-item list-group-item-action list-group-item-info">General Info And Statistics</a><br>
            <form method="post">
            	<input id="leave" class="btn btn-danger" type="submit" name="leave" value="Leave Idea">
        	</form>
        </ul>

</div>
</body>
<?php
    if(isset($_POST['leave'])) {
        foreach ($part_array as $key => $value) {
        	if ($value==$curr_user_id) {
        		unset($part_array[$key]);
        	}
        }
        $new_arr=serialize($part_array);
        $update="UPDATE ideas SET counter_part='$new_arr' WHERE post_id='$get_id'";
    	$rum = mysqli_query($con,$update);
    	if ($rum) {
    		header("Location: home.php");
    	}    	
    }
?>
</html>