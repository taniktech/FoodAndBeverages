<?php
session_start();
include('functions.php'); 
//get class object
$customFun= new customFunctions();
$user_data = false;
if(isset($_SESSION['log_id']) && isset($_SESSION['log_name']))
{
  $user_data = true;
  $uid = $_SESSION['log_id'];
  $name = $_SESSION['log_name'];
}
else
{
	header("location: index");
}
if(isset($_GET['orderID']))
{

$orderID = $_GET['orderID'];
$jsonData = $customFun->getOrderResponse($orderID);
$data = json_decode($jsonData, true);
if($data['rc'] != 1)
{
	header("location: index");
}
}
else
{
	header("location: index");
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--Font Awsome-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <!--Bootstrap Slecet CSS-->
    <link rel="stylesheet" href="assets/vendors/bootstrap-select/css/bootstrap-select.css">
    <!--Custom CSS-->
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
<!--NavBar-->
<nav class="navbar navbar-expand-lg">
  <div class="container">
     <a class="navbar-brand" href="index">
       <img src="assets/images/logo-bb.png" alt="Biryani Bazaar">
    </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
       <li class="nav-item active">
        <a class="nav-link" href="index" style="font-size: 20px; color: black;">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="tel:+918390000223" style="font-size: 20px; color: black;">+91 8390000223<span class="sr-only" style="font-size: 20px; color: black;">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="cart" style="font-size: 20px; color: black;">Cart <span class="sr-only">(current)</span></a>
      </li>
      <?php
      if($user_data)
      {
        ?>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 20px; color: black;">
         Welcome <?php echo $name;?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="me">My Profile</a>
          <a class="dropdown-item" href="myorders">My Orders</a>
          <a class="dropdown-item" href="mypoints">My Loyalty Points</a>
          <a class="dropdown-item" href="manageaddress">My delivery addresses</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout">Logout</a>
        </div>
      </li>
      <?php
      }
      else
      {
      ?>
        <li class="nav-item active">
        <a class="nav-link" href="javascript:void(0)" id="openLoginModal" style="font-size: 20px; color: black;">Login <span class="sr-only">(current)</span></a>
        </li>

     <?php
      }
      ?>
    </ul>
  </div>
</div>
</nav>
<!--NavBar Ends-->
<!--First Div -->
<div class="container card orderresfirstdiv1 mt-5">
	<div class="row">
	<div class="col-lg-1">
	<img src="assets/images/tick.png">
	</div>
	<div class="col-lg-11">
	<h4>Thank you for your order</h4>
	<p>Your order has been placed and is being processed. When the item(s) are shipped,you will recieve an email with the details. You can track this order through <a href="myorders">My Orders</a> page.</p>
	</div>
	</div>
</div>
<div class="container mt-2">
<div class="row">
	<div class="col-lg-4 card mb-2">
	  <div class="card-body">
	    <h5 class="card-title">Order Details</h5>
	    <div class="d-flex flex-column">


		<div class="p-2">
		  	<div class="d-flex flex-row">
			  <div class="p-2">Order Id</div>
			 
			  <div class="p-2 ml-auto text-right"># BB<?php echo $data['rd']['ts_order_id'];?></div>
			</div>
		</div>
		 <div class="p-2">
		  	<div class="d-flex flex-row">
			  <div class="p-2">Order Date</div>
			 
			  <div class="p-2 ml-auto text-right"><?php echo $data['rd']['created_at'];?></div>
			</div>
		  </div>
		  <div class="p-2">
		  	<div class="d-flex flex-row">
			  <div class="p-2">Total Amount</div>
			 
			  <div class="p-2 ml-auto text-right"> <i class="fa fa-inr" aria-hidden="true"></i> <?php echo $data['rd']['total_moeny'];?> through Cash on delivery</div>
			</div>
		  </div>

		</div>
	    
	  </div>
	</div>
	<div class="col-lg-4 card mb-2">
	  <div class="card-body">
	    <h5 class="card-title">Address</h5>
	  <?php
	  $jsonUsersAddress = $customFun->getUsersDelAddress($data['rd']['ts_address_id']);
	  $usersAddress = json_decode($jsonUsersAddress, true);
	  if($usersAddress['rc'] == 1)
	  {
	  ?>
    	<h5 class="card-title"><?php echo $usersAddress['rd']['name'];?> &nbsp;<?php echo $usersAddress['rd']['mobile'];?></h5>
    	<p class="card-text"><?php echo $usersAddress['rd']['address_line_1'];?>&nbsp;, <?php echo $usersAddress['rd']['address_line_2'];?>
    	<br /><?php echo $usersAddress['rd']['city'];?>, <?php echo $usersAddress['rd']['country'];?> - <?php echo $usersAddress['rd']['pincode'];?></p>
    <?php
	  }
	  ?>
	  </div>
	</div>
</div>
</div>
 <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--JQuery Validate -->
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <!--Custom App Js-->
    <script src="assets/js/app.js"></script>
    <!--Bootstrap Slecet JS-->
    <script src="assets/vendors/bootstrap-select/js/bootstrap-select.js"></script>
  </body>
</html>