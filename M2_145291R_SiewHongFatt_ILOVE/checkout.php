<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>

    <!-- Bootstrap -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="Css/style.css" rel="stylesheet" type="text/css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
<?php 
session_start();
if(isset($_SESSION['uid']))
{
$cusID = $_SESSION['uid']; 
$conn = mysqli_connect("localhost", "root", "", "m2_145291R"); 

$sql_cart = "select p.productID, p.productname , p.color , p.price , c.QOH , c.cartID , p.productID from cart as c inner join product as p on c.productID = p.productID where c.cusID = '$cusID'";
$cart_list = mysqli_query($conn,$sql_cart);
$sql_cus = "select * from customer where cusID ='$cusID'";
$cus_list = mysqli_query($conn,$sql_cus);
$cus = mysqli_fetch_assoc($cus_list);
$conn = mysqli_connect("localhost", "root", "", "m2_145291R"); 
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
$display = "inline";
	$display1 = "none";	
}
else
{
	$display = "none";
	$display1 = "inline";
}
$sql_bill = "select * from bill where cusID = $cusID";
$bill = mysqli_query($conn,$sql_bill);
$billResult = mysqli_fetch_assoc($bill);
?>


<body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="js/jquery-1.11.3.min.js"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed --> 
	<script src="js/bootstrap.js"></script>
<div id="wrapper">
      
    <div id="header">
   <img src="images/logo.png" alt="logo" id="logo">

      <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="350">
        <div class="container-fluid">
    
          <!-- Brand and toggle get grouped for better mobile display -->
        
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="defaultNavbar1">
            <ul class="nav navbar-nav">
              <li  ><a href="index.php">HOME</a></li>
              <li><a href="product_menu.php">PRODUCT</a></li>
              <li style="display:<?php echo $display; ?>"><a href="myaccount.php">MY ACCOUNT</a></li>
              
              <li><a href="showCart.php">CART(<?php echo $num ?>)</a></li>
                <li style="display:<?php echo $display; ?>"><a href="logout.php">LOGOUT</a></li>
         
                	 	<?php 
			
				if(isset($_SESSION['uid']))
				{
					echo "Welcome";
					?>
                     <img src="cus_dp/<?php echo $cus['profilePicture'] ;?>" <?php echo "id=dp" ; ?> />
       <?php } ?>
       </ul>
       </div>
        <!-- /.container-fluid -->
      </nav>
       </div>
       </div>

<form method="POST" action="checkout_action.php">
<fieldset>
    <legend>Cart Information</legend>
<table width="703" border="0">
  <tbody>
<tr>
    <td>Product Name</td>
    <td>Price</td>
    <td>Quantity</td>
    <td>Total</td>
    <td>Expected Delivery Date<td>
    </tr>
 <?php  while ($cart = mysqli_fetch_assoc($cart_list)) { ?>
    
    <tr>
    <td><?php echo $cart['productname']; ?> </td>
    
  		<td><?php echo $cart['price']; ?></td>
        <td><?php echo $cart['QOH']; ?> <input type="hidden" name="qty" value="<?php echo $cart['QOH']; ?>"></td>
      <td><?php echo number_format($cart['price'] *$cart['QOH'],0) ; ?></td>
   <td><?php echo date("Y/m/d" ,  strtotime( ' + 5 days')); ?></td>
      </tr>
<?php  }?>
 
  </tbody>
  </table>
  <?php echo "Grand Total " . $_POST['total']; ?>
  </fieldset>
  
<fieldset>
    <legend>Billing Information</legend>
<table width="703" border="0">
  <tbody>
    <tr>
      <td width="141">Full Name:</td>
      <td width="546"><?php echo $billResult['fullName'] ?></td>
    </tr>
  
   
    <tr>
      <td>Phone Number</td>
      <td><?php echo $billResult['phoneNo'] ?></td>
    </tr>
    <tr>
      <td>Street Address</td>
      <td><?php echo $billResult['address'] ?></td>
    </tr>
  </tbody>
</table>
</fieldset>
<fieldset>
    <legend>Shipping Information</legend>
<table width="703" border="0">
  <tbody>
    <tr>
      <td width="141">Recevier Name</td>
      <td width="546"><input type="text" name="rname" required></td>
    </tr>
 
    <tr>
      <td>Recevier Address</td>
      <td><input type="text" name="radd" required></td>
    </tr>
    <tr>
    	<td>Shipping option</td>
        <td><input name="shipping" type="radio" value="normal Delivery" checked="checked">Normal Delivery <input type="radio" name="shipping" value="singpost"> Singpost</td>
    </tr>
  </tbody>
</table>
</fieldset>
<fieldset>
    <legend>Payment</legend>
<table width="703" border="0">
  <tbody>
    <tr>
      <td width="141">Payment Method</td>
      <td width="546"><input name="payment" type="radio" value="nets" checked="checked">Credit Card</td>
    </tr>
        <tr>
      <td width="141">Credit Card Number</td>
      <td><?php echo $billResult['creditCardNum']; ?></td>
    </tr>
    </tbody>
    </table>
 </fieldset>
 <input class="btn btn-default" type="Submit" value="submit">
</form>
</div>
</body>
</html>