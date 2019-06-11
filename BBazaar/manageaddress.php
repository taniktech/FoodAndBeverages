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
else
{
    header("location: index");
}
?>
<!doctype html>
<html lang="en">
<head>
  <link rel="icon" href="assets/images/fav-icon.png"  sizes="16x16">
  <title>Biryani Bazaar | Manage Address</title>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/paper-assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/paper-assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Dashboard core CSS    -->
    <link href="assets/paper-assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/paper-assets/css/themify-icons.css" rel="stylesheet">
    <!--Custom CSS-->
    <link rel="stylesheet" href="assets/css/profilestyle.css">
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
      <div class="sidebar-wrapper" style="background-color: #251108">
            <div class="logo">
                <a href="index" class="simple-text">
                    
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="me">
                        <i class="ti-user"></i>
                        <p>My Profile</p>
                    </a>
                </li>
                <li>
                    <a href="myorders">
                        <i class="ti-view-list-alt"></i>
                        <p>My Orders</p>
                    </a>
                </li>
                <li>
                    <a href="mypoints">
                        <i class="ti-text"></i>
                        <p>Loyalty Points</p>
                    </a>
                </li>
                <li class="active">
                    <a href="manageaddress">
                        <i class="ti-text"></i>
                        <p>Manage Addresses</p>
                    </a>
                </li>
            </ul>
      </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="assets/images/logo-bb.png" alt="Biryani Bazaar">
                    </a>
                </div>
                <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                         <li>
                            <a href="index">
                                <i></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li>
                            <a href="me">
                                <i></i>
                                <p>My Profile</p>
                            </a>
                        </li>
                        <li>
                            <a href="cart">
                                <i></i>
                                <p>Cart</p>
                            </a>
                        </li>
                        <li>
                            <a href="logout">
                                <i></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
      
      $userInfo = $customFun->getUserInfo();
      ?>

         <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Manage Addresses</h4>
                            </div>
                <div class="content">

                <div class="row">
                <div class="col-lg-12">
                <div class="card">
                <a href="#" data-toggle="modal" data-target="#addressModal">
                 <div class="content alert alert-success">
                    <span><b> + </b> Add new Address</span>
                </div>
                </a>
                </div>
                </div>
                </div>

                <div class="row">
                <div class="col-lg-12">
                <div class="card">
                <div class="content">
                 <?php
                  $i = 0;
                  $jsonUsersAddress = $customFun->getUsersAddress();
                  $usersAddress = json_decode($jsonUsersAddress, true);
                  if($usersAddress['rc'] == 1)
                  {
                  ?>
                <ul class="list-unstyled team-members">
                <?php
                foreach($usersAddress['rd'] as  $data)
                {
                ?>
                    <li>
                        <div class="row">
                            <div class="col-xs-9">
                                <?php echo $data['name'];?> &nbsp; &nbsp;  <?php echo $data['mobile'];?>
                                <br />
                                <span><small><?php echo $data['address_line_1'];?> &nbsp; , <?php echo $data['address_line_2'];?>   </small></span><br />
                                <span><small><?php echo $data['city'];?>, <?php echo $data['country'];?> - <?php echo $data['pincode'];?></small></span>
                            </div>
                            <div class="col-xs-3 text-right">
                            <a href="javascript:void(0)" class="openEditAddressModal" data-addid="<?php echo $data['ts_address_id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: green;"></i><span style="color: green;"> Edit</span></a>
                         </div>
                        </div>
                    </li>
                <?php
                }?>
                </ul>
                  <?php
                   }
                   ?>
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
<!--Address Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Biryani Bazaar</h4>
      </div>
      <form  id="usersAddNewAddress"> 
      <div class="modal-body">    
        <div class="row" style="display:none">
            <div class="form-group col-md-4">
              <label for="uid">Token</label>
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
        <div class="text-right">
            <button type="submit" class="btn btn-success btn-fill">Save</button>
        </div>
    </div>
    </form>
    </div>
  </div>
</div>
<!--Address Modal ends-->
<!--Address Edit Modal -->
<div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="background-color: rgba(0, 0, 0, .5);">
  <div class="modal-dialog" role="document">
      <!-- Modal content-->
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Biryani Bazaar</h4>
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
                <input type="text" class="form-control border-input" id="inputEditAddress1" name="inputEditAddress1" placeholder="1234 Main St">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <label for="inputEditAddress2">Address 2</label>
                  <input type="text" class="form-control border-input" id="inputEditAddress2" name="inputEditAddress2" placeholder="Apartment, studio, or floor">
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
            <button type="submit" class="btn btn-success btn-fill" style="float: left;">Save</button>
            <button type="button" class="btn btn-danger btn-fill" id="deleteAdd">Delete</button>

            <button type="button" class="btn btn-secondary btn-fill" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Edit Address Modal ends-->
<footer class="footer">
    <div class="container-fluid">
        <nav class="pull-left">
            <ul>

                <li>
                    <a href="#">
                        Biryani Bazaar
                    </a>
                </li>
            </ul>
        </nav>
        <div class="copyright pull-right">
           <!--  &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="#">Biryani Bazaar</a> -->
        </div>
    </div>
</footer>

</div>
</div>

</body>

    <!--JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/paper-assets/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Dashboard Core javascript and methods -->
    <script src="assets/paper-assets/js/paper-dashboard.js"></script>
    <!--JQuery Validate -->
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <!--Custom App Js-->
    <script src="assets/js/app.js"></script>

</html>
