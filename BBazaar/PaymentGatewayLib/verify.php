<?php

require('config.php');
//Include db config file
require '../db.php';
session_start();

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
   $html = "Your payment was successfull";
   $bb_rzp_order_id = $_POST['bb_order_id'];
   $bb_order_id = $_SESSION['final_price_oid']['order_id'];
   if($bb_rzp_order_id == $bb_order_id)
   {
    $uid = $_SESSION['log_id'];
    $sql ="SELECT * FROM ts_orders WHERE ts_order_id='$bb_order_id' and user_id = '$uid'";
    try
        {

        //get db object
        $db= new db();
        //connection_aborted
        $db=$db->connect();
        //Begin transaction
        $db->beginTransaction();
        $stmt=$db->query($sql);
        if($stmt->rowCount() > 0)
        {
            $transaction_status_id_done = 1;
            $sql1 = "update ts_orders set transaction_status_id=:transaction_status_id WHERE ts_order_id='$bb_order_id' and user_id = '$uid'";
            $stmt1 = $db->prepare($sql1);
            $stmt1->bindParam(":transaction_status_id", $transaction_status_id_done);
            $stmt1->execute();
            if($stmt1->rowCount() > 0)
            {
                $db->commit();
                //Delete Session Now
                unset($_SESSION['product_cart']);
                unset($_SESSION['delAdd']);
                unset($_SESSION['ad_c_code']);
                unset($_SESSION['final_price_oid']);

                //Send SMS
                $sendSMSToCustomerConfirm = $customFun->sendSMSToCustomer($order_id);
                $sendSMSToManagerConfirm = $customFun->sendSMSToManager($order_id);
                header ("Location: orderresponse?orderID=" . $bb_order_id . "");

            }
            else
            {
                $html = "Something went wrong";
            }
        }
        else
        {
            $html = "Something went wrong";
        }

        }
        catch(PDOException $e)
         {
            $db->rollback();
            echo '{"error":{"text":'.$e->getMessage().'}}';
         }

   }
    else
    {
        $html = "Something went wrong";
    }
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;
