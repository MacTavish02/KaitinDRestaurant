<?php
session_start();
$username=trim($_POST['username']);
$email=trim($_POST['email']);
$pass=trim($_POST['password']);
$fn=trim($_POST['fn']);
$ln=trim($_POST['ln']);


$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'photographer');
$q="insert into users (username,email,password,first_name,last_name) values('$username','$email','$pass','$fn','$ln')";
$i=mysqli_query($con,$q);
$q2="CREATE TABLE `".$username."` (S_No int(3) primary key auto_increment,image_name varchar(100) unique,caption varchar(100),Date INT(2),Month varchar(15),Year int(4))";
$t=mysqli_query($con,$q2);
mkdir($username);

if(!$i||!$t)
{
	header ('location:http://localhost:8080/examples/Photographer/failed.html');
}
else
{
	$_SESSION['username']=$username;
	header ('location:http://localhost:8080/examples/Photographer/profile.php?username='.$username);
}
?>
