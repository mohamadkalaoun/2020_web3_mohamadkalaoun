<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <!-- sign up validation -->
    <script type="text/javascript">
    function validatesignup() {
        var username= document.signupform.username.value ;
        var x=document.signupform.email.value;  
        var atposition=x.indexOf("@");  
        var dotposition=x.lastIndexOf(".");
        var option = document.getElementsByName('gender');
        var firstpassword= document.signupform.password_1.value ;
        var secondpassword=document.signupform.password_2.value;
        
    if (username==null || username==""){  
     alert("username can't be blank");  
     return false;  
    }
    else if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
     alert("Please enter a valid e-mail address ");  
     return false;  
     }
    else if (!(option[0].checked || option[1].checked )) {
     alert("Please Select Your Gender");
     return false;
     }   
    else if(firstpassword.length<8){  
    alert("Password must be at least 8 characters long.");  
    return false; } 
    else if(!(firstpassword==secondpassword)){ 
    alert("password must be same!");
    return false;  
    } 
    }
    </script>
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form name="signupform"  method="post" action="register.php" onsubmit="return validatesignup()">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" >
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" >
  	</div>
    <div class="input-group">
      <label>Gender : </label> <br>
      <table id="genderform">
        <tr>
          <td>
            <label for="male">Male</label><br>
            <input type="radio" id="male" name="gender" value="male">
          </td>
          <td></td>
          <td>
            <label for="female">Female</label><br>
            <input type="radio" id="female" name="gender" value="female">
          </td>
        </tr>
      </table>
    </div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>