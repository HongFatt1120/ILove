<!DOCTYPE html>
<html>
<head>
<title></title>

    <!-- Bootstrap -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="Css/style.css" rel="stylesheet" type="text/css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>
<body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="js/jquery-1.11.3.min.js"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed --> 
	<script src="js/bootstrap.js"></script>
    
    
    
    
<?php
$total = "";
session_start();
if(!isset($_SESSION['MM_Username']) || !isset($_SESSION['uid']))
{
	header("location:login.php");
}
else
{
	$username = $_SESSION['MM_Username'] ;
	$cusID = $_SESSION['uid'];


$conn = mysqli_connect("localhost","root", "", "m2_145291r");
$username = $_SESSION['MM_Username'];
$sql_history = "select c.productname , c.price, a.QOH, cast(b.invoiceDate as date) as invoicedate , cast( DATE_ADD(b.invoiceDate ,INTERVAL 5 DAY) as date) AS EXPECTED  from purchasehistory as a inner join invoice as b on a.invoiceID = b.invoiceID inner join product as c  on a.productID = c.productID where b.cusID = '$cusID'";
$history_list = mysqli_query($conn,$sql_history);

$checkpurchase = mysqli_num_rows($history_list); 

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
      <nav class="navbar navbar-inverse"  data-spy="affix" data-offset-top="300">
        <div class="container-fluid">
    
          <!-- Brand and toggle get grouped for better mobile display -->
        
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="defaultNavbar1">
            <ul class="nav navbar-nav">
              <li  ><a href="index.php">HOME</a></li>
              <li><a href="product_menu.php">PRODUCT</a></li>
              <li><a href="myaccount.php">MY ACCOUNT</a></li>
             
              <li><a href="showCart.php">CART(<?php echo $num; ?>)</a></li>
              
                <li><a href="logout.php">Logout</a></li>
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
    <div id="subnav">
<ul id="snav">
<li><a href="myaccount.php">Update Personal Info</a></li>
<li><a href="changePassword.php">Change Password</a></li>
<li><a href="purchasehistory.php">View Transation History</a></li>
</ul>
</div>

   
<?php

if($checkpurchase >= 1)
{

 ?>
 <div id="purchase">
<table width="639" border="0">
  <tbody>
    <tr>
     <td width="120"><strong>Product Name</strong></td>
      <td width="53"><strong>Price</strong></td>
      <td width="68"><strong>Quantiy</strong></td>
        <td width="85"><strong>Total Price</strong></td>
        <td><strong>Date Purchase</strong></td>
        <td><strong>Expected Delivery</strong></td>
    </tr>
    
    <?php  while ($his = mysqli_fetch_assoc($history_list)) { ?>
    
    
    <tr>
    <td><?php echo $his['productname']; ?></td>
  		<td><?php echo $his['price']; ?></td>
        <td><?php echo $his['QOH']; ?></td>
      <td><?php echo number_format($his['price'] *$his['QOH'],0) ; ?></td>
      <td><?php echo $his['invoicedate']; ?></td>
      <td><?php echo  $his['EXPECTED']; ?></td>
      
	</tr>
    <?php 
	
	$total += $his['price'] * $his['QOH'] ;  
	
	
	?>
    
	<?php } ?>

  </tbody>
</table>


 <?php } else
 {
	  echo "Currently no transation history";
 }} 
  ?>

	
 
</div>
</div>




</body>
</html>


