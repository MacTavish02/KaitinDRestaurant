<?php  

$con=mysqli_connect('localhost','root');
 mysqli_select_db($con,'photographer');

$username=$_GET['username'];
$q="select * from users where username='$username'";
$i=mysqli_query($con,$q);
$n= mysqli_num_rows($i);
if($n==1)
	echo "found";
else 
	echo "available";

?>
