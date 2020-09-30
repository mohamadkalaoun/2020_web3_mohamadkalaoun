<?php 
session_start();

include("includes/connection.php"); 

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
////                                                                                                      ////
////                                      encrypt function                                                ////
////                                                                                                      ////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

function ucrypt($pass){
	$ciphering = "AES-128-CTR";      
   	 // Use OpenSSl Encryption method 
    $iv_length = openssl_cipher_iv_length($ciphering); 
    $options = 0; 
            
	 // Non-NULL Initialization Vector for encryption 
	$encryption_iv = '1234567891011121'; 
            
	 // Store the encryption key 
	$encryption_key = "ScrumbThumb"; 
            
	 // Use openssl_encrypt() function to encrypt the data 
	$encryption = openssl_encrypt($pass, $ciphering, 
                    $encryption_key, $options, $encryption_iv);
	return $encryption;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
////                                                                                                      ////
////                                      decrypt function                                                ////
////                                                                                                      ////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

function udecrypt($pass1){

	$ciphering2 = "AES-128-CTR"; 
    $options2 = 0; 
     // Non-NULL Initialization Vector for decryption 
    $decryption_iv2 = '1234567891011121';
     // Store the decryption key 
    $decryption_key2 = "ScrumbThumb";
     // Use openssl_decrypt() function to decrypt the data 
    $decryption1=openssl_decrypt ($pass1, $ciphering2,  
         $decryption_key2, $options2, $decryption_iv2);  

    return $decryption1;
} 


	if(isset($_POST['login'])){
	
	$email = htmlentities(mysqli_real_escape_string($con,$_POST['email']));
	$pass = htmlentities(mysqli_real_escape_string($con,$_POST['pass']));
	
	$select_user = "select * from users where user_email='$email' AND user_pass='$pass' AND status='verified'";
	
	$query = mysqli_query($con,$select_user); 
	
	$check_user = mysqli_num_rows($query);
	
	if($check_user==1){
	
	$_SESSION['user_email']=$email;
		if(!empty($_POST["remember"])) {
		//$simple_string = strval($phone);
		$encryption = ucrypt($email);

		setcookie ("email",$encryption,time()+ 2628000);

		//$simple_string2 = $_POST["password"];
		$encryption2 = ucrypt($pass);
		setcookie ("password",$encryption2,time()+ 2628000);
		} else { 
		setcookie("username","");
		setcookie("password","");
		} 
	echo "<script>window.open('home.php','_self')</script>";
	
	}
	else {
	echo "<script>alert('incorrect details, try again!')</script>";
	}
	
	}


?>
