<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
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
}
else
{
	$display = "none";
	$display1 = "inline";
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
            
              <li style="display:<?php echo $display; ?>"><a href="viewOrder.php">VIEW ORDER</a></li>
              <li style="display:<?php echo $display; ?>"><a href="updateProduct.php">UPDATE PRODUCT</a></li>
              <li style="display:<?php echo $display; ?>"><a href="addProduct.php">ADD PRODUCT</a></li>
   
                <li style="display:<?php echo $display; ?>"><a href="logout.php">LOGOUT</a></li>
                </ul>
         
                	
       </div>
        <!-- /.container-fluid -->
      </nav>
       </div>
       
     <div style="display:<?php echo $display1 ?>" >
        <form id="admin" method="POST" action="admin_action.php">
		<table  width="440" height="77" border="0">
  		<tbody>
    	<tr>
      	<td width="165">Admin Username:</td>
      	<td width="265"><input type="text" name="username" ></td>
    	</tr>
    	<tr>
      	<td>Admin Password:</td>
      	<td><input type="password" name="password" ></td>
    	</tr>
  		</tbody>
		</table>
		<button type="submit" class="btn btn-default" name="submit" id="submit" >Login</button>
	<?php 
		
		if(isset($_GET['error']))
		{
			if($_GET['error'] ==1)
			{
				echo "Wrong password or username";
			}
		}
		?>
		</form>
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