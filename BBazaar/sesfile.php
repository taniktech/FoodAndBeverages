<?php
//Activate session to store login credentials
if(isset($_POST["sesid"]))
{
session_start();
$_SESSION["log_id"]=$_POST["sesid"];
$_SESSION["log_name"]=$_POST["sesname"];
}
//Activate session for admin
if(isset($_POST["sesadminid"]))
{
session_start();
$_SESSION["admin_log_id"]=$_POST["sesadminid"];
$_SESSION["admin_log_name"]=$_POST["sesname"];
$_SESSION["log_type"]=$_POST["adminid"];
}
//Activate session to add items to cart mo_id means menu and outlet id
// if(isset($_POST["mo_id"]))
// {

// session_start();
// if(!isset($_SESSION["mo_id"])){
//     //If it doesn't, create an empty array.
//     $_SESSION['mo_id'] = array();
    
// }
// array_push($_SESSION['mo_id'],$_POST["mo_id"]);

// }
if(isset($_POST["mo_id"]) && isset($_POST["quantity"]))
{

$mo_id = $_POST["mo_id"];
$quantity = $_POST["quantity"];
session_start();
$product = array("mo_id"=>$mo_id,"quantity"=>$quantity);

if(!isset($_SESSION["product_cart"])){
    //If it doesn't, create an empty array.
    $_SESSION['product_cart'] = array();
    
}
$_SESSION['product_cart'][$mo_id] = $product;

}
//Remove items from cart
// if(isset($_POST["remove_mo_id"]))
// {


// session_start();
// if (($key = array_search($_POST["remove_mo_id"], $_SESSION['mo_id'])) !== false) {
//     unset($_SESSION['mo_id'][$key]);
// }


// }
if(isset($_POST["remove_mo_id"]))
{

$mo_id = $_POST["remove_mo_id"];
session_start();

unset($_SESSION['product_cart'][$mo_id]);

}
//Update Quantity of an Item
if(isset($_POST["up_mo_id"]) && isset($_POST["up_quantity"]))
{
	$mo_id = $_POST["up_mo_id"];
	$new_quantity = $_POST["up_quantity"];
	session_start();
	if(isset($_SESSION["product_cart"])){

		$_SESSION['product_cart'][$mo_id]['quantity'] = $new_quantity;

	}
}
//Add Coupon Code to Session
if(isset($_POST["ad_c_code"]))
{
	$c_code = $_POST["ad_c_code"];
	session_start();
	if(isset($_SESSION["ad_c_code"])){

	unset($_SESSION['ad_c_code']);

	}
	$_SESSION["ad_c_code"] = $c_code;
}
//Remove Coupon code from session
if(isset($_POST["re_c_code"]))
{
	session_start();
	if(isset($_SESSION["ad_c_code"])){

	unset($_SESSION['ad_c_code']);

	}
	unset($_SESSION['ad_c_code']);
}
// Add delivery Address
if(isset($_POST["delAdd"]))
{
	$delAdd = $_POST["delAdd"];
	session_start();
	if(isset($_SESSION["delAdd"])){

	unset($_SESSION['delAdd']);

	}
	$_SESSION["delAdd"] = $delAdd;

}
// Add delivery Address
if(isset($_POST["reDelAddSess"]))
{
	$addID = $_POST["addID"];
	session_start();
	if(isset($_SESSION["delAdd"]) && ($_SESSION["delAdd"]) == $addID){

	unset($_SESSION['delAdd']);

	}
	

}
//Check address selcted or not
if(isset($_POST["checkSession"]))
{
session_start();
if(isset($_SESSION['log_id']) && isset($_SESSION["product_cart"]) && !empty($_SESSION['product_cart']))
{
  if(!isset($_SESSION["delAdd"]))
  {
  	$rc = "2";
  	$rd = "Address not selected";
	$res['rc'] = $rc;
	$res['rd'] = $rd;
	$json_res = json_encode($res);
	die($json_res);
	

  }	
   else
   {
   	$rc = "1";
	$res['rc'] = $rc;
	$json_res = json_encode($res);
	die($json_res);
	
   }
    
}
else
{
	$rc = "3";
	$res['rc'] = $rc;
	$json_res = json_encode($res);
	die($json_res);
	
}

}
// Repeat Order, add to cart old items
if(isset($_POST["re_mo_id"]))
{

	$oldIDs = $_POST["re_mo_id"];

	if (is_array($oldIDs))
		{
			$i = 0;
			$j = count($oldIDs);
			session_start();
			foreach ($oldIDs as $oneID) {
				$i++;
				$mo_id = $oneID['ts_cart_id'];
				$quantity = $oneID['quantity'];
				$product = array("mo_id"=>$mo_id,"quantity"=>$quantity);

				if(!isset($_SESSION["product_cart"])){
				    //If it doesn't, create an empty array.
				    $_SESSION['product_cart'] = array();
				    
					}

				$_SESSION['product_cart'][$mo_id] = $product;
			}
			if($i == $j)
			{
				$rc="1";
				$res['rc']=$rc;
				$json_res=json_encode($res);
				echo $json_res; 
			}
		}
		else
		{

			$rc="2";
			$res['rc']=$rc;
			$json_res=json_encode($res);
			echo $json_res; 

		}


}
// Add Final Price and Order ID to Session
if(isset($_POST["ad_fp_oid"]))
{
$order_id = $_POST['order_id'];
$final_price = $_POST['f_p'];
session_start();
if(isset($_SESSION['final_price_oid']))
{
	unset($_SESSION['final_price_oid']);
}

$_SESSION['final_price_oid'] = array("order_id"=> $order_id, "final_price"=>$final_price);
$rc="1";
$res['rc']=$rc;
$res['rd'] = $_SESSION['final_price_oid'];
$json_res=json_encode($res);
echo $json_res; 
}
//End of file
?>