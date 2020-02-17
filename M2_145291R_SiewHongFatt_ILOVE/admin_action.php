<?php 
 
 $u = $_POST['username'];
 $p = $_POST['password'];

 	$conn = mysqli_connect("localhost", "root", "", "m2_145291r"); 

	$sql = "select * from admin where adminusername= '$u' and adminPassword= '$p' ";

	$search_result = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($search_result);
	$userfound = mysqli_num_rows($search_result);

	if($userfound >= 1)
	{
		session_start();
		$_SESSION['aid'] = $result['adminID'];
	header("location:adminlogin.php");	
	}
	else
	{
		header("location:adminlogin.php?error=1");
	}
?>