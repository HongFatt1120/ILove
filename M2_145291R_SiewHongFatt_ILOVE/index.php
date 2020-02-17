<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">   
    <title>Index</title>

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
if(isset($_SESSION['uid']))
{
	$cusID = $_SESSION['uid'];
	$conn = mysqli_connect("localhost", "root", "11201120", "m2_145291r"); 

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

 
  <body style="padding-bottom: 70px; padding-top: 70px;">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="js/jquery-1.11.3.min.js"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed --> 
	<script src="js/bootstrap.js"></script>
    
    
    <script type="text/javascript">
  
 		<?php if(isset($_GET['error'])) { ?>
			$(document).ready(function(){
			$("#myModal").modal('show');
			});
		<?php $wpw = "Wrong username and password. Please try again"; ?>
		<?php }else if(isset($_GET['valid'])) { ?>
		
		 $(document).ready(function(){
			$("#myModal").modal('show');
			});
			
		<?php $wpw = "Please Login before you buy";  ?>
		
		<?php }else if(isset($_GET['login'])) { ?>
		
		 $(document).ready(function(){
			$("#myModal").modal('show');
			});
			
		<?php } ?>
		
		
			
		
	</script>
    
  <div id="wrapper">
      
    <div id="header">
   <img src="images/logo.png" alt="logo" id="logo">

      <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="300">
        <div class="container-fluid">
    
          <!-- Brand and toggle get grouped for better mobile display -->
        
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="defaultNavbar1">
            <ul class="nav navbar-nav">
              <li  ><a href="index.php">HOME</a></li>
              <li><a href="product_menu.php">PRODUCT</a></li>
              <li style="display:<?php echo $display; ?>"><a href="myaccount.php">MY ACCOUNT</a></li>
              
              <li style="display:<?php echo $display1; ?>" data-toggle="modal" data-target="#myModal"><a href="#myModal">LOGIN</a></li>
              <li style="display:<?php echo $display1; ?>"><a href="register.php">REGISTER</a></li>
              <li><a href="showCart.php">CART(<?php echo $num ?>)</a></li>
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

  <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="login_action.php">
		<table width="200" border="0">
  		<tbody>
    	<tr>
      	<td width="73">Username:</td>
      	<td width="111"><input type="text" name="username" ></td>
    	</tr>
    	<tr>
      	<td>Password:</td>
      	<td><input type="password" name="password" ></td>
    	</tr>
  		</tbody>
		</table>
		<button type="submit" class="btn btn-default" name="submit" id="submit" >Login</button> <a href="forgetPassword.php">Forget Password?</a>
		<p><?php echo $wpw;?></p>
</form>
      </div>
      <div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

    
  </div>
</div>
<div class="container">
<div id="carousel1" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
            <div class="item active"><img src="product/screenpotector.jpg" alt="First slide image" class="center-block">
              <div class="carousel-caption">
                <h3 class="color">Accessories</h3>
              </div>
            </div>
            <div class="item"><img src="product/iphone6.png" alt="Second slide image" class="center-block">
              <div class="carousel-caption">
                <h3 class="color">Mobile Device</h3>
              </div>
            </div>
            <div class="item"><img src="product/macbkLight.jpg" alt="Third slide image" class="center-block">
              <div class="carousel-caption">
                <h3 class="color">Laptop</h3>
              </div>
            </div>
          </div>
   
  </div>
  </div>
 
  
</body>
</html>