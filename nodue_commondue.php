<?php
session_start();
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
{
	$cid=$_POST['id'];
	$amount=$_POST['amt'];
	//echo $cid, $amount;
	$a = "INSERT INTO common_due (class_id,amt) values ('$cid','$amount')";
$b=$conn->query($a);
if($b)
{
	echo "<script type='text/javascript'>alert(\"Record Added Successfully\");</script>";
	header("refresh:0;url=nodue_commondue.php");
}
}
?>
<html>
<head>
<style>
body {
    font-family:Verdana ;
		font-size: 22px;
	background-image: URL("bd12.jpg");
	background-size : 100% 100%;
	}
</style>
<title>
Common Due
</title>
</head>
<body align="center"><br><br><br><br><br><br>
<h2><u>Add Common Due</u></h2><br>
<form action="nodue_commondue.php" method="POST">
<table border="0" align="center">
<tr><td>Class ID:</td><td align="center">
<select name="id" class="btn btn-default" >
<option value="bca2">bca2</option>
<option value="bba2">bba2</option>
<option value="bca4">bca4</option>
<option value="bba4">bba4</option>
<option value="bca6">bca6</option>
<option value="bba6">bba6</option>
</select><br><br>
</td></tr>
<tr><td>Amount:</td><td><input type="text" class="btn btn-default" name="amt" placeholder="Enter the amount" ></td></tr>
</table><br/>
<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Submit" class="btn btn-success"></td></tr>

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

</body> 
</html>