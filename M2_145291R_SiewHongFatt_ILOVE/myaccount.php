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

	$sql_bill = "select * from bill where cusID ='$cusID'";
	$bill_list = mysqli_query($conn,$sql_bill);
	$bill = mysqli_fetch_assoc($bill_list);




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
	<script src="js/jquery-1.11.2.min.js"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed --> 
	<script src="js/bootstrap.js"></script>
    <div id="wrapper">
    <div id="header">		
 <img src="images/logo.png" alt="logo" id="logo">

      <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="280">
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
            
        </nav>
        
       </div>
        <!-- /.container-fluid -->
     </div>
     
     </div>
<div id="subnav">
<ul id="snav">
<li><a href="myaccount.php">Update Personal Info</a></li>
<li><a href="changePassword.php">Change Password</a></li>
<li><a href="purchasehistory.php">View Transation History</a></li>
</ul>
</div>

     <div class="section1">

<form method="POST" enctype="multipart/form-data" action="account_action.php" > 
<div class="sectionheader">
<h3>Personal Info</h3>
</div>
<div class="sectionContent">

<table width="492" height="230" border="0" id="registertable">
  <tbody>
  	<tr>
    <td>Profile Picture:</td>
    	<td><img src="cus_dp/<?php echo $cus['profilePicture']; ?>" id="dp1"/>
        <input type="file" name="dp">
    </tr>
    <tr>
      <td width="279">Full Name:</td>
      <td width="203"><input name="fname" type="text" value="<?php echo $cus['fullName']?>"  required></td>
    </tr>
    <tr>
      <td>Gender:</td>
      <td><input name="gender" type="radio" value="M" <?php if($cus['gender'] == 'M') echo "checked"; ?> >Male
      <input type="radio" name="gender"   value="F" <?php if($cus['gender'] == 'F') echo "checked"; ?>> Female
      </td>
    </tr>
    <tr>
      <td>Username:</td>
      <td><input name="username" type="text" value="<?php echo $cus['username']; ?>" required> </td>
    </tr>
    
    <tr>
      <td>Email:</td>
      <td><input name="email" type="email" value="<?php echo $cus['email'] ?>"  required></td>
        
    </tr>
  </tbody>
</table>


</div>
</div>
<br>
</div>
<div class="section2">
<div class="sectionheader">
<h3>Billing & Payment Information</h3>
</div>
<div class="sectionContent">

<table width="466" height="230" border="0" id="registertable">
  <tbody>
    <tr>
      <td width="194">Full Name:</td>
      <td width="262"><input name="fullname" value="<?php echo $bill['fullName']; ?>" type="text" required></td>
    </tr>
    <tr>
      <td>Contact Number</td>
      <td><input type="text" name="phoneNo"  value="<?php echo $bill['phoneNo']; ?>"></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><input name="address" type="text"  required  value="<?php echo $bill['address']; ?>" ></td>
    </tr>
    <tr>
      <td>Credit Card Number</td>
      <td><input name="ccnum" type="text" required  value="<?php echo $bill['creditCardNum']; ?>"></td>
    </tr>
    <tr>
      <td>Expiration Date</td>
      <td><input name="date" type="date" required value="<?php echo $bill['cardExpireDate']; ?>"  ></td>
    </tr>
   
  </tbody>
</table>


</div>


</div>
<button type="submit" class="btn btn-default" name="submit" id="asubmit">Save changes</button> 
</form>
    
  </body>
</html>