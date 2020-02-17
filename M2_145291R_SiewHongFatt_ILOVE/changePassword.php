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
                <li style="display:<?php echo $display; ?>"><a href="logout.php">LOGOUT</a></li></ul>
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
    <div id="subnav">
<ul id="snav">
<li><a href="myaccount.php">Update Personal Info</a></li>
<li><a href="changePassword.php">Change Password</a></li>
<li><a href="purchasehistory.php">View Transation History</a></li>
</ul>
</div>

<form method="POST" action="changepw_action.php" > 
     <div class="section">


<div class="sectionheader">
<h3>Change Password</h3>
</div>
<div class="sectionContent">

<table width="492" height="230" border="0">
  <tbody>
  	<tr>
    <td>Old password</td>
    	<td><input type="password" name="opw"></td>
        
    </tr>
    <tr>
      <td width="279">New Password</td>
      <td width="203"><input name="npw" type="password" required></td>
    </tr>
    
   
    <tr>
      <td>Confirm Password</td>
      <td><input name="cpw" type="password"  required></td>
        
    </tr>
  </tbody>
</table>


</div>
<button type="submit" class="btn btn-default" name="submit" id="asubmit">Save changes</button> 
</form>
</div>
<br>

</div>


</div>


</div>
<script type="text/javascript">
<?php if(isset($_GET['sucess'])) {?> 
    alert("Password Successfully Changed!");
<?php }?>
</script>
    
  </body>
</html>