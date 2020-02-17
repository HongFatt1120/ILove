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
  
  $wpw = "";
$num = 0;
$sh = "";


session_start();

	$conn = mysqli_connect("localhost", "root", "", "m2_145291r"); 
	$num = 0;
	$searchrow = 0;
	$searchresult  = "";
	if(isset($_POST['s']))
	{
	$searchresult = $_POST['s'];
	}
	$sql_search = "SELECT * FROM product where productname like '%$searchresult%'";
	$search = mysqli_query($conn,$sql_search);
	
	$searchrow = mysqli_num_rows($search);
	
	
	

if(isset($_SESSION['uid']))
{
		
	
	
	
	$cusID = $_SESSION['uid'];

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
	$display = "inline";
	$display1 = "none";	
}
else
{
	$display = "none";
	$display1 = "inline";
}


	
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
              
              <li style="display:<?php echo $display1; ?>"><a href="index.php?login">LOGIN</a></li>
              <li style="display:<?php echo $display1; ?>"><a href="register.php">REGISTER</a></li>
              <li><a href="showCart.php">CART(<?php echo $num ;?>)</a></li>
                <li style="display:<?php echo $display; ?>"><a href="logout.php">LOGOUT</a></li>
                 
                	 	<?php 
			
				if(isset($_SESSION['uid']))
				{
					echo "Welcome";
					?>
                     <img src="cus_dp/<?php echo $cus['profilePicture'] ;?>" <?php echo "id=dp" ; ?> />
       <?php } ?>
       </div>
        <!-- /.container-fluid -->
      </nav>
       </div>
       </div>
  <div id="search">
    <form id="searchform" name="searchform" method="POST" action="search.php">
        <div class="fieldcontainer">
          <input type="text" name="s" id="s" class="searchfield" placeholder="What Product you are looking for?" tabindex="1" />
          <input type="submit" name="searchbtn" id="searchbtn" value="" />
        </div>      
      </form>
      </div>

 
     

    
  </div>
</div>

<div>
</div>
<?php
$searchrow = 0;
if($searchrow >=1)
{
	

 ?>
 <table width="987" border="0">
  <tbody>
    <?php  while ($result = mysqli_fetch_assoc($search)) { ?>
    <tr>
      <td width="344"><img src="<?php echo $result['image'];?>" id="pimg" alt=""></td>
      <td width="292"><p class="pdesc">
      <h4>
    Available Stock:<?php echo $result['QOH']; ?>
      <br>
      </h4>
      <h4>Price:<?php echo $result['price']; ?>
      <br>
      </h4>
      <h4>Avaiable Color:<?php echo $result['color']; ?></p>
      </h4></td>
      <td width="337"><button type="submit" class="btn btn-default" name="submit" id="cart">
      <a href="ProductDetails.php?id=<?php echo $result['productID']?>" >Add To Cart</a></button></td>
    </tr>
    <?php  }  ?>
	<?php }else
	{
	 echo "no product found";	
	}
		 ?>

  </tbody>
</table>
 </div>
 
 
 
 
 
 
 
  </body>
 
</html>