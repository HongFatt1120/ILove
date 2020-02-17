<?php 
 
 $u = $_POST['username'];
 $p = $_POST['password'];

 	$conn = mysqli_connect("localhost", "root", "", "m2_145291r"); 

	$sql = "select * from customer where username= '$u' and password= '$p' ";

	$search_result = mysqli_query($conn, $sql);

	$userfound = mysqli_num_rows($search_result);
	echo  mysqli_error($conn);
	
	if($userfound >= 1)
	{
		session_start();
		$_SESSION['MM_Username'] = $u;
		
		$uid = mysqli_fetch_assoc($search_result);
		  $_SESSION['uid']= $uid['cusID'] ;
	header("location:product_menu.php");	
	}
	else
	{
		header("location:index.php?error=1");
	}
?>