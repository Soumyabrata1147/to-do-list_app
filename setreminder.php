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
    echo "successful";
    if(isset($_POST['save'])){
        $name=$_SESSION['name'];
        //$_POST['name']
        //;
        $message=$_POST['message'];
        $date=$_POST['date'];
    
$sql="INSERT INTO list (name,message,date) VALUES ('$name','$message','$date')";
$query=mysqli_query($con,$sql);
if($query){
    echo "reminder set";
    $_SESSION['name']=$name;
    header('location:getreminder.php');
}
}
}
?>
