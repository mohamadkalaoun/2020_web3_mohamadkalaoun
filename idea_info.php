<?php
$con = mysqli_connect("localhost","root","","bulbow") or die("Connection was not established");
session_start();
include("utype.php");

$get_id = $_GET['post_id'];
$curr_user_id = getuserid();
$user_id = getownerid($get_id);
$select="SELECT title_idea , desc_idea , counter_part , price FROM ideas WHERE post_id='$get_id'";
$run = mysqli_query($con,$select);
$row=mysqli_fetch_array($run);
$title_idea = $row['title_idea'];
$desc_idea = $row['desc_idea'];
$price = $row['price'];
$counter_part = $row['counter_part'];
$arr=unserialize($counter_part);
$unknown=0;
$male=0;
$female=0;
foreach ($arr as $key => $value) {
    $selects="SELECT user_gender FROM users WHERE user_id='$value'";
    $rum = mysqli_query($con,$selects);
    $raw=mysqli_fetch_array($rum);
    $user_gender = $raw['user_gender'];
    if (is_null($user_gender) || empty($user_gender)) {
        $unknown+=1;
    }
    else if ($user_gender=="Male") {
        $male+=1;
    }
    else if ($user_gender=="Female") {
        $female+=1;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>Summary</title>
</head>
<body>
<div class="container-fluid">
<div class="row">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
        <form action="" method="post" enctype="multipart/form-data">
                    <table class="table table-bordered table-hover">
                        <tr align="center">
                            <td colspan="6" class="active"><h2>General Info And Statistics</h2></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Title Idea</td>
                            <td>
                            <input readonly class="form-control" type="text" name="u_pass" id="mypass" value="<?php echo $title_idea;?>"/>
                            </td>
                        </tr>
                        <?php
                        if ($curr_user_id==$user_id) {
                            echo "
                        <tr>
                                <td style='font-weight: bold;'>Idea Description</td>
                                <td><textarea id='desc' name='desc' rows='5' cols='50' placeholder='$desc_idea'></textarea></td>
                        </tr>
                        <tr>
                                <td style='font-weight: bold;'>Price or General info</td>
                                <td><textarea id='price' name='price' rows='5' cols='50' placeholder='$price'></textarea></td>
                        </tr>
                        <tr align='center'>
                            <td colspan='6'>
                            <input class='btn btn-info' style='width: 250px;' type='submit' name='update' value='Update'/>
                            </td>
                        </tr>
                            ";
                        }
                        else{
                            echo "
                            <tr>
                                <td style='font-weight: bold;'>Idea Description</td>
                                <td><textarea readonly id='desc' name='desc' rows='5' cols='50' placeholder='$desc_idea'></textarea></td>
                        </tr>
                        <tr>
                                <td style='font-weight: bold;'>Price or General info</td>
                                <td><textarea readonly id='price' name='price' rows='5' cols='50' placeholder='$price'></textarea></td>
                        </tr>
                        <tr align='center'>
                            <td colspan='6'><a href='messages.php?u_id=$user_id' class='btn btn-info'>Message Idea Owner</a></td>
                        </tr>    
                            ";
                        }
                        ?>
                        <tr>
                            <td colspan="6"><div id="piechart" style="width: 100%; height: 100%;"></div></td>
                        </tr>
                        <tr align="center">
                            <td colspan="6"><a href="<?php echo"summary.php?post_id=$get_id";?>" class="btn btn-warning">Back</a></td>
                        </tr>
                    </table>
                </form>
    </div>
    <div class="col-sm-2">
    </div>
</div>
</div>
</body>
</html>
<?php 
    if(isset($_POST['update'])){
    
        $desc = htmlentities($_POST['desc']);
        $price = htmlentities($_POST['price']);
        
        if (is_null($desc) || empty($desc)) {
            echo "<script>alert('Description Is Empty!')</script>";}
        else{
            $update="UPDATE ideas SET desc_idea='$desc',price='$price' WHERE post_id='$get_id'";
            $run = mysqli_query($con,$update); 
            if($run){   
                echo "DONE";
                header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
            }
        }
    }
?>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Genders Repartition'],
          ['Male',    <?php echo "$male";?>],
          ['Unknown',    <?php echo "$unknown";?>],
          ['Female',   <?php echo "$female";?>]
        ]);

        var options = {
          title: 'Genders Repartition'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
</script>
