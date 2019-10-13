<?php
session_start();

header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

if(isset($_SESSION['username'])){
$owner=trim($_GET['username']);
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'photographer');
$q1="select * from users where username='".$owner."'";
$i1=mysqli_query($con,$q1);

if(!mysqli_num_rows($i1))
{
	header ('location:http://localhost:8080/examples/Photographer/home.php');
}
else{
$name=$i1->fetch_assoc();
$q="select * from `".$owner."` where S_No > 0";
$i=mysqli_query($con,$q);
$q1="select * from users where username ='".$_SESSION['username']."'";
$i1=mysqli_query($con,$q1);
$data=$i1->fetch_assoc();
$fn=$data['first_name'];
$y= mysqli_num_rows($i);
$x=0;
$m=$y;
for($p=1;$m!=0;$p++)
{
$q="select * from ".$owner." where S_No='$p'";
$i=mysqli_query($con,$q);
$row2 = $i->fetch_assoc();
$n= mysqli_num_rows($i);
if($n==1){
	$rows[$x]=$row2['S_No'];
	$name[$x]=$row2['image_name'];
	$caption[$x]=$row2['caption'];
	$date[$x]=$row2['Date'];
	$month[$x]=$row2['Month'];
	$year[$x]=$row2['Year'];
	$x++;
	$m--;
}
}
$cover_pic = file_exists($owner."/cover.jpg");
?>
<!DOCTYPE html>
<html len="en">
<head>
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
<meta http-equiv="Pragma" content="no-cache"/>
<meta http-equiv="Expires" content="0"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name['first_name']; ?> -We are Photographers</title>
	<link rel="stylesheet" href="nav.css">
	<link rel="stylesheet" href="http://localhost:8080/examples/Photographer/profile.css">
<style>
	body
{
	<?php if($cover_pic){ ?>
	height:100vh;
	background-image:url(<?php echo $owner."/cover.jpg";?>);
	background-repeat:no-repeat;
	background-size:cover;
	<?php } else{ ?>
		background-image:linear-gradient(to right,black,white,black);
		
	<?php } ?>
}
</style>
</head>
<body>
<script src="jquery.js"></script>
<script>
function expand()
{
	document.getElementById("sidebar").classList.toggle('active');
	document.getElementById("toggle-btn").style.display="none";
}
function collapse()
{
	document.getElementById("sidebar").classList.toggle('active');
	document.getElementById("toggle-btn").style.display="block";
}
function logout() {
  if (confirm("Are you sure you want to logout ?")) {
    location.replace("http://localhost:8080/examples/Photographer/logout.php");  
  }
}
$(document).ready(function(){
	
	$('.img-button').click(function(){
		$('.form').animate({height:"toggle",opacity:"toggle"},"slow");
		
	})
	$('.profile-btn').click(function(){
		$('.content').css("display","block");
		$('.details').css("display","block");
		$('#gallary').css("display","none");
		$('#contact').css("display","none");
		$('.contact').css("display","none");
		$('.form').css("display","none");
	})
		$('.gallary-btn').click(function(){
			$('.content').css("display","block");
			$('.details').css("display","none");
			$('#gallary').css("display","block");
			$('#contact').css("display","none");
			$('.contact').css("display","none");
	})
		$('.contact-btn').click(function(){
			$('.content').css("display","block");
			$('.details').css("display","none");
			$('#gallary').css("display","none");
			$('#contact').css("display","block");
			$('.contact').css("display","block");
			$('.form').css("display","none");
	})
	
	
	
})
</script>
<div id="sidebar" class="col-s-4 col-m-3">
<div id="toggle-btn" onclick="expand()"><br>
<span class="btn-span"></span>
<span class="btn-span"></span>
<span class="btn-span"></span>
</div>
<ul>
<div id="toggle-btn2" onclick="collapse()">
<span class="btn-span"></span>
<span class="btn-span"></span>
<span class="btn-span"></span>
</div><br>
<h1 style="color:white;">Hello <?php echo $fn;?></h1>
<li><a href="http://localhost:8080/examples/Photographer/home.php">Explore</a></li>
<li><a href="<?php echo "http://localhost:8080/examples/Photographer/profile.php?username=".$_SESSION['username'] ?>">My Profile</a></li>
<li><a href="#">About</a></li>
<li><a href="#">Contact</a></li>
</ul>
</div>
<div class="row">
<div class="col-d-3 col-l-3 col-t-2 col-m-1 col-s-1"></div>
<div class="col-d-6 col-l-6 col-t-8 col-m-9 col-s-9 identity">
<h1><?php echo $name['first_name']." ".$name['last_name'];?></h1>
</div>
<div class="col-d-3 col-l-3 col-t-2 col-m-2 col-s-2 "style="padding-right:0px;">
<div><a href="#" onclick="logout()" style="position:absolute;right:1%;top:5%;text-decoration:none;color:red;font-size:32px;float:right;">Log Out</a></div>
<div class="tabs">
<ul>

<li><button class="profile-btn">Profile</button></li>
<li><button class="gallary-btn">Gallery</button></li>
<li><button class="contact-btn" style="font-size:28px;height:70px;"><?php if($owner==$_SESSION['username']){ echo "Change Cover Pic"; }else {	echo "Contact";	}?></button></li>
</ul>
</div>
</div></div>
<div class="row">
<div class="col-2"></div> 
<div class="row content col-8"><div class="col-2"></div>
<div class="col-8 details" style="display:none;margin-top:10px;padding-top:20px;">
<img class="details" style="width:150px;height:150px;margin:auto;display:none;" src="user.jpg" ></img><br><br>
<table class="details" style="width:100%;color:white;padding:10px;font-size:30px;border-bottom:none;">
<tr >
<th >Name:</th>
<td><?php echo $name['first_name']." ".$name['last_name'];?></td>
</tr>
<tr>
<th>Photographer rating:</th>
<td>4.6</td>
</tr>
</table>
</div>
<div id="gallary" class="col-8 form" style="display:none;width:100%;">
<?php
for($count=0;$count<$y;$count++){?>
<a href="<?php echo $owner."/".$name[$count]; ?>" style="text-decoration:none;color:black;"><div class="gallary img-gallary" style="">
  <img class="gallary" src= <?php echo $owner."/".$name[$count]; ?> alt="Norther Lights" style="width:100%" ></img>
</div></a>
<?php } 
if($owner==$_SESSION['username']){
?>

<div class="gallary img-button add-button" style="">
  <div class="gallary" style="width:100%;border:2px solid white;height:25vh;text-align:center;">
 <div style="position:relative;top:30%;font-size:28px;text-align:center;color:white;">Add Image</div>
 </div>
</div><?php }?>
</div><?php
if($owner==$_SESSION['username']){
?>
<div class="col-8 form" style="position:absolute;left:20%;display:none">
<form action="http://localhost:8080/examples/Photographer/img_upload.php" method="POST" enctype="multipart/form-data">
<input type="text" placeholder="Caption for image" name="caption" required></input>
<input type="file" name="myfile"/>
<input type="submit" value="Upload"/>
<button type="button" class="img-button button">Cancel</button>
</form>
</div><?php }?>
</div >
<div id="contact">
<?php
if($owner==$_SESSION['username']){
?>
<div class="col-8 contact" style="position:absolute;left:20%;display:none;">
<form action="http://localhost:8080/examples/Photographer/cover_upload.php" method="POST" enctype="multipart/form-data">
<input type="file" name="cover_pic"/>
<input type="submit" value="Upload"/>
</form>
</div>
<?php }
else{ ?>


<?php } ?>

</div>
</div>
</div>
</body>
</html>
<?php } }else { 
header ('location:http://localhost:8080/examples/Photographer/index.html');}
?>
