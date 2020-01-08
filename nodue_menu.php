<?php
session_start();
include 'boot.php';

?>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

h4{
	font-family: Bradley Hand ITC;
	font-size: 20px;
}

body {
    font-family: verdana;
	background-image: URL("bd12.jpg");
	background-size : 100% 100%;
	position: relative;
	background-stretch: 100%;
	background-repeat: repeat;
	}

h4:hover{ 
	color:white;
}

.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: white;
    overflow: hidden;
    transition: 0.5s;
    padding-top: 70px;
	background-color:#464946;
	color: #c1c1c1;
		font-family: Bradley Hand ITC;
	
}

.sidenav a {
    padding: 4px 4px 4px 4px;	
    text-decoration: none;
    font-size: 20px;
    color: #818181;
    display: block;
    transition: 0.3s;
	font-family: Bradley Hand ITC;
	}

.sidenav a:hover {
    color: white;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 10px;
    font-size: 36px;
    margin-left: 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

</style>
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times </a>
 <form method="post" action="nodue_menu.php">
 <h4 class="hhh"> <a href="nodue_menu.php"><span class="glyphicon glyphicon-home" style="cursor:pointer; left:20;"> HOME </h4></span></a><br/>
 <h4> <a  href="lib_report.php"><span class="glyphicon glyphicon-book" style="cursor:pointer;left:20;"> LIBRARY </h4></span></a><br/> 
 <h4> <a name="lab" href="lab_report.php"><span class="glyphicon glyphicon-asterisk" style="cursor:pointer;left:20;" > LAB </h4></span></a><br/>
 <h4> <a href="infra_report.php"><span class="	glyphicon glyphicon-blackboard" style="cursor:pointer;left:20;"> INFRA </h4></span></a><br/>
 <h4> <a href="sports_report.php"><span class="glyphicon glyphicon-pawn" style="cursor:pointer;left:20;"> SPORTS </h4></span></a><br/>
 <!--<h4> <span class="glyphicons glyphicons-usd"> FEES </h4></span><br/>-->
 <h4> <a href="fee_report.php"><span  class="glyphicon glyphicon-usd"style="cursor:pointer;left:20;"> FEES</h4></span></a><br/>
 <h4> <a href="nodue_report.php"><span class="glyphicon glyphicon-list-alt" style="cursor:pointer; left:20;"> REPORT </h4></span></a><br/>
 <h4> <a href="logout.php"><span class="glyphicon glyphicon-user" style="cursor:pointer;left:20;"> LOGOUT </h4></span></a><br/>
 </form>

  </div>
	
<span style="font-size:40px;cursor:pointer" onclick="openNav()">&#9776; </span>
<center>
<h2>
<?php
echo "Welcome" ." "  . $_SESSION['username'];
?>
</h2>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "180px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script> 
</center>    
</body>
</html> 
