<?php 


	$productname = $_POST['pname'];
	$productimg = $_FILES["pimg"]["name"];
	$qoh = $_POST['QOH'];
	$color = $_POST['color'];
	$price = $_POST['price'];
	$cat = $_POST['cat'];
	$tosave =  "product/". $_FILES["pimg"]["name"];
	if($qoh <= 0 )
	{
	
		header("location:addProduct.php?error=1"  );
		
		
	} 
	else
	{
	if(($_FILES["pimg"]["type"] == "image/jpeg") || ($_FILES["pimg"]["type"] == "image/jpg")||($_FILES["pimg"]["type"] == "image/png"))
	{
	 $target = "product/" . $_FILES["pimg"]["name"];
 
 	$check = move_uploaded_file($_FILES["pimg"]["tmp_name"],$target);
	
	$conn = mysqli_connect("localhost", "root", "", "m2_145291R"); 
	$sql_product = "insert into product (productname,QOH,image,price,color,categoryID) VALUES 
	('$productname','$qoh','$tosave','$price','$color','$cat')";
	$product = mysqli_query($conn,$sql_product);
	
	header("location:updateProduct.php");
	}
	else
	{
		header("location:addProduct.php?error=2"  );
	}

		}
		


?>