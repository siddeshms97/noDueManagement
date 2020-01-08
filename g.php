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


if(isset($_POST['submit']))
	{	$usn=$_POST['usn2'];
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
		
		$a = "INSERT INTO infra (usn, name, course, semester, chair, casing, tables, other1, other2, other3, other4, other5, other6,  tot_amt) 
VALUES ('$usn','$name','$course','$sem','$key','$mou','$moni','$o1','$o2','$o3','$o4','$o5','$o6','$final')";
		
		if ($conn->query($a) === TRUE) {
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
			
		
<?php

if(isset($_POST['search']))
{
	//echo "true";
	//$usn=$_POST['usn'];
	//$name=$_POST['name'];
	//echo $usn;
	$n=$_POST['usn'];
	$a="select usn,name,sem,course from info where usn = '$n'";
	$b= $conn->query($a);

		/*echo "<center>";
			
			/*<tr><td align='center'>Name: </td>
			<td><input type = "text" value=" <?php  echo $row['name'] ?>" ></td></tr>
		
		echo "<table border='1'>
		<tr><td align='center'>Name: </td>"; 
		echo "<td><input type = 'text' disabled value='". $row['name'] ."'></td></tr>"; echo "<br/>";echo "<br/>";
		echo "<tr><td align='center'>Semester: </td>"; 
		echo "<td><input type = 'text' value='". $row['sem'] ."'></td></tr>";echo "<br/>";echo "<br/>";
		echo "<tr><td align='center'>Course: </td>" ; 
		echo "<td><input type = 'text' value='". $row['course'] ."'></td></tr>";echo "<br/>";echo "<br/>";
		echo "<tr><td align='center'>USN: </td>" ; 
		echo "<td><input type = 'text' value='". $row['usn'] ."'></td></tr>";echo "<br/>";echo "<br/>";
		echo "</table></center><br/>";
	*/	


?>


<body style="background-image:URL(black.jp); background-size:100%; font-color:black;">

<br/><br/><br/><br/>
<center>
<h2 style="font-family: verdana;"> infra </h2>

<form action="issue.php" method="post">
<br/><br/>
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
</TR>

<tr><td align="center">USN:</td>
<td><input type="text" name="usn" value="<?php echo $n;?>"></td></tr>
<tr><td align="center">ISBN:</td>
<td><input type="text" name="isbn" placeholder="Enter the ISBN number" required></td></tr>
<tr><td align="center">Issue Date:</td>
<td><input type="date" name="idate" required></td></tr>
<tr><td align="center">Return Date: </td>
<td><input type="date" name="rdate" required></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="submit" class="btn btn-primary">
<input type="button" value="Cancel" name="cancel" onclick=" <?php //header("url=issue.php"); ?> " class="btn btn-warning">
</td></tr>

</TABLE>
</form>
<?php } ?>
<center>
<h2 style="font-family: verdana;"> Library Books Issue </h2>
<form action="issue.php" method="post">

<TABLE BORDER="0">
<tr><td align="center">USN:</td>
<td>
	<select name="usn" class="form-control">
	<option value="-1">--select--</option>
	<?php
	
	$sql = mysqli_query($conn, "SELECT usn FROM student where usn not in(select usn from status where returned='no')");
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

</center>
</body>