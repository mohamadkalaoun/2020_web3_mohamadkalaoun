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
      $select="SELECT banned ,cooldown FROM ideas WHERE post_id='$get_id'";
      $run = mysqli_query($con,$select);
      $raw=mysqli_fetch_array($run);
   $im=0;
   $tm=0;                 
      $banned = $raw['banned'];
      $cooldown = $raw['cooldown']; 
      if (is_null($banned) || empty($banned)) {
        $im=0;
      }
      else{
        $arr=explode(",", $banned);
        foreach ($arr as $key => $value) {
          if ($value==$user_id) {
            $im+=1;
          }
        }
      }
      if (is_null($cooldown) || empty($cooldown)) {
        $tm=0;
      }
      else{
        switch ($cooldown) {
            case 'one':
            $tm+=1;
            $cool = 5000;
            break;
          
            case 'two':
            $tm+=1;
            $cool = 30000;
            break;

            case 'tea':
            $tm+=1;
            $cool = 60000;
            break;
        }
      }
      
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title>BrainStorming group Chat</title>
    
    <!-- bootstrap cdn -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- bootstrap cdn -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="chat2.js"></script>
    <link rel="stylesheet" type="text/css" href="style/bs.css">

    <script type="text/javascript">
        
      var name = "<?php echo $user_name ?>"; //sh8ale
      var idea_id = "<?php echo $get_id ?>";

      $("#name-area").html("You are: <span>" + name + "</span>");
      
      // kick off 
      var chat = new Chat();
      $(function() {
         chat.getState(idea_id);
         chat.update(idea_id); 
         
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
                  chat.send(text,name,idea_id);
                  //console.log(text);  
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
           url: "process2.php",
           data: {  
              'function': 'getmessages',
              'idea_id': idea_id,
              },
           dataType: "json",
           success: function(data){
           if(data.lex){

            const entries = Object.entries(data.lex);

          for (var key in entries) {
              var explode = entries[0][0].split(",");
              $('#chat-area').append($("<a href='particpaters.php?post_id="+idea_id+"' class='list-group-item list-group-item-action flex-column align-items-start'><div class = 'd-flex w-100 justify-content-between' ><h5 class = 'mb-1' >" +
               explode[0] + " </h5><small class='text-muted'>" + explode[1] + 
               "</small ></div> <p class = 'mb-1' > " + entries[key][1] + " </p> </a>"));

                      }   

           }
           document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
         },
        });
});
    </script>


</head>
<?php
if ($tm==0) {
  echo "<body onload=\"setInterval('chat.update(idea_id)', 1000)\">";
}
else if ($tm>0) {
  echo "<body onload=\"setInterval('chat.update(idea_id)', $cool )\">";
}
?>    
<div id="page-wrap"> 
  <table width="560px" border="0" cellspacing="0" cellpadding="5" height="640px" class="main" >
    <tbody> 
      <tr>
        <th class="header" scope="col" style="background-color: white"><?php echo "<a href='lobby.php?post_id=$get_id' >";?><img src="images/PicsArt_07-31-05.34.23.png" width="56" height="53" alt="back"/></th>
        <th class="header" scope="col" colspan="2">&emsp; <a style="color: white; font-size: 50px;" href="#">Brain Storming Group Chat</a></th>
      </tr>
      <tr>
      <td colspan="3" >
        <div id="chat-wrap"><div id="chat-area"></div></div>
      </td>
      </tr>
      <?php 
      if ($im==0) {
        echo "
         <tr>
          <form id='send-message-area'>
            <td colspan='3'><textarea id='sendie' maxlength = '100' required placeholder='type your message..' ></textarea></td>
          </form>
         </tr>";} 
      else if ($im>0) {
        echo "
         <tr>
          <form id='send-message-area'>
            <td colspan='3'><textarea readonly id='sendie' maxlength = '100' placeholder='You are banned !' ></textarea></td>
          </form>
         </tr>";
      } ?>

    </tbody>
  </table>
</div>

</body>

</html>