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
	
$sql_history = "select c.productname,a.QOH, cast(b.invoiceDate as date) as invoicedate , cast( DATE_ADD(b.invoiceDate ,INTERVAL 5 DAY) as date) "
. "AS EXPECTED , d.fullName ,e.recevierName , e.recevierAddress , e.shippingOption  from purchasehistory as a inner join invoice as b on a.invoiceID = b.invoiceID " . 
 "inner join product as c  on a.productID = c.productID inner join customer as d on b.cusID = d.cusID inner join shipping as e on b.cusID = e.cusID";

$history_list = mysqli_query($conn,$sql_history);
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

            
             <li><a href="viewOrder.php">VIEW ORDER</a></li>
              <li><a href="updateProduct.php">UPDATE PRODUCT</a></li>
              <li ><a href="addProduct.php">ADD PRODUCT</a></li>
   
                <li><a href="logout.php">LOGOUT</a></li>
                </ul>
         
                	
       </div>
        <!-- /.container-fluid -->
      </nav>
       </div>
      </div>
      
      <table width="1004" height="85" border="0">
  <tbody>
    <tr>
        <td width="129"><strong>Customer Name</strong></td>
     <td width="129"><strong>Product Name</strong></td>
      <td width="71"><strong>Quantiy</strong></td>
        <td width="89"><strong>Date Purchase</strong></td>
        <td width="89"><strong>Expected Delivery Date</strong></td>
        <td width="89"><strong>Recevier Name</strong></td>
        <td width="89"><strong>Address</strong></td>
        <td width="89"><strong>Shipping option</strong></td>
    </tr>
    
    <?php  while ($pur = mysqli_fetch_assoc($history_list)) { ?>
    <tr>
    <td><?php echo $pur['fullName']; ?></td>
      <td><?php echo $pur['productname']; ?></td>
  		<td><?php echo $pur['QOH']; ?></td>
        <td><?php echo $pur['invoicedate']; ?></td>
      <td><?php echo $pur['EXPECTED']; ?></td>
      <td><?php echo $pur['recevierName']; ?></td>
        <td><?php echo $pur['recevierAddress']; ?></td>
             <td><?php echo $pur['shippingOption']; ?></td>
      

	
</tr>
<?php } ?>


  </tbody>
</table>

      
      
      
      </div>
       
     

  



 
  </body>
</html>