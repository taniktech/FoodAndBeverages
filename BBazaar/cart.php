<?php
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
        <a class="nav-link" href="tel:+918390000223" style="font-size: 20px; color: black;">+91-8390000223<span class="sr-only" style="font-size: 20px; color: black;">(current)</span></a>
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
        <a class="nav-link" href="javascript:void(0)" id="openLoginModal" style="font-size: 20px; color: black;">Login & Signup <span class="sr-only">(current)</span></a>
        </li>

     <?php
      }
      ?>
    </ul>
  </div>
</div>
</nav>
<!--NavBar Ends-->

<!--First Div, to add more items from same cart page -->
<div class="container">
<div class="card mt-5">
  <div class="card-body">
      <div class="row text-center">
      <form id="indexOrderForm" class="form-inline" method="post">
        <div class="row" style="display:none">
          <div class="form-group col-md-4">
            <label for="uid">UID</label>
            <input type="text" class="form-control" name="pid" id="pid" value="<?php
            if($user_data)
            {echo $uid; }?>">
          </div>
          <div class="form-group col-md-4">
            <label for="uid">Token</label>
            <input type="text" class="form-control" name="_token" id="_token" value="addTOCart">
          </div>
        </div>
          <div class="form-group col-sm-3">
            <label for="outletSelect">Select Outlet</label>
            <select class="selectpicker required" id="outletSelect" name="outletSelect">
              <option value="">Select Outlet</option>           
              <?php
              $jsonOutletData = $customFun->getAvailableOutlets();
              $outletData = json_decode($jsonOutletData, true);
              if($outletData['rc'] == 1)
              {
              foreach ($outletData['rd'] as $key => $value) 
              {
                $outletDetails = $customFun->getOutletDetails($value['outlet_id'])

                ?>
              <option value="<?php echo $outletDetails['outlet_id'];?>"><?php echo $outletDetails['outlet'];?></option>
              <?php
              }

              }
               ?>
            </select>
          </div>
          <div class="form-group col-sm-3">
            <label for="menuSelect">Select Menu</label>
            <select class="selectpicker required" id="menuSelect" name="menuSelect">
              <option value="">Select Menu</option>
            </select>
          </div>
          <div class="form-group col-sm-3">
            <label for="qtySelect">Select Quantity</label>
            <select class="selectpicker required" id="qtySelect" name="qtySelect">
              <option value="">Select Quantity</option>
            </select>
          </div>
        <input type="hidden" name="type" value="test">
        <div class="col-sm-3 mt-4">
        <label for="goBtnID"></label>
        <button type="submit" class="btn btn-success btn-lg yello-btn" id="goToCartBtnID">Add More</button>
        </div>
    </form>
    </div>
  </div>
</div>
</div>
<!-- First Div ends here-->
<!--Second div, details about items added to cart-->

<div class="container mt-3 mb-3">
  <div class="row">
    <div class="col-sm-7 mb-2">
     <?php
    if($cart_data)
    {
    ?>
      <div class="card">
      <div class="card-header">
        Cart items ( <?php echo count($_SESSION['product_cart']);?> )
      </div>
      <ul class="list-group list-group-flush">
    <?php
    $i = 0;
    foreach($_SESSION['product_cart'] as  $data)
    {
      $i++;
      $cartData = $customFun->getCartInfo($data['mo_id']);

      $qtyData = $customFun->getCartQtyInfo($cartData['ts_menu_details_id']);
      $menuData = $customFun->getMenuDetails($qtyData['menu_id']);
      $outletData = $customFun->getOutletDetails($qtyData['outlet_id']);
    ?>
        <!-- Test Data -->
    <div class="row" style="display: none;">

      <div class="form-group">
      <label for="test_menu_price_id"></label>
      <input type="text" class="form-control" id="test_menu_price_id<?php echo $i;?>" placeholder="Test Menu Price" value="<?php echo $qtyData['price'];?>">
      </div>

    </div>
    <!--Test Data ends -->

        <li class="list-group-item">
          <div class="d-flex flex-column">
            <div class="d-flex flex-row">

<!--               <div class="p-2">
                  <img class="rounded float-left img-fluid" src="http://placehold.it/100x100" alt="Biryani Image">
              </div> -->

              <div class="p-0 ml-2 text-left">
                <p class="card-text">Item : <?php echo $menuData['menu'];?> ( <?php echo $qtyData['qty'];?> ) </p>
                <p class="card-text">Price : <i class="fa fa-inr" aria-hidden="true"></i> <?php echo $qtyData['price'];?> </p>    
                <p class="card-text">Note : <?php echo $qtyData['comment'];?> </p>        
              </div>

              <div class="p-0 ml-auto text-right">
                <p class="card-text">From : <?php echo $outletData['outlet'];?></p>
                <p class="card-text">Total : <i class="fa fa-inr" aria-hidden="true"></i> <span id="thisItemTotal<?php echo $i;?>" class="txtCal"><?php echo $qtyData['price']*$data['quantity'];?></span></p>
              </div>

            </div>

              <div class="d-flex flex-row">
                <div class="p-2">
                <button type="button" class="btn btn-warning qtyminus" data-goidm="<?php echo $i;?>" data-gomoidm="<?php echo $data['mo_id'];?>" field='itemQuantity<?php echo $i;?>'><i class="fa fa-minus" aria-hidden="true"></i></button>
                </div>
                <div class="p-2 w-25">
                  <div class="form-group">
                    <input type="text" class="form-control oneItemQuantity" disabled name='itemQuantity<?php echo $i;?>' id="itemQuantity<?php echo $i;?>" value='<?php echo $data['quantity'];?>'>
                  </div>
                </div>
                <div class="p-2">
                  <button type="button" class="btn btn-success qtyplus" data-goidp="<?php echo $i;?>" data-gomoidp="<?php echo $data['mo_id'];?>" field='itemQuantity<?php echo $i;?>'><i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>
                <div class="p-2 ml-auto">
                <button class="btn btn-danger btn-sm remove" data-moid="<?php echo $data['mo_id'];?>"><i class="fa fa-trash-o"></i></button>
                </div>
              </div>
          </div>
      </li>
      <?php
    }
    ?>
    </ul>
    </div>
    <?php
    }
    else
    {
    ?>
    <div class="card">
      <div class="card-header">
        Cart items ( 0 )
      </div>
      <div class="card-body">
      <div class="text-center">
        <img src="assets/images/bb-background/empty-cart.png" class="rounded img-fluid" alt="Cart is empty" style="height: 170px;">
      </div>
      </div>
    </div>
    <?php
    }
    ?>
<!-- Fourth div, show address when user is logged in-->
  <?php
  if($user_data && $cart_data)
  {
    $userInfo = $customFun->getUserInfo();
  ?>
<div class="card mt-2 mb-2">
  <h5 class="card-header" style="">Delivery Address</h5>
  <div class="row" id="selectDelAdd">
   <?php
  $i = 0;
  $jsonUsersAddress = $customFun->getUsersAddress();
  $usersAddress = json_decode($jsonUsersAddress, true);
  if($usersAddress['rc'] == 1)
  {
    foreach($usersAddress['rd'] as  $data)
    {
    ?>
  <div class="col-sm-6">
  <div class="card-body">

    <div class="d-flex flex-row">
      <div class="input-group-prepend">
        <div class="input-group-text">
        <input type="radio" name="userThisAddress[]" <?php if($selDelAdd && $_SESSION['delAdd'] ==$data['ts_address_id']) {?> checked <?php } ?> value="<?php echo $data['ts_address_id'];?>">
        </div>
    </div>
      <div class="ml-auto">
       <a href="javascript:void(0)" class="openEditAddressModal" data-addid="<?php echo $data['ts_address_id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: green;"></i><span style="color: green;"> Edit</span></a>
      </div>
    </div>

    
    <h5 class="card-title"><?php echo $data['name'];?> &nbsp;<?php echo $data['mobile'];?></h5>
    <p class="card-text"><?php echo $data['address_line_1'];?>&nbsp;, <?php echo $data['address_line_2'];?>
    <br /><?php echo $data['city'];?>, <?php echo $data['country'];?> - <?php echo $data['pincode'];?></p>
  </div>
  </div>
  <?php
  }
  }
  ?>
</div>

  <div class="card-body">
    <a href="#" data-toggle="modal" data-target="#addressModal" class="btn btn-success">Add New</a>
  </div>

</div>
<?php
  }
  ?>

<!--Fourth Div ends here-->
    </div>

  <div class="col-sm-5">
    <?php
    if($cart_data)
    {
    ?>
            

    <div class="card mb-2">
      <div class="card-body">
      <div class="applyCouponDiv" <?php if($c_code){ ?> style="display: none;<?php } ?>">
        <h5 class="card-title p-2">Have a Coupon Code ?</h5>
        <!--Apply Coupon Code Form-->
        <form id="applyCouponCodeForm">
        <div class="row" style="display:none">
          <div class="form-group col-md-4">
            <label for="_token">Token</label>
            <input type="text" class="form-control" name="_token" id="_token" value="checkCoupon">
          </div>
        </div>
          <div class="input-group">  
          <input type="text" class="form-control" placeholder="Enter Coupon Code" aria-label="Enter Coupon Code" name="inputCouponCode" id="inputCouponCode" aria-describedby="applyCouponBtn">

          <div class="input-group-append">
            <button class="btn btn-success" id="applyCouponBtn" type="submit">Apply</button>
          </div>
        </div>
        <label for="inputCouponCode" id="coupon_code_err"></label>
        </form>
         <!--Coupon Form ends-->
        </div>
      
      <div class="couponCodeAppliedDiv">
      <?php
        if($c_code)
        {
          $jsonCData = $customFun->getCCodeDetails();
          $cData = json_decode($jsonCData, true);
          if($cData['rc'] == 1)
          {
        ?>
        
        <div class="alert alert-success" role="alert">
          <?php echo  strtoupper($cData['rd']['coupon_name']); ?> Coupon Code Applied <a href="javascript:void(0)" class="alert-link" id="rLinkCCode">Remove</a>
        </div>
       
        <?php
        }
        }
        ?>
       </div>
      </div>
    </div>
     <?php
        }
        ?>
      <div class="card mb-2">
      <div class="card-header">
        Price Details
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <div class="d-flex">
              <div class="mr-auto p-2">Price ( <?php if($cart_data){echo count($_SESSION['product_cart']);} else {echo 0; }?> Items )</div>

              <div class="p-2"><i class="fa fa-inr" aria-hidden="true"></i> <span id="total_sum_value"></span></div>
          </div>
          <div class="d-flex">
              <div class="mr-auto p-2">Delivery Charge</div>

              <div class="p-2"><i class="fa fa-inr" aria-hidden="true"></i> 0</div>
          </div>
          <div class="d-flex">
              <div class="mr-auto p-2">Coupon Applied</div>
              <?php 
              //Intialize Coupon Money
              $c_money = 0;
              if($c_code)
              {
                
                $jsonCData = $customFun->getCCodeDetails();
                $cData = json_decode($jsonCData, true);
                if($cData['rc'] == 1)
                {

                $c_money = $cData['rd']['coupon_money']; 

                }
              }
              ?> 
              <div class="p-2"><i class="fa fa-inr" aria-hidden="true"></i> <span id="cAppliedMoney"><?php echo $c_money;?></span></div>
          </div>
        </li>

        <li class="list-group-item">
          <div class="d-flex">
              <div class="mr-auto p-2">Amount Payable</div>
              <div class="p-2"><i class="fa fa-inr" aria-hidden="true"></i> <span id="finalPaybleMoney"></span></div>
          </div>
        </li>
      </ul>
    </div>


<!-- Sign in box -->
<?php
if(!$user_data)
{
?>
    <div class="card">
      <div class="card-body">

        <h5 class="card-title p-2">Sign in</h5>

      <div class="d-flex flex-row">

      <div class="d-flex flex-column">
        <div class="pl-2 pr-2">New to Biryani Bazaar?</div>
        <div class="pl-2 pr-2">Create an account now</div>
        <div class="p-2"><button type="button" class="btn btn-outline-success" id="showSignupModal">Create an account </button></div>
      </div>

      <div class="d-flex flex-column ml-auto">
        <div class="pl-2 pr-2">Have an account?</div>
        <div class="pl-2 pr-2">Sign in now.</div>
        <div class="p-2"><button type="button" class="btn btn-success" id="showSigninModal">Sign in</button></div>
      </div>

    </div>
    </div>
    </div>
    <?php
    }
    if($user_data && $cart_data)
    {
    ?>
    <div class="d-flex flex-row">
    <div class="ml-auto" id="finalBtnDiv">
     <button type="button" class="btn btn-success btn-lg" id="proceedToPay" style="float: right;">Proceed to Pay</button>
    </div>
    </div>
    <?php
    }
    ?>
    </div>   


</div>
</div>
<!--Login & Registration Modal -->
<?php
if(!$user_data)
{
?>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0, 0, 0, .5);">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Biryani Bazaar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          
          <a class="nav-item nav-link active w-50 signupLink" id="nav-signup-tab" data-toggle="tab" href="#nav-signup" role="tab" aria-controls="nav-signup" aria-selected="true">Sign Up</a>


          <a class="nav-item nav-link w-50 loginLink" id="nav-signin-tab" data-toggle="tab" href="#nav-signin" role="tab" aria-controls="nav-signin" aria-selected="false">Sign in</a>
        </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active signupModalTab" id="nav-signup" role="tabpanel" aria-labelledby="nav-signup-tab">
          <form id="registrationform">
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
                  <input type="password" name="inputPassword" class="form-control" id="inputPassword" placeholder="Your Password" aria-describedby="pwdHelpBlock">
                  <small id="pwdHelpBlock" class="form-text text-muted">
                    Min. 5 characters, atleast 1 number and 1 special character
                  </small>
              </div>
              <button type="submit" id="doSignUp" class="btn btn-success">Sign up</button>
          </form>
          </div>
          <div class="tab-pane fade loginModalTab" id="nav-signin" role="tabpanel" aria-labelledby="nav-signin-tab">
          <div id="loginbox">
          <form id="loginform">
              <div class="form-group">
                  <label for="loginEmail">Email</label>
                  <input type="email" name="loginEmail" class="form-control" id="loginEmail" placeholder="Your Email">
              </div>
              <div class="form-group">
                  <label for="loginPassword">Password</label>
                  <input type="password" name="loginPassword" class="form-control" id="loginPassword" placeholder="Your Password">
              </div>
              <div class="clearfix">
              <button type="submit" id="doSignIn" class="btn btn-success">Sign In</button>
              <div style="font-size:85%;float:right;">Forgot password ?
                <a href="javascript:void(0)" onClick="$('#loginbox').hide(); $('#forgotbox').show()">Click Here</a>
            </div>
            </div>
          </form>
        </div>
      <div id="forgotbox" style="display:none;">
      <div class="text-center">
         Reset Password
      </div>
          <form id="forgotform">
              <div class="form-group">
                  <label for="resetMobile">Mobile</label>
                  <input type="text" name="resetMobile" class="form-control" id="resetMobile" placeholder="Your Mobile">
              </div>
          <div class="clearfix">
            <button type="submit" id="doForgetPwdBtn" class="btn btn-success">Reset</button>
            <div style="font-size:85%;float:right;">Already have an account!
                <a href="javascript:void(0)" onClick="$('#forgotbox').hide(); $('#loginbox').show()">Login Here</a>
            </div>
        </div>        
    </form>
</div>
<div id="otpbox" style="display:none;">
      <div class="text-center">
         Reset Password
      </div>
          <form id="updatePwdForm">
            <div class="form-group" hidden>
              <input type="password" name="olds" hidden class="form-control" id="olds">
            </div>
              <div class="form-group">
                  <label for="verCode">Verification Code</label>
                  <input type="text" name="verCode" class="form-control" id="verCode" placeholder="Enter OTP">
              </div>
              <div class="form-group">
                  <label for="newPwd">New Password</label>
                  <input type="password" name="newPwd" class="form-control" id="newPwd" placeholder="New Password">
              </div>
              <div class="form-group">
                  <label for="rePwd">Repeat Password</label>
                  <input type="password" name="rePwd" class="form-control" id="rePwd" placeholder="Re-enter new Password">
              </div>
          <div class="clearfix">
            <button type="submit" id="doUpdatePwdBtn" class="btn btn-success">Verify</button>
        </div>        
    </form>
</div>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<?php
}
?>
<!--Login Modal ends-->
<!--Address Edit Modal -->
<div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="background-color: rgba(0, 0, 0, .5);">
  <div class="modal-dialog" role="document">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Biryani Bazaar</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>          
        </div>
      <form  id="usersEditAddress"> 
      <div class="modal-body">
        
        <div class="row" style="display:none">
            <div class="form-group col-md-4">
              <label for="_token">Token</label>
              <input type="text" class="form-control" name="_token" value="editAdd">
            </div>
            <div class="form-group col-md-4">
              <label for="addressID">Address ID</label>
              <input type="text" class="form-control" name="addressID" id="addressID">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                  <label for="inputEditName">Name</label>
                  <input type="text" class="form-control border-input"  id="inputEditName" name="inputEditName" placeholder="Name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
            <label for="inputEditMobile">Mobile</label>
          <input type="text" class="form-control border-input" name="inputEditMobile" id="inputEditMobile" placeholder="Mobile">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                 <label for="inputEditAddress1">Address Line 1</label>
                <input type="text" class="form-control border-input" id="inputEditAddress1" name="inputEditAddress1" placeholder="Apartment, studio, or floor">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <label for="inputEditAddress2">Address 2</label>
                  <input type="text" class="form-control border-input" id="inputEditAddress2" name="inputEditAddress2" placeholder="1234 Main St">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
            <label for="inputEditCity">City</label>
             <input type="text" class="form-control border-input" id="inputEditCity" name="inputEditCity" value="Pune" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputEditCountry">Country</label>
                    <input type="text" class="form-control border-input" id="inputEditCountry" name="inputEditCountry" placeholder="Country" value="India" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label for="inputEditZip">Pincode</label>
                <input type="text" class="form-control border-input" id="inputEditZip" name="inputEditZip" placeholder="Pincode">
                </div>
            </div>
        </div>
      </div>
       <div class="modal-footer">
            <button type="submit" class="btn btn-success mr-auto">Save</button>

            <button type="button" class="btn btn-danger" id="deleteAdd">Delete</button>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Edit Address Modal ends-->
<!--Add New Address Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="background-color: rgba(0, 0, 0, .5);">
  <div class="modal-dialog" role="document">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Biryani Bazaar</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>          
        </div>
      <form  id="usersAddNewAddress"> 
      <div class="modal-body">   
        <div class="row" style="display:none">
            <div class="form-group col-md-4">
              <label for="_token">Token</label>
              <input type="text" class="form-control" name="_token" id="_token" value="addNewAdd">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                  <label for="inputName">Name</label>
                  <input type="text" class="form-control border-input"  id="inputName" name="inputName" placeholder="Name" value="<?php echo $userInfo['name']?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
            <label for="inputMobile">Mobile</label>
          <input type="text" class="form-control border-input" name="inputMobile" id="inputMobile" placeholder="Mobile" value="<?php echo $userInfo['mobile']?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                 <label for="inputAddress1">Address Line 1</label>
                <input type="text" class="form-control border-input" id="inputAddress1" name="inputAddress1" placeholder="Apartment, studio, or floor">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <label for="inputAddress2">Address 2</label>
                  <input type="text" class="form-control border-input" id="inputAddress2" name="inputAddress2" placeholder="1234 Main St">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
            <label for="inputCity">City</label>
             <input type="text" class="form-control border-input" id="inputCity" name="inputCity" value="Pune" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputCountry">Country</label>
                    <input type="text" class="form-control border-input" id="inputCountry" name="inputCountry" placeholder="Country" value="India" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label for="inputZip">Pincode</label>
                <input type="text" class="form-control border-input" id="inputZip" name="inputZip" placeholder="Pincode">
                </div>
            </div>
        </div>
      </div>
         <div class="modal-footer">
        <div class="text-center">
            <button type="submit" class="btn btn-success btn-fill btn-wd">Save</button>
        </div>
       </div>
    </form>
     
    </div>
  </div>
</div>
<!--Address Modal ends-->
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

      //Update Total Sum
       var calculated_total_sum = 0;
     
       $(".txtCal").each(function () {
           var get_textbox_value = $(this).text();
           if (!isNaN(get_textbox_value)) {
              calculated_total_sum += parseFloat(get_textbox_value);
              }                  
            });
        $("#total_sum_value").html(calculated_total_sum);

        //Update Total Payble Amount
        var calculated_coupon_value = 0;
        var get_coupon_value = $("#cAppliedMoney").text();
        if (!isNaN(get_coupon_value)) {
        calculated_coupon_value = parseFloat(get_coupon_value);
        } 

        var calculated_payble_amount = calculated_total_sum - calculated_coupon_value;
        //Reset Final amount
        $("#finalPaybleMoney").empty();
        //Update now

        $("#finalPaybleMoney").html(calculated_payble_amount);

        $(".razorpay-payment-button").addClass("btn btn-success");

       });


</script>
</body>
</html>