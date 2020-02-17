<!DOCTYPE html>
<html>
<head>
<title>Product Detail</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="Css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="js/jquery-1.11.3.min.js"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed --> 
	<script src="js/bootstrap.js"></script>
<?php


session_start();
if(isset($_SESSION['uid']))
{
	$cusID = $_SESSION['uid'];
	$conn = mysqli_connect("localhost", "root", "", "m2_145291r"); 

	$select_code = $_GET['id'];

	$sql = "SELECT * FROM product WHERE productID = '$select_code'";

	$selectedproduct = mysqli_query($conn,$sql);
	$product = mysqli_fetch_assoc($selectedproduct);

	$sql_cus = "select * from customer where cusID ='$cusID'";
	$cus_list = mysqli_query($conn,$sql_cus);
	$cus = mysqli_fetch_assoc($cus_list);
	$sql_checkcart = "select * FROM Cart where cusID = '$cusID'";
	$checkcart = mysqli_query($conn,$sql_checkcart);
	$cartnum = mysqli_num_rows($checkcart);
	if($cartnum >= 1)
	{
	$num = $cartnum;
	}	
	else
	{
	$num = 0;
	}
		
}
	else
	{
		header("location:index.php?valid=fail");
	}


?>
<div id="wrapper">

<div id="header">
    <img src="images/logo.png" alt="logo" id="logo">
    <div id="search">
    <form id="searchform" name="searchform" >
        <div class="fieldcontainer">
          <input type="text" name="s" id="s" class="searchfield" placeholder="Keywords..." tabindex="1" />
          <input type="submit" name="searchbtn" id="searchbtn" value="" />
        </div>      
      </form>
    </div>
      <nav class="navbar navbar-inverse"  data-spy="affix" data-offset-top="350">
        <div class="container-fluid">
    
          <!-- Brand and toggle get grouped for better mobile display -->
        
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="defaultNavbar1">
            <ul class="nav navbar-nav">
              <li  ><a href="index.php">HOME</a></li>
              <li><a href="product_menu.php">PRODUCT</a></li>
              <li><a href="myaccount.php">MY ACCOUNT</a></li>
              
    
              <li><a href="showCart.php">CART(<?php echo $cartnum ?>)</a></li>
              <li ><a href="logout.php">LOGOUT</a></li>
              	<?php 
			
				if(isset($_SESSION['uid']))
				{
					echo "Welcome";
					?>
                     <img src="cus_dp/<?php echo $cus['profilePicture'] ;?>" <?php echo "id=dp" ; ?> />
                     <?php } ?>
            </ul>
           
            
          </div>
          <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
      </nav>
    </div>



<h1>Country Detail page</h1>
<h3><?php echo $product['productname']; ?></h3>
<form action="insert_record.php" method="POST">
<table>
<tr><td><img src="<?php echo $product['image'] ?>" /></td>
<td>
<br>
Colour: <?php echo $product['color'] ?>
<br>
cost <?php echo $product['price']; ?>
<br>
Quantity:<input type="number" name="qty">
<input type="submit" class="btn btn-default"  value="Add to cart"><br>
<?php if(isset($_GET['error'])) {echo "Please enter a porper quantity" ;}?>
<input type="hidden" name="pid" value="<?php  echo $select_code ?>">
<input type="hidden" name="pname" value="<?php  echo $product['productname']; ?>">
<input type="hidden" name="color" value="<?php  echo $product['color']; ?>">
<input type="hidden" name="price" value="<?php echo $product['price']; ?>">
</td>
</tr>
</table>
</form>


</div>


</body>
</html>


