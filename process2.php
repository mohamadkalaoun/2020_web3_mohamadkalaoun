<?php
$con = mysqli_connect("localhost","root","","bulbow") or die("Connection was not established");

    $function = $_POST['function'];
    
    $log = array();
    
    switch($function) {
    
    case('getState'):
        global $con ;
        $get_id = $_POST['idea_id'];
        $select = "SELECT brainstorming from ideas WHERE post_id='$get_id'";
        $rain = mysqli_query($con,$select);        
        if (!$rain) {
                echo "something went wrong"; 
                exit();
            }
        $row_msg=mysqli_fetch_array($rain);
        $bschat = $row_msg['brainstorming'];
        if (is_null($bschat)) { echo "no messages"; }
        else{
                $brainS=unserialize($bschat);
                $lines=sizeof($brainS);
                $log['state'] = $lines; 
            }

   	    break;

    case('update'):    
            $state = $_POST['state'];
            global $con ;
            $get_id = $_POST['idea_id'];
            $select = "SELECT brainstorming FROM ideas where post_id='$get_id'";
            $run = mysqli_query($con,$select);
            if (!$run) {
                echo "something went wrong";
                exit();
            }
            $row_msg=mysqli_fetch_array($run);
            $bschat = $row_msg['brainstorming'];
            if (is_null($bschat)) { echo "no messages"; }
            else{
                $brainS=unserialize($bschat);
                $count=sizeof($brainS);
                if($state == $count){
                 $log['state'] = $state;
                 $log['text'] = false;
                    }
                else{
                    $text= array();
                    $log['state'] = $state + sizeof($brainS) - $state;
                    $i=0;
                    foreach( $brainS as $key => $value ){
                        if($i<$state){
                            unset($brainS[$key]);
                            $i+=1;
                        }
                    }
                    foreach ($brainS as $line_num => $line){
                            $text[$line_num] =  $line = str_replace("\n", "", $line);
                        }
                     $log['text'] = $text; 
                }
            }
             break;
    	 
    case('send'):
        global $con ;
        $get_id = htmlentities(strip_tags($_POST['idea_id']));
        $select = "SELECT brainstorming from ideas WHERE post_id='$get_id'";
        $rain = mysqli_query($con,$select);
        if ($rain) {
            $nickname = htmlentities(strip_tags($_POST['nickname']));
            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
            $message = htmlentities(strip_tags($_POST['message']));
            if(($message) != "\n"){
             //if(preg_match($reg_exUrl, $message, $url)) {
             //   $message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
             //   } 
            $date=date('Y-m-d h:i:sa');

            $row=mysqli_fetch_array($rain);
            $bschat = $row['brainstorming'];
            if (is_null($bschat)) {
                $brainS=array("$nickname,$date"=>"$message");
                $brainstorming=serialize($brainS);
                $update = "UPDATE ideas SET brainstorming='$brainstorming' WHERE post_id='$get_id'";
                echo "$update";
                $run = mysqli_query($con,$update); 
                }
            else{
                $brainS=unserialize($bschat);
                $new="$nickname,$date";
                $brainS[$new]=$message;
                $brainstorming=serialize($brainS);
                $update = "UPDATE ideas SET brainstorming='$brainstorming' WHERE post_id='$get_id'";
                $run = mysqli_query($con,$update);  
                }
              }
            }
        	break;
    case('getmessages'):
            global $con ;
            $get_id = $_POST['idea_id'];
            $select = "SELECT brainstorming FROM ideas where post_id='$get_id'";
            $run = mysqli_query($con,$select);
            if (!$run) {
                echo "something went wrong";
                exit();
            }
            $row_msg=mysqli_fetch_array($run);
            $bschat = $row_msg['brainstorming'];
            if (is_null($bschat)) {
                echo "no messages";
            }
            else{
                $brainS=unserialize($bschat);
                $log['lex'] = $brainS; }
            break;
}
    echo json_encode($log);
?>