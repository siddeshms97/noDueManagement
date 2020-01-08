<?php
session_start();
include 'boot.php';
$conn = new mysqli('localhost','root','','nms');

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
<h1><center><b><u>Final Report</u></b></center></h1>
	<div class="panel panel-default">
	<div class="panel panel-heading">
		<!--<a href="report.php"><button type="button" value="Back" class="btn btn-default pull-left" />Back </button></a>-->
	<h1>
	</h1>
	<div class="panel panel-body">
	<form>

	<table class="table table-striped">
			<tr>
			<th>SL NO</th>  <th>Student Name</th><th>Semester</th><th>Course</th><th>USN</th><th>Library Due</th><th>Lab Due</th>
			<th>Infra Due</th><th>Sports Due</th><th>Fee Due</th><th>Common Due</th><th>Grand Total</th>
			</tr>
			<?php
	
	
	
	$cid=$_POST['class_id'];
	$sub = mysqli_query($conn,"select * from final_due where class_id = '$cid'");
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
	
	
	<td> <?php echo $row['name']; ?> </td>
		<input type="hidden" value="<?php echo $row['name']; ?>" name="name[]" />
		
			<td> <?php echo $row['sem']; ?> </td>
		<input type="hidden" value="<?php echo $row['sem']; ?>" name="sem[]" />
		

	<td> <?php echo $row['course']; ?> </td>
		<input type="hidden" value="<?php echo $row['course']; ?>" name="course[]" />


		
				<td> <?php echo $row['usn']; ?> </td>
		<input type="hidden" value="<?php echo $row['usn']; ?>" name="usn[]" />
	
	<td> <?php echo $row['lib_due']; ?> </td>
		<input type="hidden" value="<?php echo $row['lib_due']; ?>" name="course[]" />
		
		<td> <?php echo $row['lab_due']; ?> </td>
		<input type="hidden" value="<?php echo $row['lab_due']; ?>" name="course[]" />
		
		<td> <?php echo $row['infra_due']; ?> </td>
		<input type="hidden" value="<?php echo $row['infra_due']; ?>" name="course[]" />
		
		<td> <?php echo $row['sports_due']; ?> </td>
		<input type="hidden" value="<?php echo $row['sports_due']; ?>" name="course[]" />
		
		<td> <?php echo $row['fee_due']; ?> </td>
		<input type="hidden" value="<?php echo $row['fee_due']; ?>" name="course[]" />
		
		<td> <?php echo $row['comm_due']; ?> </td>
		<input type="hidden" value="<?php echo $row['comm_due']; ?>" name="course[]" />
		
		<td> <?php echo $row['tot_due']; ?> </td>
		<input type="hidden" value="<?php echo $row['tot_due']; ?>" name="course[]" />
		
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
 if ($_SESSION['type'] == "hod")
 {
	 ?>
	 <a href="nodue_hodmenu.php"><center><button type="button" value="Back" class="btn btn-primary" />Back </button></a></center>
	 
	 <?php
 }
 ?>	
	</div>
	</div>
	</div>
	
	
	<?php	
}
}
?>




<html>
<head>
<title>Report</title>



</head>
<body align="center"><br><br><br><br>
<form action="nodue_report.php" method="post">

<h2>Report Generation</h2>
<br>
<br>
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

</body>
</html>