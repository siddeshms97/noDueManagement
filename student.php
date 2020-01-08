<?php
session_start();
//include 'conn.php';
include 'boot.php';

$conn = new mysqli('localhost','root','','nms');
$usn = $_SESSION["usn"];

//echo $usn;		

$a="select * from final_due where usn = '$usn'";
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
	background-size: 100% 100%;
}
</style>
</head>
<body >
<center>

<!----------------------------------------------------->

<form action="nodue_finaldue.php" method="post">

<h4> <a href="logout.php"><span class="glyphicon glyphicon-user pull-right" style="cursor:pointer;left:-20;"> LOGOUT </h4></span></a><br/>
<h1 style ="font-family:Lucida Calligraphy;">Final Due </h1>
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







</TABLE>
</center>
<h2><u>Notice</u></h2>
<h3 style=font-size:16px;>*Last day to pay the due amount is 9-05-2018,failed to do so<span style= color:red;>  HALLTICKET WILL NOT BE ISSUED!!</span></h3>
</form>


<!------------------------->


</body>
</html>