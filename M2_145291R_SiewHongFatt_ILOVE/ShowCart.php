<!DOCTYPE html>
<html>
<head>
<title></title>
<link href="Css/style.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="js/jquery-1.11.3.min.js"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed --> 
	<script src="js/bootstrap.js"></script>
<?php
session_start();
if(!isset($_SESSION['MM_Username']) || !isset($_SESSION['uid']))
{
	header("location:index.php?login");
}
else
{
	$username = $_SESSION['MM_Username'] ;
	$cusID = $_SESSION['uid'];


$conn = mysqli_connect("localhost","root", "", "m2_145291r");
$username = $_SESSION['MM_Username'];
$sql_cart = "select p.productname , p.color , p.price , c.QOH , c.cartID , p.productID from cart as c inner join product as p on c.productID = p.productID where c.cusID = '$cusID'";
$cart_list = mysqli_query($conn,$sql_cart);

$total = "";
$totalqty = "";
 
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




?>
<div id="wrapper">
 
<div id="header">
    <img src="images/logo.png" alt="logo" id="logo">
    <div id="search">
    <form id="searchform" name="searchform"  method="POST" action="search.php" >
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
                <li><a href="showCart.php">CART(<?php echo $cartnum; ?>)</a></li>
     		  <li><a href="logout.php">LOGOUT</a></li>
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

<?php

if($cartnum >= 1)
{

 ?>
 <div id="cartContent">
<table width="1004" height="85" border="0">
  <tbody>
    <tr>
     <td width="129"><strong>Product Name</strong></td>
     <td width="37"><strong>Color</strong></td>
      <td width="53"><strong>Price</strong></td>
      <td width="71"><strong>Quantiy</strong></td>
        <td width="89"><strong>Total Price</strong></td>
    </tr>
    
    <?php  while ($cart = mysqli_fetch_assoc($cart_list)) { ?>
    <tr>
    <td><?php echo $cart['productname']; ?></td>
      <td><?php echo $cart['color']; ?></td>
  		<td><?php echo $cart['price']; ?></td>
        <td><?php echo $cart['QOH']; ?></td>
      <td><?php echo number_format($cart['price'] *$cart['QOH'],0) ; ?></td>
      
<td width="362">

	<form action="updatecart.php" method="POST">
		
		
	<input type="number" name="NewQty">
    <?php 
	
	if(isset($_GET['error']))
	{
		
		if($_GET['error'] ==1)
		{
			echo "Quantity not enough. Please enter a lower quantity";
		} 
		else
		{
			echo "Please do not enter number less than 1";
		}
	}
	?>
    <input type="submit" name="update"  class="btn btn-default" value="Update Qty">	
	   <input type="hidden" name="cid" value="<?php echo $cart['cartID']; ?>">
       <input type="hidden" name="pid" value="<?php echo $cart['productID'] ;?>">
    <input type="hidden" name="qty" value="<?php echo $cart['QOH'] ;?>"	>
	</form>
</td>
	
<td width="233">
<form action="deletecart.php" method="POST">
	<button type="submit" class="close"  name="Delete" id="delete" >&times;</button>
	<input type="hidden" name="cid" value="<?php echo $cart['cartID'] ?>"	>
    <input type="hidden" name="qty" value="<?php echo $cart['QOH'] ;?>"	>
    
	   <input type="hidden" name="pid" value="<?php echo $cart['productID'] ;?>">
	
	</form>
</td>
	</tr>
    <?php 
	
	$total += $cart['price'] * $cart['QOH'] ;  
	
	$totalqty += $cart['QOH'] ; 
	?>
    
	<?php } ?>

  </tbody>
</table>
Grand Total <?php echo number_format($total,0); ?> 
<form method="POST" action="checkout.php">
 <input type="hidden" name="total" value="<?php echo $total ;?>">
 <input type="submit" class="btn btn-default" value="Checkout">
 </form>

 <?php } else
 {
	  echo "Currently your cart have no item";
 }} 
  ?>
  <?php
  if(isset($_POST['error']))
  {
 	 if(($_POST['error']) == 1)
 	 {
	  echo "stock not enough";
 	}
 	else if ($_POST['error'] ==2 )
 	{
	 echo "Please enter a value quantiy";
	 
}
  }
  
  ?>

	
 
</div>
</div>




</body>
</html>


