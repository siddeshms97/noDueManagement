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
	$mn=mysqli_query($conn,"select class_id from student where usn='$n' ");
$mno=mysqli_fetch_assoc($mn);
?>


<body style="background-image:URL(black.jp); background-size:100%; font-color:black;">

<br/><br/><br/><br/>
<center>
<h2 style="font-family: verdana;"> Library Books Issue </h2>

<form action="nodue_issue.php" method="post">
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
<form action="nodue_issue.php" method="post">

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

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

h4{
	font-family: Verdana;
	font-size: 20px;
}

body {
    font-family: verdana;
	background-image: URL("bd12.jpg");
	background-size: 100%;
	position: relative;
	background-stretch: 100%;
	background-repeat: repeat;

	
	}

h4:hover{ 
	color:white;
}

.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: white;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 50px;
	background-color:#464946;
	color: #c1c1c1;
}

.sidenav a {
    padding: 4px 4px 4px 4px;	
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: white;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 10px;
    font-size: 36px;
    margin-left: 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}


</style>
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times </a>
 
 <h4> <a href="nodue_libmenu.php"><span class="glyphicon glyphicon-home" style="cursor:pointer; left:20;"> HOME </h4></span></a><br/>

 <h4> <a href="nodue_lib.html"><span class="glyphicon glyphicon-asterisk" style="cursor:pointer;left:20;" > LIB </h4></span></a><br/>

 <h4> <a href="lib_report.php"><span class="	glyphicon glyphicon-blackboard" style="cursor:pointer;left:20;"> REPORT </h4></span></a><br/>
 
 <h4> <a href="logout.php"><span class="glyphicon glyphicon-user" style="cursor:pointer;left:20;"> LOGOUT </h4></span></a><br/>
 

  </div>
	
<span style="font-size:40px;cursor:pointer" onclick="openNav()">&#9776; </span>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "200px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script> 
<center>

</center></h2>    
</body>
</html> 
