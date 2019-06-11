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
  <title>Biryani Bazaar | Terms & Conditions</title>
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
      .title
        {
          font-size: 35px;
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
                      <li><a data-toggle="modal" href="javascript:void(0)" data-target="#loginModal" style="font-size: 20px; color: black;">Login</a></li>
                      <?php
                      }
                      ?>
                    </ul>
                  </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
              </nav>
          </div>
        </header>
        <div class="terms-div" style="margin-top: 10%; margin-bottom: 5%;">
        <div class="container">
          <h4 class="title">Biryani Bazaar Term of Service Use</h4>
          <p>
            Thanks for using our services (Services including usage of this website and our various products or offerings). The Services are provided by Biryani Bazaar, located at M. NO. 1/1374, Bhadalewasti, Wagholi, Pune, Maharastra - 412207, India.
            By using our Services, you are agreeing to these terms. Please read them carefully.
            Our Services may change due to many circumstances, so sometimes additional terms or product requirements (including age requirements) may apply. Additional terms will be available with the relevant Services, and those additional terms become part of your agreement with us if you use those Services.
            We intend to be as transparent as possible with you in our dealings with you. However, we reserve the right to refuse to answer any question you that may be negatively impact our interest. For service details, please refer our website http://www.biryanibazaar.in.
          </p>
          <h4 class="title">Ordering</h4>
          <p>
            You agree to take reasonable care when providing us with your details and warrant that these details are accurate and complete at the time of ordering food. 
            We ensure quality standards and are responsible and liable for all and any issues and cases pertaining to the quality of the food or order for eg. veg/non-veg labelling etc but not limited to this, to you directly. We may refund you the amount you paid for the service either in full or part.
            You understand that you have sole responsibility of suitability of the order on ultimate consumer of service - some type of product/offer may not be suitable for certain age, or medical condition.
          </p>
          <h4 class="title">Prices and Payment</h4>
          <p>
            We reserve the right of changing pricing of any service without prior notice. The price listed on the website is the latest. Any food cart selling service at different price is in breach of franchise agreement and would be held liable for penalty to users / customers and to franchisor. 
            We reserve the right to alter the menu of Food available for sale and to delete and remove from listing the menu of Food and Food Delivery options, if any.
            The total price for service includes cost of services, taxes, discounts, etc, if any, and will be displayed on the Website when you place your order. Full payment must be made for all the particulars mentioned in the order by available methods of payment on the website.
            For online payment, you would be directed to secured payment gateway managed and secured by RazorPay. By providing your card, wallet or any other payment instrument detail to RazorPay, you accept that you trust the Privacy and Terms of Usage RazorPay provides. We or our employees are in no way liable for any breach of data or failure of transaction. You can refer to https://razorpay.com/ to get more details about RazorPay. Your credit card company may conduct additional and necessary security checks to confirm about your identification before making any such payment.
            You warrant that you are the authorized user of payment instrument you are using for making a payment.
          </p>
          <h4 class="title">Delivery</h4>
          <p>
            Delivery period quoted at the time of ordering are approximate only and may vary. Services will be delivered to the address as intimated by you while ordering.
            We will make every effort to deliver services within the time stated; however, we will not be liable for any loss caused to you by late delivery. You can contact us on our number to get the status of delivery - we will do our best to deliver services to you as quickly as possible. We, under no circumstances would refund the payment.
            If you fail to accept delivery of ordered service after it is ready or we are unable to deliver at the estimated time due to your failure to provide appropriate instructions or authorizations, then the service shall be deemed to have been delivered to you and all risk and responsibility in relation to such service shall pass to you. Any storage, insurance and other costs which we incur as a result of the inability to deliver shall be your responsibility and you shall indemnify us in full for such cost.
            At the time of delivery of, you must ensure that adequate arrangement to recieve service safely are in place including access where necessary. You would be accountable for any mishaps and liable to cover the damage in addition to the cost of order service.
          </p>
          <h4 class="title">Refund Policy</h4>
          <p>
            When applicable, refund will be credited to you within 4-5 days of refund confirmation.
          </p>
        </div>
        </div>
        <footer>
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
                                              <button type="submit" id="doSignIn" class="btn btn-success">Sign In</button>
                                          </form>
                                  </div>
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
    <script src="../../../cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>
    <!--JQuery Validate -->
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <!-- Own script-->
    <script src="assets/js/layout.js"></script>
    <script src="assets/js/elements.js"></script>
    <script src="assets/js/widget.js"></script>
     <!--Bootstrap Slecet JS-->
    <script src="assets/vendors/bootstrap-select/js/bootstrap-select.js"></script>
    <!--Custom App Js-->
    <script src="assets/js/app.js"></script>
  </body>
</html>