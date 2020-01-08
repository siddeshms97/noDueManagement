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
	{	$name=$_POST['name'];
		$usn = $_POST['usn'];
		$isbn = $_POST['isbn'];
		$idate = $_POST['idate'];
		$rdate = $_POST['rdate'];
		$cid=$_POST['cid'];
		
		$u1 = mysqli_query($conn,"select usn from lib_data where usn = '$usn'");
		if ($u1)
		{
		//$u2 =  mysqli_query($conn,"delete from lib_data where usn = '$usn'");
		//echo "done";
		}
		
		$a = "insert into lib_data (usn , isbn, i_date, r_date, class_id) values ('$usn','$isbn','$idate','$rdate','$cid')";
		$b = $conn->query($a);
			
		$no="no";
		
		$c = "insert into status (usn , isbn, returned ) values ('$usn','$isbn','$no')";
		$d = $conn->query($c);
		
		if ($d) 
		{	//$msg = "Added Successfully :)";
			//echo "<script type='text/javascript'>alert(\"$msg\");</script>";
		?>
		<div class="alert alert-info" align="center">
	<strong>Book taken by <?php echo $name ?> </strong>
	</div>
<?php
		header("refresh:3; url=nodue_issue.php");
		}	
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
	if ($n == -1)
{
	
	echo "<script type='text/javascript'>alert(\"Please select USN\");</script>";
		 header( "refresh:0;url=nodue_issue.php" );
}
	$mn=mysqli_query($conn,"select class_id from student where usn='$n' ");
$mno=mysqli_fetch_assoc($mn);
?>

<head>
<style>
body{
	font-family:Verdana ;
		font-size: 22px;
	background-image: URL("bd12.jpg");
	background-size: 100% 100%;
}
</style>
<script>

</script>
</head>
<body>

<br/><br/>
<center>
<h2 style="font-family: verdana;"> Library Books Issue </h2>

<form action="nodue_issue.php" method="post" name="myform"> 
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

<tr><td align="center">Class ID:</td>
<td><input type="text" name="cid" value="<?php echo $mno['class_id']; ?>"></td></tr>


<tr><td align="center">ISBN:</td>
<td><input type="text" name="isbn" placeholder="Enter the ISBN number" required id="i"></td></tr>
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


<form action="nodue_issue.php" method="post" name="myform">

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
<td colspan="2" align="center"><input type="submit" name="search" value="Search" class="btn btn-default" onclick="ValidateForm(this.form)">	</td></tr>
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