<?php
// Razorpay Integration Files Include
require('PaymentGatewayLib/config.php');
require('PaymentGatewayLib/razorpay-php/Razorpay.php');

// Create the Razorpay Order
use Razorpay\Api\Api;
// Razorpay Integration Files Included
session_start();
include('functions.php'); 
//get class object
$customFun= new customFunctions();
$user_data = false;
$cart_data = false;
$c_code = false;
$selDelAdd = false;
if(isset($_SESSION['log_id']) && isset($_SESSION['log_name']))
{
  $user_data = true;
  $uid = $_SESSION['log_id'];
  $name = $_SESSION['log_name'];
}
// All redirection
//1. Looged in users
if(isset($_SESSION['log_id']) && isset($_SESSION['log_name']))
{
  $user_data = true;
  $uid = $_SESSION['log_id'];
  $name = $_SESSION['log_name'];
}
else
{
  header("location: cart");
}
//2. Query string ID check
if (!isset($_GET['id']))
{
  header("location: cart");
}
//3. Order ID match
if($_GET['id']!= $_SESSION['final_price_oid']['order_id'])
{
  header("location: cart");
}

if(isset($_SESSION['product_cart']) && !empty($_SESSION['product_cart']))
{
  $cart_data = true;
}
if(isset($_SESSION['ad_c_code']))
{
  $c_code = true;
}
if(isset($_SESSION['delAdd']))
{
  $selDelAdd = true;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="icon" href="assets/images/fav-icon.png"  sizes="16x16">
  <title>Biryani Bazaar | Cart</title>
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
    <!--Payment Options Modal -->
    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModal" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="background-color: rgba(0, 0, 0, .5);">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Biryani Bazaar</h5>
          </div>
          <div class="modal-body">
            <div class="text-center mb-2">
              <h6 class="card-text">Select Payment Method</h6>
            </div>
            <div class="d-flex flex-row  mb-2">
            <div class="text-left">
              <p class="card-text">Payment To be Made: <i class="fa fa-inr" aria-hidden="true"></i> <?php echo $_SESSION['final_price_oid']['final_price'];?></p>
            </div>
            <div class="ml-auto text-right">
              <p class="card-text"> Order ID : <?php echo $_SESSION['final_price_oid']['order_id'];?> </p>
            </div>
            </div>
            <!-- Cash On Delivery -->
            <div id="codDiv">
            <button type="button" class="btn btn-success" id="codBtn">Cash On Delivery</button>
            </div>
            <!-- Cash On Delivery ends-->
            or
            <!--=====================Payment Gateway=================================--> 
              <?php
              if(isset($_SESSION['final_price_oid']))
              {
              
              $final_price = $_SESSION['final_price_oid']['final_price'];
              $bb_order_id = $_SESSION['final_price_oid']['order_id'];
              $api = new Api($keyId, $keySecret);

              //
              // We create an razorpay order using orders api
              // Docs: https://docs.razorpay.com/docs/orders
              //
              $orderData = [
                  'receipt'         => $bb_order_id,
                  'amount'          => $final_price * 100, // 2000 rupees in paise
                  'currency'        => 'INR',
                  'payment_capture' => 1 // auto capture
              ];

              $razorpayOrder = $api->order->create($orderData);
              // Get Logged In user Details
              $userInfo = $customFun->getUserInfo();
              $razorpayOrderId = $razorpayOrder['id'];

              $_SESSION['razorpay_order_id'] = $razorpayOrderId;

              $displayAmount = $amount = $orderData['amount'];

              if ($displayCurrency !== 'INR')
              {
                  $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
                  $exchange = json_decode(file_get_contents($url), true);

                  $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
              }

              $checkout = 'automatic';
              $data = [
                  "key"               => $keyId,
                  "amount"            => $amount,
                  "name"              => "Biryani Bazaar",
                  "description"       => "Biryani Bazaar Payment",
                  "image"             => "http://biryanibazaar.in/assets/images/logo-bb.png",
                  "prefill"           => [
                  "name"              => $userInfo['name'],
                  "email"             => $userInfo['email'],
                  "contact"           => $userInfo['mobile'],
                  ],
                  "notes"             => [
                  "address"           => "N/A",
                  "merchant_order_id" => $bb_order_id,
                  ],
                  "theme"             => [
                  "color"             => "#F37254"
                  ],
                  "order_id"          => $razorpayOrderId,
              ];

              if ($displayCurrency !== 'INR')
              {
                  $data['display_currency']  = $displayCurrency;
                  $data['display_amount']    = $displayAmount;
              }

              $json = json_encode($data);

              require("PaymentGatewayLib/checkout/{$checkout}.php");
              }
              ?>
            <!--=====================Payment Gateway ends==========================--> 
          </div>
        </div>
      </div>
    </div>

     <!--Payment Options Modal ends-->
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
    <script>
    $(document).ready(function(){
      $(".razorpay-payment-button").addClass("btn btn-success");
      $('#paymentModal').modal('show');

    });
    </script>
</body>
</html>