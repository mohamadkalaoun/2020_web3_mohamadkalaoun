<?php
include("includes/connection.php");
include("functions/functions.php");
?>
<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="home.php">BulBow</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	      	
	      	<?php 
			$user = $_SESSION['user_email'];
			$get_user = "select * from users where user_email='$user'"; 
			$run_user = mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);
					
			$user_id = $row['user_id']; 
			$user_name = $row['user_name'];
			$first_name = $row['f_name'];
			$last_name = $row['l_name'];
			$describe_user = $row['describe_user'];
			$Relationship_status = $row['Relationship'];
			$user_pass = $row['user_pass'];
			$user_email = $row['user_email'];
			//$user_country = $row['user_country'];
			$user_birthday = $row['user_birthday'];
			$user_image = $row['user_image'];
			$user_cover = $row['user_cover'];
			$recovery_account = $row['recovery_account'];
			$register_date = $row['user_reg_date'];
					
					
			$user_posts = "select * from ideas where user_id='$user_id'"; 
			if ($user_posts) {
			  $run_posts = mysqli_query($con,$user_posts); 
			  $posts = mysqli_num_rows($run_posts);
			}
			else{echo " ";}
			?>

	        <li><a href='profile.php?<?php echo "u_id=$user_id" ?>'><?php echo "$first_name"; ?></a></li>
	       	<li><a href="home.php">Home</a></li>
			<li><a href="members.php">Find People</a></li>
			<li><a href="messages.php?u_id=new">Messages</a></li>

			<?php
					
			echo"
					
	        <li class='dropdown'>
	          <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span><i class='glyphicon glyphicon-chevron-down'></i></span></a>
	          <ul class='dropdown-menu'>
	            <li>
	           <a href='my_post.php?u_id=$user_id'>My Ideas <span class='badge badge-secondary'> $posts</span></a>
	            </li>
	            <li>
	            <a href='edit_profile.php?u_id=$user_id'>Edit My Account</a>
	            </li>
	            <li role='separator' class='divider'></li>
	            <li>
	            <a href='logout.php'>Logout</a>
	            </li>
	          </ul>
	        </li>
	      </ul>
	      ";
	      ?>
	      <ul class="nav navbar-nav navbar-right">
	        <li class="dropdown">
	          <form class="navbar-form navbar-left" method="get" action="results.php">
		        <div class="form-group">
		          <input type="text" class="form-control" name="user_query" placeholder="Search">
		        </div>
		        <button type="submit" class="btn btn-info" name="search">Search</button>
		      </form>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
</nav>