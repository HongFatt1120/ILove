<!doctype html>
<html>
<head>

<meta charset="utf-8">
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
if(isset($_POST['submit']) )
{
$username = $_POST['username'];
$sqn = $_POST['sqn'];
$sans = $_POST['sans'];

$conn = mysqli_connect("localhost","root", "", "m2_145291r");
	$sql_checkpw = "select * from customer where username = '$username' AND securityQn ='$sqn' AND securityAns = '$sans'";
	$check_pw = mysqli_query($conn,$sql_checkpw); 
	$row = mysqli_num_rows($check_pw);

	
}
 ?>
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
            
              
              <li style="display:<?php echo $display1; ?>"><a href="login.php?login">LOGIN</a></li>
              <li style="display:<?php echo $display1; ?>"><a href="register.php">REGISTER</a></li>
              <li><a href="showCart.php">CART(<?php echo $num ?>)</a></li>
     
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
<h3>Forget Password</h3>

<div id="section">
<form method="POST" action="">
<table width="200" border="0">
  <tbody>
    <tr>
      <td>username</td>
      <td><input name="username" Type="text" required ></td>
    </tr>
     <tr>
      <td>security Question:</td>
      <td><select name="sqn">
      <option value="when is your Birthday">when is your Birthday?</option>
      <option value="when is your first love">when is your first love?</option>
      <option value="what is your first pet name">what is your first pet name?</option>
      </select></td>
    </tr>
    <tr>
      <td>Answer:</td>
      <td><input name="sans" type="text" required></td>
    </tr>
  </tbody>
</table>
<input type="submit" class="btn btn-default"  vlaue="submit" name="submit">

</form>
<?php 
if(isset($row))
{
	if($row >=1)
	{
		
		$pw_list = mysqli_fetch_assoc($check_pw);
echo "your password is " . $pw_list['password'];
}
else
{
	echo "invalid";
}
}
?>


</div>
</body>
</html>