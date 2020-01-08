<?php
//include 'conn.php';
session_start();
include 'boot.php';
$conn = new mysqli('localhost','root','','nms');
if (isset($_POST['submit']))
{		
	
$usn=$_POST['usn'];
//$name=$POST['name'];
$course=$_POST['course'];
$sem=$_POST['sem'];
$days=$_POST['days'];
$total=$_POST['due'];
$name=$_POST['name'];
$cid=$_POST['cid'];
$a = "INSERT INTO dues (usn,name,course,sem,days,total, class_id) values ('$usn','$name','$course','$sem','$days','$total','$cid') ";
$b=$conn->query($a);

$j1= "delete from status where usn= '$usn'";
$j2= $conn->query($j1);


?>
<div class="alert alert-warning" align="center">
	<strong>Fine amount stored for <?php echo $name ?> succesfully</strong>
	</div>
<?php

header("refresh:3; url=noduelib_fee.php");
}


if (isset($_POST['search']))
{
$usn=$_POST['ddusn'];

if (!$usn || $usn == -1)
{
	echo "<script type='text/javascript'>alert(\"Invalid USN selected\");</script>";
	header("refresh:0;url=noduelib_fee.php");
}

$a="select * from student where usn = '$usn'";
	$b= $conn->query($a);
?>

<html>
<body> 
<center>

<!----------------------------------------------------->

<form action="noduelib_fee.php" method="post">
<br/><br/>
	<table border="1">
<tr><td align='center'>Name: </td>
<td><input type = "text" name = "name" value=" <?php while($row1=mysqli_fetch_assoc($b))
{
echo $row1['name'];

 ?>" >

<tr><td align='center'>Semester: </td>
<td><input type = "text" name="sem" value=" <?php 
echo $row1['sem'];

 ?>" >
<tr><td align='center'>Course: </td>
<td><input type = "text" name="course" value=" <?php 
echo $row1['course'];
}
 ?>" >
</TR>

<tr><td align="center">USN:</td>
<td><input type="text" name="usn" required value="<?php echo $usn;?>"></td></tr>
<?php
$c = "select isbn,i_date,r_date from lib_data where usn= '$usn'";
$d= $conn->query($c);
$mn=mysqli_query($conn,"select class_id from student where usn='$usn' ");
$mno=mysqli_fetch_assoc($mn);
while ($e=mysqli_fetch_assoc($d))
{
?>

<tr><td align="center">Class ID:</td>
<td><input type="text" name="cid" value="<?php echo $mno['class_id']; ?>"></td></tr>
<tr><td align="center">ISBN: </td>
<td>
	<select name="isbn" class="form-control">
	<option value="-1"></option>
	<?php
	$sql = mysqli_query($conn, "SELECT distinct isbn FROM lib_data where usn='$usn'");
	$row = mysqli_num_rows($sql);
	while ($row = mysqli_fetch_array($sql)){
	echo "<option value='". $row['isbn'] ."'>" .$row['isbn'] ."</option>" ;
	
	}
	?> 								
								
</select></tr>


<!--
<tr><td align="center">ISBN:</td>
<td><input type="text" name="isbn" value=" <?php echo $e['isbn'];  ?> "></td></tr>
-->



<tr><td align="center">Issue Date:</td>
<td><input type="text" name="idate" value=" <?php echo $e['i_date'];  ?> "></td></tr>
<tr><td align="center">Return Date: </td>
<td><input type="text" name="rdate" value=" <?php echo $e['r_date'];  ?> "></td></tr>

<?php

$f = "select r_date from status where usn= '$usn'";
$g= $conn->query($f);
while ($h=mysqli_fetch_assoc($g))
{
?>
<tr>
<td>Returned on:</td>
<td><input type="text" name="returned" value=" <?php echo $h['r_date']; ?> "></td></tr>

<?php
/*echo $e['r_date'];
echo $h['r_date'];
*/
$ret_date = strtotime($e['r_date']);
$reted_date = strtotime($h['r_date']);
//echo $ret_date . $reted_date;
$diff= 	$reted_date - $ret_date;
$days=floor($diff/(60*60*24));
 $due=0;
if($days <= 5)
{
	$due = $due + $days ;
}

if($days > 5)
{
	$due = $due + (($days - 5) * 10+ 5) ;
}

?>
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
<tr><td align="center">Days: </td>
<td><input type="text" name="days" value="<?php echo $days;
?>"></td></tr>

<tr><td align="center">Total Due: </td>
<td><input type="text" name="due" value="<?php echo $due;
}}?>"></td></tr>


<tr><td colspan="2" align="center"><input type="submit" value="Submit" name="submit" class="btn btn-primary">
</td></tr>
<?php } ?>



</TABLE>
</center>

</form>


<!------------------------->

<center>
<h2 style="font-family: verdana;"> Library Books Due </h2><br/>
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
<form action="noduelib_fee.php" method="post">
<table border="0">
<tr><td align="center"> USN: </td>
<td>
	<select name="ddusn" class="form-control">
	<option value="-1">--Select--</option>
	<?php
		$x= "select usn from status ";
	$y=$conn->query($x);
	while($z=mysqli_fetch_assoc($y))
	{
	$sql = mysqli_query($conn, "SELECT distinct '$z' FROM lib_data ");
	$row = mysqli_num_rows($sql);
	while ($row = mysqli_fetch_array($sql)){
	echo "<option value='". $z['usn'] ."'>" .$z['usn'] ."</option>" ;
	}
	}
	?> 								
								
</select>
<td colspan="2" align="center">
<input type="submit" value="Search" name="search" class="btn btn-default">

</td></tr>
</table>
	

</form>

</body>
</center>
<?php
 if ($_SESSION['type'] == "admin")
 {
	 ?>
	 <a href="nodue_menu.php"><center><button type="button" value="Back" class="btn btn-primary" />Back </button></a></center>
	 <?php
 }
 if ($_SESSION['type'] == "lib")
 {
	 ?>
	 <a href="nodue_libmenu.php"><center><button type="button" value="Back" class="btn btn-primary" />Back </button></a></center>
	 
	 <?php
 }
 ?>
</body>

</html>