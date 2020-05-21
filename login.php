<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
   <!-- javascript login validation -->
  <script>  
       function validateform(){  
       var name=document.myform.username.value;  
       var password=document.myform.password.value;  
  
     if (name==null || name==""){  
     alert("Name can't be blank");  
     return false;  
    }else if(password.length<8){  
    alert("Password must be at least 8 characters long.");  
    return false;  
    }  
    } 
  </script> 
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form name="myform" method="post" action="login.php" onsubmit="return validateform()">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>