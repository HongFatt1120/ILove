<?php

$qty = $_POST['NewQty'];


if($qty < 1)
{
	header("location:updateProduct.php?error=1");
}
else
{
$pid = $_POST['pid'];
$conn = mysqli_connect("localhost","root", "", "m2_145291r");
$sql = "UPDATE product SET QOH = $qty where productID='$pid'";
$update = mysqli_query($conn,$sql);

header("location:updateProduct.php");
}

?>