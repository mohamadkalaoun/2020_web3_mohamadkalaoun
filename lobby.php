<!doctype html>
<?php
session_start();
include("utype.php");
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
	*{
		box-sizing: border-box;
	}
	.main{
		align-items: center ;
		display:block;
  		width:622px;
  		text-align:center;
		background: #5DB2DB;
		align-self: center ;
		max-width: 622px;
 		margin: auto;
  		padding: 10px;
	}
</style>
<title>idea_lobby</title>
</head>
<body>
<div class="main">
 <table width="622px" border="0" cellspacing="29px" cellpadding="" >
  <tbody>
    <tr>
      <th scope="col"><a href="index01.php" ><img src="images/globalchat.png" width="500" height="480" alt=""/></a></th>
	</tr>
    <tr> <th scope="col"><a href="brains.php"><img src="images/brainS.png" width="500" height="480" alt=""/></a></th></tr> 
     <tr> <th scope="col"><img src="images/summary.png" width="500" height="480" alt=""/></th></tr>
  </tbody>
</table>
<?php
 if(verUser()==true){
 echo "<footer class='quote'><textarea>Something related to your idea ..</textarea></footer>"; }
 else{ 
 	echo""; }
?>
</div>
</body>
</html>
