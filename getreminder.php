<?php
session_start();
$servername='localhost';
$user='root';
$password='';
$dbname='to-do-list';
//set connection
$con=mysqli_connect($servername,$user,$password,$dbname);
if(!$con){
    die("cannot connect".mysqli_connect_error());
}else{
    //echo "successful";
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Remind me !!!</title>
<link rel='stylesheet' href='index.css'>
<link href="https://fonts.googleapis.com/css?family=Roboto:400,,500,700&display=swap" rel="stylesheet"> 
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
<?php
$sysdate=date("Y/m/d");
$tomorrow_date=date('Y-m-d', strtotime('+1 day'));
//echo $tomorrow;
//$sql="SELECT * FROM list WHERE name='".$_SESSION['name']."' && date>='$sysdate' &&date>='$tomorrow_date' ORDER BY date ";
$del="DELETE FROM list WHERE date<'$sysdate'";
$del=mysqli_query($con,$del);
//$query=mysqli_query($con,$sql);
//total reminders
$total_sql="SELECT * FROM list WHERE name='".$_SESSION['name']."' && date>='$sysdate'";
$total_query=mysqli_query($con,$total_sql);
$row_count=mysqli_num_rows($total_query);
echo "<p class='nav'>"."Reminders(".$row_count.")</p>";
?>
<div class='rest'>
<?php
//today reminders
//$today_row=mysqli_num_rows($today_query);
//if($today_row==1){   
//}
?>
<p class='heading'>Today</p>
<?php
//today reminders
$today="SELECT * FROM list WHERE name='".$_SESSION['name']."' && date='$sysdate'";
$today_query=mysqli_query($con,$today);
while($rows_today=mysqli_fetch_assoc($today_query)){
    echo "<div class='messages'>";
    echo "<br>".$rows_today['message'];
    echo "</div>";
}?>
<p class='heading'>Tomorrow</p>
<?php
//tomorrow reminders
$tomorrow="SELECT * FROM list WHERE name='".$_SESSION['name']."' && date='$tomorrow_date'";
$tomorrow_query=mysqli_query($con,$tomorrow);
while($rows_tomorrow=mysqli_fetch_assoc($tomorrow_query)){
    echo "<div class='messages'>";
    echo "<br>".$rows_tomorrow['message'];
    echo "</div>";
}?>
<p class='heading'>Upcoming</p>
<?php
//upcoming reminders
$upcoming="SELECT * FROM list WHERE name='".$_SESSION['name']."' && date>'$sysdate' && date>'$tomorrow_date' ORDER BY date ";
$upcoming_query=mysqli_query($con,$upcoming);
while($rows_upcoming=mysqli_fetch_assoc($upcoming_query)){
    echo "<div class='messages'>";
    echo "<br>".$rows_upcoming['message'];
    echo "</div>";
}
}
?>
<a href='submit.html'><i class="fa fa-plus" aria-hidden="true"></i></a>
</div>
</body>
</html>