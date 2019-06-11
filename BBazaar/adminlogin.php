<?php
session_start();
include('functions.php'); 
//get custom object
$customFun= new customFunctions();
$user_data = false;
if(isset($_SESSION['log_id']) && isset($_SESSION['log_name']))
{
  $user_data = true;
  $uid = $_SESSION['log_id'];
  $name = $_SESSION['log_name'];
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
<!--Login Modal -->
<div class="container w-50 mt-5 mb-5">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">BiryaniBazar</h4>
                      <h4 class="modal-title">Admin Zone</h4>        
                    </div>
                    <div class="modal-body">
                      <div class="forms">
                              <div id="loginbox">
                                  <div class="text-left">
                                      <div class="text-center">
                                         Sign In
                                      </div>
                                      <div class="">
                                          <form id="adminloginform">
                                              <div class="form-group">
                                                  <label for="loginEmail">Email</label>
                                                  <input type="email" name="loginEmail" class="form-control" id="loginEmail" placeholder="Your Email">
                                              </div>
                                              <div class="form-group">
                                                  <label for="loginPassword">Password</label>
                                                  <input type="password" name="loginPassword" class="form-control" id="loginPassword" placeholder="Your Password">
                                              </div>
                                              <button type="submit" id="doSignIn" class="btn btn-primary">Sign In</button>
                                          </form>
                                      </div>
                                      <div class="text-muted">
                                          <div class="col-md-12 control">
                                              <div style="padding-top:15px; padding-left:10px; font-size:85%; margin: 0 -15px;">Don't have an account!
                                                  <a href="#" onClick="$('#loginbox').hide();$('.panel').removeClass('animated shake'); $('#signupbox').show()">Sign Up Here</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div id="signupbox" style="display:none;">
                                  <div class="text-left">
                                      <div class="text-center">
                                          Sign Up
                                      </div>
                                      <div class="">
                                          <form id="adminregistrationform">
                                              <div class="form-group">
                                                  <label for="inputName">Name</label>
                                                  <input type="text" name="inputName" class="form-control" id="inputName" placeholder="Your Name">
                                              </div>
                                              <div class="form-group">
                                                  <label for="inputEmail">Email</label>
                                                  <input type="email" name="inputEmail" class="form-control" id="inputEmail" placeholder="Your Email">
                                              </div>
                                              <div class="form-group">
                                                  <label for="inputMobile">Mobile</label>
                                                  <input type="text" name="inputMobile" class="form-control" id="inputMobile" placeholder="Your Mobile">
                                              </div>
                                              <div class="form-group">
                                                  <label for="inputPassword">Password</label>
                                                  <input type="password" name="inputPassword" class="form-control" id="inputPassword" placeholder="Your Password">
                                              </div>
                                                <button type="submit" id="doSignUp" class="btn btn-primary">Sign up</button>
                                          </form>
                                      </div>
                                      <div class="text-muted">
                                          <div class="col-md-12 control">
                                              <div style="padding-top:15px; padding-left:10px; font-size:85%; margin: 0 -15px;">Already have an account!
                                                  <a href="#" onClick="$('#signupbox').hide(); $('.panel').removeClass('animated shake'); $('#loginbox').show()">Login Here</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                      </div>
                    </div>
                  </div>
                 </div>
<!--Login Modal ends-->

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