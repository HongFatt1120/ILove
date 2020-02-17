<?php
session_start();



$conn = mysqli_connect("localhost","root", "", "m2_145291r");

$cidToDelete = $_POST['cid'];
$qtyToReturn  = $_POST['qty'];
$pid = $_POST['pid'];


$sql = "DELETE FROM cart WHERE cartID='$cidToDelete'";
$delete = mysqli_query($conn,$sql);

header("location:showcart.php");


?>