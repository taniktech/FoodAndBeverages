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
  <title>Biryani Bazaar | My Orders</title>
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
                <li class="active">
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
      ?>

         <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                        <div class="header">
                            <h4 class="title">My Orders</h4>
                        </div>
                <?php
                  $i = 0;
                  $jsonUserOrders = $customFun->getUserOrders();
                  $userOrders = json_decode($jsonUserOrders, true);
                  if($userOrders['rc'] == 1)
                  {
                    ?>
                    <div class="content">
                    <ul class="list-unstyled team-members">
                    <?php
                    foreach($userOrders['rd'] as  $data)
                    {
                        $i++;
                    ?>
                <li>
                    <div class="row">
                    <div class="col-xs-1">
                    <?php echo $i;?>
                    </div>
                    <div class="col-xs-4">
                        Order ID &nbsp; #BB<?php echo $data['ts_order_id'];?>
                        <br />
                        Total Amount &nbsp; Rs. <?php echo $data['total_moeny'];?>
                         <br />
                        <span>Order Date &nbsp; <?php echo $data['created_at'];?></span>
                    </div>
                    <div class="col-xs-5">
                        <?php
                        $jsonMenuData = $customFun->getOrderMenuDetails($data['ts_order_id']);
                        $menuData = json_decode($jsonMenuData, true);
                        if($menuData['rc'] == 1)
                        {
                            $j = 0;
                            foreach($menuData['rd'] as  $data)
                            {
                                $j++;
                                $menuDetails = $customFun->getCartQtyInfo($data['ts_menu_details_id']);
                                $menuOrdered = $customFun->getMenuDetails($menuDetails['menu_id']);
                                $outletDetails = $customFun->getOutletDetails($menuDetails['outlet_id']);
                            if($j == 1)
                            {
                            ?>
                            Items Ordered ( <?php echo count($menuData['rd']);?> )
                            <br />
                            <?php 
                            }
                            ?>
                        Item ( <?php echo $j;?> ) : 
                        <br />
                        <?php echo $menuOrdered['menu'];?>
                        <br />
                        <?php echo "Quantity : ".$data['quantity']. " - ". $menuDetails['qty'];?>
                        <br />
                         <?php echo "From : ".$outletDetails['outlet'];

                        if($j != count($menuData['rd']))
                        {
                        ?>
                        <hr>
                        <?php
                        }
                        }
                        }
                        ?>
                    </div>

                    <div class="col-xs-2 text-right">
                        <button type="submit" class="btn btn-success btn-fill repeatThisOrder" data-rid="<?php echo $data['ts_order_id'];?>">Repeat</button>
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
                  <div class="content">
                        <div class="alert alert-info">
                        <span><b> Info - </b> You have not ordered Biryani Yet.</span>
                        </div>
                        <div class="text-center">
                        <a href="cart"><button type="button" class="btn btn-info btn-fill btn-wd">Order Now</button></a>
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
