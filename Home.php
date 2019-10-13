<?php
session_start();
if(isset($_SESSION['username'])){
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'photographer');

$q="select * from users where S_No > 0";
$i=mysqli_query($con,$q);
$y= mysqli_num_rows($i);
$x=0;
$m=$y;
for($p=1;$m!=0;$p++)
{
$q="select * from users where S_No='$p'";
$i=mysqli_query($con,$q);
$row2 = $i->fetch_assoc();
$n= mysqli_num_rows($i);
if($n==1){
	$rows[$x]=$row2['S_No'];
	$name[$x]=$row2['username'];
	$first_name[$x]=$row2['first_name'];
	$last_name[$x]=$row2['last_name'];
	$x++;
	$m--;
}
}
$q1="select * from users where username ='".$_SESSION['username']."'";
$i1=mysqli_query($con,$q1);
$data=$i1->fetch_assoc();
$fn=$data['first_name'];
?>
<!DOCTYPE html>
<html len="en">
<head>
	<meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
<meta http-equiv="pragma" content="no-cache" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore -We are Photographers</title>
	<link rel="stylesheet" href="nav.css">
	<link rel="stylesheet" href="home.css">
	
<style>
#sidebar #toggle-btn span
{
	background:black;
}
</style>
</head>
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
</script>
<body>





<!--Make sure the form has the autocomplete function switched off:-->
<div class="row" style="position:absolute;top:0%;width:99%;height:50vh;">
<div class="col-2">
<div id="sidebar" class="col-s-4 col-m-3">
<div id="toggle-btn" onclick="expand()">
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
<li><a href="<?php echo "http://localhost:8080/examples/Photographer/profile.php?username=".$_SESSION['username'] ?>">My Profile</a></li>
<li><a href="about.html">About</a></li>
<li><a href="Contact.html">Contact</a></li>
</ul>
</div>

</div>
<div class="col-7" style="padding-top:0px;">
<div class="search-bar" style="margin-top:0px;text-align:center;background-color:orange;border:1px solid orange;border-radius:0 0 10px 10px;">
<h1>WE ARE</h1>
<h4>PHOTOGRAPHERS</h4>
<form autocomplete="off" style="position:sticky;top:0px;"action="http://localhost:8080/examples/Photographer/profile.php">
  <div class="autocomplete" style="width:300px;">
    <input id="myInput" type="text" name="username" placeholder="Search User">
  </div>
  <input type="submit" Value="Open Profile">
</form><br>
</div>
<div class="suggestion" style="margin-top:10px;text-align:center;">
<h2>Some Suggestion for you</h2>
<div class="row">
<?php  for($count=0;$count<$y;$count++){ if(!(strtolower($name[$count])==strtolower($_SESSION['username']))){?>
<a href="<?php echo "http://localhost:8080/examples/Photographer/profile.php?username=".$name[$count];?>" style="text-decoration:none;color:black;"><div class="polaroid " style="margin:10px;display:inline-block;float:left;">
  <img src="<?php if(file_exists($name[$count]."/cover.jpg")){echo $name[$count]."/cover.jpg";}else {echo "user.jpg";}  ?>" alt="<?php echo $name[$count]; ?>"  height="150px" width="198px"></img>
  <div class="container">
    <p><?php echo $first_name[$count]." ".$last_name[$count]."<br>(".$name[$count].")";  ?></p>
  </div>
</div></a>
<?php }}  ?>

</div>
</div>
</div>
<div class="col-3 side">
<a href="#" onclick="logout()" style="text-decoration:none;color:red;font-size:28px;float:right;">Log Out</a>
</div> 
</div>
<div class="row">
<div class="col-2"></div>
<div class="col-7" style="">




</div>
<div class="col-3"></div>
</div>

<script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var countries = [<?php  for($count=0;$count<$y;$count++) {	if(!(strtolower($name[$count])==strtolower($_SESSION['username']))){echo '"'.$name[$count].'",';}	} ?>];
/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);
</script>




</body>
</html>
<?php 
}
else{
header ('location:http://localhost:8080/examples/Photographer/index.html');}
?>