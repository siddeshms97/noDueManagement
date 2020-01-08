<?php
include 'boot.php';

if (isset($_POST['submit2']))
{
		$usn=$_POST['usn2'];
		$name=$_POST['name2'];
		$course=$_POST['course2'];
		$sem=$_POST['sem2'];
		$key=$_POST['chairs'];
		$mou=$_POST['casings'];
		$moni=$_POST['tables'];
		$o1=$_POST['other1'];
		$o2=$_POST['other2'];
		$o3=$_POST['other3'];
		$o4=$_POST['other4'];
		$o5=$_POST['other5'];
		$o6=$_POST['other6'];
		$final=$_POST['final_amount2'];
		
// Create connection
$conn = new mysqli('localhost','root','','nms');

// Check connection
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO infra (usn, name, course, semester, chair, casing, tables, other1, other2, other3, other4, other5, other6,  tot_amt) 
VALUES ('$usn','$name','$course','$sem','$key','$mou','$moni','$o1','$o2','$o3','$o4','$o5','$o6','$final')";

if ($conn->query($sql) === TRUE) {
	//echo "<font size='6'><br><center>New record added successfully :) </font><br><br></center>";
	echo "<script> 
	alert(\"Record added successfully!\");
	</script>";
	
	$flag=1;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
}

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
    font-family: "Times New Roman";
	background-image: URL("bg4.jpg");
	background-size: 100%;
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
 
 <h4> <a href="/nodue_inframenu.php"><span class="glyphicon glyphicon-home" style="cursor:pointer; left:20;"> HOME </h4></span></a><br/>
 
 <h4> <a href="/nodue_infra.php/"><span class="	glyphicon glyphicon-blackboard" style="cursor:pointer;left:20;"> INFRA </h4></span></a><br/>
 
 <h4> <a href="/nodue_lab.php/"><span class="glyphicon glyphicon-user" style="cursor:pointer;left:20;"> LOGOUT </h4></span></a><br/>
 

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
</body>
</html> 



<html>
	<head>
	<title>	Infrastructure Due</title>

	<script>
	function myFunction()
	{
		var checkBox = document.getElementById("myCheck");
		var text = document.getElementById("t");
		if (checkBox.checked == true)
		{
			text.style.display = "block";
		}
		else 
		{
			text.style.display = "none";
		}
	}
	function chair()
	{
		var checkBox = document.getElementById("cha");
		//var text = document.getElementById("text");
		if (checkBox.checked == true)
		{
			one.style.display = "inline-block";
			document.getElementById('ch').value=300;
		} 
		else 
		{
			one.style.display = "none";
		}
	}

	function casing() 
	{
		var checkBox = document.getElementById("cas");
		//var text = document.getElementById("text");
		if (checkBox.checked == true)
		{
			two.style.display = "inline-block";
			document.getElementById('ca').value=100;
		}
		else
		{
			two.style.display = "none";
		}
	}

	function table() {
		var checkBox = document.getElementById("tab");
		//var text = document.getElementById("text");
		if (checkBox.checked == true)
		{
			three.style.display = "inline-block";
			document.getElementById('ta').value=600;
		}
		else
		{
			three.style.display = "none";
		}
	}
	function more() 
	{
		var checkBox = document.getElementById("mor");
		var text = document.getElementById("text");
		if (checkBox.checked == true)
		{
			four.style.display = "inline-block";
		}
		else
		{
			four.style.display = "none";
		}
	}
	function more1() 
	{
		var checkBox = document.getElementById("mor1");
		var text = document.getElementById("text");
		if (checkBox.checked == true)
		{
			five.style.display = "inline-block";
		} 
		else 
		{
			five.style.display = "none";
		}
	}
	function calculate()
	{
			var a = parseInt(document.getElementById('ch').value);
			var b = parseInt(document.getElementById('ca').value);
	
	
			var c = parseInt(document.getElementById('ta').value);
			var d = parseInt(document.getElementById('id2').value);
			var e = parseInt(document.getElementById('id4').value);
			var f = parseInt(document.getElementById('id6').value);
			var g =  a + b + c + d + e + f;

	
			document.getElementById('id7').value = g ;
	}
 
</script>
</head>

<body><br><br><br><br>
	<form action="nodue_infra.php" method="POST" id="f03">
	
	<table border="0"align="center">
	<tr><td colspan="2" align="center"><h2>Infrastructure Dues</h2></td></tr>
	<tr><td>Enter USN:</td><td><input type="text" name="usn2" id="100" placeholder="USN"/></td><td><input type="button" name="search" value="search"></td></tr>
	<tr><td>student name:</td><td><input type="text" name="name2" placeholder="Student's name"/></td></tr>
	<tr><td>Course:</td><td><input type="text" name="course2" placeholder="Course"/></td></tr>
	<tr><td>Semester:</td><td><input type="text" name="sem2" placeholder="Semester"></td></tr>
	<tr><td>Dues:</td></tr><br>
	<tr><td><input type="checkbox" id="cha"  onclick="chair()">Chair

	<tr><td><input type="checkbox" id="cas"  onclick="casing()">Casing

	<tr><td><input type="checkbox" id="tab"  onclick="table()">Table

	
	<div id="one" style="display:none">
	<input type="text" name="chairs" id="ch" value="0">
	</div>

	
	<div id="two" style="display:none">
	<input type="text" name="casings" id="ca" value="0">
	</div>

	
	<div id="three" style="display:none">
	<input type="text" name="tables" id="ta" value="0">
	</div></tr>
	<tr><td>Others:</td><td><input type="checkbox" id="myCheck"  onclick="myFunction()">

	<div id="t" style="display:none">
		<input type="text" name="other1" id="id1" placeholder="Specify the Due"><br/>
		<input type="text" name="other2" id="id2" value="0" placeholder="specify the amount">
		<input type="checkbox" id="mor" onclick="more()">More
	<div id="four" style="display:none">
		<input type="text" name="other3" id="id3"  placeholder="specify the due"><br>
		<input type="text" name="other4" id="id4" value="0" placeholder="specify the amount">
		<input type="checkbox" id="mor1" onclick="more1()">More
	<div id="five" style="display:none">
		<input type="text" name="other5" id="id5" placeholder="Specify the Due"><br/>
		<input type="text" name="other6" id="id6" value="0" placeholder="specify the amount">
	</div>
	</div>
	</div>
	</tr>


	<tr><td>Total fine amount:</td><td><input id="id7" type="text" name="final_amount2" placeholder="Final amount"></td>
	<td><input type="button" name="cal" value ="Calculate Total Amount" onclick="calculate()"></td></tr>
	<br/>
	<tr><td colspan="3" align="center"><button type="submit" name="submit2" value="submit">submit<br/>
	<button type="reset" name="reset1" value="reset">reset</td></tr>
	</table>
	</form>
	</body>
</html>