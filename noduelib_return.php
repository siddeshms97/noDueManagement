<?php
//include 'conn.php';
session_start();
include 'boot.php';
$conn = new mysqli('localhost','root','','nms');
if (isset($_POST['return']))
{
$usn=$_POST['usn'];
$date= date("Y-m-d") ;
$name=$_POST['name'];
$cid=$_POST['cid'];

/*$u1 = mysqli_query($conn,"select usn from status where usn = '$usn'");
		if ($u1)
		{
		$u2 =  mysqli_query($conn,"delete from status where usn = '$usn'");
		echo "done";
		}


/*
$msg = "Are you sure? :|";
$m = "<script type='text/javascript'>confirm(\"$msg\");</script>";
echo $m;
if($m == true)
{*/
$a = "update status set returned = 'yes',r_date='$date' where usn='$usn' ";
$b=$conn->query($a);
?>
<div class="alert alert-success" align="center">
	<strong>Book returned by <?php echo $name ?> succesfully</strong>
	</div>
<?php
/*
echo "<script type='text/javascript'>alert(\"SUCCESS\");</script>";
	}
	
else
{
		echo "<script type='text/javascript'>alert(\"FAILED\");</script>";
}*/
header("refresh:3; url=noduelib_return.php");
}


if (isset($_POST['search']))
{
$usn=$_POST['usn'];
$a="select * from student where usn = '$usn'";
	$b= $conn->query($a);
	$mn=mysqli_query($conn,"select class_id from student where usn='$usn' ");
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
</head>
<body>
<center>

<!----------------------------------------------------->

<form action="noduelib_return.php" method="post">
<br/><br/>
	<table border="1">
<tr><td align='center'>Name: </td>
<td><input type = "text" name = "name"value=" <?php while($row1=mysqli_fetch_assoc($b))
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
<td><input type="text" name="usn" placeholder="Enter the USN number" value="<?php echo $usn;?>"></td></tr>
<?php
$c = "select isbn,i_date,r_date from lib_data where usn= '$usn'";
$d= $conn->query($c);
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
<td><input type="text" name="rdate" value=" <?php echo $e['r_date']; } ?> "></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Return" name="return" class="btn btn-primary"></td></tr>
<?php } ?>



</TABLE>
</center>

</form>


<!------------------------->

<center>
<h2 style="font-family: verdana;"> Library Books Return </h2><br/>
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
<form action="noduelib_return.php" method="post">
<table border="0">
<tr><td align="center">USN: </td>
<td>
	<select name="usn" class="form-control">
	<option value="-1">--select--</option>
	<?php
		$x= "select usn from status where returned='no'";
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