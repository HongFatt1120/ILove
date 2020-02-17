<!doctype html>
<html>
<head>

<?php

$conn = mysqli_connect("localhost", "root", "", "m2_145291R"); 
session_start();

	$filter = "";
	$uid = "";
	$cartnum = 0;
	$num = 0;
	$cusID = "";
	$sql_cat = "SELECT DISTINCT catergoryName , categoryID FROM category " ;
	$cat_list = mysqli_query($conn,$sql_cat);

	$sql_cat = "SELECT DISTINCT catergoryName , categoryID FROM category " ;
	$cat_list = mysqli_query($conn,$sql_cat);


	if($cartnum >= 1)
	{
		$num = $cartnum;	
	}


	if(isset($_GET['Cat']))
	{
	$cont_selected = $_GET['Cat'];
	$filter = "WHERE categoryID =  '$cont_selected'";
	}

	$sql_product = "SELECT * FROM product " . $filter;
	$product_list = mysqli_query($conn,$sql_product);

if(isset($_SESSION['uid']))
{
	$uid = $_SESSION['uid'];
	$sql_cus = "select * from customer where cusID ='$uid'";
	$cus_list = mysqli_query($conn,$sql_cus);
	$cus = mysqli_fetch_assoc($cus_list);

	$sql_checkcart = "select * FROM Cart where cusID = '$uid'";
	$checkcart = mysqli_query($conn,$sql_checkcart);
	$cartnum = mysqli_num_rows($checkcart);


	$sql_product = "SELECT * FROM product " . $filter;
	$product_list = mysqli_query($conn,$sql_product);
	$sql_cat = "SELECT DISTINCT catergoryName , categoryID FROM category " ;
	$cat_list = mysqli_query($conn,$sql_cat);
	$display = "inline";
	$display1 = "none";	

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

<meta charset="utf-8">
<title>Product - 145291R</title>

<link href="css/bootstrap.css" rel="stylesheet">
	
    <link href="Css/style.css" rel="stylesheet" type="text/css">

</head>



	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
  </head>
  <body style="padding-bottom: 70px">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="js/jquery-1.11.3.min.js"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed --> 
	<script src="js/bootstrap.js"></script>
    
<body>

  
</div>
<div id="wrapper">
  
  <div id="header">	
<div id="header">
    <img src="images/logo.png" alt="logo" id="logo">
   
      <nav class="navbar navbar-inverse"  data-spy="affix" data-offset-top="300">
        <div class="container-fluid">
    
          <!-- Brand and toggle get grouped for better mobile display -->
        
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="defaultNavbar1">
            <ul class="nav navbar-nav">
              <li  ><a href="index.php">HOME</a></li>
              <li><a href="product_menu.php">PRODUCT</a></li>
              <li style="display:<?php echo $display; ?>"><a href="myaccount.php">MY ACCOUNT</a></li>
              
              <li style="display:<?php echo $display1; ?>" ><a href="index.php?login">LOGIN</a></li>
              <li style="display:<?php echo $display1; ?>"><a href="register.php">REGISTER</a></li>
              <li><a href="showCart.php">CART(<?php echo $num ?>)</a></li>
                <li style="display:<?php echo $display; ?>"><a href="logout.php">LOGOUT</a></li>
                    <?php 
		   if(isset($_SESSION['uid']))
				{
					echo "Welcome";
					?>
                     <img src="cus_dp/<?php echo $cus['profilePicture'] ;?>" <?php echo "id=dp" ; ?> />
       <?php } 
		   ?>
            </ul>
       
            
          </div>
          <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
      </nav>
    </div>
     <div id="search">
    <form id="searchform" name="searchform"  method="POST" action="search.php" >
        <div class="fieldcontainer">
          <input type="text" name="s" id="s" class="searchfield" placeholder="Keywords..." tabindex="1" />
          <input type="submit" name="searchbtn" id="searchbtn" value="" />
        </div>      
      </form>
    </div>
</div>

        <div id="content">

<form method="GET" >


 <div id="subnav">
<ul id="snav">
<?php while($one_continent = mysqli_fetch_assoc($cat_list))
{
?>

<li><a href="product_menu.php?Cat=<?php echo $one_continent['categoryID']; ?>"><?php echo $one_continent['catergoryName'] ?></a></li>

<?php } ?>
</form>

</ul>
</div>

<table width="987" border="0">
  <tbody>
    <?php  while ($one_country = mysqli_fetch_assoc($product_list)) { ?>
    <tr>
      <td width="344"><img src="<?php echo $one_country['image'];?>" id="pimg" alt=""></td>
      <td width="292"><p class="pdesc">
      <h4>
    Available Stock:<?php echo $one_country['QOH']; ?>
      <br>
      </h4>
      <h4>Price:<?php echo $one_country['price']; ?>
      <br>
      </h4>
      <h4>Avaiable Color:<?php echo $one_country['color']; ?></p>
      </h4></td>
      <td width="337"> <a href="ProductDetails.php?id=<?php echo $one_country['productID']?>" >
      <button type="submit" class="btn btn-default" name="submit" id="cart">Add To Cart</button></a></td>
    </tr>
    <?php  } ?>
  </tbody>
</table>

</body>
</html>
