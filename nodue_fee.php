<?php
session_start();
include 'boot.php';

// Create connection
$conn = new mysqli('localhost','root','','nms');

// Check connection
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['submit4']))
{
		$usn=$_POST['usn'];
		$name=$_POST['name'];
		$course=$_POST['course'];
		$sem=$_POST['sem'];
		$t=$_POST['tuitions'];
		$e=$_POST['exams'];
		$o1=$_POST['other1'];
		$o2=$_POST['other2'];
		$o3=$_POST['other3'];
		$o4=$_POST['other4'];
		$o5=$_POST['other5'];
		$o6=$_POST['other6'];
		$final=$_POST['final_amount4'];
		$cid=$_POST['cid'];
		
$sql = "INSERT INTO fee (usn, name, course, semester, tutfee, examfee, other1, other2, other3, other4, other5, other6, tot_amt, class_id) 
		VALUES ('$usn','$name','$course','$sem','$t','$e','$o1','$o2','$o3','$o4','$o5','$o6','$final','$cid')";

if ($conn->query($sql) == TRUE) {
	echo "<script> 
	alert(\"Record added successfully!\");
	</script>";
} 
else 
{
    echo "Error: " . $sql . "<br>" . $conn->error;
	
}
//$conn->close();
}
if(isset($_POST['search']))
{
	
	$n=$_POST['usn'];
	$a="select usn,name,sem,course from student where usn = '$n'";
$b= $conn->query($a);
if ($n == -1)
{
	
	echo "<script type='text/javascript'>alert(\"Please select USN\");</script>";
		 header( "refresh:0;url=nodue_fee.php" );
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
	background-size : 100% 100%;
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

		function tuition()
		{
			var checkBox = document.getElementById("tui");
			//var text = document.getElementById("text");
			if (checkBox.checked == true)
			{
				one.style.display = "inline-block";
				document.getElementById('tu').value=1000;
			}
			else		
			{
				one.style.display = "none";
			}
		}

		function exam()
		{
			var checkBox = document.getElementById("exa");
			//var text = document.getElementById("text");
			if (checkBox.checked == true)
			{
				two.style.display = "inline-block";
				document.getElementById('ex').value=500;
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
	
	
			var a = parseInt(document.getElementById('tu').value);
			var b = parseInt(document.getElementById('ex').value);
	
	
			var c = parseInt(document.getElementById('id2').value);
			var d = parseInt(document.getElementById('id4').value);
			var e = parseInt(document.getElementById('id6').value);
	
			var f =  a + b + c + d + e ;

	
			document.getElementById('id7').value = f ;
	
		}
		</script>
</head>
<body><center>
<h2><br>Fees Due</h2>
<form action="nodue_fee.php" method="POST">
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


<tr><td>Dues:</td></tr>
			<tr><td><input type="checkbox" id="tui"  onclick="tuition()">Tuition Fee</td>
				<td><div id="one" style="display:none">
				<input type="text" name="tuitions" id="tu" value="0">
				</td></div>
			</tr>

			<tr><td><input type="checkbox" id="exa"  onclick="exam()">Exam Fee</td>
				<td><div id="two" style="display:none">
				<input type="text" name="exams" id="ex" value="0">
				</td></div>
			</tr>


			<tr><td>Others:<input type="checkbox" id="myCheck"  onclick="myFunction()"></td>

				<td><div id="t" style="display:none">
					<input type="text" id="id1" name="other1" placeholder="Specify the Due"><br/>
					<input type="text" id="id2" name="other2" placeholder="specify the amount" value="0">
					<input type="checkbox" id="mor" onclick="more()">More

					<div id="three" style="display:none">
						<input type="text" id="id3" name="other3" placeholder="specify the due"><br>
						<input type="text" id="id4" name="other4" placeholder="specify the amount" value="0">
						<input type="checkbox" id="mor1" onclick="more1()">More

					<div id="four" style="display:none">
						<input type="text" id="id5" name="other5" placeholder="Specify the Due"><br/>
						<input type="text" id="id6" name="other6" placeholder="specify the amount" value="0">
					</div>
					</div>
				</div>
				</td>
			</tr>

			<div>
			
			<tr><td>Total fine amount:</td><td><input type="text" name="final_amount4" id="id7" required ></td></tr>
<tr><td colspan="2" align="center"><input type="button" name="cal" value="Calculate Total Amount" onclick="calculate()" class="btn btn-link"></td><br /></tr>
			</div>
		
		<br/>

	
	<tr><td colspan="3" align="center"><button type="submit" name="submit4" value="submit4" class="btn btn-link">submit</button>
	<button type="reset" name="reset" value="reset" class="btn btn-link">reset</button></td></tr>
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
	background-size: 100%;
}
</style>
</head>
<form action="nodue_fee.php" method="post">
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
 if ($_SESSION['type'] == "fee")
 {
	 ?>
	 <a href="nodue_feemenu.php"><center><button type="button" value="Back" class="btn btn-primary" />Back </button></a></center>
	 
	 <?php
 }
 ?>

</center>
</body>
</html>


		



