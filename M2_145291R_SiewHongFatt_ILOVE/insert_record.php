<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>
<?php

$pid = $_POST['pid'];
$qty = $_POST['qty'];
$pname = $_POST['pname'];
$color = $_POST['color'];
$price = $_POST['price'];
session_start();
$uid = $_SESSION['uid'];

$conn = mysqli_connect("localhost","root", "", "m2_145291r");
	
	$sql_check = "select * from product where QOH < '$qty' AND productID = '$pid'";
	$check_qoh = mysqli_query($conn,$sql_check);
	$row = mysqli_num_rows($check_qoh);
	
	if($row >= 1 || $qty <= 0)
	{
	
		header("location:ProductDetails.php?id=". $pid . "&" . "error=1"  );
		
		
	} 

	else
	{
		$sql_checkcart = "select * from cart where productID= '$pid' AND cusID = '$uid' ";
		$checkcart = mysqli_query($conn,$sql_checkcart);
		$cart = mysqli_fetch_assoc($checkcart);
		$row1 = mysqli_num_rows($checkcart);
		
		
		if($row1 >= 1)
		{
			$sql_update = "UPDATE cart SET QOH = (QOH + $qty)  where productID= '$pid' AND cusID = '$uid' ";
			
			$update = mysqli_query($conn,$sql_update);
			
			
		header("location:showcart.php");
		}
		else
		{
		

				
				
	$sql_cart = "insert into cart (cusID,productID,QOH) VALUES 
	('$uid','$pid','$qty')";
	
	$result2 = mysqli_query($conn,$sql_cart);
					



	header("location:showcart.php");
		}
	}

?>




</body>
</html>


