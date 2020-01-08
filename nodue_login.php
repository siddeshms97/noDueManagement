<?php
session_start();

if (isset($_POST['login']))
{
		$user=$_POST['username'];
		$pass=$_POST['password'];
		$flag=0;
		$_SESSION['username']=$user;
		
		
// Create connection
$conn = new mysqli('localhost','root','','nms');


// Check connection
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM login WHERE uname='".$user."' and pass='".$pass."'";
$result = $conn->query($sql);

$sql1 = ("select type from login where uname='".$user."' and pass='".$pass."' ");
$res = $conn->query($sql1);
$r=mysqli_fetch_assoc($res);

	$_SESSION['type']=$r['type'];
	
if($r['type'] == "admin")	//SHOULD BE ADMIN
{

	//echo $_SESSION['type'];
if (mysqli_num_rows($result) > 0)
	{
		
		$msg="Login Successfull!";
		echo "<script type='text/javascript'>alert(\"$msg\");</script>";
		 header( "refresh:0;url=nodue_menu.php" ); 

	}
}
else
if ($r['type'] == "lib")
	{
			$msg="Login Successfull!";
		echo "<script type='text/javascript'>alert(\"$msg\");</script>";
		header( "refresh:0;url=nodue_libmenu.php" );
	}
else	if ($r['type'] == "lab")
	{
			$msg="Login Successfull!";
		echo "<script type='text/javascript'>alert(\"$msg\");</script>";
		header( "refresh:0;url=nodue_labmenu.php" );
	}
else	if ($r['type'] == "sports")
	{
			$msg="Login Successfull!";
		echo "<script type='text/javascript'>alert(\"$msg\");</script>";
		header( "refresh:0;url=nodue_sportsmenu.php" );
		
	}
else	if ($r['type'] == "infra")
	{
			$msg="Login Successfull!";
		echo "<script type='text/javascript'>alert(\"$msg\");</script>";
		header( "refresh:0;url=nodue_inframenu.php" );
	}
else	if ($r['type'] == "fee")
	{
			$msg="Login Successfull!";
		echo "<script type='text/javascript'>alert(\"$msg\");</script>";
		header( "refresh:0;url=nodue_feemenu.php" );
	}
else	if ($r['type'] == "hod")
	{
			$msg="Login Successfull!";
		echo "<script type='text/javascript'>alert(\"$msg\");</script>";
		header( "refresh:0;url=nodue_hodmenu.php" );
	}

/*else
{	
		
		$msg="Invalid Login!!";
		echo "<script type='text/javascript'>alert(\"$msg\");</script>";
		 header( "refresh:0;url=nodue_login.php" );

}
	*/$conn->close();
}	





////////STUDENT LOGIN//////////////

if (isset($_POST['go']))
{		

		$usn=$_POST['usn'];
		$_SESSION["usn"] = $usn;
		$flag=0;
		
// Create connection
$conn = new mysqli('localhost','root','','nms');

// Check connection
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$usn1 = mysqli_query($conn,"select usn from student where usn = '$usn' ");	
$usn2 = mysqli_fetch_assoc($usn1);
if ($usn2['usn'] != $usn) 
{	
		$flag=0;
		$msg="Invalid Login!!";
		echo "<script type='text/javascript'>alert(\"$msg\");</script>";
		 header( "refresh:0;url=nodue_login.php" );
		 exit();

}
 if ($usn2['usn'] == $usn)
 {


$sql = "SELECT * FROM final_due WHERE usn='".$usn."'"; 
$result = $conn->query($sql);
$res1=mysqli_fetch_array($result);

	if(mysqli_num_rows($result) > 0 )
	{
		
		$z1= mysqli_query($conn,"Select amt from common_due where class_id = '$res1[class_id]' " );
		$z2=mysqli_fetch_array($z1);
		$_SESSION["com_due"] =  $z2['amt'];
		echo "<script type='text/javascript'>alert(\"Student Login Successful!!!\");</script>";
		header( "refresh:0;url=student.php" );	
		exit();
		
	}

$sql2 = mysqli_query($conn,"select class_id from student where usn= '$usn'");
$sql3 = mysqli_fetch_assoc($sql2);

$sql4 = mysqli_query($conn,"select amt from common_due where class_id= '$sql3[class_id]' ");
$sql5 = mysqli_fetch_assoc($sql4);

if (mysqli_num_rows($sql4) )
{
	$flag = 1;
	$_SESSION["flag"] = $flag;
	echo ('<script type="text/javascript">alert("The amount to be paid is: ');echo($sql5['amt']);ECHO(' ") </script>');
	 header( "refresh:0;url=nodue_login.php" );
			exit();
}



	if(mysqli_num_rows($sql4) == 0)
{
	echo "<script type='text/javascript'>alert(\"No Dues to be paid!!!!\");</script>";
	header( "refresh:0;url=nodue_login.php" );
			exit();
	
}	



	//$conn->close();
}		
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><META http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
.form-control-inline {
    min-width: 20;
    width: auto;
    display: inline;
}
.hel{
font-size:35;
width:700px;
font-family:Lucida Calligraphy;
color:#0c9dd1;
}
</style>
<script type="text/javascript">


	function validate()
{	
if(document.myform.username.value == "")
{
alert("Please enter the username!!!");
document.myform.username.focus();
return false;
}
if(document.myform.password.value == "")
{
alert("Please enter the password!!!");
document.myform.password.focus();
return false;
}

}


</script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-image:URL(bd6.jpg); color:white; background-size: 100%;">
<br/><br/><br/><br/><br/><br/><br/>
<h1 class="hel"><center><span class="#">No-Due Management System</span></center></h1><br/>
<div class="container">
  <form action="nodue_login.php" method="POST" name="myform" onsubmit="return(validate());">
	<center>
	<div class="form-group col-lg-4">
	<div class="form-group">
	<b><h4>Username:</h4></b>
      <input class="form-control" type="text" name="username" placeholder="Enter your username">
	</div>
	
	
    <div class="form-group">
	<b><h4>Password:</h4></b>
      <input class="form-control" type="password" name="password" placeholder="Enter your password">
	</div>
	
		<button type="submit" name="login" class="btn btn-primary">Login</button>
	  <button type="button" class="btn btn-warning">Cancel</button><br>	<br/>
	  
	  </center>
  </div>
  </form>

<div class="container">  
<div class="form-group col-lg-4">
  <form method="POST" action="nodue_login.php" class="">
  <div class="form-group">
  	<b><h4><center>Enter your USN:</center></h4></b>
	</div>
	<div class="form-group">
      <input class="form-control" type="text" name="usn" placeholder="For students only"><br/>
	  <center><input type="submit" class="btn btn-primary" name="go" value="Go" /></center>
  </div>
  <?php

//  echo $_SESSION["flag"];
 /* if ($_SESSION["flag"] == 1)
  {
	  echo "The amount to be paid is: <b>".$_SESSION["pay"]."</b>";
  }*/
  ?>
</div>
</div>
</form>

</body></html>
