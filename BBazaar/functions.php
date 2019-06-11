<?php
//Include db config file
require 'db.php';
class customFunctions
{

//To Get Outlet availble in Index page

public function getAvailableOutlets()
{
	$sql ="SELECT DISTINCT outlet_id FROM ts_menu_details";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$outletResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
	  	$rc = "1";
		$res['rc'] = $rc;
		$res['rd'] = $outletResults;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	  else
	  {
	  	$rc = "2";
		$res['rc'] = $rc;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
// Get Outlet Details
public function getOutletDetails($o_id)
{
	$sql ="SELECT * FROM ms_outlets where outlet_id = '$o_id'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$outletResults = $stmt->fetch(PDO::FETCH_ASSOC);

	  	return $outletResults;
	  }
	  else
	  {

	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
//To Get menu availble in Index page

public function getMenuDetails($m_id)
{
	$sql ="SELECT * FROM ms_menus where menu_id = '$m_id'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$outletResults = $stmt->fetch(PDO::FETCH_ASSOC);
	  	
	  	return $outletResults;
	  }
	  else
	  {

	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}

//Get details of cart's biryani
public function getCartInfo($mo_id)
{

	$sql ="SELECT * FROM ts_cart where ts_cart_id='$mo_id'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$cartResults = $stmt->fetch(PDO::FETCH_ASSOC);
	  	
	  	return $cartResults;
	  }
	  else
	  {

	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
//Get details of cart's biryani menu details
public function getCartQtyInfo($menu_detail_id)
{

	$sql ="SELECT * FROM ts_menu_details where ts_menu_details_id='$menu_detail_id'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$cartResults = $stmt->fetch(PDO::FETCH_ASSOC);
	  	
	  	return $cartResults;
	  }
	  else
	  {

	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
//Get User's detaild
public function getUserInfo()
{

	$uid = 0;
	if(isset($_SESSION['log_id']) && isset($_SESSION['log_name']))
	{
	  $uid = $_SESSION['log_id'];
	}
	if(isset($_SESSION['admin_log_id']))
	{
		$uid = $_SESSION['admin_log_id'];
	}
	$sql ="SELECT * FROM ts_users where user_id='$uid'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$userResults = $stmt->fetch(PDO::FETCH_ASSOC);
	  	
	  	return $userResults;
	  }
	  else
	  {

	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
//Get User's details
public function getAllUsersInfo()
{

	$user_type_id = 1;
	$sql ="SELECT * FROM ts_users where user_type_id='$user_type_id'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$userResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
	  	$rc = "1";
		$res['rc'] = $rc;
		$res['rd'] = $userResults;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	  else
	  {
	  	$rc = "2";
		$res['rc'] = $rc;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
//Get User's address details
public function getUsersAddress()
{

	$uid = 0;
	if(isset($_SESSION['log_id']) && isset($_SESSION['log_name']))
	{
	  $uid = $_SESSION['log_id'];
	}
	if(isset($_SESSION['admin_log_id']))
	{
		$uid = $_SESSION['admin_log_id'];
	}
	$sql ="SELECT * FROM ts_users_address where user_id='$uid'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$userResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
	  	$rc = "1";
		$res['rc'] = $rc;
		$res['rd'] = $userResults;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	  else
	  {
	  	$rc = "2";
		$res['rc'] = $rc;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
//Get Applied Coupon code applied details
public function getCCodeDetails()
{

	$c_code = 0;
	if(isset($_SESSION['ad_c_code']))
	{
	  $c_code = $_SESSION['ad_c_code'];
	}
	$sql ="SELECT * FROM ts_coupon_codes where ts_coupon_code='$c_code'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$rowResults = $stmt->fetch(PDO::FETCH_ASSOC);
	  	$rc = "1";
		$res['rc'] = $rc;
		$res['rd'] = $rowResults;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	  else
	  {
	  	$rc = "2";
		$res['rc'] = $rc;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}

//Get Order Response
public function getOrderResponse($orderID)
{

	$uid = 0;
	if(isset($_SESSION['log_id']))
	{
	  $uid = $_SESSION['log_id'];
	}
	$transaction_status_id = 1;
	$sql ="SELECT * FROM ts_orders where user_id='$uid' and ts_order_id= '$orderID' and transaction_status_id = '$transaction_status_id'";
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
	  	$rc = "1";
		$res['rc'] = $rc;
		$res['rd'] = $results;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	  else
	  {
	  	$rc = "2";
		$res['rc'] = $rc;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
//Get User's delivery address details
public function getUsersDelAddress($del_add)
{

	$uid = 0;
	if(isset($_SESSION['log_id']))
	{
	  $uid = $_SESSION['log_id'];
	}
	$sql ="SELECT * FROM ts_users_address where user_id='$uid' and ts_address_id='$del_add'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$userResults = $stmt->fetch(PDO::FETCH_ASSOC);
	  	$rc = "1";
		$res['rc'] = $rc;
		$res['rd'] = $userResults;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	  else
	  {
	  	$rc = "2";
		$res['rc'] = $rc;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
//Get Users Order
public function getUserOrders()
{

	$uid = 0;
	if(isset($_SESSION['log_id']))
	{
	  $uid = $_SESSION['log_id'];
	}
	$transaction_status_id = 1;
	$sql ="SELECT * FROM ts_orders where user_id='$uid' and transaction_status_id = '$transaction_status_id'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	  	$rc = "1";
		$res['rc'] = $rc;
		$res['rd'] = $results;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	  else
	  {
	  	$rc = "2";
		$res['rc'] = $rc;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
// Get Menu and Outlet details from order ID
public function getOrderMenuDetails($orderID)
{

	$sql ="SELECT * FROM ts_cart where ts_order_id='$orderID'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	  	$rc = "1";
		$res['rc'] = $rc;
		$res['rd'] = $results;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	  else
	  {
	  	$rc = "2";
		$res['rc'] = $rc;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }


}




//Global Send SMS function
public function sendSMS($to_mobile, $message)
{
		
		$mobile = $to_mobile;
		$message = $message;
		//Please Enter Your Details
		$username="biryanibazaar007"; //your username
		$password="Biryani007@"; //your password
		$mobile="91".$mobile; //enter Mobile numbers comma seperated
		$message =$message;
		$senderid="bbazar"; //Your senderid
		$stype= 2; //Type Of Your Message
		$url="http://www.metamorphsystems.com/index.php/api/bulk-sms";
		$message = urlencode($message);
		$ch = curl_init();
		if (!$ch){die("Couldn't initialize a cURL handle");}
		$ret = curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt ($ch, CURLOPT_POSTFIELDS,
		"username=$username&password=$password&from=$senderid&to=$mobile&message=$message&sms_type=$stype");
		$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//If you are behind proxy then please uncomment below line and provide your proxy ip with port.
		// $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
		$curlresponse = curl_exec($ch); // execute
		if(curl_errno($ch))
		return 'curl error : '. curl_error($ch);
		if (empty($ret))
		{
		// some kind of an error happened
		die(curl_error($ch));
		curl_close($ch); // close cURL handler
		} 
		else 
		{
			$info = curl_getinfo($ch);
			curl_close($ch); // close cURL handler
			return $curlresponse;
			
		}
}


//Send SMS to Customer
public function sendSMSToCustomer($orderID)
{

	$transaction_status_id = 1;
	$sql ="SELECT * FROM ts_orders where ts_order_id= '$orderID' and transaction_status_id = '$transaction_status_id'";
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
	  	//Get Order Details
	  	$user_id = $results['user_id'];
	  	$delivery_address_id = $results['ts_address_id'];
	  	$order_id = $results['ts_order_id'];
	  	$bill = $results['payable_money'];
	  	
	  	//Get Delivery Address and mobile no
	  	$customFun= new customFunctions();
	  	$jsonAddressData = $customFun->getUsersDelAddress($delivery_address_id);
	  	$addressData = json_decode($jsonAddressData, true);
        if($addressData['rc'] == 1)
        {
        	$cust_name = $addressData['rd']['name'];
        	$cust_mobile = $addressData['rd']['mobile'];
        	
        }

        //Prepare Message
	  	$customeMessage = "Thanks $cust_name for ordering! Your order id is #BB$order_id. Your total bill is Rs. $bill. For delivery enquiry call us at 8390000223";

	  	$jsonSendSMSData = $customFun->sendSMS($cust_mobile, $customeMessage);  	
	  	$sensSMSData = json_decode($jsonSendSMSData, true);
	  	if($sensSMSData['JobId'] > 1)
	  	{
	  		$rc = "1";
	  		$rd = "SMS Sent to customer";
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
		  	return $json_res;
	  	}
	  	else
	  	{
	  		$rc = "2";
	  		$rd = "Something went wrong";
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
		  	return $json_res;
	  	}

	  }
	  else
	  {
	  	$rc = "3";
		$res['rc'] = $rc;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}

//Send SMS to Biryani Bazaar Manager
public function sendSMSToManager($orderID)
{

	$transaction_status_id = 1;
	$sql ="SELECT * FROM ts_orders where ts_order_id= '$orderID' and transaction_status_id = '$transaction_status_id'";
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
	  	//Get Order Details
	  	$user_id = $results['user_id'];
	  	$delivery_address_id = $results['ts_address_id'];
	  	$order_id = $results['ts_order_id'];
	  	$total_moeny = $results['total_moeny'];
	  	$coupon_money = $results['coupon_money'];

	  	$bill = $results['payable_money'];
	  	$menuMessage = [];
	  	//Get Orderd Menu and outlet details


	  	
	  	//Get Delivery Address
	  	$customFun= new customFunctions();
	  	$jsonAddressData = $customFun->getUsersDelAddress($delivery_address_id);
	  	$addressData = json_decode($jsonAddressData, true);
        if($addressData['rc'] == 1)
        {
        	$cust_name = $addressData['rd']['name'];
        	$cust_mobile = $addressData['rd']['mobile'];
        	$cust_add_line_1 = $addressData['rd']['address_line_1'];
        	$cust_add_line_2 = $addressData['rd']['address_line_2'];
        	$cust_city = $addressData['rd']['city'];
        	$cust_pincode = $addressData['rd']['pincode'];

        	$cust_full_address = $cust_add_line_1.", ".$cust_add_line_2.", ".$cust_city.", ".$cust_pincode;
        }
        //Get all menu details and outlet details
       	$jsonMenuData = $customFun->getOrderMenuDetails($orderID);
	  	$menuData = json_decode($jsonMenuData, true);
        if($menuData['rc'] == 1)
        {
        	$i = 0;
        	foreach($menuData['rd'] as  $data)
    		{
    			$i++;
        		$menuDetails = $customFun->getCartQtyInfo($data['ts_menu_details_id']);
        		$menuOrdered = $customFun->getMenuDetails($menuDetails['menu_id']);
        		$outletDetails = $customFun->getOutletDetails($menuDetails['outlet_id']);
        		
        		//Frame a menu message
        		$menuMessage[] = "Item ( $i ) : ".$menuOrdered['menu']. ", from : ".$outletDetails['outlet']. ", Quantity : ".$data['quantity']. " - ". $menuDetails['qty']."; ";
       		}
        }
        $menuMessage = implode(" ", $menuMessage); 
        //Prepare Message
	  	$customeMessage = "Cust Name : $cust_name; Mobile : $cust_mobile; Address : $cust_full_address; Total Amount: $total_moeny; Coupon Discount : $coupon_money; Order Total : $bill; Items Ordered : ".$menuMessage;

	  	//This message has to be sent to Outlet Manager
	  	$manager_mobile_no = 8390000223;

	  	$jsonSendSMSData = $customFun->sendSMS($manager_mobile_no, $customeMessage);  	
	  	$sensSMSData = json_decode($jsonSendSMSData, true);
	  	if($sensSMSData['JobId'] > 1)
	  	{
	  		$rc = "1";
	  		$rd = "SMS Sent to manager";
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
		  	return $json_res;
	  	}
	  	else
	  	{
	  		$rc = "2";
	  		$rd = "Something went wrong";
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
		  	return $json_res;
	  	}

	  }
	  else
	  {
	  	$rc = "3";
		$res['rc'] = $rc;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
//To Get All subscribers list

public function getAllSubscribers()
{
	$sql ="SELECT * FROM ts_subscribers";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	  	$rc = "1";
		$res['rc'] = $rc;
		$res['rd'] = $results;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	  else
	  {
	  	$rc = "2";
		$res['rc'] = $rc;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}

// Check for Loylty points

public function checkLoylty()
{
	$uid = 0;
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
	  	$sql2 ="SELECT * FROM ts_loyalty_points where user_id= '$uid'";
	  	$stmt2=$db->query($sql2);
	  	$fullData = $stmt2->fetchAll(PDO::FETCH_ASSOC);

	  	$loylty_points = $added_points - $used_points;
	  	$rc = "1";
		$res['rc'] = $rc;
		$res['rd'] = $loylty_points;
		$res['fullData'] = $fullData;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	  else
	  {
	  	$rc = "2";
		$res['rc'] = $rc;
		$res['rd'] = $loylty_points;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
// Get all coupon code availble
public function getCoupons()
{
	$sql ="SELECT * FROM ts_coupon_codes";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	  	$rc = "1";
		$res['rc'] = $rc;
	  	$res['rd'] = $results;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	  else
	  {
	  	$rc = "2";
		$res['rc'] = $rc;
	  	$res['rd'] = "No coupon code availble.";
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}

// Check loylty eligibilty
public function checkLoyltyEligibilty()
{
	$uid = 0;
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
		  	$rc = "1";
			$res['rc'] = $rc;
			$res['points'] = $loylty_points;
			$res['rd'] = "Loyal50";
			$json_res = json_encode($res);
		  	return $json_res;
		}
		else
		  {
		  	$rc = "2";
			$res['rc'] = $rc;
		  	$res['rd'] = "No loylty points.";
			$json_res = json_encode($res);
		  	return $json_res;
		  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
//End of file
}

?>