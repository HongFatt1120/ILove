<?php

session_start();
$cusID = $_SESSION['uid'];

	$opw = $_POST['opw'];
	$npw = $_POST['npw'];
	$cpw = $_POST['cpw'];	
	
	$conn = mysqli_connect("localhost", "root", "", "m2_145291R"); 

if(isset($_POST['submit']))
{
	
	if($npw != $cpw)
	{
		header("Location:changePassword.php?error=1");
	}
	else
	{
		$sql_check = "select * from customer where cusID='$cusID' AND password = '$opw'";
		$check = mysqli_query($conn,$sql_check);
		$row = mysqli_num_rows($check);
		echo mysqli_error($conn);
		
		if($row >= 1)
		{
		$sql_update = "UPDATE customer SET password = '$npw'  where cusID = $cusID";
			$result = mysqli_query($conn , $sql_update);
			header("Location:changePassword.php?sucess=pass");
		}
		else
		{
			header("Location:changePassword.php?error=2");
		}
		
	}

			
			
			
				
		}

			

	
	
		
	
	
	
	?>