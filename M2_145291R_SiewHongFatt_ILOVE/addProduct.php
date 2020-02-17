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
  $conn = mysqli_connect("localhost", "root", "", "m2_145291r"); 
 
if(isset($_SESSION['aid']))
{
	$adminID = $_SESSION['aid'];
	

	

	$sql_cat = "SELECT DISTINCT catergoryName , categoryID FROM category " ;
	$cat_list = mysqli_query($conn,$sql_cat);
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
              <li ><a href="addProduct.php">ADD PRODUCT</a></li>
   
   
                <li><a href="logout.php">LOGOUT</a></li>
            </ul>
         
                	
       </div>
        <!-- /.container-fluid -->
      </nav>
       </div>
       
     <div>
        <form action="product_action.php" method="POST" enctype="multipart/form-data" id="admin">
		<table  width="440" height="234" border="0">
  		<tbody>
    	<tr>
      	<td width="165">Product Name</td>
      	<td width="265"><input type="text" name="pname"  required></td>
    	</tr>
    	<tr>
      	<td>Product Image</td>
      	<td><input type="file" name="pimg" required></td>
    	</tr>
        <tr>
      	<td>Quantity</td>
      	<td><input type="number" name="QOH"required ></td>
    	</tr>
        <tr>
        <td>Price</td>
      	<td><input type="text" name="price" required ></td>
    	</tr>
         <tr>
        <td>Color</td>
      	<td><input type="text" name="color" required></td>
    	</tr>
        <tr>
        <td>Catergory</td>
      	<td>
        <select name="cat">
        <?php while($cat = mysqli_fetch_assoc($cat_list))
{
?>
        	<option value="<?php echo $cat['categoryID']; ?>">
            
                <?php echo $cat['catergoryName']; ?>
            </option>
            <?php } ?>
        </select>
        
        </td>
    	</tr>
        
        
  		</tbody>
		</table>
		<button type="submit" class="btn btn-default" name="submit" id="submit" >Add Product</button> 
        <?php 
		if(isset($_GET['error']))
		{
			if($_GET['error'] == 1)
			{
				echo "Please enter a proper Quantity";
			}
			else
			{
				echo "File type not allow";
			}
			
		}
		
		?>
		</form>
      </div>
  </div>

  

 
   





 
  </body>
</html>