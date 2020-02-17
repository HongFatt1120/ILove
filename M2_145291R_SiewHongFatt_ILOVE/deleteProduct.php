<?php


$conn = mysqli_connect("localhost","root", "", "m2_145291r");


$pid = $_POST['pid'];


$sql = "DELETE FROM product WHERE productID='$pid'";
$delete = mysqli_query($conn,$sql);

header("location:updateProduct.php");

?>