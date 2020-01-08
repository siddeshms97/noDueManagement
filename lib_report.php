<?php
session_start();

include 'boot.php';
//include 'conn.php';
// Create connection
$conn = new mysqli('localhost','root','','nms');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>NMS</title>

<style>
body{
	font-size:14px;
}

h1{
	font-size:22px;
	text-decoration: underline;
}
h2{
	font-size:22px;
}

</style>
</head>

<body>
<h1><center><b><u>Library Report</u></b></center></h1>
	<div class="panel panel-default">
	<div class="panel panel-heading">
		<!--<a href="report.php"><button type="button" value="Back" class="btn btn-default pull-left" />Back </button></a>-->
	<h1>
	</h1>
	<div class="panel panel-body">
	<form>

	<table class="table table-striped">
			<tr>
			<th>SL NO</th> <th>USN</th> <th>Name</th><th>Course</th><th>Sem</th><th>Days</th><th>Total</th>
			</tr>
			<?php
	
	$sub1 = mysqli_query($conn,"select * from dues");
	if($sub1)
{

	$count=0;
	$counter=0;
	
	while($row=mysqli_fetch_array($sub1))
	{
		$count++;
	?>
	
	<tr>
	<td> <?php echo $count; ?> </td>
	<td> <?php echo $row['usn']; ?> </td>
		<input type="hidden" value="<?php echo $row['usn']; ?>" name="usn[]" />
		
		<td> <?php echo $row['name']; ?> </td>
		<input type="hidden" value="<?php echo $row['name']; ?>" name="name[]" />
		
	
	<input type="hidden" value="<?php echo $row['course']; ?>" name="course[]" />
	<td> <?php echo $row['course']; ?> </td>
	
	<input type="hidden" value="<?php echo $row['sem']; ?>" name="sem[]" />
	<td> <?php echo $row['sem']; ?> </td>
	
		<input type="hidden" value="<?php echo $row['days']; ?>" name="days[]" />
		<td> <?php echo $row['days']; ?> </td>


	<td> <?php echo $row['total']; ?> </td>
		<input type="hidden" value="<?php echo $row['total']; ?>" name="total[]" />

	
	</tr>
	
	<?php 
	$counter++;
	}
	?>
	<tr><td colspan="4" align="center">

	</td></tr>
	</table>
	</form>
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
 ?>		</div>
	</div>
	</div>
	</div>
	
	
	<?php	
}
?>
<?php
{
if (isset($_POST['search']))
{
	//echo "fwF";
	
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>NMS</title>

<style>
body{
	font-size:14px;
}

h1{
	font-size:22px;
}
h2{
	font-size:22px;
	font-family: verdana;
}

</style>
</head>

<body>
<!--<h1><center><b><u>Final Report</u></b></center></h1>-->
<h1><center><b><u>Library Report</u></b></center></h1>
	<div class="panel panel-default">
	<div class="panel panel-heading">
		<!--<a href="report.php"><button type="button" value="Back" class="btn btn-default pull-left" />Back </button></a>-->
	<h1>
	</h1>
	<div class="panel panel-body">
	<form>

	<table class="table table-striped">
			<tr>
			<th>SL NO</th> <th>USN</th> <th>Name</th><th>Course</th><th>Sem</th><th>Days</th><th>Total</th>
			</tr>
			<?php
	
	
	
	$cid=$_POST['class_id'];
	$sub = mysqli_query($conn,"select * from dues where class_id = '$cid'");
	if($sub)
{

	$count=0;
	$counter=0;
	
	while($row=mysqli_fetch_array($sub))
	{
		$count++;
	?>
	
	<tr>
	<td> <?php echo $count; ?> </td>
	<td> <?php echo $row['usn']; ?> </td>
		<input type="hidden" value="<?php echo $row['usn']; ?>" name="usn[]" />
		
		<td> <?php echo $row['name']; ?> </td>
		<input type="hidden" value="<?php echo $row['name']; ?>" name="name[]" />
		
	
	<input type="hidden" value="<?php echo $row['course']; ?>" name="course[]" />
	<td> <?php echo $row['course']; ?> </td>
	
	<input type="hidden" value="<?php echo $row['sem']; ?>" name="sem[]" />
	<td> <?php echo $row['sem']; ?> </td>
	
		<input type="hidden" value="<?php echo $row['days']; ?>" name="days[]" />
		<td> <?php echo $row['days']; ?> </td>


	<td> <?php echo $row['total']; ?> </td>
		<input type="hidden" value="<?php echo $row['total']; ?>" name="total[]" />

	
	</tr>
	<?php 
	$counter++;
}
	?>
	<tr><td colspan="4" align="center">

	</td></tr>
	</table>
	</form>
	</div>
	</div>
	</div>
	
	
	<?php	
}
}
?>
<?php
}
?>

<html>
<head>
<title>Report</title>
</head>
<body align="center"><br><br><br><br>
<form action="lib_report.php" method="post">


<br>
<br>
<h2><b>Select class</b></h2>
<table border="0" align="center">
<tr><td>Class</td><td>
<select name="class_id">
<option value="bca2">BCA2</option>
<option value="bba2">BBA2</option>
<option value="bca4">BCA4</option>
<option value="bba4">BBA4</option>
<option value="bca6">BCA6</option>
<option value="bba6">BBA6</option>
</select></td></tr>
<!--<tr><td>Semester</td><td>
<select>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
</select></td></tr>-->
</table>
<br/>
<input type="submit" name="search" value="Search" class="btn btn-default">
</form>
<?php
?>
</html>
