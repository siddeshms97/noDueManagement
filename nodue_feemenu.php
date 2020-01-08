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
	font-family: Verdana;
	font-size: 20px;
}

body {
    font-family:Verdana ;
		font-size: 22px;
	background-image: URL("bd12.jpg");
	background-size: 100% 100%;
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
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 50px;
	background-color:#464946;
	color: #c1c1c1;
}

.sidenav a {
    padding: 4px 4px 4px 4px;	
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
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
 
 <h4> <a href="nodue_feemenu.php"><span class="glyphicon glyphicon-home" style="cursor:pointer; left:20;"> HOME </h4></span></a><br/>
 
 <h4> <a href="nodue_fee.php"><span  class="glyphicon glyphicon-usd"style="cursor:pointer;left:20;"> FEES</h4></span></a><br/>
 
 <h4> <a href="nodue_finaldue.php"><span  class="	glyphicon glyphicon-euro"style="cursor:pointer;left:20;"> FINAL DUE</h4></span></a><br/>
 
 <h4> <a href="fee_report.php"><span class="	glyphicon glyphicon-blackboard" style="cursor:pointer;left:20;"> REPORT </h4></span></a><br/>
 
 <h4> <a href="logout.php"><span class="glyphicon glyphicon-user" style="cursor:pointer;left:20;"> LOGOUT </h4></span></a><br/>
 

  </div>
	
<span style="font-size:40px;cursor:pointer" onclick="openNav()">&#9776; </span>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "200px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script> 
<center>
<h2>
<?php
echo "Welcome" ." "  . $_SESSION['username'];
?>
</center></h2>      
</body>
</html> 
