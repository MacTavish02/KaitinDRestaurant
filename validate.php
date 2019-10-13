<?php
session_start();
$id=$_POST['username'];
$pass=$_POST['password'];
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'photographer');
$q="select * from users where username='$id' && password='$pass'";
$i=mysqli_query($con,$q);
$n= mysqli_num_rows($i);
if($n==1)
{
	
     $_SESSION['username']=$id;
	header ('location:http://localhost:8080/examples/Photographer/home.php');
}
else{
	header ('location:http://localhost:8080/examples/Photographer/failed.php');
}
?>