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
  <title>Biryani Bazaar | Loyalty Points</title>
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
                <li class="active">
                    <a href="mypoints">
                        <i class="ti-text"></i>
                        <p>Loyalty Points</p>
                    </a>
                </li>
                <li>
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
      //Get user's loyalty point
      $jsonLData = $customFun->checkLoylty();
      $loyltyData = json_decode($jsonLData, true);

      ?>

         <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">My Loyalty Points</h4>
                            </div>
                            <hr>
                            <div class="content">
                                <ul class="list-unstyled team-members">
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-6">
                                            Total Loyalty Points Earned
                                            </div>
                                            <div class="col-xs-3">
                                               <i class="fa fa-inr"></i> <span><?php echo $loyltyData['rd']; ?></span>
                                                
                                            </div>

                                            <div class="col-xs-3 text-right">
                                                <button type="submit" class="btn btn-success btn-fill" data-toggle="collapse" data-target="#loyaltyDetails" aria-expanded="false" aria-controls="loyaltyDetails">See Details</button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <?php
                              //Get user's loyalty point
                              $jsonLFullData = $customFun->checkLoylty();
                              $loyltyFullData = json_decode($jsonLFullData, true);
                              if($loyltyFullData['rc'] == 1 && $loyltyFullData['rd'] > 0)
                               {
                                $i = 0;
                               ?>
                                <div class="collapse" id="loyaltyDetails">
                                <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                <thead>
                                    <th>Sl.</th>
                                    <th>Order ID</th>
                                    <th>Amount Paid</th>
                                    <th>Points</th>
                                    <th>Status</th>
                                    <th>Order Date</th>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($loyltyFullData['fullData'] as $data) {
                                    $i++;
                                ?>
                                        <tr>
                                            <td><?php echo $i;?>.</td>
                                            <td>#BB<?php echo $data['ts_order_id'];?></td>
                                            <td><i class="fa fa-inr"></i> <?php echo $data['payable_money'];?></td>
                                            <td><i class="fa fa-inr"></i> <?php echo $data['loyalty_point'];?></td>
                                            <td><?php if($data['loyalty_flow_id'] == 1){?> Added <?php }if($data['loyalty_flow_id'] == 2){?> Used <?php }?></td>
                                            <td><?php echo $data['created_at'];?></td>
                                        </tr>
                                <?php
                                 }
                                 ?>
                                </tbody>
                                </table>
                                </div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                    <!-- &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="#">Biryani Bazaar</a> -->
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
