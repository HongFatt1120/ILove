<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
$username = $_POST['username'];
$sqn = $_POST['sqn'];
$sans = $_POST['sans'];

$conn = mysqli_connect("localhost","root", "", "m2_145291r");
	$sql_checkpw = "select * from customer where username = '$username' AND securityQn ='$sqn' AND securityAns = '$sans'";
	$check_pw = mysqli_query($conn,$sql_checkpw); 
	$row = mysqli_num_rows($check_pw);

	
	if($row >=1)
	{
		
		$pw_list = mysqli_fetch_assoc($check_pw);

		$_POST['pw'] = $pw_list['password'];
	}
	header("Location:forgetPassword.php");
 ?>


</body>
</html>