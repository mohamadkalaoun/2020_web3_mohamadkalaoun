<?php

$con = mysqli_connect("localhost","root","","bulbow") or die("Connection was not established");

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
////                                                                                                      ////
////                               function to insert an idea                                            ////
////                                                                                                      ////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		function insertPost(){

			if(isset($_POST['sub'])){
			global $con;
			global $user_id;
			//echo "$user_id";
			$title_idea = htmlentities($_POST['title_idea']);
			$content = htmlentities($_POST['content']);
			$upload_image = $_FILES['upload_image']['name'];
            $image_tmp = $_FILES['upload_image']['tmp_name'];
            $random_number = rand(1,100);
            

            if(strlen($content) > 250){
            	echo "<script>alert('Please Use 250 or less than 250 words')</script>";
            	echo"<script>window.open('home.php','_self')</script>";
            }
            else if(strlen($upload_image) >= 1 && strlen($content) >= 1 && strlen($title_idea) >= 1){
            	move_uploaded_file($image_tmp,"imagepost/$upload_image.$random_number");
         		$counter_part=array("$user_id");
         		$counter_part2=serialize($counter_part);
	              $insert1 = "insert into ideas (user_id,title_idea,desc_idea,upload_image,post_date,size_part,group_pass,cooldown,counter_part) values ('$user_id','$title_idea','$content','$upload_image.$random_number',NOW(),'50','','','$counter_part2')";
	              //echo "$insert1";
	              $run = mysqli_query($con,$insert1);
					if($run){
						echo"DONE";
					
					echo"<script>window.open('home.php','_self')</script>";

					$update = "update users set posts='yes' where user_id='$user_id'";
					$run_update = mysqli_query($con,$update);
					}
				 

			exit();
            }
            else{

            	echo "<script>alert('Error Occured, you should fill all the fields')</script>";
				echo"<script>window.open('home.php','_self')</script>";
            }
        }
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
////                                                                                                      ////
////                               function for displaying all ideas                                      ////
////                                                                                                      ////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function get_posts(){

	global $con;

	$per_page=5;

	if (isset($_GET['page'])) {
	$page = $_GET['page'];
	}
	else {
	$page=1;
	}
	$start_from = ($page-1) * $per_page;

	$get_posts = "select * from ideas ORDER by 1 DESC LIMIT $start_from, $per_page";

	$run_posts = mysqli_query($con,$get_posts);

	while($row_posts=mysqli_fetch_array($run_posts)){

		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$title_idea=$row_posts['title_idea'];
		$content = substr($row_posts['desc_idea'],0,40);
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		//getting the user who has posted the thread
		$user = "select * from users where user_id='$user_id' AND posts='yes'";
		$run_user = mysqli_query($con,$user);
		$row_user=mysqli_fetch_array($run_user);

		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		// getting the user who want to particicpate
		$user_com = $_SESSION['user_email'];
		$get_com = "select * from users where user_email='$user_com'";
		$run_com = mysqli_query($con,$get_com);
		$row_com=mysqli_fetch_array($run_com);
		$curr_user = $row_com['user_id'];
		$user_com_name = $row_com['user_name'];
                    
	

		 if(strlen($content) >= 1 && strlen($upload_image) >= 1 && strlen($title_idea) >= 1){
            echo "
			<style>
               h3 { color: #4287f5;}
            </style>";
			echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
				<div class='row'>
					<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='50px' height='50px'></p>
					</div>
					<div class='col-sm-6'>
						<h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
						<h4><small style='color:black;'>Updated an idea on <strong>$post_date</strong></small></h4>
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
				<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a>
				&nbsp;<a href='lobby.php?post_id=$post_id' style='float:left;'><button class='btn btn-info' name='participate'>participate</button></a>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";

		}
		
	}
	include("pagination.php");
	}

	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
////                                                                                                      ////
////                             function for displaying a single idea                                    ////
////                                                                                                      ////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function single_post(){

	if(isset($_GET['post_id'])){

	global $con;

	$get_id = $_GET['post_id'];

	$get_posts = "select * from ideas where post_id='$get_id'";

	$run_posts = mysqli_query($con,$get_posts);

	$row_posts=mysqli_fetch_array($run_posts);

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
		$user_image = $row_user['user_image'];

		// getting the user session
		$user_com = $_SESSION['user_email'];

		$get_com = "select * from users where user_email='$user_com'";
		$run_com = mysqli_query($con,$get_com);
		$row_com=mysqli_fetch_array($run_com);

		$user_com_id = $row_com['user_id'];
		$user_com_name = $row_com['user_name'];


		//now displaying all at once



		if(isset($_GET['post_id'])){
			$post_id = $_GET['post_id'];
			}
			$get_posts = "select post_id from users where post_id='$post_id'";
			$run_user = mysqli_query($con,$get_posts);

			$post_id = $_GET['post_id'];

			$post = $_GET['post_id'];
			$get_user = "select * from ideas where post_id='$post'";
			$run_user = mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);

			$p_id = $row['post_id'];

			if($p_id != $post_id){
				echo "<script>alert('ERROR')</script>";
				echo "<script>window.open('home.php','_self')</script>";
			}else{


		if(strlen($content) >= 1 && strlen($upload_image) >= 1 && strlen($title_idea)>= 1 ){

			echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
				<div class='row'>
					<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
					</div>
					<div class='col-sm-6'>
						<h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
						<h4><small style='color:black;'>Updated an idea on <strong>$post_date</strong></small></h4>
					</div>
					<div class='col-sm-4'>

					</div>
				</div>
				<div class='row'>
					<div class='col-sm-12'>
					    <p>$title_idea</p> <br>
						<p>$content</p>
						<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
					</div>
				</div><br>
				<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a>
				&nbsp;<a href='lobby.php?post_id=$post_id' style='float:left;'><button class='btn btn-info' name='participate'>participate</button></a>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>";

		}
	// modification
		include("comments.php");

		echo "
		<div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <div class='panel panel-info'>
                <div class='panel-body'>
                	<form action='' method='post' class='form-inline'>
                    <textarea placeholder='Write your comment here!'' class='pb-cmnt-textarea' name='comment'></textarea>
                    <button class='btn btn-info pull-right' name='reply'>Comment</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
		";

		if(isset($_POST['reply'])){

			$comment = htmlentities($_POST['comment']);

			if($comment == ""){
			echo"<script>alert('Enter your comment!')</script>";
			echo "<script>window.open('single.php?post_id=$post_id','_self')</script>";
			}else{
			$insert = "insert into comments (post_id,user_id,comment,comment_author,date) values ('$post_id','$user_id','$comment','$user_com_name',NOW())";

			$run = mysqli_query($con,$insert);

			echo"<script>alert('Your Reply was added!')</script>";
			echo "<script>window.open('single.php?post_id=$post_id','_self')</script>";
		}

		}

	}
	}

	}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////
////                                                                                                      ////
////                              function for displaying user ideas                                      ////
////                                                                                                      ////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function user_posts(){
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
			$user_image = $row_user['user_image'];






			if(isset($_GET['u_id'])){
			$u_id = $_GET['u_id'];
			}
			$get_posts = "select user_email from users where user_id='$u_id'";
			$run_user = mysqli_query($con,$get_posts);
			$row=mysqli_fetch_array($run_user);

			$user_email = $row['user_email'];

			$user = $_SESSION['user_email'];
			$get_user = "select * from users where user_email='$user'";
			$run_user = mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);

			$user_id = $row['user_id'];
			$u_email = $row['user_email'];

			if($u_email != $user_email){
				echo"<script>window.open('my_post.php?u_id=$user_id','_self')</script>";
			}else{
              if(strlen($content) >= 1 && strlen($upload_image) >= 1 && strlen($title_idea) >= 1 ){

			echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
				<div class='row'>
					<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
					</div>
					<div class='col-sm-6'>
						<h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
						<h4><small style='color:black;'>Updated an idea on <strong>$post_date</strong></small></h4>
					</div>
					<div class='col-sm-4'>

					</div>
				</div>
				<div class='row'>
					<div class='col-sm-12'>
					    <p>$title_idea</p> <br>
						<p>$content</p>
						<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
					</div>
				</div><br>
				<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a>
				&nbsp;<a href='lobby.php?post_id=$post_id' style='float:left;'><button class='btn btn-info'>participate</button></a>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>";

		}
		
			include("functions/delete_post.php");
		}

		}

	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
////                                                                                                      ////
////                            function for displaying search results                                    ////
////                                                                                                      ////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function results(){

	global $con;

	if(isset($_GET['search'])){
	$search_query = htmlentities($_GET['user_query']);
	}
    $get_posts = "select * from ideas where title_idea like '%$search_query%' OR desc_idea like '%$search_query%' OR upload_image like '%$search_query%'";
	$run_posts = mysqli_query($con,$get_posts);


	while($row_posts=mysqli_fetch_array($run_posts)){

		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
        $title_idea =$row_posts['title_idea'];
		$content = substr($row_posts['desc_idea'],0,40);
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];


		$user = "select * from users where user_id='$user_id' AND posts='yes'";

		$run_user = mysqli_query($con,$user);
		$row_user=mysqli_fetch_array($run_user);

		$user_name = $row_user['user_name'];
		$first_name = $row_user['f_name'];
		$last_name = $row_user['l_name'];
		$user_image = $row_user['user_image'];

	    if(strlen($content) >= 1 && strlen($upload_image) >= 1 && strlen($title_idea) >= 1){

			echo "
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
				<div class='row'>
					<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
					</div>
					<div class='col-sm-6'>
						<h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
						<h4><small style='color:black;'>Updated an idea on <strong>$post_date</strong></small></h4>
					</div>
					<div class='col-sm-4'>

					</div>
				</div>
				<div class='row'>
					<div class='col-sm-12'>
					    <p>$title_idea</p> <br>
						<p>$content</p>
						<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
					</div>
				</div><br>
				<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a>
				&nbsp;<a href='lobby.php?post_id=$post_id' style='float:left;'><button class='btn btn-info'>participate</button></a>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";

		}

	}
 }



//////////////////////////////////////////////////////////////////////////////////////////////////////////////
////                                                                                                      ////
////                              function for displaying search users                                    ////
////                                                                                                      ////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function search_user(){

	global $con;

	if(isset($_GET['search_user_btn'])){
	$search_query = htmlentities($_GET['search_user']);
	$get_user = "select * from users where f_name like '%$search_query%' OR l_name like '%$search_query%' OR user_name like '%$search_query%'";
	}
	else{
	$get_user = "select * from users";
	}

	$run_user = mysqli_query($con,$get_user);

	while($row_user=mysqli_fetch_array($run_user)){

		$user_id = $row_user['user_id'];
		$f_name = $row_user['f_name'];
		$l_name = $row_user['l_name'];
		$username = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		//now displaying all at once

		echo "
		<div class='row'>
			<div class='col-sm-3'>
			</div>

			<div class='col-sm-6'>

			<div class='row' id='find_people'>
			<div class='col-sm-4'>
			<a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>
			<img class='img-circle' src='users/$user_image' width='150px' height='140px' title='$username' style='float:left; margin:1px;'/>
			</a>
			</div><br><br>
			<div class='col-sm-6'>
			<a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>
			<strong><h2>$f_name $l_name</h2></strong>
			</a>
			</div>
			<div class='col-sm-3'>
			</div>

			</div>

			</div>
			<div class='col-sm-4'>
			</div>
		</div><br>";
	}

	}
?>
