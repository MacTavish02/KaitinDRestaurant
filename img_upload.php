<?php
session_start();
if(isset($_SESSION['username'])){
$caption = $_POST['caption'];
$f=$_FILES['myfile'];
$fname = preg_replace('/\s/', '', $f['name']);
$date = date('d');
$month = date('m');
$year = date('y');
$year= "20".$year;
$con=mysqli_connect('localhost','root');
	mysqli_select_db($con,'photographer');
if(file_exists($_SESSION['username']."/".$fname))
{
	echo $f['name']." already exists";
}
else 
{	
if($f['type']=="image/jpeg" || $f['type']=="image/pjpeg" || $f['type']=="image/png" || trim($f['type'])=="")
	{
	$q="insert into ".$_SESSION['username']." (image_name,caption,Date,Month,Year) values('$fname','$caption','$date','$month','$year')";
	$i=mysqli_query($con,$q);
	if(!$i)
	{
		echo $q;
		echo "Some Error Occured";
	}
	else{
	move_uploaded_file($f['tmp_name'],$_SESSION['username']."/".$fname);
	header ('location:http://localhost:8080/examples/Photographer/profile.php?username='.$_SESSION['username']);
	}
	}
else
	echo "File type is not valid ".$f['type'];
}
}
else
{
	header ('location:http://localhost:8080/examples/Photographer/index.html');
}
?>