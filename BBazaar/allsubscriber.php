<?php
session_start();
$user_data = false;
if(!isset($_SESSION['admin_log_id']) && !isset($_SESSION['admin_log_name']) && !isset($_SESSION['log_type']) )
{
header("location: index");
}
else
{
include('functions.php'); 
//get custom object
$customFun= new customFunctions();
  $user_data = true;
  $uid = $_SESSION['admin_log_id'];
  $name = $_SESSION['admin_log_name'];
} 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="icon" href="assets/images/fav-icon.png"  sizes="16x16">
  <title>Biryani Bazaar | Admin</title>
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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="index">BiryaniBazar</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="#">Admin Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
      <?php
      if($user_data)
      {
        ?>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Welcome <?php echo $name;?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="me">My Profile</a>
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
        <a class="nav-link" data-toggle="modal" data-target="#loginModal">Login <span class="sr-only">(current)</span></a>
        </li>

     <?php
      }
      ?>
    </ul>
  </div>
</nav>
<!--NavBar Ends-->
<!--Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">BiryaniBazar</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>          
                    </div>
                    <div class="modal-body">
                      <div class="forms">
                              <div id="signupbox">
                                  <div class="text-left">
                                      <div class="text-center">
                                          Sign Up
                                      </div>
                                      <div class="">
                                          <form id="registrationform">
                                              <div class="form-group">
                                                  <label for="inputName">Name</label>
                                                  <input type="text" name="inputName" class="form-control" id="inputName" placeholder="Your Name">
                                              </div>
                                              <div class="form-group">
                                                  <label for="inputEmail">Email</label>
                                                  <input type="email" name="inputEmail" class="form-control" id="inputEmail" placeholder="Your Email">
                                                  <label for="inputEmail" id="input_email_err"></label>
                                              </div>
                                              <div class="form-group">
                                                  <label for="inputMobile">Mobile</label>
                                                  <input type="text" name="inputMobile" class="form-control" id="inputMobile" placeholder="Your Mobile">
                                                  <label for="inputMobile" id="input_mobile_err"></label>
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
                              <div id="loginbox" style="display:none;">
                                  <div class="text-left">
                                      <div class="text-center">
                                         Sign In
                                      </div>
                                      <div class="">
                                          <form id="loginform">
                                              <div class="form-group">
                                                  <label for="loginEmail">Email</label>
                                                  <input type="email" name="loginEmail" class="form-control" id="loginEmail" placeholder="Your Email">
                                                  <label for="loginEmail" id="user_email_err"></label>
                                              </div>
                                              <div class="form-group">
                                                  <label for="loginPassword">Password</label>
                                                  <input type="password" name="loginPassword" class="form-control" id="loginPassword" placeholder="Your Password">
                                                  <label for="loginPassword" id="user_pwd_err"></label>
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
                      </div>
                    </div>
                  </div>
  </div>
</div>
<!--Login Modal ends-->

<!--First Div -->
<div class="container">
  <div class="row mt-5 mb-5">
    <div class="col-sm-2">
      <nav class="nav flex-column">
        <a class="nav-link active" href="admindashboard">Dashboard</a>
        <a class="nav-link" href="allcustomers">All Customers</a>
        <a class="nav-link" href="allsubscribers">All subscribers</a>
        <a class="nav-link" href="#">Party Order</a>
        <a class="nav-link" href="#">Update Menu</a>
      </nav>
    </div>
    <div class="col-sm-8 card">
    <div class="card-body">
      <?php
      $i = 0;
      $jsonUsersData = $customFun->getAllSubscribers();
      $usersData = json_decode($jsonUsersData, true);
      if($usersData['rc'] == 1)
      {
      ?>
      <div class="table-responsive">
        <table class="table">
              <thead>
              <tr>
                <th>S.No.</th>
                <th>Mobile</th>
                <th>Subscribed On</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                foreach($usersData['rd'] as  $data)
                {
                  $i++;
                ?>
                  <tr>
                   <td><?php echo $i;?></td>
                   <td><?php echo $data['mobile'];?></td>
                   <td><?php echo $data['created_at'];?></td>
                <?php
                }?>
             
              </tbody>
        </table>
      </div>
      <?php
       }
       else if($usersData['rc'] == 2)
       {
      ?>
      <div class="alert alert-primary text-center" role="alert">
        No Subscribers Yet
      </div>
       <?php
       }
       else
       {
       ?>
       <div class="alert alert-primary text-center" role="alert">
        Something went wrong
      </div>
        <?php
       }
       ?>
    </div> 
    </div> 
</div> 
</div> 
<!-- First div ends-->
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