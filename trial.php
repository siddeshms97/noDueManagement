<?php

include 'boot.php';

//db details
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'nms';

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
	
<body>
<form action="trial.php" method="post">
<table border="1">
<tr><td align='center'>Name: </td>
<td><input type = "text" name="name" value=" <?php while($row1=mysqli_fetch_assoc($b))
{
echo $row1['name'];

 ?>" >

<tr><td align='center'>Semester: </td>
<td><input type = "text" value=" <?php 
echo $row1['sem'];

 ?>" >
<tr><td align='center'>Course: </td>
<td><input type = "text" value=" <?php 
echo $row1['course'];
}
 ?>" >
 <!--<tr><td align="center">USN:</td>
<td><input type="text" name="usn" value="<?php echo $n;?>"></td></tr>
<tr><td align="center">name:</td>
<td><input type="text" name="isbn" placeholder="name" required></td></tr>
<tr><td align="center">sem:</td>
<td><input type="date" name="sem" required></td></tr>
<tr><td align="center">course: </td>
<td><input type="date" name="course" required></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="submit" class="btn btn-primary">
<input type="button" value="Cancel" name="cancel" onclick=" <?php //header("url=issue.php"); ?> " class="btn btn-warning">
</td></tr>-->

</TABLE>
</form>
<form action="nodue_issue.php" method="post">

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
