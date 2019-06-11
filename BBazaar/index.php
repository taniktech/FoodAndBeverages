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
  <link rel="icon" href="assets/images/fav-icon.png"  sizes="16x16">
  <title>Biryani Bazaar | Home</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS-->
    <link href="assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!-- WARNING: Respond.js doesn't work if you view the page via file://-->
    <!-- IE 9-->
    <!-- Vendors-->
    <link rel="stylesheet" href="assets/vendors/flexslider/flexslider.min.css">
    <link rel="stylesheet" href="assets/vendors/swipebox/css/swipebox.min.css">
    <link rel="stylesheet" href="assets/vendors/slick/slick.min.css">
    <link rel="stylesheet" href="assets/vendors/slick/slick-theme.min.css">
    <link rel="stylesheet" href="assets/vendors/animate.min.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="assets/vendors/pageloading/css/component.min.css">
    <!-- Font-icon-->
    <link rel="stylesheet" href="assets/fonts/font-icon/style.css">
    <!-- Style-->
    <link rel="stylesheet" type="text/css" href="assets/css/layout.css">
    <link rel="stylesheet" type="text/css" href="assets/css/elements.css">
    <link rel="stylesheet" type="text/css" href="assets/css/extra.css">
    <link rel="stylesheet" type="text/css" href="assets/css/widget.css">
    <link id="colorpattern" rel="stylesheet" type="text/css" href="assets/css/color/colordefault.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="assets/css/live-settings.css">
    <!-- Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rancho" rel="stylesheet">
    <!--Bootstrap Slecet CSS-->
    <link rel="stylesheet" href="assets/vendors/bootstrap-select/css/bootstrap-select.css">
    <!-- Script Loading Page-->
    <script src="assets/vendors/html5shiv.js"></script>
    <script src="assets/vendors/respond.min.js"></script>
    <script src="assets/vendors/pageloading/js/snap.svg-min.js"></script>
    <script src="assets/vendors/pageloading/sidebartransition/js/modernizr.custom.js"></script>
    <!--Custom CSS-->
    <link rel="stylesheet" href="assets/css/style.css">
    <style type="text/css">
      .bootstrap-select.btn-group .dropdown-menu.inner {
    padding: 10px !important;
      }
      .bootstrap-select.btn-group .dropdown-menu a.dropdown-item span.dropdown-item-inner {
    padding: 3px !important;
        }
    </style>

  </head>
  <body>
    <div id="pagewrap" class="pagewrap">
      <div id="html-content" class="wrapper-content">
        <header>
          <div class="header-main">
              <nav class="navbar navbar-default">
                <div class="container">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index">
                        <img src="assets/images/logo-bb.png" alt="Biryani Bazaar" class="logo-img">
                    </a>
                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="index" style="font-size: 20px; color: black;">Home</a></li>
                      <li><a href="tel:+918390000223" style="font-size: 20px; color: black;">+91-8390000223</a></li>
                      <li><a href="cart" style="font-size: 20px; color: black;">Cart</a></li>
                    <?php
                    if($user_data)
                    {
                    ?>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="font-size: 20px; color: black;">Welcome <?php echo $name;?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        <li><a href="me">My Profile</a></li>
                        <li><a href="myorders">My Orders</a></li>
                        <li><a href="mypoints">My Loyalty Points</a></li>
                        <li><a href="manageaddress">My delivery addresses</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="logout">LogOut</a></li>
                        </ul>
                      </li>
                      <?php
                      }
                      else
                      {
                      ?>
                      <li><a data-toggle="modal" href="javascript:void(0)" data-target="#loginModal" style="font-size: 20px; color: black;">Login & Signup</a></li>
                      <?php
                      }
                      ?>
                    </ul>
                  </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
              </nav>
          </div>
        </header>
        <div class="page-container">
          <div class="section nav-light pdn">
                <div class="top-header top-bg-video">
                  <div class="slides" >
                    <div class="slide-content slide-layout-02 slide-style-02" style="margin-top: 12%;">
                      <div class="container">
                        <div class="slide-content-inner text-center">
                          <h3 data-ani-in="fadeInUp" data-ani-out="fadeOutDown" data-ani-delay="800" class="slide-title animated" style="color: #2f4d29; font-family: Rancho;font-size: 60px;">Welcome to Biryani Bazaar</h3>
                          <p data-ani-in="fadeInUp" data-ani-out="fadeOutDown" data-ani-delay="1200" class="slide-sub-title animated"><span class="text" style="color: black; margin-top: 5%; margin-bottom: 5%;">Enjoy The Authentic Hyderabadi Dum Biryani</span></p>
                        </div>
                      </div>
          <div class="container">
          <!--Selction Box-->
          <div class="row" >
            <form class="form-inline" id="indexOrderForm">
            <div class="form-group" style="display: none;">
              <label for="uid">Token</label>
              <input type="text" class="form-control" name="_token" id="_token" value="addTOCart">
            </div>
            <div class="form-group col-md-3 col-md-offset-1">
           <!--  <label for="outletSelect">Select Outlet</label> -->
            <select class="form-control selectpicker required" id="outletSelect" name="outletSelect">
              <option value="">Select Nearest Store</option>           
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
            <div class="form-group col-md-3">
            <!-- <label for="menuSelect">Select Menu</label> -->
            <select class="form-control selectpicker required" id="menuSelect" name="menuSelect">
              <option value="">Select Menu</option>
            </select>
            </div>
            <div class="form-group col-md-3">
            <!-- <label for="qtySelect">Select Quantity</label> -->
            <select class="form-control selectpicker required" id="qtySelect" name="qtySelect">
              <option value="">Select Quantity</option>
            </select>
            </div>
            <div class="form-group col-md-2 col-xs-offset-3 col-sm-offset-0">
            <!-- <label for="goBtnID"></label> -->
            <button type="submit" class="swin-btn fadeInUp" id="goToCartBtnID">Order Now</button>
            </div>
          </form>
          </div>
          <!--Selction Box-->
        </div>
      </div>
    </div>
  </div>
</div>

         <div class="top-header top-slider layout-shop">
            <div class="slides">
              <div class="slide-content slide-layout-01">
                <div class="container">
                  <div class="row">
                    <div class="col-xs-6">
                      <div class="swin-sc swin-sc-title text-left">
                        <h3 data-ani-in="fadeInUp" data-ani-out="fadeOutDown" data-ani-delay="500" class="title animated fadeInUp" style="color: #2f4d29">Deliciousness jumping into the mouth</h3>
                        <h4 data-ani-in="fadeInUp" data-ani-out="fadeOutDown" data-ani-delay="1000" class="subtitle animated fadeInUp" style="color: #fbb017;">Enjoy The Authentic Hyderabadi Dum Biryani</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="slide-bg"><img src="assets/images/bb-slider/slider-bb-1.jpg" alt="" class="img img-responsive"></div>
            </div>
            <div class="slides">
              <div class="slide-content slide-layout-01">
                <div class="container">
                  <div class="row">
                    <div class="col-xs-6">
                      <div class="swin-sc swin-sc-title text-left">
                        <h3 data-ani-in="fadeInUp" data-ani-out="fadeOutDown" data-ani-delay="500" class="title animated fadeInUp" style="color: #2f4d29;">Where food speaks with your palate</h3>
                        <h4 data-ani-in="fadeInUp" data-ani-out="fadeOutDown" data-ani-delay="1000" class="subtitle animated fadeInUp" style="color: #fbb017;">Enjoy The Authentic Hyderabadi Dum Biryani</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="slide-bg"><img src="assets/images/bb-slider/slider-bb-2.jpg" alt="" class="img img-responsive"></div>
            </div>
            <div class="slides">
              <div class="slide-content slide-layout-01">
                <div class="container">
                  <div class="row">
                    <div class="col-xs-6">
                      <div class="swin-sc swin-sc-title text-left">
                        <h3 data-ani-in="fadeInUp" data-ani-out="fadeOutDown" data-ani-delay="500" class="title animated fadeInUp" style="color: #2f4d29;">beyond the boundaries of taste</h3>
                        <h4 data-ani-in="fadeInUp" data-ani-out="fadeOutDown" data-ani-delay="1000" class="subtitle animated fadeInUp" style="color: #fbb017;">Enjoy The Authentic Hyderabadi Dum Biryani</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="slide-bg"><img src="assets/images/bb-slider/slider-bb-3.jpg" alt="" class="img img-responsive"></div>
            </div>
          </div>
          <div class="page-content-wrapper">
            <div class="page-content no-padding">
              <section class="story-section padding-top-100 padding-bottom-100">
                <div class="container">
                  <div class="row">
                    <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="swin-sc swin-sc-title text-left wow fadeInUp">
                        <p class="top-title"><span>About us</span></p>
                        <h3 class="title white-color">Our Story</h3>
                      </div>
                      <p class="des wow fadeInUp">If Biryani is what you love, you have come to the best place to have it. Our Mission is to ensure that we serve the best Hyderabadi Dum Biryani, using the best ingredients possible, at an amazing price and quantity that will leave you more than satisfied.</p>
                      <p class="des wow fadeInUp">Plenty of tasty vegetarian dishes are available to bring completeness to the Indian cuisine.
                      What makes our Hyderabadi Cuisine special is the use of special ingredients, carefully chosen and cooked to the right degree. The addition of a certain Herb, Spice, Condiment, or an Amalgam of these adds a unique taste and texture to the dish. </p>
                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12">
                      <img src="assets/images/bb-about-us.jpg" alt="" class="img img-responsive wow fadeInRight">
                    </div>
                  </div>
                </div>
              </section>
              <section class="service-section-02 padding-top-100">
                <div class="container">
                  <div class="swin-sc swin-sc-title">
                    <p class="top-title"><span>Our Service</span></p>
                    <h3 class="title">What We Focus On</h3>
                  </div>
                  <div class="swin-sc swin-sc-iconbox">
                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div data-wow-delay="0.5s" class="item icon-box-02 wow fadeInUpShort">
                          <div class="wrapper-icon"><i class="icons swin-icon-dinner-2"></i><span class="number">1</span></div>
                          <h4 class="title">Private Event</h4>
                          <div class="description">Celebrating a special occasion with family and friends or gathering colleagues for a dinner meeting? For party orders, call on +91-8390000223</div>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div data-wow-delay="1s" class="item icon-box-02 wow fadeInUpShort">
                          <div class="wrapper-icon"><i class="icons swin-icon-browser"></i><span class="number">2</span></div>
                          <h4 class="title">Online Order</h4>
                          <div class="description">Pune's Authentic Biryani is now available for online ordering now. Get wide range of Biryani dishes.</div>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div data-wow-delay="1.5s" class="item icon-box-02 wow fadeInUpShort">
                          <div class="wrapper-icon"><i class="icons swin-icon-delivery"></i><span class="number">3</span></div>
                          <h4 class="title">Outdoor Catering</h4>
                          <div class="description">Leveraging on our vast domain experience in the field of catering services we are offering matchless Outdoor Catering Services to our valued clients.</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <section class="product-sesction-02 padding-top-120 padding-bottom-100">
                <div class="container">
                  <div class="swin-sc swin-sc-title">
                    <p class="top-title"><span>Our Menu</span></p>
                    <h3 class="title">Tasty And Good Price</h3>
                  </div>
                  <div class="swin-sc swin-sc-product products-02 carousel-02">
                    <div class="products nav-slider">
                      <div class="row slick-padding">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="blog-item item swin-transition">
                            <div class="block-img"><img src="assets/images/bb-menu/bb-menu-1.jpg" alt="" class="img img-responsive">
                              <div class="block-circle price-wrapper"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">Rs.</span>179</span></div>
                            </div>
                            <div class="block-content">
                              <h5 class="title"><a href="javascript:void(0)">Hyderabadi Dum Chicken Biryani</a></h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="blog-item item swin-transition">
                            <div class="block-img"><img src="assets/images/bb-menu/bb-menu-2.jpg" alt="" class="img img-responsive">
                              <div class="block-circle price-wrapper"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">Rs.</span>299</span></div>
                            </div>
                            <div class="block-content">
                              <h5 class="title"><a href="javascript:void(0)">Hyderabadi Dum Mutton Biryani</a></h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="blog-item item swin-transition">
                            <div class="block-img"><img src="assets/images/bb-menu/bb-menu-3.jpg" alt="" class="img img-responsive">
                              <div class="block-circle price-wrapper"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">Rs.</span>159</span></div>
                            </div>
                            <div class="block-content">
                              <h5 class="title"><a href="javascript:void(0)">Hyderabadi Special Egg Biryani</a></h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="blog-item item swin-transition">
                            <div class="block-img"><img src="assets/images/bb-menu/bb-menu-4.jpg" alt="" class="img img-responsive">
                              <div class="block-circle price-wrapper"><span class="price woocommerce-Price-amount amount"><span class="price-symbol">Rs.</span>159</span></div>
                            </div>
                            <div class="block-content">
                              <h5 class="title"><a href="javascript:void(0)">Hyderabadi Veg Dum Biryani</a></h5>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
<!--Hidden Image Gallery-->
<!--               <section class="story-section padding-top-100 padding-bottom-100">
                <div class="container">
                  <div class="row">
                    <div class="col-md-2 col-sm-12 col-xs-12">
                      <div class="swin-sc swin-sc-title text-left wow fadeInUp">
                        <h3 class="title white-color">Gallery</h3>
                      </div>
                    </div>
                    <div class="col-md-10 col-sm-12 col-xs-12">
                      <div class="row slick-padding">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="blog-item item swin-transition">
                            <div class="block-img"><img src="assets/images/bb-gallery/gal-img-1.jpg" alt="" class="img img-responsive">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="blog-item item swin-transition">
                            <div class="block-img"><img src="assets/images/bb-gallery/gal-img-2.jpg" alt="" class="img img-responsive">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="blog-item item swin-transition">
                            <div class="block-img"><img src="assets/images/bb-gallery/gal-img-3.jpg" alt="" class="img img-responsive">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row slick-padding" style="padding-top: 40px;">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="blog-item item swin-transition">
                            <div class="block-img"><img src="assets/images/bb-gallery/gal-img-4.jpg" alt="" class="img img-responsive">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="blog-item item swin-transition">
                            <div class="block-img"><img src="assets/images/bb-gallery/gal-img-5.jpg" alt="" class="img img-responsive">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <div class="blog-item item swin-transition">
                            <div class="block-img"><img src="assets/images/bb-gallery/gal-img-6.jpg" alt="" class="img img-responsive">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section> -->
<!--Hidden Image Gallery-->
            </div>
          </div>
        </div>
        <footer>
          <div class="subscribe-section">
            <div class="container">
              <div class="subscribe-wrapper">
                <div class="row">
                  <div class="col-lg-8 col-lg-offset-2">
                    <div class="subscribe-heading">
                      <h3 class="title">Subcribe Us Now</h3>
                      <div class="des">Get more news and delicious dishes everyday from us</div>
                    </div>
                    <form id="subscribeusForm" class="widget-newsletter">
                      <div class="" style="display: none;">
                      <input name="_token" class="form-control" type="text" value="addSubsc">
                      </div>
                      <input placeholder="Your Mobile No." name="subscribeMobile" id="subscribeMobile" class="form-control" type="text"><span class="submit"><button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i></button></span>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="footer-top"></div>
          <div class="footer-main">
            <div class="container">
              <div class="row">
                <div class="col-lg-8">
                  <div class="ft-widget-area">
                    <div class="ft-area1">
                      <div class="swin-wget swin-wget-about">
                        <div class="clearfix"><a class="wget-logo"><img src="assets/images/logo-bb.png" alt="" class="img img-responsive"></a>
                          <ul class="socials socials-about list-unstyled list-inline">
                            <li><a href="https://www.facebook.com/biryanibazaarindia/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/biryanibazaar" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/biryanibazaarindia/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                          </ul>
                        </div>
                        <div class="wget-about-content">
                        </div>
                        <div class="about-contact-info clearfix">
                          <div class="address-info">
                            <div class="info-icon"><i class="fa fa-map-marker"></i></div>
                            <div class="info-content">
                              <p>Bhadalewasti, Near Hotel Kaveri</p>
                              <p> Wagholi, Pune-412207</p>
                            </div>
                          </div>
                          <div class="phone-info">
                            <div class="info-icon"><i class="fa fa-mobile-phone"></i></div>
                            <div class="info-content">
                              <p>+91-8390000223</p>
                            </div>
                          </div>
                          <div class="email-info">
                            <div class="info-icon"><i class="fa fa-envelope"></i></div>
                            <div class="info-content">
                              <p>biryanibazaarwagholi@gmail.com</p>
                            </div>
                          </div>
                        </div>
                         <div class="about-contact-info clearfix" style="margin-top: 10%;">
                          <div class="address-info">                      
                          </div>
                          <div class="phone-info">
                            <a href="terms" target="_blank" style="color: #fbb017;">Terms & Conditions</a>
                          </div>
                          <div class="email-info">
                            <a href="privacy" target="_blank" style="color: #fbb017;">Privacy Policy & Disclaimer</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="ft-fixed-area">
                    <div class="reservation-box">
                      <div class="reservation-wrap">
                        <h3 class="res-title">Open Hour</h3>
                        <div class="res-date-time">
                          <div class="res-date-time-item">
                            <div class="res-date">
                              <div class="res-date-item">
                                <div class="res-date-text">
                                  <p>Monday:</p>
                                </div>
                                <div class="res-date-dot">.......................................</div>
                              </div>
                            </div>
                            <div class="res-time">
                              <div class="res-time-item">
                                <p>10AM - 9PM</p>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="res-date-time-item">
                            <div class="res-date">
                              <div class="res-date-item">
                                <div class="res-date-text">
                                  <p>Tuesday:</p>
                                </div>
                                <div class="res-date-dot">.......................................</div>
                              </div>
                            </div>
                            <div class="res-time">
                              <div class="res-time-item">
                                <p>10AM - 9PM</p>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="res-date-time-item">
                            <div class="res-date">
                              <div class="res-date-item">
                                <div class="res-date-text">
                                  <p>Wednesday:</p>
                                </div>
                                <div class="res-date-dot">.......................................</div>
                              </div>
                            </div>
                            <div class="res-time">
                              <div class="res-time-item">
                                <p>10AM - 9PM</p>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="res-date-time-item">
                            <div class="res-date">
                              <div class="res-date-item">
                                <div class="res-date-text">
                                  <p>Thursday:</p>
                                </div>
                                <div class="res-date-dot">.......................................</div>
                              </div>
                            </div>
                            <div class="res-time">
                              <div class="res-time-item">
                                <p>10AM - 9PM</p>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="res-date-time-item">
                            <div class="res-date">
                              <div class="res-date-item">
                                <div class="res-date-text">
                                  <p>Friday:</p>
                                </div>
                                <div class="res-date-dot">.......................................</div>
                              </div>
                            </div>
                            <div class="res-time">
                              <div class="res-time-item">
                                <p>10AM - 9PM</p>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="res-date-time-item">
                            <div class="res-date">
                              <div class="res-date-item">
                                <div class="res-date-text">
                                  <p>Saturday:</p>
                                </div>
                                <div class="res-date-dot">.......................................</div>
                              </div>
                            </div>
                            <div class="res-time">
                              <div class="res-time-item">
                                <p>10AM - 9PM</p>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="res-date-time-item">
                            <div class="res-date">
                              <div class="res-date-item">
                                <div class="res-date-text">
                                  <p>Sunday:</p>
                                </div>
                                <div class="res-date-dot">.......................................</div>
                              </div>
                            </div>
                            <div class="res-time">
                              <div class="res-time-item">
                                <p>10AM - 9PM</p>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                        </div>
                        <h3 class="res-title">Call for Order</h3>
                        <p class="res-number">+91-8390000223</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </footer><a id="totop" href="#" class="animated"><i class="fa fa-angle-double-up"></i></a>
      </div>
    </div>
      <!--Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="background-color: rgba(0, 0, 0, .5);">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Biryani Bazaar</h4>
                </div>
                    <div class="modal-body">
                        <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active" style="width: 50%;"><a href="#signup" aria-controls="signup" role="tab" data-toggle="tab">Sign up</a></li>
                        <li role="presentation" style="width: 50%;"><a href="#signin" aria-controls="signin" role="tab" data-toggle="tab">Sign in</a></li>
                      </ul>

                        <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="signup">
                          <div id="signupbox">
                                  <div class="text-left">
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
                                                  <small id="pwdHelpBlock" class="help-block">Min. 5 characters, atleast 1 number and 1 special character</small>
                                              </div>
                                                <button type="submit" id="doSignUp" class="btn btn-success">Sign up</button>
                                          </form>
                                  </div>
                              </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="signin">
                          <div id="loginbox">
                                  <div class="text-left">
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
                    <!--Modal Body-->
                  </div>
              </div>
            </div>
<!--Login Modal ends-->
    <!-- jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap JavaScript-->
    <script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
    <!-- Vendors-->
    <script src="assets/vendors/flexslider/jquery.flexslider-min.js"></script>
    <script src="assets/vendors/swipebox/js/jquery.swipebox.min.js"></script>
    <script src="assets/vendors/slick/slick.min.js"></script>
    <script src="assets/vendors/isotope/isotope.pkgd.min.js"></script>
    <script src="assets/vendors/jquery-countTo/jquery.countTo.min.js"></script>
    <script src="assets/vendors/jquery-appear/jquery.appear.min.js"></script>
    <script src="assets/vendors/parallax/parallax.min.js"></script>
    <script src="assets/vendors/vide/jquery.vide.min.js"></script>
    <script src="assets/vendors/pageloading/js/svgLoader.min.js"></script>
    <script src="assets/vendors/pageloading/js/classie.min.js"></script>
    <script src="assets/vendors/pageloading/sidebartransition/js/sidebarEffects.min.js"></script>
    <script src="assets/vendors/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="assets/vendors/wowjs/wow.min.js"></script>
    <script src="assets/vendors/skrollr.min.js"></script>
    <!--JQuery Validate -->
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <!-- Own script-->
    <script src="assets/js/layout.js"></script>
     <!--Bootstrap Slecet JS-->
    <script src="assets/vendors/bootstrap-select/js/bootstrap-select.js"></script>
    <!--Custom App Js-->
    <script src="assets/js/app.js"></script>
  </body>
</html>