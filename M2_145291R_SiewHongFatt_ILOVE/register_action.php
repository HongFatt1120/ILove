<?php


if(isset($_POST['submit']))
{
	$usrname = $_POST['username'];
	$fname = $_POST['fname'];
	$gender = $_POST['gender'];
	$pwd = $_POST['pwd'];
	$cfpwd = $_POST['cfpwd'];
	$sqn = $_POST['sqn'];
	$sans = $_POST['sans'];
	$email = $_POST['email'];
	$profilePic = $_FILES["dp"]["name"];
	
	
	$fullname = $_POST['fullname'];
	$phoneNo = $_POST['phoneNo'];
	$add = $_POST['address'];
	$ccnum = $_POST['ccnum'];
	$expire = $_POST['date'];
	
	$tosave = $usrname. "_" . $_FILES["dp"]["name"];
	if($pwd != $cfpwd)
	{
		header("Location:register.php?error=1&fname="  .$fname . "&uname=" . $usrname . "&gender=" . $gender . "&sqn=" . $sqn . "&sans=" . $sans . "&email=" . $email . "&fullname=". $fullname ."&phoneNo=". $phoneNo . "&address=". $add . "&ccnum=". $ccnum. "&expire=". $expire );
	}
	else
	{
		$conn = mysqli_connect("localhost", "root", "", "m2_145291R"); 
		$sql_validateID = "SELECT * FROM customer WHERE username = '$usrname'" ;
		$result = mysqli_query($conn,$sql_validateID);
		$row = mysqli_num_rows($result);
		if($row >= 1)
		{
			header("Location:register.php?error=2&fname="  .$fname  . "&gender=" . $gender . "&sqn=" . $sqn . "&sans=" . $sans . "&email=" . $email . "&fullname=". $fullname ."&phoneNo=". $phoneNo . "&address=". $add . "&ccnum=". $ccnum. "&expire=". $expire);
			
		}
		else
		{
		
		if(($_FILES["dp"]["type"] == "image/jpeg") || ($_FILES["dp"]["type"] == "image/jpg")||($_FILES["dp"]["type"] == "image/png"))
		{
	 $target = "cus_dp/" . $usrname . "_" . $_FILES["dp"]["name"];
 
 	$check = move_uploaded_file($_FILES["dp"]["tmp_name"],$target);
	
	$sql_insert = "INSERT INTO customer (fullName,username,gender,password,securityQn,securityAns,email,profilePicture)
					VALUES ('$fname','$usrname','$gender','$pwd','$sqn','$sans','$email','$tosave')";
	
		$result = mysqli_query($conn , $sql_insert);
		
		$cusID = mysqli_insert_id($conn);
		
		$sql_bill = "insert into bill (cusID, fullName,phoneNo,address,creditCardNum,cardExpireDate) VALUES 
	('$cusID','$fullname','$phoneNo','$add','$ccnum','$expire')";
		$bill = mysqli_query($conn,$sql_bill);
		
		header("location:index.php?login");
		
		}
		else
		{
			header("Location:register.php?error=3&fname="  .$fname . "&uname=" . $usrname . "&gender=" . $gender . "&sqn=" . $sqn . "&sans=" . $sans . "&email=" . $email );
		}

		
		
		}
		
	}
	

	
	
	
}

?>