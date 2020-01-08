<?php
session_start();
//include 'conn.php';
include 'boot.php';

$conn = new mysqli('localhost','root','','nms');
if (isset($_POST['submit']))
{
		$name=$_POST['name'];
		$sem=$_POST['sem'];
		$course=$_POST['course'];
		$usn=$_POST['usn'];
		$cid=$_POST['cid'];
		$lib_due=$_POST['lib_due'];
		$lab_due=$_POST['lab_due'];
		$infra_due=$_POST['infra_due'];
		$sports_due=$_POST['sports_due'];
		$fee_due=$_POST['fee_due'];
		$comm_due=$_POST['comm_due'];
		$tot_due=$_POST['tot_due'];
		
		
		//validation
		$r1 = mysqli_query($conn," Select usn from final_due where usn = '$usn'");
		$r2 = mysqli_fetch_array($r1);
		
		if($usn == $r2['usn'])
		{
			
			echo "<script> 
	alert(\"Record already exists!!\");
	</script>";
	header("refresh:0;url=nodue_finaldue.php");
	exit();
	
		}
		
		
		
		$sql = "INSERT INTO final_due ( name, sem, course, usn,class_id, lib_due, lab_due, infra_due, sports_due, fee_due, comm_due, tot_due) 
VALUES ('$name','$sem','$course','$usn','$cid','$lib_due','$lab_due','$infra_due','$sports_due','$fee_due','$comm_due','$tot_due')";


if ($conn->query($sql) == TRUE) {
	echo "<script> 
	alert(\"Record added successfully!\");
	</script>";
	
	//$flag=1;
}
 else
	 {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
header("refresh:0;url=nodue_finaldue.php");
}



if (isset($_POST['search']))
{
$usn=$_POST['usn'];
$a="select * from student where usn = '$usn'";
	$b= $conn->query($a);
	
	
		$s13=mysqli_query($conn,"select class_id from student where usn= '$usn' ");
	$s14=mysqli_fetch_assoc($s13);
	
	
	$s1=mysqli_query($conn,"select total from dues where usn='$usn'");
	$s2=mysqli_fetch_assoc($s1);
	//echo $s2['total'];
	
	$s3=mysqli_query($conn,"select tot_amt from infra where usn='$usn'");
	$s4=mysqli_fetch_assoc($s3);
	
	$s5=mysqli_query($conn,"select tot_amt from fee where usn='$usn'");
	$s6=mysqli_fetch_assoc($s5);
	
	$s7=mysqli_query($conn,"select tot_amt from lab where usn='$usn'");
	$s8=mysqli_fetch_assoc($s7);
	
	$s9=mysqli_query($conn,"select tot_amt from sports where usn='$usn'");
	$s10=mysqli_fetch_assoc($s9);
	
	$s11=mysqli_query($conn,"select amt from common_due where class_id='$s14[class_id]' ");
	$s12=mysqli_fetch_assoc($s11);
//		echo $s12['amt'];
	
	

	
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
</head>
<body> 
<center>

<!----------------------------------------------------->

<form action="nodue_finaldue.php" method="post">
<br/><br/>
	<table border="1">
<tr><td align='center'>Name: </td>
<td><input type = "text" name = "name" value=" <?php while($row1=mysqli_fetch_assoc($b))
{
echo $row1['name'];

 ?>" >

<tr><td align='center'>Semester: </td>
<td><input type = "text" name="sem" value= <?php 
echo $row1['sem'];

 ?>>
 
<tr><td align='center'>Course: </td>
<td><input type = "text" name="course" value=" <?php 
echo $row1['course'];
}
 ?>" >
</TR>

<tr><td align="center">USN:</td>
<td><input type="text" name="usn" placeholder="Enter the USN number" value="<?php echo $usn;?>"></td></tr>

<tr><td align="center">Class ID:</td>
<td><input type="text" name="cid" placeholder="Enter the CID number" value="
<?php 
$a="select * from student where usn = '$usn'";
$b= $conn->query($a);
$c=mysqli_fetch_assoc($b);
echo $c['class_id'];
?>"></td></tr>

<tr><td align="center">Library Due:</td>
<td><input type="text" name="lib_due" value="<?php echo $s2['total']; ?>"><td></tr>
	
<tr><td align="center">Laboratory Due:</td>
<td><input type="text" name="lab_due" value="<?php echo $s4['tot_amt']; ?>"></td></tr>

<tr><td align="center">Infrastructure Due:</td>
<td><input type="text" name="infra_due" value="<?php echo $s6['tot_amt']; ?>"></td></tr>

<tr><td align="center">Sports Due:</td>
<td><input type="text" name="sports_due" value="<?php echo $s8['tot_amt']; ?>"></td></tr>

<tr><td align="center">Fee Due:</td>
<td><input type="text" name="fee_due" value="<?php echo $s10['tot_amt']; ?>"></td></tr>

<tr><td align="center">Common Due:</td>
<td><input type="text" name="comm_due" value="<?php echo $s12['amt']; ?>"></td></tr>

<tr><td align="center">Total Due:</td>
<td><input type="text" name="tot_due" value="<?php echo $s12['amt']+$s10['tot_amt']+$s8['tot_amt']+$s6['tot_amt']+$s4['tot_amt']+$s2['total']; ?>"></td></tr>


<tr><td colspan="2" align="center"><input type="submit" value="Submit" name="submit" class="btn btn-link"></td></tr>




</TABLE>
</center>

</form>


<!------------------------->
<?php
}
?>
<center>
<h2 style="font-family: verdana;"> Final Due </h2><br/>
<style>
body{
	font-family:Verdana ;
		font-size: 22px;
	background-image: URL("bd12.jpg");
	background-size : 100% 100%;
}
</style>
<form action="nodue_finaldue.php" method="post">
<table border="0">
<tr><td align="center">USN: </td>
<td>
	<select name="usn" class="form-control">
	<option value="-1">--select--</option>
	<?php
		$x= "select usn from student";
	$y=$conn->query($x);
	while($z=mysqli_fetch_assoc($y))
	{
	echo "<option value='". $z['usn'] ."'>" .$z['usn'] ."</option>" ;
	}
	?> 								
								
</select>
<td colspan="2" align="center">
<input type="submit" value="Search" name="search" class="btn btn-default">
</td></tr>
</table>
	<br/><br/>

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