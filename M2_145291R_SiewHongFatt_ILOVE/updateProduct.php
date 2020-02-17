<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
  </head>
  <?php
  session_start();
if(isset($_SESSION['aid']))
{
	$adminID = $_SESSION['aid'];
	$conn = mysqli_connect("localhost", "root", "", "m2_145291r"); 

	
	$display = "inline";
	$display1 = "none";	
	$sql_product = "SELECT * FROM product " ;
	$product_list = mysqli_query($conn,$sql_product);
}
else
{
	header("location:adminlogin.php");
}
?>
  <body>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="js/jquery-1.11.2.min.js"></script>

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
                            <li><a href="adminlogin.php">HOME</a></li>

            
               <li ><a href="viewOrder.php">VIEW ORDER</a></li>
              <li ><a href="updateProduct.php">UPDATE PRODUCT</a></li>
              <li><a href="addProduct.php">ADD PRODUCT</a></li>
   
                <li><a href="logout.php">LOGOUT</a></li>
                </ul>
         
                	
       </div>
        <!-- /.container-fluid -->
      </nav>
       </div>
       </div>
       
       <table width="987" border="0">
  <tbody>
    <?php  while ($product = mysqli_fetch_assoc($product_list)) { ?>
    <tr>
      <td width="344"><img src="<?php echo $product['image'];?>" id="pimg" alt=""></td>
      <td width="292"><p class="pdesc">
      <h4>
    Available Stock:<?php echo $product['QOH']; ?>
      <br>
      </h4>
      <h4>Price:<?php echo $product['price']; ?>
      <br>
      </h4>
      <h4>Avaiable Color:<?php echo $product['color']; ?></p>
      </h4></td>
      <td width="337">
      <form action="updateproduct_action.php" method="POST">
	<input type="number" name="NewQty">
    <input type="submit" name="update"  class="btn btn-default" value="Update Qty">	
	<input type="hidden" name="pid" value="<?php echo $product['productID'] ;?>">
	</form></td>
    
    <td width="233">
<form action="deleteProduct.php" method="POST">
	<button type="submit" class="close"  name="Delete" id="delete" >&times;</button>


	   <input type="hidden" name="pid" value="<?php echo $product['productID'] ;?>">
	
	</form>
</td>
    </tr>
    
    <?php  } ?>
  </tbody>
  <?php if(isset($_GET['error']))
	{
		if($_GET['error'] == 1)
		{
			echo "<b>nagative value given.</b>";
		}
	}
     ?>  
</table>
           
       </div>
       
    

 
   




 
  </body>
</html>