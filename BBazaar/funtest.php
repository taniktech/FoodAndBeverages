<?php
session_start();
include('functions.php'); 
//get custom object
$customFun= new customFunctions();
//To check sending sms to customer working or not
// $jsonCustomerData = $customFun->sendSMSToCustomer(1);
// print_r($jsonCustomerData);

// To check sending sms to manager working or not
// $jsonManagerData = $customFun->sendSMSToManager(4);
// print_r($jsonManagerData);

// To check Menu orderd content
// $jsonManagerData = $customFun->getOrderMenuDetails(1);
// print_r($jsonManagerData);

// $jsonManagerData = $customFun->checkLoylty();
// print_r($jsonManagerData);
//$jsonOutletData = $customFun->getOutletDetails(1);
//print_r($jsonOutletData);
$jsonCreateOrder = $customFun->createOrder();
print_r($jsonCreateOrder);
?>