<?php 


$rname = $_POST['rname'];
$rddress = $_POST['radd'];
$shipping = $_POST['shipping'];


session_start();
$cusID = $_SESSION['uid'];
$conn = mysqli_connect("localhost","root", "", "m2_145291r");
	
	$sql_ship = "insert into shipping (cusID,recevierName,recevierAddress,shippingOption) VALUES 
	('$cusID','$rname','$rddress','$shipping')";
	
$ship = mysqli_query($conn,$sql_ship);

$sql_invoice = "INSERT INTO invoice (cusID) VALUE ('$cusID')";
$invoice = mysqli_query($conn,$sql_invoice);
$lastid = mysqli_insert_id($conn);
	
$sql_cart = "select * from cart where cusID = '$cusID' ";
$cart_list = mysqli_query($conn,$sql_cart);

while($purchase = mysqli_fetch_assoc($cart_list))
{
	$pid = $purchase['productID'];
	$qty = $purchase['QOH'];
	$sql_purchase = "insert into purchasehistory (productID,invoiceID,QOH) VALUES ('$pid','$lastid','$qty')";
	$purchase1 = mysqli_query($conn,$sql_purchase);
	
	$sql_product = "update product set QOH = QOH - $qty where productID = '$pid' ";
	$product = mysqli_query($conn,$sql_product);
}
		
$sql_clear = "DELETE FROM cart where cusID = '$cusID'";
$clear = mysqli_query($conn,$sql_clear);

header("location:purchasehistory.php");
?>