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
	font-size:16px;
}

</style>
</head>

<body>
<h1><center><b><u>Sports Report</u></b></center></h1>
	<div class="panel panel-default">
	<div class="panel panel-heading">
		<!--<a href="report.php"><button type="button" value="Back" class="btn btn-default pull-left" />Back </button></a>-->
	<h1>
	</h1>
	<div class="panel panel-body">
	<form>

	<table class="table table-striped">
			<tr>
			<th>SL NO</th> <th>USN</th> <th>Student Name</th><th>Course</th><th>Semester</th><th>Bat</th><th>Ball</th>
			<th>Other Due</th><th>Amount</th><th>Other Due</th><th>Amount</th><th>Other Due</th><th>Amount</th><th>Total Amount</th>
			</tr>
			<?php
	
	$sub1 = mysqli_query($conn,"select * from sports");
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

	<td> <?php echo $row['course']; ?> </td>
		<input type="hidden" value="<?php echo $row['$course']; ?>" name="course[]" />

	<td> <?php echo $row['semester']; ?> </td>
		<input type="hidden" value="<?php echo $row['semester']; ?>" name="sem[]" />
	
	<td> <?php echo $row['bat']; ?> </td>
		<input type="hidden" value="<?php echo $row['bat']; ?>" name="course[]" />
		<td> <?php echo $row['ball']; ?> </td>
		<input type="hidden" value="<?php echo $row['ball']; ?>" name="course[]" />
		
		<td> <?php echo $row['other1']; ?> </td>
		<input type="hidden" value="<?php echo $row['other1']; ?>" name="course[]" />
		<td> <?php echo $row['other2']; ?> </td>
		<input type="hidden" value="<?php echo $row['other2']; ?>" name="course[]" />
		<td> <?php echo $row['other3']; ?> </td>
		<input type="hidden" value="<?php echo $row['other3']; ?>" name="course[]" />
		<td> <?php echo $row['other4']; ?> </td>
		<input type="hidden" value="<?php echo $row['other4']; ?>" name="course[]" />
		<td> <?php echo $row['other5']; ?> </td>
		<input type="hidden" value="<?php echo $row['other5']; ?>" name="course[]" />
		<td> <?php echo $row['other6']; ?> </td>
		<input type="hidden" value="<?php echo $row['other6']; ?>" name="course[]" />
		<td> <?php echo $row['tot_amt']; ?> </td>
		<input type="hidden" value="<?php echo $row['tot_amt']; ?>" name="course[]" />
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
 if ($_SESSION['type'] == "sports")
 {
	 ?>
	 <a href="nodue_sportsmenu.php"><center><button type="button" value="Back" class="btn btn-primary" />Back </button></a></center>
	 
	 <?php
 }
 ?>	
	</div>
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
<h1><center><b><u>Sports Report</u></b></center></h1>
	<div class="panel panel-default">
	<div class="panel panel-heading">
		<!--<a href="report.php"><button type="button" value="Back" class="btn btn-default pull-left" />Back </button></a>-->
	<h1>
	</h1>
	<div class="panel panel-body">
	<form>

	<table class="table table-striped">
			<tr>
			<th>SL NO</th> <th>USN</th> <th>Student Name</th><th>Course</th><th>Semester</th><th>Bat</th><th>Ball</th>
			<th>Other Due</th><th>Amount</th><th>Other Due</th><th>Amount</th><th>Other Due</th><th>Amount</th><th>Total Amount</th>
			</tr>
			<?php
	
	
	
	$cid=$_POST['class_id'];
	$sub = mysqli_query($conn,"select * from sports where class_id = '$cid'");
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

	<td> <?php echo $row['course']; ?> </td>
		<input type="hidden" value="<?php echo $row['$course']; ?>" name="course[]" />

	<td> <?php echo $row['semester']; ?> </td>
		<input type="hidden" value="<?php echo $row['semester']; ?>" name="sem[]" />
	
	<td> <?php echo $row['bat']; ?> </td>
		<input type="hidden" value="<?php echo $row['bat']; ?>" name="course[]" />
		<td> <?php echo $row['ball']; ?> </td>
		<input type="hidden" value="<?php echo $row['ball']; ?>" name="course[]" />
		
		<td> <?php echo $row['other1']; ?> </td>
		<input type="hidden" value="<?php echo $row['other1']; ?>" name="course[]" />
		<td> <?php echo $row['other2']; ?> </td>
		<input type="hidden" value="<?php echo $row['other2']; ?>" name="course[]" />
		<td> <?php echo $row['other3']; ?> </td>
		<input type="hidden" value="<?php echo $row['other3']; ?>" name="course[]" />
		<td> <?php echo $row['other4']; ?> </td>
		<input type="hidden" value="<?php echo $row['other4']; ?>" name="course[]" />
		<td> <?php echo $row['other5']; ?> </td>
		<input type="hidden" value="<?php echo $row['other5']; ?>" name="course[]" />
		<td> <?php echo $row['other6']; ?> </td>
		<input type="hidden" value="<?php echo $row['other6']; ?>" name="course[]" />
		<td> <?php echo $row['tot_amt']; ?> </td>
		<input type="hidden" value="<?php echo $row['tot_amt']; ?>" name="course[]" />
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
<form action="sports_report.php" method="post">

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


