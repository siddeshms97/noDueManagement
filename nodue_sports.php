<?php
session_start();
include 'boot.php';

// Create connection
$conn = new mysqli('localhost','root','','nms');

// Check connection
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['submit3']))
{
		$usn=$_POST['usn'];
		$name=$_POST['name'];
		$course=$_POST['course'];
		$sem=$_POST['sem'];
		$bat=$_POST['bat'];
		$ball=$_POST['ball'];
		$o1=$_POST['other1'];
		$o2=$_POST['other2'];
		$o3=$_POST['other3'];
		$o4=$_POST['other4'];
		$o5=$_POST['other5'];
		$o6=$_POST['other6'];
		$final=$_POST['final_amount3'];
		$cid=$_POST['cid'];
		
	
$sql = "INSERT INTO sports (usn, name, course, semester, bat, ball, other1, other2, other3, other4, other5, other6, tot_amt, class_id) 
       VALUES ('$usn','$name','$course','$sem','$bat','$ball','$o1','$o2','$o3','$o4','$o5','$o6','$final','$cid')";
	   if ($conn->query($sql) == TRUE) {
	echo "<script> 
	alert(\"Record added successfully!\");
	</script>";
} 
else 
{
    echo "Error: " . $sql . "<br>" . $conn->error;
	
}
$conn->close();
}
if(isset($_POST['search']))
{
	
	$n=$_POST['usn'];
	$a="select usn,name,sem,course from student where usn = '$n'";
$b= $conn->query($a);
if ($n == -1)
{
	
	echo "<script type='text/javascript'>alert(\"Please select USN\");</script>";
		 header( "refresh:0;url=nodue_sports.php" );
}
$mn=mysqli_query($conn,"select class_id from student where usn='$n' ");
$mno=mysqli_fetch_assoc($mn);
?>
<html>
<head>
<style>
body{
	font-family:Verdana ;
		font-size: 22px;
	background-image: URL("bd12.jpg");
	background-size: 100%;
}
</style>
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

	function Bat()
	{
		var checkBox = document.getElementById("bat");
		//var text = document.getElementById("text");
		if (checkBox.checked == true)
		{
			one.style.display = "inline-block";
			document.getElementById('id1').value=700;
		} 
		else 
		{
			one.style.display = "none";
		}
	}

	function Ball() 
	{
		var checkBox = document.getElementById("bal");
		//var text = document.getElementById("text");
		if (checkBox.checked == true)
		{
			two.style.display = "inline-block";
			document.getElementById('id2').value=100;
		} 
		else
		{
			two.style.display = "none";
		}
	}
	function more() 
	{
		var checkBox = document.getElementById("mor");
		var text = document.getElementById("text");
		if (checkBox.checked == true)
		{
			three.style.display = "inline-block";
		} 
		else 
		{
			three.style.display = "none";
		}
	}
	function more1()
	{
		var checkBox = document.getElementById("mor1");
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
	function calculate()
	{
			var a = parseInt(document.getElementById('id1').value);
			var b = parseInt(document.getElementById('id2').value);
			var c = parseInt(document.getElementById('id3').value);
			var d = parseInt(document.getElementById('id4').value);
			var e = parseInt(document.getElementById('id5').value);
			
			var f =  a + b + c + d + e ;

	
			document.getElementById('id6').value = f ;
	}
</script>
</head>
<body><center>

<h2><br>Sports Due</h2>
<form action="nodue_sports.php" method="POST">
	<table border="1">
<tr><td align='center'>Name: </td>
<td><input type = "text" name="name" value=" <?php while($row1 = mysqli_fetch_assoc($b))
{
echo $row1['name'];

 ?>" >

<tr><td align='center'>Semester: </td>
<td><input name="sem" type = "text" value=" <?php 
echo $row1['sem'];

 ?>" >
<tr><td align='center'>Course: </td>
<td><input type = "text" name="course" value=" <?php 
echo $row1['course'];
}
 ?>" >
</tr>
<tr><td align="center">USN:</td>
<td><input type="text" name="usn" value="<?php echo $n; ?>"></td></tr>

<tr><td align="center">Class ID:</td>
<td><input type="text" name="cid" value="<?php echo $mno['class_id']; ?>"></td></tr>

<tr><td>Dues:</td></tr><br>
	<tr><td><input type="checkbox" id="bat"  onclick="Bat()">Cricket Bat</td>
	<td><div id="one" style="display:none">
	<input type="text" name="bat" id="id1" value="0" >
	</td></div>
	<tr><td><input type="checkbox" id="bal"  onclick="Ball()">Cricket Ball</td>

	<td><div id="two" style="display:none">
	<input type="text" name="ball"  id="id2" value="0">
	</div></td></tr>
	<tr><td>Others:<input type="checkbox" id="myCheck"  onclick="myFunction()">

	<td><div id="t" style="display:none">
		<input type="text" name="other1" placeholder="Specify the Due"><br/>
		<input type="text" name="other2" id="id3" placeholder="specify the amount" value="0">
		<input type="checkbox" id="mor" onclick="more()">More
	<div id="three" style="display:none">
		<input type="text" name="other3"  placeholder="specify the due"><br>
		<input type="text" name="other4" id="id4" value="0" placeholder="specify the amount">
		<input type="checkbox" id="mor1" onclick="more1()">More
	<div id="four" style="display:none">
		<input type="text" name="other5" placeholder="Specify the Due"><br/>
		<input type="text" name="other6" id="id5" value="0" placeholder="specify the amount">
	</div>
	</div>
	</div></td></tr>

	<tr><td>Total fine amount:</td><td><input type="text" name="final_amount3" id="id6" placeholder="Final amount" required></tr>
	<tr><td colspan="2" align="center"><input type="button" name="cal" value="Calculate the total fine" onclick="calculate()" class="btn btn-link"></td></tr>
	<tr><td colspan="3" align="center"><button type="submit" name="submit3" value="submit" class="btn btn-link">submit<br/>
	<button type="reset" name="reset1" value="reset" class="btn btn-link">reset
	</table>
	</form>
	</center>
	<?php
}
?>
<center>
<head>
<style>
body{
	font-family:Verdana ;
		font-size: 22px;
	background-image: URL("bd12.jpg");
	background-size : 100% 100%;
}
</style>
</head>
<form action="nodue_sports.php" method="post">
<TABLE BORDER="0">
<tr><td align="center">USN: </td>
<td>
	<select name="usn" class="form-control">
	<option value="-1">--select--</option>
	<?php

	// Create connection
$conn = new mysqli('localhost','root','','nms');
	$sql = mysqli_query($conn, "SELECT usn FROM student");
	$row = mysqli_num_rows($sql);
	while ($row = mysqli_fetch_array($sql)){
	echo "<option value='". $row['usn'] ."'>" .$row['usn'] ."</option>" ;
	
	}
	
	?> 								
								
</select>
</td>
<br/>
<td colspan="2" align="center"><input type="submit" name="search" value="Search" class="btn btn-default">	</td></tr>
</table>
</form>	

 <?php
 if ($_SESSION['type'] == "admin")
 {
	 ?>
	 <a href="nodue_menu.php"><center><button type="button" value="Back" class="btn btn-primary" />Back </button></a></center>
	 <?php
 }
 if ($_SESSION['type'] == "sports")
 {
	 ?>
	 <a href="nodue_sportsmenu.php"><center><button type="button" value="Back" class="btn btn-primary" />Back </button></a></center>
	 
	 <?php
 }
 ?>

</center>
</body>
</html>
</body>
</html> 

