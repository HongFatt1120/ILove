<?php
session_start();



$conn = mysqli_connect("localhost","root", "", "m2_145291r");

$cidupdate = $_POST['cid'];
$newQty = $_POST['NewQty'];
$oldqty = $_POST['qty'];
$pid = $_POST['pid'];

$sql_check = "select * from product where QOH < '$newQty' AND productID = '$pid'";
	$check_qoh = mysqli_query($conn,$sql_check);
	$row = mysqli_num_rows($check_qoh);
	
	if($row >= 1)
	{
		header("location:ShowCart.php?error=1");
	}
else if($newQty < 1)
{
	header("location:ShowCart.php?error=2");
}

else 
{

$sql = "UPDATE cart SET QOH = '$newQty' where cartID='$cidupdate'";
$update = mysqli_query($conn,$sql);

header("Location:ShowCart.php");
	
}



?>