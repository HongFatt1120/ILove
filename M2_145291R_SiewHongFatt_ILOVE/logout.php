<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>
<?php
session_start();

if(isset($_SESSION['uid']))
{
unset($_SESSION['MM_Username']);
unset( $_SESSION['uid']);


session_destroy();
header("location:index.php");

}

if(isset($_SESSION['aid']))
{
	unset($_SESSION['aid']);
	session_destroy();
	header("location:adminlogin.php");
}



?>
</body>
</html>
