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
    <link rel="stylesheet" href="style/2home_style2.css" media="all"/>
</head>
<style>
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload{
    width: 100%;
}
</style>
<script>
$(document).ready( function() {
    	$(document).on('change', '.-btnfile :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		}); 	
	});
</script>
<body>
<div class="row">
	<div id="insert_post" class="col-sm-12">
	  <form action="home.php?id=<?php echo $user_id;?>" method="post" id="f" enctype='multipart/form-data' class="form-group">
        <input type="text" id="title_idea" name="title_idea" class="form-control" placeholder="Title Idea..">
 		<textarea id="form10" id="content" name="content" class="md-textarea form-control" rows="3" placeholder="Describe Your Idea.."></textarea>
        <div class="input-group">
          <span class="input-group-btn">
          <span class="btn btn-default btn-file">
            Add image… <input type="file" name='upload_image' id="imgInp">
          </span>
          </span>
          <input type="text" class="form-control" readonly>
       	</div>
        <img id='img-upload'/>
		<center><button id="btn-post" class="btn btn-primary btn-block" name="sub">Post</button></center>
	   </form>
		<?php insertPost();?>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<center><h2><strong>Latest Ideas</strong></h2><br></center>
		<?php get_posts();?>
	</div>
</div>
</body>
</html>
<?php } ?>

<!-- <span class='badge badge-secondary'> $count_msg</span> -->
