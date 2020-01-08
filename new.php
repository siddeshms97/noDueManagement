<?php

include 'boot.php';

//db details
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'nms';

//Connect and select the database
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['search']))
{
	//echo "true";
	//$usn=$_POST['usn'];
	//$name=$_POST['name'];
	//echo $usn;
	$n=$_POST['usn'];
	$a="select usn,name,sem,course from student where usn = '$n'";
	$b= $conn->query($a);
}
?>
<html>
<body>
<form action="new.php" method="post">
<table border="1">
<tr><td>Name</td>
<td><input type="text" value=" <?php while($row1=mysqli_fetch_assoc($b))
{
echo $row1['name'];
}
 ?>" ></td></tr>

 
<tr><td>sem</td>
<td><input type="text" value="<?php while($row1=mysqli_fetch_assoc($b))
{
echo $row1['sem'];
}
 ?>" ></td></tr>
 
 
<tr><td>course</td>
<td><input type="text" value="<?php while($row1=mysqli_fetch_assoc($b))
{
echo $row1['course'];
}
 ?>" ></td></tr>
</table>
</form>
<form action="new.php" method="post">

<TABLE BORDER="0">
<tr><td align="center">USN:</td>
<td>
	<select name="usn" class="form-control">
	<option value="-1">--select--</option>
	<?php
	
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
</body>
</html>