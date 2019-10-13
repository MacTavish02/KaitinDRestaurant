<?php
session_start();
if(isset($_SESSION['username'])){
$f=$_FILES['cover_pic'];
$fname=$f['name'];

if(file_exists($_SESSION['username']."/cover.jpg"))
{
	unlink($_SESSION['username']."/cover.jpg"); 
	move_uploaded_file($f['tmp_name'],$_SESSION['username']."/cover.jpg");
	header ('location:http://localhost:8080/examples/Photographer/profile.php?username='.$_SESSION['username']);
}
else 
{	
if($f['type']=="image/jpeg" || $f['type']=="image/pjpeg" || $f['type']=="image/png" || trim($f['type'])=="")
	{
	move_uploaded_file($f['tmp_name'],$_SESSION['username']."/cover.jpg");
	header ('location:http://localhost:8080/examples/Photographer/profile.php?username='.$_SESSION['username']);
	}
else
	echo "File type is not valid : ".$f['type'];
}
}
else
{
	header ('location:http://localhost:8080/examples/Photographer/index.html');
}
?>