<?php

      $con = mysqli_connect("localhost","root","","bulbow") or die("Connection was not established");
      session_start();
      $user = $_SESSION['user_email'];
      $get_user = "select * from users where user_email='$user'"; 
      $run_user = mysqli_query($con,$get_user);
      $row=mysqli_fetch_array($run_user);
                    
      $user_id = $row['user_id']; 
      $user_name = $row['user_name'];
      $get_id = $_GET['post_id'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title>Chat</title>
    
    <link rel="stylesheet" href="style/style01.css" type="text/css" />
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="chat.js"></script>
    
    <script type="text/javascript">
        
      var name = "<?php echo $user_name ?>";
    	$("#name-area").html("You are: <span>" + name + "</span>");
    	
    	// kick off 
        var chat = new Chat();
    	$(function() {

    		 chat.getState();
         chat.update(); 
    		 
    		 // watch textarea for key presses
             $("#sendie").keydown(function(event) {  
             
                 var key = event.which;  
           
                 //all keys including return.  
                 if (key >= 33) {
                   
                     var maxLength = $(this).attr("maxlength");  
                     var length = this.value.length;  
                     
                     // don't allow new content if length is maxed out
                     if (length >= maxLength) {  
                         event.preventDefault();  
                     }  
                  }  
    		 																																																});
    		 // watch textarea for release of key press
    		 $('#sendie').keyup(function(e) {	
    		 					 
    			  if (e.keyCode == 13) { 
    			  
                    var text = $(this).val();
    				var maxLength = $(this).attr("maxlength");  
                    var length = text.length; 
                     
                    // send 
                    if (length <= maxLength + 1) { 
                     
    			        chat.send(text, name);	
    			        $(this).val("");
    			        
                    } else {
                    
    					$(this).val(text.substring(0, maxLength));
    					
    				}	
    				   				
    			  }
             });            
    	});

$(document).ready(function(){
  $.ajax({
           type: "POST",
           url: "process.php",
           data: {  
              'function': 'getmessages',
              'file': file
              },
           dataType: "json",
           success: function(data){
             if(data.lex){
              for (var i = 0; i < data.lex.length; i++) {
                              $('#chat-area').append($("<p>"+ data.lex[i] +"</p>"));
                          }                 
             }
             document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
             //instanse = false;
             //state = data.state;
           },
        });
});
    </script>


</head>

<body onload="setInterval('chat.update()', 1300)">

    <div id="page-wrap"> 
      <table width="560px" border="0" cellspacing="0" cellpadding="5" height="640px" class="main" >
       <tbody> 
         <tr>
          <th class="header" scope="col" style="background-color: white"><?php echo "<a href='lobby.php?post_id=$get_id' >";?><img src="images/PicsArt_07-31-05.34.23.png" width="56" height="53" alt="back"/></th>
          <th class="header" scope="col" colspan="2">&emsp; <a style="color: white; font-size: 50px;" href="#">Global Group Chat</a></th>
        </tr>
        <tr>
         <td colspan="3" >
          <p id="name-area"></p>       
          <div id="chat-wrap"><div id="chat-area"></div></div>
         </td>
        </tr>
        <tr>
        <form id="send-message-area">
            <td colspan="3"><textarea id="sendie" maxlength = '100' placeholder="type your message.." ></textarea></td>
        </form>
        </tr>
       </tbody>
     </table>
    </div>

</body>

</html>
