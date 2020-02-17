<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
  <!-- Bootstrap -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
<link href="Css/style.css" rel="stylesheet" type="text/css">
</head>

  <?php
  
  $wpw = "";
$num = 0;
$sh = "";

session_start();
if(isset($_SESSION['uid']))
{
	$cusID = $_SESSION['uid'];
	$conn = mysqli_connect("localhost", "root", "", "m2_145291r"); 

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

      <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="370">
        <div class="container-fluid">
    
          <!-- Brand and toggle get grouped for better mobile display -->
        
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="defaultNavbar1">
            <ul class="nav navbar-nav">
              <li  ><a href="index.php">HOME</a></li>
              <li><a href="product_menu.php">PRODUCT</a></li>
           
              
              <li style="display:<?php echo $display1; ?>" ><a href="index.php?login">LOGIN</a></li>
              <li style="display:<?php echo $display1; ?>"><a href="register.php">REGISTER</a></li>
              <li><a href="showCart.php">CART(<?php echo $num ?>)</a></li>
          
                	 	<?php 
			
				if(isset($_SESSION['uid']))
				{
					echo "Welcome";
					?>
                     <img src="cus_dp/<?php echo $cus['profilePicture'] ;?>" <?php echo "id=dp" ; ?> />
       <?php } ?>
        </nav>
       </div>
        <!-- /.container-fluid -->
     </div>
     </div>
       

   <?php
   $fname = "";
   $uname = "";
   $sans = "";
   $email = "";
   $fullname = "";
   $phoneNo = "";
   $add = "";
	$ccnum = "";
	$expire = "";
		  
   
   ?>
    <?php 
	if(isset($_GET['error']))
	{
		if($_GET['error'] == 1)
		{
		
		  $fname = $_GET['fname'];
		  $uname = $_GET['uname'];
		  $sans = $_GET['sans'];
		  $email = $_GET['email'];
		  $fullname = $_GET['fullname'];
		  $phoneNo = $_GET['phoneNo'];
		  $add = $_GET['address'];
		  $ccnum = $_GET['ccnum'];
		  $expire = $_GET['expire'];
		  
		 
		}
		if($_GET['error'] == 2)
		{
		 $fname = $_GET['fname'];
	
		  $sans = $_GET['sans'];
		  $email = $_GET['email'];
		  	  $fullname = $_GET['fullname'];
		  $phoneNo = $_GET['phoneNo'];
		  $add = $_GET['address'];
		  $ccnum = $_GET['ccnum'];
		  $expire = $_GET['expire'];
		  
		 
		} 
			if($_GET['error'] == 3)
		{
		
		  $fname = $_GET['fname'];
		  $uname = $_GET['uname'];
		  $sans = $_GET['sans'];
		  $email = $_GET['email'];
		  	  $fullname = $_GET['fullname'];
		  $phoneNo = $_GET['phoneNo'];
		  $add = $_GET['address'];
		  $ccnum = $_GET['ccnum'];
		  $expire = $_GET['expire'];
		  
		 
		 
		}
	}

	  ?>
      

<div class="section">
<div class="sectionheader">
<h3>Personal Info</h3>
</div>
<div class="sectionContent">
<form method="POST" enctype="multipart/form-data" action="register_action.php" > 
<table width="466" height="230" border="0" id="registertable">
  <tbody>
    <tr>
      <td width="194">Full Name:</td>
      <td width="262"><input name="fname" type="text" required></td>
    </tr>
    <tr>
      <td>Gender:</td>
      <td><input name="gender" type="radio" value="M" checked="checked"> Male
      <input type="radio" name="gender" value="F"> Female
      
    
      
      </td>
    </tr>
    <tr>
      <td>Username:</td>
      <td><input name="username" type="text" value="<?php echo $uname; ?>" required ></td>
    </tr>
    <tr>
      <td>Password:</td>
      <td><input name="pwd" type="password" required></td>
    </tr>
    <tr>
      <td>confirm password:</td>
      <td><input name="cfpwd" type="password" required></td>
    </tr>
    <tr>
      <td>security Question:</td>
      <td><select name="sqn">
      <option value="when is your Birthday" >when is your Birthday?</option>
      <option value="when is your first love" >when is your first love?</option>
      <option value="what is your first pet name">what is your first pet name?</option>
      </select></td>
    </tr>
    <tr>
      <td>Answer:</td>
      <td><input name="sans" type="text" value="<?php echo $sans; ?>" required></td>
    </tr>
    <tr>
      <td>Email:</td>
      <td><input name="email" type="email" value="<?php echo $email; ?>" required></td>
         <tr>
      <td>Profile Picture:</td>
      <td><input name="dp" type="file" required></td>
    </tr>
    </tr>
  </tbody>
</table>


</div>
<br>
</div>
<div class="section">
<div class="sectionheader">
<h3>Billing & Payment Information</h3>
</div>
<div class="sectionContent">
<form method="POST" enctype="multipart/form-data" action="register_action.php" > 
<table width="466" height="230" border="0" id="registertable">
  <tbody>
    <tr>
      <td width="194">Full Name:</td>
      <td width="262"><input name="fullname" value="<?php echo $fullname; ?>" type="text" required></td>
    </tr>
    <tr>
      <td>Contact Number</td>
      <td><input type="text"  value="<?php echo $phoneNo; ?>" name="phoneNo" required></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><input name="address" type="text"  value="<?php echo $add; ?>"  required ></td>
    </tr>
    <tr>
      <td>Credit Card Number</td>
      <td><input name="ccnum" type="text"  value="<?php echo $ccnum; ?>" required></td>
    </tr>
    <tr>
      <td>Expiration Date</td>
      <td><input name="date" type="date"  value="<?php echo $expire; ?>" required></td>
    </tr>
   
  </tbody>
</table>


</div>
<input type="submit" class="btn btn-default" name="submit">
</form>
<?php
if(isset($_GET['error']))
{
	if(($_GET['error']) == 1)
	{
		echo "Password not match";
		
	}
	else if ($_GET['error'] == 2)
	{
		echo "same username found! please try use another name";
	}
	else if(($_GET['error']) == 3)
	{
		echo "Image file type not allow";
	}
}
?>
</div>


</body>
</html>
