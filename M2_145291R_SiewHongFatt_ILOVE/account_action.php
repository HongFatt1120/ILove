<?php

session_start();
$cusID = $_SESSION['uid'];


$usrname = $_POST['username'];


	$fname = $_POST['fname'];
	
	$gender = $_POST['gender'];
	$email = $_POST['email'];	
	$fullname = $_POST['fullname'];
	$phoneNo = $_POST['phoneNo'];
	$add = $_POST['address'];
	$ccnum = $_POST['ccnum'];
	$expire = $_POST['date'];
	
	$conn = mysqli_connect("localhost", "root", "", "m2_145291R"); 

if(isset($_POST['submit']))
{
	
	if(isset($_FILES["dp"]["name"]))
	{
		
		
		$tosave = $usrname. "_" . $_FILES["dp"]["name"];
		
		if(($_FILES["dp"]["type"] == "image/jpeg") || ($_FILES["dp"]["type"] == "image/jpg")||($_FILES["dp"]["type"] == "image/png"))
		{
			 $target = "cus_dp/" . $usrname . "_" . $_FILES["dp"]["name"];
 
	 		$check = move_uploaded_file($_FILES["dp"]["tmp_name"],$target);
			
			$sql_update = "UPDATE customer SET fullName = '$fname' , username = '$usrname'" .
			" , gender= '$gender' , email = '$email' , profilePicture = '$tosave' where cusID = $cusID";
			$result = mysqli_query($conn , $sql_update);
			
				$sql_bill = "update bill  SET cusID = '$cusID', fullName = '$fullname' ," .
				"phoneNo = '$phoneNo',address = '$add',creditCardNum = '$ccnum',cardExpireDate = '$expire'";
		$bill = mysqli_query($conn,$sql_bill);
		header("location:myaccount.php");
		}
		else
	{
		
		$sql_update = "UPDATE customer SET fullName = '$fname' , username = '$usrname'" .
			" , gender= '$gender' , email = '$email' where cusID = $cusID";
			$result = mysqli_query($conn , $sql_update);
		
		$sql_bill = "update bill  SET cusID = '$cusID', fullName = '$fullname' ," .
		"phoneNo = '$phoneNo',address = '$add',creditCardNum = '$ccnum',cardExpireDate = '$expire'";
		$bill = mysqli_query($conn,$sql_bill);
		header("location:myaccount.php");
		}
		
			
	}
		
	}
	
	
		
	
	
	
	?>