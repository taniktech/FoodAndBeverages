<?php
error_reporting(0);
if(isset($_POST) && isset($_POST['_token']))
{
//Include db config file
//Functions.php has db.php so no need to require
//require 'db.php';
require 'functions.php'; 
/* Add new Admin*/
if($_POST['_token'] == "newAdReg")
{
		$name = $_POST['name'];
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password = md5($password);
		$user_type_id = 2;
		$sql = "SELECT * FROM ts_users WHERE mobile='$mobile' and user_type_id = '$user_type_id'";
		$sql1 = "SELECT * FROM ts_users WHERE email='$email'and user_type_id = '$user_type_id'";
		$sql2="insert into ts_users(name,mobile,email, password, user_type_id) values(:name,:mobile,:email,:password, :user_type_id)";
		try
		{

			// get db object

			$db = new db();

			// connection

			$db = $db->connect();
			$stmt = $db->query($sql);
			$stmt1 = $db->query($sql1);
			$checkMobile = 0;
			$checkEmail = 0;
			if ($stmt->rowCount() > 0)
			{
				$checkMobile = 1;
			}

			if ($stmt1->rowCount() > 0)
			{
				$checkEmail = 1;
			}

			if ($checkMobile == 1 && $checkEmail == 0)
			{
				$rc = "3";
				$rd = "Your Phone Number is already with us. Please Login.";
				$res['rc'] = $rc;
				$res['rd'] = $rd;
				$json_res = json_encode($res);
				echo $json_res;
			}
			else
			if ($checkMobile == 0 && $checkEmail == 1)
			{
				$rc = "2";
				$rd = "Your Email is already with us. Please Login.";
				$res['rc'] = $rc;
				$res['rd'] = $rd;
				$json_res = json_encode($res);
				echo $json_res;
			}
			else
			if ($checkMobile == 1 && $checkEmail == 1)
			{
				$rc = "2";
				$rd = "It seems you are already registered, Please login ";
				$res['rc'] = $rc;
				$res['rd'] = $rd;
				$json_res = json_encode($res);
				echo $json_res;
			}
			else
			if ($checkMobile == 0 && $checkEmail == 0)
			{
				$stmt2=$db->prepare($sql2);
				$stmt2->bindParam(":name",$name);
				$stmt2->bindParam(":mobile",$mobile);
				$stmt2->bindParam(":email",$email);
				$stmt2->bindParam(":password",$password);
				$stmt2->bindParam(":user_type_id",$user_type_id);
				if($stmt2->execute())
				{
					$uid = $db->lastInsertId();
					$rc = "1";
					$rd = "Registration Successful";
					$uid = $uid;
					$name = $name;
					$user_type_id = $user_type_id;
					$res['rc'] = $rc;
					$res['rd'] = $rd;
					$res['uid'] = $uid;
					$res['name'] = $name;
					$res['user_type_id'] = $user_type_id;
					$json_res = json_encode($res);
					echo $json_res;
				}
				else
				{
					$rc = "404";
					$res['rc'] = $rc;
					$json_res = json_encode($res);
					echo $json_res;
				}	
				
			}
			else
			{
				$rc = "2";
				$rd = "Unable to complete your request at this moment";
				$res['rc'] = $rc;
				$res['rd'] = $rd;
				$json_res = json_encode($res);
				echo $json_res;
			}
		}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }

}
/* Add new customer*/
if($_POST['_token'] == "newReg")
{
		$name = $_POST['name'];
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password = md5($password);
		$user_type_id = 1;
		$sql = "SELECT * FROM ts_users WHERE mobile='$mobile' and user_type_id = '$user_type_id'";
		$sql1 = "SELECT * FROM ts_users WHERE email='$email'and user_type_id = '$user_type_id'";
		$sql2="insert into ts_users(name,mobile,email, password, user_type_id) values(:name,:mobile,:email,:password, :user_type_id)";
		try
		{

			// get db object

			$db = new db();

			// connection

			$db = $db->connect();
			$stmt = $db->query($sql);
			$stmt1 = $db->query($sql1);
			$checkMobile = 0;
			$checkEmail = 0;
			if ($stmt->rowCount() > 0)
			{
				$checkMobile = 1;
			}

			if ($stmt1->rowCount() > 0)
			{
				$checkEmail = 1;
			}

			if ($checkMobile == 1 && $checkEmail == 0)
			{
				$rc = "3";
				$rd = "Your Phone Number is already with us. Please Login.";
				$res['rc'] = $rc;
				$res['rd'] = $rd;
				$json_res = json_encode($res);
				echo $json_res;
			}
			else
			if ($checkMobile == 0 && $checkEmail == 1)
			{
				$rc = "2";
				$rd = "Your Email is already with us. Please Login.";
				$res['rc'] = $rc;
				$res['rd'] = $rd;
				$json_res = json_encode($res);
				echo $json_res;
			}
			else
			if ($checkMobile == 1 && $checkEmail == 1)
			{
				$rc = "2";
				$rd = "It seems you are already registered, Please login ";
				$res['rc'] = $rc;
				$res['rd'] = $rd;
				$json_res = json_encode($res);
				echo $json_res;
			}
			else
			if ($checkMobile == 0 && $checkEmail == 0)
			{
				$stmt2=$db->prepare($sql2);
				$stmt2->bindParam(":name",$name);
				$stmt2->bindParam(":mobile",$mobile);
				$stmt2->bindParam(":email",$email);
				$stmt2->bindParam(":password",$password);
				$stmt2->bindParam(":user_type_id",$user_type_id);
				if($stmt2->execute())
				{
					$uid = $db->lastInsertId();
					$rc = "1";
					$rd = "Registration Successful";
					$uid = $uid;
					$name = $name;
					$res['rc'] = $rc;
					$res['rd'] = $rd;
					$res['uid'] = $uid;
					$res['name'] = $name;
					$json_res = json_encode($res);
					echo $json_res;
				}
				else
				{
					$rc = "404";
					$res['rc'] = $rc;
					$json_res = json_encode($res);
					echo $json_res;
				}	
				
			}
			else
			{
				$rc = "2";
				$rd = "Unable to complete your request at this moment";
				$res['rc'] = $rc;
				$res['rd'] = $rd;
				$json_res = json_encode($res);
				echo $json_res;
			}
		}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }

}

/* Login customer*/
if($_POST['_token'] == "log")
{

	$email=$_POST['email'];
	$password=$_POST['password'];
	$password = md5($password);
	$user_type_id = 1;
	$sql ="SELECT * FROM ts_users WHERE email='$email'and user_type_id = '$user_type_id'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		if ($userRow['password'] == "$password")
		{
			$rc = "1";
			$rd = "Login Successful";
			$uid = $userRow['user_id'];
			$name = $userRow['name'];
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$res['uid'] = $uid;
			$res['name'] = $name;
			$json_res = json_encode($res);
			echo $json_res;
		}
		else
		{
			$rc = "3";
			$rd = "Invalid Password";
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
			echo $json_res;
		}
	  }	
	  else
	  {
		$rc="2";
		$rd="You are not registered with us yet";
		$res['rc']=$rc;
		$res['rd']=$rd;
		$json_res=json_encode($res);
		echo $json_res; 
	  }	
	  }
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
/* Login Admin*/
if($_POST['_token'] == "adLog")
{

	$email=$_POST['email'];
	$password=$_POST['password'];
	$password = md5($password);
	$user_type_id = 2;
	$sql ="SELECT * FROM ts_users WHERE email='$email'and user_type_id = '$user_type_id'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
		if ($userRow['password'] == "$password")
		{
			$rc = "1";
			$rd = "Login Successful";
			$uid = $userRow['user_id'];
			$name = $userRow['name'];
			$user_type_id = $user_type_id;
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$res['uid'] = $uid;
			$res['name'] = $name;
			$res['user_type_id'] = $user_type_id;
			$json_res = json_encode($res);
			echo $json_res;
		}
		else
		{
			$rc = "3";
			$rd = "Invalid Password";
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
			echo $json_res;
		}
	  }	
	  else
	  {
		$rc="2";
		$rd="You are not registered with us yet";
		$res['rc']=$rc;
		$res['rd']=$rd;
		$json_res=json_encode($res);
		echo $json_res; 
	  }	
	  }
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
// Forgot Password User
if($_POST['_token'] == "fPwdUser")
{

	$mobile=$_POST['mobile'];
	$user_type_id = 1;
	$sql ="SELECT * FROM ts_users WHERE mobile='$mobile'and user_type_id = '$user_type_id'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	  	$mobile = $userRow['mobile'];
	  	$otpVal = rand(100000, 999999);
	  	$is_expired = 0;

		$sql1 = "insert into ts_otps(mobile,otp,is_expired) values(:mobile,:otp,:is_expired)";
		$stmt1 = $db->prepare($sql1);
		$stmt1->bindParam(":mobile", $mobile);
		$stmt1->bindParam(":otp", $otpVal);
		$stmt1->bindParam(":is_expired", $is_expired);
		$stmt1->execute();
		if ($stmt1->rowCount() > 0)
		{
			$message = 'OTP '.$otpVal;
		  	$customFun= new customFunctions();
		  	//Send SMS
			$jsonSendSMSData = $customFun->sendSMS($mobile, $message);
		  	$rc="1";
			$rd="OTP sent";
			$res['rc']=$rc;
			$res['rd']=$rd;
			$res['m']=$mobile;
			$json_res=json_encode($res);
			echo $json_res; 
		}
		else
		{
			$rc = "3";
			$res['rc'] = $rc;
			$json_res = json_encode($res);
			echo $json_res;
		}
	  }	
	  else
	  {
		$rc="2";
		$rd="You are not registered with us yet";
		$res['rc']=$rc;
		$res['rd']=$rd;
		$json_res=json_encode($res);
		echo $json_res; 
	  }	
	  }
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
// Update OTP and new password
if($_POST['_token'] == "verifyOtpFpwd")
{

	$mobile = $_POST['mobile'];
	$otp = $_POST['otp'];
	$newPwd = $_POST['newPwd'];
	$is_expired = 1;

	$sql = "SELECT * FROM ts_otps WHERE mobile='$mobile' and otp='$otp' and is_expired!=$is_expired AND NOW() <= DATE_ADD(created_at, INTERVAL 5 MINUTE)";
	try
	{

		// get db object

		$db = new db();

		// connection

		$db = $db->connect();

		//Begin transaction
		$db->beginTransaction();

		$stmt = $db->query($sql);
		$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($stmt->rowCount() > 0)
		{

			$sql1 = "UPDATE ts_otps SET is_expired = :is_expired WHERE otp='$otp' and mobile='$mobile'";
			$stmt1 = $db->prepare($sql1);
			$stmt1->bindParam(":is_expired", $is_expired);
			$stmt1->execute();
			if ($stmt1->rowCount() > 0)
			{
				$password = md5($newPwd);
				$user_type_id = 1;
				$sql2 = "UPDATE ts_users SET password = :password WHERE mobile='$mobile'";
				$stmt2 = $db->prepare($sql2);
				$stmt2->bindParam(":password", $password);
				if ($stmt2->execute())
				{
					
					$sql3 ="SELECT * FROM ts_users WHERE mobile='$mobile'and user_type_id = '$user_type_id' and password = '$password'";

					$stmt3 = $db->query($sql3);		
					if ($stmt3->rowCount() > 0)
					{
					$db->commit();
					$userRow1 = $stmt3->fetch(PDO::FETCH_ASSOC);
					$rc = "1";
					$rd = "Password changed successfully, logging in..";
					$uid = $userRow1['user_id'];
					$name = $userRow1['name'];
					$user_type_id = $user_type_id;
					$res['rc'] = $rc;
					$res['rd'] = $rd;
					$res['uid'] = $uid;
					$res['name'] = $name;
					$res['user_type_id'] = $user_type_id;
					$json_res = json_encode($res);
					echo $json_res;

					}
					else
					{
						$rc = "3";
						$res['rc'] = $rc;
						$json_res = json_encode($res);
						echo $json_res;
					}
				}
				else
				{
					$rc = "3";
					$res['rc'] = $rc;
					$json_res = json_encode($res);
					echo $json_res;
				}
				
			}
			else
			{
				$rc = "3";
				$res['rc'] = $rc;
				$json_res = json_encode($res);
				echo $json_res;
			}
		}
		else
		{
			$rc = "2";
			$rd = "OTP Expired";
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
			echo $json_res;
		}
	}

	catch(PDOException $e)
	{
		echo '{"error":{"text":' . $e->getMessage() . '}}';
	}
}
//Add to cart 
if($_POST['_token'] == "addTOCart")
{

$ts_menu_details_id = $_POST['qtySelect'];
$sql="insert into ts_cart(ts_menu_details_id) values(:ts_menu_details_id)";
	try
	{
		//get db object
		$db= new db();
		//connection_aborted
		$db=$db->connect();
		$stmt=$db->prepare($sql);
		$stmt->bindParam(":ts_menu_details_id",$ts_menu_details_id);
		if($stmt->execute())
		{
			$ts_cart_id = $db->lastInsertId();
			$rc = "1";
			$rd = "Added To Cart";
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$res['ts_cart_id'] = $ts_cart_id;
			$json_res = json_encode($res);
			echo $json_res;
		}
		else
		{
			echo "No";
		}	
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }

	}
//Remove from cart
if($_POST['_token'] == "removeItem")
{
	$ts_cart_id = $_POST['moid'];
	$sql ="DELETE FROM ts_cart WHERE ts_cart_id='$ts_cart_id'";
	try
	{

		// get db object

		$db = new db();

		// connection_aborted

		$db = $db->connect();
		$stmt = $db->query($sql);
		if ($stmt->execute())
		{
			$rc = "1";
			$rd = $ts_cart_id;
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
			echo $json_res;
		}
	}

	catch(PDOException $e)
	{
		echo '{"error":{"text":' . $e->getMessage() . '}}';
	}


}
//Add new address
if($_POST['_token'] == "addNewAdd")
{
	$uid = 0;
	session_start();
	if(isset($_SESSION['log_id']) && isset($_SESSION['log_name']))
	{
	  $uid = $_SESSION['log_id'];
	}

	$name = $_POST['inputName'];
	$inputAddress1 = $_POST['inputAddress1'];
	$inputAddress2 = $_POST['inputAddress2'];
	$inputCity = "Pune";
	$inputCountry = "India";
	$inputZip = $_POST['inputZip'];
	$mobile = $_POST['inputMobile'];
	$sql ="SELECT * FROM ts_users WHERE user_id='$uid'";
	
	try
	{

		// get db object

		$db = new db();

		// connection_aborted

		$db = $db->connect();
		//Begin transaction
		$db->beginTransaction();

		$stmt = $db->query($sql);
		if ($stmt->rowCount() > 0)
			{

				$sql1="insert into ts_users_address(user_id, name, mobile, address_line_1,address_line_2,city,country, pincode ) values(:user_id,:name, :mobile,:line_1,:line_2,:city,:country,:pin)";
				$stmt1 = $db->prepare($sql1);
				$stmt1->bindParam(":user_id", $uid);
				$stmt1->bindParam(":name", $name);
				$stmt1->bindParam(":mobile", $mobile);
				$stmt1->bindParam(":line_1", $inputAddress1);
				$stmt1->bindParam(":line_2", $inputAddress2);
				$stmt1->bindParam(":city", $inputCity);
				$stmt1->bindParam(":country", $inputCountry);
				$stmt1->bindParam(":pin", $inputZip); 
				$stmt1->execute();
				if ($stmt1->rowCount() > 0)
				{
					$db->commit();
					$rc = "1";
					$rd = "Address Updated";
					$res['rc'] = $rc;
					$res['rd'] = $rd;
					$json_res = json_encode($res);
					echo $json_res;

				}
			}
			else
			{
				echo "Oho";
			}
		
	}

	catch(PDOException $e)
	{
		$db->rollback();
		echo '{"error":{"text":' . $e->getMessage() . '}}';
	}


}
//Update Users Pofiele
if($_POST['_token'] == "upUsProfile")
{
	$uid = 0;
	session_start();
	if(isset($_SESSION['log_id']) && isset($_SESSION['log_name']))
	{
	  $uid = $_SESSION['log_id'];
	}

	$name = $_POST['inputName'];

	$sql ="SELECT * FROM ts_users WHERE user_id='$uid'";
	
	try
	{

		// get db object

		$db = new db();

		// connection_aborted

		$db = $db->connect();
		//Begin transaction
		$db->beginTransaction();

		$stmt = $db->query($sql);
		if ($stmt->rowCount() > 0)
			{
				$sql1 = "update ts_users set name=:name where user_id='$uid'";
				$stmt1 = $db->prepare($sql1);
				$stmt1->bindParam(":name", $name);
				$stmt1->execute();
				if ($stmt1->rowCount() > 0)
				{
					$db->commit();
					$rc = "1";
					$rd = "Profile Updated";
					$res['rc'] = $rc;
					$res['rd'] = $rd;
					$json_res = json_encode($res);
					echo $json_res;

				}
				else
				{
					$rc = "2";
					$res['rc'] = $rc;
					$json_res = json_encode($res);
					echo $json_res;

				}
					

			}
			else
			{
				$rc = "3";
				$res['rc'] = $rc;
				$json_res = json_encode($res);
				echo $json_res;
			}

	}

	catch(PDOException $e)
	{
		$db->rollback();
		echo '{"error":{"text":' . $e->getMessage() . '}}';
	}


}
//Apply Coupon code
if($_POST['_token'] == "checkCoupon")
{

	$cCode = $_POST['inputCouponCode'];
	$sql ="SELECT * FROM ts_coupon_codes WHERE coupon_name='$cCode'";
	try
	{

		// get db object

		$db = new db();

		// connection_aborted

		$db = $db->connect();
		//Begin transaction
		$db->beginTransaction();

		$stmt = $db->query($sql);
		if ($stmt->rowCount() > 0)
		{
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			$ts_coupon_code =  $userRow['ts_coupon_code'];
			$c_name = $userRow['coupon_name'];
			$c_money = $userRow['coupon_money'];
			$rc = "1";
			$res['rc'] = $rc;
			$res['ts_coupon_code'] = $ts_coupon_code;
			$res['c_name'] = $c_name;
			$res['c_money'] = $c_money;
			$json_res = json_encode($res);
			echo $json_res;
		}
		else
		{
			$rc = "2";
			$rd = "Invalid Coupon Code";
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
			echo $json_res;
		}
	}

	catch(PDOException $e)
	{
		echo '{"error":{"text":' . $e->getMessage() . '}}';
	}


}
//Apply Coupon code
if($_POST['_token'] == "checkAddForEdit")
{
	$uid = 0;
	session_start();
	if(isset($_SESSION['log_id']) && isset($_SESSION['log_name']))
	{
	  $uid = $_SESSION['log_id'];
	}
	$add_id = $_POST['addid'];
	$sql ="SELECT * FROM ts_users_address WHERE ts_address_id='$add_id' and user_id='$uid'";
	try
	{

		// get db object

		$db = new db();

		// connection_aborted

		$db = $db->connect();

		$stmt = $db->query($sql);
		if ($stmt->rowCount() > 0)
		{
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			$rc = "1";
			$res['rc'] = $rc;
			$res['rd'] = $userRow;
			$json_res = json_encode($res);
			echo $json_res;
		}
		else
		{
			$rc = "2";
			$res['rc'] = $rc;
			$json_res = json_encode($res);
			echo $json_res;
		}

	}
	catch(PDOException $e)
	{
		echo '{"error":{"text":' . $e->getMessage() . '}}';
	}

}
//Update Users Pofiele
if($_POST['_token'] == "editAdd")
{

	$uid = 0;
	session_start();
	if(isset($_SESSION['log_id']) && isset($_SESSION['log_name']))
	{
	  $uid = $_SESSION['log_id'];
	}
	$name = $_POST['inputEditName'];
	$mobile = $_POST['inputEditMobile'];
	$address_line_1 = $_POST['inputEditAddress1'];
	$address_line_2 = $_POST['inputEditAddress2'];
	$pincode = $_POST['inputEditZip'];
	$addressID = $_POST['addressID'];
	$city = "Pune";
	$country = "India";
	$sql ="SELECT * FROM ts_users_address WHERE ts_address_id='$addressID' and user_id='$uid'";
	
	try
	{

		// get db object

		$db = new db();

		// connection_aborted

		$db = $db->connect();
		//Begin transaction
		$db->beginTransaction();

		$stmt = $db->query($sql);
		if ($stmt->rowCount() > 0)
			{
				$sql1 = "update ts_users_address set name=:name, mobile=:mobile, address_line_1=:address_line_1, address_line_2=:address_line_2, city=:city, country=:country, pincode=:pin where ts_address_id='$addressID' and user_id='$uid'";
				$stmt1 = $db->prepare($sql1);
				$stmt1->bindParam(":name", $name);
				$stmt1->bindParam(":mobile", $mobile);
				$stmt1->bindParam(":address_line_1", $address_line_1);
				$stmt1->bindParam(":address_line_2", $address_line_2);
				$stmt1->bindParam(":city", $city);
				$stmt1->bindParam(":country", $country);
				$stmt1->bindParam(":pin", $pincode);
				$stmt1->execute();
				if ($stmt1->rowCount() > 0)
				{
					$db->commit();
					$rc = "1";
					$rd = "Address Updated";
					$res['rc'] = $rc;
					$res['rd'] = $rd;
					$json_res = json_encode($res);
					echo $json_res;

				}
				else
				{
					$rc = "2";
					$res['rc'] = $rc;
					$json_res = json_encode($res);
					echo $json_res;

				}
					

			}
			else
			{
				$rc = "3";
				$res['rc'] = $rc;
				$json_res = json_encode($res);
				echo $json_res;
			}

	}

	catch(PDOException $e)
	{
		$db->rollback();
		echo '{"error":{"text":' . $e->getMessage() . '}}';
	}


}

// Delete Address
if($_POST['_token'] == "deleteUsersAdd")
{

	$addressID = $_POST['addressID'];
	$uid = 0;
	session_start();
	if(isset($_SESSION['log_id']) && isset($_SESSION['log_name']))
	{
	  $uid = $_SESSION['log_id'];
	}
	$sql ="SELECT * FROM ts_users_address WHERE ts_address_id='$addressID' and user_id='$uid'";
	
	try
	{

		// get db object

		$db = new db();

		// connection_aborted

		$db = $db->connect();
		$stmt = $db->query($sql);
		if ($stmt->rowCount() > 0)
			{
				$sql1 ="DELETE FROM ts_users_address WHERE ts_address_id='$addressID' and user_id='$uid'";
				$stmt1 = $db->query($sql1);
				if ($stmt->execute())
				{
					$rc = "1";
					$res['rc'] = $rc;
					$json_res = json_encode($res);
					echo $json_res;
				}
				else
				{
					$rc = "2";
					$res['rc'] = $rc;
					$json_res = json_encode($res);
					echo $json_res;
				}
			}
			else
			{
				$rc = "2";
				$res['rc'] = $rc;
				$json_res = json_encode($res);
				echo $json_res;
			}

	}

	catch(PDOException $e)
	{
		echo '{"error":{"text":' . $e->getMessage() . '}}';
	}


}
//Load Menu for specific Outlet

if($_POST['_token'] == "loadMenuForOutlet")
{

	$outletID = $_POST['outletID'];
	$sql ="SELECT DISTINCT menu_id FROM ts_menu_details WHERE outlet_id='$outletID'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  		$menuIDs=$stmt->fetchAll(PDO::FETCH_ASSOC);
	  		$data = array();
	  		$customFun= new customFunctions();
	  		foreach ($menuIDs as $key => $value) {
	  			$oneMenu = $customFun->getMenuDetails($value['menu_id']);
	  			$data[] = $oneMenu;
	  		}

			$rc = "1";
			$rd = $data;
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
			echo $json_res;
	  }	
	  else
	  {
		$rc="2";
		$rd="No Menu Availble";
		$res['rc']=$rc;
		$res['rd']=$rd;
		$json_res=json_encode($res);
		echo $json_res; 
	  }	
	  }
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }

}

//Load Quantity for specific Menu

if($_POST['_token'] == "loadQtyForMenu")
{

	$menuID = $_POST['menuID'];
	$outletID = $_POST['outletID'];
	$sql ="SELECT * FROM ts_menu_details WHERE menu_id ='$menuID' and outlet_id = '$outletID'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  		$data=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$rc = "1";
			$rd = $data;
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
			echo $json_res;
	  }	
	  else
	  {
		$rc="2";
		$rd="No Quantity Availble";
		$res['rc']=$rc;
		$res['rd']=$rd;
		$json_res=json_encode($res);
		echo $json_res; 
	  }	
	  }
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }

}
//Cash on Delivery
if($_POST['_token'] == "cOnDel")
{
	$uid = 0;
	session_start();
	if(isset($_SESSION['log_id']) && ($_SESSION['log_id'] > 0) && isset($_SESSION["product_cart"]) && !empty($_SESSION['product_cart']) && isset($_SESSION["delAdd"]))
	{

	  $uid = $_SESSION['log_id'];
	  $product_cart = $_SESSION["product_cart"];
	  $ts_del_add_id = $_SESSION["delAdd"];
	  $loyalty_check = false;
	  //Delete Session Now
	  unset($_SESSION['product_cart']);
	  unset($_SESSION['delAdd']);
	  $total_price = 0;
	  $transaction_status_id_init = 2;
	  if (is_array($product_cart))
	  {
	  	try
		{

		//get db object
		$db= new db();
		//connection_aborted
		$db=$db->connect();
		//Begin transaction
		$db->beginTransaction();

		//Create One order
		$sql="insert into ts_orders(user_id,transaction_status_id, ts_address_id)values(:user_id,:transaction_status_id, :ts_address_id)";
		$stmt=$db->prepare($sql);
		$stmt->bindParam(":user_id",$uid);
		$stmt->bindParam(":transaction_status_id",$transaction_status_id_init);
		$stmt->bindParam(":ts_address_id",$ts_del_add_id);
		$stmt->execute();
		if($stmt->rowCount() > 0)
		{
		//Get Order ID
		$order_id = $db->lastInsertId();	

		$customFun= new customFunctions();
	  	foreach ($product_cart as $key => $value) {

		//Get All info here
		$cartData = $customFun->getCartInfo($value['mo_id']);
		$ts_cart_id = $value['mo_id'];  
     	$qtyData = $customFun->getCartQtyInfo($cartData['ts_menu_details_id']);
     	$thisItemQuantity = $value['quantity'];
     	$thisItemPrice = $qtyData['price'];
     	//Check current ts_cart_id exist or not and then update
     	$sql1 ="SELECT * FROM ts_cart WHERE ts_cart_id='$ts_cart_id'";

		$stmt1=$db->query($sql1);
		if($stmt1->rowCount() > 0)
		{

		$sql2 = "update ts_cart set user_id=:user_id, price=:price, quantity=:quantity, ts_order_id=:ts_order_id where ts_cart_id='$ts_cart_id'";

		$stmt2 = $db->prepare($sql2);
		$stmt2->bindParam(":user_id", $uid);
		$stmt2->bindParam(":price", $thisItemPrice);
		$stmt2->bindParam(":quantity", $thisItemQuantity);
		$stmt2->bindParam(":ts_order_id", $order_id);
		$stmt2->execute();
		if($stmt2->rowCount() > 0)
		{
			
			$total_price = $total_price + ($thisItemQuantity * $thisItemPrice);

		}
		}	


		}

		//Get Copon code if any
		$c_money = 0;
		if(isset($_SESSION["ad_c_code"]))
		{
			$jsonCData = $customFun->getCCodeDetails();
            $cData = json_decode($jsonCData, true);
            if($cData['rc'] == 1)
            {
            
            $c_money = $cData['rd']['coupon_money']; 
            $c_name = $cData['rd']['coupon_name']; 
            if($c_name == 'loyal50')
            {
            	$loyalty_check = true;
            }
        	}
        	unset($_SESSION['ad_c_code']);
		}

		$payble_price = $total_price - $c_money;
		$transaction_status_id = 1;
		$sql3 = "update ts_orders set total_moeny=:total_moeny, coupon_money=:coupon_money, payable_money=:payable_money,transaction_status_id= :transaction_status_id where ts_order_id='$order_id'";

		$stmt3 = $db->prepare($sql3);
		$stmt3->bindParam(":total_moeny", $total_price);
		$stmt3->bindParam(":coupon_money", $c_money);
		$stmt3->bindParam(":payable_money", $payble_price);
		$stmt3->bindParam(":transaction_status_id", $transaction_status_id);
		$stmt3->execute();
		if($stmt3->rowCount() > 0)
		{
			if($loyalty_check)
			{
				$loyalty_flow_id = 2;

				$sql4 = "insert into ts_loyalty_points(user_id,ts_order_id, payable_money, loyalty_flow_id, loyalty_point) values(:user_id,:ts_order_id, :payable_money, :loyalty_flow_id, :loyalty_point)";

				$stmt4 = $db->prepare($sql4);
				$stmt4->bindParam(":user_id", $uid);
				$stmt4->bindParam(":ts_order_id", $order_id);
				$stmt4->bindParam(":payable_money", $payble_price);
				$stmt4->bindParam(":loyalty_flow_id", $loyalty_flow_id);
				$stmt4->bindParam(":loyalty_point", $c_money);
				$stmt4->execute();
			}
			//Add Loyalty point
			$loyalty_flow_id = 1;
			$loyalty_percent = 5;
			$final_loyalty_point = ($payble_price * $loyalty_percent)/100;

			$sql5 = "insert into ts_loyalty_points(user_id,ts_order_id, payable_money, loyalty_flow_id, loyalty_point) values(:user_id,:ts_order_id, :payable_money, :loyalty_flow_id, :loyalty_point)";

			$stmt5 = $db->prepare($sql5);
			$stmt5->bindParam(":user_id", $uid);
			$stmt5->bindParam(":ts_order_id", $order_id);
			$stmt5->bindParam(":payable_money", $payble_price);
			$stmt5->bindParam(":loyalty_flow_id", $loyalty_flow_id);
			$stmt5->bindParam(":loyalty_point", $final_loyalty_point);
			$stmt5->execute();
			if($stmt5->rowCount() > 0)
			{

				$db->commit();
				unset($_SESSION['final_price_oid']);
				//Send SMS
				$sendSMSToCustomerConfirm = $customFun->sendSMSToCustomer($order_id);
				$sendSMSToManagerConfirm = $customFun->sendSMSToManager($order_id);
				$rc = "1";
			  	$rd = $order_id;
				$res['rc'] = $rc;
				$res['rd'] = $rd;
				$json_res = json_encode($res);
				die($json_res);
			
			}
		}

		}

	 	}
	  	catch(PDOException $e)
		 {
		 	$db->rollback();
			echo '{"error":{"text":'.$e->getMessage().'}}';
		 }

	  }

	}
 	else
 	{

  	$rc = "2";
  	$rd = "Something went wrong";
	$res['rc'] = $rc;
	$res['rd'] = $rd;
	$json_res = json_encode($res);
	die($json_res);
	
  	}	


}
// Create Order
if($_POST['_token'] == "creOrder")
{
	$uid = 0;
	session_start();
	if(isset($_SESSION['log_id']) && ($_SESSION['log_id'] > 0) && isset($_SESSION["product_cart"]) && !empty($_SESSION['product_cart']) && isset($_SESSION["delAdd"]))
	{

	  $uid = $_SESSION['log_id'];
	  $product_cart = $_SESSION["product_cart"];
	  $ts_del_add_id = $_SESSION["delAdd"];
	  $loyalty_check = false;
	  $total_price = 0;
	  $transaction_status_id_init = 2;
	  if (is_array($product_cart))
	  {
	  	try
		{

		//get db object
		$db= new db();
		//connection_aborted
		$db=$db->connect();
		//Begin transaction
		$db->beginTransaction();

		//Create One order
		$sql="insert into ts_orders(user_id,transaction_status_id, ts_address_id)values(:user_id,:transaction_status_id, :ts_address_id)";
		$stmt=$db->prepare($sql);
		$stmt->bindParam(":user_id",$uid);
		$stmt->bindParam(":transaction_status_id",$transaction_status_id_init);
		$stmt->bindParam(":ts_address_id",$ts_del_add_id);
		$stmt->execute();
		if($stmt->rowCount() > 0)
		{
		//Get Order ID
		$order_id = $db->lastInsertId();	

		$customFun= new customFunctions();
	  	foreach ($product_cart as $key => $value) {

		//Get All info here
		$cartData = $customFun->getCartInfo($value['mo_id']);
		$ts_cart_id = $value['mo_id'];  
     	$qtyData = $customFun->getCartQtyInfo($cartData['ts_menu_details_id']);
     	$thisItemQuantity = $value['quantity'];
     	$thisItemPrice = $qtyData['price'];
     	//Check current ts_cart_id exist or not and then update
     	$sql1 ="SELECT * FROM ts_cart WHERE ts_cart_id='$ts_cart_id'";

		$stmt1=$db->query($sql1);
		if($stmt1->rowCount() > 0)
		{

		$sql2 = "update ts_cart set user_id=:user_id, price=:price, quantity=:quantity, ts_order_id=:ts_order_id where ts_cart_id='$ts_cart_id'";

		$stmt2 = $db->prepare($sql2);
		$stmt2->bindParam(":user_id", $uid);
		$stmt2->bindParam(":price", $thisItemPrice);
		$stmt2->bindParam(":quantity", $thisItemQuantity);
		$stmt2->bindParam(":ts_order_id", $order_id);
		if($stmt2->execute())
		{		
			$total_price = $total_price + ($thisItemQuantity * $thisItemPrice);
		}

		}	

		}

		//Get Copon code if any
		$c_money = 0;
		if(isset($_SESSION["ad_c_code"]))
		{
			$jsonCData = $customFun->getCCodeDetails();
            $cData = json_decode($jsonCData, true);
            if($cData['rc'] == 1)
            {
            
            $c_money = $cData['rd']['coupon_money']; 
            $c_name = $cData['rd']['coupon_name']; 
            if($c_name == 'loyal50')
            {
            	$loyalty_check = true;
            }
        	}
		}

		$payble_price = $total_price - $c_money;
		$sql3 = "update ts_orders set total_moeny=:total_moeny, coupon_money=:coupon_money, payable_money=:payable_money where ts_order_id='$order_id'";

		$stmt3 = $db->prepare($sql3);
		$stmt3->bindParam(":total_moeny", $total_price);
		$stmt3->bindParam(":coupon_money", $c_money);
		$stmt3->bindParam(":payable_money", $payble_price);
		$stmt3->execute();
		if($stmt3->rowCount() > 0)
		{

				$db->commit();
				$rc = "1";
				$res['rc'] = $rc;
				$res['order_id'] = $order_id;
				$res['amount'] = $payble_price;
				$json_res = json_encode($res);
				die($json_res);
		}

		}

	 	}
	  	catch(PDOException $e)
		 {
		 	$db->rollback();
			echo '{"error":{"text":'.$e->getMessage().'}}';
		 }

	  }

	}
 	else
 	{

  	$rc = "2";
  	$rd = "Something went wrong";
	$res['rc'] = $rc;
	$res['rd'] = $rd;
	$json_res = json_encode($res);
	die($json_res);
	
  	}	

}
//Add new subscriber
if($_POST['_token'] == "addSubsc")
{
	$mobile = $_POST['subscribeMobile'];
	$sql1="insert into ts_subscribers(mobile) values(:mobile)";
	try
		{

		//get db object
		$db= new db();
		//connection_aborted
		$db=$db->connect();
		//Begin transaction
		$db->beginTransaction();
		$stmt = $db->prepare($sql1);
		$stmt->bindParam(":mobile", $mobile);
		$stmt->execute();
		if($stmt->rowCount() > 0)
		{
			$db->commit();
			$rc = "1";
			$rd = "Thanks for subscribing";
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
			echo $json_res;
		}
		else
		{
			$rc = "2";
			$res['rc'] = $rc;
			$json_res = json_encode($res);
			echo $json_res;
		}


		}
		catch(PDOException $e)
		 {
		 	$db->rollback();
			echo '{"error":{"text":'.$e->getMessage().'}}';
		 }
}
// Repeat Order
if($_POST['_token'] == "reOrder")
{
	$uid = 0;
	session_start();
	if(isset($_SESSION['log_id']))
	{
	  $uid = $_SESSION['log_id'];
	}
	$rid = $_POST['rid'];

	$sql ="SELECT * FROM ts_cart WHERE user_id='$uid' and ts_order_id='$rid'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  		$data=$stmt->fetchAll(PDO::FETCH_ASSOC);
	  		$ts_cart_ids = [];
	  		foreach ($data as $oneData) {

	  			$ts_menu_details_id = $oneData['ts_menu_details_id'];
	  			$quantity = $oneData['quantity'];

	  			$sql1="insert into ts_cart(ts_menu_details_id) values(:ts_menu_details_id)";
	  			
	  			$stmt1=$db->prepare($sql1);
				$stmt1->bindParam(":ts_menu_details_id",$ts_menu_details_id);
				if($stmt1->execute())
				{
					$ts_cart_id = $db->lastInsertId();
					$ts_cart_ids[] = array('ts_cart_id'=>$ts_cart_id, 'quantity'=>$quantity);
				}


	  		}
			$rc = "1";
			$rd = $ts_cart_ids;
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
			echo $json_res;
	  }	
	  else
	  {
		$rc="2";
		$res['rc']=$rc;
		$json_res=json_encode($res);
		echo $json_res; 
	  }	

	  }
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }


}
//Loyalty check
if($_POST['_token'] == "lCheck")
{
	$uid = 0;
	session_start();
	if(isset($_SESSION['log_id']))
	{
	  $uid = $_SESSION['log_id'];
	}

	$loylty_flow_id_added = 1;
    $loylty_flow_id_used = 2;
    $loylty_points = 0;
    $added_points = 0;
    $used_points = 0;
	$sql ="SELECT SUM(loyalty_point) FROM ts_loyalty_points where user_id= '$uid' and loyalty_flow_id = '$loylty_flow_id_added'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	
	  	$results = $stmt->fetch(PDO::FETCH_ASSOC);
	  	$added_points_sum = $results['SUM(loyalty_point)'];

	  	if($added_points_sum > 0)
	  	{
	  		$added_points = $added_points_sum;
	  		$sql1 ="SELECT SUM(loyalty_point) FROM ts_loyalty_points where user_id= '$uid' and loyalty_flow_id = '$loylty_flow_id_used'";
	  		
	  		$stmt1=$db->query($sql1);
		  	if($stmt1->rowCount() > 0)
		  	{	
		  		
		  		$results1 = $stmt1->fetch(PDO::FETCH_ASSOC);
		  		$used_points_sum = $results1['SUM(loyalty_point)'];
		  		if($used_points_sum > 0)
		  		{
		  			$used_points = $used_points_sum;

		  		}	  	
		  	}
		  }
		  $loylty_points = $added_points - $used_points;
		  if($loylty_points >= 50)
		  {
		  	$cCode = "loyal50";
		  	$sql2 ="SELECT * FROM ts_coupon_codes WHERE coupon_name='$cCode'";
		  	$stmt2=$db->query($sql2);
		  	if ($stmt2->rowCount() > 0)
			{
				$cRow=$stmt2->fetch(PDO::FETCH_ASSOC);
				$ts_coupon_code =  $cRow['ts_coupon_code'];
				$c_name = $cRow['coupon_name'];
				$c_money = $cRow['coupon_money'];
				$rc = "1";
				$res['rc'] = $rc;
				$res['ts_coupon_code'] = $ts_coupon_code;
				$res['c_name'] = $c_name;
				$res['c_money'] = $c_money;
				$json_res = json_encode($res);
				echo $json_res;
			}
			else
			{
				$rc = "2";
				$rd = "Invalid Coupon Code";
				$res['rc'] = $rc;
				$res['rd'] = $rd;
				$json_res = json_encode($res);
				echo $json_res;
			}

		  }
		  else
		  {
		  	$rc = "2";
			$res['rc'] = $rc;
		  	$res['rd'] = "No loylty points.";
			$json_res = json_encode($res);
		  	echo $json_res;
		  }
		  	
		}
		else
		  {
		  	$rc = "2";
			$res['rc'] = $rc;
		  	$res['rd'] = "No loylty points.";
			$json_res = json_encode($res);
		  	echo $json_res;
		  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }

}
//End of file
}


